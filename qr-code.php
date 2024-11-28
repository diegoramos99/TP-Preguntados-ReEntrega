<?php

require '../vendor/autoload.php';

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\Color\Color;

// Información para el QR
$usuario = "JuanPerez";
$ciudad = "Buenos Aires";
$pais = "Argentina";
$data = "Usuario: $usuario, Ubicación: $ciudad, $pais";

// Ruta para guardar el archivo QR
$qrFile = __DIR__ . '/../qr_codes/usuario_qr.png';

// Crear la carpeta 'qr_codes' si no existe
if (!file_exists(__DIR__ . '/../qr_codes')) {
    mkdir(__DIR__ . '/../qr_codes', 0777, true);
}

// Crear el objeto QrCode
$qrCode = new QrCode($data);

// Configurar propiedades del QR
$qrCode->setEncoding(new Encoding('UTF-8'));
$qrCode->setErrorCorrectionLevel(new ErrorCorrectionLevelLow());
$qrCode->setForegroundColor(new Color(0, 0, 0)); // Color negro
$qrCode->setBackgroundColor(new Color(255, 255, 255)); // Fondo blanco

// Usar un Writer para exportar el QR en PNG
$writer = new PngWriter();
$result = $writer->write($qrCode);

// Guardar el QR en un archivo
$result->saveToFile($qrFile);

// Mostrar mensaje de éxito
echo "Código QR generado en: $qrFile";

?>