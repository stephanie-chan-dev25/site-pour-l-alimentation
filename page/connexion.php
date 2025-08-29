<?php
$host = "localhost";
$user = "root";
$pass = "2032";
$dbname = "my_db";

// Connexion
$conn = new mysqli($host, $user, $pass, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("❌ Connexion échouée : " . $conn->connect_error);
}
?>