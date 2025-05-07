<?php
// Incluir la conexión a la base de datos y el Modelo
include_once '../config/db_config.php';
include_once '../model/PQRSModel.php';

// Crear una instancia del modelo
$pqrsModel = new PQRSModel($pdo);

// Obtener el número de radicado desde la URL
$radicado = isset($_GET['radicado']) ? $_GET['radicado'] : null;
$pqrs = null;

if ($radicado) {
    // Obtener la PQRS por el número de radicado
    $pqrs = $pqrsModel->obtenerPQRSPorId($radicado);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Impresión de PQRS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
            }
            .container {
                width: 100%;
                padding: 20px;
            }
            .btn {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container py-4">
        <h5 class="mb-3">Detalles de la PQRS</h5>
        <?php if ($pqrs): ?>
            <div class="card">
                <div class="card-body">
                    <h6><strong>Nombre o razón social:</strong> <?php echo htmlspecialchars($pqrs['nombre']); ?></h6>
                    <p><strong>Tipo de documento:</strong> <?php echo ucfirst($pqrs['tipo_documento']); ?></p>
                    <p><strong>Número de documento:</strong> <?php echo $pqrs['numero_documento']; ?></p>
                    <p><strong>Lugar de expedición:</strong> <?php echo $pqrs['lugar_expedicion']; ?></p>
                    <p><strong>Dirección:</strong> <?php echo $pqrs['direccion']; ?></p>
                    <p><strong>Ciudad:</strong> <?php echo $pqrs['ciudad']; ?></p>
                    <p><strong>Teléfono:</strong> <?php echo $pqrs['telefono']; ?></p>
                    <p><strong>Correo electrónico:</strong> <?php echo $pqrs['correo']; ?></p>
                    <p><strong>Descripción:</strong> <?php echo nl2br(htmlspecialchars($pqrs['descripcion'])); ?></p>
                    <p><strong>Archivos adjuntos:</strong> 
                        <?php if ($pqrs['anexos']): ?>
                            <?php 
                            $anexos = explode(',', $pqrs['anexos']);
                            foreach ($anexos as $anexo): 
                            ?>
                                <a href="../uploads/<?php echo $anexo; ?>" target="_blank"><?php echo $anexo; ?></a><br>
                            <?php endforeach; ?>
                        <?php else: ?>
                            No hay archivos adjuntos.
                        <?php endif; ?>
                    </p>
                    <p><strong>Fecha de radicación:</strong> <?php echo $pqrs['fecha']; ?></p>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-danger mt-3">No se encontró ninguna PQRS con el número de radicado ingresado.</div>
        <?php endif; ?>
        <button class="btn btn-success" onclick="window.print()">Imprimir</button>
    </div>
</body>
</html>
