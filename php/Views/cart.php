<h2>Cart</h2>
<?php if($empty_cart):?>
	<form action="cart" method="post">
	<?=$big_cart;?>
	<div class="btn-group px-2 m-2">
		<input class="btn btn-secondary mx-2" type="submit" name="refresh" value="Recount"   />
	</form>
	<form action="order" method="post" >
		<input class="btn btn-success" type="submit" name="purshise" value="Purshise"  />
	</form>
	</div>

<?php else:?>
<p>Empty cart!</p>
<?php endif;?>
	