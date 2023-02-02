<?php
  class php_admin_Controllers_ajax extends php_Controllers_BaseController
  {
	
   
     function index()
	 {
	
		include_once "config.php";
		//подключаем страницу каталога
		if($_REQUEST['url']=="editproducts.php"){
			if(isset($_REQUEST['l']) && isset($_REQUEST['step'])){
	 		$lower_bound=$_REQUEST['l']; 
			 $step=$_REQUEST['step'];	

		}
	}		

		include_once $_REQUEST['url'];
	}}
?>