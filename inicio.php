
<?php

session_start();

if (!isset($_SESSION['auth'])) {
    header('Location: index.html');
    exit;
}

// $mysqli= new mysqli('localhost', 'ovggt_ovggt_formulario_admin', 'wlan.in3.', 'ovggt_formulario');
$mysqli = new mysqli('localhost', 'root', '', 'bolsaempleo');
mysqli_set_charset($mysqli, "utf8");

if ($mysqli->connect_error) {
    die('Error de conexión: ' . $mysqli->connect_error);
}

$datos = array();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['filtrar'])) {
  if (isset($_POST['nombre'])) {
    $nombre_a_filtrar = trim($_POST['nombre']); // Obtener el nombre para filtrar
    if (!empty($nombre_a_filtrar)) {
      $sql = "SELECT * FROM tbl_form_empleo WHERE des_nombre LIKE '%$nombre_a_filtrar%'";
    } else {
      $sql = "SELECT * FROM tbl_form_empleo";
    }
  } else {
    if (isset($_POST['puesto'])) {
      $nombre_a_filtrar = trim($_POST['puesto']); // Obtener el nombre para filtrar
      if (!empty($nombre_a_filtrar)) {
        $sql = "SELECT * FROM tbl_form_empleo WHERE  des_puesto_aplicado LIKE '%$nombre_a_filtrar%'";
      } else {
        $sql = "SELECT * FROM tbl_form_empleo";
      }
    }
    else{
      $sql = "SELECT * FROM tbl_form_empleo";
    }
  }


  $resultado = $mysqli->query($sql);

  if ($resultado) {
    while ($fila = $resultado->fetch_assoc()) {
      $datos[] = $fila;
    }
  } else {
    echo "Error en la consulta: " . $mysqli->error;
  }
} else {
  $sql = "SELECT * FROM tbl_form_empleo";
  $resultado = $mysqli->query($sql);

  if ($resultado) {
    while ($fila = $resultado->fetch_assoc()) {
      $datos[] = $fila;
    }
  } else {
    echo "Error en la consulta: " . $mysqli->error;
  }
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
    <link rel="stylesheet" href="./css/navbar.css">
    <link rel="stylesheet" href="./css/global.css">
    <style>

    </style>
    <header class="header">
    </header>
    <span class="span-line"></span>
</head>

<body>

    <div class="container mt-4">
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
            <input type="date" name="date1" id="date1">
            <input type="date" name="date2" id="date2">
            <button type="submit" name="filtrar" id="btn_filter" class="btn btn-blue mt-2">Filtrar</button>
          </form>
        </div>
      </div>
    </div>


    <div class="container mx-auto" style="margin-top: 10vw;">
        <div class="row mx-auto">
            <?php foreach ($datos as $dato) : ?>
                <div class="col-md-12 mb-3 mx-auto">
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

<script>

document.getElementById("txt_filter").style.display = "none";
function filterChange(e){
  const _option = e.target.value;
  if(_option == "0"){
    document.getElementById("txt_filter").style.display = "none";
    ["date1", "date2"].forEach((item)=> document.getElementById(item).display = 'block');
    // document.getElementById("txt_filter").style.display = "none";
    return;
  }

  ["date1", "date2"].forEach((item)=> document.getElementById(item).display = 'none');
  if(_option == "3"){
    document.getElementById("txt_filter").style.display = "none";
    document.getElementById("btn_filter").innerText = "Ver Todo"
    return;
  }
  else{
    document.getElementById("txt_filter").style.display = "block";
    document.getElementById("btn_filter").innerText = "Filtrar"
  }
  document.getElementById("txt_filter").placeholder = _option == "1" ?  'Ingrese el nombre' : 'Ingrese el Puesto';
  document.getElementById("txt_filter").name = _option == "1" ?  'nombre' : 'puesto';
}

</script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="./js/events.js"></script>
</body>

</html>

