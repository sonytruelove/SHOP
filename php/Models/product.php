<?php
class php_Models_Product
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
}
?>