<hr>
<h3>Lista de Productos</h3>
<?php if (!empty($products)): ?>
    <ol style="display: flex; flex-direction: column; align-items: first baseline; gap:1em;">
        <?php foreach ($products as $product): ?>
            <li>
                <?= htmlspecialchars($product['nombre']) ?> 
                <form method="POST" action="<?= BASE_URL ?>DeleteProduct" style="display: inline;">
                    <input type="hidden" name="id" value="<?= $product['id'] ?>">
                    <button type="submit">Eliminar</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ol>
<?php else: ?>
    <p>No hay productos disponibles.</p>
<?php endif; ?>