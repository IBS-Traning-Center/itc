<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<style type="text/css">
#content #school_list ul li {
	margin-bottom:0px;
}
#content #school_list ul ul {
	margin:5px 0 30px 40px;
}
</style>
<?if ($arResult["SECTION"]["DEPTH_LEVEL"] == 1) {?>

<style type="text/css">
 blockquote {
	margin:0 0 0 0px;
}
h2 {
padding:10px 0 5px;
}
blockquote ul {
	list-style-image:none;
	list-style-position:outside;
	list-style-type:none;
	margin:0 0 10px 20px;
}
#content #one_list ul {
	list-style-image:url(/bitrix/templates/en/images/list_index_bigger_no_up.gif);
	list-style-position:outside;
	list-style-type:circle;
	margin:0 0 0px 20px;
}
#content #one_list  ul li {
	margin:0 0 3px 20px;
}

#content #one_list blockquote ul {
	list-style-image:none;
	list-style-position:outside;
	list-style-type:none;
	margin:0 0 0px 20px;
	padding:0 0 0px 0px;
}
#content #one_list blockquote {
	margin:5px 0 0;
}
.header_text {
	background:#F9F9F7 none repeat scroll 0 0;
	margin:5px 0 10px 15px;
	padding:10px 10px 5px;
}
.header_accordion a.accord {
	border-bottom:1px dashed #22396D;
	margin:0 0 0px;
	text-decoration:none;
}
#content #one_list .desc ul {
	list-style-image:url(/bitrix/templates/en/images/list_index_bigger_no_up.gif);
	list-style-position:outside;
	list-style-type:circle;
	margin:0 0 0px 20px;
}
#content #one_list .desc ul li {
	margin:0 0 3px 20px;
}
#content #one_list .desc {
	line-height:140%;
}
</style>
<script type="text/javascript">
ddaccordion.init({
	headerclass: "header_accordion",
	contentclass: "header_text",
	revealtype: "click",
	mouseoverdelay: 200,
	collapseprev: false,
	defaultexpanded: [],
	onemustopen: false,
	animatedefault: false,
	persiststate: false,
	toggleclass: ["closedlanguage", "openlanguage"],
	togglehtml: ["prefix", "<img src='/bitrix/templates/en/images/but_plus.gif' /> ", "<img src='/bitrix/templates/en/images/but_minus.gif'/> "],
	animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(headers, expandedindices){
	},
	onopenclose:function(header, index, state, isuseractivated){
	}
})
</script>
	<div id="one_list">
	<div class="desc">
		<?=$arResult["SECTION"]["DESCRIPTION"]?>
	</div>
	<?
	$ar_result=CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID"=>"49", "ID"=>$arResult["SECTION"]["ID"]), false,Array("UF_META_TITLE" ));
	if($razdel=$ar_result->GetNext()){
		$vBrowserTitle = $razdel['UF_META_TITLE'];
	}
	if (strlen($vBrowserTitle)>0){
		$APPLICATION->SetPageProperty("title", $vBrowserTitle);
		$APPLICATION->SetPageProperty("blue_title", $arResult['SECTION']['NAME']);	
	} 
//$APPLICATION->SetPageProperty("title", "Блоги экспертов");
	$CURRENT_DEPTH=$arResult["SECTION"]["DEPTH_LEVEL"]+1;
	foreach($arResult["SECTIONS"] as $arSection):
		//print_r($arSection);
		if ($arSection["DEPTH_LEVEL"]==2)  {
			$ID_SECTION = $arSection["ID"];

			$arSectionLevel[$ID_SECTION]["NAME"] = $arSection["NAME"] ;
			$arSectionLevel[$ID_SECTION]["DESC"] = $arSection["DESCRIPTION"] ;
			$ar_result=CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID"=>"49", "ID"=>$arSection["ID"]), false,Array("UF_PP_PURPOSE","UF_CAT_PRICE","UF_CAT_DURATION", "UF_DISCOUNT" ));
			if($razdel=$ar_result->GetNext()){
				//iwrite($razdel);
				$arSectionLevel[$ID_SECTION]["PURPOSE"] = $razdel["~UF_PP_PURPOSE"];
				$arSectionLevel[$ID_SECTION]["PRICE"] = $razdel["UF_CAT_PRICE"];
				$arSectionLevel[$ID_SECTION]["DURATION"] = $razdel["UF_CAT_DURATION"];
				//$arSectionLevel[$ID_SECTION]["DISCOUNT"] = intval($razdel["UF_DISCOUNT"]);
             }
		}
	?>
	<?
	   if ($arSection["DEPTH_LEVEL"]==2) {?>
	    <h2><?=$arSection["NAME"]?></h2>
	    	<?if (strlen($arSectionLevel[$ID_SECTION]["PURPOSE"])>0){?>
	    		<div class="floated_right w70"><a class="orange" href="/mail/?ID=<?=$arSection['ID']?>">Записаться на обучение</a></div>
	    		<p class="indent"><?=$arSectionLevel[$ID_SECTION]["PURPOSE"]?> <a class="orange" href="<?=$arSection['SECTION_PAGE_URL']?>">Подробнее</a></p>
	    	<? } ?>
	   <? } ?>

		<?if ($arSection["DEPTH_LEVEL"]==3)  {
			$ID_SECTION = $arSection["ID"];
			$arSectionLevel[$ID_SECTION]["NAME"] = $arSection["NAME"] ;
			$arSectionLevel[$ID_SECTION]["DESC"] = $arSection["DESCRIPTION"] ;
			$ar_result=CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID"=>"49", "ID"=>$arSection["ID"]), false,Array("UF_PP_PURPOSE","UF_CAT_PRICE","UF_CAT_DURATION", "UF_DISCOUNT" ));
			if($razdel=$ar_result->GetNext()){
				//iwrite($razdel);
				$arSectionLevel[$ID_SECTION]["PURPOSE"] = $razdel["~UF_PP_PURPOSE"];
				$arSectionLevel[$ID_SECTION]["PRICE"] = $razdel["UF_CAT_PRICE"];
				$arSectionLevel[$ID_SECTION]["DURATION"] = $razdel["UF_CAT_DURATION"];
				$arSectionLevel[$ID_SECTION]["DISCOUNT"] = $razdel["UF_DISCOUNT"];
    		}?>

		<?}

		if ($arSection["DEPTH_LEVEL"]==3) {?>
			<?
			if (strlen($arSectionLevel[$ID_SECTION]["DISCOUNT"])> 0){} else {
				$arSectionLevel[$ID_SECTION]["DISCOUNT"] = 10;  //скидка  в процентах по умолчанию
			}
			?>
		<blockquote>
			<ul>
							<?
							//сделаем запрос к инфоблок школ(программ подготовки)
							// и получим все курсы категории нашей программы
							// точнее получим ID курса его стоимость и длительность
							// второй гетлист - поиск имени курса по его ID
							?>
							<?
							$arSelect = Array("PROPERTY_pp_course", "PROPERTY_PP_COURSE.ACTIVE", "PROPERTY_pp_price","PROPERTY_pp_duration", "NAME");
						    $arFilter = Array("IBLOCK_ID"=>49, "SECTION_ID"=>$ID_SECTION);
							$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, $arSelect);
							$sumPrice = 0;
							$sumDuration = 0;
							$index = 0;
							$totalActiveCoursesInClass = 0;
							while($ar_fields = $res->GetNext())
							{
								if ($ar_fields['PROPERTY_PP_COURSE_ACTIVE'] == "Y")  {
									//iwrite($ar_fields);
									$totalActiveCoursesInClass = $totalActiveCoursesInClass + 1;
									$id_course = $ar_fields["PROPERTY_PP_COURSE_VALUE"];
									$priceSchool = $ar_fields["PROPERTY_PP_PRICE_VALUE"];
									$durationSchool = $ar_fields["PROPERTY_PP_DURATION_VALUE"];
									$name = $ar_fields["NAME"];

									// второй гетлист - поиск имени курса по его ID
									$arSelectCourses = Array("NAME", "PROPERTY_COURSE_PRICE", "PROPERTY_COURSE_DURATION" ,  "PROPERTY_COURSE_CODE");
									$arFilterCourses = Array("IBLOCK_ID"=>6, "ID"=>$id_course, "ACTIVE" => "Y");
									$resCourses = CIBlockElement::GetList(Array(), $arFilterCourses, false, false, $arSelectCourses);
									while($ar_fieldsCourses = $resCourses->GetNext())
									{
										$nameCourse = $ar_fieldsCourses["NAME"];
										$priceCourse = $ar_fieldsCourses["PROPERTY_COURSE_PRICE_VALUE"];
										$durationCourse = $ar_fieldsCourses["PROPERTY_COURSE_DURATION_VALUE"];
										$codeCourse = $ar_fieldsCourses["PROPERTY_COURSE_CODE_VALUE"];
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
									$arCourses[$id_course]['CODE'] = $codeCourse;
								}
							}

							$arCoursesTotal['COUNT'] = $index;

							// коэффициент измения цены когда покупается вся ПП целиком = 0,9
							//$coefficientOfPrice = 0.9;  //было раньше
							//iwrite($arSectionLevel[$ID_SECTION]["DISCOUNT"]);
							$coefficientOfPrice = 1 - ($arSectionLevel[$ID_SECTION]["DISCOUNT"]/100);
							$sumPrice = round($sumPrice* $coefficientOfPrice);
							$arCoursesTotal['SUMPRICE'] = $sumPrice;
							$arCoursesTotal['SUMDURATION'] = $sumDuration;
							$index = 0;
							?>
				<? if  ($totalActiveCoursesInClass > 0) {?>
		        <li>
					<div class="header_accordion" title="<?=$arSection['NAME']?>"><a href="#" class="accord"><?=$arSection['NAME']?></a></div>
                    <div class="header_text w540">
	    					<?if (strlen($arSectionLevel[$ID_SECTION]["PURPOSE"])>0){?><p><?=$arSectionLevel[$ID_SECTION]["PURPOSE"]?></p><? } ?>

							<?foreach ($arCourses as $arCoursesSingle) {?>
								<div class="clases_wrapper">
									 <div class="l w80">
	       						    	 <?=$arCoursesSingle['CODE']?>
	       						     </div>
									 <div class="l w260"><a href="/training/catalog/course.html?ID=<?=$arCoursesSingle['ID']?>"><?=$arCoursesSingle['NAME']?></a></div>
									 <div class="r w60">
	       						    	 &nbsp;<?/*<?=$arCoursesSingle['PRICE']*$coefficientOfPrice?> р.*/?>
	       						     </div>
									 <div  class="r w60">
	       						    	 <?=$arCoursesSingle['DURATION']?> ч.
	       						     </div>
	       						      <div class="clear"> </div>
       						    </div>

       						<?
       							$index = $index +1;
       						}
							?>

								<div class="clases_wrapper_in">
									 <div class="l w350"><span class="r">Итого: </span> </div>
									 <div class="r w60">
	       						    	 <strong><?=$arCoursesTotal['SUMPRICE']?> р.</strong>
	       						     </div>
									 <div class="r w60">
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
       </ul>
       </blockquote>
	   <? } ?>
	<?endforeach?>
	</div>
<? } ?>





<?if ($arResult["SECTION"]["DEPTH_LEVEL"] == 2) {?>
<style type="text/css">
 blockquote {
	margin:0 0 0 0px;
}
blockquote ul {
	list-style-image:none;
	list-style-position:outside;
	list-style-type:none;
	margin:0 0 10px 20px;
}
.header_text {
	background:#F9F9F7 none repeat scroll 0 0;
	margin:5px 0 10px 15px;
	padding:10px 10px 5px;
}
.header_accordion a.accord {
	border-bottom:1px dashed #22396D;
	margin:0 0 25px;
	text-decoration:none;
}
#content #one_list .desc ul {
	list-style-image:url(/bitrix/templates/en/images/list_index_bigger_no_up.gif);
	list-style-position:outside;
	list-style-type:circle;
	margin:0 0 0px 20px;
}
#content #one_list .desc ul li {
	margin:0 0 3px 20px;
}
#content #one_list .desc {
	line-height:140%;
}
</style>

<script type="text/javascript">
ddaccordion.init({
	headerclass: "header_accordion",
	contentclass: "header_text",
	revealtype: "click",
	mouseoverdelay: 200,
	collapseprev: false,
	defaultexpanded: [],
	onemustopen: false,
	animatedefault: false,
	persiststate: false,
	toggleclass: ["closedlanguage", "openlanguage"],
	togglehtml: ["prefix", "<img src='/bitrix/templates/en/images/but_plus.gif' /> ", "<img src='/bitrix/templates/en/images/but_minus.gif'/> "],
	animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(expandedindices){
	},
	onopenclose:function(header, index, state, isuseractivated){
	}
})
</script>

	<div id="one_list">
	    <div class="desc">
	    	<div class="floated_right w70"><a class="orange" href="/mail/?ID=<?=$arResult['SECTION']['ID']?>">Записаться на обучение</a></div>
			<?=$arResult["SECTION"]["DESCRIPTION"]?>
		</div>
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
			$ar_result=CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID"=>"49", "ID"=>$arSection["ID"]), false,Array("UF_PP_PURPOSE","UF_CAT_PRICE","UF_CAT_DURATION","UF_DISCOUNT"  ));
			if($razdel=$ar_result->GetNext()){
				$arSectionLevel[$ID_SECTION]["PURPOSE"] = $razdel["~UF_PP_PURPOSE"];
				$arSectionLevel[$ID_SECTION]["PRICE"] = $razdel["UF_CAT_PRICE"];
				$arSectionLevel[$ID_SECTION]["DURATION"] = $razdel["UF_CAT_DURATION"];
				$arSectionLevel[$ID_SECTION]["DISCOUNT"] = $razdel["UF_DISCOUNT"];
             	//echo "PRICE = ".$razdel["UF_CAT_PRICE"];
             }
		}
	?>
	<?
		if ($arSection["DEPTH_LEVEL"]==3) {?>
				<?
				if (strlen($arSectionLevel[$ID_SECTION]["DISCOUNT"])> 0){} else {
					$arSectionLevel[$ID_SECTION]["DISCOUNT"] = 10;  //скидка  в процентах по умолчанию
				}
				?>
							<?
							//сделаем запрос к инфоблок школ(программ подготовки)
							// и получим все курсы категории нашей программы
							// точнее получим ID курса его стоимость и длительнотст
							// второй гетлист - поиск имени курса по его ID
							?>
							<?
							$arSelect = Array("PROPERTY_pp_course", "PROPERTY_PP_COURSE.ACTIVE", "PROPERTY_pp_price","PROPERTY_pp_duration", "NAME");
						    $arFilter = Array("IBLOCK_ID"=>49, "SECTION_ID"=>$ID_SECTION);
							$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, $arSelect);
							$sumPrice = 0;
							$sumDuration = 0;
							$index = 0;
							$totalActiveCoursesInClass = 0;
							while($ar_fields = $res->GetNext())
								{
								if ($ar_fields['PROPERTY_PP_COURSE_ACTIVE'] == "Y")  {
									$totalActiveCoursesInClass = $totalActiveCoursesInClass + 1;
									$id_course = $ar_fields["PROPERTY_PP_COURSE_VALUE"];
									$priceSchool = $ar_fields["PROPERTY_PP_PRICE_VALUE"];
									$durationSchool = $ar_fields["PROPERTY_PP_DURATION_VALUE"];
									$name = $ar_fields["NAME"];
									//второй гетлист - поиск имени курса по его ID
									$arSelectCourses = Array("NAME", "PROPERTY_COURSE_PRICE", "PROPERTY_COURSE_DURATION" ,  "PROPERTY_COURSE_CODE");
									$arFilterCourses = Array("IBLOCK_ID"=>6, "ID"=>$id_course);
									$resCourses = CIBlockElement::GetList(Array(), $arFilterCourses, false, false, $arSelectCourses);
									while($ar_fieldsCourses = $resCourses->GetNext())
									{
										$nameCourse = $ar_fieldsCourses["NAME"];
										$priceCourse = $ar_fieldsCourses["PROPERTY_COURSE_PRICE_VALUE"];
										$durationCourse = $ar_fieldsCourses["PROPERTY_COURSE_DURATION_VALUE"];
										$codeCourse = $ar_fieldsCourses["PROPERTY_COURSE_CODE_VALUE"];
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
									$arCourses[$id_course]['CODE'] = $codeCourse;
				  				}?>
							<? } ?>
							<?
							$arCoursesTotal['COUNT'] = $index;

							// коэффициент измения цены когды покупается вся ПП целиком = 0,9
							//$coefficientOfPrice = 0.9;
							$coefficientOfPrice = 1 - ($arSectionLevel[$ID_SECTION]["DISCOUNT"]/100);
							$sumPrice = round($sumPrice* $coefficientOfPrice);
							$arCoursesTotal['SUMPRICE'] = $sumPrice;
							$arCoursesTotal['SUMDURATION'] = $sumDuration;
							$index = 0;?>
				<? if  ($totalActiveCoursesInClass > 0) {?>
		        <li>
					<div class="header_accordion" title="<?=$arSection['NAME']?>"><a href="#" class="accord"><?=$arSection['NAME']?></a></div>
                    <div class="header_text w540">
	    					<?if (strlen($arSectionLevel[$ID_SECTION]["PURPOSE"])>0){?><p><?=nl2br($arSectionLevel[$ID_SECTION]["PURPOSE"])?></p><? } ?>

							<?foreach ($arCourses as $arCoursesSingle) {?>
								<div  class="clases_wrapper">
									 <div class="l w80">
	       						    	 <?=$arCoursesSingle['CODE']?>
	       						     </div>
									 <div class="l w260"><a href="/training/catalog/course.html?ID=<?=$arCoursesSingle['ID']?>"><?=$arCoursesSingle['NAME']?></a></div>
									 <div class="r w60">
	       						    	 &nbsp;<?/*<?=$arCoursesSingle['PRICE']*$coefficientOfPrice?> р.*/?>
	       						     </div>
									 <div class="r w60">
	       						    	 <?=$arCoursesSingle['DURATION']?> ч.
	       						     </div>
	       						      <div class="clear"> </div>
       						    </div>
       						<?
       							$index = $index +1;
       						}
							?>
								<div class="clases_wrapper_in">
									 <div  class="l w350"><span class="r">Итого: </span> </div>
									 <div class="r w60">
	       						    	 <strong><?=$arCoursesTotal['SUMPRICE']?> р.</strong>

	       						     </div>
									 <div class="r w60">
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
		$life_time = 30*60;

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
			$obSection->Update($ID_SECTION, array("UF_CAT_PRICE"=>$arCoursesTotal['SUMPRICE'],
			 "UF_CAT_DURATION"=>$arCoursesTotal['SUMDURATION']));
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
			   <? } ?>
			<?endforeach?>

			<?
			 // создаем объект
			$obCache = new CPHPCache;
			// время кеширования - 30 минут
			$life_time = 30*60;

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