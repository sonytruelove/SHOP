<?php
class php_Models_content
  {

function create_cards(){
	$db=DB::getInstance();
	$result=$db->connect()->query("SELECT * FROM `shop`");	
	if($result->rowCount()){
	while($row=$result->fetch(PDO::FETCH_ASSOC)){

 echo '
  <div class="col mb-5">
            <div class="card h-100">
              <!-- Product image-->
              <img class="card-img-top" width=450 height=300 src="data:image/jpeg;base64,'.base64_encode($row['IMAGE']).'"/>
              <!-- Product details-->
              <div class="card-body p-4">
                <div class="text-center">
                  <!-- Product name-->
                  <h5 class="fw-bolder">'.$row['TITLE'].'</h5>
                  <!-- Product price-->$'.$row['PRICE'].' 
                </div>
              </div>
              <!-- Product actions-->
              <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                <div class="text-center">
                  <a class="btn btn-outline-dark mt-auto" href="'.$row['URL'].'">VIEW</a>
                </div>
              </div>
            </div>
          </div>

';

}}}
}
?>