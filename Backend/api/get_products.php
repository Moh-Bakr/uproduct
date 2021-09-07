<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../Logic/Logic.php';

$database = new Database();
$db = $database->getConnection();

$items = new Logic($db);
$stmt = $items->getproducts();
$itemCount = $stmt->rowCount();

if($itemCount > 0){
    $productarr = array();
    $productarr["body"] = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $e = array(
            "ID" =>$id,
            "SKU" =>  $sku,
            "Name" => $name,
            "Price" => $price,
            "Type" => $type,
            "Value" => $value
        );

        array_push($productarr["body"], $e);
    }
    echo json_encode($productarr);
}
else{
    http_response_code(404);
    echo json_encode(
        array("message" => "No record found.")
    );
}