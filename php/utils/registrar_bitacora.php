<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require('./../var.php');
class registrarBitacora extends Database{
  public function guardar($username, $accion, $modulo) {
    $fecha = date("Y-m-d");
    $hora = date("H:i:s");
    $ip = $_SERVER['REMOTE_ADDR'];
    $sql = "INSERT INTO tbl_bitacora (bit_username, bit_ip, bit_fecha, bit_hora, bit_accion, bit_modulo) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("ssssss", $username, $ip, $fecha, $hora, $accion, $modulo);
    $stmt->execute();
  }

}
?>
