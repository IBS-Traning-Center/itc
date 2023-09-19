<?php
session_start();
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
require("./get_function.php");
require("./get_const.php");

//Патчим файлы для правильной работы скрипта скрытия модулей
echo not_mine();
echo '<main>';
//Сбрасываем кэш
$cache = new CPHPCache();
$cache->AbortDataCache();


//Устанавливаем заголовок страницы
$APPLICATION->SetTitle("Get Update Modules ver 2.3.0 (beta)");

/////////////////////
//Начинаем

//Если ключ меньшей длинны или нажата кнопка Сбросить
if(strlen($_POST["k"])<23 || $_POST["command"]=="reset" || $_SESSION['k'] != $_POST["k"]){
	clear();
}
if($_SESSION['k'] != $_POST["k"]) getKeyInfo(TRUE);

//строим основной массив с данными
rebuild();


//Если нажата кнопка получить инфу о модулях
if($_POST["command"]=="module"){

	//Если ключ не изменился
	if($_SESSION['k'] == $_POST["k"]){
		echo KEYNOTCHANGE;
	}
	//Если ключ короче чем должен быть
	elseif(strlen($_POST["k"])<23){
		echo SHORTKEY;
	}
	//Если передан новый ключ и нужной длинны
	else{
		unset($_SESSION['KeyInfo']['ERROR']);
		//Сохраняем ключ в сессии
		$_SESSION['k'] = $_POST["k"];
		echo MADEREQUEST;
		//Получаем информацию о ключе и сохраняем в сессию
		getKeyInfo();

	}

}

//Сортируем массив с модулями
sortArray($_SESSION['KeyInfo']['MODULES']);

// Выводим ошибку если есть
echo "<p>".$_SESSION['KeyInfo']['ERROR']."</p>";

//ссылки для уменьшения кода
if(is_array($_SESSION['KeyInfo']['CLIENT'])){
	$cName = &$_SESSION['KeyInfo']['CLIENT']['NAME'];
	$dateFrom = &$_SESSION['KeyInfo']['CLIENT']['DATE_FROM'];
	$dateTo = &$_SESSION['KeyInfo']['CLIENT']['DATE_TO'];
}


$modules = &$_SESSION['KeyInfo']['MODULES'];

//Сортируем список обновлений
foreach($modules as $modId => $infMod){
	sortArray($_SESSION['KeyInfo']['MODULES'][$modId]['VERSIONS']);
}

?>
<br>
<form id="infkey" action="get_update.php" method="post"></form>
<form id="reset" action="get_update.php" method="post"></form>

<p>Ключ: <input id="key" name="k" form="infkey" value="<?=$_POST['k']?>" size="28" maxlength="23"></p>


<p><input name="command" form="infkey" value="module" hidden="true">
<input type="submit" form="infkey" value="Получить информацию о модулях">

<input name="command" form="reset" value="reset" hidden="true">
<input type="submit" form="reset" value="Сбросить"></p>

<?//Строим вывод исходя из полученной информации?>

<form id="downmod" action="get_update.php" method="post"></form>
<div id="updater">
<?//Получена ли информация о ключе


	if(is_array($_SESSION['KeyInfo']['CLIENT'])){
		echo "<div id='keyinfo'><p>Зарегистрировано на имя \"".$cName."\", обновления доступны с ".$dateFrom." по ".$dateTo."</p>";
		if(count($modules)>0) echo '<br><p>Список модулей:</p>';
		echo "</div>";

	}

	//Пробегаемся по всем модулям и выводим строки
	foreach($modules as $modId => $infMod){
		//Проверяем если есть установленный модуль или доступно обновление
		if($modules[$modId]['INST_VERSION'] != '' || $modules[$modId]['UPDATE_VERSION'] != '' || $modules[$modId]['KEY'] == 'Y'){
			//Выводим строку
			echo strModule($infMod);
		}
	}

//ОТЛАДКА
//__($_SESSION['KeyInfo']);
//$temp_upd = 'update_archive';
//CUpdateClientPartner::UnGzipArchive($temp_upd, $strError='', false);
//unarch('aspro.mshop.1.1.2.delta');
//<div id="result">Результат</div>

?>
</div>


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>


<script>
$(document).on('click', '.ajax-send-dwl',function(){

	 parents = $(this).parents();
	 controlId = $(parents[1]).attr('id');
	 controlInf = controlId.replace(/control-/gi, "");

	 id = $(this).attr('data-id');
	 type = $(this).attr('data-type');

	if(type == 'delta'){
		 prevver = $(this).attr('data-prevver');
		 ver = $(this).attr('data-ver');
	}else{
		prevver = false;
		ver = false;
	}

	var buff;
	buff = $("#"+controlId).html();

	$.ajax({
		url: 'get_upd.php',
		cache: false,
	    data:{
	        action: "dwl",
	        id:id,
	        prevver:prevver,
	        ver:ver,
	        type:type
    },
	    beforeSend: function(){
			    h = $("#"+controlId).outerHeight(true);
		        $("#"+controlId).replaceWith("<div id='"+controlId+"' class='control'> <?=$ajaxloading?> </div>");
		        $("#"+controlId).height(h);
		        $("#updater").addClass('disable');
	},
        complete: function(data){

		   control = $("#new-"+controlId, data.responseText).html();
		   inf = $("#"+controlInf+"-inf", data.responseText).attr("class");

		   if(inf==1){
		   	    $("#"+controlInf+"-inf").append("<span class='green'>Успешно скачан файл!</span>");
	           	$("#"+controlInf+"-inf span").delay(2000).fadeOut(1000, function(){$(this).remove()});
		   		$("#"+controlId).replaceWith("<div id='"+controlId+"' class='control'>"+control+"</div>");
           }else if(inf==0){
	           	$("#"+controlInf+"-inf").append("<span class='red'>Произошла неизвестная Ошибка!</span>");
	           	$("#"+controlInf+"-inf span").delay(2000).fadeOut(1000, function(){$(this).remove()});
	           	$("#"+controlId).replaceWith("<div id='"+controlId+"' class='control'>"+buff+"</div>");
           }else if(inf<0){
	           	$("#"+controlInf+"-inf").append("<span class='blue'>Файл уже присутствует в папке!</span>");
	           	$("#"+controlInf+"-inf span").delay(2000).fadeOut(1000, function(){$(this).remove()});
			   	$("#"+controlId).replaceWith("<div id='"+controlId+"' class='control'>"+buff+"</div>");
           }
           $("#updater").removeClass('disable');
           //$('#result').html(data.responseText);

        }
	});
	return false;
});



$(document).on('click', '.ajax-send-upd',function(){

	parents = $(this).parents();
	controlId = $(parents[1]).attr('id');
	controlInf = controlId.replace(/control-/gi, "");

	file = $(this).attr('data-file');
	id = $(this).attr('data-id');
	type = $(this).attr('data-type');

	if(type == 'delta'){
		prevver = $(this).attr('data-prevver');
		ver = $(this).attr('data-ver');
	}else{
		prevver = false;
		ver = false;
	}


	var buff;
	buff = $("#"+controlId).html();

	$.ajax({
		url: 'get_upd.php',
		cache: false,
	    data:{
	        action: "upd",
	        file:file,
	        id:id,
	        prevver:prevver,
	        ver:ver,
	        type:type

    },
	    beforeSend: function(){
			h = $("#"+controlId).outerHeight(true);
		    $("#"+controlId).replaceWith("<div id='"+controlId+"' class='control'> <?=$ajaxloading?> </div>");
		    $("#"+controlId).height(h);
		    $("#updater").addClass('disable');
	},
        complete: function(data){

		   control = $("#new-"+controlId, data.responseText).html();
		   inf = $("#"+controlInf+"-inf", data.responseText).attr("class");

		   if(inf==1){
		   	    $("#"+controlInf+"-inf").append("<span class='green'>Успешно установлено!</span>");
	           	$("#"+controlInf+"-inf span").delay(2000).fadeOut(1000, function(){$(this).remove()});
		   		if(type =='mod'){
			   		ids = $(parents[3]).attr('id');
			   		$("#"+ids+" .install").removeClass('no');
			   	}
		   		$("#"+controlId).replaceWith("<div id='"+controlId+"' class='control'>"+control+"</div>");
           }else if(inf==0){
	           	$("#"+controlInf+"-inf").append("<span class='red'>Произошла неизвестная Ошибка!</span>");
	           	$("#"+controlInf+"-inf span").delay(2000).fadeOut(1000, function(){$(this).remove()});
	           	$("#"+controlId).replaceWith("<div id='"+controlId+"' class='control'>"+buff+"</div>");
           }
           $("#updater").removeClass('disable');
           //$('#result').html(data.responseText);

        }
	});
	return false;
});


</script>

<link href="style.css" type="text/css"  rel="stylesheet" />
</main>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>