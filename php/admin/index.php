<php?
session_start();?>
<div class="login_form">
<h2>Авторизация</h2>
<div class="info">
</div>
Введите логин и пароль администратора:
<form action="enter" method="POST">
<table id="login_form_table" style="margin-top:10px;">
<tr>
  <td>Логин:</td><td><input type="text" name="login" value="<?=$login?>" /></td>
</tr>
<tr>
  <td>Пароль:</td><td><input type="text" name="pass" value="<?=$pass?>" /></td>
</tr>
<tr>
<td colspan="2">
  <input type="hidden" name="location" value="admin">
  <input type="submit" value="Вход">
</td>  
</tr>  
</table>  
</form>
</div>