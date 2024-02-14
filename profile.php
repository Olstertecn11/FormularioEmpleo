<?php

session_start();

if (!isset($_SESSION['auth']) || !isset($_GET['cod_id'])) {
  header('Location: index.html');
  exit;
}

$codId = $_GET['cod_id'];

$mysqli = new mysqli('localhost', 'root', '', 'bolsaempleo');
// $mysqli = new mysqli('localhost', 'ovggt_ovggt_formulario_admin', 'wlan.in3.', 'ovggt_formulario');

if ($mysqli->connect_error) {
  die('Error de conexión: ' . $mysqli->connect_error);
}

$sql = "SELECT * FROM tbl_form_empleo where cod_id='$codId'";
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
      <link rel="stylesheet" href="./css/profile.css">
      <link rel="stylesheet" href="./css/navbar.css">
    <link rel="stylesheet" href="./css/global.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <header class="header">
    </header>
    <span class="span-line"></span>
  </head>

  <body>
    <!-- <p>Hola de nuevo, <?= $_SESSION['userName'] ?> !!!</p> -->


<div class="container mt-4 actions-buttons-container">
  <div class="row">
    <div class="col-md-8 ml-auto">
      <div class="p-2">
        <button class="btn btn-success" id="btn_export_pdf">Guardar en PDF</button>
        <button class="btn btn-warning ml-4 text-white" id="btn_print_pdf">Imprimir</button>
      </div>
    </div>
  </div>
</div>
    <div class="container mx-auto" style="margin-top: 4vw;" >
      <div class="row mx-auto" >
        <?php foreach ($datos as $dato) : ?>
        <div class="col-md-12 mb-3 mx-auto" id="pdf">
          <div class="card mb-3 mx-auto " style="max-width: 940px;">
            <div class="row g-0 row-header">
              <div class="col-md-5">
              <img class="img-profile-cv" src="<?= $dato['bl_foto'] ?>" class="card-img-top thumbnail" alt="<?= $dato['des_nombre'] ?>">
              </div>
              <div class="col-md-7">
                <div class="title-box">
                  <h2 class="title-name">  <?= $dato['des_nombre'] ?></h2>
                  <h5 class="subtitle-job"><?= $dato['des_puesto_aplicado'] ?></h5>
                </div>
              </div>
            </div>
            <div class="row g-0 row-content">
              <div class="col-md-5">
                <div class="row">
                  <div class="contact-box">
                    <h4>Contacto</h4>
                    <li href=""> <i class="fa-solid fa-envelope mr-2 mt-1"></i><?= $dato['des_email'] ?></li>
                    <li href=""> <i class="fa-solid fa-phone mr-2 mt-3"></i><?= $dato['des_cel'] ?></li>
                    <li href=""> <i class="fa-solid fa-location-pin mr-2 mt-3"></i><?= $dato['des_direccion'] ?></li>
                  </div>
                </div>
                <div class="row">
                  <div class="contact-box border-right">
                    <h4>Educación</h4>
                    <div class="box-educ-media">
                      <li ><p> <b><?= $dato['des_titulo_medio'] ?> </b> </p></li>
                      <li><p><?= $dato['des_lugar_medio'] ?></p></li>
                      <small><?= $dato['des_anio_medio'] ?></small>
                    </div>
                    <div class="box-educ-media mt-2">
                      <li ><p> <b><?= $dato['des_titulo_superior'] ?></b> </p></li>
                      <li><p><?= $dato['des_lugar_superior'] ?></p></li>
                      <small><?= $dato['des_anio_superior'] ?></small>
                    </div>
                  <hr>
                  <p class="mt-2 ml-2">
                    <b>
                      <?= $dato['ind_estudia'] == 1 ? 'Actualmente Estudiando' : 'Actualmente sin estudiar' ?>
                    </b>
                  </p>
                  <p class="mt-2 ml-2 text-justify pr-4"><?= $dato['des_det_estudio'] != '' ? $dato['des_det_estudio'] : '' ?></p>
                  </div>
                </div>
                <div class="content-section">
                  <h5>Referencias</h5>
                  <hr>
                  <div class="personal-details">
                    <ul class="mr-4">
                      <li><p>Referencia Personal: <b><?= $dato['des_ref_personal'] ?></b></p></li>
                      <li><p>Referencia Laboral: <b><?= $dato['des_ref_laboral'] ?></b></p></li>
                      <li><p>Referido por: <b><?= $dato['des_referidor'] != ''? $dato['des_referidor'] : '' ?></b></p></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-md-7">
                <div class="content-section">
                  <h4>Habilidades</h4>
                  <hr>
                  <p class="text-justify"><?= $dato['des_skills'] ?></p> 
                </div>
                <div class="content-section">
                  <h4>Detalles Personales</h4>
                  <hr>
                  <div class="personal-details">
                    <ul>
                      <li><p>Fecha de Nacimiento: <b><?= $dato['fec_nacimiento'] ?></b></p></li>
                      <li><p>DPI: <b><?= $dato['des_dpi'] ?></b></p></li>
                      <li><p>NIT: <b><?= $dato['des_nit'] ?></b></p></li>
                      <li><p>Estado Civil: <b><?= $dato['ind_estcivil'] == 1 ? 'Soltero' : 'Casado' ?></b></p></li>
                      <li><p>Fecha de la Solicitud: <b><?= $dato['fec_solicitud'] ?></b></p></li>
                      <li><p>Horario Disponible: <b><?= $dato['des_dis_horario'] ?></b></p></li>
                    </ul>
                  </div>
                </div>
                <div class="content-section">
                  <h4>Experiencia Laboral</h4>
                  <hr>
                  <div class="personal-details">
                      <p class="text-justify mr-2">Puesto Anterior: <b><?= $dato['des_puesto_anterior'] ?></b> en la empresa <b><?= $dato['des_empresa_anterior'] ?></b>
                      ubicada en <b><?= $dato['des_dir_empresa'] ?></b> durante <?= $dato['des_tiempo_laborado'] ?>
                        presentando mi renuncia por <?= $dato['des_mrenuncia'] ?>
                      </p>
                      <hr>
                      <p>Contacto de empresa: <b><?= $dato['des_cont_empresa'] ?></b></p>
                  </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    <script src="./js/profile.js"></script>
    <script src="./js/events.js"></script>
  </body>

</html>

