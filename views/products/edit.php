<?php require_once __DIR__ . '/../layout/header.php'; ?>
<?php require_once __DIR__ . '/../layout/nav.php'; ?>

<!-- Título centrado / Centered title -->
<h2 class="mb-4 text-center">Editar Producto</h2>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>


<form action="index.php?controller=product&action=update" method="POST" enctype="multipart/form-data">
    <!-- Campo oculto con el ID del producto /
        Hidden field with product ID -->
    <input type="hidden" name="id" value="<?= $product['id'] ?>">
    <!-- Nombre del producto / Product Name-->
    <div class="mb-3">
        <label for="name" class="form-label">Nombre del Producto</label>
        <input type="text" name="nombre" class="form-control"
            value="<?= htmlspecialchars($product['nombre']) ?>" required>
    </div>

    <!-- Categoría del producto / Product Category -->
    <div class="mb-3">
        <label for="category" class="form-label">Categoría</label>
        <select class="form-select" id="category" name="categoria_id" required>
            <option value="">Seleccione una categoría</option>
        <?php foreach ($categories as $cat): ?>
            <option value="<?= $cat['id'] ?>" <?= $cat['id'] == $product['categoria_id'] ? 'selected' : '' ?>><?= htmlspecialchars($cat['nombre']) ?></option>
        <?php endforeach; ?>
        </select>
    </div>

    <!-- Cantidad / Available Stock -->
    <div class="mb-3">
        <label for="stock" class="form-label">Cantidad</label>
        <input type="number" name="cantidad" id="stock" class="form-control"
            value="<?= ($product['cantidad']) ?>" required>
    </div>

    <!-- Precio -->
    <div class="mb-3">
        <label for="price" class="form-label">Precio</label>
        <input type="number" step="0.01" name="precio" class="form-control"
            value="<?= ($product['precio']) ?>" required>
    </div>

    <!-- Descripción del producto / Product Description -->
    <div class="mb-3">
        <label for="description" class="form-label">Descripción</label>
        <textarea name="descripcion" id="description" class="form-control" rows="3"><?= htmlspecialchars($product['descripcion']) ?></textarea>
    </div>

    <!-- Imagen del producto / Product Image -->
    <div class="mb-3">
        <label for="image" class="form-label">Imagen Producto</label>
        <input type="file" name="image" id="image" class="form-control" accept="image/*">
    </div>

    <!-- Botón para enviar el formulario / Submit button -->
    <button type="submit" class="btn btn-primary">Actualizar Producto</button>
</form>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>