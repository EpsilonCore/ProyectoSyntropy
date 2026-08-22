<?php

class geocodificacion {

    private $nominatimUrl = "https://nominatim.openstreetmap.org/search";
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
}