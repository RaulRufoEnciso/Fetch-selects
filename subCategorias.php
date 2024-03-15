<?php
// Connexió a la base de dades
$db = new mysqli("localhost", "root", "", "sabeslomalodelast");

// Comprova la connexió
if($db->connect_error) {
    die("Connexió fallida: " . $db->connect_error);
}

// Recull l'ID de la categoria
$catId = $_POST['cat1']; // Aquí assumeix que l'ID ve del frontend via POST

// Prepara la consulta
$query = "SELECT id, nom FROM subcategories WHERE categoria_id = ?";
$stmt = $db->prepare($query);
$stmt->bind_param("i", $catId);

// Executa la consulta
$stmt->execute();
$result = $stmt->get_result();

// Prepara l'array de retorn
$return = array();
while($row = $result->fetch_assoc()) {
    $object = new stdClass();
    $object->nom = $row["nom"];
    $object->id = $row["id"];
    $return[] = $object;
}

// Tanca la connexió
$stmt->close();
$db->close();

// Retorna les dades com a JSON
echo json_encode($return);
