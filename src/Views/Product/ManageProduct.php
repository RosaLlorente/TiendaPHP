<h3>Crear nuevo producto</h3>
<?php
    $errores = $_SESSION['errores'] ?? [];
    unset($_SESSION['old_data'], $_SESSION['errores']);
?>


<form action="<?= BASE_URL ?>ManageProduct" method="POST">
    <label for="categoria_id">Categoria(insertarID)</label>
    <input type="number" name="data[categoria_id]" id="categoria_id">

    <label for="nombre">Nombre</label>
    <input type="text" name="data[nombre]" id="nombre">

    <label for="descripcion">Descripcion</label>
    <input type="text" name="data[descripcion]" id="descripcion">

    <label for="precio">Precio</label>
    <input type="number" name="data[precio]" id="precio">

    <label for="stock">Stock</label>
    <input type="number" name="data[stock]" id="stock">

    <label for="oferta">Oferta</label>
    <input type="text" name="data[oferta]" id="oferta">

    <label for="fecha">Fecha</label>
    <input type="date" name="data[fecha]" id="fecha">

    <label for="imagen">Imagen</label>
    <input type="file" name="data[imagen]" id="imagen">

    <input type="submit" value="Enviar">
    <input type="reset" value="Borrar todo">
</form>

