
function show_catalog() {
    //сворачивает полное описание у всех строк
    /*$("td[class=desc]").each(function(){		
    		var text=$(this).text();
    		$(this).text(text.substr(0,120)+'...');
    	}
    );*/
}

//запрашивает страницу для вывода 
function show(url) {
    $.ajax({
        type: "POST",
        url: "ajax.php",
        data: {
            url: url
        },
        cache: false,
        success: function(data) {
            $("#content").html(data);

        }
    });
}
//отчистка всех полей форы  редактирвания товара
function clear_field_edit() {
    var edit_product = $(".edit_product");
    edit_product.find("input[name=edit_id]").val('');
    edit_product.find("input[name=edit_title]").val('');
    edit_product.find("#edit_preview").html('');
    edit_product.find("input[name=edit_price]").val('');
    edit_product.find("textarea[name=edit_description]").val('');
    $('input[name=edit_photoimg]').val('');


}

//отчистка всех полей форы добавления товара
function clear_field_new_product() {
    var create_product = $(".create_product");
    create_product.find("input[title=title]").val('');
    create_product.find("#preview").html('');
    create_product.find("input[name=price]").val('');
    create_product.find("textarea[name=description]").val('');
    $('input[name=photoimg]').val('');
}

function indication(object, text, type) {
	
    var background = "#9abb8b";
    var bordercolor = "#588a41";

    if (!type) {
        background = "#fab0ab";
        bordercolor = "#fc6f64";
    }
    object.animate({
        opacity: "show"
    }, "slow");
    object.html(text);
    object.css('background', background);
    object.css('border-color', bordercolor);
    object.animate({
        opacity: "hide"
    }, 3000);

}

//позиционирование элемента по центру окна
function centerPosition(object) {
    object.css('position', 'absolute');
    object.css('left', ($(window).width() - object.width()) / 2 + 'px');
    object.css('top', ($(window).height() - object.height()) / 2 + 'px');
}
$(document).ready(function(){  
$(".create_product").hide();
 $(".edit_product").hide();	
});

/*Каталог*/

//Обработка  нажатия кнопки перехода на другую страницу каталога
$('a[rel=pagination]').live("click", function() {

    var l = $(this).attr('l'); // нижняя граница
    var step = $(this).attr('step'); // интервал

    $.ajax({
        type: "POST",
        url: "ajax.php",
        data: {
            url: "php/admin/Controllers/editproducts.php",
            l: l,
            step: step
        },
        cache: false,
        success: function(data) {
            $("#content").html(data);
        }

    });

});

//Обработка  нажатия кнопки создания нового товара
$('a[rel=create_new_product]').live("click", function() {
    $(".edit_product").hide(); //скрываем открытые окна 
    centerPosition($(".create_product"));
    $(".create_product").animate({
        opacity: "show"
    }, 500); 
});

//Обработка  нажатия кнопки сохранения нового товара
$('a[rel=save_new_product]').live("click", function() {
	var fakefilepath=$('input[type=file]').val();
	var arr= fakefilepath.split('\\');
	var filename=arr[arr.length-1];
    var title = $.trim($(".create_product").find('input[name=title]').val());
    var price = $.trim($(".create_product").find('input[name=price]').val()) - 0;
    var desc = $.trim($(".create_product").find('textarea[name=description]').val());
	alert(desc);
    var err = 0;

    if (!desc || !title) {
        err = "Все поля должны быть заполнены!";
    } else if ((typeof price) != "number" || !price) {
        err = "Введите правильную цену!";
    }
    if (err != 0) {
        indication($("#message"), err, false);
    } else 
        $.ajax({
            type: "POST",
            url: "ajax.php",
            data: {
                url: "php/admin/Models/add_product.php",
                title: title,
                price: price,
		desc: desc,
                image_url: filename
            },
            cache: false,
            success: function(data) {
                var response = eval("(" + data + ")");
                indication($("#message"), response.msg, response.status);
                $(".create_product").hide();

                //переходим на последнюю страницу
                var l = $("div.pagination").find("a").last().attr('l');
                var step = $("div.pagination").find("a").last().attr('step');
                $.ajax({
                    type: "POST",
                    url: "ajax.php",
                    data: {
                        url: "editproduct.php",
                        l: l,
                        step: step
                    },
                    cache: false,
                    success: function(data) {
                        $("#content").html(data);
                    }
                });

            }
		

        });
  	

 	
   
});
		
$('a[rel=cancel_create_new_product]').live("click", function() {
    clear_field_new_product();
    $(".create_product").animate({
        opacity: "hide"
    }, 500);
});



//Обработка  нажатия кнопки редактирования  товара	
$('a[rel=edit]').live("click", function() {
    var edit_product = $(".edit_product");
    $(".edit_btn_cansel_load_img").css('display', 'none');
    $(".create_product").hide(); 
    centerPosition(edit_product);
    edit_product.animate({
        opacity: "show"
    }, 500); 

    var id = $(this).attr('id');
    var title_product = $("tr[id=" + $(this).attr('id') + "]").find("td[class=title]").text();
    var desc_product = $("tr[id=" + $(this).attr('id') + "]").find("td[class=description]").text();
    var price_product = $("tr[id=" + $(this).attr('id') + "]").find("td[class=price]").text();
    var image_url_product = $("tr[id=" + $(this).attr('id') + "]").find("img[class=uploads]").attr('src');

    edit_product.find("input[name=edit_id]").val(id);
    edit_product.find("input[name=edit_title]").val(title_product);
    $(".edit_btn_load_img").css('display', 'block');



    if (image_url_product != "../uploads/none.png") {
        $(".edit_btn_load_img").css('display', 'none');
        edit_product.find("#edit_preview").html("<img src=" + image_url_product + " width='100' height='100'/>");
        edit_product.find(".edit_btn_cansel_load_img").css('display', 'block');

    }

    edit_product.find("input[name=edit_price]").val(price_product);
    edit_product.find("textarea[name=edit_description]").val(desc_product);

});


//Обработка  нажатия кнопки сохранения отредактированного товара	
$('a[rel=save_edit_product]').live("click", function() {
    var id = $.trim($('input[name=edit_id]').val());
    var filepath = $('input[name=edit_photoimg]').val();


    if (filepath != "") {
        var arr = filepath.split('\\');
        var image_url_product = arr[arr.length - 1];
    } else {
        var image_url_product = $("tr[id=" + id + "]").find("img[class=uploads]").attr('src');
        var arr = image_url_product.split('/');
        image_url_product = arr[arr.length - 1];
    }

    var title = $.trim($('input[name=edit_title]').val());
    var price = $.trim($('input[name=edit_price]').val()) - 0;
    var desc = $.trim($('input[name=edit_description]').val());;
    var err = 0;
	
    if (!title||!desc) {
        err = "Все поля должны быть заполнены!";
    } else if ((typeof price) != "number" || !price) {
        err = "Введите правильную цену!";
    }

    if (err != 0) {
	alert(err);
        $("#message").animate({
            opacity: "show"
        }, "slow");
        $("#message").html(err);
        $("#message").css('background', '#fab0ab');
        $("#message").css('border-color', '#fc6f64');
        $("#message").animate({
            opacity: "hide"
        }, 3000);
    } else
		
        $.ajax({
            type: "POST",
            url: "ajax.php",
            data: {
                url: "php/admin/Models/edit_product.php",
                id: id,
                title: title,
                price: price,
                image_url: image_url_product
            },
            cache: false,
            success: function(data) {
                var response = eval("(" + data + ")");

                indication($("#message"), response.msg, response.status);
                $(".edit_product").animate({
                    opacity: "hide"
                }, 500);

                //вставляем  измененны данные в строку таблицы
                $("tr[id=" + id + "]").find("td[class=title]").text(title);
                $("tr[id=" + id + "]").find("td[class=desc]").text(desc);
                $("tr[id=" + id + "]").find("td[class=price]").text(price);
                $("tr[id=" + id + "]").find("td[class=image_url]").html("");
                if (!image_url_product) image_url_product = "none.png";
                $("tr[id=" + id + "]").find("td[class=image_url]").html("<img class='uploads' src='../uploads/" + image_url_product + "' width='80' height='80'/>");

                clear_field_edit();
            },
		error: function(xhr, status, error) {
  			var err = eval("(" + xhr.responseText + ")");
  			alert(err.Message);
				},

        });
});


//нажата кнопка отмены изображния в форме редакирования
$('#edit_form_del_img').live('click', function() {
    var ID = $.trim($('input[name=edit_id]').val());

    $("tr[id=" + id + "]").find("img[class=uploads]").attr('src', '');

    $.ajax({
        type: "POST",
        url: "ajax.php",
        data: {
            url: "php/admin/Models/delete_image.php",
            id: ID
        },
        cache: false,
        success: function(data) {
            $("#edit_preview").html('');
            $(".edit_btn_load_img").css('display', 'block');
            $(".edit_btn_cansel_load_img").css('display', 'none');

        }
    });
});

//нажата кнопка отмены изображния в форме добавления товара
$('#form_del_img').live('click', function() {
    $("#preview").html('');

    $('input[name=photoimg]').val('');
    $(".btn_cansel_load_img").css('display', 'none');
    $(".btn_load_img").css('display', 'block');
});

//Обработка  нажатия кнопки отмены редактирования  товара			
$('a[rel=cancel_edit_product]').live("click", function() {
    clear_field_edit();
    $(".edit_product").animate({
        opacity: "hide"
    }, 500);
});
//Обработка  нажатия кнопки удаления  товара			
$('a[rel=del]').live("click", function() {

    var l = $("div.pagination").find("a[class=activ]").attr('l');
    var step = $("div.pagination").find("a[class=activ]").attr('step');
    var back_url = "editproducts.php?l=" + l + "&step=" + step;
    $.ajax({
        type: "POST",
        url: "ajax.php",
        data: {
            url: "php/admin/Models/delete_product.php",
            id: $(this).attr('id')
        },
        cache: false,
        success: function(data) {

            var response = eval("(" + data + ")");
            indication($("#message"), response.msg, response.status);


            $.ajax({
                type: "POST",
                url: "ajax.php",
                data: {
                    url: "php/admin/Models/edit_product.php",
                    l: l,
                    step: step
                },
                cache: false,
                success: function(data) {
                    $("#content").html(data);
                }
            });
     
        },

    });
});
