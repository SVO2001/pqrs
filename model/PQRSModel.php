<?php
class PQRSModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function insertarPQRS($tipo_persona, $nombre, $tipo_documento, $numero_documento, $lugar_expedicion, $direccion, $ciudad, $telefono, $correo, $descripcion, $anexos) {
        // Preparar la consulta SQL para insertar los datos
        $sql = "INSERT INTO pqrs (tipo_persona, nombre, tipo_documento, numero_documento, lugar_expedicion, direccion, ciudad, telefono, correo, descripcion, anexos)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Preparar la sentencia
        $stmt = $this->pdo->prepare($sql);

        // Ejecutar la sentencia con los valores recibidos
        return $stmt->execute([$tipo_persona, $nombre, $tipo_documento, $numero_documento, $lugar_expedicion, $direccion, $ciudad, $telefono, $correo, $descripcion, $anexos]);
    }

    public function obtenerPQRSPorId($id) {
        // Consultar la PQRS por ID
        $sql = "SELECT * FROM pqrs WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Método para obtener todas las PQRS
    public function obtenerTodasPQRSS() {
        // Consultar todas las PQRS
        $sql = "SELECT * FROM pqrs";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para actualizar el estado de una PQRS
    public function actualizarEstadoPQRS($estado, $id) {
        $sql = "UPDATE pqrs SET estado = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$estado, $id]);
    }

    // Método para obtener los archivos adjuntos de una PQRS por ID
    public function obtenerAnexosPQRS($id) {
        // Consultar los anexos de la PQRS
        $sql = "SELECT anexos FROM pqrs WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['anexos'] : null;
    }
}
?>
