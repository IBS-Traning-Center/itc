<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
	$ii=0; // для массива куда мы будем ложить значения
	$vMavCount = 9;
	$arValueOfCourses = array();
 ?><?foreach($arResult["ITEMS"] as $arItem):?><?
		$prepod_surname="";$prepod_name="";$prepod_code="";
		$schedule_course_id = $arItem['PROPERTIES']['schedule_course']['VALUE'];
		//iwrite($arItem['PROPERTIES']);
		$city = $arItem['PROPERTIES']['city']['VALUE'];
		$schedule_startdate = $arItem['PROPERTIES']['startdate']['VALUE'];
		$schedule_enddate = $arItem['PROPERTIES']['enddate']['VALUE'];
		$schedule_time = $arItem['PROPERTIES']['schedule_time']['VALUE'];
		$schedule_description = $arItem['PROPERTIES']['schedule_description']['VALUE']['TEXT'];
		$schedule_price = $arItem['PROPERTIES']['schedule_price']['VALUE'];
		$schedule_duration = $arItem['PROPERTIES']['schedule_duration']['VALUE'];
		$schedule_teacher_string = $arItem['PROPERTIES']['string_teacher']['VALUE'];
		$schedule_teacher_id = $arItem['PROPERTIES']['teacher']['VALUE'];
		if (strlen($schedule_enddate)> 0){
			$schedule_startdate	.= "-<br/>".$schedule_enddate;
		}
		$schedule_startdate	= str_replace(".2011","",$schedule_startdate);
		$schedule_startdate	= str_replace(".2011","",$schedule_startdate);
		$schedule_startdate	= str_replace(".2012","",$schedule_startdate);
 		$arSelect = Array(
	 		"PROPERTY_course_price",
	 		"PROPERTY_course_duration",
	 		"PROPERTY_course_idcategory",
	 		"PROPERTY_course_code",
			"PROPERTY_course_format",
			"PROPERTY_short_descr",
			"PROPERTY_ID_COURSE_OWNER",
	 		"NAME",
 		);
		$arFilter = Array("IBLOCK_ID"=>6,"ID"=>$schedule_course_id);
		//print_r($arFilter);
		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		while($ar_fields = $res->GetNext())
		{
	 		$course_price = $ar_fields["PROPERTY_COURSE_PRICE_VALUE"];
	 		$course_duration = $ar_fields["PROPERTY_COURSE_DURATION_VALUE"];
	 		$course_id_category = $ar_fields["PROPERTY_COURSE_IDCATEGORY_VALUE"];
	 		$course_code = $ar_fields["PROPERTY_COURSE_CODE_VALUE"];
	 		$course_online_enumid = $ar_fields["PROPERTY_COURSE_FORMAT_ENUM_ID"];
	 		$courseNameFromCatalog = $ar_fields["NAME"];
			$courseShort=$ar_fields["PROPERTY_SHORT_DESCR_VALUE"];
	 		$courseOwnerID = $ar_fields["PROPERTY_ID_COURSE_OWNER_ENUM_ID"];
	 		//iwrite($ar_fields);
		}

  		$arSelect = Array("NAME", "SORT");
		$arFilter = Array("IBLOCK_ID"=>50,"ID"=>$course_id_category);

		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		while($ar_fields = $res->GetNext())
		{
	 		$cat_name= $ar_fields["NAME"];
	 		$cat_sort= $ar_fields["SORT"];
		}
		$prepod_photo="";
		if ($schedule_teacher_id > 0) {
	  		$arSelect = Array("NAME", "PROPERTY_expert_name","CODE", "PREVIEW_PICTURE");
			$arFilter = Array("IBLOCK_ID"=>56,"ID"=>$schedule_teacher_id);
			$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
			while($ar_fields = $res->GetNext())
			{
				
		 		$prepod_surname = $ar_fields["NAME"];
		 		$prepod_code    = strtolower($ar_fields["CODE"]);
		 		$prepod_name    = $ar_fields["PROPERTY_EXPERT_NAME_VALUE"];
				$prepod_active  = $ar_fields["ACTIVE"];
				$prepod_photo = CFile::GetFileArray($ar_fields["PREVIEW_PICTURE"]);
			}
		} else {
			$prepod_photo["SRC"]="/images_new/about/zagl.jpg";
			$prepod_active  = "N";
			$prepod_surname = $schedule_teacher_string;
		}
		
       $arValueOfCourses[$ii]["sort"] = $cat_sort;
       $arValueOfCourses[$ii]["cat_name"] = $cat_name;
       $arValueOfCourses[$ii]["name"] = trim($courseNameFromCatalog);
		$arValueOfCourses[$ii]["short"]=$courseShort;
       $arValueOfCourses[$ii]["startdate"] = $schedule_startdate;
       $arValueOfCourses[$ii]["time"] = $schedule_time;
       $arValueOfCourses[$ii]["duration"] = $schedule_duration;
       $arValueOfCourses[$ii]["price"] = $schedule_price;
       $arValueOfCourses[$ii]["course_id"] = $schedule_course_id;
       $arValueOfCourses[$ii]["course_code"] = $course_code;
       $arValueOfCourses[$ii]["cat_id"] = $course_id_category;
	   $arValueOfCourses[$ii]["prepod_surname"] = $prepod_surname;
	   $arValueOfCourses[$ii]["prepod_code"] = $prepod_code;
	$arValueOfCourses[$ii]["prepod_name"] = $prepod_name;
	$arValueOfCourses[$ii]["prepod_photo"] = $prepod_photo;
       $arValueOfCourses[$ii]["online_id"] = $course_online_enumid;
       $arValueOfCourses[$ii]["courseOwnerID"] = $courseOwnerID;
       $arValueOfCourses[$ii]["time_id"] = $arItem["ID"];
       $arValueOfCourses[$ii]["detail_page_url"] = $arItem["DETAIL_PAGE_URL"];
	   $arValueOfCourses[$ii]["city"] = GetCityNameByID($arItem['PROPERTIES']['city']['VALUE']);
	   //iwrite($arValueOfCourses);
	   if ($arItem['PROPERTIES']['city']['VALUE']==CITY_ID_OMSK) {?>
			<?$utm='utm_source=rassylka&utm_medium=email_Omsk&utm_campaign=digest_'.date('m_Y');?>	
		<?} elseif ($arItem['PROPERTIES']['city']['VALUE']==CITY_ID_SPB) {?>
			<?$utm='utm_source=rassylka&utm_medium=email_Spb&utm_campaign=digest_'.date('m_Y');	?>			
		<?} elseif (($arItem['PROPERTIES']['city']['VALUE']==CITY_ID_KIEV) || ($arItem['PROPERTIES']['city']['VALUE']==CITY_ID_DNEPR) || ($arItem['PROPERTIES']['city']['VALUE']==CITY_ID_ODESSA)) {?>
			<?$utm='utm_source=rassylka&utm_medium=email_Ukraine&utm_campaign=digest_'.date('m_Y');?>
		<?} else {?>
			<?$utm='utm_source=rassylka&utm_medium=email_Moscow&utm_campaign=digest_'.date('m_Y');?>
		<?}?>
	<? $ii=$ii+1;?>
<?endforeach;?>
				
						<table cellspacing="0" cellpadding="0" border="0" style="width: 676px; border-collapse:collapse;">
							<tr>
								<td style="width: 86px; padding-bottom: 18px;">
									<?if ($arItem['PROPERTIES']['city']['VALUE']==CITY_ID_OMSK) {?>
										<img src="/images/digest2014/omsk.jpg" />
									<?} elseif ($arItem['PROPERTIES']['city']['VALUE']==CITY_ID_SPB) {?>
										<img src="/images/digest2014/spb.jpg" />
									<?} elseif ($arItem['PROPERTIES']['city']['VALUE']==CITY_ID_MOSCOW) {?>
										<img src="/images/digest2014/mosk.jpg" />
									<?} elseif ($arItem['PROPERTIES']['city']['VALUE']==CITY_ID_KIEV) {?>
										<img src="/images/digest2014/kiev.jpg" />
									<?} elseif ($arItem['PROPERTIES']['city']['VALUE']==CITY_ID_DNEPR) {?>
										<img src="/images/digest2014/dnepr.jpg" />
									<?} elseif ($arItem['PROPERTIES']['city']['VALUE']==CITY_ID_ODESSA) {?>
										<img src="/images/digest2014/odessa.jpg" />
									<?} else {?>
										<img src="/images/digest2014/online.jpg" />
									<?}?>
								</td>
								<td style="width: 416px; font-size: 19px; font-family: Arial; color: #e0995e; padding-bottom: 18px;">
									<div>
										<?if ($arItem['PROPERTIES']['city']['VALUE']==CITY_ID_MOSCOW) {?>
										<a style="font-size: 19px; font-family: Arial; color: #e0995e;" href="http://ibs-training.ru/timetable/?<?=$utm?>">МОСКВА</a>
										<?} elseif ($arItem['PROPERTIES']['city']['VALUE']==CITY_ID_KIEV) {?>
										<a style="font-size: 19px; font-family: Arial; color: #e0995e;" href="http://ibs-training.ru/timetable/index.html?city=kiev&<?=$utm?>">КИЕВ</a>
										<?} elseif ($arItem['PROPERTIES']['city']['VALUE']==CITY_ID_SPB) {?>
										<a style="font-size: 19px; font-family: Arial; color: #e0995e;" href="http://ibs-training.ru/timetable/index.html?city=spb&<?=$utm?>">САНКТ-ПЕТЕРБУРГ</a>
										<?} elseif ($arItem['PROPERTIES']['city']['VALUE']==CITY_ID_OMSK) {?>
										<a style="font-size: 19px; font-family: Arial; color: #e0995e;" href="http://ibs-training.ru/timetable/index.html?city=omsk&<?=$utm?>">ОМСК</a>
										<?} elseif ($arItem['PROPERTIES']['city']['VALUE']==CITY_ID_DNEPR) {?>
										<a style="font-size: 19px; font-family: Arial; color: #e0995e;" href="http://ibs-training.ru/timetable/index.html?city=dnepr&<?=$utm?>">ДНЕПРОПЕТРОВСК</a>
										<?} elseif ($arItem['PROPERTIES']['city']['VALUE']==CITY_ID_ODESSA) {?>
										<a style="font-size: 19px; font-family: Arial; color: #e0995e;" href="http://ibs-training.ru/timetable/index.html?city=odessa&<?=$utm?>">ОДЕССА</a>
										<?} else {?>
										<a style="font-size: 19px; font-family: Arial; color: #e0995e;" href="http://ibs-training.ru/timetable/onlinecourse/?<?=$utm?>">ОНЛАЙН</a>
										<?}?>
									</div>
								</td>
								<td style="vertical-align: bottom; text-align: center; padding-bottom: 18px;">
									<img src="/images/digest2014/date.jpg" />
								</td>
								<td style="vertical-align: bottom; text-align: center; padding-bottom: 18px;">
									<img src="/images/digest2014/time.jpg" />
								</td>
							</tr>



						

<?
	$index = 0;
	while (list($key, $value) = each($arValueOfCourses)) {
?>
<?print_r?>
<? if (($value["courseOwnerID"] == 120) or ($value["courseOwnerID"] == 121) or ($value["courseOwnerID"] == 123)) {?>
								<tr>
									<td style="width: 86px; vertical-align: top;">
										<img src="<?=$value["prepod_photo"]["SRC"]?>"/>
									</td>
									<td style="width: 416px; vertical-align: top; font-family: Arial; padding-bottom: 30px;">
										<div style="font-family: Arial; font-size: 17px; color: #4f5d73;">
											Тренер - <?if ($value["prepod_code"]) {?><a href="/about/experts/<?=$value['prepod_code']?>.html?<?=$utm?>" style="font-family: Arial; color:#77b3d4;" > <?=$value["prepod_surname"];?> <?=$value["prepod_name"];?></a> <?} else {?> <?=$value["prepod_surname"];?> <?=$value["prepod_name"];?><?}?>
										</div>
										<div>
											<a style="font-family: Arial; font-size: 17px; color: #4f5d73;" href="http://ibs-training.ru/training/catalog/course.html?ID=<?=$value[course_id]?>&ID_TIME=<?=$value[time_id]?>&<?=$utm?>"><?=$value["name"]?></a>
										</div>
										<div style="font-size: 13px; font-family: Arial; color: #404040;" >
											<?=$value["short"]?>
										</div>
									</td>
									<td style="vertical-align: top; text-align: center; padding-bottom: 18px; font-family: Arial; font-size: 16px; color: #4f5d73;">
										<?=$value["startdate"] ?>
									</td>
									<td style="vertical-align: top; text-align: center; padding-bottom: 18px; font-family: Arial; font-size: 16px; color: #4f5d73;">
										<?=$value["duration"]?> ч.
									</td>
								</tr>
								
														
<? $index = $index + 1; ?>
<? } ?>									

<?
   }
?>
								<tr>
									<td colspan="4" style="border: 1px solid #dbdbdb; " >
									</td>
								</tr>
								<tr>
									<td>
										<img src="/images/email/spacer.gif" height="25" alt="" border="0"/>
									</td>
								</tr>
								</table>
								
									
							