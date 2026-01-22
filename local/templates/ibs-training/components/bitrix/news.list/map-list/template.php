<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(false);
?>
<?if ($_SESSION["cityID"]>0) {?>
	<?$activeID=$_SESSION["cityID"]?>
<?} else {?>
	<?$activeID=CITY_ID_MOSCOW?>
<?}?>
<div class="maps-list">

<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="location-tab map_<?=$arItem["PROPERTIES"]["CITY"]["VALUE"]?> <?if ($arItem["PROPERTIES"]["CITY"]["VALUE"]==$activeID) {?>active<?}?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
	<?$arCoords = split(",",  $arItem["PROPERTIES"]["MAP"]["VALUE"]);?>
	<?$arCoordinatesForMap=array(
		array(
			'TEXT' => "Luxoft Training",
			'LON' => $arCoords[1],
			'LAT' => $arCoords[0]
		))
	?>

	<?$arItem['MAP_DATA'] = serialize(
      array(
        'yandex_lat' => $arCoords[0],  //широта центра карты
        'yandex_lon' => $arCoords[1],  //долгота центра карты
        'yandex_scale' => 15, //начальный масштаб
        'PLACEMARKS' => $arCoordinatesForMap //координаты
        )
      );?>

	<div class="maps">
	 <?
	 $APPLICATION->IncludeComponent(
	"bitrix:map.yandex.view",
	".default",
		Array(
			"INIT_MAP_TYPE" => "ROADMAP",
			"MAP_DATA" => $arItem['MAP_DATA'],
			"MAP_WIDTH" => "100%",
			"MAP_HEIGHT" => "360",
			"CONTROLS" => array(0=>"SMALL_ZOOM_CONTROL",1=>"TYPECONTROL",2=>"SCALELINE",),
			"OPTIONS" => array(0=>"ENABLE_SCROLL_ZOOM",1=>"ENABLE_DBLCLICK_ZOOM",2=>"ENABLE_DRAGGING",3=>"ENABLE_KEYBOARD",),
			"MAP_ID" => "gm_".$arItem["PROPERTIES"]["CITY"]["VALUE"]
		)
	);?>
	</div>
				<div class="map-info flexbox-wrap row">
					<div class="small-2">
						<div class="address">
							<?=htmlspecialchars_decode($arItem["PROPERTIES"]["ADDRESS"]["VALUE"]["TEXT"])?>
						</div>
						<?if  (strlen($arItem["PROPERTIES"]["ADDITION"]["VALUE"]["TEXT"])>0) {?>
						<div class="addition">
							<h3>Примечание</h3>
							<p><?=htmlspecialchars_decode($arItem["PROPERTIES"]["ADDITION"]["VALUE"]["TEXT"])?></p>
						</div>
						<?}?>
					</div>
					<div class="small-2">
						<div class="email">
							<h3>Электронный адрес</h3>
							<a href="mailto:<?=EMAIL_ADDRESS?>"><?=EMAIL_ADDRESS?></a>
						</div>
						<div class="phones">
							<h3>Телефоны</h3>
							<?=htmlspecialchars_decode($arItem["PROPERTIES"]["PHONES"]["VALUE"]["TEXT"])?>
						</div>
					</div>
				</div>

	</div>
<?endforeach;?>

</div>
