<?

class CIBlockPropertyElementListGeopointTypes
{
	function GetUserTypeDescription()
	{
		return array(
			"PROPERTY_TYPE"		=>"E",
			"USER_TYPE"			=>"EList",
			"DESCRIPTION"		=>GetMessage("IBLOCK_PROP_ELIST_DESC"),
			"GetPropertyFieldHtml"	=>array("CIBlockPropertyElementList","GetPropertyFieldHtml"),
		);
	}
	//PARAMETERS:
	//$arProperty - b_iblock_property.*
	//$value - array("VALUE","DESCRIPTION") -- here comes HTML form value
	//strHTMLControlName - array("VALUE","DESCRIPTION")
	//return:
	//safe html
	function GetPropertyFieldHtml($arProperty, $value, $strHTMLControlName)
	{
		static $cache = array();
		$IBLOCK_ID = $arProperty["LINK_IBLOCK_ID"];
		if(!array_key_exists($IBLOCK_ID, $cache))
		{
			$arSelect = array(
				"ID",
				"NAME",
			);
			$arFilter = array (
				"IBLOCK_ID" => $arProperty["LINK_IBLOCK_ID"],
				//"SECTION_ID" => $arProperty["SECTION_ID"],
				//"ACTIVE" => "N",
				"CHECK_PERMISSIONS" => "Y",
			);
			$arOrder = array(
				"NAME" => "ASC",
				"ID" => "ASC",
			);
			$cache[$IBLOCK_ID] = array();
			$rsItems = CIBlockElement::GetList($arOrder, $arFilter, false, false, $arSelect);
			while($arItem = $rsItems->GetNext())
				$cache[$IBLOCK_ID][] = $arItem;

		}
		$html = '<div id="types_of_section"><select name="'.$strHTMLControlName["VALUE"].'">
		<option value=""> </option>';
		foreach($cache[$IBLOCK_ID] as $arItem)
		{
			$html .= '<option value="'.$arItem["ID"].'"';
			if($value["VALUE"] == $arItem["~ID"])
				$html .= ' selected';
			$html .= '>'.$arItem["NAME"].'</option>';
		}
		$html .= '</select></div>';
		return  $html;
	}
}

if (isset($_POST["SEL_NAME"])) {
//print "</pre>";

// подключение служебной части пролога
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");

$arProperty = array();

$arProperty["LINK_IBLOCK_ID"] = $_POST["IBLOCK_ID"];
$arProperty["SECTION_ID"] = $_POST["SECTION_ID"];
echo CIBlockPropertyElementListGeopointTypes::GetPropertyFieldHtml($arProperty, null, array("VALUE" => $_POST["SEL_NAME"]));

// подключение служебной части эпилога
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
}
?>