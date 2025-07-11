<?php require_once __DIR__ . '/../layout/header.php'; ?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <style>
    .flip-card {
      background-color: transparent;
      width: 300px;
      height: 200px;
      perspective: 1000px;
      margin: 20px;
    }

    .flip-card-inner {
      position: relative;
      width: 100%;
      height: 100%;
      text-align: center;
      transition: transform 0.8s;
      transform-style: preserve-3d;
    }

    .flip-card:hover .flip-card-inner {
      transform: rotateY(180deg);
    }

    .flip-card-front img {
      width: 100%;
      height: 200px;
      object-fit: cover;
    }

    .flip-card-front,
    .flip-card-back {
      position: absolute;
      width: 100%;
      height: 100%;
      backface-visibility: hidden;
      border: 1px solid #f1f1f1;
      border-radius: 10px;
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .flip-card-front {
      background-color: #fff;
      color: black;
    }

    .flip-card-back {
      background-color: rgb(143, 175, 209);
      color: white;
      transform: rotateY(180deg);
    }
  </style>
</head>

<body>
  <nav id="mainNav" class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="img/logoD.jpg" alt="logo" width="200" height="90" class="text-center">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu"
        aria-controls="navMenu" aria-expanded="false" aria-label="Menú">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navMenu">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="#quienes">Quiénes somos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#catalogo">Catálogo</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#contacto">Contáctenos</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-outline-light btn-sm" href="index.php?controller=auth&action=showLogin">Iniciar sesión</a>
          </li>
          <a href="index.php?controller=cart&action=checkout" class="position-relative text-dark text-decoration-none">
            <i class="bi bi-cart4 fs-4"></i>
            <?php if (!empty($_SESSION['cart'])): ?>
              <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                <?= array_sum(array_column($_SESSION['cart'], 'quantity')) ?>
              </span>
            <?php endif; ?>
          </a>
        </ul>
      </div>
    </div>
  </nav>
  <?php if (isset($_SESSION['user_id'])): ?>
    <li class="nav-item">
      <a class="nav-link" href="index.php?controller=sale&action=index">Mis Pedidos</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="index.php?controller=cart&action=index">Carrito</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="index.php?controller=auth&action=logout">Cerrar sesión</a>
    </li>
  <?php endif; ?>


  <!-- Haz clic para chatear por WhatsApp -->
  <a href="https://api.whatsapp.com/send?phone=1234567890&text=Hola,%20quisiera%20más%20info" target="_blank" class="whatsapp-float" aria-label="Contactar por WhatsApp">
    <i class="bi bi-whatsapp"></i>
  </a>

  <!-- Incluye Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    .whatsapp-float {
      position: fixed;
      bottom: 25px;
      right: 25px;
      background-color: #25D366;
      color: white;
      width: 60px;
      height: 60px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
      font-size: 1.5rem;
      z-index: 9999;
      transition: transform 0.3s, box-shadow 0.3s;
    }

    .whatsapp-float:hover {
      transform: scale(1.1);
      box-shadow: 0 6px 16px rgba(0, 0, 0, 0.3);
    }
  </style>

  <!-- Página principal con imagen de fondo y texto encima -->
  <!-- Banner-->
  <div class="hero-home text-center d-flex flex-column justify-content-center align-items-center"
    style="background: url('img/Productdotaciones.png') center/cover no-repeat;
            height: 400px; color: #fff; text-shadow: 1px 1px 4px rgba(0,0,0,0.7);">
    <h1>DotacionesJR</h1>
    <p>Dotaciones y suministros para empresas de calidad</p>
    <a href="index.php?controller=product&action=index" class="btn btn-outline-light mt-3">Explorar Productos</a>
  </div>
  <section class="py-5  bg-secondary text-white text-center shape-divider shape-top shape-bottom">
    <div class="about-section py-5">
      <div class="container d-flex flex-column flex-md-row align-items-center">
        <div class="about-text mb-4 mb-md-0 pe-md-5">
          <h3>¿Quiénes somos?</h3>
          <p>Somos una empresa familiar, ofrecemos una amplia variedad de suministros y dotaciones para todo tipo de empresas. Nuestros productos garantizan calidad y satisfacción para tus empleados</p>
          <a href="index.php?action=products" class="link-secondary">Ver Productos</a>
        </div>
        <div class="about-image">
          <img src="img/somos.jpg" class="img-fluid rounded shadow" alt="Quiénes somos">
        </div>
      </div>
    </div>

    <h2>CATALOGO DE PRODUCTOS</h2>
    <div class="container d-flex justify-content-center flex-wrap">
      <div class="flip-card">
        <div class="flip-card-inner">
          <div class="flip-card-front">
            <img src="img/botas.jpg" alt="botas">
            <h5>Botas de cuero</h5>
          </div>
          <div class="flip-card-back">
            <p>Calzado de alta protección</p>
          </div>
        </div>
        <a href="index.php?controller=cart&action=add&id=<?= $product['id'] ?>" class="btn btn-primary">Agregar al carrito</a>
      </div>

      <div class="flip-card">
        <div class="flip-card-inner">
          <div class="flip-card-front">
            <img src="img/Guantes.jpg" alt="guantes">
            <h5>Guantes en carnaza</h5>
          </div>
          <div class="flip-card-back">
            <p>Guantes para trabajar con calor extremo.</p>
          </div>
        </div>
        <a href="index.php?controller=cart&action=add&id=<?= $product['id'] ?>" class="btn btn-primary">Agregar al carrito</a>
      </div>

      <div class="flip-card">
        <div class="flip-card-inner">
          <div class="flip-card-front">
            <img src="img/Chaqueta.jpg" alt="chaqueta">
            <h5>Chaqueta</h5>
          </div>
          <div class="flip-card-back">
            <p>Chaqueta en material resistente y reflectivo.</p>
          </div>
        </div>
        <a href="index.php?controller=cart&action=add&id=<?= $product['id'] ?>" class="btn btn-primary">Agregar al carrito</a>
      </div>

      <div class="flip-card">
        <div class="flip-card-inner">
          <div class="flip-card-front">
            <img src="img/chaleco.jpg" alt="chaleco">
            <h5>Chaleco para motoristas</h5>
          </div>
          <div class="flip-card-back">
            <p>Chaleco reflectivo para motoristas.</p>
          </div>
        </div>
        <a href="index.php?controller=cart&action=add&id=<?= $product['id'] ?>" class="btn btn-primary">Agregar al carrito</a>
      </div>

      <div class="flip-card">
        <div class="flip-card-inner">
          <div class="flip-card-front">
            <img src="img/Overoles.jpg" alt="overol">
            <h5>Overol en Jean</h5>
          </div>
          <div class="flip-card-back">
            <p>Overol en jean, adecuado para la industria.</p>
          </div>
        </div>
        <a href="index.php?controller=cart&action=add&id=<?= $product['id'] ?>" class="btn btn-primary">Agregar al carrito</a>
      </div>

      <div class="flip-card">
        <div class="flip-card-inner">
          <div class="flip-card-front">
            <img src="img/polo.jpg" alt="polo">
            <h5>Camisa Polo</h5>
          </div>
          <div class="flip-card-back">
            <p class="card-text">Camisa tipo polo para publicidad.</p>
          </div>
        </div>
        <a href="index.php?controller=cart&action=add&id=<?= $product['id'] ?>" class="btn btn-primary">Agregar al carrito</a>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>
<footer id="footer" class="bg-dark text-white text-center py-3 mt-30rem">
  <div class="container">
    <div class="row">
      <!-- Bloque 1: Información de contacto -->
      <div class="col-12 col-md-6 mb-4">
        <h5 class="mb-3">Información</h5>
        <div class="text-center mb-3">
          <img src="img/android-chrome-192x192.png" class="img-fluid rounded" alt="Logo empresa" style="max-width: 100px;">
        </div>
        <ul class="list-unstyled">
          <li><i class="bi bi-telephone"></i> Teléfono: 12 123 1234</li>
          <li><i class="bi bi-geo-alt"></i> Dirección: Av 24 con Cra 74</li>
        </ul>
      </div>

      <!-- Bloque 2: Formulario de contacto -->
      <div class="col-12 col-md-6">
        <h5 class="mb-3">Contáctanos</h5>
        <form>
          <div class="mb-3">
            <label for="inputName" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="inputName" placeholder="Tu nombre">
          </div>
          <div class="mb-3">
            <label for="inputEmail" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control" id="inputEmail" placeholder="nombre@ejemplo.com">
          </div>
          <div class="mb-3">
            <label for="inputInterest" class="form-label">Interesado en</label>
            <select class="form-select" id="inputInterest">
              <option>Calzado industrial</option>
              <option>Ropa de trabajo</option>
              <option>Otros accesorios</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="inputMessage" class="form-label">Escríbenos</label>
            <textarea class="form-control" id="inputMessage" rows="3" placeholder="Tu mensaje"></textarea>
          </div>
          <button type="submit" class="btn btn-success w-100">Enviar</button>
        </form>
      </div>
    </div>
  </div>
</footer>





<!-- Contacto -->

</html>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>