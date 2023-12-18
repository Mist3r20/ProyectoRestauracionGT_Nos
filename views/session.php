<!DOCTYPE html>
<html lang="es">
<head>
    <title>Footer</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/registro_estil.css" rel="stylesheet" type="text/css" media="screen">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="form-container">
                    <form action="?controller=usuario&action=iniciar" method="POST" class="login-form">
                        <h2>Iniciar Sesión</h2>
                        <input type="email" name="email" placeholder="Correo electrónico" class="form-control" required>
                        <input type="password" name="password" placeholder="Contraseña"class="form-control"required>
                        <button type="submit" class="boton-registro">INICIAR</button>
                    </form>
                    <form action="?controller=usuario&action=registro" method="POST" class="register-form">
                        <h2>Registrarse</h2>
                        <input type="text" name="username" placeholder="Nombre" class="form-control" required>
                        <input type="text" name="apellido" placeholder="Apellido" class="form-control" required>
                        <input type="email" name="email" placeholder="Correo electrónico" class="form-control" required>
                        <input type="password" name="password" placeholder="Contraseña" class="form-control" required>
                        <input type="password" name="passwordRepetir" placeholder="Repetir Contraseña" class="form-control" required>
                        <button type="submit" class="boton-registro">REGISTRARSE</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>