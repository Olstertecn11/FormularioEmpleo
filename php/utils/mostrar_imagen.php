<?php

$mysqli = new mysqli('localhost', 'root', '', 'bolsaempleo');

if ($mysqli->connect_error) {
    die('Error de conexión: ' . $mysqli->connect_error);
}

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    
    $stmt = $mysqli->prepare("SELECT * FROM tbl_form_empleo WHERE cod_id = ?");
    $stmt->bind_param('s', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_array();
    echo '<img src="' . $row['bl_foto'] . '"/>';
    $stmt->close();
}

$mysqli->close();

?>

