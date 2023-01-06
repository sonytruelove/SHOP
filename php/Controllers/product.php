<?php
class php_Controllers_product extends php_Controllers_BaseController
  {
    function index()
     {
      $model = new php_Models_product;
      $product = $model->getProduct($_REQUEST['id']); 
      $this->product=$product;
     }
  }
?>