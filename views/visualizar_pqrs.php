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
    <title>Visualización de PQRS - Colegio Laura Vicuña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12 px-4">
                <h5 class="mb-3 text-primary">Consulta de PQRS</h5>
                <?php if ($pqrs): ?>
                    <div class="alert alert-success mt-3">
                        <strong>¡PQRS radicada exitosamente!</strong> Tu número de radicado es: <?php echo $pqrs['id']; ?>
                    </div>
                    <h5 class="mt-4">Detalles de la PQRS</h5>
                    <div class="card mt-3">
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

                <div class="mt-4">
                    <p>¿No has radicado tu PQRS aún?</p>
                    <a href="formulario_pqrs.php" class="btn btn-primary">Radicar una nueva PQRS</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
