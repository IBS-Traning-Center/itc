<?
if (!function_exists("_GetChildMenuRecursive"))
{
	function _GetChildMenuRecursive(&$arMenu, &$arResult, $menuType, $use_ext, $menuTemplate, $currentLevel, $maxLevel)
	{
		if ($currentLevel > $maxLevel)
			return;

		for ($menuIndex = 0, $menuCount = count($arMenu); $menuIndex < $menuCount; $menuIndex++)
		{
			//Menu from iblock (bitrix:menu.sections)
			if (is_array($arMenu[$menuIndex]["PARAMS"]) && isset($arMenu[$menuIndex]["PARAMS"]["FROM_IBLOCK"]))
			{
				$iblockSectionLevel = intval($arMenu[$menuIndex]["PARAMS"]["DEPTH_LEVEL"]);
				if ($currentLevel > 1)
					$iblockSectionLevel = $iblockSectionLevel + $currentLevel - 1;

				$arResult[] = $arMenu[$menuIndex] + Array("DEPTH_LEVEL" => $iblockSectionLevel, "IS_PARENT" => $arMenu[$menuIndex]["PARAMS"]["IS_PARENT"]);
				continue;
			}

			//Menu from files
			if ($currentLevel < $maxLevel)
			{
				$menu = new CMenu($menuType);
				$success = $menu->Init($arMenu[$menuIndex]["LINK"], $use_ext, $menuTemplate, $onlyCurrentDir = true);
				echo "$arMenu[$menuIndex][LINK]<br/>";
				echo "use_ext=$use_ext<br/>";
				echo "menuTemplate= $menuTemplate<br/>";
				echo "onlyCurrentDir=$onlyCurrentDir<br/>";
				continue;
				$subMenuExists = ($success && count($menu->arMenu) > 0);

				$arResult[] = $arMenu[$menuIndex] + Array("DEPTH_LEVEL" => $currentLevel, "IS_PARENT" => $subMenuExists);

				if ($subMenuExists)
				{
					$menu->RecalcMenu();
					_GetChildMenuRecursive($menu->arMenu, $arResult, $menuType, $use_ext, $menuTemplate, $currentLevel+1, $maxLevel);
				}
			}
			else
			{
				$arResult[] = $arMenu[$menuIndex] + Array("DEPTH_LEVEL" => $currentLevel, "IS_PARENT" => false);
			}

		}
	}
}
?>