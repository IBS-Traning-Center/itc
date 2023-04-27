<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (count($arResult["ITEMS"])>0){ ?>
<div id="lux_nearest" align="left" style="text-transform: uppercase; font-size: 14px;font-family: 'Courier New', Courier, FreeMono; font-weight: normal; color:#000000; text-decoration: none;margin-bottom:4px; ">Ближайшие мероприятия:</div>
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<?
			$arr = ParseDateTime($arItem['PROPERTIES']['startdate']['VALUE'], "DD.MM.YYYY HH:MI:SS");
			$arItem['PROPERTIES']['startdate']['VALUE'] = $arr["DD"].".".$arr["MM"].".".$arr["YYYY"];
			?>
				<span style="display:block; padding:0px 0px 3px 0px; font-size: 12px; font-family: 'Courier New', Courier, FreeMono; font-weight: normal; color:#666666; font-decoration: none;">
				<a  target="_blank" style="font-size: 12px; color:#42AB1F;font-family: 'Courier New', Courier, FreeMono; text-decoration: none;" href="http://ibs-training.ru/events/seminar/<?=$arItem['ID']?>/?r1=qasib_ru&r2=schedule"><?=$arItem["NAME"] ?></a>
				<?if ($arItem['PROPERTIES']['type_event']['VALUE_ENUM_ID'] == 92){?>
					<strong>Вебинар</strong><? }else {?><strong>Семинар:</strong> <?=$arItem['PROPERTIES']['location']['VALUE']?>
				<? } ?>,
				<?= $arItem['PROPERTIES']['startdate']['VALUE'] ?>
				</span>
	<?endforeach;?>
<? } ?>

