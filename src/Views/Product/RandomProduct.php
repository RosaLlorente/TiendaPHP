<hr>
<h3>Productos Aleatorios</h3>
<?php if (!empty($products)): ?>
    <ol style="display: flex; flex-direction: column; align-items: flex-start; gap:1em;">
        <?php foreach ($products as $product): ?>
            <li>
                <strong>Nombre:</strong> <?= htmlspecialchars($product['nombre']) ?><br>
                <strong>Descripción:</strong> <?= htmlspecialchars($product['descripcion']) ?><br>
                <strong>Precio:</strong> $<?= number_format($product['precio'], 2) ?><br>
                <strong>Stock:</strong> <?= htmlspecialchars($product['stock']) ?><br>
                <strong>Imagen:</strong> <img src="<?= BASE_URL ?>/public/Img/<?= htmlspecialchars($product['imagen']) ?>" alt="<?= htmlspecialchars($product['nombre']) ?>" width="100"><br>
                <strong>Oferta:</strong> <?= $product['oferta'] ? 'Sí' : 'No' ?><br>
                <strong>Fecha:</strong> <?= htmlspecialchars($product['fecha']) ?><br>
            </li>
        <?php endforeach; ?>
    </ol>
<?php else: ?>
    <p>No hay productos aleatorios disponibles.</p>
<?php endif; ?>

