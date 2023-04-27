<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
header('Content-Type: image/gif');
echo base64_decode('R0lGODlhAQABAJAAAP8AAAAAACH5BAUQAAAALAAAAAABAAEAAAICBAEAOw==');
CModule::IncludeModule("iblock");
if ($_GET["counter_id"]){
	$arSelect = Array("ID", "NAME", "PREVIEW_TEXT");
	$arFilter = Array("IBLOCK_ID"=>113, "NAME"=> intval($_GET["counter_id"]));
	$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
	while($ob = $res->GetNextElement())
	{
		$arFields = $ob->GetFields();
		
	}
	if (intval($arFields["ID"])>0) {
		//echo "123";
		$el = new CIBlockElement;
		$count=intval($arFields["PREVIEW_TEXT"]);
		$count++;
		$arLoadProductArray = Array(
		   "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
		  "IBLOCK_ID"      => 113,
		  "NAME"           => intval($_GET["counter_id"]),
		  "ACTIVE"         => "Y",            // активен
		  "PREVIEW_TEXT"   => $count,
		);
		$res = $el->Update($arFields["ID"], $arLoadProductArray);
	} else {
		//echo "321";
		$el = new CIBlockElement;
		$arLoadProductArray = Array(
		  
		  "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
		  "IBLOCK_ID"      => 113,
		  "NAME"           => intval($_GET["counter_id"]),
		  "ACTIVE"         => "Y",            // активен
		  "PREVIEW_TEXT"   => "1",
		);

		$PRODUCT_ID = $el->Add($arLoadProductArray);
		//print_r($PRODUCT_ID);
		//echo $el->LAST_ERROR;
	}
}