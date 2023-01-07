<?php
class Application_Models_Cart
  {  
    function addToCart($id, $count=1)
    {        
     $_SESSION['cart'][$id]=$_SESSION['cart'][$id]+$count;     
    return true;
    }    
     
    function delFromCart($id, $count=1){}
     
    function clearCart(){}
  }
?>