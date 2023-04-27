<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (count($arResult["ITEMS"])!=0) {?>
<div class="news-list">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<?if (count($arItem["FILE"])>0) {?>
	<div id="<?=$this->GetEditAreaId($arItem['ID']);?>" class="library-box">
		<div class="title">
			<?//echo "<pre>"?>
			<?//print_r($arItem["COURSE-INFO"]);?>
			<?//echo "</pre>";?>
			<div class="r">
				<span class="time"><?=$arItem["COURSE-INFO"]["PROPERTY_SCHEDULE_DURATION_VALUE"]?> ч.</span>
				<span class="date"><?=$arItem["COURSE-INFO"]["PROPERTY_STARTDATE_VALUE"]?><?if (strlen($arItem["COURSE-INFO"]["PROPERTY_ENDDATE_VALUE"])>0) {?> - <?=$arItem["COURSE-INFO"]["PROPERTY_ENDDATE_VALUE"]?><?}?></span>
			</div>
			<div class="holder">
				<?//echo "<pre>";?>
				<?//print_r(count($arItem["FILE"]))?>
				<?//echo "</pre>";?>
				<h2><?=$arItem["COURSE-INFO"]["PROPERTY_SCHEDULE_COURSE_NAME"]?></h2>
				<dl>
					<dt>Тренер:</dt>
					<dd><a target="_blank" href="/about/experts/<?=$arItem["COURSE-INFO"]["TRENER"]["CODE"]?>.html"><?=$arItem["COURSE-INFO"]["TRENER"]["NAME"]?></a></dd>
				</dl>
				</div>
				</div>
				<div class="library-table">
					<table>
						<tbody>
						<tr>
						<?$t=0;?>
						
						
						<?foreach ($arItem["FILE"] as $arFile) {?>
							<?$arFile=CFile::GetFileArray($arFile);?>							
							<?$arLast=preg_split("#\.#", $arFile["FILE_NAME"])?>
							<?$format=end($arLast);?>
							<?$filename=""?>
							<?if ($format=="doc" || $format=="docx") {?>
								<?$filename=SITE_TEMPLATE_PATH."/images/ico-doc.png"?>
							<?} elseif ($format=="xls" || $format=="xlsx") {?>
								<?$filename=SITE_TEMPLATE_PATH."/images/ico-xls.png"?>
							<?} elseif ($format=="pdf") {?>
								<?$filename=SITE_TEMPLATE_PATH."/images/ico-pdf.png"?>
							<?}?>
							<?if ($t>2) {?>
								<?echo "</tr><tr>";?>
								<?$t=0;?>
							<?}?>
							<td>
								<div class="vcenter">
									<img src="<?=$filename?>" alt="">
									<div class="holder"><a href="<?=$arFile["SRC"]?>"><?=$arFile["FILE_NAME"]?></a></div>
								</div>
							</td>
							<?$t++?>
							
						<?}?>
						</tr>
						</tbody></table>
					</div>
</div>
	<?}?>
<?endforeach;?>

</div>
<?} else {?>
	<p style="font-size: 14px; margin-bottom: 20px;" >Материалы библиотеки будут доступны после начала обучения</p>
<?}?>
