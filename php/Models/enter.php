<?php

 class php_Models_enter 
  {	  
	  function ValidData($login,$pass)
	  {
		$unVisibleForm=false;
		$db=DB::getInstance();
		$result=$db->connect()->prepare("SELECT * FROM  `users` 
						WHERE LOGIN= :login and PASS = :pass");	
		$result->bindParam(':login',$login,PDO::PARAM_INT);
		$result->bindParam(':pass', $pass, PDO::PARAM_INT);
		$result->execute();	
		$row=$result->fetch(PDO::FETCH_ASSOC);
		if($result->rowCount()){
			$_SESSION["Auth"]=true;  
			$_SESSION["User"]=$login;  
			$_SESSION["role"]=$row["ROLE"]; 
		}
		else $_SESSION["Auth"]=false;  

		if (!$_SESSION["Auth"]){
			$msg="<em><span style='color:red'>Данные введены не верно!</span></em>";
		}	
		else {
			$msg="<em><span style='color:green'>Вы верно ввели данные!</span></em>";
			$unVisibleForm=true;
		}
		
		$result=array("unVisibleForm"=>$unVisibleForm,
						"userName"=>$login,
						"msg"=>$msg,
						"login"=>$login,
						"pass"=>$pass,);
		return $result;
		
	  }
  } 
?>