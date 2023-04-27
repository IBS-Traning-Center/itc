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



						<table width="100%" cellspacing="0" cellpadding="0" style="margin:0px;padding:0px; border:2px solid #004080; border-collapse:collapse;">
						<tbody>
						<tr>
							<td valign="middle" height="30" style="margin:0px;padding:0px; background-color:#004080;" class="pad_null">
								<div style="text-align:left;margin:0px 0px 0px 15px;font-weight:bold;display:block;font-size:16px; font-family:Arial,Helvetica,sans-serif; color:#FFFFFF;">
									 <span style="text-transform:uppercase;"><?=strtoupper(GetCityNameByID($arItem['PROPERTIES']['city']['VALUE']))?></span>. &nbsp;&nbsp;БЛИЖАЙШИЕ КУРСЫ 
								</div>
							</td>
						</tr>
						<tr>
							<td valign="top" style="margin:0px;padding:0px; background-color:#FFFFFF;" class="pad_null">
								<div style="text-align:left;margin:7px 15px 7px 15px; padding:0px;font-family:Arial,Helvetica,sans-serif;color:#1C548D;">
									<img src="/images/email/244_60_hot_mice.jpg" width="244" height="60" alt="" border="0" align="">
								</div>
								<div style="text-align:left;margin:7px 15px 7px 15px; padding:0px;font-family:Arial,Helvetica,sans-serif;color:#333333; font-size:12px;">
									<table cellspacing="0" cellpadding="0" border="0" class="lux_table" width="100%" style="border-collapse:collapse; border:none; margin:0px;padding:0px;color:#333333;font-size:14px;font-family:Arial,Helvetica,sans-serif;">
									<tr class="lux_header">
										<td valign="top" style="margin:0px;padding:0px;font-family:Arial,Helvetica,sans-serif;font-size:15px;color:#333333;">
											<strong>Тренер</strong>
										</td>
										<td valign="top" style="margin:0px;padding:0px;font-family:Arial,Helvetica,sans-serif;font-size:15px;color:#333333;">
											<strong>Курс</strong>
										</td>
										<td valign="top" width="10" style="margin:0px;padding:0px;width:10px;">
											 &nbsp;
										</td>
										<td valign="top" nowrap width="130" style="margin:0px;padding:0px;font-family:Arial,Helvetica,sans-serif;font-size:15px;text-align:center;">
											<strong>Дата, длит.</strong>
																	
										</td>
									</tr>
									<tr>
										<td valign="top" height="5">
											<div style="line-height:0;">
												<img width="5" height="5" src="/images/email/padding10.png">
											</div>
										</td>
									</tr>

<?
	$index = 0;
	while (list($key, $value) = each($arValueOfCourses)) {
?>
<?print_r?>
<? if (($value["courseOwnerID"] == 120) or ($value["courseOwnerID"] == 121) or ($value["courseOwnerID"] == 123)) {?>
									<tr valign='top' >
										<td style="padding-right: 10px;padding-bottom: 10px; padding-top: 2px;" nowrap>
											<img src="<?=$value["prepod_photo"]["SRC"]?>"><br/>
											<?if ($value["prepod_code"]) {?>
											<a style="color: #004080; font-size: 11px;" href="/about/experts/<?=$value['prepod_code']?>.html?<?=$utm?>"><?=$value["prepod_surname"];?> <?=$value["prepod_name"];?></a>
											<?} else {?>
											<span style="font-size: 11px;"><?=$value["prepod_surname"];?>  <?=$value["prepod_name"];?></span>
											<?}?>
										</td>
										<td valign='top' style="padding-bottom: 10px;" class="lux_td_name" width="400">
											<a href="http://ibs-training.ru/training/catalog/course.html?ID=<?=$value[course_id]?>&ID_TIME=<?=$value[time_id]?>&<?=$utm?>" style="color:#004080;" target="_blank"><?=$value["name"]?></a><br/>
											<span style="font-size: 11px; color: #656565;"><?=$value["short"]?></span>
										</td>
										<td valign="top" width="10" style="margin:0px;padding:0px;width:10px;">
											 &nbsp;
										</td>
										<td valign='top' class="lux_td_name" style="text-align:center;">
											 <?=$value["startdate"] ?>,<br/> <?=$value["duration"]?> ч.
										</td>
										
									</tr>
									<tr>
										<td valign="top" height="5">
											<div style="line-height:0;">
												<img width="5" height="5" src="/images/email/padding10.png">
											</div>
										</td>
									</tr>									
<? $index = $index + 1; ?>
<? } ?>									

<?
   }
?>
									</table>
								</div>
								<div>
									<img src="/images/email/padding10.png" alt="" border="0" height="10">
								</div>
								<div style="text-align:right;margin:0px 15px 0px 15px; padding:0px;font-family:Arial,Helvetica,sans-serif;color:#1C548D;">
									<?if ($arItem['PROPERTIES']['city']['VALUE']==CITY_ID_OMSK) {?>
										<a href="http://ibs-training.ru/timetable/?city=omsk&utm_source=rassylka&utm_medium=email_Omsk&utm_campaign=digest_<?=date('m_Y');?>" style="text-decoration:none;" target="_blank"><img src="/images/email/78_21_more_link.png" width="78" height="21" alt="" border="0"></a>
									<?} elseif ($arItem['PROPERTIES']['city']['VALUE']==CITY_ID_SPB) {?>
										<a href="http://ibs-training.ru/timetable/?city=spb&utm_source=rassylka&utm_medium=email_Spb&utm_campaign=digest_<?=date('m_Y');?>" style="text-decoration:none;" target="_blank"><img src="/images/email/78_21_more_link.png" width="78" height="21" alt="" border="0"></a>
									<?} elseif ($arItem['PROPERTIES']['city']['VALUE']==CITY_ID_KIEV) {?>
										<a href="http://ibs-training.ru/timetable/?city=kiev&utm_source=rassylka&utm_medium=email_Ukraine&utm_campaign=digest_<?=date('m_Y');?>" style="text-decoration:none;" target="_blank"><img src="/images/email/78_21_more_link.png" width="78" height="21" alt="" border="0"></a>
									<?} elseif ($arItem['PROPERTIES']['city']['VALUE']==CITY_ID_DNEPR) {?>
										<a href="http://ibs-training.ru/timetable/?city=dnepr&utm_source=rassylka&utm_medium=email_Ukraine&utm_campaign=digest_<?=date('m_Y');?>" style="text-decoration:none;" target="_blank"><img src="/images/email/78_21_more_link.png" width="78" height="21" alt="" border="0"></a>
									<?} elseif ($arItem['PROPERTIES']['city']['VALUE']==CITY_ID_ODESSA) {?>
										<a href="http://ibs-training.ru/timetable/?city=odessa&utm_source=rassylka&utm_medium=email_Ukraine&utm_campaign=digest_<?=date('m_Y');?>" style="text-decoration:none;" target="_blank"><img src="/images/email/78_21_more_link.png" width="78" height="21" alt="" border="0"></a>
									<?} else {?>
										<a href="http://ibs-training.ru/timetable/?utm_source=rassylka&utm_medium=email_Moscow&utm_campaign=digest_<?=date('m_Y');?>" style="text-decoration:none;" target="_blank"><img src="/images/email/78_21_more_link.png" width="78" height="21" alt="" border="0"></a>
									<?}?>
								</div>
								<div>
									<img src="/images/email/padding10.png" alt="" border="0" height="10">
								</div>
							</td>
						</tr>
						</tbody>
						</table>