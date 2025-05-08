<?php
$host = 'mi-servidor-mysql.mysql.database.azure.com';
$db = 'proyecto';
$user = 'adminusuario';
$pass = 'Sebastian2001';
$sslCert = 'C:\ruta\al\archivo\DigiCertGlobalRootCA.crt.pem';  // Ruta al archivo .pem

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$db", 
        $user, 
        $pass, 
        array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::MYSQL_ATTR_SSL_CA => $sslCert,  // Ruta al certificado
            PDO::MYSQL_ATTR_SSL_KEY => $sslCert, // Opcional si tienes un archivo de clave
            PDO::MYSQL_ATTR_SSL_CERT => $sslCert // Opcional si tienes un archivo de certificado
        )
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
