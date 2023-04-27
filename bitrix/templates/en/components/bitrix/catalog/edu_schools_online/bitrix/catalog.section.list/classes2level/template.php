<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<style type="text/css">
#content #school_list ul li {
	margin-bottom:0px;
}
#content #school_list ul ul {
	margin:5px 0 30px 40px;
}
</style>




<?if ($arResult["SECTION"]["DEPTH_LEVEL"] == 2) {?>
<script type="text/javascript">
$(document).ready(function(){
    $('div.toggler-1').toggleElements(
        { fxAnimation:'slide', fxSpeed:'fast', className:'toggler' } );
	var myList = $('div.toggler-1').find('div.close');
		myList.click(function() {
 			$(this).parent().hide();
		});
	$('#one-list ul li a.toggler-closed').click(function() {
 			//alert("se");
		});
});
</script>
<style type="text/css">
 blockquote {
	margin:0 0 0 0px;
}
</style>
	<div id="one_list">

	<p><?=$arResult["SECTION"]["DESCRIPTION"]?></p>
	<blockquote>
	<ul>
	<?
	//echo $arResult["SECTION"]["ID"];
	$CURRENT_DEPTH=$arResult["SECTION"]["DEPTH_LEVEL"]+1;
	$summa_vseh_kursov_price = 0;
	$summa_vseh_kursov_duration = 0;
	foreach($arResult["SECTIONS"] as $arSection):
		//print_r($arSection);
		if ($arSection["DEPTH_LEVEL"]==3)  {
			$ID_SECTION = $arSection["ID"];
			$arSectionLevel[$ID_SECTION]["NAME"] = $arSection["NAME"] ;
			$arSectionLevel[$ID_SECTION]["DESC"] = $arSection["DESCRIPTION"] ;
			$ar_result=CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID"=>"49", "ID"=>$arSection["ID"]), false,Array("UF_PP_PURPOSE","UF_CAT_PRICE","UF_CAT_DURATION", ));
			if($razdel=$ar_result->GetNext()){
				$arSectionLevel[$ID_SECTION]["PURPOSE"] = $razdel["UF_PP_PURPOSE"];
				$arSectionLevel[$ID_SECTION]["PRICE"] = $razdel["UF_CAT_PRICE"];
				$arSectionLevel[$ID_SECTION]["DURATION"] = $razdel["UF_CAT_DURATION"];
             	//echo "PRICE = ".$razdel["UF_CAT_PRICE"];
             }
		}
	?>
	<?
		if ($arSection["DEPTH_LEVEL"]==3) {?>
							<?
							//сделаем запрос к инфоблок школ(программ подготовки) и получим все курсы категории нашей программы
							// точнее получим ID курса его стоимость и длительнотст
							// второй гетлист - поиск имени курса по его ID
							?>
							<?
							$arSelect = Array("PROPERTY_pp_course", "PROPERTY_pp_price","PROPERTY_pp_duration", "NAME");
						    $arFilter = Array("IBLOCK_ID"=>49, "SECTION_ID"=>$ID_SECTION);
							$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, $arSelect);
							$sumPrice = 0;
							$sumDuration = 0;
							$index = 0;
							while($ar_fields = $res->GetNext())
								{
							 		$id_course = $ar_fields["PROPERTY_PP_COURSE_VALUE"];
							 		$priceSchool = $ar_fields["PROPERTY_PP_PRICE_VALUE"];
							 		$durationSchool = $ar_fields["PROPERTY_PP_DURATION_VALUE"];
							 		$name = $ar_fields["NAME"];

							?>
							<?
                                //... второй гетлист - поиск имени курса по его ID
								$arSelectCourses = Array("NAME", "PROPERTY_COURSE_PRICE", "PROPERTY_COURSE_DURATION");
							    $arFilterCourses = Array("IBLOCK_ID"=>6, "ID"=>$id_course);
								$resCourses = CIBlockElement::GetList(Array(), $arFilterCourses, false, false, $arSelectCourses);
								while($ar_fieldsCourses = $resCourses->GetNext())
									{
										$nameCourse = $ar_fieldsCourses["NAME"];
										$priceCourse = $ar_fieldsCourses["PROPERTY_COURSE_PRICE_VALUE"];
										$durationCourse = $ar_fieldsCourses["PROPERTY_COURSE_DURATION_VALUE"];
									}
                            //сформируем массив
                                if (strlen($priceSchool)>0) { $price = $priceSchool; } else { $price = $priceCourse; }
                                if (strlen($durationSchool)>0) { $duration = $durationSchool; } else { $duration = $durationCourse; }

								$sumPrice = $sumPrice + $price;
								$sumDuration = $sumDuration + $duration;
								$index = $index + 1;

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
							$index = 0;?>
		        <li>
					<div class="toggler-1" title="<?=$arSection['NAME']?>">
	    					<?if (strlen($arSectionLevel[$ID_SECTION]["PURPOSE"])>0){?><p><?=nl2br($arSectionLevel[$ID_SECTION]["PURPOSE"])?></p><? } ?>

							<?foreach ($arCourses as $arCoursesSingle) {?>
								<div  style="padding:3px 0px 3px 0px; overflow:auto;  border-bottom:1px solid #EEE;">
									 <div style="float:left; width:355px; margin-right:10px;"><a href="/training/catalog/course.html?ID=<?=$arCoursesSingle['ID']?>"><?=$arCoursesSingle['NAME']?></a></div>
									 <div style="float:left; width:50px; ">
	       						    	 <?=$arCoursesSingle['PRICE']?> р.
	       						     </div>
									 <div style="float:right; width:45px; ">
	       						    	 <?=$arCoursesSingle['DURATION']?> ч.
	       						     </div>
       						    </div>

       						<?
       							$index = $index +1;
       						}
							?>

								<div  style="padding:3px 0px 3px 0px; overflow:auto; ">
									 <div style="float:left; width:355px; margin-right:10px;"><span style="float:right;">Итого: </span> </div>
									 <div style="float:left; width:50px; ">
	       						    	 <strong><?=$arCoursesTotal['SUMPRICE']?> р.</strong>

	       						     </div>
									 <div style="float:right; width:45px; ">
	       						    	 <strong><?=$arCoursesTotal['SUMDURATION']?> ч.</strong>
	       						     </div>
       						    </div>
<?
$summa_vseh_kursov_price = $summa_vseh_kursov_price + $arCoursesTotal['SUMPRICE'];
$summa_vseh_kursov_duration = $summa_vseh_kursov_duration + $arCoursesTotal['SUMDURATION'];
?>
<?
 // создаем объект
$obCache = new CPHPCache;
// время кеширования - 30 минут
$life_time = 30*600;

// формируем идентификатор кеша в зависимости от всех параметров
// которые могут повлиять на результирующий HTML
$cache_id = $ID_SECTION;

// если кеш есть и он ещё не истек, то
if($obCache->InitCache($life_time, $cache_id, "/")) {
    // получаем закешированные переменные
    $vars = $obCache->GetVars();
    $SECTION_TITLE = $vars["SECTION_TITLE"];
   // echo "SECTION_TITLE=$SECTION_TITLE";
    // иначе обращаемся к базе
} else {
	$obSection = new CIBlockSection;
	$obSection->Update($ID_SECTION, array("UF_CAT_PRICE"=>$arCoursesTotal['SUMPRICE'], "UF_CAT_DURATION"=>$arCoursesTotal['SUMDURATION']));
}


// начинаем буферизирование вывода
if($obCache->StartDataCache()) {
    // записываем предварительно буферизированный вывод в файл кеша
    // вместе с дополнительной переменной
    $obCache->EndDataCache(array(
        "SECTION_TITLE"    => $arCoursesTotal['SUMPRICE']
        ));
}
                                unset($arCourses);
                                unset($arCoursesTotal);

							?>
					</div>
         		</li>
	   <? } ?>
	<?endforeach?>

<?
 // создаем объект
$obCache = new CPHPCache;
// время кеширования - 30 минут
$life_time = 30*600;

// формируем идентификатор кеша в зависимости от всех параметров
// которые могут повлиять на результирующий HTML
$cache_id = $arResult["SECTION"]["ID"];
//echo "cache_id=$cache_id";
// если кеш есть и он ещё не истек, то
if($obCache->InitCache($life_time, $cache_id, "/")) {
    // получаем закешированные переменные
    $vars = $obCache->GetVars();
    $SECTION_TITLE = $vars["SECTION_TITLE"];
    //echo "SECTION_TITLE=$SECTION_TITLE";
    // иначе обращаемся к базе
} else {
	$obSection = new CIBlockSection;
	$obSection->Update($cache_id, array("UF_CAT_PRICE"=>$summa_vseh_kursov_price, "UF_CAT_DURATION"=>$summa_vseh_kursov_duration));
}


// начинаем буферизирование вывода
if($obCache->StartDataCache()) {
    // записываем предварительно буферизированный вывод в файл кеша
    // вместе с дополнительной переменной
    $obCache->EndDataCache(array(
        "SECTION_TITLE"    => $summa_vseh_kursov_price
        ));
}

?>



			</ul>
		</blockquote>
	</div>
<? } ?>