<?php
namespace StoreApp;

require_once __DIR__ . "/../database/DB.php";

abstract class Product
{
    private $table = "products";

    protected $id;
    protected $name;
    protected $SKU;
    protected $price;
    protected $categories_id;

    public function __construct($_arr)
    {
        $this->name = $_arr['name'];
        $this->SKU = uniqid("{$_arr['SKU']}-");
        $this->price = $_arr['price'];
        $this->categories_id = $_arr['productType'];
    }

    abstract public function setId($_id); 
    abstract public function getId();
    abstract public function setName($_name); 
    abstract public function getName(); 
    abstract public function setSKU($_SKU); 
    abstract public function getSKU(); 
    abstract public function setPrice($_price); 
    abstract public function getPrice();
    
    abstract public function insert_product();
    abstract public function read_last_inserted_id();
    abstract public function insert();
    abstract public static function print_attributes_card();
    abstract public function delete_last_inserted_product();
    

    


}


?>