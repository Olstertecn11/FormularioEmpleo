<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require('./registrar_bitacora.php');
$bitmodel = new registrarBitacora();

switch($_SERVER['REQUEST_METHOD']){
    case 'GET':
        echo 'Calling...';
        break;
    case 'POST':
      $data = json_decode(file_get_contents('php://input'), true);

      if(isset($data['username'], $data['action'], $data['module'])) {
        $usuario = $data['username'];
        $accion = $data['action'];
        $modulo = $data['module'];
        $bitmodel->guardar($usuario, $accion, $modulo);
        echo "Saved";
      } else {
        echo "Error";
      }
      break;


}
?>
