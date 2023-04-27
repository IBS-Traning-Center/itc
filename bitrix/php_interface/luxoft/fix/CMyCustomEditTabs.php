<?php
class CMyCustomEditTabs {
	
	function ShowTab($divName, $arArgs, $bVarsFromForm)
	{
	   	if ($divName == "myEdit1") {
	   		print_r($_REQUEST);
	    ?>
			<tr>
			   <td width="40%">Введите myEdit1:</td>
			   <td width="60%"><input type="text" name="myEdit1_input" value="<?=$_POST["myEdit1_input"]?>"></td>
			</tr>
		<?
	   	}
	   	
		if ($divName == "myEdit2") {
			print_r($_POST);	    
		?>
			<tr>
			   <td width="40%">Введите myEdit2:</td>
			   <td width="60%"><input type="text" name="myEdit2_input" value="<?=$_POST["myEdit2_input"]?>"></td>
			</tr>
		<?
	   	}
	}
	 	
}
class CMyCustomEditTabs1 extends CMyCustomEditTabs{
	
	function OnInit() {
		return array(
			"TABSET" => "MyEditTabs",
         	"GetTabs" => array("CMyCustomEditTabs1", "GetTabs"),
         	"ShowTab" => array("CMyCustomEditTabs", "ShowTab"),
         	"Action" => array("CMyCustomEditTabs1", "Action"),
         	"Check" => array("CMyCustomEditTabs1", "Check"),
      	);
	}

	function Action($arArgs)
	{
	   // Основные данные сохранены. Делаем тут необходимые действия, сохраняем инфо из кастомных табов.
	   // Возвращаем True в случае успеха и False - в случае ошибки
	   // В случае ошибки делаем так же $GLOBALS["APPLICATION"]->ThrowException("Ошибка!!!", "ERROR");
	   
		$GLOBALS["APPLICATION"]->ThrowException(print_r($_REQUEST));return false;
		//print_r($_REQUEST);
		
		return true;
	}
	
	function Check($arArgs)
	{
	   // Основные данные еще не сохранялись. Делаем тут разные проверки.
	   // Возвращаем True, если можно все сохранять, иначе False
	   // В случае False делаем так же $GLOBALS["APPLICATION"]->ThrowException("Ошибка!!!", "ERROR");
	   
		return true;
	}
	
	function GetTabs($arArgs)
	{
		// SORT - после какого стандартного таба вставлять. Не установлено - после последнего
	   	$arTabs = array(
	    	array(	"DIV" => "myEdit1", 
	    			"TAB" => "Mega Edit Tab 1", 
	    			"ICON" => "iblock_element", 
	    			"TITLE" => "Mega Edit Tab 1", 
	    			"SORT" => 1),
	    	array(	"DIV" => "myEdit11", 
	    			"TAB" => "Mega Edit Tab 11", 
	    			"ICON" => "iblock_element", 
	    			"TITLE" => "Mega Edit Tab 11", 
	    			"SORT" => 1)
	   	);
	   	return $arTabs;
	}
	
/*	function ShowTab($divName, $arArgs, $bVarsFromForm)
	{
	   	if ($divName == "myEdit1")
	   	{
	    ?>
			<tr>
			   <td width="40%">Введите мега инфу в это мега поле;-):</td>
			   <td width="60%"><input type="text" name="zzzzzzzzz"></td>
			</tr>
		<?
	   	}
	}*/ 
}

class CMyCustomEditTabs2 extends CMyCustomEditTabs{
	
	function OnInit() {
		return array(
			"TABSET" => "MyEditTabs1",
         	"GetTabs" => array("CMyCustomEditTabs2", "GetTabs"),
         	"ShowTab" => array("CMyCustomEditTabs", "ShowTab"),
         	"Action" => array("CMyCustomEditTabs2", "Action"),
         	"Check" => array("CMyCustomEditTabs2", "Check"),
      	);
	}

	function Action($arArgs)
	{
	   // Основные данные сохранены. Делаем тут необходимые действия, сохраняем инфо из кастомных табов.
	   // Возвращаем True в случае успеха и False - в случае ошибки
	   // В случае ошибки делаем так же $GLOBALS["APPLICATION"]->ThrowException("Ошибка!!!", "ERROR");
	   
		return true;
	}
	
	function Check($arArgs)
	{
	   // Основные данные еще не сохранялись. Делаем тут разные проверки.
	   // Возвращаем True, если можно все сохранять, иначе False
	   // В случае False делаем так же $GLOBALS["APPLICATION"]->ThrowException("Ошибка!!!", "ERROR");
	   
		return true;
	}
	
	function GetTabs($arArgs)
	{
		// SORT - после какого стандартного таба вставлять. Не установлено - после последнего
	   	$arTabs = array(
	    	array(	"DIV" => "myEdit2", 
	    			"TAB" => "Mega Edit Tab 2", 
	    			"ICON" => "iblock_element2", 
	    			"TITLE" => "Mega Edit Tab 2", 
	    			"SORT" => 1),
	   	);
	   	return $arTabs;
	}
	
/*	function ShowTab($divName, $arArgs, $bVarsFromForm)
	{
	   	if ($divName == "myEdit2")
	   	{
	    ?>
			<tr>
			   <td width="40%">Введите мега инфу в это мега поле;-):</td>
			   <td width="60%"><input type="text" name="zzzzzzzzz"></td>
			</tr>
		<?
	   	}
	}*/
} 
 
?>