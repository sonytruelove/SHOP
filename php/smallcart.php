<?php
  class php_smallCart
  {
    protected static $instance; 
	private function __construct() {}	
	public static function getInstance() 
	{
		if (!is_object(self::$instance)) self::$instance = new self;
		return self::$instance;
    }
	
	public function  setCartData() 
	 {			 
	  $cart_content = serialize($_SESSION['cart']);
	  SetCookie("cart", $cart_content,time()+3600*24*2); 
	 }
	
	protected function  getCokieCart()
	 {	
	   if(isset($_COOKIE)){ 
			$_SESSION['cart']=unserialize($_COOKIE['cart']); 
			return  true;	
	   }
	   
	  return  false;		 
	 }
	 
	public function  getCartData() 
	 {
	 	$res['cart_count']=0; 
		$res['cart_price']=0; 
		
		   if($this->getCokieCart() && $_SESSION['cart']) 
		   {
				foreach ($_SESSION['cart'] as $id=>$count){ 
					$sql = "SELECT p.price FROM product p WHERE id='{$id}'";
					$result = mysql_query($sql)  or die(mysql_error());
					if($row = mysql_fetch_assoc($result))
						 {		 
							$total_price+=$row['price']*$count;
							$total_count+=$count;
						 }	 
				}
				
			$res['cart_count']=$total_count;
			$res['cart_price']=$total_price;
			

			}
	  return  $res;
	 }
 }
/*
  Автор: Авдеев Марк.
  e-mail: mark-avdeev@mail.ru
  blog: lifeexample.ru
*/
?>