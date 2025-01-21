<hr>
<h3>Catalogo</h3>
<?php if (!empty($products)): ?>
    <ol style="display: flex; flex-direction: column; align-items: first baseline; gap:1em;">
        <?php foreach ($products as $product): ?>
            <li>
                <strong>Nombre:</strong> <?= htmlspecialchars($product['nombre']) ?><br>
                <strong>Descripción:</strong> <?= htmlspecialchars($product['descripcion']) ?><br>
                <strong>Precio:</strong> $<?= number_format($product['precio'], 2) ?><br>
                <strong>Stock:</strong> <?= htmlspecialchars($product['stock']) ?><br>
                <strong>Imagen:</strong> <img src="<?= BASE_URL ?>/public/Img/<?= htmlspecialchars($product['imagen']) ?>" alt="<?= htmlspecialchars($product['nombre']) ?>" width="100"><br>
                <strong>Oferta:</strong> <?= $product['oferta'] ? 'Sí' : 'No' ?><br>
                <strong>Fecha:</strong> <?= htmlspecialchars($product['fecha']) ?><br>
                <?php if ($product["stock"] != 0): ?>
                    <div>
                        <a href="<?= BASE_URL ?>Cart">Añadir al carrito</a>
                    </div>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ol>
<?php else: ?>
    <p>No hay productos disponibles.</p>
<?php endif; ?>