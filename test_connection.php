<?php
$host = 'localhost'; 
$db = 'proyecto';   
$user = 'root';      
$pass = '';          

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexión exitosa a la base de datos!";
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
