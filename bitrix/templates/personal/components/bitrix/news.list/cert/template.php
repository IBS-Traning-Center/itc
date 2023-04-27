<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (count($arResult["ITEMS"])!=0) {?>
<ul class="cert-list">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<li>
		<a href="/cert/<?=$arItem["PROPERTIES"]["CERT"]["VALUE"]?>">
			<img src="/images/cert-preview-new.jpg" alt="" width="150"><?=$arItem["COURSE_NAME"]?>
		</a>
	</li>

<?endforeach;?>
</ul>
Вам доступна онлайн-версия полученных сертификатов, ссылки на которые Вы cможете добавить в свое резюме или в свой профиль.  Вы также можете распечатать сертификаты при необходимости.<br/>

<?} else {?>
	<p style="font-size: 14px; margin-bottom: 20px;" >В настоящий момент у вас нет активных курсов</p>
<?}?>
