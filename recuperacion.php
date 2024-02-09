<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperación de contraseña</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/recuperacion.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <h2 class="mt-5 text-center title">Recuperación de contraseña</h2>
                <form method="put" action="./php/pass/passController.php" class="card p-4">
                    <div class="form-group">
                        <label for="token">Token:</label>
                        <input type="text" class="form-control" id="token" name="token" placeholder="j9a9e0632d"
                            value="<?php echo isset($_GET['tk']) ? htmlspecialchars($_GET['tk']) : ''; ?>" >
                    </div>
                    <div class="form-group">
                        <label for="token">Correo:</label>
                        <input type="email" class="form-control" id="correo" name="correo" placeholder="olster@gmail.com"
                            value="<?php echo isset($_GET['cr']) ? htmlspecialchars($_GET['cr']) : ''; ?>" >
                    </div>
                    <div class="form-group">
                        <label for="contra">Contraseña:</label>
                        <input type="password" class="form-control" id="contraseña" name="contra" placeholder="********"
                             >
                    </div>
                    <div class="form-group">
                        <label for="contra">Confirmacion de Contraseña:</label>
                        <input type="password" class="form-control" id="contraseña" name="contraseña" placeholder="*********"
                            >
                    </div>
                    <button type="submit" class="btn btn-blue">Enviar</button>
                </form>
            </div>
        </div>

    </div>

    <!-- Scripts de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
