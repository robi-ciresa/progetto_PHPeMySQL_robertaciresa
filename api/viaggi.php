<?php

require '../db.php';

header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $sql = "SELECT v.id, v.posti_disponibili, GROUP_CONCAT(p.nome) AS paesi 
                FROM viaggi v
                LEFT JOIN viaggio_paese vp ON v.id = vp.viaggio_id
                LEFT JOIN paesi p ON vp.paese_id = p.id
                GROUP BY v.id";
        
        // Filtrare per numero di posti disponibili se specificato
        if (isset($_GET['posti_disponibili'])) {
            $posti = intval($_GET['posti_disponibili']);
            $sql .= " HAVING v.posti_disponibili >= $posti";
        }
        
        // Filtrare per paese se specificato
        if (isset($_GET['paese'])) {
            $paese = $conn->real_escape_string($_GET['paese']);
            $sql .= " AND FIND_IN_SET('$paese', paesi) > 0";
        }

        $result = $conn->query($sql);
        $viaggi = [];
        while($row = $result->fetch_assoc()) {
            $viaggi[] = $row;
        }
        echo json_encode($viaggi);
        break;

    case 'POST':
        // Inserire un nuovo viaggio
        $data = json_decode(file_get_contents("php://input"), true);
        $posti_disponibili = isset($data['posti_disponibili']) ? intval($data['posti_disponibili']) : 0;
        $paesi = isset($data['paesi']) ? $data['paesi'] : [];  // Array di ID dei paesi

        if ($posti_disponibili > 0 && !empty($paesi)) {
            $sql = "INSERT INTO viaggi (posti_disponibili) VALUES (?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $posti_disponibili);
            if ($stmt->execute()) {
                $viaggio_id = $conn->insert_id;

                $stmt = $conn->prepare("INSERT INTO viaggio_paese (viaggio_id, paese_id) VALUES (?, ?)");
                foreach ($paesi as $paese_id) {
                    $paese_id = intval($paese_id);
                    $stmt->bind_param("ii", $viaggio_id, $paese_id);
                    $stmt->execute();
                }

                http_response_code(201);
                echo json_encode(["message" => "Viaggio creato con successo"]);
            } else {
                http_response_code(500);
                echo json_encode(["message" => "Errore durante la creazione del viaggio"]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Dati del viaggio non forniti correttamente"]);
        }
        break;

    case 'PUT':
        // Modificare un viaggio
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $data = json_decode(file_get_contents("php://input"), true);
        $posti_disponibili = isset($data['posti_disponibili']) ? intval($data['posti_disponibili']) : 0;
        $paesi = isset($data['paesi']) ? $data['paesi'] : [];  // Array di ID dei paesi

        if ($posti_disponibili > 0 && $id > 0) {
            $sql = "UPDATE viaggi SET posti_disponibili=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $posti_disponibili, $id);
            if ($stmt->execute()) {
                $sql = "DELETE FROM viaggio_paese WHERE viaggio_id=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id);
                $stmt->execute();

                $stmt = $conn->prepare("INSERT INTO viaggio_paese (viaggio_id, paese_id) VALUES (?, ?)");
                foreach ($paesi as $paese_id) {
                    $paese_id = intval($paese_id);
                    $stmt->bind_param("ii", $id, $paese_id);
                    $stmt->execute();
                }

                echo json_encode(["message" => "Viaggio aggiornato con successo"]);
            } else {
                http_response_code(500);
                echo json_encode(["message" => "Errore durante l'aggiornamento del viaggio"]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "ID o dati del viaggio non forniti correttamente"]);
        }
        break;

    case 'DELETE':
        // Cancellare un viaggio
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        if ($id > 0) {
            $sql = "DELETE FROM viaggio_paese WHERE viaggio_id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();

            $sql = "DELETE FROM viaggi WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            if ($stmt->execute()) {
                echo json_encode(["message" => "Viaggio cancellato con successo"]);
            } else {
                http_response_code(500);
                echo json_encode(["message" => "Errore durante la cancellazione del viaggio"]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "ID del viaggio non fornito"]);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(["message" => "Metodo non supportato"]);
        break;
}

$conn->close();

?>



