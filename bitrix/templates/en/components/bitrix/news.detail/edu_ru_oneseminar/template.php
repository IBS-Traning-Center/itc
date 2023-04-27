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
		global  $startdateGlobal, $glFlagShowForm, $arEventInfo ;
		//iwrite($arResult);
		$glFlagShowForm  = true;
		$seminar_name = $arResult["NAME"];
		$typeEventName = "Семинар";
		if ($arResult["PROPERTIES"]["type_event"]["VALUE_ENUM_ID"]==92){
			$typeEventName = "Вебинар";
		}
		$idTrener = $arResult['PROPERTIES']['trener']['VALUE'];
		$arTrener["SURNAME"] = "";
		if (strlen($arResult['PROPERTIES']['trener']['VALUE'])>0){
			$arOrder = array();
			$arSort = array();
			$arFilter = array("IBLOCK_ID"=>56, "ID"=>$arResult['PROPERTIES']['trener']['VALUE']);
			$arGroupBy = false;
			$arNavStartParams = array();
			$arSelectFields = array("ID", "NAME", "PROPERTY_EXPERT_SHORT", "PROPERTY_EXPERT_NAME", "CODE");
			$res = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, $arNavStartParams, $arSelectFields);
			$index = 0;
			while($ob = $res->GetNextElement())
			{
				$arFields = $ob->GetFields();
				$arTrener["SURNAME"] = $arFields["NAME"];
				$arTrener["ID"] = $arFields["ID"];
				$arTrener["CODE"] = $arFields["CODE"];
				$arTrener["NAME"] = $arFields["PROPERTY_EXPERT_NAME_VALUE"];
				$arTrener["DESC"] = $arFields["PROPERTY_EXPERT_SHORT_VALUE"];
	   		}
		}
		$seminar_id = $arResult["ID"];
		$location = $arResult['PROPERTIES']['location']['VALUE'];
		$lecturer = $arResult['PROPERTIES']['lecturer']['VALUE'];
		$startdate = $arResult['PROPERTIES']['startdate']['VALUE'];
$datetime = $startdate;
$format = "DD.MM.YYYY HH:MI:SS";
$arr = ParseDateTime($datetime, $format);
$startdate = $arr["DD"].".".$arr["MM"].".".$arr["YYYY"];
		$startdateGlobal = $startdate;
		//$description = nl2br($arResult['PROPERTIES']['description']['VALUE']);
		$description = nl2br(strip_tags($arResult['PROPERTIES']['description']['~VALUE'], '<a>'));
		$content = nl2br($arResult['PROPERTIES']['content']['VALUE']);
		$people = nl2br($arResult['PROPERTIES']['people']['VALUE']);
		$time = $arResult['PROPERTIES']['time']['VALUE'];
		$titlefile = $arResult['PROPERTIES']['titlefile']['VALUE'];
		$city_id = $arResult['PROPERTIES']['city']['VALUE'];
		$arSelect = Array("NAME");
		$arFilter = Array("IBLOCK_ID"=>"51","ID"=>$city_id);
		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		while($ar_fields = $res->GetNext())
		{
			$city_name= $ar_fields["NAME"];
		}
$APPLICATION->SetTitle($typeEventName.": ".$arResult["NAME"]);
$APPLICATION->SetPageProperty("title", $typeEventName.": ".$arResult["NAME"]);
$APPLICATION->SetPageProperty("blue_title", $arResult["NAME"]);



 ?>

<? if(strlen($arResult["PREVIEW_TEXT"])>0)  {  ?>
	<div class="floated_right_nc w70">
		<div class="buble_body">
			<h2>Организаторы:</h2>
		</div>
		<?=$arResult["PREVIEW_TEXT"]?>
	</div>
<? } ?>

<h2><?=$typeEventName?>: <?=$seminar_name?></h2>
<? if(strlen($arResult["DETAIL_TEXT"])>1)  {?>
	<div class="floated_right w70"><?=$arResult["DETAIL_TEXT"]?></div>
<? } ?>

<span id="event_city_name" style="display:none;"><?=$city_name?></span>
<? if(!$startdate=="")  {  ?>
	<span class="st">Дата проведения:</span>
	<p class="indent" id="from_event_date"><?=$startdate?>
<a data-type="SeminarPage" data-action="AddToCalendar" data-name="<?=$startdate?> <?=$seminar_name?>" rel="nofollow" class="js-tracking" href="/events/seminar/ics.html?ID=<?=$arResult['ID']?>" title="Добавить событие в календарь" ><img class="floated_right" border=0 src="/downloads/images/file_ical.png" width="48"></a>
</p>
<? } ?>
<? if(!$time=="")  {  ?>
	<span class="st">Время:</strong></span>
	<p class="indent"><?=$time?>
<? if ($arResult["PROPERTIES"]["type_event"]["VALUE_ENUM_ID"]==92){?>
 (мск.)
<? } ?>
</p>
<? } ?>
<? if(!$location=="")  {  ?>
	<span class="st">Место проведения:</span>
	<p class="indent"><?=$location?></p>
<? } ?>

<? if((strlen($arTrener["SURNAME"]) == 0) and (strlen($lecturer) > 0 ))  {  ?>
	<span class="st">Докладчик</span> <br />
	<p class="indent"><?=nl2br($lecturer)?></p>
	<? if(strlen($arResult["PREVIEW_PICTURE"]["SRC"])>0)  {  ?>
		<p class="indent"><img src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arResult["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arResult["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arResult["PREVIEW_PICTURE"]["DESCRIPTION"]?>" class="" border="0"></p>
	<? } ?>
<? } ?>

<? if(strlen($arTrener["SURNAME"])>0)  {  ?>
	<span class="st">Докладчик</span> <br />
	<p class="indent"><a target="_blank" href="/about/experts/<?=$arTrener['CODE']?>.html"><?=$arTrener["SURNAME"]?> <?=$arTrener["NAME"]?></a> &mdash; <?=$arTrener["DESC"]?></p>
	<? if(strlen($arResult["PREVIEW_PICTURE"]["SRC"])>0)  {  ?>
		<p class="indent"><img src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arResult["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arResult["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arResult["PREVIEW_PICTURE"]["DESCRIPTION"]?>" class="" border="0"></p>
	<? } ?>
<? } ?>
<? if ($arResult["PROPERTIES"]["type_event"]["VALUE_ENUM_ID"]==92){?>
	<div class="floated_right w70">
		<span class="links "><a class="orange" href="/events/seminar/webinar_rules.html">Правила участия в вебинаре</a></span>
	</div><br />
<? } ?>
<? if((strlen($description)>0) or (strlen($arResult['PROPERTIES']['ADDITIONAL_DESC']['~VALUE']['TEXT'])>0))  {  ?>
	<span class="st l">Краткое описание</span><br />
	<? if(strlen($description)>0)  {  ?>	
		<p class="indent"><?=$description?></p>
	<? } ?>
	<? if(strlen($arResult['PROPERTIES']['ADDITIONAL_DESC']['~VALUE']['TEXT'])>0)  {  ?>
		<div class="indent" style="padding-bottom:10px;"><?=$arResult['PROPERTIES']['ADDITIONAL_DESC']['~VALUE']['TEXT']?></div>
	<? } ?>

<? } ?>


<?
$uri = "http://www.luxoft-training.ru";
$uri .= GetPagePath(false,false);
//iwrite($uri);
?>
<div class="floated_right w100">
<!--
<iframe src="http://www.facebook.com/plugins/like.php?href=<?=$uri?>&amp;layout=box_count&amp;show_faces=true&amp;width=450&amp;action=recommend&amp;colorscheme=light&amp;locale=ru_RU&amp;height=65" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:65px;" allowTransparency="true"></iframe>
-->
<div id="fb-root"></div>
 <script>
     window.fbAsyncInit = function() 
    {
         // init the FB JS SDK
         FB.init(
         {
            appId : '225734987442328', 
            channelUrl : '//WWW.LUXOFT-TRAINING.RU',
            status : true, 
            cookie : true, 
            xfbml : true 
        }); 
     }; 
     (function(d)
     {
         var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement('script'); js.id = id; js.async = true;
         js.src = "//connect.facebook.net/ru_RU/all.js";
         ref.parentNode.insertBefore(js, ref);
     }(document));
 </script>
<div class="fb-like" data-href="<?=$uri?>" data-send="false" data-layout="box_count" data-width="450" data-show-faces="false"></div>


<br /><br />

<g:plusone></g:plusone>
<script type="text/javascript">
  window.___gcfg = {lang: 'ru'};

  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>

</div>



<? if(!$content=="")  {  ?>
	<span class="st">Содержание</span>
	<p class="indent"><?=$content?></p>
<? } ?>


<? if(!$people=="")  {  ?>
	<span class="st">Целевая аудитория</span>
	<p class="indent"><?=$people?></p>
<? } ?>
<?/* //ID_LINKED_COURSES
	$varNumberLinkedCourses  =  count($arResult["PROPERTIES"]["ID_LINKED_COURSES"]["VALUE"]);
	//iwrite($arResult["PROPERTIES"]["ID_LINKED_COURSES"]);
	$arIDCourses = array();
	if  (($varNumberLinkedCourses > 0) and  array_key_exists("0", $arResult["PROPERTIES"]["ID_LINKED_COURSES"]["VALUE"])){?>
	<span class="st">Связанные курсы</span>
	<div class="indent">
	<table width="" border="0" cellspacing=6>  <tbody>
	<?
		$arOrder = array();
		$arSort = array();
		$arFilter = array("IBLOCK_ID"=>6, "ACTIVE"=>"Y" , "ID"=>$arResult["PROPERTIES"]["ID_LINKED_COURSES"]["VALUE"]);
		$arGroupBy = false;
		$arNavStartParams = array();
		$arSelectFields = array("ID", "NAME", "PROPERTY_COURSE_CODE");
		$res = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, $arNavStartParams, $arSelectFields);
		while($ob = $res->GetNextElement())
		{
			$arFields = $ob->GetFields();?>
            <tr><td><a href="/training/catalog/course.html?ID=<?=$arFields['ID']?>">
            	<?=$arFields['PROPERTY_COURSE_CODE_VALUE']?></a></td><td>&nbsp;</td>
            	<td><a href="/training/catalog/course.html?ID=<?=$arFields['ID']?>"><?=$arFields['NAME']?></a></td></tr>

		<?}
	?>
	</tbody> </table>
	</div>
	<?}

*/?>

<?  //ID_PREDV_COURSES  course_format
	$varNumberLinkedCourses  =  count($arResult["PROPERTIES"]["ID_LINKED_COURSES"]["VALUE"]);
	//iwrite($arResult["PROPERTIES"]["ID_LINKED_COURSES"]["VALUE"]);
	$arIDCourses = array();
	if  (($varNumberLinkedCourses > 0) and  array_key_exists("0", $arResult["PROPERTIES"]["ID_LINKED_COURSES"]["VALUE"])){?>
	<span class="st">Связанные курсы</span>
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
                <?//iwrite($arFields);
                ?>
                <? // ">=PROPERTY_STARTDATE" => $todayDate, "PROPERTY_SCHEDULE_COURSE"=>$arIDCourses
                // check курсы в раписании, если есть то выводим
				$arFilterTimetable = Array("IBLOCK_ID"=>9, "PROPERTY_SCHEDULE_COURSE"=>$arFields["ID"],
					 "ACTIVE" => "Y", ">=PROPERTY_STARTDATE" => date("Y-m-d"));
				$arGroupByTimetable = false;
				$arNavStartParamsTimetable = array("nTopCount" => 1);
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
					"PROPERTY_CITY",
				);
				//Можно выбрать и значения свойств элементов по значениям свойства типа
				// "Привязка к элементам". Для этого необходимо указать  PROPERTY_<PROPERTY_CODE>.PROPERTY_<PROPERTY_CODE2>,
				//  где PROPERTY_CODE - ID или мнемонический код свойства привязки, а PROPERTY_CODE2
				//  - свойство указанного в привязке элемента.
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
	            <li><a href="/training/catalog/course.html?ID=<?=$arFields['ID']?>">
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
	</div>
	<? } ?>




<? if(strlen($arResult["PROPERTIES"]["file"]["VALUE"]) > 0)  {  ?>
	<span class="st">Дополнительные файлы</span>
	<p class="indent"><a  href="<?=CFile::GetPath($arResult["PROPERTIES"]["file"]["VALUE"])?>">
	<? if(strlen($arResult["PROPERTIES"]["titlefile"]["VALUE"]) > 0) {?>
		<?=$arResult["PROPERTIES"]["titlefile"]["VALUE"]?>
		<? } else {?>
		Скачать
		<? } ?>
	</a></p>
<? } ?>
<?if (($arResult["PROPERTIES"]["FLAG_CLOSE_REG"]["VALUE_ENUM_ID"] <> 101) and ($arResult["ID"] !== "28375")) {?>
	<p><span class="st">Участие в мероприятии бесплатное при условии предварительной регистрации.</span><br /></p>
<? } ?>
<? global $USER;
if ($USER->IsAdmin()) {
	//print_r($arResult['PROPERTIES']);
	//echo $arResult["PROPERTIES"]["code_hml"]["~VALUE"];
	//iwrite($arResult);
};
?>
<?if ($arResult["PROPERTIES"]["FLAG_CLOSE_REG"]["VALUE_ENUM_ID"] == 101) {
	$glFlagShowForm = false;
}?>
<?//iwrite($arResult["PROPERTIES"]["FLAG_CLOSE_REG"]);
?>
<?
	$arEventInfo["NAME"] = $arResult["NAME"];
	$arEventInfo["CODE"] = "";
	$arEventInfo["DATE"] = $startdate;
	$arEventInfo["TYPE_ID"] = 80;
	$arEventInfo["EVENT_CITY"] = $city_name;
	if ($arResult["PROPERTIES"]["type_event"]["VALUE_ENUM_ID"]==92){
		$arEventInfo["EVENT_CITY"] = "Онлайн";
		$arEventInfo["WEBINAR"] = "TRUE";
	}
/*
	78 - Курсы
	79 - Школы
	80 - Семинары
	81 - Круглые столы
	82 - Конференции
*/
?>

    <?
    $uri = $APPLICATION->GetCurUri("r1=socialicons");
    $uri_twitter = $APPLICATION->GetCurUri("r1=socialicons&r2=twt");
    ?>
    <script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script>
    <script type="text/javascript"> 
        var YaShareInstance = new Ya.share({
            element: 'ya_share',
            elementStyle: {
                        type: 'none',
                        quickServices: ['', 'yaru', 'vkontakte', 'facebook', 'twitter', 'odnoklassniki', 'moimir', 'lj', 'moikrug', 'evernote', 'greader']
            },
            onready: function(instance) {
                        instance.updateShareLink(
                            "<?echo "http://www.luxoft-training.ru".$uri;?>",
                            "<?echo $typeEventName.": ".$arResult["NAME"].", ".$startdate;?>",
                            {
                               twitter: {link: '<?echo "http://www.luxoft-training.ru".$uri_twitter;?>', title: '<?echo $typeEventName.": ".$arResult["NAME"].", ".$startdate." @TrainingLuxoft";?>'}
                            }
                        );
            }
        });
        YaShareInstance.updateShareLink('http://www.luxoft-training.ru/', 'УЦ Luxoft');
    </script> 
    <div id="ya_share"></div> 
    <br />

