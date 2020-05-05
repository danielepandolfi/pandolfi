<?php



// Create a PHP object
$productObj = new stdClass();
$productObj->productList = array(new stdClass(),new stdClass());
$productObj->productList[0]->nome = "Arduino";
$productObj->productList[0]->barcode = "L-DIN-AR01";
$productObj->productList[1]->nome = "Raspberry";
$productObj->productList[1]->barcode = "L-DIN-RB01";

//connect to database
$db_connection=new mysqli("pandolfi_db_1", "user","password","db");
 if($db_connection->connect_error){
     die("connection failed" . $db_connection->connection_error);
 }
 $result= $db_connection->query("SELECT * FROM `item`");
  if($result){
      foreach($result as $row){
          $item= new stdClass();
          $item->nome= $row["nome"];
          $item->barcode= $row["barcode"];
          $item->img_url = $row["img.url"];
          $productObj->productList[]= $item;
      }
  }

// convert object to JSON string
$productJson = json_encode($productObj);

// return the string to the client
header('Content-Type: application/json');
echo $productJson;

  


?>


