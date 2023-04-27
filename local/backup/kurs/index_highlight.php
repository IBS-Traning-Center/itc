<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?> 
<?GLOBAL $USER?>

<?$APPLICATION->IncludeComponent(
"luxoft:sef.comp",
"",
Array(
),
false
);?>

	<?GLOBAL $COURSE_ID?>
	<?$arSelect = Array("ID", "PROPERTY_short_descr");
	$arFilter = Array("ID"=>$COURSE_ID);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
	while($ob = $res->GetNextElement())
	{
		$arFields = $ob->GetFields();
		if (strlen($arFields["PROPERTY_SHORT_DESCR_VALUE"])>0) {
			echo "<div class='headline_image'><p>";
			echo $arFields["PROPERTY_SHORT_DESCR_VALUE"];
			echo "</p></div>";
		}
	}?>
