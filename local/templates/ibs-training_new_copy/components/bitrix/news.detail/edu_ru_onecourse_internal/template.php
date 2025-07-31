<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<style>
.trcode{
	min-width:85px;
	display:inline-block;
}
.trcell{
	/*display:table-cell;*/
}
#content ul.linked li.trname {
	list-style:none outside none;
	margin:0 0 2px 0px;
}
#content ul.linked li {
	margin:0 0 2px 20px;
}
#content ul.linked  {
	margin:0 0 10px 0px;
}
</style>
	  <?
			function checkHtml($str){
				$mystring = 'ul';
				$pos = strpos($str, $mystring);
				if ($pos === false) {
					$str = nl2br($str);
				}
				return $str;
			}
//iwrite($arResult);
global  $arEventInfo ;
	      $course_name = $arResult["NAME"];
	      $course_id = $arResult["ID"];

	      $course_code = $arResult['PROPERTIES']['course_code']['VALUE'];
	      $course_price = $arResult['PROPERTIES']['course_price']['VALUE'];
	      //$course_description = $arResult['PROPERTIES']['course_description']['VALUE'];
	      $course_language = $arResult['PROPERTIES']['course_language']['VALUE'];
	      $course_duration = $arResult['PROPERTIES']['course_duration']['VALUE'];
	      $course_type = $arResult['PROPERTIES']['course_type']['VALUE'];
	      $course_puproses = $arResult['PROPERTIES']['course_puproses']['~VALUE'];
          //iwrite($arResult['PROPERTIES']['course_puproses']['~VALUE']);



	      //$course_topics = nl2br($arResult['PROPERTIES']['course_topics']['VALUE']);
	      $course_audience = $arResult['PROPERTIES']['course_audience']['~VALUE'];
	      //$course_required = nl2br($arResult['PROPERTIES']['course_required']['VALUE']);
	      $course_linkedcourses = nl2br($arResult['PROPERTIES']['course_linkedcourses']['VALUE']);
	      $course_trainers = $arResult['PROPERTIES']['course_trainers']['VALUE'];
	      $course_owner = $arResult['PROPERTIES']['course_owner']['VALUE'];
	      $course_requirements = nl2br($arResult['PROPERTIES']['course_requirements']['VALUE']);
	      $course_addsources = $arResult['PROPERTIES']['course_addsources']['~VALUE'];
	      $course_other =$arResult['PROPERTIES']['course_other']['~VALUE'];
	      $course_filename = $arResult['PROPERTIES']['course_filename']['VALUE'];
	      $course_idcategory = strip_tags($arResult['DISPLAY_PROPERTIES']['course_idcategory']);
	      //$course_linkedcourses = nl2br($arResult['PROPERTIES']['course_linkedcourses']['VALUE']);


          $course_puproses = checkHtml($course_puproses);
          $course_audience = checkHtml($course_audience);
          $course_addsources = checkHtml($course_addsources);
          $course_other = checkHtml($course_other);



	      $course_topics_html_text = $arResult['PROPERTIES']['course_top_html']['VALUE']['TEXT'];
	      $course_topics_html_type = $arResult['PROPERTIES']['course_top_html']['VALUE']['TYPE'];
	      //iwrite($arResult['PROPERTIES']['course_top_html']);
	      if (($course_topics_html_type=="text") or ($course_topics_html_type=="TEXT")) {

	      	$course_topics = nl2br($course_topics_html_text);
	      } else {
	      	$course_topics = $arResult['PROPERTIES']['course_top_html']['~VALUE']['TEXT'];
	      }

	      $course_desc_html_text = $arResult['PROPERTIES']['course_desc_new']['VALUE']['TEXT'];
	      $course_desc_html_type = $arResult['PROPERTIES']['course_desc_new']['VALUE']['TYPE'];
	      if (($course_desc_html_type=="text") or ($course_desc_html_type=="TEXT")) {
	      	$course_description = nl2br($course_desc_html_text);
	      } else {
	      	$course_description = $arResult['PROPERTIES']['course_desc_new']['~VALUE']['TEXT'];
	      }
          //iwrite($arResult['PROPERTIES']['course_linked_new']);
	      $course_linked_html_text = $arResult['PROPERTIES']['course_linked_new']['VALUE']['TEXT'];
	      $course_linked_html_type = $arResult['PROPERTIES']['course_linked_new']['VALUE']['TYPE'];
	      if (($course_linked_html_type=="text") or ($course_linked_html_type=="TEXT")){
	      	$course_linkedcourses = nl2br($course_linked_html_text);
	      } else {
	      	$course_linkedcourses = $arResult['PROPERTIES']['course_linked_new']['~VALUE']['TEXT'];
	      }
          //iwrite($arResult['PROPERTIES']['course_req_new']);
	      $course_required_html_text = $arResult['PROPERTIES']['course_req_new']['VALUE']['TEXT'];
	      $course_required_html_type = $arResult['PROPERTIES']['course_req_new']['VALUE']['TYPE'];
	      if (($course_required_html_type=="text") or ($course_required_html_type=="TEXT")){
	      	$course_required = nl2br($course_required_html_text);
	      } else {
	      	$course_required = $arResult['PROPERTIES']['course_req_new']['~VALUE']['TEXT'];
	      }

	      //$course_topics = nl2br($arResult['PROPERTIES']['course_topics']['VALUE']);
 ?>
<h2><?=$course_name?></h2>
<span class="st">Код:</span>
<p class="indent" id="course_code"><?=$course_code?></p>

<?if (strlen($arResult["PREVIEW_PICTURE"]["SRC"])) {?>
<img class="" border="0" src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>"
 width="<?=$arResult["PREVIEW_PICTURE"]["WIDTH"]?>"
 height="<?=$arResult["PREVIEW_PICTURE"]["HEIGHT"]?>"
 alt="<?=$arResult["PREVIEW_PICTURE"]["DESCRIPTION"]?>" title="<?=$arResult["NAME"]?>" />
  <div class="clear"> </div>
<? } ?>

<? if(!$course_owner=="")  {  ?>
	<span class="st">Владелец:</span>
	<p class="indent"><?=$course_owner?></p>
<? } ?>
<?if (strlen($arResult['PROPERTIES']['course_format']['VALUE_ENUM_ID'])>0) {?>
	<span class="st">Формат:</span>
	<?
	//VALUE_ENUM_ID = 102 - Очный
	//VALUE_ENUM_ID = 103 - Онлайн  }
	//получим код связанного курса и подставим в урл
		$arSelectFields = array("ID", "NAME", "PROPERTY_COURSE_CODE", "CODE");
		$arFilter = Array("IBLOCK_ID"=>6, "ID"=>$arResult['PROPERTIES']['linked_format_id']['VALUE']);
		$res = CIBlockElement::GetList(array(), $arFilter, false, array(), $arSelectFields);
		while($ob = $res->GetNextElement())
			{
				$arFieldsLinked = $ob->GetFields();

			}
	?>
	<p class="indent">
	<? if($arResult['PROPERTIES']['course_format']['VALUE_ENUM_ID'] == 102)  { ?>
		Очный
		<?
		$titleName = $arResult["NAME"]. " (очный)";
		$APPLICATION->SetPageProperty("blue_title", $titleName);
		?>
		<?if ($arResult['PROPERTIES']['linked_format_id']['VALUE']>0){?>
(<a href="/internal/catalog/<?=$arFieldsLinked['CODE']?>/">перейти к онлайн версии</a>)
<?/*    (<a href="/training/catalog/course.html?ID=<?=$arResult['PROPERTIES']['linked_format_id']['VALUE']?>">перейти к онлайн версии</a>)
 */?>		<? } ?>
	<? } ?>
	<? if($arResult['PROPERTIES']['course_format']['VALUE_ENUM_ID'] == 103)  { ?>
		<a href="/training/online/rules.html">Online (дистанционный)</a>
		<?
		$titleName = $arResult["NAME"]. " (online)";
		$APPLICATION->SetPageProperty("blue_title", $titleName);
		?>
		<?if ($arResult['PROPERTIES']['linked_format_id']['VALUE']>0){?>

(<a href="/internal/catalog/<?=$arFieldsLinked['CODE']?>/">перейти к очной версии</a>)

<?/*
          (<a href="/training/catalog/course.html?ID=<?=$arResult['PROPERTIES']['linked_format_id']['VALUE']?>">перейти к очной версии</a>)
*/?>		<? } ?>
	<? } ?>
	</p>

<? } ?>

<? if(strlen($course_description)>1)  {  ?>
	<span class="st">Описание:</span>
	<?if ($course_desc_html_type=="TEXT"){?>
	<p class="indent"><?=$course_description?></p>
	<? } else {?>
		<br /><div class="indent"><?=$course_description?></div><br />
	<? }?>
<? } ?>

<? if(!$course_puproses=="")  {  ?>
	<span class="st">Цели:</span>
	<div class="indent"><?=$course_puproses?></div><br />
<? } ?>
<? if(strlen($course_topics)>1)  {  ?>
	<span class="st">Разбираемые темы:</span>
	<?if ($course_topics_html_type=="TEXT"){?>
		<p class="indent"><?=$course_topics?></p>
	<? } else {?>
		<br /><div class="indent"><?=$course_topics?></div><br />
	<? }?>
<? } ?>
<? if(!$course_audience=="")  {  ?>
	<span class="st">Целевая аудитория:</span>
	<div class="indent"><?=$course_audience?></div><br />
<? } ?>

<? if(strlen($course_required)>1)  {  ?>
	<span class="st">Предварительная подготовка – общее:</span>
	<?if (strtoupper($course_required_html_type)=="TEXT"){?>
	<p class="indent"><?=$course_required?></p>
	<? } else {?>
		<br /><div class="indent"><?=$course_required?></div>
	<? }?>
<? } ?>



<?  //ID_PREDV_COURSES  course_format
	$varNumberPredvCourses  =  count($arResult["PROPERTIES"]["ID_PREDV_COURSES"]["VALUE"]);
	$arIDCourses = array();
	if  (($varNumberPredvCourses > 0) and  array_key_exists("0", $arResult["PROPERTIES"]["ID_PREDV_COURSES"]["VALUE"])){?>
	<br /><span class="st">Предварительная подготовка – курсы УЦ:</span>
	<div class="indent">
         <blockquote>
			<ul class="linked">
		<?
			$arOrder = array("PROPERTY_COURSE_FORMAT" =>"DESC", "PROPERTY_COURSE_CODE" =>"ASC"); // DESC - онлайн курсы позади
			$arFilter = array("IBLOCK_ID"=>6, "ACTIVE"=>"Y" , "ID"=>$arResult["PROPERTIES"]["ID_PREDV_COURSES"]["VALUE"]);
			$arGroupBy = false;
			//$arGroupBy = array("PROPERTY_COURSE_FORMAT");
			$arNavStartParams = array();
			$arSelectFields = array("ID", "NAME", "PROPERTY_COURSE_CODE", "PROPERTY_COURSE_FORMAT", "PROPERTY_COURSE_DURATION" );
			$res = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, $arNavStartParams, $arSelectFields);
			$index = 0; $tempVariable ="";
			while($ob = $res->GetNextElement())
			{
				$arFields = $ob->GetFields();?>
				<? if ($index == 0)  {
                	 $tempVariable = $arFields["PROPERTY_COURSE_FORMAT_ENUM_ID"];
                }?>
				<? if (($index == 0)  and ($arFields["PROPERTY_COURSE_FORMAT_ENUM_ID"] == 102)){
                	echo "<li class='trname'>Очные курсы:</li>";
                }?>
				<? if (($index == 0)  and ( $arFields["PROPERTY_COURSE_FORMAT_ENUM_ID"] == 103) or
					($tempVariable <> $arFields["PROPERTY_COURSE_FORMAT_ENUM_ID"])) {
                	echo "<br /><li class='trname'>Online курсы:</li>";
                }?>
                <?
                // ">=PROPERTY_STARTDATE" => $todayDate, "PROPERTY_SCHEDULE_COURSE"=>$arIDCourses
                // check курсы в раписании, если есть то выводим
				$arFilterTimetable = Array("IBLOCK_ID"=>9, "PROPERTY_SCHEDULE_COURSE"=>$arFields["ID"],
					 "ACTIVE" => "Y", ">=PROPERTY_STARTDATE" => date("Y-m-d"));
				$arGroupByTimetable = false;
				$arNavStartParamsTimetable = array("nTopCount" => 3);
				$arOrderTimetable = array("PROPERTY_SCHEDULE_COURSE" => "ASC");
				$arSelectFieldsTimetable = Array(
				"ID",
				"NAME",
				"PROPERTY_STARTDATE",
				"PROPERTY_REGISTRATION_LINK",
				"PROPERTY_COURSE_CODE",
				"PROPERTY_SCHEDULE_DURATION",
				"PROPERTY_STARTDATE",
				"PROPERTY_ENDDATE",
				"PROPERTY_CITY.NAME",
				"PROPERTY_CITY"
				);
				$indexTimetable = false;
				$resTimetable = CIBlockElement::GetList($arOrderTimetable, $arFilterTimetable, $arGroupByTimetable,
					$arNavStartParamsTimetable, $arSelectFieldsTimetable);
				$number = 0;
				$dateSomeCourses = "";
				while($obTimetable = $resTimetable->GetNextElement())
				{
					$arFieldsTimetable = $obTimetable->GetFields();
					$indexTimetable = true;
					if ($number !== 0){
						$dateSomeCourses .= ", ";
					}
					//iwrite($arFieldsTimetable);
					$dateSomeCourses .= $arFieldsTimetable['PROPERTY_STARTDATE_VALUE'];
            		if (strlen($arFieldsTimetable['PROPERTY_ENDDATE_VALUE'])>0){
            			$dateSomeCourses .= "-". $arFieldsTimetable['PROPERTY_ENDDATE_VALUE'];
            		}
	            	if ($arFieldsTimetable['PROPERTY_CITY_VALUE'] <> 14909){
            			$dateSomeCourses .= " (". $arFieldsTimetable['PROPERTY_CITY_NAME']. ")";
            		}
            		$number = $number + 1;
				}
                ?>
	            <li><a href="/internal/catalog/<?=$arFields['PROPERTY_COURSE_CODE_VALUE']?>/">
	            	<?=$arFields['PROPERTY_COURSE_CODE_VALUE']?> &ndash;
	            	<?=$arFields['NAME']?><?if (!$indexTimetable){?>
	            		</a>
                    <? } ?><?
	            	if ($indexTimetable){
	            		if (strlen($arFields['PROPERTY_COURSE_DURATION_VALUE'])>0){
	            			echo ", ".$arFields['PROPERTY_COURSE_DURATION_VALUE']. " час.";
	            		}
	            		echo "</a>, ";
	            		echo $dateSomeCourses;
	            	}
	            	?>


	            </li>
                <? $index = $index + 1;
                   $tempVariable = $arFields["PROPERTY_COURSE_FORMAT_ENUM_ID"];
                 ?>
			<? } ?>
			</ul>
         </blockquote>
	</div><br />
	<? } ?>

<?  //ID_PREDV_COURSES  course_format
	$varNumberLinkedCourses  =  count($arResult["PROPERTIES"]["ID_LINKED_COURSES"]["VALUE"]);
	$arIDCourses = array();
	if  (($varNumberLinkedCourses > 0) and  array_key_exists("0", $arResult["PROPERTIES"]["ID_LINKED_COURSES"]["VALUE"])){?>
	<span class="st">Связанные курсы:</span>
	<div class="indent">
           <blockquote>
			<ul class="linked">
		<?
			$arOrder = array("PROPERTY_COURSE_FORMAT" =>"DESC", "PROPERTY_COURSE_CODE" =>"ASC"); // DESC - онлайн курсы позади
			$arFilter = array("IBLOCK_ID"=>6, "ACTIVE"=>"Y" , "ID"=>$arResult["PROPERTIES"]["ID_LINKED_COURSES"]["VALUE"]);
			$arGroupBy = false;
			//$arGroupBy = array("PROPERTY_COURSE_FORMAT");
			$arNavStartParams = array();
			$arSelectFields = array("ID", "NAME", "PROPERTY_COURSE_CODE", "PROPERTY_COURSE_FORMAT", "PROPERTY_COURSE_DURATION" );
			$res = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, $arNavStartParams, $arSelectFields);
			$index = 0; $tempVariable ="";
			while($ob = $res->GetNextElement())
			{
				$arFields = $ob->GetFields();?>
				<? if ($index == 0)  {
                	 $tempVariable = $arFields["PROPERTY_COURSE_FORMAT_ENUM_ID"];
                }?>
				<? if (($index == 0)  and ($arFields["PROPERTY_COURSE_FORMAT_ENUM_ID"] == 102)){
                	echo "<li class='trname'>Очные курсы:</li>";
                }?>
				<? if (($index == 0)  and ( $arFields["PROPERTY_COURSE_FORMAT_ENUM_ID"] == 103) or
					($tempVariable <> $arFields["PROPERTY_COURSE_FORMAT_ENUM_ID"])) {
                	echo "<br /><li class='trname'>Online курсы:</li>";
                }?>
                <? // ">=PROPERTY_STARTDATE" => $todayDate, "PROPERTY_SCHEDULE_COURSE"=>$arIDCourses
                // check курсы в раписании, если есть то выводим
				$arFilterTimetable = Array("IBLOCK_ID"=>9, "PROPERTY_SCHEDULE_COURSE"=>$arFields["ID"],
					 "ACTIVE" => "Y", ">=PROPERTY_STARTDATE" => date("Y-m-d"));
				$arGroupByTimetable = false;
				$arNavStartParamsTimetable = array("nTopCount" => 3);
				$arOrderTimetable = array("PROPERTY_SCHEDULE_COURSE" => "ASC");
				$arSelectFieldsTimetable = Array(
				"ID",
				"NAME",
				"PROPERTY_STARTDATE",
				"PROPERTY_REGISTRATION_LINK",
				"PROPERTY_COURSE_CODE",
				"PROPERTY_SCHEDULE_DURATION",
				"PROPERTY_STARTDATE",
				"PROPERTY_ENDDATE",
				"PROPERTY_CITY.NAME",
				"PROPERTY_CITY"
				);
				$indexTimetable = false;
				$resTimetable = CIBlockElement::GetList($arOrderTimetable, $arFilterTimetable, $arGroupByTimetable,
					$arNavStartParamsTimetable, $arSelectFieldsTimetable);
				$dateSomeCourses = "";
				$number = 0;
				while($obTimetable = $resTimetable->GetNextElement())
				{
					$arFieldsTimetable = $obTimetable->GetFields();
					$indexTimetable = true;
					if ($number !== 0){
						$dateSomeCourses .= ", ";
					}
					//iwrite($arFieldsTimetable);
					$dateSomeCourses .= $arFieldsTimetable['PROPERTY_STARTDATE_VALUE'];
            		if (strlen($arFieldsTimetable['PROPERTY_ENDDATE_VALUE'])>0){
            			$dateSomeCourses .= "-". $arFieldsTimetable['PROPERTY_ENDDATE_VALUE'];
            		}
	            	if ($arFieldsTimetable['PROPERTY_CITY_VALUE'] <> 14909){
            			$dateSomeCourses .= " (". $arFieldsTimetable['PROPERTY_CITY_NAME']. ")";
            		}
            		$number = $number + 1;
				}
                ?>
	            <li><a href="/internal/catalog/<?=$arFields['PROPERTY_COURSE_CODE_VALUE']?>/">
	            	<?=$arFields['PROPERTY_COURSE_CODE_VALUE']?> &ndash;
	            	<?=$arFields['NAME']?><?if (!$indexTimetable){?>
	            		</a>
                    <? } ?><?
	            	if ($indexTimetable){
	            		if (strlen($arFields['PROPERTY_COURSE_DURATION_VALUE'])>0){
	            			echo ", ".$arFields['PROPERTY_COURSE_DURATION_VALUE']. " час.";
	            		}
	            		echo "</a>, ";
	            		echo $dateSomeCourses;
	            	}
	            	?>

	            </li>
                <? $index = $index + 1;
                   $tempVariable = $arFields["PROPERTY_COURSE_FORMAT_ENUM_ID"];
                 ?>
			<? } ?>
			</ul>
			</blockquote>
	</div><br />
	<? } ?>


<? if(strlen($course_linkedcourses)>1)  {  ?>
	<span class="st">Связанные курсы:</span>
	<?if ($course_linked_html_type=="TEXT"){?>
	<p class="indent"><?=$course_linkedcourses?></p>
	<? } else {?>
		<br /><div class="indent"><?=$course_linkedcourses?></div><br />
	<? }?>
<? } ?>


<? if(!$course_addsources=="")  {  ?>
	<span class="st">Рекомендуемые дополнительные материалы, источники:</span>
	<div class="indent"><?=$course_addsources?></div><br />
<? } ?>
<? if(!$course_classrequirements=="")  {  ?>
	<span class="st">Требования к классу:</span>
	<p class="indent"><?=$course_classrequirements?></p>
<? } ?>
<? if(!$course_other=="")  {  ?>
	<span class="st">Примечание:</span>
	<div class="indent"><?=$course_other?></div><br />
<? } ?>
<? if(!$course_titlefile=="")  {  ?>
	<span class="st">Дополнительные файлы:</span>
	<p class="indent"><a href="<?php echo $course_file ?>"><?php echo $course_titlefile; ?></a></p>
<? } ?>
<?
	$arEventInfo["NAME"] = $arResult["NAME"];
	$arEventInfo["CODE"] = $course_code;
	//$arEventInfo["DATE"] = $startdate;
	$arEventInfo["TYPE_ID"] = 78;
	//$arEventInfo["EVENT_CITY"] = $city_name;
/*
	78 - Курсы
	79 - Школы
	80 - Семинары
	81 - Круглые столы
	82 - Конференции
*/
?>



