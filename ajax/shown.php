<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?if ($_REQUEST["shown"]=="yes") {?>
	<?$_SESSION["ALREADY_SHOWN"]="Y"?>
<?}?>