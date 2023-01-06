<?php

include_once 'DB-singleton.php'; 

$db = DB::getInstance();

$products = [];

$products[] = [
		'ID' => 1,

              'TITLE' => 'Mexico sofa',

	      'PRICE' => '100',

              'IMAGE' => file_get_contents("https://www.mia-moebel.de/media/catalog/product/cache/1/image/1000x750/9df78eab33525d08d6e5fb8d27136e95/m/g/sofa-mexico-moebel-landhaus-pinie-honig_23967.jpg"),
	      'URL' => 'Mexico-sofa'

              ];
$products[] = [
		'ID' => 2,

              'TITLE' => 'Cool Chair',

	      'PRICE' => '50',

              'IMAGE' => file_get_contents("https://coolmaterial.com/wp-content/uploads/2013/07/Quartz-Armchair-1.jpg"),

	      'URL' => 'Cool-Chair'

              ];
$dquery = "DELETE FROM `shop`";
$iquery = "INSERT INTO shop(ID, TITLE, PRICE, IMAGE, URL) VALUES (?, ?, ?, ?, ?)";
$stmt = $db->connect()->prepare($dquery);
$stmt->execute();
foreach ($products as $product) {
    $stmt = $db->connect()->prepare($iquery);
	$stmt->bindParam(1,$product['ID'],PDO::PARAM_INT,11);
	$stmt->bindParam(2,$product['TITLE'],PDO::PARAM_STR,25);
	$stmt->bindParam(3,$product['PRICE'],PDO::PARAM_INT,11);
	$stmt->bindParam(4,$product['IMAGE'],PDO::PARAM_LOB);
	$stmt->bindParam(5,$product['URL'],PDO::PARAM_STR,40);
    $stmt->execute();

}

echo "Records inserted successfully";