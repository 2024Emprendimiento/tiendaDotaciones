<?php
// Model to handle product images

class ProductImage {
    private $db;

    public function __construct() {
        $this->db = require __DIR__ . '/../config/database.php';
    }

    public function getByProductId($productId) {
        $stmt = $this->db->prepare("SELECT * FROM product_image WHERE product_id = ?");
        $stmt->execute([$productId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteByProductId($productId) {
    $stmt = $this->db->prepare("DELETE FROM product_image WHERE product_id = ?");
    return $stmt->execute([$productId]);
}

}
