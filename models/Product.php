<?php
require_once __DIR__ . '/../config/database.php'; //conectamos con la base de datos

class Product // clase producto
{
    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
        
    }

    public function getAll() //traer todo 
    {
        $stmt = $this->db->query("SELECT products.id, products.nombre, products.categoria_id, products.cantidad, products.precio, products.descripcion, products.image, categories.nombre 
        AS category_name 
        FROM products 
        LEFT JOIN categories 
        ON products.categoria_id = categories.id 
        ORDER BY products.id DESC"); //union de dos tablas con el JOIN, 
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //Método getById(): Busca un usuario por su ID.
    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Devuelve el producto o false si no existe / Returns the product or false if not found
    }
    /**
     * Crear un nuevo producto
     * Create a new product
     */
    public function create($name, $category_id,  $stock, $price, $description, $image) //crear un registro
    {
        $stmt = $this->db->prepare("INSERT INTO products (nombre, categoria_id, cantidad, precio, descripcion, image) VALUES (:nombre, :categoria_id, :cantidad, :precio, :descripcion, :image)"); //parametros que se reciben en la dase de datos (?) va a cada campo de ref
        $stmt->bindParam(':nombre', $name);             // Nombre del producto / Product name
        $stmt->bindParam(':categoria_id', $category_id);     // Categoría / Category
        $stmt->bindParam(':cantidad', $stock);           // Stock disponible / Available stock
        $stmt->bindParam(':precio', $price);           // Precio / Price
        $stmt->bindParam(':descripcion', $description); // Descripción del producto / Product description
        $stmt->bindParam(':image', $image);           // Ruta de la imagen / Image path
        return $stmt->execute();
    }

    /**
     * Actualizar un producto existente
     * Update an existing product
     */
    public function update($id, $name, $category_id, $stock, $price, $description, $image)
    {
        $stmt = $this->db->prepare("UPDATE products SET nombre = :nombre, categoria_id = :categoria_id, cantidad = :cantidad, precio = :precio, descripcion = :descripcion, image = :image WHERE id = :id");
        $stmt->bindParam(':nombre', $name);             // Nombre del producto / Product name
        $stmt->bindParam(':categoria_id', $category_id);     // Categoría / Category
        $stmt->bindParam(':cantidad', $stock);           // Stock disponible / Available stock
        $stmt->bindParam(':precio', $price);           // Precio / Price
        $stmt->bindParam(':descripcion', $description); // Descripción del producto / Product description
        $stmt->bindParam(':image', $image);           // Ruta de la imagen / Image path
        $stmt->bindParam(':id', $id); // 
        return $stmt->execute(); // Retorna true si se actualizó correctamente / Returns true if update was successful
    }
    
    
    public function getCategories()
    {
        $stmt = $this->db->query("SELECT id, nombre FROM categories ORDER BY nombre ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function increaseStock($product_id, $quantity)
    {
        $stmt = $this->db->prepare("UPDATE products SET cantidad = cantidad + ? WHERE id = ?");
        return $stmt->execute([$quantity, $product_id]);
    }

    /**
     * Eliminar producto por ID
     * Delete a product by its ID
     */
    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM products WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute(); // Retorna true si se eliminó / Returns true if deleted
    }
}
