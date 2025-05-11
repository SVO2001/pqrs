<?php
$host = 'mi-servidor-mysql.mysql.database.azure.com';
$db = 'proyecto';
$user = 'adminusuario';
$pass = 'Sebastian2001';

try {
    // Establecer la conexión PDO sin SSL 
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass, array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ));
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
