<?php
error_reporting(E_ALL);
// Activar la visualización de errores en pantalla
ini_set('display_errors', 1);
require('./login_model.php');
$loginmodel = new LoginModel();

switch($_SERVER['REQUEST_METHOD']){
    case 'GET':
        break;
    case 'POST':
    
    if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password'])) {
      $usuario = $_POST['username'];
      $contrasena = $_POST['password'];
      $response =  $loginmodel->existUser($usuario, $contrasena);

      if($response){
        session_start();
        session_regenerate_id();
        $_SESSION["auth"] = TRUE;
        $_SESSION["userId"] = $response['usr_id']; 
        $_SESSION["userName"] = $response['usr_nombre']; 
        echo json_encode(array("response" => 1)); 
      } else {
        echo json_encode(array("response" => 2)); 
      }
    } else {
      echo json_encode(array("response" => 3)); 
    }

}
?>
