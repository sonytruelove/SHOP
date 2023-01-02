<?php
class php_Models_products
  {

function create_cards(){
	$db=DB::getInstance();
	$result=$db->connect()->query("SELECT * FROM `shop`");	
	if($result->rowCount()){
	while($row=$result->fetch(PDO::FETCH_ASSOC)){

 echo '
	
<div class="card-columns">
  <div class="card mb-5 ">
    <img class="card-img-top" src="data:image/jpeg;base64,'.base64_encode($row['IMAGE']).'" alt="">
    <div class="card-body">
      <h5 class="card-title">'.$row['TITLE'].'</h5>
      <p class="card-text">$'.$row['PRICE'].'</p>
    </div>
  </div>


';


}}}
}
?>