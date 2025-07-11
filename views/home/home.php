<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../layout/header.php';
require_once __DIR__ . '/../layout/nav.php';
$rol = $_SESSION['rol'] ?? 'cliente';
?>

<p class="text-center">Selecciona una sección para continuar:</p>

<!-- Sección principal con imagen de fondo y texto encima -->
<section class="hero-section d-flex align-items-center justify-content-center text-dark" style="
    background-image: url('/dotaciones/public/img/dotaciones.jpg');
    background-size: cover;
    background-position: center;
    height: 100vh;
    position: relative;
    padding: 4rem 4rem;
    margin: 0;
    ">

    <!-- Capa clara para mejorar la legibilidad del texto -->
    <div style="
        background-color: rgba(255, 255, 255, 0.83);
        padding: 3rem;
        border-radius: 1rem;
        text-align: center;
        max-width: 800px;
    ">

        <div class="container mt-4" style="max-width: 360px;">
            <h3 class="mb-4 text-center">🙂</h3>
            <div class="jumbotron">
                <h1 class="display-3">¡Bienvenidos!</h1>
                <p class="lead">Sistema de Gestión DotacionesJR</p>
                <hr class="my-2">
            </div>
        </div>

    </div>
</section>

<!-- Secciones funcionales -->
<div class="container mt-5">
    <div class="row justify-content-center">

        <!-- Productos -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 h-100 text-center">
                <div class="card-body">
                    <i class="bi bi-cup-hot-fill display-4 text-success mb-3"></i>
                    <h5 class="card-title">Productos</h5>
                    <p class="card-text">Productos disponibles.</p>
                    <a class="btn btn-lg text-white mt-4" style="background-color: rgba(231, 137, 14, 0.94); box-shadow: 0 8px 16px rgba(0, 0, 0, 0.4)" href="index.php?controller=product&action=index">Ir a Productos</a>
                </div>
            </div>
        </div>

        <!-- Usuarios (solo para administrador) -->
        <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'administrador'): ?>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0 h-100 text-center">
                    <div class="card-body">
                        <i class="bi bi-person-lines-fill display-4 text-dark mb-3"></i>
                        <h5 class="card-title">Usuarios</h5>
                        <p class="card-text">Administración de usuarios del sistema.</p>
                        <a class="btn btn-lg text-white mt-4" style="background-color: rgba(231, 137, 14, 0.94); box-shadow: 0 8px 16px rgba(0, 0, 0, 0.4)" href="index.php?controller=user&action=index">Ver Usuarios</a>
                    </div>
                </div>
            </div>

            <!-- Pedidos -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0 h-100 text-center">
                    <div class="card-body">
                        <i class="bi bi-box-seam display-4 text-primary mb-3"></i>
                        <h5 class="card-title">Pedidos</h5>
                        <p class="card-text">Administración de pedidos del sistema.</p>
                        <a class="btn btn-lg text-white mt-4" style="background-color: rgba(231, 137, 14, 0.94); box-shadow: 0 8px 16px rgba(0, 0, 0, 0.4)" href="index.php?controller=sale&action=index">Ver Pedidos</a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
