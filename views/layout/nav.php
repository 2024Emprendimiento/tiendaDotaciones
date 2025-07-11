<nav class="navbar navbar-expand-lg navbar-dark bg-dark" class="bg-success p-2" style="--bs-bg-opacity: .5;">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php?controller=dashboard&action=index#">
            <img src="../public/img/logoD.jpg" alt="logo" width="200" height="90" class="text-center">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuNavbar">
            <span class="navbar-toggler-icon"></span>
            <img src="../public/img/favicon-32x32.png" alt="Logo" class="img-fluid" style="padding: 5px; margin-top: 1px; max-width: 95px">
        </button>

        <div class="collapse navbar-collapse" id="menuNavbar">
            <?php if (isset($_SESSION['user_id'])): ?>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php if (isset($_SESSION['user_rol']) && $_SESSION['user_rol'] === 'administrador'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?controller=user&action=index">Usuarios</a>
                        </li>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['user_rol']) && in_array($_SESSION['user_rol'], ['administrador', 'cliente'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?controller=product&action=index">Productos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?controller=category&action=index">Categoría</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?controller=sale&action=index">Pedidos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?controller=cart&action=index">Carrito</a>
                        </li>
                    <?php endif; ?>
                </ul>
            <?php endif; ?>

            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <?php
                        $roleName = 'Cliente';
                        if (isset($_SESSION['user_rol'])) {
                            $roleName = ($_SESSION['user_rol'] === 'administrador') ? 'Administrador' : 'Vendedor';
                        }
                    ?>
                    <li class="nav-item">
                        <span class="navbar-text me-2 text-white">
                            Bienvenido <?= $roleName ?>, <?= htmlspecialchars($_SESSION['user_nombre']) ?>
                        </span>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light btn-sm" href="index.php?controller=auth&action=logout">
                            Cerrar sesión
                        </a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="btn btn-outline-light btn-sm" href="index.php?controller=auth&action=showLogin">Iniciar sesión</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
