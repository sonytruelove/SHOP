<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Shop</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="/shop/css/styles.css" type="text/css" rel="stylesheet" />
  </head>
  <body>	
  <script type="text/javascript" src="../../shop/js/jquery-1.7.2.min.js"></script>
  <?php include_once 'php/route.php';
	include_once 'php/DB-singleton.php';
		 spl_autoload_register( function($class_name) 
 			{
    				$path=str_replace("_", "/", $class_name);
    				include_once($path .".php");
 			});
	$route=new Route;
	$member=$route->Run();
	$member['init']=0;
	if(isset($member)){
  		foreach ($member as $key => $value)
		{
	 		$$key= $value;
		} 
		
	include_once 'php/template/navigation.html'; 
 	include_once 'php/template/header.html';
	$view=$route->getView();
	include ($view);
	} 
 	include_once 'php/template/footer.html';?>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->

  </body>
</html>
