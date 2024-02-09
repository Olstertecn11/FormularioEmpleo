<?php

require('./passModel.php');
$passmodel = new passModel();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $correo = $_POST['correo'];
  if(!empty($correo)){
    $passmodel->createToken($correo);
  } else {
    echo "Por favor, complete todos los campos del formulario.";
  }

}

if($_SERVER["REQUEST_METHOD"] == "GET"){
  $correo = $_GET['correo'];
  $token = $_GET['token'];
  $pass = $_GET['contra'];
  $passmodel->saveNewPass($token, $pass, $email);

}


?>

