<h3>Registro</h3>

<?php
    $oldData = $_SESSION['old_data'] ?? [];
    $errores = $_SESSION['errores'] ?? [];
    unset($_SESSION['old_data'], $_SESSION['errores']);
?>

<form action="<?= BASE_URL ?>registro" method="POST">
    <label for="nombre">Nombre</label>
    <input type="text" name="data[nombre]" id="nombre" value="<?= htmlspecialchars($oldData['nombre'] ?? '') ?>">

    <label for="apellidos">Apellido</label>
    <input type="text" name="data[apellidos]" id="apellidos" value="<?= htmlspecialchars($oldData['apellidos'] ?? '') ?>">

    <label for="email">Correo</label>
    <input type="email" name="data[email]" id="email" value="<?= htmlspecialchars($oldData['email'] ?? '') ?>">

    <label for="password">Contraseña</label>
    <input type="password" name="data[password]" id="password">

    <input type="submit" value="Registrarse">
    <input type="reset" value="Borrar todo">
</form>
