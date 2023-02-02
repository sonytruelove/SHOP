<?php
$login="";
$pass="";
?>
<?php if(array_key_exists("Auth",$_SESSION) && array_key_exists("role",$_SESSION) && $_SESSION["role"]=="1"):
?>
<html>

  <head>
    <script type="text/javascript" src="../../script/jquery.form.js"></script>
	<script type="text/javascript" src="../../script/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="../../script/admin.js"></script>
  </head>
  
  <body>
  
 <div id="header">
		<div class="logo"></div>		
		<div class="menu">
			<ul>
				<li ><a href="/" id="#">Просмотр</a></li>
				<li class="products"><a href="admin/editproducts" id="product">Товары</a></li>
				<li class="page"><a href="#" id="page">Страницы</a></li>
				<li class="menu"><a href="#" id="menu">Меню</a></li>
				<li class="settings"><a href="#" id="settings">Настройки</a></li>

			</ul>
		</div>
		<div class="user">
			<a href="#"><?=$_SESSION["User"]?></a> (<a href="/enter?out=1">Выход</a>)
		</div>
	</div>
	
	<div id="message_box">
	<div id="message">
	
	</div>
	</div>

	<div id="content">
		<div class="data">
			<p>Добро пожаловать в панель администрирования системы!</p>
		</div>
	</div>

  </body>
  
</html>
<?php else:?>
<div class="login_form">
<h2>Авторизация</h2>
<div class="info">
<?php if(!array_key_exists("Auth",$_SESSION)){
echo "Только администраторы могут пользоваться этим разделом!";
}
else 
{
if(array_key_exists("role",$_SESSION)){
if($_SESSION["role"]>1) echo "У вас нет доступа к этой части сайта!";}
}?>
</div>
Введите логин и пароль администратора:
<form action="admin/editproducts" method="POST">
  <div class="form-group">
    <label for="InputLogin">Login</label>
    <input type="login" class="form-control" name="login" value="<?= $login?>"placeholder="Login">
  </div>
  <div class="form-group">
    <label for="InputPassword">Password</label>
    <input type="password" class="form-control" name="pass" value="<?= $pass?>" placeholder="Password">
  </div>
  <button type="submit" class="btn btn-success mt-5">Submit</button>
</form>


<?php endif;?>
</div>