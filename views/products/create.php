<?php require_once __DIR__ . '/../layout/header.php'; // Incluye el encabezado común del sitio (navegación, estilos, apertura de <body>, etc.)?>
<?php require_once __DIR__ . '/../layout/nav.php'; ?>

<!-- Título de la página / Page title -->
<h2>Crear Producto</h2>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<!-- Formulario para crear un nuevo producto /
    Form to create a new product -->
<div class="container my-5">
    <form action="index.php?controller=product&action=store" method="POST" enctype="multipart/form-data">
        <!-- Nombre del producto / Product name -->
        <div class="mb-3">
            <label for="name" class="form-label">Nombre del Producto</label>
            <input type="text" class="form-control" id="name" name="nombre" required>
        </div>

        <!-- Categoría del producto / Product category -->
         <!-- Categoría -->
        <div class="mb-3">
            <label for="category" class="form-label">Categoría</label>
            <select class="form-select" id="category" name="categoria_id" required>
                <option value="">Seleccione una categoría</option>
            <?php foreach ($categories as $cat): ?>
                <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['nombre']) ?></option>
            <?php endforeach; ?>
            </select>
        </div>

         <!-- Stock disponible del producto / Available stock -->
        <div class="mb-3">
            <label for="stock" class="form-label">Cantidad</label>
            <input type="number" class="form-control" id="stock" name="cantidad" required>
        </div>

        <!-- Precio del producto / Product price -->
        <div class="mb-3">
            <label for="price" class="form-label">Precio</label>
            <input type="number" class="form-control" id="price" name="precio" step="0.01" required>
        </div>

        <!-- Descripción del producto / Product description -->
        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea class="form-control" id="description" name="descripcion" rows="3"></textarea>
        </div>

        <!-- Imagen del producto / Product image -->
        <div class="mb-3">
            <label for="image" class="form-label">Imagen Producto</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
        </div>

        <!-- Botones de acción / Action buttons -->
        <button type="submit" class="btn btn-success">Guardar Producto</button>
        <a href="index.php?controller=product&action=index" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
<?php
// Incluye el pie de página común del sitio (cierre de contenedor, scripts, cierre de body y html)
// Include the shared site footer (container closing, scripts, body and html close)
require_once __DIR__ . '/../layout/footer.php';
?>