<?php

include_once 'DB-singleton.php'; 

$db = DB::getInstance();

$products = [];

$products[] = [
		'ID' => 1,

              'TITLE' => 'Mexico sofa',

	      'PRICE' => '100',

              'IMAGE' => file_get_contents("https://www.mia-moebel.de/media/catalog/product/cache/1/image/1000x750/9df78eab33525d08d6e5fb8d27136e95/m/g/sofa-mexico-moebel-landhaus-pinie-honig_23967.jpg")

              ];
$products[] = [
		'ID' => 2,

              'TITLE' => 'Cool Chair',

	      'PRICE' => '50',

              'IMAGE' => file_get_contents("https://coolmaterial.com/wp-content/uploads/2013/07/Quartz-Armchair-1.jpg")

              ];
$iquery = "INSERT INTO shop(ID, TITLE, PRICE, IMAGE) VALUES (?, ?, ?, ?)";

foreach ($products as $product) {
    $stmt = $db->connect()->prepare($iquery);
	mysqli_stmt_bind_param($stmt, "isis", $product['ID'], $product['TITLE'], $product['PRICE'], $product['IMAGE']); 
    $stmt->execute();

}

echo "Records inserted successfully";