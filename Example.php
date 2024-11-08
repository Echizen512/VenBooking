<?php
$url = "https://ve.dolarapi.com/v1/dolares";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json"
]);

$response = curl_exec($ch);
curl_close($ch);

if ($response !== false) {
    $data = json_decode($response, true);

    if ($data !== null) {
        echo "Dólar: " . $data[0]['nombre'] . " (BCV)" . "<br>";
        echo "Promedio: " . $data[0]['promedio'] . "<br>";
        echo "Fecha de Actualización: " . $data[0]['fechaActualizacion'] . "<br>";
    } else {
        echo "Error al convertir la respuesta JSON.";
    }
} else {
    echo "Error al obtener los datos de la API.";
}
?>
