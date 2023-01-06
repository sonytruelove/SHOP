<head><link href="../css/styles.css" rel="stylesheet"></head>
<div class="display-4">
<?=$product['TITLE']?>
</div>
<div class="card mb-5">
	<div class="card-img">
	<image src="data:image/jpeg;base64,<?=base64_encode($product['IMAGE'])?>" class="mr-3" alt="description">
	</div>
	<div class="media-body mx-left display-5 bg-dark text-white">
	<?=$product['PRICE']?> $                  
	</div>
	
</div>
	<div class=" p-4 pt-2 bg-transparent">
                  <a class="  fw-bolder fw-5 display-4 justify-content-center d-flex  btn-outline-dark mt-auto  " href="#">Add to cart</a>

	</div>
