
<?php

require('./userModel.php');
$usermodel = new userModel();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $usuario = $_POST['usuario'];
    $pass = $_POST['contra'];        // Verificar si los datos no están vacíos
    $contra = password_hash($pass, PASSWORD_DEFAULT);
        if(!empty($nombre) && !empty($apellido) && !empty($correo) && !empty($usuario) && !empty($contra)) {
            $usermodel->insertUser($nombre, $apellido, $correo, $usuario, $contra);
        } else {
          echo "Por favor, complete todos los campos del formulario.";
        }

}

if($_SERVER["REQUEST_METHOD"] == "GET"){
  echo 'NULL';
}
?>

