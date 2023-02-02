<?php
  class php_admin_Controllers_index extends php_Controllers_BaseController
  {
	
   
     function index()
	 { 
	 		
		if(array_key_exists('login',$_REQUEST)||array_key_exists('pass',$_REQUEST)){	
			$model=new php_Models_enter;
			$resultValid=$model->ValidData($_REQUEST['login'],$_REQUEST['pass']);
			$this->unVisibleForm=$resultValid['unVisibleForm'];
			$this->userName=$resultValid['login'];
			$this->msg=$resultValid['msg'];
			$this->login=$resultValid['login'];
			$this->pass=$resultValid['pass'];
			
			if(array_key_exists('location',$_REQUEST)) header('Location: '.$_REQUEST['location']);
			
		}
		else 
			if(array_key_exists('Auth',$_SESSION))$this->unVisibleForm=true;	
		
	
		if(array_key_exists('out',$_REQUEST)){
			if($_REQUEST['out']=='1'){
				$_SESSION["Auth"]=false;
				$_SESSION["User"]="";
				$_SESSION["role"]="";
				$this->unVisibleForm=false;
			}
		}

	 
  

	 }
  }
?>