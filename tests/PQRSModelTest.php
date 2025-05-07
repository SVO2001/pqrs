<?php
// tests/PQRSModelTest.php
use PHPUnit\Framework\TestCase;

// Se incluye la ruta del modelo Model/PQRSModel.php
require_once __DIR__ . '/../model/PQRSModel.php';

class PQRSModelTest extends TestCase
{
    // Conexión PDO que se usará en las pruebas
    private $pdo;
    private $pqrsModel;

    // Este método se ejecuta antes de cada prueba
    protected function setUp(): void
    {
        // Configuración de la conexión PDO con las credenciales correctas
        $this->pdo = new PDO('mysql:host=localhost;dbname=proyecto', 'root', ''); 
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Crear la instancia del modelo
        $this->pqrsModel = new PQRSModel($this->pdo);
    }

    public function testInsertarPQRS()
    {
        // Datos de prueba
        $tipo_persona = 'estudiante';
        $nombre = 'Juan Pérez';
        $tipo_documento = 'CC';
        $numero_documento = '123456789';
        $lugar_expedicion = 'Bogotá';
        $direccion = 'Calle 123';
        $ciudad = 'Bogotá';
        $telefono = '1234567890';
        $correo = 'juan@correo.com';
        $descripcion = 'Descripción de la PQRS';
        $anexos = 'Archivo adjunto';

        // Verificar que se inserte correctamente
        $result = $this->pqrsModel->insertarPQRS($tipo_persona, $nombre, $tipo_documento, $numero_documento, $lugar_expedicion, $direccion, $ciudad, $telefono, $correo, $descripcion, $anexos);
        $this->assertTrue($result); // Se espera que la función retorne true si se insertó correctamente
    }

    public function testObtenerPQRSPorId()
    {
        // Probar obtener una PQRS por ID
        $id = 1;  // Usar un ID de prueba
        $pqrs = $this->pqrsModel->obtenerPQRSPorId($id);

        // Verificar que el resultado no sea nulo
        $this->assertNotNull($pqrs); // Se espera que retorne un array con los datos de la PQRS
    }

    public function testActualizarEstadoPQRS()
    {
        // Datos de prueba
        $estado = 'En proceso';
        $id = 1;  // Usar un ID de prueba

        // Verificar que se actualice correctamente el estado
        $result = $this->pqrsModel->actualizarEstadoPQRS($estado, $id);
        $this->assertTrue($result); // Se espera que la función retorne true si se actualizó correctamente
    }
}
?>
