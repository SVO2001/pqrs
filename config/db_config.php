<?php
$host = 'mi-servidor-mysql.mysql.database.azure.com';
$db = 'proyecto';
$user = 'adminusuario';
$pass = 'Sebastian2001';

// Ruta al archivo del certificado SSL
$ssl_ca = __DIR__ . '/SSL/DigiCertGlobalRootCA.crt.pem';  

try {
    // Establecer la conexión PDO con el archivo SSL
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass, array(
        PDO::MYSQL_ATTR_SSL_CA => $ssl_ca,  // Usar el archivo de certificado
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ));
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>

