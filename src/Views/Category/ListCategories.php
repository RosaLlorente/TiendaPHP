<hr>
<h3>Lista de Categorías</h3>
<?php if (!empty($categories)): ?>
    <ol style="display: flex; flex-direction: column; align-items: first baseline; gap:1em;">
        <?php foreach ($categories as $category): ?>
            <li>
                <?= htmlspecialchars($category['nombre']) ?> 
                <form method="POST" action="<?= BASE_URL ?>DeleteCategory" style="display: inline;">
                    <input type="hidden" name="id" value="<?= $category['id'] ?>">
                    <button type="submit">Eliminar</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ol>
<?php else: ?>
    <p>No hay categorías disponibles.</p>
<?php endif; ?>