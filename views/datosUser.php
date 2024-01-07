<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Datos del Usuario</title>
    <link href="../assets/css/datos_estil.css" rel="stylesheet" type="text/css" media="screen">
    <link href="../assets/css/full_estil.css" rel="stylesheet" type="text/css" media="screen">
</head>
<body>
    <div class="container">
    <div class="profile-container">
            <h2 class="profile-title">Datos Personales</h2>
            <form action="?controller=usuario&action=actualizar" method="POST" class="profile-form">
                <?php foreach($users as $user) { ?>
                <input type="hidden" name="id_usuario" value="<?= $user->getID() ?>">
                <input type="hidden" name="contraseña_usuario" value="<?= $user->getPassword() ?>">
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" value="<?= $user->getNombre() ?>" class="input-field">
                </div>
                <div class="form-group">
                    <label for="apellido">Apellido:</label>
                    <input type="text" id="apellido" name="apellido" value="<?= $user->getApellido() ?>" class="input-field">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?= $user->getEmail() ?>" class="input-field">
                </div>
                <div class="form-group">
                    <label for="direccion">Dirección:</label>
                    <input type="text" id="direccion" name="direccion" value="<?= $user->getDireccion() ?>" class="input-field">
                </div>
                <div class="form-group">
                    <label for="telefono">Teléfono:</label>
                    <input type="number" id="telefono" name="telefono" value="<?= $user->getTelefono() ?>" class="input-field" pattern="\d{9}" title="El teléfono debe tener 9 dígitos">
                </div>
                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" class="input-field">
                </div>
                <button type="submit" class="submit-button">Actualizar Datos</button>
                <?php } ?>
            </form>
        </div>
    </div>
</body>
</html>