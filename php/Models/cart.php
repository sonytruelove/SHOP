<?php
 class php_Models_cart
  {	  
	  function addToCart($id, $count=1)
	  {	if($_SESSION['cart']!=0){
		$_SESSION['cart'][$id]=$_SESSION['cart'][$id]+$count;
		return true;}
	  }	  
	  
	  function getListItemId() 
	  {	 $listId=[];
		if(!empty($_SESSION['cart'])){
			$listId=array_keys($_SESSION['cart']);
		return $listId;}
		return [];
	  }	  
	  
	  function getTotalSumm() 
	  {	  	  		 
		$array_product_id=$this->getListItemId(); 
		$item_position = new php_Models_product();	
		
		foreach($array_product_id as $id){
			$product_positions[]=$item_position->getProduct($id);
		}
		foreach($product_positions as $product)
		{
			$total_summ+=$_SESSION['cart'][$product['ID']]*$product['PRICE'];
		}
			return $total_summ;
	  }
	  
	 
	 function clearCart(){
    unset($_SESSION['cart']);
  }
	  
	  
	  function refreshCart($array_product_id){ 
		foreach($array_product_id as $Item_Id => $new_count){
			if($new_count<=0){ 
				unset($_SESSION['cart'][$Item_Id]); 
			}
			else
				$_SESSION['cart'][$Item_Id]=$new_count; 		
			
		}
		
	  }
	  
	
	 function isEmptyCart(){ 
    if(array_key_exists("cart",$_SESSION) && !empty($_SESSION['cart'])) return false; 
    return true;
    }
	  
	 
	  function printCart()
	  {	$product_positions ??= [];  	
		$total_summ ??= 0;  
		$array_product_id=$this->getListItemId(); 
		
		$item_position = new php_Models_product();
		
		foreach($array_product_id as $id){
			$product_positions[]=$item_position->getProduct($id); 
		}
			$table_cart='<div class="row px-2">
    <div  class="col-lg-1 col-sm-3 col-xs-12" style="height: 100px; line-height: 100px;">
     N
    </div>
    <div  class="col-lg-3 col-sm-3 col-xs-12" style="height: 100px; line-height: 100px;">
     TITLE
    </div>
    <div class="col-lg-2 col-sm-3 col-xs-12" style="height: 100px; line-height: 100px;">
    PRICE
    </div>
    <div class="col-lg-1 col-sm-3 col-xs-12" style="height: 100px; line-height: 100px;">
    COUNT
    </div>
    <div class="col-lg-1 col-sm-3 " style="height: 100px; line-height: 100px;">
    SUM
    </div>
    <div class="col-lg-1 col-sm-3 col-xs-12" style="height: 100px; line-height: 100px;">
    REMOVE
    </div>
  </div>

';
	 
		
			$i=1;
			foreach($product_positions as $product)
			{	
				
				$table_cart.='<div class="row px-2 border-top py-2"><div class="col-lg-1 col-sm-3 col-xs-12">'.$i++.'</div>';
				$table_cart.='<div class="col-lg-3 col-sm-3 col-xs-12">'.$product['TITLE'].'</div>';
				$table_cart.='<div class="col-lg-2 col-sm-3 col-xs-12" style="color: green">'.$product['PRICE'].' $ </div>';
				$table_cart.='<div class="col-lg-1 col-sm-3 col-xs-12"><input type="text" style="text-align:center" size=3 name="item_'.$product['ID'].'" value="'.$_SESSION['cart'][$product['ID']].'"></div>';	
				$table_cart.='<div class="col-lg-1 col-sm-3 col-xs-10" style="color: green">'.$_SESSION['cart'][$product['ID']]*$product['PRICE'].' $ </div>';			
				$table_cart.='<div class="col-lg-1 col-sm-3 col-xs-12">'."<INPUT TYPE='checkbox'  name='del_".$product['ID']."'>".'</div></div>';
				
				$total_summ+=$_SESSION['cart'][$product['ID']]*$product['PRICE'];
			}
			$table_cart.='<h3 class="fs-4 py-4 px-2">Total: <strong> <span style="color: green">'.$total_summ.' $ </h3>';
		
		return $table_cart;
	  }	  
  } 