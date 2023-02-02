<?php

  class php_admin_Controllers_editproducts extends php_Controllers_BaseController
  {
     function index()
	 {	
		 if(array_key_exists('in-cart-product-id',$_REQUEST)) 
			{
			    $cart=new php_Models_cart;
				$cart->addToCart($_REQUEST['in-cart-product-id']);
				Lib_SmalCart::getInstance()->setCartData();
				header('Location: /catalog');
				exit;
			}
	

	
	
			$step=6;//сколько выводить на странице объектов	
			$page=1;
			if(isset($_REQUEST['p'])){ //запрашиваемая страница
			$page=$_REQUEST['p'];
			}
				
		
	     $model=new php_Models_editproducts;
		 $Items =$model->getPageList($page,$step);//передаем номер страницы, и количество объектов
		
		 $pages='';
		 
		 foreach($Items as $data){
			if(key($data)=="pagination"){
				$pagination=$data["pagination"];
				
				foreach($pagination as $page=>$info){
				
				if(is_numeric($page))
					$pages.='<a class="'.$info[2].'" href="editproducts?p='.($page+1).'">'.($page+1).'</a>';
	
				}
				
				$pages='<div class="pagination">Страница '.$pagination['active_page'].' из '.(count($pagination)-1).' '.$pages.'</div>';
				$this->pager=$pages;
			}		 
	 }

	//удаляем из массива информацию о пагинации? вся она хранится в последнем элементе массива
	 $id_pagination_element=count($Items)-1;
	 unset($Items[$id_pagination_element]);
		
	 $this->Items=$Items;
	
  }
  }
?>