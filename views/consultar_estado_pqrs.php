<?php
// Incluir la conexión a la base de datos y el Modelo
include_once '../config/db_config.php';
include_once '../model/PQRSModel.php';

// Crear una instancia del modelo
$pqrsModel = new PQRSModel($pdo);

// Inicializar la variable de la PQRS
$pqrs = null;

// Verificar si se ha enviado el número de radicado
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['radicado'])) {
    $radicado = $_GET['radicado'];
    // Obtener la PQRS por su número de radicado
    $pqrs = $pqrsModel->obtenerPQRSPorId($radicado);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Estado de PQRS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <div class="container py-5">
        <h2>Consulta de Estado de PQRS</h2>
        
        <!-- Formulario de consulta -->
        <form method="GET" action="consultar_estado_pqrs.php">
            <div class="mb-3">
                <label for="radicado" class="form-label">Número de radicado</label>
                <input type="text" name="radicado" id="radicado" class="form-control" placeholder="Ingrese su número de radicado" required>
            </div>
            <button type="submit" class="btn btn-primary">Consultar</button>
        </form>

        <!-- Mostrar detalles de la PQRS -->
        <?php if ($pqrs): ?>
            <div class="mt-4">
                <h4>Detalles de la PQRS</h4>
                <p><strong>Estado:</strong> <?php echo $pqrs['estado']; ?></p>
                <p><strong>Nombre o razón social:</strong> <?php echo $pqrs['nombre']; ?></p>
                <p><strong>Tipo de documento:</strong> <?php echo $pqrs['tipo_documento']; ?></p>
                <p><strong>Número de documento:</strong> <?php echo $pqrs['numero_documento']; ?></p>
                <p><strong>Lugar de expedición:</strong> <?php echo $pqrs['lugar_expedicion']; ?></p>
                <p><strong>Dirección:</strong> <?php echo $pqrs['direccion']; ?></p>
                <p><strong>Ciudad:</strong> <?php echo $pqrs['ciudad']; ?></p>
                <p><strong>Teléfono:</strong> <?php echo $pqrs['telefono']; ?></p>
                <p><strong>Correo electrónico:</strong> <?php echo $pqrs['correo']; ?></p>
                <p><strong>Descripción:</strong> <?php echo $pqrs['descripcion']; ?></p>
                <p><strong>Archivos adjuntos:</strong> <?php echo $pqrs['anexos'] ? 'Sí' : 'No'; ?></p>
                <p><strong>Fecha de radicado:</strong> <?php echo $pqrs['fecha']; ?></p>
            </div>
        <?php elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['radicado'])): ?>
            <div class="alert alert-warning mt-4">
                No se encontró una PQRS con ese número de radicado.
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
