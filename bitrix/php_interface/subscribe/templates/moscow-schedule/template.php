<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $SUBSCRIBE_TEMPLATE_RESULT;
$SUBSCRIBE_TEMPLATE_RESULT=false;
global $SUBSCRIBE_TEMPLATE_RUBRIC;
$SUBSCRIBE_TEMPLATE_RUBRIC=$arRubric;
global $APPLICATION;
?>

<span id="body_style" style="display:block; color: #2d2d2d; background: #fff;">

      <!-- Preheader -->
      <table class="preheader" style="font-family: tahoma, geneva, sans-serif; vertical-align: middle; background: #fff; height: 90px; border-bottom: 1px solid #f5f5f5;" cellpadding="0" cellspacing="0" width="100%">
        <tr><td style="color: rgb(255, 255, 255); font-size: 2px;">Московское расписание Luxoft Training</td> 	</tr>
		<tr>
          <td>

            <!-- Webversion -->
            <table border="0" cellpadding="0" cellspacing="0" summary="" width="750" style="" align="center">
              <tr>
                <td style="padding: 20px 40px 20px 15px; width: 134px;" class="logo"> <a href="http://ibs-training.ru/"><img width="104" src="/local/templates/ibs-training/assets/images/logo_gradient.svg" alt=""/></a></td>
				<td style="width: 148px; padding: 20px 0;" class="logo-2 webversion"> <a href="https://ibs-training.ru/about/news/LuxoftTrainingprodlilsvoepartnerstvosIIBAna2018g/"><img width="148" src="/images/digest2018/logo-2.jpg" alt=""/></a></td>
                <td>&nbsp;</td>
				<td style="width: 214px; padding: 20px 0; padding-right: 15px;" class="not-logo">
                   <table border="0" cellspacing="0" cellspacing="" summary="" width="100%" align="center">
						<tr>
							<td style="padding-right: 12px"><a href="http://vk.com/luxoft_training"><img src="/images/digest2018/vk.jpg" /></a></td>
							<td style="padding-right: 12px"><a href="https://twitter.com/TrainingLuxoft"><img src="/images/digest2018/twitter.jpg" /></a></td>
							<td style="padding-right: 12px"><a href="https://www.facebook.com/TrainingCenterLuxoft"><img src="/images/digest2018/facebook.jpg" /></a></td>
							<td style="padding-right: 12px"><a href="https://www.linkedin.com/groups/3880622/"><img src="/images/digest2018/linkedin.jpg" /></a></td>
							<td><a href="http://www.youtube.com/user/LuxoftTrainingCenter"><img src="/images/digest2018/youtube.jpg" /></a></td>
						</tr>
				   </table>
                </td>
              </tr>
            </table>
            <!-- End Webversion -->
          </td>
        </tr>
      </table>


        <table class="course" style="background: #f5f5f5" cellpadding="0" cellspacing="0" width="100%">
        <tr>
			<td style="">

<?
CModule::IncludeModule("iblock");
$arSelect = Array("ID", "NAME", "PROPERTY_SCHEDULE_COURSE_TYPE.NAME", "DATE_ACTIVE_FROM", "PREVIEW_TEXT", "PROPERTY_TRAINER_ID.NAME", "PROPERTY_TRAINER_SIMPLE", "PROPERTY_SCHEDULE_TIME", "PROPERTY_TRAINER_ID.PROPERTY_SHORT_NAME", "PROPERTY_TRAINER_ID.DETAIL_PAGE_URL","PROPERTY_TRAINER_ID.PREVIEW_PICTURE", "DETAIL_PAGE_URL", "PROPERTY_STARTDATE", "PROPERTY_ENDDATE","PROPERTY_CITY_ID.NAME","PROPERTY_CITY_ID.IBLOCK_SECTION_ID",  "PROPERTY_schedule_course.NAME", "PROPERTY_schedule_course.XML_ID", "PROPERTY_COURSE_ID.DETAIL_PAGE_URL", "PROPERTY_COURSE_ID.PROPERTY_HTML_DESC");
$arFilter = Array("IBLOCK_ID"=> 9, "ACTIVE"=>"Y", "PROPERTY_CITY"=> 5741,  '>PROPERTY_STARTDATE'=> date('Y-m-d'), '<PROPERTY_STARTDATE'=> date('Y-m-d', strtotime('+90 day')));
$res = CIBlockElement::GetList(Array("PROPERTY_SCHEDULE_COURSE_TYPE.SORT"=> "ASC", "PROPERTY_STARTDATE"=>"ASC"), $arFilter, false, false, $arSelect);
while($ob = $res->GetNextElement())
{
 $arResult["COURSES"][] = $ob->GetFields();

}
/*
  [ID] => 38069
            [~ID] => 38069
            [NAME] => --Temp Name--
            [~NAME] => --Temp Name--
            [DATE_ACTIVE_FROM] => 27.05.2013 15:16:45
            [~DATE_ACTIVE_FROM] => 27.05.2013 15:16:45
            [PREVIEW_TEXT] =>
            [~PREVIEW_TEXT] =>
            [PROPERTY_TRAINER_ID_NAME] => Carp
            [~PROPERTY_TRAINER_ID_NAME] => Carp
            [PROPERTY_TIME_VALUE] => 14:00 - 18:00
            [~PROPERTY_TIME_VALUE] => 14:00 - 18:00
            [PROPERTY_TIME_DESCRIPTION] =>
            [~PROPERTY_TIME_DESCRIPTION] =>
            [PROPERTY_TIME_VALUE_ID] => 38069:525
            [~PROPERTY_TIME_VALUE_ID] => 38069:525
            [PROPERTY_TRAINER_ID_PROPERTY_SHORT_NAME_VALUE] => Alexandru-Mihai
            [~PROPERTY_TRAINER_ID_PROPERTY_SHORT_NAME_VALUE] => Alexandru-Mihai
            [PROPERTY_TRAINER_ID_PROPERTY_SHORT_NAME_DESCRIPTION] =>
            [~PROPERTY_TRAINER_ID_PROPERTY_SHORT_NAME_DESCRIPTION] =>
            [PROPERTY_SHORT_NAME_TRAINER_ID_VALUE_ID] => 38147:512
            [~PROPERTY_SHORT_NAME_TRAINER_ID_VALUE_ID] => 38147:512
            [PROPERTY_TRAINER_ID_DETAIL_PAGE_URL] => /trainers/carp/
            [~PROPERTY_TRAINER_ID_DETAIL_PAGE_URL] => /trainers/carp/
            [PROPERTY_TRAINER_ID_PREVIEW_PICTURE] => 5681
            [~PROPERTY_TRAINER_ID_PREVIEW_PICTURE] => 5681
            [DETAIL_PAGE_URL] => /ennews/detail.php?ID=38069
            [~DETAIL_PAGE_URL] => /ennews/detail.php?ID=38069
            [PROPERTY_STARTDATE_VALUE] => 23.06.2015 14:00:00
            [~PROPERTY_STARTDATE_VALUE] => 23.06.2015 14:00:00
            [PROPERTY_STARTDATE_DESCRIPTION] =>
            [~PROPERTY_STARTDATE_DESCRIPTION] =>
            [PROPERTY_STARTDATE_VALUE_ID] => 38069:527
            [~PROPERTY_STARTDATE_VALUE_ID] => 38069:527
            [PROPERTY_CITY_ID_NAME] => Bucharest
            [~PROPERTY_CITY_ID_NAME] => Bucharest
            [PROPERTY_CITY_ID_IBLOCK_SECTION_ID] => 540
            [~PROPERTY_CITY_ID_IBLOCK_SECTION_ID] => 540
            [PROPERTY_COURSE_ID_NAME] => Linux Essentials
            [~PROPERTY_COURSE_ID_NAME] => Linux Essentials
            [PROPERTY_COURSE_ID_DETAIL_PAGE_URL] => /it-course/ADM-007/
            [~PROPERTY_COURSE_ID_DETAIL_PAGE_URL] => /it-course/ADM-007/
*/
?>

	<?$t=0?>
	<?$last_city="Bucharest"?>
	<table border="0" cellpadding="0" cellspacing="0" width="750" summary="" align="center">
	<?foreach ($arResult["COURSES"] as $key=>$arCourse) {?>


								<?if ($last_city!=$arCourse["PROPERTY_SCHEDULE_COURSE_TYPE_NAME"]) {?>
									<tr><td class="whitespace" height="40">&nbsp;</td></tr>
									<tr>
									  <td style="padding: 0 15px;" class="emailContainer" valign="top">
										<table  border="0" cellpadding="0" cellspacing="0" style="width: 100%">
											<tr>
												<td style="padding: 20px; background: #426192; font-size: 16px; color: #fff; font-weight: bold; padding-right: 28px; font-family: tahoma, geneva, sans-serif;"><?=$arCourse["PROPERTY_SCHEDULE_COURSE_TYPE_NAME"]?></td>
											</tr>
										</table>
									  </td>
									</tr>
									<tr><td class="whitespace" height="15">&nbsp;</td></tr>
									<?$last_city=$arCourse["PROPERTY_SCHEDULE_COURSE_TYPE_NAME"];?>

								<?}?>
								<tr>
										<td style="padding: 0 15px;">
										<table  border="0" cellpadding="0" cellspacing="0" style="width: 100%">
										<tr>
											<td style="background: #fff; border-bottom: 1px solid #f4f4f4; height: 84px; padding-left: 36px; border-left: 3px solid #426192; vertical-align: middle; width: 400px; padding-right: 15px;"><a style="font-size: 16px; color: #426192; text-decoration: none; font-family: tahoma, geneva, sans-serif;"  href="http://ibs-training.ru/kurs/<?=$arCourse["PROPERTY_SCHEDULE_COURSE_XML_ID"]?>.html"><?=$arCourse["PROPERTY_SCHEDULE_COURSE_NAME"]?></a></td>
											<td style="background: #fff; background: #fff; border-bottom: 1px solid #f4f4f4; padding-right: 15px;  width: 100px;">
												<table border="0" cellpadding="0" cellspacing="0" style="width: 100%">
													<tr>
														<td style="padding-right: 12px; width: 16px; font-family: tahoma, geneva, sans-serif;"><img src="/images/digest2018/date.jpg" /></td>
														<td style="font-size: 14px; color: #426192; font-family: tahoma, geneva, sans-serif;"><?if (strlen($arCourse["PROPERTY_ENDDATE_VALUE"])>0) {?>
											<?=date("d.m.Y", strtotime($arCourse["PROPERTY_STARTDATE_VALUE"]))?>-<?=date("d.m.Y", strtotime($arCourse["PROPERTY_ENDDATE_VALUE"]))?></td>
										<?} else {?>
											<?=date("d.m.Y", strtotime($arCourse["PROPERTY_STARTDATE_VALUE"]))?>
										<?}?></td>
													</tr>
												</table>
											</td>
											<td style="background: #fff; background: #fff; border-bottom: 1px solid #f4f4f4; text-align: right; padding-right: 36px;">
												<table border="0" cellpadding="0" cellspacing="0" style="width: 100%">
													<td style="padding-right: 12px; width: 15px;"><img src="/images/digest2018/time.jpg" /></td>
													<td style="font-size: 14px; color: #426192; font-family: tahoma, geneva, sans-serif; text-align: left;"><?=$arCourse["PROPERTY_SCHEDULE_TIME_VALUE"]?></td>
												</table>
											</td>
										</tr>
										</table>
									</td>
								</tr>
								<tr><td class="whitespace" height="10">&nbsp;</td></tr>

	<?}?>
							</table>
			<td>
		</tr>
		</table>
				<table class="footer" style="background: #fff" cellpadding="0" cellspacing="0" width="750" summary="" align="center">
			<tr>
				<td style="padding: 0 15px;">
					<table cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td style="text-align: center; font-size: 21px; font-family: tahoma, geneva, sans-serif; padding: 34px 0; border-bottom: 1px solid #f3f2f2">
								Если у Вас возникли какие-либо вопросы, Вы можете задать их любым удобным для Вас способом:
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td style="padding: 34px 15px 10px 15px;">
					<table cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td style="width: 23px; padding-top: 12px;  padding-bottom: 10px;">
								<img src="/images/digest2018/email.jpg" width="16"/>
							</td>
							<td>
								<a style="font-size: 14px; font-family: tahoma, geneva, sans-serif;  color: #426192; text-decoration: none;" href="mailto:<?=EMAIL_ADDRESS?>"><?=EMAIL_ADDRESS?></a>
							</td>
							<td style="font-size: 14px; font-family: tahoma, geneva, sans-serif; ">
								Москва <b>+7 (495) 967-8030</b>
							</td>
							<td style="font-size: 14px; font-family: tahoma, geneva, sans-serif; ">
								Санкт-Петербург <b>+7 (812) 457-1044</b>
							</td>
						</tr>
						<tr>
							<td style="width: 23px; padding-top: 2px; padding-top: 12px;  padding-bottom: 10px;">
								<img src="/images/digest2018/world.jpg" width="16"/>
							</td>
							<td>
								<a style="font-size: 14px; font-family: tahoma, geneva, sans-serif;  color: #426192; text-decoration: none;" href="http://ibs-training.ru">ibs-training.ru</a>
							</td>
							<td style="font-size: 14px; font-family: tahoma, geneva, sans-serif; ">
								Омск <b>+7 (3812) 33-23-08</b>
							</td>
							<td style="font-size: 14px; font-family: tahoma, geneva, sans-serif; ">
								Киев <b>+38 (044) 238-81-08</b>
							</td>
						</tr>
						<tr>
							<td style="width: 23px; padding-top: 2px; padding-top: 12px;  padding-bottom: 10px;">
								&nbsp;
								<?/*<img src="/images/digest2018/world.jpg" width="16"/>*/?>
							</td>
							<td>
								&nbsp; <?/*<a style="font-size: 14px; font-family: tahoma, geneva, sans-serif;  color: #426192; text-decoration: none;" href="http://ibs-training.ru">ibs-training.ru</a>*/?>
							</td>
							<td style="font-size: 14px; font-family: tahoma, geneva, sans-serif; ">
								Одесса <b>+38 (048) 720-70-01</b>
							</td>
							<td style="font-size: 14px; font-family: tahoma, geneva, sans-serif; ">
								Днепр <b>+38 (056) 787-12-21</b>
							</td>
						</tr>
					</table>
				</td>
			</tr>

		</table>
      <!-- End Footer -->
    </span>
<?
$SUBSCRIBE_TEMPLATE_RESULT = true;
if($SUBSCRIBE_TEMPLATE_RESULT) {
	return array(
		"SUBJECT"=>$SUBSCRIBE_TEMPLATE_RUBRIC["NAME"]
		,"BODY_TYPE"=>"html"
		,"CHARSET"=>"Windows-1251"
		,"DIRECT_SEND"=>"Y"
		,"FROM_FIELD"=>$SUBSCRIBE_TEMPLATE_RUBRIC["FROM_FIELD"]
	);

} else {
	return false;
}
?>
