<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
require_once($_SERVER["DOCUMENT_ROOT"].$componentPath."/functions.php");

//Menu depth level
if (isset($arParams["MAX_LEVEL"]) && 1 < intval($arParams["MAX_LEVEL"]) && intval($arParams["MAX_LEVEL"]) < 5)
	$arParams["MAX_LEVEL"] = intval($arParams["MAX_LEVEL"]);
else
	$arParams["MAX_LEVEL"] = 1;

//Root menu type
if (isset($arParams["ROOT_MENU_TYPE"]) && strlen($arParams["ROOT_MENU_TYPE"]) > 0)
	$arParams["ROOT_MENU_TYPE"] = htmlspecialchars(trim($arParams["ROOT_MENU_TYPE"]));
else
	$arParams["ROOT_MENU_TYPE"] = "left";

//Child menu type
if (isset($arParams["CHILD_MENU_TYPE"]) && strlen($arParams["CHILD_MENU_TYPE"]) > 0)
	$arParams["CHILD_MENU_TYPE"] = htmlspecialchars(trim($arParams["CHILD_MENU_TYPE"]));
else
	$arParams["CHILD_MENU_TYPE"] = "left";

//Include menu_ext.php
$arParams["USE_EXT"] = (isset($arParams["USE_EXT"]) && $arParams["USE_EXT"] == "Y" ? true : false);

//my
if (isset($_SERVER["REAL_FILE_PATH"])) {
	$dir_exclude = substr(strrchr($_SERVER["REAL_FILE_PATH"], "/"), 1);
	$curDir = str_replace($dir_exclude, "", $_SERVER["REAL_FILE_PATH"]);

 } else {
	$curDir = $APPLICATION->GetCurDir();
}

$str_count = substr_count($curDir, "/");  //// my
if ($str_count>2) {
	$mainDir = explode("/", $curDir);
	$curDir = "/$mainDir[1]/";
}

//Read root menu
$menu = new CMenu($arParams["ROOT_MENU_TYPE"]);
$menu->Init($curDir, $arParams["USE_EXT"], $componentPath."/stub.php");

$menu->RecalcMenu();

$arResult = Array();

$menu->MenuDir = $APPLICATION->GetCurDir(); //// my
   //echo $menu->MenuDir;
//Read child menu recursive
if ($arParams["MAX_LEVEL"] > 1)
{
	_GetChildMenuRecursive(
		$menu->arMenu,
		$arResult,
		$arParams["CHILD_MENU_TYPE"],
		$arParams["USE_EXT"],
		$menu->template,
		$currentLevel = 1,
		$arParams["MAX_LEVEL"]
	);
}
else
{
	$arResult = $menu->arMenu;
	for ($menuIndex = 0, $menuCount = count($menu->arMenu); $menuIndex < $menuCount; $menuIndex++)
	{
		//Menu from iblock (bitrix:menu.sections)
		if (is_array($arResult[$menuIndex]["PARAMS"]) && isset($arResult[$menuIndex]["PARAMS"]["FROM_IBLOCK"]))
		{
			$arResult[$menuIndex]["DEPTH_LEVEL"] = $arResult[$menuIndex]["PARAMS"]["DEPTH_LEVEL"];
			$arResult[$menuIndex]["IS_PARENT"] = $arResult[$menuIndex]["PARAMS"]["IS_PARENT"];
		}
		else
		{
			//Menu from files
			$arResult[$menuIndex]["DEPTH_LEVEL"] = 1;
			$arResult[$menuIndex]["IS_PARENT"] = false;
		}
	}
}

unset($menu->arMenu);

if (IsModuleInstalled('fileman'))
{
	//Icons
	$menuDir = $menu->MenuDir;
	$menuExists = (strlen($menuDir) > 0);

	$bMenuAdd =
		$APPLICATION->GetPublicShowMode() == 'configure'
		&&
		(
			$APPLICATION->GetCurDir() != $menu->MenuDir
			||
			!$menuExists
		)
		&& $USER->CanDoOperation('fileman_add_element_to_menu')
		&& $USER->CanDoOperation('fileman_edit_menu_elements')
		&& $USER->CanDoFileOperation('fm_add_to_menu',  Array(SITE_ID, $menu->MenuDir.".".$menu->type.".menu.php"));
		// this one is checking l8r
		//&& $USER->CanDoFileOperation('fm_create_new_file', Array(SITE_ID, $menu->MenuDir.".".$menu->type.".menu.php"));

	$bMenuEdit =
		$menuExists
		&& $USER->CanDoOperation('fileman_add_element_to_menu')
		&& $USER->CanDoOperation('fileman_edit_menu_elements')
		&& $USER->CanDoFileOperation('fm_add_to_menu',  Array(SITE_ID, $menu->MenuDir.".".$menu->type.".menu.php"))
		&& $USER->CanDoFileOperation('fm_edit_existent_file', Array(SITE_ID, $menu->MenuDir.".".$menu->type.".menu.php"));

	/*
	$displayIcons = (
		$USER->CanDoOperation('fileman_edit_menu_elements') &&
		(
			($menuExists && $USER->CanDoFileOperation('fm_edit_existent_file', Array(SITE_ID, $menu->MenuDir.".".$menu->type.".menu.php")))
			||
			(!$menuExists && $USER->CanDoOperation('fileman_add_element_to_menu'))
		)
	);
	*/

	if ($bMenuAdd)
	{
		$bMenuAdd = false;
		$currentAddDir = $APPLICATION->GetCurDir();

		while (strlen($currentAddDir)>0)
		{
			$currentAddDir = rtrim($currentAddDir, "/");

			if (is_dir($_SERVER["DOCUMENT_ROOT"].$currentAddDir) && $USER->CanDoFileOperation('fm_create_new_file', Array(SITE_ID, $currentAddDir."/.".$menu->type.".menu.php")))
			{
				$bMenuAdd = true;
				$menuDir = $currentAddDir;
				break;
			}

			$position = strrpos($currentAddDir, "/");
			if ($position === false)
				break;

			$currentAddDir = substr($currentAddDir, 0, $position+1);
		}
	}

	$arIcons = array();

	if ($bMenuEdit)
	{
		$menu_edit_url = $APPLICATION->GetPopupLink(array(
			"URL"=> "/bitrix/admin/public_menu_edit.php?lang=".LANGUAGE_ID.
				"&site=".SITE_ID."&back_url=".urlencode($_SERVER["REQUEST_URI"]).
				"&path=".urlencode($menu->MenuDir)."&name=".$menu->type
			)
		);

		//Icons
		$arIcons[] = Array(
			"URL"		=> 'javascript:'.$menu_edit_url,
			"ICON"		=> "menu-edit",
			"TITLE"		=> ($menuExists? GetMessage("MAIN_MENU_EDIT") : GetMessage("MAIN_MENU_ADD")),
			"DEFAULT"	=> ($APPLICATION->GetPublicShowMode() != 'configure' ? true : false),
		);

		//panel
		$static_var_name = 'BX_TOPPANEL_MENU_EDIT_'.$menu->type;

		if (!defined($static_var_name))
		{
			define($static_var_name, 1);

			$curDir = $APPLICATION->GetCurDir();
			$bDefaultItem = ($curDir == "/" && $menu->type == "top" || $curDir <> "/" && $menu->type == "left");
			$arMenuTypes = GetMenuTypes(SITE_ID);
			$buttonID = "menus";

			$APPLICATION->AddPanelButton(array(
				"HREF"		=> ($bDefaultItem ? 'javascript:'.$menu_edit_url : ''),
				"ID"		=> $buttonID,
				"ICON"		=> "icon-menu",
				"ALT"		=> GetMessage('MAIN_MENU_TOP_PANEL_BUTTON_ALT')
					.($bDefaultItem ? ' '.'&quot;'.(isset($arMenuTypes[$menu->type]) ? $arMenuTypes[$menu->type]:$menu->type).'&quot;' : ''),
				"TEXT"		=> GetMessage("MAIN_MENU_TOP_PANEL_BUTTON_TEXT"),
				"MAIN_SORT"	=> "300",
				"SORT"		=> 10,
				"RESORT_MENU"=>true,
				//"MODE"		=> array("view", "edit"),
			), $bDefaultItem);

			$aMenuItem =  array(
				"TEXT"		=> GetMessage(
					'MAIN_MENU_TOP_PANEL_ITEM_TEXT',
					array('#MENU_TITLE#' => (isset($arMenuTypes[$menu->type]) ? $arMenuTypes[$menu->type] : $menu->type))
				),
				"TITLE"		=> GetMessage(
					'MAIN_MENU_TOP_PANEL_ITEM_ALT',
					array('#MENU_TITLE#' => (isset($arMenuTypes[$menu->type]) ? $arMenuTypes[$menu->type] : $menu->type))
				),
				"SORT" => "100",
				"ICON"		=> "menu-edit",
				"ACTION"	=> $menu_edit_url,
				"DEFAULT"	=> $bDefaultItem,
			);
			$APPLICATION->AddPanelButtonMenu($buttonID, $aMenuItem);
		}
	}

	if ($bMenuAdd)
	{
		$menu_edit_url = $APPLICATION->GetPopupLink(array(
			"URL" => "/bitrix/admin/public_menu_edit.php?new=Y&lang=".LANGUAGE_ID.
				"&site=".SITE_ID."&back_url=".urlencode($_SERVER["REQUEST_URI"]).
				"&path=".urlencode($currentAddDir)."&name=".$menu->type
			)
		);

		//Icons
		$arIcons[] = Array(
			"URL"		=> 'javascript:'.$menu_edit_url,
			"ICON"		=> "menu-edit",
			"TITLE"		=> GetMessage('MAIN_MENU_ADD_NEW'),
			"DEFAULT"	=> (!$bMenuEdit && $APPLICATION->GetPublicShowMode() != 'configure' ? true : false),
		);

		//panel
		$static_var_name = 'BX_TOPPANEL_MENU_ADD_'.$menu->type;

		if (!defined($static_var_name))
		{
			define($static_var_name, 1);

			$curDir = $APPLICATION->GetCurDir();
			$bDefaultItem = ($curDir == "/" && $menu->type == "top" || $curDir <> "/" && $menu->type == "left");
			$arMenuTypes = GetMenuTypes(SITE_ID);
			$buttonID = "menus";

			$APPLICATION->AddPanelButton(array(
				"HREF"		=> ($bDefaultItem ? 'javascript:'.$menu_edit_url : ''),
				"ID"		=> $buttonID,
				"ICON"		=> "icon-menu",
				"ALT"		=> GetMessage('MAIN_MENU_TOP_PANEL_BUTTON_ALT')
					.($bDefaultItem ? ' '.'&quot;'.(isset($arMenuTypes[$menu->type]) ? $arMenuTypes[$menu->type]:$menu->type).'&quot;' : ''),
				"TEXT"		=> GetMessage("MAIN_MENU_TOP_PANEL_BUTTON_TEXT"),
				"MAIN_SORT"	=> "300",
				"SORT"		=> 10,
				"RESORT_MENU"=>true,
				//"MODE"		=> array("configure"),
			), false);

			$aMenuItem =  array(
				"TEXT"		=> GetMessage(
					'MAIN_MENU_ADD_TOP_PANEL_ITEM_TEXT',
					array('#MENU_TITLE#' => (isset($arMenuTypes[$menu->type]) ? $arMenuTypes[$menu->type] : $menu->type))
				),
				"TITLE"		=> GetMessage(
					'MAIN_MENU_ADD_TOP_PANEL_ITEM_ALT',
					array('#MENU_TITLE#' => (isset($arMenuTypes[$menu->type]) ? $arMenuTypes[$menu->type] : $menu->type))
				),
				"SORT" => "200",
				"ICON"		=> "menu-edit",
				"ACTION"	=> $menu_edit_url,
				"DEFAULT"	=> false,
			);

			if (!defined('BX_TOPPANEL_MENU_SEPARATOR_INCLUDED'))
			{
				$APPLICATION->AddPanelButtonMenu($buttonID, array('SEPARATOR' => "Y", "SORT" => "150"));
				define('BX_TOPPANEL_MENU_SEPARATOR_INCLUDED', 1);
			}

			$APPLICATION->AddPanelButtonMenu($buttonID, $aMenuItem);
		}
	}

	if ($bMenuAdd || $bMenuEdit)
			$this->AddIncludeAreaIcons($arIcons);
}

$this->IncludeComponentTemplate();
?>