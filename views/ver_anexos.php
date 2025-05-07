<?php
// Incluir la conexión a la base de datos y el Modelo
include_once '../config/db_config.php';
include_once '../model/PQRSModel.php';

// Crear una instancia del modelo
$pqrsModel = new PQRSModel($pdo);

// Verificar si se ha pasado el número de radicado
if (isset($_GET['radicado'])) {
    $radicado = $_GET['radicado'];
    $pqrs = $pqrsModel->obtenerPQRSPorId($radicado);
} else {
    die("No se ha especificado un número de radicado.");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Anexos - PQRS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-4">
        <h5 class="text-primary">Anexos de la PQRS</h5>

        <?php if (!empty($pqrs['anexos'])): ?>
            <h6>Archivo adjunto:</h6>
            <ul>
                <li>
                    <a href="../uploads/<?php echo htmlspecialchars(basename($pqrs['anexos'])); ?>" 
                       target="_blank" class="btn btn-outline-primary">
                        Ver archivo adjunto
                    </a>
                </li>
            </ul>
        <?php else: ?>
            <p class="text-warning">No hay archivos adjuntos para esta PQRS.</p>
        <?php endif; ?>

        <a href="panel_control.php" class="btn btn-secondary mt-3">Volver al Panel de Control</a>
    </div>
</body>
</html>
