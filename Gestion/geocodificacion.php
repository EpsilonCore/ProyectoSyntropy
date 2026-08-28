<?php

class geocodificacion {

    private $nominatimUrl = "https://nominatim.openstreetmap.org/search";
    private $osrmUrl = "https://router.project-osrm.org/nearest/v1/driving";
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

    /**
     * Ajusta una coordenada al punto más cercano sobre una calle transitable,
     * usando el servicio público de OSRM. Sirve para corregir el caso en que
     * Nominatim devuelve el centroide de un edificio en vez de un punto en la calle.
     */
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
            // Si OSRM falla, devolvemos la coordenada original como respaldo
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
}