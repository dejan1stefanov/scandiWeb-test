<?php
namespace StoreApp;

require_once __DIR__ . "/Product.php";

use StoreApp\Product;

class DVD extends Product
{
    private $table = 'dvds';
    private $products_id;
    private $attributes_value;
    private $parameter = "MB";
   

    public function __construct($_arr)
    {
        parent::__construct($_arr);
        $this->attributes_value = $_arr['size'];
    }

    public function setId($_id) 
    {
        $this->id = $_id;
    }
    public function getId() {
        return $this->id;
    }

    public function setName($_name) 
    {
        $this->name = $_name;
    }
    public function getName() 
    {
        return $this->name;
    }

    public function setSKU($_SKU) 
    {
        $this->SKU = $_SKU;
    }
    public function getSKU() 
    {
        return $this->SKU;
    }

    public function setPrice($_price) 
    {
        $this->price = $_price;
    }
    public function getPrice() 
    {
        return $this->price;
    }

    public function setAttr_value($_attr_value) 
    {
        $this->attr_value = $_attr_value;
    }
    public function getAttr_value() 
    {
        return $this->attr_value;
    }

    // ============================================= INSERT ==================================
    public function insert_product() 
    {
        $conn = \DB::connect();

        // Execute query
        $sql = "INSERT INTO products(name, SKU, price) VALUES(:name, :SKU, :price)";

        // Prepare statement
        $stmt = $conn->prepare($sql);
        $data = ['name' => $this->name, 'SKU' => $this->SKU, 'price' => $this->price];

        // return $stmt;
        return $stmt->execute($data);

    }

    public function insert() 
    {
        $conn = \DB::connect();

        print_r($conn);
        // Execute query
        $sql = "INSERT INTO products_categories(products_id, categories_id, attributes_value) VALUES(:products_id, :categories_id, :attributes_value)";

        // Prepare statement
        $stmt = $conn->prepare($sql);
        $data = ['products_id' => $this->id, 'categories_id' => $this->categories_id, 'attributes_value' => $this->attributes_value];

        // return $stmt;
        return $stmt->execute($data);

    }

    // ======================================== READ ========================================
    public function read()
    {
        $conn = \DB::connect();
        // Create query
        $sql = "SELECT *
        FROM " . $this->table . "
        WHERE 1";

        // Prepare statement
        $stmt = $conn->prepare($sql);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

    public function read_last_inserted_id() 
    {
        $conn = \DB::connect();

        $sql = "SELECT id
        FROM products 
        WHERE 1
        ORDER BY id DESC
        LIMIT 1;";

        // Prepare statement
        $stmt = $conn->prepare($sql);

        // Execute query
        $stmt->execute();

        return $stmt;

    }

     // ======================================== DELETE ========================================
     public function delete_last_inserted_product() 
     {
         $conn = \DB::connect();
 
         $sql = "DELETE 
         FROM products
         ORDER BY id DESC
         LIMIT 1;";
 
         // Prepare statement
         $stmt = $conn->prepare($sql);
 
         // Execute query
         $stmt->execute();
 
         return $stmt;
 
     }

    //  ========================================= PRINT ==================================
    public static function print_attributes_card()
    {
        return '<div id="DVD" class="d-flex justify-content-between align-items-center mb-4">
                    <label for="size" class="m-0">Size (MB)</label>
                    <div class="attributeParent w-50">
                        <input id="size" name="size" type="number" class="form-control w-100 attribute">
                    </div>
                </div>
                <p><b>Please, provide disk space in MB</b></p>';
    }


}



?>