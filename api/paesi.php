<?php

require '../db.php';

header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        // Ottenere tutti i paesi
        $sql = "SELECT * FROM paesi";
        $result = $conn->query($sql);
        $paesi = [];
        while($row = $result->fetch_assoc()) {
            $paesi[] = $row;
        }
        echo json_encode($paesi);
        break;

    case 'POST':
        // Inserire un nuovo paese
        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($data['nome']) && !empty($data['nome'])) {
            $nome = $conn->real_escape_string(trim($data['nome']));
            $sql = "INSERT INTO paesi (nome) VALUES ('$nome')";
            if ($conn->query($sql) === TRUE) {
                http_response_code(201);
                echo json_encode(["message" => "Paese creato con successo"]);
            } else {
                http_response_code(500);
                echo json_encode(["message" => "Errore durante la creazione del paese"]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Nome del paese non fornito"]);
        }
        break;

    case 'PUT':
        // Modificare un paese
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $data = json_decode(file_get_contents("php://input"), true);
        if ($id > 0 && isset($data['nome']) && !empty($data['nome'])) {
            $nome = $conn->real_escape_string(trim($data['nome']));
            $sql = "UPDATE paesi SET nome='$nome' WHERE id=$id";
            if ($conn->query($sql) === TRUE) {
                echo json_encode(["message" => "Paese aggiornato con successo"]);
            } else {
                http_response_code(500);
                echo json_encode(["message" => "Errore durante l'aggiornamento del paese"]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "ID o nome del paese non fornito"]);
        }
        break;

    case 'DELETE':
        // Cancellare un paese
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        if ($id > 0) {
            $sql = "DELETE FROM paesi WHERE id=$id";
            if ($conn->query($sql) === TRUE) {
                echo json_encode(["message" => "Paese cancellato con successo"]);
            } else {
                http_response_code(500);
                echo json_encode(["message" => "Errore durante la cancellazione del paese"]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "ID del paese non fornito"]);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(["message" => "Metodo non supportato"]);
        break;
}

$conn->close();

?>

