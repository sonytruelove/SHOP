<script type="text/javascript" src="../../shop/js/jquery.form.js"></script>
<script type="text/javascript" src="../../shop/js/admin.js"></script>
	<script type="text/javascript">

	$('#photoimg').live('change', function(){ 
			   $("#preview").html('');
			   $("#preview").html('<img src="loader.gif" alt="Uploading...."/>');
			   $("#imageform").ajaxForm({				
					target: '#preview'
				}).submit();
				$(".btn_cancel_load_img").css('display', 'block');
				$(".btn_load_img").css('display',  'none');	
		});	
		
	$('#edit_photoimg').live('change', function(){ 
			   $("#edit_preview").html('');
			   $("#edit_preview").html('<img src="loader.gif" alt="Uploading...."/>');
			   $("#edit_imageform").ajaxForm({				
					target: '#edit_preview'
				}).submit();
	});
	</script>	
<?php
	$model=new php_Models_editproducts;	
	$products=array();
	if(isset($lower_bound)&&isset($step)){
		 $products=$model->getList($lower_bound,$step);
	}
	else $products=$model->getList(0,5);
?>	
<h1>Каталог товаров</h1>

	<a href="#" rel="create_new_product" class="button"><i class="bi bi-plus"></i>Добавить товар</a>
	
	<table class="products_table"><tr><th>ID</th><th>Изображение</th><th>Название</th><th>Цена</th><th> Описание</th><th></th><th></th></tr>	 
	<?php	
	foreach($products as $data){
		if(key($data)=="ID"){?>
			<tr id="<?=$data['ID']?>">
			<td class="id"><?=$data['ID']?></td>
			<td class="image_url_product"><img class="uploads" height=50 weidth=50 src="<?='data:image/jpeg;base64,'.base64_encode($data['IMAGE'])?>"/></td>
			<td class="title"><?=$data['TITLE']?></td>
			<td class="price"><?=$data['PRICE']?></td>
			<td class="description" id="<?=$data['ID']?>"><?=$data['DESCRIPTION']?></td>
			<td><a href="#" rel="edit" id="<?=$data['ID']?>">Редактировать</a></td>
			<td><a href="#" rel="del" id="<?=$data['ID']?>">Удалить</a></td>
			</tr>
		<?php }
	else
		if(key($data)=="pagination"){
			$pages="";
			$pagination=$data["pagination"];
			foreach($pagination as $page=>$info){
			if(is_numeric($page))
				$pages.='<a class="'.$info[2].'" rel="pagination" l="'.$info[0].'" step="'.$info[1].'" href="#">'.($page+1).'</a>';
			}
			
			$pages='<div class="pagination">Страница '.$pagination['active_page'].' из '.(count($pagination)-1).'   '.$pages.'</div>';
		}
		
	}
	?>

	<tr><td colspan="7"><?=$pages?></td></tr>
	</table>
	
	
	
	<div class="create_product">
		<div class="popwindow">
			<div class="title_popwindow">
				Новый товар		
			</div>
			<div class="close_popwindow">
				<a href="#" rel="cancel_create_new_product" >
				<i class="bi bi-x"></i>
				</a>
			</div>
		</div>	
		<table border="1">	
		<tr>
			<td>Название:</td><td><input type="text" name="title"/></td>
			<td rowspan="2">Изображение:
			<div class="btn_load_img">
				<form id="imageform" method="post" enctype="multipart/form-data" action="loadimage.php">
				<input type="file" name="photoimg" id="photoimg" />
				</form>	
			</div>
			
			<div class="btn_cancel_load_img">
				<a href="#" id="form_del_img"  alt="Отменить" title="Отменить"><i class="bi bi-x"></i></a>
			</div>						
		
			
			<div id="preview"></div>
			</td>
		</tr>
		<tr><td>Цена:</td><td><input type="text" name="price"/>$</td></tr>
		<tr><td>Описание:</td><td colspan="2"><textarea name="description" style="width:95%; height: 150px;"></textarea></td></tr>
		<tr>
			<td colspan="3" style="height:40px; text-align:right;">
				<a href="#" rel="save_new_product" class="button" >Сохранить</a>
			</td>
		</tr>
		</table>
	</div>
	
	<div class="edit_product">
			<div class="popwindow">
				<div class="title_popwindow">
					Редактировать товар		
				</div>
				<div class="close_popwindow">
					<a href="#" rel="cancel_edit_product" >
					<i class="bi bi-x"></i>
					</a>
				</div>
			</div>			
			<table border="1" style="background-color:#ffffff">	
				<tr><td>Название:</td><td><input type="text" name="edit_title" /></td><td rowspan="2">Изображение:
				<div class="edit_btn_load_img">			
				<form id="edit_imageform" method="post" enctype="multipart/form-data" action="loadimage.php">
				<input type="file" name="edit_photoimg" id="edit_photoimg" />
				</form>			
				</div>
			
				<div class="edit_btn_cancel_load_img">
					<a href="#" id="edit_form_del_img"  alt="Отменить" title="Отменить"><i class="bi bi-x"></i></a>
				</div>
			
				<div id="edit_preview">
				
				</div>
				
				</td></tr>
				<tr><td>Цена:</td><td><input type="text" name="edit_price"/>$</td></tr>
				<tr><td>Описание:</td><td colspan="2"><textarea name="edit_description" style="width:95%; height: 150px;"></textarea></td></tr>
				<tr><td colspan="3" style="height:40px; text-align:right;">
				<a href="#" rel="save_edit_product" class="button" >Сохранить</a>
				</td></tr>
			</table>
			<input type="hidden" name="edit_id"/>
	</div>	