<?php

class geocodificacion {

    private $nominatimUrl = "https://nominatim.openstreetmap.org/search";
    private $osrmUrl = "https://router.project-osrm.org/nearest/v1/driving";
    private $osrmRouteUrl = "https://router.project-osrm.org/route/v1/driving";
    private $userAgent = "Epsilon-GestionResiduos/1.0";

    public function geocodificarDireccion($calle, $numero, $barrio) {
        $direccion = "$calle $numero, $barrio, Montevideo, Uruguay";

        $params = http_build_query([
            "format" => "json",
            "limit"  => 1,
            "q"      => $direccion
        ]);

        $ch = curl_init("{$this->nominatimUrl}?{$params}");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "User-Agent: {$this->userAgent}",
            "Accept-Language: es"
        ]);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);

        $respuesta = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);

        if ($error) {
            throw new Exception("Error al conectar con Nominatim: $error");
        }

        $datos = json_decode($respuesta, true);

        if (empty($datos)) {
            return null; // no se encontró la dirección
        }

        return [
            "lat"      => floatval($datos[0]["lat"]),
            "lon"      => floatval($datos[0]["lon"]),
            "etiqueta" => $datos[0]["display_name"]
        ];
    }
    public function snapearACalle($lat, $lon) {
        $url = "{$this->osrmUrl}/{$lon},{$lat}";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "User-Agent: {$this->userAgent}"
        ]);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);

        $respuesta = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);

        if ($error) {
            return ["lat" => $lat, "lon" => $lon];
        }

        $datos = json_decode($respuesta, true);

        if (
            empty($datos) ||
            $datos["code"] !== "Ok" ||
            empty($datos["waypoints"])
        ) {
            return ["lat" => $lat, "lon" => $lon];
        }

        // OSRM devuelve [lon, lat]
        $ubicacionCalle = $datos["waypoints"][0]["location"];

        return [
            "lat" => floatval($ubicacionCalle[1]),
            "lon" => floatval($ubicacionCalle[0])
        ];
    }

    public function GYSDireccion($calle, $numero, $barrio) {
        $resultado = $this->geocodificarDireccion($calle, $numero, $barrio);

        if ($resultado === null) {
            return null; // no se encontró la dirección
        }

        $coordenadasCalle = $this->snapearACalle($resultado["lat"], $resultado["lon"]);

        return [
            "lat"      => $coordenadasCalle["lat"],
            "lon"      => $coordenadasCalle["lon"],
            "etiqueta" => $resultado["etiqueta"]
        ];
    }
    
    public function calcularRutaCalles(array $puntos) {
        if (count($puntos) < 2) {
            return null;
        }

        $coordenadas = implode(';', array_map(function ($p) {
            return $p['lon'] . ',' . $p['lat'];
        }, $puntos));

        $url = "{$this->osrmRouteUrl}/{$coordenadas}?overview=full&geometries=geojson";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "User-Agent: {$this->userAgent}"
        ]);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);

        $respuesta = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);

        if ($error) {
            throw new Exception("Error al conectar con OSRM: $error");
        }

        $datos = json_decode($respuesta, true);

        if (empty($datos) || $datos["code"] !== "Ok" || empty($datos["routes"])) {
            return null;
        }

        $ruta = $datos["routes"][0];

        // GeoJSON devuelve cada punto como [lon, lat]; lo invertimos para Leaflet ([lat, lon]).
        $geometria = array_map(function ($coord) {
            return ["lat" => $coord[1], "lon" => $coord[0]];
        }, $ruta["geometry"]["coordinates"]);

        return [
            "geometria"        => $geometria,
            "distanciaMetros"  => $ruta["distance"],
            "duracionSegundos" => $ruta["duration"],
        ];
    }
}