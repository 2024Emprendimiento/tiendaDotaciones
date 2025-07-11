<?php

require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../models/Category.php'; // Requiere el modelo categoria para interactuar con la base de datos.

class ProductController
{
    private $db;
    private $productModel;
    private $saleModel;

    public function __construct($conexion)
    {   
        $this->db = $conexion;
        $this->productModel = new Product();

    }

        // Mostrar listado de productos (con stock actualizado por ventas)
        // Display list of products (stock adjusted based on sales)
    public function index()
    {
        session_start();

        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?controller=auth&action=iniciarSesion");
            exit;
        }
        $products = $this->productModel->getAll();
        require_once __DIR__ . '/../views/products/index.php';
    }
     // Historial de ventas
    // Sales history
    public function salesHistory()
    {
        $sales = $this->saleModel->getAllSalesWithDetails();
        require_once __DIR__ . '/../views/products/sales.php';
    }

    public function create()
    {
        session_start();

        if (!isset($_SESSION['user_id'])) {
        header("Location: index.php?controller=auth&action=iniciarSesion");
        exit;
        }

    // ✅ Obtener categorías desde el modelo
    $categories = $this->productModel->getCategories();

    require_once __DIR__ . '/../views/products/create.php';
    }


    public function store()
    {
        $name = $_POST['nombre'];
        $category = $_POST['categoria_id'];
        $stock = $_POST['cantidad'];
        $price = $_POST['precio'];
        $description = $_POST['descripcion'];

        $imagePath = '';
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../public/uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $fileName = basename($_FILES['image']['name']);
            $uniqueName = time() . "_" . $fileName;
            $targetFile = $uploadDir . $uniqueName;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                $imagePath = 'public/uploads/' . $uniqueName;
            }
        }

        $this->productModel->create($name, $category, $stock, $price, $description, $imagePath);
        header('Location: index.php?controller=product&action=index');
    }
    // Método edit(): Muestra el formulario para editar un producto existente.
    // Show form to edit product
    public function edit()
    {
        session_start();

        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?controller=auth&action=iniciarSesion");
            exit;
        }

        $id = $_GET['id'];
        $product = $this->productModel->getById($id);

        if (!$product) {
            echo "Producto no encontrado";
        exit;
        }

    // ✅ Obtener categorías para el select
        $categories = $this->productModel->getCategories();

        require_once __DIR__ . '/../views/products/edit.php';
    }

    // Procesa la actualización del producto
    public function update()
    {
        session_start();

        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?controller=auth&action=iniciarSesion");
            exit;
        }

        $errors = [];
        
        $id = $_POST['id'];
        $name = $_POST['nombre'] ?? '';
        $category_id = $_POST['categoria_id'] ?? '';
        $stock = $_POST['cantidad'] ?? '';
        $price = $_POST['precio'] ?? '';
        $description = $_POST['descripcion'] ?? '';

        $product = $this->productModel->getById($id);
        $currentImage = $product['image'];

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../public/uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $fileName = basename($_FILES['image']['name']);
            $uniqueName = time() . "_" . $fileName;
            $targetFile = $uploadDir . $uniqueName;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                $image = 'public/uploads/' . $uniqueName;
            }
        } else {
            $image = $currentImage;
        }

        $this->productModel->update($id, $name, $category_id,  $stock, $price, $description, $image);
        header('Location: index.php?controller=product&action=index');
    }

    // Eliminar producto
    // Delete product
    public function delete()
    {   
        $id = $_GET['id'];
        $this->productModel->delete($id);
        header('Location: index.php?controller=product&action=index');
    }

}

