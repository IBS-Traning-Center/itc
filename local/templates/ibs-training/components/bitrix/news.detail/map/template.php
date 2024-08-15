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
$this->setFrameMode(true);
?>
<div class="map-detail">
	<h2><?=$arResult["NAME"]?></h2>
	<?$arCoords = explode(",", $arResult["PROPERTIES"]["MAP"]["VALUE"]);?>
	<?$arCoordinatesForMap=array(
		array(
			'TEXT' => "IBS Training Center",
			'LON' => $arCoords[1],
			'LAT' => $arCoords[0]
		))
	?>

	<?$arResult['MAP_DATA'] = serialize(
      array(
        'yandex_lat' => $arCoords[0],  //широта центра карты
        'yandex_lon' => $arCoords[1],  //долгота центра карты
        'yandex_scale' => 15, //начальный масштаб
        'PLACEMARKS' => $arCoordinatesForMap //координаты
        )
      );?>

	<div class="maps">
	 <?$APPLICATION->IncludeComponent(
	"bitrix:map.yandex.view",
	".default",
		Array(
			"INIT_MAP_TYPE" => "ROADMAP",
			"MAP_DATA" => $arResult['MAP_DATA'],
			"MAP_WIDTH" => "100%",
			"MAP_HEIGHT" => "360",
			"CONTROLS" => array(0=>"SMALL_ZOOM_CONTROL",1=>"TYPECONTROL",2=>"SCALELINE",),
			"OPTIONS" => array(0=>"ENABLE_SCROLL_ZOOM",1=>"ENABLE_DBLCLICK_ZOOM",2=>"ENABLE_DRAGGING",3=>"ENABLE_KEYBOARD",),
			"MAP_ID" => "gm_1",
			"API_KEY" => "57db4a25-47aa-4d58-8502-6fd07bdcb994"
		)
	);?>
	</div>
	<div itemscope itemtype="http://schema.org/Organization" class="map-info flexbox-wrap row">
        <span style="position: absolute; visibility: hidden;" itemprop="name">IBS Training Center</span>
        <div class="small-2">
            <div class="address" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                <p itemprop="streetAddress"><?= htmlspecialchars_decode($arResult["PROPERTIES"]["ADDRESS"]["VALUE"]["TEXT"]) ?></p>
            </div>
            <? if (
                    is_array($arResult) &&
                    is_array($arResult["PROPERTIES"]) &&
                    is_array($arResult["PROPERTIES"]["ADDITION"]) &&
                    is_array($arResult["PROPERTIES"]["ADDITION"]["VALUE"]) &&
                    strlen($arResult["PROPERTIES"]["ADDITION"]["VALUE"]["TEXT"]) > 0
            ) { ?>
                <div class="addition">
                    <h3>Примечание</h3>
                    <p>
                        <?= htmlspecialchars_decode($arResult["PROPERTIES"]["ADDITION"]["VALUE"]["TEXT"]) ?>
                    </p>
                </div>
            <? } ?>
        </div>
        <div class="small-2">
            <div class="email">
                <h3>Электронный адрес</h3>
                <a itemprop="email" href="mailto:<?= EMAIL_ADDRESS ?>"><?= EMAIL_ADDRESS ?></a>
            </div>
            <div class="phones">
                <h3>Телефоны</h3>
                <span itemprop="telephone"><?= htmlspecialchars_decode($arResult["PROPERTIES"]["PHONES"]["VALUE"]["TEXT"]) ?></span>
            </div>
        </div>
	</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div id="content-map-info" class="bg not-main-page">
	<div class="frame p-b-35">
		<?if (count($arResult["PROPERTIES"]["MORE_PHOTOS"]["VALUE"])>1) {?>
		<div class="photos-wraper clearfix">
			<?foreach ($arResult["PROPERTIES"]["MORE_PHOTOS"]["VALUE"] as $photoID) {?>
			<?$arPhoto=CFile::GetFileArray($photoID);?>
			<div class="photo-item">
				<a data-fancybox="gallery" href="<?=$arPhoto["SRC"]?>"><img src="<?=$arPhoto["SRC"]?>" alt=""/></a>
			</div>
			<?}?>
		</div>
		<?}?>
		<?if (
                is_array($arResult) &&
                is_array($arResult["PROPERTIES"]) &&
                is_array($arResult["PROPERTIES"]["HOW_TO_GET"]) &&
                is_array($arResult["PROPERTIES"]["HOW_TO_GET"]["VALUE"]) &&
                $arResult["PROPERTIES"]["HOW_TO_GET"]["VALUE"]["TEXT"]
        ) {?>
		<h3>Проезд</h3>
		<div class="map-info-more">
		<?=$arResult["PROPERTIES"]["HOW_TO_GET"]["VALUE"]["TEXT"]?>
		</div>
		<?}?>
		<?if (
                is_array($arResult) &&
                is_array($arResult["PROPERTIES"]) &&
                is_array($arResult["PROPERTIES"]["ATTENTION"]) &&
                is_array($arResult["PROPERTIES"]["ATTENTION"]["VALUE"]) &&
                $arResult["PROPERTIES"]["ATTENTION"]["VALUE"]["TEXT"]
        ) {?>
		<br>
		<div class="map-info-more">
		<?=htmlspecialchars_decode($arResult["PROPERTIES"]["ATTENTION"]["VALUE"]["TEXT"])?>
		</div>
		<?}?>

		<h3>Важно</h3>
		<div class="map-info-more">
		Для получения пропуска в здание необходимо охране предъявить паспорт.
		</div>
	</div>
</div>
<section class="section-box _callback-contacts">
    <div class="section-box__container container">
        <div class="section-box__header">
            <div class="section-box__title"><b>Мы готовы помочь</b><br>
                Отправьте запрос, и наш менеджер свяжется с вами
            </div>
        </div>
        <div class="section-box__content">
            <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH.'/include/callback-contacts.php', [], ['MODE' => 'html']);?>
        </div>
    </div>
</section>
