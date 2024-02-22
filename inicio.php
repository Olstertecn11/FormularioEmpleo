

<?php

session_start();

if (!isset($_SESSION['auth'])) {
    header('Location: index.html');
    exit;
}

function conectarBD() {
    $mysqli = new mysqli('localhost', 'root', '', 'bolsaempleo');
    if ($mysqli->connect_error) {
        die('Error de conexión: ' . $mysqli->connect_error);
    }
    mysqli_set_charset($mysqli, "utf8");
    return $mysqli;
}

function obtenerFormulariosEmpleo($mysqli, $sql) {
    $datos = array();
    $resultado = $mysqli->query($sql);

    if ($resultado) {
        while ($fila = $resultado->fetch_assoc()) {
            $datos[] = $fila;
        }
    } else {
        echo "Error en la consulta: " . $mysqli->error;
    }

    return $datos;
}

$mysqli = conectarBD();
$datos = array();
$sql = "SELECT * FROM tbl_form_empleo";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['filtrar'])) {
    if(isset($_POST['option'])) {
        $option = $_POST['option'];
        if ($option === "0") {
          if (isset($_POST['date1']) && isset($_POST['date2'])) {
            // $date1 = $_POST['date1']." 00:00:00";
            // $date2 = $_POST['date2']." 00:00:00";
            // $date1 = DateTime::createFromFormat('m/d/Y h:i A', $date1)->format('Y-m-d H:i:s');
            // $date1 = strftime('%Y-%m-%d %H:%M:%S', strtotime(mysqli_real_escape_string($mysqli,$_POST['date1'])));
            // $date2 = strftime('%Y-%m-%d %H:%M:%S', strtotime(mysqli_real_escape_string($mysqli,$_POST['date2'])));
            $date1 = strftime('%Y-%m-%d', strtotime(mysqli_real_escape_string($mysqli,$_POST['date1'])));
            $date2 = strftime('%Y-%m-%d', strtotime(mysqli_real_escape_string($mysqli,$_POST['date2'])));
            // $date2 = DateTime::createFromFormat('m/d/Y h:i A', $date2)->format('Y-m-d H:i:s');
            // $sql = "SELECT * FROM tbl_form_empleo WHERE fec_solicitud BETWEEN '$date1' AND '$date2'";
            $sql = "SELECT * FROM tbl_form_empleo WHERE fec_solicitud >= '$date1' AND fec_solicitud <= '$date2'";

          }
          else {
            $sql = "SELECT * FROM tbl_form_empleo WHERE cod_id = 1";
          }
        } elseif ($option === "1") {
          if (isset($_POST['nombre'])) {
            $nombre_a_filtrar = trim($_POST['nombre']);
            if (!empty($nombre_a_filtrar)) {
              $sql = "SELECT * FROM tbl_form_empleo WHERE des_nombre LIKE '%$nombre_a_filtrar%'";
            }
          }
        } elseif ($option === "2") {
          if (isset($_POST['puesto'])) {
            $nombre_a_filtrar = trim($_POST['puesto']);
            if (!empty($nombre_a_filtrar)) {
              $sql = "SELECT * FROM tbl_form_empleo WHERE des_puesto_aplicado LIKE '%$nombre_a_filtrar%'";
            }
          }
        }
    }
}

$datos = obtenerFormulariosEmpleo($mysqli, $sql);
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
    <link rel="stylesheet" href="./css/navbar.css">
    <link rel="stylesheet" href="./css/global.css">
    <style>

    </style>
    <header class="header">
    </header>
    <span class="span-line"></span>
</head>

<body>

    <div class="container mt-4 check-container">
      <input type="checkbox" class="form-check-input" id="check" >
      <label for="check" class="card-text">Mostrar Filtros</label>
    </div>

    <div class="container  filter_container">
      <div class="row">
        <div class="col-md-3">
          <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class=" p-4 form-group">
              <select class="form-control" id="exampleFormControlSelect1" onchange="filterChange(event)">
                <option value="0">Buscar por Fechas</option>
                <option value="1">Buscar por Nombre</option>
                <option value="2">Buscar por Puesto</option>
                <option value="3">Ver Todos</option>
              </select>
          </form>
        </div>
        <div class="col-md-3">
          <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class=" p-4 form-group">
            <input type="text" name="nombre" placeholder="Introduce el nombre" id="txt_filter" class="form-control">
            <input type="date" name="date1" id="date1" class="form-control mt-2">
            <input type="date" name="date2" id="date2" class="form-control mt-2">
            <input type="text" name="option" id="_option" value="0"  style="display: none;">
            <button type="submit" name="filtrar" id="btn_filter" class="btn btn-blue mt-2">Filtrar</button>
          </form>
        </div>
      </div>
    </div>


    <div class="container mx-auto" style="margin-top: 2vw;">
        <div class="row mx-auto">
            <?php foreach ($datos as $dato) : ?>
                <div class="col-md-12 mb-3 mx-auto col-content">
                    <div class="card mb-3 mx-auto card-container" style="max-width: 800px;">
                        <div class="row g-0">
                            <div class="col-md-5">
                                <img class="img-profile-card rounded-start" src="<?= $dato['bl_foto'] ?>"
                                    class="card-img-top thumbnail" alt="<?= $dato['des_nombre'] ?>">
                            </div>
                            <div class="col-md-7">
                                <div class="card-body">
                                    <h4 class="card-title"><?= $dato['des_nombre'] ?></h4>
                                    <p class="card-text text-justify text-muted font-italic"><?= $dato['fec_solicitud'] ?></p>
                                    <p class="card-text text-justify skills-box"><?= $dato['des_skills'] ?></p>
                                    <p class="card-text"><small class="text-muted"><?= $dato['des_puesto_aplicado'] ?></small></p>
                                    <div class="buttons-box">
                                        <a href="./profile.php?cod_id=<?= $dato['cod_id'] ?>" class="btn btn-blue ">
                                            Visitar Perfil
                                        </a>
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
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    <script src="./js/inicio.js"></script>
    <script src="./js/bitacora.js"></script>
    <script src="./js/events.js"></script>
</body>

</html>

