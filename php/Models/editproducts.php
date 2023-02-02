<?php

 class php_Models_editproducts 
  {	  
	
	  function getList($lower_bound=0, $step=6)
	  {  
		$db=DB::getInstance();
		$result=$db->connect()->prepare("SELECT * FROM  `shop` 
						ORDER BY ID
						 LIMIT :lower_bound , :step");	
		$result->bindParam(':lower_bound',$lower_bound,PDO::PARAM_INT);
		$result->bindParam(':step', $step, PDO::PARAM_INT);
		$result->execute();
		if($result->rowCount())
		while ($row = $result->fetch(PDO::FETCH_ASSOC))
		{		 
			$productsItems[]=$row;
		}
		

		$result = $db->connect()->query("SELECT ID FROM  `shop` ORDER BY ID ");	   
		$count = $result->rowCount();
		$array_page=array(); 
		$k=1;
		if($step=="0")$step=1;		
		for($i=1; $i<=ceil($count/$step); $i++)
			{
				unset($num);
				for($j=0; $j<$step; $j++)
					$num[]=$k++;
				
				$array_page[$i]=$num;
			}
		

		
		foreach($array_page as $pageid=>$page){
	
			foreach($page as $num){
			
				if($num==($lower_bound+1)){
					$active=$pageid;
				}
			}
		}	

		
		$pagination["active_page"]=$active;
		$k=0;
		for($s=0; $s<$count; $s+=$step){
			$class="noactive";
			if($active==($k+1)){$class="active";}
			$pagination[$k]=array($s,$step,$class);
			$k++;
		}
 		  
		$productsItems[]=array('pagination'=>$pagination);
		
		return $productsItems; 
	  }
	  
	  

	   function getPageList($page=1,$step=5)
	  {
		$db=DB::getInstance();
		$result = $db->connect()->query("SELECT ID FROM  `shop` ORDER BY ID ");	   
		$count=$result->rowCount();

		$array_page=array(); 
		$k=1;
		if($step=="0")$step=1;		
		for($i=1; $i<=ceil($count/$step); $i++)
			{
				unset($num);
				for($j=0; $j<$step; $j++)
					$num[]=$k++;
				
				$array_page[$i]=$num;
			}
			


		$lower_bound=$array_page[$page][0]-1;
		if(!isset($lower_bound))$lower_bound=1;
		
		
		
		return $this->getList($lower_bound, $step);		
	  }
  } 