<?php
// Incluir la conexión a la base de datos y el Modelo
include_once '../config/db_config.php';
include_once '../model/PQRSModel.php';

// Crear una instancia del modelo
$pqrsModel = new PQRSModel($pdo);

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $tipo_persona = $_POST['tipoPersona'];
    $nombre = $_POST['nombre'];
    $tipo_documento = $_POST['tipoDocumento'];
    $numero_documento = $_POST['numeroDocumento'];
    $lugar_expedicion = $_POST['lugarExpedicion'];
    $direccion = $_POST['direccion'];
    $ciudad = $_POST['ciudad'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $descripcion = $_POST['descripcionPqrs'];

    // Manejo de los anexos (archivos subidos)
    $anexos = [];
    if (!empty($_FILES['anexos']['name'][0])) {
        $total_files = count($_FILES['anexos']['name']);
        for ($i = 0; $i < $total_files; $i++) {
            $file_name = $_FILES['anexos']['name'][$i];
            $file_tmp_name = $_FILES['anexos']['tmp_name'][$i];
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $new_name = uniqid() . '.' . $file_ext;
            $upload_dir = '../uploads/';
            
            // Mover el archivo a la carpeta de uploads
            if (move_uploaded_file($file_tmp_name, $upload_dir . $new_name)) {
                $anexos[] = $new_name; // Guardar el nombre del archivo
            }
        }
    }
    $anexos = implode(',', $anexos); // Convertir el array de anexos en una cadena separada por comas

    // Llamar al método del Modelo para insertar la PQRS
    if ($pqrsModel->insertarPQRS($tipo_persona, $nombre, $tipo_documento, $numero_documento, $lugar_expedicion, $direccion, $ciudad, $telefono, $correo, $descripcion, $anexos)) {
        // Redirigir a la página de visualización de PQRS con el número de radicado
        $id_radicado = $pdo->lastInsertId();
        header("Location: ../views/visualizar_pqrs.php?radicado=" . $id_radicado);
        exit(); // Terminar la ejecución del script después de redirigir
    } else {
        echo "Hubo un error al radicar la PQRS.";
    }
}
?>
