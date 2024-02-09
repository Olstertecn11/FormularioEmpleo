<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperacion</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <div class="container" style="margin-top: 8vw">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <div class="card p-4">
                    <form action="./php/pass/passController.php" method="POST" class="form-group">
                        <h4 class="text-center">Recuperacion de Contraseña</h4>
                        <p class="text-center mt-4 mb-4">Debe introducir el correo con el cual creo su cuenta en la
                            aplicacion</p>
                        <div class="form-group">
                            <label for="">Correo</label>
                            <input type="email" placeholder="oscarmoral@gmail.com" name="correo" class="form-control">
                        </div>
                        <input type="submit" value="Recuperar Contraseña" class="btn btn-warning">
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
