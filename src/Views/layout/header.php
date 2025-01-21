<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?=BASE_URL?>/public/CSS/Style.css">
    <title>Tienda</title>
</head>
<body>
    <h1>Tienda</h1>
    <nav>
        <ul>
            <li><a href="<?=BASE_URL?>">Inicio</a></li>
            <?php if(!isset($_SESSION['user_id'])): ?>
                <li><a href="<?=BASE_URL?>login">Iniciar Sesion</a></li>
                <li><a href="<?=BASE_URL?>registro">Registrarse</a></li>
            <?php else: ?>
                <li><a href="<?=BASE_URL?>Catalog">VerCatalogo</a></li>
                <li><a href="<?=BASE_URL?>Cart">Carrito</a></li>
                <li><a href="<?=BASE_URL?>logout">Cerrar Sesión</a></li>
                <?php if ($_SESSION['role'] == 'admin'): ?>
                    <li><a href="<?=BASE_URL?>ManageCategory">Gestionar Categoria</a></li>
                    <li><a href="<?=BASE_URL?>ManageProduct">Gestionar Producto</a></li>
                <?php endif; ?>
                <p>Bienvenido, <?= htmlspecialchars($_SESSION['user_name']); ?></p> 
            <?php endif; ?>
        </ul>
    </nav>
