<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<style type="text/css">
    #counter br { clear: both; }
    .cntSeparator {
        font-size: 54px;
        margin: 0px 4px;
        color: #000;
        line-height: 56px;
    }
    .desc { margin: 7px 3px; }
    .desc div {
        float: left;
        font-family: Arial;
        width: 70px;
        margin-right: 65px;
        font-size: 13px;
        font-weight: bold;
        color: #000;
    }
    .cntDigit {
        margin-left: 3px;
    }
    .tran-time {
        margin-bottom: 10px;
        font-size: 15px;
    }


</style>
<script type="text/javascript">
    $(function(){
        $('.lang-it').click(function(){
            if ($(this).hasClass('active')) {
                return false;
            } else {
                $('.change-it').css('display', 'none');
                $('.'+$(this).attr('rel')).css('display', 'block');
                $('.lang-it').removeClass('active');
                $(this).addClass('active');

            }
        });
		if (window.location.hash == '#ru-ver') {
			$('a.lang-it[rel="second-wr"]').trigger('click');
		}
    })
</script>
<?
global  $gCourseFormat;
	$gCourseFormat = false;
global  $arEventInfo ;
?>

	  <?

          //print_r($arResult['PROPERTIES']['course_tran_puproses']);
	      $course_puproses = $arResult['PROPERTIES']['course_puproses']['~VALUE'];
          $course_tran_puproses = $arResult['PROPERTIES']['tran_course_puproses']['~VALUE'];
	      $course_audience = $arResult['PROPERTIES']['course_audience']['~VALUE'];
          $course_tran_audience = $arResult['PROPERTIES']['tran_course_audience']['~VALUE'];
	      $course_linkedcourses = nl2br($arResult['PROPERTIES']['course_linkedcourses']['VALUE']);
	      $course_requirements = nl2br($arResult['PROPERTIES']['course_requirements']['VALUE']);
		  $course_tran_req = nl2br($arResult['PROPERTIES']['tran_course_req']['VALUE']);
	      $course_addsources = $arResult['PROPERTIES']['course_addsources']['~VALUE'];
	      $course_other =$arResult['PROPERTIES']['course_other']['~VALUE'];
          $course_puproses = checkHtmlN($course_puproses);
          $course_tran_puproses = checkHtmlN($course_tran_puproses);
          $course_audience = checkHtmlN($course_audience);
          $course_tran_audience = checkHtmlN($course_tran_audience);
          $course_addsources = checkHtmlN($course_addsources);
          $course_other = checkHtmlN($course_other);


	      $course_topics_html_text = $arResult['PROPERTIES']['course_top_html']['VALUE']['TEXT'];
	      $course_topics_html_type = $arResult['PROPERTIES']['course_top_html']['VALUE']['TYPE'];
	      if (($course_topics_html_type=="text") or ($course_topics_html_type=="TEXT")) {
	      	$course_topics = nl2br($course_topics_html_text);
	      } else {
	      	$course_topics = $arResult['PROPERTIES']['course_top_html']['~VALUE']['TEXT'];
	      }
          $course_tran_topics_html_text = $arResult['PROPERTIES']['tran_course_top_html']['VALUE']['TEXT'];
          $course_tran_topics_html_type = $arResult['PROPERTIES']['tran_course_top_html']['VALUE']['TYPE'];
          if (($course_tran_topics_html_type=="text") or ($course_tran_topics_html_type=="TEXT")) {
              $course_tran_topics = nl2br($course_tran_topics_html_text);
          } else {
              $course_tran_topics = $arResult['PROPERTIES']['tran_course_top_html']['~VALUE']['TEXT'];
          }

	      $course_desc_html_text = $arResult['PROPERTIES']['course_desc_new']['VALUE']['TEXT'];
          $course_desc_html_type = $arResult['PROPERTIES']['course_desc_new']['VALUE']['TYPE'];
		
		
		if (($course_desc_html_type=="text") or ($course_desc_html_type=="TEXT")) {
	      	$course_description = nl2br($course_desc_html_text);
	      } else {
			
	      	$course_description = $arResult['PROPERTIES']['course_desc_new']['~VALUE']['TEXT'];
	      }
		
        $course_tran_desc_html_text = $arResult['PROPERTIES']['tran_course_desc_new']['VALUE']['TEXT'];
        $course_tran_desc_html_type = $arResult['PROPERTIES']['tran_course_desc_new']['VALUE']['TYPE'];
        if (($course_tran_desc_html_type=="text") or ($course_tran_desc_html_type=="TEXT")) {
              $course_tran_description = nl2br($course_tran_desc_html_text);
			  
          } else {
		
            $course_tran_description = $arResult['PROPERTIES']['tran_course_desc_new']['~VALUE']['TEXT'];
			 
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
		  $course_tran_required_html_text = $arResult['PROPERTIES']['tran_course_req']['VALUE']['TEXT'];
	      $course_tran_required_html_type = $arResult['PROPERTIES']['tran_course_req']['VALUE']['TYPE'];
	      if (($course_tran_required_html_type=="text") or ($course_tran_required_html_type=="TEXT")){
	      	$course_tran_required = nl2br($course_required_html_text);
	      } else {
	      	$course_tran_required = $arResult['PROPERTIES']['tran_course_req']['~VALUE']['TEXT'];
	      }
		  
?>
	<div itemprop="name" class="course-head-wrap" <?if(strlen($course_tran_description)>1) {?>style="padding-right:60px"<?}?> content="Курс '<?=$arResult["NAME"]?>'"><h2><?=$arResult["NAME"]?></h2>
       <?if(strlen($course_tran_description)>1) {?><div class="choose-lang"><a href="javascript:void(0)" rel="first-wr" class="lang-it active">En</a><a href="javascript:void(0)" rel="second-wr" class="lang-it">Ru</a></div><?}?>
    </div>
	
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


    <?$c_time= strtotime($arResult["PROPERTIES"]["countdown_time"]["VALUE"])-time()?>
    <?$time=seconds2times($c_time)?>
     <?foreach ($time as $key=>$tm) {?>
        <?if (strlen($tm)==0) {?>
            <?$time[$key]="00";?>
        <?} elseif (strlen($tm)==1) {?>
            <?$time[$key]="0".$tm;?>
        <?}?>
    <?}?>
    <?if (intval($c_time)>0) {?>
        <?$strtime=$time[3].":".$time[2].":".$time[1].":".$time[0]?>
        <script type="text/javascript">
            $(function(){

                $('#counter').countdown({
                    digitWidth: 41,
                    digitHeight: 60,
                    digitImages: 3,
                    image: '/images/flippers.png',
                    startTime: '<?=$strtime?>'
                });
                $('#counter-another').countdown({
                    digitWidth: 41,
                    digitHeight: 60,
                    digitImages: 3,
                    image: '/images/flippers.png',
                    startTime: '<?=$strtime?>'
                });
            })
        </script>
    <?}?>
	<?/*if ($arResult["DETAIL_PICTURE"]) {?>
		<div class="cour-det-img" style="margin-bottom: 10px;">
			<img src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>" height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>" />
		</div>
	<?}*/?>
	<span class="st">Длительность:</span>
	<p class="indent"><?=$arResult['PROPERTIES']['course_duration']['VALUE']?> ч.</p>
    <div class="change-it first-wr">
    <span class="st"><?echo GetMessage("COURSE_DESC_HEADER");?>:</span>
	<?if ($course_desc_html_type=="TEXT"){?>
	<p class="indent"> <div itemprop="description"><?=$course_description?></div></p>
	<? } else {?>
		<br /><div class="indent"><div itemprop="description"><?=$course_description?></div></div><br />
	<? }?>
	
<? } else { ?>
	 <div class="change-it first-wr">
<?}?>      
<br/>
<?if(!$course_puproses=="")  {  ?>
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
<?if  (intval($c_time)>0) {?>
         <div class="tran-time"><b><?if (($arResult['PROPERTIES']['course_code']['VALUE']=="PTRN-007") || ($arResult['PROPERTIES']['course_code']['VALUE']=="PTRN-015")) {?>До окончания действия специального предложения осталось:<?} else {?>
		 	<?if (strlen($arResult["PROPERTIES"]["timer_text"]['VALUE'])>0) {echo $arResult["PROPERTIES"]["timer_text"]['VALUE'];} else {?>До окончания регистрации на тренинг осталось:<?}?>
		 <?}?></b></div>


        <div class="indent">
            <div id="counter">

            </div>
			<div class="under-time">
				<div class="under-item">
					Дней
				</div>
				<div class="under-item">
					Часов
				</div>
				<div class="under-item">
					Минут
				</div>
				<div class="under-item">
					Секунд
				</div>
				<div style="clear:both"></div>
			</div>
        </div>
		
    <?}?>
	<br/>
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
    </div>
    <div class='change-it second-wr'>
        <span class="st"><?echo GetMessage("COURSE_DESC_HEADER");?>:</span>
        <?if ($course_tran_desc_html_type=="TEXT"){?>
            <p class="indent"> <div itemprop="description"><?=$course_tran_description?></div></p>
        <? } else {?>
            <br /><div class="indent"><div itemprop="description"><?=$course_tran_description?></div></div><br />
        <? }?>
        <br/>
        <? if(!$course_tran_puproses=="")  {  ?>
        <span class="st"><?echo GetMessage("COURSE_PURPOSES_HEADER");?>:</span>
        <div class="indent"><?=$course_tran_puproses?></div><br />
        <? } ?>

        <? if(strlen($course_tran_topics)>1)  {  ?>
                <span class="st"><?echo GetMessage("COURSE_TOPICS_HEADER");?>:</span>
                <?if ($course_tran_topics_html_type=="TEXT"){?>
                <p class="indent"><?=$course_tran_topics?></p>
                <? } else {?>
            <br /><div class="indent"><?=$course_tran_topics?></div><br />
                <? }?>
        <? } ?>
		<?if  (intval($c_time)>0) {?>
         <div class="tran-time"><b><?if (($arResult['PROPERTIES']['course_code']['VALUE']=="PTRN-007") || ($arResult['PROPERTIES']['course_code']['VALUE']=="PTRN-015")) {?>До окончания действия специального предложения осталось:<?} else {?>
		 	<?if (strlen($arResult["PROPERTIES"]["timer_text"]['VALUE'])>0) {echo $arResult["PROPERTIES"]["timer_text"]['VALUE'];} else {?>До окончания регистрации на тренинг осталось:<?}?>
		 <?}?></b></div>


        <div class="indent">
            <div id="counter-another">

            </div>
			<div class="under-time">
				<div class="under-item">
					Дней
				</div>
				<div class="under-item">
					Часов
				</div>
				<div class="under-item">
					Минут
				</div>
				<div class="under-item">
					Секунд
				</div>
				<div style="clear:both"></div>
			</div>
        </div>
		<?}?>
		<br/>
        <? if ($arResult['PROPERTIES']['ID_COURSE_TYPE']['VALUE']>0){ ?>
                <span class="st"><?echo GetMessage("COURSE_TYPE_COURSE");?>:</span>
                <div class="indent"><strong><?=$arResult['PROPERTIES']['ID_COURSE_TYPE']['TYPE_NAME']?>:</strong> <?=$arResult['PROPERTIES']['ID_COURSE_TYPE']['TYPE_PREVIEW']?></div><br />
                <? } ?>

        <? if($course_audience)  {  ?>
                <span class="st"><?echo GetMessage("COURSE_AUDIENCE_HEADER");?>:</span>
                <div class="indent"><?=$course_tran_audience?></div><br />
                <? } ?>

        <? if(($arResult['PROPERTIES']['ID_COURSE_OWNER']['VALUE_ENUM_ID'] == 120) or
                ($arResult['PROPERTIES']['ID_COURSE_OWNER']['VALUE_ENUM_ID'] == 121)){ ?>
                <span class="st"><?echo GetMessage("COURSE_CERTIFIED_HEADER");?>:</span>
                <div class="indent"><?echo GetMessage("COURSE_CERTIFIED_TEXT");?></div><br />
                <? } ?>

        <? if(strlen($course_tran_required)>1)  {  ?>
                <span class="st"><?echo GetMessage("COURSE_BEFORE_HEADER");?>:</span>
                <?if (strtoupper($course_tran_required_html_type)=="TEXT"){?>
                <p class="indent"><?=$course_tran_required?></p>
                <? } else {?>
            <br /><div class="indent"><?=$course_tran_required?></div><br />
                <? }?>
        <? } ?>
		
    </div>
<? /*if(count($arResult['LINKED_CLASSES'])>0)  {  ?>
	<span class="st"><?echo GetMessage("COURSE_IS_INCLUDED_NEXT_CLASSESS");?>:</span>
	<blockquote>
		<ul>
			<?foreach($arResult['LINKED_CLASSES'] as $arLinkedClass){?>
				<li><a href="/training/catalog/code/<?=$arLinkedClass['CODE']?>/"><?=$arLinkedClass['NAME']?></a></li>
			<? } ?>
		</ul>
	</blockquote>
<? } */?>

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
	$arEventInfo["ID"] = $arResult["ID"];
	$arEventInfo["CODE"] = $arResult['PROPERTIES']['course_code']['VALUE'];
	$arEventInfo["TYPE_ID"] = 78;
/*
	78 - пїЅпїЅпїЅпїЅпїЅ
	79 - пїЅпїЅпїЅпїЅпїЅ
	80 - пїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅ
	81 - пїЅпїЅпїЅпїЅпїЅпїЅпїЅ пїЅпїЅпїЅпїЅпїЅ
	82 - пїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅ
*/
?>



