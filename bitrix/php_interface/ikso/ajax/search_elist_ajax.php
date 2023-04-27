<?
define("STOP_STATISTICS", true);
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_js.php");
if(CModule::IncludeModule("iblock"))
{
	CUtil::decodeURIComponent($_REQUEST);
	if(!empty($_REQUEST["search"]))
	{
		$arResult = array();
		$db_res = CIBlockElement::GetList(
            array("CODE" => "ASC"),
            array(
                "IBLOCK_ID" => intval($_REQUEST["IBLOCK_ID"]),
                 array(
			        "LOGIC" => "OR",
			        array("%NAME" => $_REQUEST["search"]),
			        array("%CODE" => $_REQUEST["search"]),
			    ),
				"ACTIVE"=> "Y",
                "CHECK_PERMISSIONS" => "N",
                "SHOW_NEW" => "Y"
            ),
            false,
            array('nTopCount' => 10),
            array(
                "ID",
                "IBLOCK_ID",
                "NAME",
                "CODE"
            )
        );
		if($db_res)
		{
			while($res = $db_res->Fetch())
			{
				$arResult[] = array(
                    "ID" => $res["ID"],
					"NAME" => $res["NAME"],
					"CODE" => $res["CODE"],
				);
			}
		}
		?><?=CUtil::PhpToJSObject($arResult)?><?
	}
}
require_once($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/include/epilog_admin_js.php");
?>