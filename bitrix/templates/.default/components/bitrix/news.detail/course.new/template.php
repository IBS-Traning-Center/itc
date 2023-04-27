<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
global  $gCourseFormat;
	$gCourseFormat = false;
global  $arEventInfo ;
?>

	  <?
	      $course_puproses = $arResult['PROPERTIES']['course_puproses']['~VALUE'];
	      $course_audience = $arResult['PROPERTIES']['course_audience']['~VALUE'];
	      $course_linkedcourses = nl2br($arResult['PROPERTIES']['course_linkedcourses']['VALUE']);
	      $course_requirements = nl2br($arResult['PROPERTIES']['course_requirements']['VALUE']);
	      $course_addsources = $arResult['PROPERTIES']['course_addsources']['~VALUE'];
	      $course_other =$arResult['PROPERTIES']['course_other']['~VALUE'];
          $course_puproses = checkHtmlN($course_puproses);
          $course_audience = checkHtmlN($course_audience);
          $course_addsources = checkHtmlN($course_addsources);
          $course_other = checkHtmlN($course_other);

	      $course_topics_html_text = $arResult['PROPERTIES']['course_top_html']['VALUE']['TEXT'];
	      $course_topics_html_type = $arResult['PROPERTIES']['course_top_html']['VALUE']['TYPE'];
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

	      $course_linked_html_text = $arResult['PROPERTIES']['course_linked_new']['VALUE']['TEXT'];
	      $course_linked_html_type = $arResult['PROPERTIES']['course_linked_new']['VALUE']['TYPE'];
	      if (($course_linked_html_type=="text") or ($course_linked_html_type=="TEXT")){
	      	$course_linkedcourses = nl2br($course_linked_html_text);
	      } else {
	      	$course_linkedcourses = $arResult['PROPERTIES']['course_linked_new']['~VALUE']['TEXT'];
	      }

	      $course_required_html_text = $arResult['PROPERTIES']['course_req_new']['VALUE']['TEXT'];
	      $course_required_html_type = $arResult['PROPERTIES']['course_req_new']['VALUE']['TYPE'];
	      if (($course_required_html_type=="text") or ($course_required_html_type=="TEXT")){
	      	$course_required = nl2br($course_required_html_text);
	      } else {
	      	$course_required = $arResult['PROPERTIES']['course_req_new']['~VALUE']['TEXT'];
	      }
?>
	<span itemprop="name" content="Курс '<?=$arResult["NAME"]?>'"><h2><?=$arResult["NAME"]?></h2></span>
	
	<span class="st"><?echo GetMessage("COURSE_CODE_HEADER");?>:</span>
	<p class="indent" id="course_code"><?=$arResult['PROPERTIES']['course_code']['VALUE']?></p>



<? if(($arResult['PROPERTIES']['ID_COURSE_OWNER']['VALUE_ENUM_ID'] == 120) or
	($arResult['PROPERTIES']['ID_COURSE_OWNER']['VALUE_ENUM_ID'] == 121) or
	(strlen($arResult['PROPERTIES']['course_owner']['VALUE']) > 0)) {  ?>
	<span class="st"><?echo GetMessage("COURSE_OWNER_HEADER");?>:</span>
	<p class="indent">
		<? if(($arResult['PROPERTIES']['ID_COURSE_OWNER']['VALUE_ENUM_ID'] == 120) or
			($arResult['PROPERTIES']['ID_COURSE_OWNER']['VALUE_ENUM_ID'] == 121)){ ?>
			<?echo GetMessage("COURSE_OWNER_LUXOFT");?>
		<? }else{ ?>
			<?=$arResult['PROPERTIES']['course_owner']['VALUE']?>
		<? } ?>
	</p>
<? } ?>

	
	<span itemprop="offerDetails" itemscope itemtype="http://data-vocabulary.org/Offer">
		<meta itemprop="price" content="<?=$arResult["PROPERTIES"]["course_price"]["VALUE"]?>" />
		<meta itemprop="currency" content="RUB" />
	</span>
	

<? if(strlen($course_description)>1)  {  ?>
	<span class="st"><?echo GetMessage("COURSE_DESC_HEADER");?>:</span>
	<?if ($course_desc_html_type=="TEXT"){?>
	<p class="indent"> <span itemprop="description"><?=$course_description?></span></p>
	<? } else {?>
		<br /><div class="indent"><span itemprop="description"><?=$course_description?></span></div><br />
	<? }?>
<? } ?>

<? if(!$course_puproses=="")  {  ?>
	<span class="st"><?echo GetMessage("COURSE_PURPOSES_HEADER");?>:</span>
	<div class="indent"><?=$course_puproses?></div><br />
<? } ?>

<? if(strlen($course_topics)>1)  {  ?>
	<span class="st"><?echo GetMessage("COURSE_TOPICS_HEADER");?>:</span>
	<?if ($course_topics_html_type=="TEXT"){?>
		<p class="indent"><?=$course_topics?></p>
	<? } else {?>
		<br /><div class="indent"><?=$course_topics?></div><br />
	<? }?>
<? } ?>

<? if ($arResult['PROPERTIES']['ID_COURSE_TYPE']['VALUE']>0){ ?>
	<span class="st"><?echo GetMessage("COURSE_TYPE_COURSE");?>:</span>
	<div class="indent"><strong><?=$arResult['PROPERTIES']['ID_COURSE_TYPE']['TYPE_NAME']?>:</strong> <?=$arResult['PROPERTIES']['ID_COURSE_TYPE']['TYPE_PREVIEW']?></div><br />
<? } ?>

<? if($course_audience)  {  ?>
	<span class="st"><?echo GetMessage("COURSE_AUDIENCE_HEADER");?>:</span>
	<div class="indent"><?=$course_audience?></div><br />
<? } ?>

<?/* if(($arResult['PROPERTIES']['ID_COURSE_OWNER']['VALUE_ENUM_ID'] == 120) or
	($arResult['PROPERTIES']['ID_COURSE_OWNER']['VALUE_ENUM_ID'] == 121)){ ?>
		<span class="st"><?echo GetMessage("COURSE_CERTIFIED_HEADER");?>:</span>
		<div class="indent"><?echo GetMessage("COURSE_CERTIFIED_TEXT");?></div><br />
<? } */?>

<? if(strlen($course_required)>1)  {  ?>
	<span class="st"><?echo GetMessage("COURSE_BEFORE_HEADER");?>:</span>
	<?if (strtoupper($course_required_html_type)=="TEXT"){?>
	<p class="indent"><?=$course_required?></p>
	<? } else {?>
		<br /><div class="indent"><?=$course_required?></div><br />
	<? }?>
<? } ?>

<? if(count($arResult['LINKED_CLASSES'])>0)  {  ?>
	<span class="st"><?echo GetMessage("COURSE_IS_INCLUDED_NEXT_CLASSESS");?>:</span>
	<blockquote>
		<ul>
			<?foreach($arResult['LINKED_CLASSES'] as $arLinkedClass){?>
				<li><a href="/training/catalog/code/<?=$arLinkedClass['CODE']?>/"><?=$arLinkedClass['NAME']?></a></li>
			<? } ?>
		</ul>
	</blockquote>
<? } ?>

<?  //ID_PREDV_COURSES  course_format
	$arIDCourses = array();
	if  (count($arResult['ADDITONAL']['PREDVARIT']) > 0) {?>
	<br /><span class="st"><?echo GetMessage("COURSE_BEFORELUXOFT_HEADER");?>:</span>
	<div class="indent">
         <blockquote>
			<ul class="linked">
				<? foreach ($arResult['ADDITONAL']['PREDVARIT'] as $arPredvCourses) {?>
	            <li>
					<a href="/training/catalog/course.html?ID=<?=$arPredvCourses['COURSE_ID']?>">
						<?=$arPredvCourses['COURSE_CODE']?> &ndash;
						<?=$arPredvCourses['COURSE_NAME']?>
					<?if (!count($arPredvCourses['TIMETABLE'])){?>
						</a>
                    <? } ?>
					<?if (count($arPredvCourses['TIMETABLE'])){
	            		if (strlen($arPredvCourses['COURSE_DURATION'])>0)
	            			echo ", ".$arPredvCourses['COURSE_DURATION']. " ".GetMessage("HOURS");
	            		?>
						</a>
						<? 
						$number  = 0; $vCourseDates = "";
						foreach ($arPredvCourses['TIMETABLE'] as $arTimetable) {
							if ($number !== 0)
								$vCourseDates .= ", ";
							$vCourseDates .= $arTimetable['TIMETABLE_STARTDATE'];
							if (strlen($arTimetable['TIMETABLE_ENDDATE'])>0){
								$vCourseDates .= "-". $arTimetable['TIMETABLE_ENDDATE'];
							}
							if ($arTimetable['TIMETABLE_CITY_ID'] <> CITY_ID_ONLINE){
								$vCourseDates .= " (". $arTimetable['TIMETABLE_CITY_NAME']. ")";
							}
							$number = $number + 1;
						}	
						echo ", ".$vCourseDates;						
					}
	            	?>
	            </li>				
				<? } ?>
			</ul>
         </blockquote>
	</div><br />
	<? } ?>

<?  //ID_Linked_COURSES  course_format
	if  (count($arResult['ADDITONAL']['LINKED'])>0){?>
	<span class="st"><?echo GetMessage("COURSE_LINKEDCOURSES_HEADER");?>:</span>
	<div class="indent">
           <blockquote>
			<ul class="linked">
				<? foreach ($arResult['ADDITONAL']['LINKED'] as $arLinkedCourses) {?>
	            <li>
					<a href="/training/catalog/course.html?ID=<?=$arLinkedCourses['COURSE_ID']?>">
						<?=$arLinkedCourses['COURSE_CODE']?> &ndash;
						<?=$arLinkedCourses['COURSE_NAME']?>
					<?if (!count($arLinkedCourses['TIMETABLE'])){?>
						</a>
                    <? } ?>
					<?if (count($arLinkedCourses['TIMETABLE'])){
	            		if (strlen($arLinkedCourses['COURSE_DURATION'])>0)
	            			echo ", ".$arLinkedCourses['COURSE_DURATION']. " ".GetMessage("HOURS");
	            		?>
						</a>
						<? 
						$number  = 0; $vCourseDates = "";
						foreach ($arLinkedCourses['TIMETABLE'] as $arTimetable) {
							if ($number !== 0)
								$vCourseDates .= ", ";
							$vCourseDates .= $arTimetable['TIMETABLE_STARTDATE'];
							if (strlen($arTimetable['TIMETABLE_ENDDATE'])>0){
								$vCourseDates .= "-". $arTimetable['TIMETABLE_ENDDATE'];
							}
							if ($arTimetable['TIMETABLE_CITY_ID'] <> CITY_ID_ONLINE){
								$vCourseDates .= " (". $arTimetable['TIMETABLE_CITY_NAME']. ")";
							}
							$number = $number + 1;
						}	
						echo ", ".$vCourseDates;						
					}
	            	?>
	            </li>				
				<? } ?>		
			</ul>
			</blockquote>
	</div><br />
	<? } ?>
<? if(strlen($course_linkedcourses)>1)  {  ?>
	<span class="st"><?echo GetMessage("COURSE_LINKED_HEADER");?>:</span>
	<?if ($course_linked_html_type=="TEXT"){?>
	<p class="indent"><?=$course_linkedcourses?></p>
	<? } else {?>
		<br /><div class="indent"><?=$course_linkedcourses?></div><br />
	<? }?>
<? } ?>


<? if(!$course_addsources=="")  {  ?>
	<span class="st"><?echo GetMessage("COURSE_RECOMMEND_HEADER");?>:</span>
	<div class="indent"><?=$course_addsources?></div><br />
<? } ?>
<? if(!$course_classrequirements=="")  {  ?>
	<span class="st"><?echo GetMessage("COURSE_REQ_HEADER");?>:</span>
	<p class="indent"><?=$course_classrequirements?></p>
<? } ?>
<? if(!$course_other=="")  {  ?>
	<span class="st"><?echo GetMessage("COURSE_ADDITIONAL_HEADER");?>:</span>
	<div class="indent"><?=$course_other?></div><br />
<? } ?>
<? if(!$course_titlefile=="")  {  ?>
	<span class="st"><?echo GetMessage("COURSE_FILES_HEADER");?>:</span>
	<p class="indent"><a href="<?php echo $course_file ?>"><?php echo $course_titlefile; ?></a></p>
<? } ?>

<?
	$arEventInfo["NAME"] = $arResult["NAME"];
	$arEventInfo["CODE"] = $arResult['PROPERTIES']['course_code']['VALUE'];
	$arEventInfo["TYPE_ID"] = 78;
/*
	78 - Курсы
	79 - Школы
	80 - Семинары
	81 - Круглые столы
	82 - Конференции
*/
?>



