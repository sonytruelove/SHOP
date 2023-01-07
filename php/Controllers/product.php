<?php
class php_Controllers_product extends php_Controllers_BaseController
  {
    function index()
     {if(array_key_exists('in-cart-product-id',$_REQUEST))
     { echo 'work';
       $cart=new php_Models_cart;
       $cart->addToCart($_REQUEST['in-cart-product-id']);
       php_SmallCart::getInstance()->setCartData();
	$db=DB::getInstance();
	$ID=$_REQUEST['ID'];
	$result=$db->connect()->query("SELECT * FROM shop WHERE ID like '$ID'");	
	if($result->rowCount()){
	$row=$result->fetch(PDO::FETCH_ASSOC);
	$_REQUEST['URL']=$row['URL'];
       header("Location: ".$_REQUEST['URL']);
       exit;
     }}
      $model = new php_Models_product;
      $product = $model->getProduct($_REQUEST['ID']); 
      $this->product=$product;
     }
  }
?>