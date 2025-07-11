<?php require_once __DIR__ . '/../layout/header.php'; ?> <!-- Incluye el encabezado general (barra de navegación, estilos, etc.)-->
<?php require_once __DIR__ . '/../layout/nav.php'; ?>

<?php if (isset($_GET['success'])): ?><!-- Si se ha registrado un nuevo producto, se muestra un mensaje de éxito -->
    <div class="alert alert-success">Producto registrado correctamente.</div>
<?php elseif (isset($_GET['updated'])): ?>
    <div class="alert alert-success">Producto actualizado.</div>
<?php elseif (isset($_GET['deleted'])): ?>
    <div class="alert alert-success">producto eliminado.</div>
<?php endif; ?>

<div class="container my-5">
    <h2>Listado de Productos</h2>
    <?php if (isset($_SESSION['user_rol']) && $_SESSION['user_rol'] === 'administrador'): ?>
        <a href="index.php?controller=product&action=create" class="link-light link-opacity-60-hover btn btn-success mb-2 text-white" style="box-shadow: 1px 2px 4px rgba(0, 0, 0, 0.36)">Nuevo Producto</a>
    <?php endif; ?>



    <!-- Botón para ir al historial de ventas / Sales history button -->
    <a href="index.php?controller=product&action=salesHistory" class="btn mb-3 ms-2" style="background-color: #262526; color: white;">
        <i class="bi bi-receipt"></i> Historial de Ventas
    </a>
    
    <!-- Tabla con los productos registrados / Table with registered products -->
    <table class="table table-hover table-striped align-middle text-center">
        <thead class="table-dark text-center">
            <tr>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Descripción</th>
                <th>Imagen Producto</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                    <tr class="text-center">
                        <td><?= htmlspecialchars($product['nombre']) ?></td>
                        <td><?= htmlspecialchars($product['categoria_id']) ?></td>
                        <td><?= htmlspecialchars($product['cantidad']) ?></td>
                        <td>$<?= number_format($product['precio']) ?></td>
                        <td><?= htmlspecialchars($product['descripcion']) ?></td>
                        <td>
                            <?php if (!empty($product['image'])): ?>
                                <img src="/dotaciones/<?= htmlspecialchars($product['image']) ?>" alt="Imagen" style="width: 100px;">
                            <?php else: ?>
                                Sin imagen
                            <?php endif; ?>
                        </td> 
                        <?php if (isset($_SESSION['user_rol']) && $_SESSION['user_rol'] === 'administrador'): ?>
                            <td>
                                <a href="index.php?controller=product&action=edit&id=<?= $product['id'] ?>" class="btn btn-warning btn-sm text-white">Editar</a>
                                <a href="index.php?controller=product&action=delete&id=<?= $product['id'] ?>" class="btn btn-danger btn-sm text-white"
                                    onclick="return confirm('¿Estás seguro de eliminar este producto?');">Eliminar</a>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="<?= (isset($_SESSION['user_rol']) && $_SESSION['user_rol'] === 'administrador') ? '7' : '6' ?>" class="text-center">
                        No hay productos registrados.
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</div>

<div style="margin-bottom: 5rem;"></div>
<?php require_once __DIR__ . '/../layout/footer.php'; ?>