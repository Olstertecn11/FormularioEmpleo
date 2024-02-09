<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require('./../var.php');

class passModel extends Database {
    public function createToken($correo){
        $token = bin2hex(random_bytes(16));
        $sql = "INSERT INTO tbl_token (tk_valor) VALUES ('$token')";

        if ($this->conn->query($sql) === TRUE) {
          $to = $correo;
          $subject = "Token de recuperacion de contraseña";
          $message = "Por favor ingrese al siguiente link para restalecer su contraseña: https://ovg.gt/formularios/empleo/admin/recuperacion.php?tk=". $token."&cr=".$correo;
          $headers = "From: otzunund@miumg.edu.gt\r\n";
          $headers .= "Content-Type: text/plain; charset=utf-8\r\n";

          if (mail($to, $subject, $message, $headers)) {
            echo "El correo ha sido enviado correctamente.";
          } else {
            echo "Error al enviar el correo.";
          }
          echo "Token creado correctamente";
          header("Location: ./../../index.html");
          exit(); 
        } else {
          echo "Error al insertar registro: " . $this->conn->error;
        }
    }

    public function saveNewPass($token, $pass, $email) {
      $sql = "SELECT * FROM tbl_token WHERE tk_valor = ?";
      $stmt = $this->conn->prepare($sql);
      $stmt->bind_param("s", $token);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $update_sql = "UPDATE tbl_usuario SET usr_contra = ? WHERE usr_correo = ?";
        $stmt_update = $this->conn->prepare($update_sql);
        $stmt_update->bind_param("ss", $pass, $email);
        $stmt_update->execute();
        $delete_sql = "DELETE FROM tbl_token WHERE tk_valor = ?";
        $stmt_delete = $this->conn->prepare($delete_sql);
        $stmt_delete->bind_param("s", $token);
        $stmt_delete->execute();
        $response = array("success" => true, "message" => "Password reset successful");
        echo json_encode($response);
      } else {
        $response = array("success" => false, "message" => "User not found");
        echo json_encode($response);
      }
    }
}

?>

