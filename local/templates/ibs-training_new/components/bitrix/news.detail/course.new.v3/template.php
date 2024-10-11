<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
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
$course_international_certificate = $arResult['PROPERTIES']['international_certificate']['VALUE'];


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
<div id="content" class="bg not-main-page gray">
    <div class="frame course-main-info">
        <div class="row clearfix">
            <div class="small-2">
                <b>Курс:</b> <?=$arResult['PROPERTIES']['course_code']['VALUE']?>
                <? if($arResult['PROPERTIES']['NEW_ICON']['VALUE'] == "Да"){ ?>
                    <i class="icon newone">new</i>
                <?}?>
                <br/>
                <b>Длительность:</b> <?=$arResult['PROPERTIES']['course_duration']['VALUE']?> ч.
                <?if (strlen($arResult['PROPERTIES']['course_owner']['VALUE'])>0)  {?><br/><b>Владелец курса:</b> <?=$arResult['PROPERTIES']['course_owner']['VALUE']?> <?}?>
                <? if($arResult['PROPERTIES']['ICON_PD_HOURS']['VALUE'] === 'Да') { ?>
                    <i class="course__icon-pd"></i>
                <? } ?>
            </div>
            <?/*<div class="small-2 align-right mobile-hidden ">
						<a href="#" class="file pdf">Скачать карточку курса</a>
					</div>*/?>
        </div>
        <div class="row clearfix">
            <div class="small-2 padding-right">
                <div class="descr-wrap margin-b-35" >
                    <h2 id="description">Описание</h2>
                    <?=$course_description?>
                </div>
                <div class="descr-wrap">
                    <h2 id="themes">Разбираемые темы</h2>
                    <?=$course_topics?>
                </div>
            </div>
            <div class="small-2 padding-left">
                <div class="desr-wrap margin-b-35">
                    <h2 id="goals">Цели</h2>
                    <?=$course_puproses?>
                </div>
                <div class="desr-wrap margin-b-35">
                    <h2 id="auditory">Целевая аудитория</h2>
                    <?=$course_audience?>

                </div>
                <?if (strlen($course_required)>0) {?>
                    <div class="descr-wrap margin-b-35" >
                        <h2 id="description">Предварительная подготовка</h2>
                        <?if (strtoupper($course_required_html_type)=="TEXT"){?>
                            <?=$course_required?>
                        <? } else {?>
                            <?=$course_required?>
                        <? }?>
                    </div>
                <?}?>
            </div>
        </div>
        <div class="certficate">
            <?php if (!is_null($course_international_certificate)): ?>
                После окончания курса
                выдаётся международный сертификат ICAgile
                <?php else: ?>После окончания курса выдаётся сертификат на бланке Luxoft Training<?php endif ?>
        </div>
    </div>
</div>

<?/* if(($arResult['PROPERTIES']['ID_COURSE_OWNER']['VALUE_ENUM_ID'] == 120) or
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
<? } ?*/?>


<span itemprop="offerDetails" itemscope itemtype="http://data-vocabulary.org/Offer">
		<meta itemprop="price" content="<?=$arResult["PROPERTIES"]["course_price"]["VALUE"]?>" />
		<meta itemprop="currency" content="RUB" />
	</span>


<?/* if(strlen($course_description)>1)  {  ?>






    <div class="change-it first-wr">
    <div class="item-section">
    <div class="st"><?echo GetMessage("COURSE_DESC_HEADER");?>:</div>
	<?if ($course_desc_html_type=="TEXT"){?>
	    <p class="indent"> <div itemprop="description"><?=$course_description?></div></p>
	<? } else {?>
		<div class="indent"><div itemprop="description"><?=$course_description?></div></div><br />
	<? }?>
	</div>
<? } else { ?>
	 <div class="change-it first-wr">
<?}?>
<?if(!$course_puproses=="")  {  ?>
    <div class="item-section">
	    <div class="st"><?echo GetMessage("COURSE_PURPOSES_HEADER");?>:</div>
	    <div class="indent"><?=$course_puproses?></div>
    </div>
<? } ?>

<? if(strlen($course_topics)>1)  {  ?>
    <div class="item-section">
	<div class="st"><?echo GetMessage("COURSE_TOPICS_HEADER");?>:</div>
	<?if ($course_topics_html_type=="TEXT"){?>
		<p class="indent"><?=$course_topics?></p>
	<? } else {?>
		<div class="indent"><?=$course_topics?></div><br />
	<? }?>
     </div>
<? } ?>

<? if ($arResult['PROPERTIES']['ID_COURSE_TYPE']['VALUE']>0){ ?>
    <div class="item-section">
	    <div class="st"><?echo GetMessage("COURSE_TYPE_COURSE");?>:</div>
	    <div class="indent"><strong><?=$arResult['PROPERTIES']['ID_COURSE_TYPE']['TYPE_NAME']?>:</strong> <?=$arResult['PROPERTIES']['ID_COURSE_TYPE']['TYPE_PREVIEW']?></div>
    </div>
<? } ?>

<? if($course_audience)  {  ?>
<div class="item-section">
	<div class="st"><?echo GetMessage("COURSE_AUDIENCE_HEADER");?>:</div>
	<div class="indent"><?=$course_audience?></div>
    </div>
<? } ?>

<?/* if(($arResult['PROPERTIES']['ID_COURSE_OWNER']['VALUE_ENUM_ID'] == 120) or
	($arResult['PROPERTIES']['ID_COURSE_OWNER']['VALUE_ENUM_ID'] == 121)){ ?>
		<span class="st"><?echo GetMessage("COURSE_CERTIFIED_HEADER");?>:</span>
		<div class="indent"><?echo GetMessage("COURSE_CERTIFIED_TEXT");?></div><br />
<? } */?>

<? /*if(strlen($course_required)>1)  {  ?>
    <div class="item-section">
	<div class="st"><?echo GetMessage("COURSE_BEFORE_HEADER");?>:</div>
	<?if (strtoupper($course_required_html_type)=="TEXT"){?>
	<p class="indent"><?=$course_required?></p>
	<? } else {?>
    <div class="indent"><?=$course_required?></div><br />
	<? }?>
    </div>
<? } ?>
    </div>
    <div class='change-it second-wr'>
		<div class="item-section">
        <div class="st"><?echo GetMessage("COURSE_DESC_HEADER");?>:</div>
        <?if ($course_tran_desc_html_type=="TEXT"){?>
            <p class="indent"> <div itemprop="description"><?=$course_tran_description?></div></p>
        <? } else {?>
            <div class="indent"><div itemprop="description"><?=$course_tran_description?></div></div><br />
        <? }?>
        </div>
        <? if(!$course_tran_puproses=="")  {  ?>
		<div class="item-section">
			<div class="st"><?echo GetMessage("COURSE_PURPOSES_HEADER");?>:</div>
			<div class="indent"><?=$course_tran_puproses?></div><br />
		</div>
        <? } ?>

        <? if(strlen($course_tran_topics)>1)  {  ?>
				<div class="item-section">
                <div class="st"><?echo GetMessage("COURSE_TOPICS_HEADER");?>:</div>
                <?if ($course_tran_topics_html_type=="TEXT"){?>
                <p class="indent"><?=$course_tran_topics?></p>
                <? } else {?>
           <div class="indent"><?=$course_tran_topics?></div><br />
                <? }?>
				</div>
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
				<div class="item-section">
					<div class="st"><?echo GetMessage("COURSE_TYPE_COURSE");?>:</div>
					<div class="indent"><strong><?=$arResult['PROPERTIES']['ID_COURSE_TYPE']['TYPE_NAME']?>:</strong> <?=$arResult['PROPERTIES']['ID_COURSE_TYPE']['TYPE_PREVIEW']?></div>
                </div>
				<? } ?>

        <? if($course_tran_audience)  {  ?>
				<div class="item-section">
					<div class="st"><?echo GetMessage("COURSE_AUDIENCE_HEADER");?>:</div>
					<div class="indent"><?=$course_tran_audience?></div>
				</div>
                <? } ?>

        <? if(($arResult['PROPERTIES']['ID_COURSE_OWNER']['VALUE_ENUM_ID'] == 120) or
                ($arResult['PROPERTIES']['ID_COURSE_OWNER']['VALUE_ENUM_ID'] == 121)){ ?>
				<div class="item-section">
					<div class="st"><?echo GetMessage("COURSE_CERTIFIED_HEADER");?>:</div>
					<div class="indent"><?echo GetMessage("COURSE_CERTIFIED_TEXT");?></div>
				</div>
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
/*$arIDCourses = array();
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
<div class="item-section">
<div class="st"><?echo GetMessage("COURSE_LINKEDCOURSES_HEADER");?>:</div>
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
</div></div>
<? } ?>
<? if(strlen($course_linkedcourses)>1)  {  ?>
<div class="item-section">
<div class="st"><?echo GetMessage("COURSE_LINKED_HEADER");?>:</div>
<?if ($course_linked_html_type=="TEXT"){?>
<p class="indent"><?=$course_linkedcourses?></p>
<? } else {?>
    <div class="indent"><?=$course_linkedcourses?></div>
<? }?>
</div>
<? } ?>


<? if(!$course_addsources=="")  {  ?>
<div class="item-section">
<div class="st"><?echo GetMessage("COURSE_RECOMMEND_HEADER");?>:</div>
<div class="indent"><?=$course_addsources?></div>
</div>
<? } ?>
<? if(!$course_classrequirements=="")  {  ?>
<div class="item-section">
    <div class="st"><?echo GetMessage("COURSE_REQ_HEADER");?>:</div>
    <p class="indent"><?=$course_classrequirements?></p>
</div>
<? } ?>
<? if(!$course_other=="")  {  ?>
<div class="item-section">
<div class="st"><?echo GetMessage("COURSE_ADDITIONAL_HEADER");?>:</div>
<div class="indent"><?=$course_other?></div>
</div>
<? } ?>
<? if(!$course_titlefile=="")  {  ?>
<div class="item-section">
<div class="st"><?echo GetMessage("COURSE_FILES_HEADER");?>:</div>
<p class="indent"><a href="<?php echo $course_file ?>"><?php echo $course_titlefile; ?></a></p>
</div>
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
$arEventInfo["NAME"] = $arResult["NAME"];
$arEventInfo["ID"] = $arResult["ID"];
$arEventInfo["CODE"] = $arResult['PROPERTIES']['course_code']['VALUE'];
$arEventInfo["TYPE_ID"] = 78;
?>



