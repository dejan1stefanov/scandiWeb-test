<?php
// headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
require_once __DIR__ . "/../database/DB.php";
require_once __DIR__ . "/../models/ProductCategory.php";

use StoreApp\ProductCategory;
// Instantiate DB & connect
new DB();
// Instantiate product category object
$product_category = new ProductCategory();
// Get raw posted data
$data = json_decode(file_get_contents("php://input"));
//Logic if there are more than one product selected for delete
$products_id = $data->id;

if(count($products_id) < 2)
{
    $where_query = $data->id[0];
}
else if(count($products_id) > 1)
{
    $num = count($products_id);
  
    for($i=0; $i < $num; $i++)
    {
        if($i == 0)
        {
            $where_query = $products_id[$i];
        }
        else
        {
            $where_query .= ",{$products_id[$i]}";
        }
    }

}

// Set ID or string of more IDs to delete
$product_category->setProductsId($where_query);

if ($product_category->delete()) 
{
    echo json_encode(
        array('message' => 'Product Deleted')
    );
} 
else 
{
    echo json_encode(
        array('message' => 'An error occured. Product/s was/were not Deleted. Please try again.')
    );
}
