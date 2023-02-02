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
			
				
			}
			if($rt[(count($rt)-2)]=="admin"){
			$route="shop/admin/".$rt[(count($rt)-1)];
			}

			}
	   }	
		return $route;
    }

    private function getController()
	{         
        $route=$this->getRoute();
	$rt=explode('/', $route);
	if($route=="admin"){return 'php/admin/Controllers/index.php';}
	if(count($rt)>1){
		if($rt[(count($rt))-2]=="admin"){
			if(isset($_SESSION["Auth"]) && $_SESSION["role"]=="1"){
				return 'php/admin/Controllers/'.$rt[(count($rt))-1].'.php';
	}else{echo 'У вас нет доступа';return 'php/admin/Controllers/index.php';}}}
        $path_contr = 'php/Controllers/';
        $controller= $path_contr. $route . '.php';
        return $controller;
    	
}
	public function getView()
	{

        $route=$this->getRoute();
	$rt=explode('/', $route);
	if($route=="admin"){return 'php/admin/Views/index.php';}
	if(count($rt)>1){
	if($rt[(count($rt))-2]=="admin"){
		if(isset($_SESSION["Auth"]) && $_SESSION["role"]=="1") {return 'php/admin/Views/'.$rt[(count($rt))-1].'.php';}else{return 'php/admin/Views/index.php';}}
	}
        $path_view = 'php/Views/' ;
        $view = $path_view . $route . '.php';
        return $view;
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