<?php

session_start();

if (!isset($_SESSION['auth'])) {
  header('Location: index.html');
  exit;
}

?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<div class="container mt-4">
<div class="row">
<div class="col-md-5 mx-auto">

<div class="card p-4">
    <h2 class="card-text text-center">Formulario de Inserción de Usuario</h2>
    <form action="./php/user/userController.php" method="POST" class="form-group">
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" required class="form-control"><br>

        <label for="apellido">Apellido:</label><br>
        <input type="text" id="apellido" name="apellido" required class="form-control"><br>

        <label for="correo">Correo:</label><br>
        <input type="email" id="correo" name="correo" required class="form-control"><br>

        <label for="usuario">Usuario:</label><br>
        <input type="text" id="usuario" name="usuario" required class="form-control"><br>

        <label for="contra">Contraseña:</label><br>
        <input type="password" id="contra" name="contra" required class="form-control"><br>

        <input type="submit" value="Enviar" class="btn btn-success btn-block">
    </form>


</div>
</div>
<div class="col-md-4">
<h2 class="text-center"> fkdsjaflasklfjk</h2>
</div>
</div>
</div>



