<?php
namespace StoreApp;

require_once __DIR__ . "/../database/DB.php";

class ProductCategory
{
    private $table = "productsCategory";
    private $id;
    private $products_id;
    private $categories_id;
    private $attributes_value;

    public function setProductsId($_id) 
    {
        $this->products_id = $_id;
    }
    public function getProductsId() 
    {
        return $this->products_id;
    }

    public function read() 
    {
        $conn = \DB::connect();

        // Create query
        $sql = "SELECT products.*, categories.title AS category, products_categories.attributes_value, attributes.name AS attributes, attributes.parameter
        FROM products LEFT JOIN products_categories ON products.id = products_categories.products_id
        LEFT JOIN categories ON products_categories.categories_id = categories.id
        LEFT JOIN attributes ON categories.attributes_id = attributes.id
        ORDER BY products.id";

        // Prepare statement
        $stmt = $conn->prepare($sql);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

    public function delete()
    {
        $conn = \DB::connect();

        // Create query
        $sql = "DELETE FROM products WHERE id IN ($this->products_id)";

        $stmt = $conn->exec($sql);

        return $stmt;
    }
}