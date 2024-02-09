<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require('./../var.php');
  class userModel extends Database{
   

  public function insertUser($nombre, $apellido, $correo, $usuario, $contra){
    $sql = "INSERT INTO tbl_usuario (usr_nombre, usr_apellido, usr_correo, usr_usuario, usr_contra) 
            VALUES ('$nombre', '$apellido', '$correo', '$usuario', '$contra')";
    if ($this->conn->query($sql) === TRUE) {
        echo "Registro insertado correctamente.";
        header("Location: ./../../panel.php");
        exit(); 
    } else {
        echo "Error al insertar registro: " . $this->conn->error;
    }
  }

}
?>
