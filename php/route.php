<?php
 class Route 
 {
    private function getRoute() 
    {
	   if (empty($_GET['route']))
       {
           $route = 'index';
	   }
         else
	   {
                 $route = $_GET['route'];				
			$rt=explode('/', $route);
			$route=$rt[(count($rt)-1)]; 
			if(count($rt)>1){
			if($rt[(count($rt)-2)]=="product"){			
				$db=DB::getInstance();
				$result=$db->connect()->query("SELECT * FROM shop WHERE url like '$route'");	
				if($result->rowCount()){
				$row=$result->fetch(PDO::FETCH_ASSOC);
				$_REQUEST['ID']=$row['ID'];
				$route="product";
	}
				
			}}
	   }
		return $route;
    }

    private function getController()
	{          
       $route=$this->getRoute();
	if($route!="admin"){
       $path_contr = 'php/Controllers/';
       $controller= $path_contr. $route . '.php';
       return $controller;}
    }
	 
	public function getView()
	{
       $route=$this->getRoute();
	   if($route!="admin"){
       $path_view = 'php/Views/' ;
       $view = $path_view . $route . '.php';
       return $view;}
    }
	 
	public function Run()
	{ 
	   session_start(); 
	   $controller=$this->getController();
	   $cl=explode('.', $controller);
	   $cl=$cl[0]; 
           $name_contr=str_replace("/", "_", $cl);
	   $contr=new $name_contr;
       	   $contr->index();
	   $member=$contr->member;
	   return $member;
	
	}
 }
?>