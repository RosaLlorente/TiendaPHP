<h3>Iniciar sesion</h3>
<?php
    $oldData = $_SESSION['old_data'] ?? [];
    $errores = $_SESSION['errores'] ?? [];
    unset($_SESSION['old_data'], $_SESSION['errores']);
?>
<form action="<?=BASE_URL?>login" method="POST">
    <label for="email">Correo</label>
    <input type="email" name="data[email]" id="email" value="<?= htmlspecialchars($oldData['email'] ?? '') ?>">

    <label for="password">Contraseña</label>
    <input type="password" name="data[password]" id="password">

    <input type="submit" value="Iniciar Sesion">
    <input type="reset" value="Borrar todo">
</form>