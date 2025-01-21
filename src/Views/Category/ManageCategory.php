<h3>Crear nueva categoria</h3>

<?php
    $errores = $_SESSION['errores'] ?? [];
    unset($_SESSION['old_data'], $_SESSION['errores']);
?>

<form action="<?= BASE_URL ?>ManageCategory" method="POST">
    <label for="nombre">Nombre</label>
    <input type="text" name="data[nombre]" id="nombre">
    <input type="submit" value="Enviar">
    <input type="reset" value="Borrar todo">
</form>

