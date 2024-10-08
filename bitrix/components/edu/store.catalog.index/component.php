<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arParams['CACHE_GROUPS'] = $arParams['CACHE_GROUPS'] == 'N' ? 'N' : 'Y';

if ($this->StartResultCache(false, $arParams['CACHE_GROUPS'] == 'Y' ? $USER->GetGroups() : false))
{
	if (!CModule::IncludeModule('catalog'))
	{
		$this->AbortResultCache();
		return;
	}

	$dbRes = CCatalog::GetList(
		array(),
		array('LID' => SITE_ID)
	);

	$arCatalog = array();
	while ($arRes = $dbRes->Fetch())
	{
		$arCatalog[$arRes['IBLOCK_ID']] = array(
			'IBLOCK_ID' => $arRes['IBLOCK_ID'],
			'NAME' => $arRes['NAME'],
		);
	}

	if (count($arCatalog) > 0)
	{
		$dbRes = CIBlock::GetList(
			array('SORT' => 'ASC', 'NAME' => 'ASC'),
			array('ID' => array_keys($arCatalog))
		);
		$dbRes = new CIBlockResult($dbRes);
		while ($arRes = $dbRes->GetNext())
		{
			if(defined("BX_COMP_MANAGED_CACHE"))
				$GLOBALS["CACHE_MANAGER"]->RegisterTag("iblock_id_".$arRes["ID"]);

			if($arRes["ACTIVE"] == "Y")
			{
				if ($arRes['PICTURE'])
					$arRes['PICTURE'] = CFile::GetFileArray($arRes['PICTURE']);

				$arCatalog[$arRes['ID']] = array_merge($arCatalog[$arRes['ID']], array(
					'ID' => $arRes['ID'],
					'LIST_PAGE_URL' => $arRes['LIST_PAGE_URL'],
					'PICTURE' => $arRes['PICTURE'],
					'DESCRIPTION' => $arRes['DESCRIPTION_TYPE'] == 'text' ? $arRes['DESCRIPTION'] : $arRes['~DESCRIPTION'],
				));
				$arResult[$arRes['ID']] = $arCatalog[$arRes['ID']];
			}
		}
	}

	if(defined("BX_COMP_MANAGED_CACHE"))
		$GLOBALS["CACHE_MANAGER"]->RegisterTag("iblock_id_new");

	foreach ($arResult as $arCat)
	{
		$dbRes = CIBlockSection::GetList(
			array('SORT' => 'ASC', 'NAME' => 'ASC'),
			array('ACTIVE' => 'Y', 'DEPTH_LEVEL' => 1, 'IBLOCK_ID' => $arCat['ID'])
		);

		$arResult[$arCat['ID']]['CHILDREN'] = array();
		while ($arRes = $dbRes->GetNext())
		{
			$arResult[$arCat['ID']]['CHILDREN'][$arRes['ID']] = array(
				'ID' => $arRes['ID'],
				'NAME' => $arRes['NAME'],
				'SECTION_PAGE_URL' => $arRes['SECTION_PAGE_URL'],
			);
		}
	}

	$this->IncludeComponentTemplate();
}

if (count($arResult) == 1)
{
	$arCat = array_shift($arResult);
	LocalRedirect($arCat['LIST_PAGE_URL']);
}

?>