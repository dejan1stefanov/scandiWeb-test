<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  require_once __DIR__ . "/../models/ProductCategory.php";


  use StoreApp\ProductCategory;


  new DB();

  $product_category = new ProductCategory();

  $stmt = $product_category->read();
 
  if($stmt->rowCount() > 0) 
  {
    // products_categories array
    $products_categories_arr = [];

    while($row = $stmt->fetch()) 
    {
      extract($row);
      // last array type of returning data
      $product_category_item = [
          'id' => $row['id'],
          'sku' => $row['sku'],
          'name' => ucfirst($row['name']),
          'price' => number_format($row['price'],2),
          'category' => ucfirst($row['category']),
          'attributes' => ucfirst($row['attributes']),
          'attributes_value' => $row['attributes_value'],
          'parameter' => $row['parameter']
      ];

      // Push to "data"
      array_push($products_categories_arr, $product_category_item);
    }

    // Turn to JSON & output
    echo json_encode($products_categories_arr);

  } 
  else 
  {
    // No Products
    echo json_encode(
      array('message' => 'No Products Found')
    );
  }
?>