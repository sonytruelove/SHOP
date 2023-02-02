<?php
class php_Models_product
{    
function getProduct($ID)
{
	$db=DB::getInstance();
	$result=$db->connect()->query("SELECT * FROM shop WHERE ID='$ID'");	
	$row=$result->fetch(PDO::FETCH_ASSOC);
	if($result->rowCount()){
		return $row;
	}
}
function addProduct($array)
	  { 	
		$array['url']=	translitIt($array['title']);
		$image_url="http://localhost/shop/php/admin/uploads/".$array['image_url'];
		$image=file_get_contents($image_url);
		echo $image;
		if(strlen($array['url'])>60)$array['url']=	substr($array['url'], 0, 60);
		//для чистоты работы, тут лучше проверить на уже существующие url,
			$db=DB::getInstance();
	$iquery = "INSERT INTO shop(ID, TITLE, PRICE, IMAGE, URL, DESCRIPTION) VALUES (?, ?, ?, ?, ?, ?)";
	$stmt = $db->connect()->prepare($iquery);
	$stmt->bindParam(1,$array['id'],PDO::PARAM_INT,11);
	$stmt->bindParam(2,$array['title'],PDO::PARAM_STR,25);
	$stmt->bindParam(3,$array['price'],PDO::PARAM_INT,11);
	$stmt->bindParam(4,$image,PDO::PARAM_LOB);
	$stmt->bindParam(5,$array['url'],PDO::PARAM_STR,40);
	$stmt->bindParam(5,$array['desc'],PDO::PARAM_STR,40);
    $stmt->execute();
			if($stmt->execute()){
			  
			 return $db->connect()->lastInsertId();
				
			}
		
		return	false;
	  }
function deleteProduct($id)
	  { $db=DB::getInstance();
		if($db->connect()->prepare("DELETE FROM shop WHERE ID = ?")->execute([$id])){
		return true;
		}
		return	false;
	  }


function updateProduct($array,$id)
	  { 	
		$db=DB::getInstance();
		if($db->connect()->prepare("UPDATE shop SET TITLE=?,PRICE=?,IMAGE=?,DESC=? WHERE ID = ?")->execute([$array['title'],$array['price'],$array['image_url'],$array['desc'],$id])){		   
				return true;
			}
		return	false;
	  }
}
?>