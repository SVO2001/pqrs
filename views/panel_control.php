<?php
// Incluir la conexión a la base de datos y el Modelo
include_once '../config/db_config.php';
include_once '../model/PQRSModel.php';

// Crear una instancia del modelo
$pqrsModel = new PQRSModel($pdo);

// Obtener todas las PQRS de la base de datos
$pqrsList = $pqrsModel->obtenerTodasPQRSS();

// Actualizar el estado de una PQRS
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['estado'], $_POST['id'])) {
    $estado = $_POST['estado'];
    $id = $_POST['id'];
    $pqrsModel->actualizarEstadoPQRS($estado, $id);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control - Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <div class="container-fluid py-4">
        <h5 class="text-primary">Panel de Control - Administrador</h5>
        <div class="mt-3">
            <h6>Lista de PQRS</h6>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Número de Radicado</th>
                        <th scope="col">Nombre del Solicitante</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acción</th>
                        <th scope="col">Ver anexos</th> <!-- Nueva columna -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pqrsList as $pqrs): ?>
                        <tr>
                            <td><?php echo $pqrs['id']; ?></td>
                            <td><?php echo $pqrs['nombre']; ?></td>
                            <td>
                                <!-- Formulario para actualizar el estado -->
                                <form method="POST" action="panel_control.php">
                                    <input type="hidden" name="id" value="<?php echo $pqrs['id']; ?>">
                                    <select name="estado" class="form-select">
                                        <option value="Recibida" <?php echo $pqrs['estado'] == 'Recibida' ? 'selected' : ''; ?>>Recibida</option>
                                        <option value="En Gestión" <?php echo $pqrs['estado'] == 'En Gestión' ? 'selected' : ''; ?>>En Gestión</option>
                                        <option value="Resuelta" <?php echo $pqrs['estado'] == 'Resuelta' ? 'selected' : ''; ?>>Resuelta</option>
                                    </select>
                                    <button type="submit" class="btn btn-success mt-2">Actualizar Estado</button>
                                </form>
                            </td>
                            <td>
                                <a href="visualizar_pqrs.php?radicado=<?php echo $pqrs['id']; ?>" class="btn btn-info">Ver detalles</a>
                                <a href="imprimir_pqrs.php?radicado=<?php echo $pqrs['id']; ?>" class="btn btn-warning">Imprimir</a>
                            </td>
                            <td>
                                <!-- Mostrar enlace de Ver anexos si hay archivo adjunto -->
                                <?php if ($pqrs['anexos']): ?>
                                    <a href="ver_anexos.php?radicado=<?php echo $pqrs['id']; ?>" class="btn btn-primary">Ver anexos</a>
                                <?php else: ?>
                                    No hay anexos
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
