
<?php

session_start();

if (!isset($_SESSION['auth'])) {
  header('Location: index.html');
  exit;
}

$mysqli = new mysqli('localhost', 'root', '', 'bolsaempleo');

if ($mysqli->connect_error) {
  die('Error de conexión: ' . $mysqli->connect_error);
}

$sql = "SELECT * FROM tbl_form_empleo";
$resultado = $mysqli->query($sql);

$datos = array();

while ($fila = $resultado->fetch_assoc()) {
  $datos[] = $fila;
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <link rel="stylesheet" href="./css/inicio.css">
    <style>
    
    </style>
    <header class="header">
    </header>
    <span class="span-line"></span>
  </head>

  <body>
    <!-- <p>Hola de nuevo, <?= $_SESSION['userName'] ?> !!!</p> -->

    <div class="container mx-auto" style="margin-top: 10vw;">
      <div class="row mx-auto">
        <?php foreach ($datos as $dato) : ?>
        <div class="col-md-12 mb-3 mx-auto">
          <div class="card mb-3 mx-auto card-container" style="max-width: 740px;">
            <div class="row g-0">
              <div class="col-md-5">
                <img class="img-profile-card rounded-start" src="<?= $dato['bl_foto'] ?>" class="card-img-top thumbnail" alt="<?= $dato['des_nombre'] ?>">
              </div>
              <div class="col-md-7">
                <div class="card-body">
                  <h4 class="card-title"><?= $dato['des_nombre'] ?></h4>
                  <p class="card-text text-justify text-muted font-italic"><?= $dato['fec_solicitud'] ?></p>
                  <p class="card-text text-justify "><?= $dato['des_skills'] ?></p>
                  <p class="card-text"><small class="text-muted"><?= $dato['des_puesto_aplicado'] ?></small></p>
                  <button class="btn btn-warning">
                    Descargar CV
                  </button>
                  <button class="btn btn-success">
                    Visitar Perfil
                  </button>
                </div>
              </div>
            </div>
          </div>



        </div>
        <?php endforeach; ?>
      </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="./js/events.js"></script>
  </body>

</html>

