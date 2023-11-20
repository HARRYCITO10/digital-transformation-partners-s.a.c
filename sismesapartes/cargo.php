<?php
require 'vendor/autoload.php';
use Dompdf\Dompdf;

$id = $_GET['id'];

require('conexion.php');
date_default_timezone_set('America/Lima');
$sentencia=$conexion->prepare("SELECT * FROM expedientes WHERE id=:id");
$sentencia->bindParam(":id",$id);
$sentencia->execute();
    
$registro = $sentencia->fetch(PDO::FETCH_ASSOC);
$remitente = $registro['remitente'];
$tipo_doc = $registro['tipo_doc'];
$folio = $registro['folio'];
$asunto = $registro['asunto'];
$codigoSeguridad = $registro['cod_seguridad'];
$num_expediente = $registro['num_expediente'];
$fecha = date('d/m/Y H:i:s');
$correo = $registro['correo'];
$telefono = $registro['telefono'];


$dompdf = new Dompdf();


$pdfContent = '
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cargo de Trámite</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }
        .container {
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .header p {
            margin: 0;
            font-size: 16px;
            color: #777;
        }
        .content {
            margin-bottom: 30px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .table th,
        .table td {
            padding: 10px;
            border: 1px solid #ccc;
            font-size: 14px;
            text-align: left;
        }
        .table th {
            background-color: #f5f5f5;
            font-weight: bold;
            white-space: nowrap;
        }
        .table td {
            white-space: nowrap;
        }
        .footer {
            text-align: center;
            font-size: 14px;
            color: #777;
            margin-top: 30px;
        }
        .rectangle {
            position: relative;
            width: 30%;
            margin-bottom: 20px;
            border: 1px solid #000;
            padding: 5px 10px;
        }
        .rectangle p {
            margin: 0;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">

        <div class="content">
            <div class="rectangle">
                <p>CARGO</p>
                <p>N° ' . $num_expediente . '</p>
            </div>
            <table class="table">
                 <tr>
                    <th>N° expediente:</th>
                    <td>' . $num_expediente . '</td>
                </tr>
                <tr>
                    <th>Remitente:</th>
                    <td>' . $remitente . '</td>
                </tr>
                <tr>
                    <th>Tipo de documento:</th>
                    <td>' . $tipo_doc . '</td>
                </tr>
                <tr>
                    <th>Folios:</th>
                    <td>' . $folio . '</td>
                </tr>
                <tr>
                    <th>Asunto:</th>
                    <td>' . $asunto . '</td>
                </tr>
                <tr>
                    <th>Código de seguridad:</th>
                    <td>' . $codigoSeguridad . '</td>
                </tr>
                <tr>
                    <th>Fecha y hora:</th>
                    <td>' . $fecha . '</td>
                </tr>
                <tr>
                    <th>Correo:</th>
                    <td>' . $correo . '</td>
                </tr>
                <tr>
                    <th>Teléfono:</th>
                    <td>' . $telefono . '</td>
                </tr>
            </table>
        </div>
        <div class="footer">
            <p>Estimado(a) usuario, recuerda que con el N° de Expediente y el código de seguridad puedes realizar el seguimiento de tu trámite.</p>
        </div>
    </div>
</body>
</html>';


$dompdf->loadHtml($pdfContent);


$dompdf->render();


header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="cargo_tramite.pdf"');
header('Cache-Control: private, max-age=0, must-revalidate');
header('Pragma: public');
header('Content-Length: ' . strlen($dompdf->output()));


echo $dompdf->output();
exit();
?>