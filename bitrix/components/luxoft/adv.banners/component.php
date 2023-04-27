<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (CModule::IncludeModule("advertising"))	{ 
	$cache = new CPHPCache();
	$cache_time = 7200;
	$cache_id = 'banner'.$arParams["TYPE"];
	$cache_path = '/banners/';
	if ($cache_time > 0 && $cache->InitCache($cache_time, $cache_id, $cache_path))
	{
		$res = $cache->GetVars();
	
		if (is_array($res["BANNERS"]) && (count($res["BANNERS"]) > 0))
		$arResult["BANNERS"] = $res["BANNERS"];
		
		
	} 
	
	if (count($arResult["BANNERS"])==0)
	{
		
		$arFilter["TYPE_SID"]=$arParams["TYPE"];
		$arFilter["LAMP"]="GREEN";
		$rsBanners = CAdvBanner::GetList($by, $order, $arFilter, $is_filtered, "N");
		while($arBanner = $rsBanners->Fetch())
		{	
			$arBanner["IMAGE"]=CFile::GetFileArray($arBanner["IMAGE_ID"]);
			$arResult["BANNERS"][]=$arBanner;
		}
		if ($cache_time > 0)
	   {
			 $cache->StartDataCache($cache_time, $cache_id, $cache_path);
			 $cache->EndDataCache(array("BANNERS"=>$arResult["BANNERS"]));
	   }
	}
}
$this->IncludeComponentTemplate();

?>