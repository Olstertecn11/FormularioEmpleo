<?php

session_start();

if (!isset($_SESSION['auth'])) {
    header('Location: index.html');
    exit;
}



?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="./css/panel.css">
<link rel="stylesheet" href="./css/navbar.css">
<link rel="stylesheet" href="./css/global.css">
<header class="header">
</header>


<div class="container mt-4">
    <div class="row">
        <div class="col-md-5 mx-auto">

            <div class="card p-4">
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

                    <input type="submit" value="Enviar" class="btn btn-blue btn-block">
                </form>


            </div>
        </div>
        <div class="col-md-6 mx-auto">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Correo</th>
                        <th>Usuario</th>
                        <th>Acciones</th>
                        <!-- <th>Contraseña</th> No se recomienda mostrar la contraseña en una tabla pública -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Establecer la conexión a la base de datos (debes tener tus credenciales aquí)
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "bolsaempleo";

                    // Crear conexión
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Verificar la conexión
                    if ($conn->connect_error) {
                        die("Conexión fallida: " . $conn->connect_error);
                    }

                    // Consulta SQL para obtener los datos de los usuarios
                    $sql = "SELECT usr_id, usr_nombre, usr_apellido, usr_correo, usr_usuario FROM tbl_usuario";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Mostrar cada fila de datos
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["usr_id"] . "</td>";
                            echo "<td>" . $row["usr_nombre"] . "</td>";
                            echo "<td>" . $row["usr_apellido"] . "</td>";
                            echo "<td>" . $row["usr_correo"] . "</td>";
                            echo "<td>" . $row["usr_usuario"] . "</td>";
                            echo "<td>" . "<a class='btn btn-danger text-white'>Eliminar</a>" . "</td>";
                            // No se recomienda mostrar la contraseña en una tabla pública
                            // echo "<td>" . $row["usr_contra"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No se encontraron resultados</td></tr>";
                    }
                    // Cerrar conexión
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="./js/events.js"></script>
