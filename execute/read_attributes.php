<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

require_once __DIR__ . "/../models/Book.php";
require_once __DIR__ . "/../models/DVD.php";
require_once __DIR__ . "/../models/Furniture.php";
require_once __DIR__ . "/../models/Factory.php";

use StoreApp\Factory;

new DB();

$arr = $_POST;

 // Get raw posted data
$data = json_decode(file_get_contents("php://input"));

$object = Factory::create_ajax($data->origin);
$card = $object::print_attributes_card();

 
// Check if any images
if($card !== "") 
{

    $cards_arr = [];
   
    $card_item = [
        'card' => $card
    ];

  // Push to "data"
  array_push($cards_arr, $card_item);

  // Turn to JSON & output
  echo json_encode($cards_arr);

} 
else 
{
  // No Cards
  echo json_encode(
    array('message' => 'No Attributes Found')
  );
}






?>