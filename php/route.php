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
	   }
		return $route;
    }

    private function getController()
	{       
       $route=$this->getRoute();
       $path_contr = 'php/Controllers/';
       $controller= $path_contr. $route . '.php';
       return $controller;
    }
	 
	public function getView()
	{
       $route=$this->getRoute();
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