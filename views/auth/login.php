<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4 shadow-lg border-0" style="width: 100%; max-width: 400px;">
        <h2 class="mb-4 text-center">Iniciar Sesión</h2>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <form action="index.php?controller=auth&action=iniciarSesion" method="POST">
            <div class="mb-3">  <!-- Campo de correo / Email field -->
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Ingresa tu correo" required>
            </div>

            <div class="mb-3"><!-- Campo de contraseña / Password field -->
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Ingresa tu contraseña" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Iniciar sesión</button>

            <!-- Botón para volver al home / Return to homepage button -->
            <a href="/dotaciones/public/" class="btn w-100" style="background-color: #262526; color: white;">Volver al inicio</a>
            <!-- Enlace para recuperación de contraseña / Password recovery link -->
            <div class="text-center mt-3">
                <a href="index.php?controller=auth&action=forgotPassword" class="btn btn-link p-0">
                    ¿Olvidaste tu contraseña?
                </a>
            </div>

        </form>
    </div>
</div>
<?php require_once __DIR__ . '/../layout/footer.php'; ?>