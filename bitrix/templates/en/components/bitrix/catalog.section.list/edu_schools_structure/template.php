<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<style type="text/css">
table.edu td {
	vertical-align:middle;
}
</style>
<?
$index = 0;
foreach($arResult["SECTIONS"] as $arSection):
?>
<?if ($arSection["DEPTH_LEVEL"]=="2")  {
	$ID_SECTION = $arSection["ID"];
	$arSectionLevel_2[$ID_SECTION]["NAME"] = $arSection["NAME"] ;
	$arSectionLevel_2[$ID_SECTION]["DESC"] = $arSection["DESCRIPTION"] ;
	   	$ar_result=CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID"=>"49", "ID"=>$arSection["ID"]), false, Array("UF_PP_PURPOSE" ));
		if($razdel=$ar_result->GetNext()){ }
		$arSectionLevel_2[$ID_SECTION]["PURPOSE"] = $razdel["UF_PP_PURPOSE"];
 }
//print_r($arSection);
 ?>

<?if (($arSection["DEPTH_LEVEL"]=="3") and ($arSection["IBLOCK_SECTION_ID"]) == $ID_SECTION)  {
	$arSectionLevel_3[$ID_SECTION][$arSection["ID"]] = $arSection["NAME"];
} ?>
<?$index = $index + 1;?>
<?endforeach?>



	<?foreach ($arSectionLevel_3 as $id => $v1) { ?>
	<h2><?=$arSectionLevel_2[$id]['NAME']?></h2>
	<?if (strlen($arSectionLevel_2[$id]['DESC'])>0){?><h3>Целевая аудитория:</h3><p class="indent"> <?=$arSectionLevel_2[$id]['DESC']?></p><? } ?>
	<?if (strlen($arSectionLevel_2[$id]['PURPOSE'])>0){?><h3>Цель:</h3><p class="indent"> <?=$arSectionLevel_2[$id]['PURPOSE']?></p><? } ?>

<!--	<table  class="edu" border="0" cellpadding="5" cellspacing="0" >
		<tbody>
			<tr>
	  			<td width="15%"><p align="left"><?=$arSectionLevel_2[$id]["NAME"]?></p></td>
	   			<td>&nbsp;</td>
				<td>
-->
				<?  $index_count=1;
					foreach ($v1 as $v2 => $nameCategory) {?>

					<table  class="edu" border="0" cellpadding="5" cellspacing="0" >
						<tbody>
							<tr class="edu_header">
								<td colspan=5><p><?=$index_count?>. <?=$nameCategory?></p></td>
							</tr>
							<?
							//сделаем запрос к инфоблок школ(программ подготовки) и получим все курсы категории нашей программы
							// точнее получим ID курса его стоимость и длительнотст
							// второй гетлист - поиск имени курса по его ID
							?>
							<?
							$arSelect = Array("PROPERTY_pp_course", "PROPERTY_pp_price","PROPERTY_pp_duration", "NAME");
						    $arFilter = Array("IBLOCK_ID"=>49, "SECTION_ID"=>$v2);
							$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, $arSelect);
							$sumPrice = 0;
							$sumDuration = 0;
							$index = 0;
							while($ar_fields = $res->GetNext())
								{
							 		$id_course = $ar_fields["PROPERTY_PP_COURSE_VALUE"];
							 		$price = $ar_fields["PROPERTY_PP_PRICE_VALUE"];
							 		$duration = $ar_fields["PROPERTY_PP_DURATION_VALUE"];
							 		$name = $ar_fields["NAME"];

							?>
							<?
								$sumPrice = $sumPrice + $price;
								$sumDuration = $sumDuration + $duration;
								$index = $index + 1;

                                //... второй гетлист - поиск имени курса по его ID
								$arSelectCourses = Array("NAME");
							    $arFilterCourses = Array("IBLOCK_ID"=>6, "ID"=>$id_course);
								$resCourses = CIBlockElement::GetList(Array(), $arFilterCourses, false, false, $arSelectCourses);
								while($ar_fieldsCourses = $resCourses->GetNext())
									{
										$nameCourse = $ar_fieldsCourses["NAME"];
									}
                            //сформируем массив
							$arCourses[$id_course]['PRICE'] = $price;
							$arCourses[$id_course]['NAME'] =  $nameCourse;
							$arCourses[$id_course]['DURATION'] = $duration;
							$arCourses[$id_course]['ID'] = $id_course;
				  			?>
							<? } ?>
							<?
							$arCoursesTotal['COUNT'] = $index;

							// коэффициент измения цены когды покупается вся ПП целиком = 0,9
							$coefficientOfPrice = 0.9;
							$sumPrice = round($sumPrice* $coefficientOfPrice);
							$arCoursesTotal['SUMPRICE'] = $sumPrice;
							$arCoursesTotal['SUMDURATION'] = $sumDuration;
							$index = 0;
							foreach ($arCourses as $arCoursesSingle) {
							?>
							<tr>
       						    <td><p><a href="/training/catalog/course.html?ID=<?=$arCoursesSingle['ID']?>"><?=$arCoursesSingle['NAME']?></a></p></td>
       						    <td><nobr><?=$arCoursesSingle['PRICE']?> р.</nobr></td>
       						    <td><nobr><?=$arCoursesSingle['DURATION']?> ч.</nobr></td>
								<?if ($index==0){?><td rowspan="<?=$arCoursesTotal['COUNT']?>"  ><nobr><?=$arCoursesTotal['SUMPRICE']?> р.</nobr></td><? } ?>
								<?if ($index==0){?><td rowspan="<?=$arCoursesTotal['COUNT']?>"  ><nobr><?=$arCoursesTotal['SUMDURATION']?> ч.</nobr></td> <? } ?>
       						</tr>
       						<? $index = $index +1;
       							}
                                unset($arCourses);
                                unset($arCoursesTotal);
							?>
						</tbody>
					</table>
					<? $index_count = $index_count + 1; ?>
					<?}?>
<!--
    			 </td>
				<td>&nbsp;</td>
			</tr>
		</tbody>
	</table>
-->
<br /><br /><br />
	<? } ?>









