<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

class Database{
  // private $db_host = 'localhost';
  // private $db_user = 'root';
  // private $db_password = '';
  // private $db_schema = 'bolsaempleo';
  // public $conn = '';
  // //
  private $db_host = 'localhost';
  private $db_user = 'ovggt_ovggt_formulario_admin';
  private $db_password = 'wlan.in3.';
  private $db_schema = 'ovggt_formulario';
  public $conn = '';

  public function __construct()
  {
    $this->conn = $this->catchError($this->connect());
  }

  public function catchError($newConnection){
    if ($newConnection->connect_error) {
      $response = array("connected" => false, "message" => "Connection failed: " . $newConnection->connect_error);
      echo json_encode($response);
    } else {
      $response = array("connected" => true, "message" => "Connected successfully");
      return $newConnection;
      echo json_encode($response);
    }
    return $newConnection;
  }

  public function connect(){
    if (!$this->conn) {
      return mysqli_connect($this->db_host, $this->db_user, $this->db_password, $this->db_schema);
    } 
    return null;
  }

  public function disconnect() 
  {
    if ($this->conn) {
      if (mysqli_close($this->conn)) {
        $this->conn = false; 
        return true;
      } else {
        return false;
      }
    }
  }
}


?>
