<?php
class php_Models_cart
  {  
    function addToCart($id, $count=1)
    {        
     $_SESSION['cart'][$id]=$_SESSION['cart'][$id]+$count;     
    return true;
    }    
     
    function delFromCart($id, $count=1){}
     function checkCart(){$_SESSION['cart'][$id];}
    function clearCart(){}
  }
?>