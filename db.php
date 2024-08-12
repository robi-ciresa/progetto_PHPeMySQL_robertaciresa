<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "orizon";

// Funzione per gestire errori
function handleError($message) {
    error_log($message . "\n", 3, __DIR__ . '/errors.log');
    http_response_code(500); 
    echo json_encode(["message" => "Errore interno del server."]);
    exit();
}

// Crea una connessione al database
$conn = new mysqli($servername, $username, $password, $dbname);

// Controlla la connessione
if ($conn->connect_error) {
    handleError("Connessione fallita: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

?>
