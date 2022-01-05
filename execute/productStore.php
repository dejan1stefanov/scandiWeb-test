<?php
session_start();
require_once __DIR__ . "/../models/Book.php";
require_once __DIR__ . "/../models/DVD.php";
require_once __DIR__ . "/../models/Furniture.php";
require_once __DIR__ . "/../models/Factory.php";

use StoreApp\Factory;

new DB();

$arr = $_POST;

$object = Factory::create($arr);

if($object->insert_product())
{
    //fetch the id from the new inserted product
    $stmt = $object->read_last_inserted_id();
    if($stmt->rowCount() > 0) 
    {
        while($row = $stmt->fetch()) 
        {
            $object->setId($row['id']);
        }
        //insert the same product in the child table
        if($object->insert())
        {
            $_SESSION['success'] = "Product added successfuly!";
            header("Location: ../public/addProduct.php");
            die();
        }
        else
        {
            //if the insert in the child table fails, delete from the parent also
            $object->delete_last_inserted_product();
            $_SESSION['error'] = "An error occured. Please try again. Thank you!";
            header("Location: ../public/addProduct.php");
            die();
        }
    }
    else
    {
        //if reading fails delete the product from previous table
        $object->delete_last_inserted_product();
        $_SESSION['error'] = "An error occured. Please try again. Thank you!";
        header("Location: ../public/addProduct.php");
        die();
    }

}
else
{
    $_SESSION['error'] = "An error occured. Please try again. Thank you!";
    header("Location: ../public/addProduct.php");
    die();
}


?>
