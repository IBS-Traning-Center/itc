<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if (count($arResult["PROPERTIES"]["REASONS"]["VALUE"])==5) {
	$arSelect = Array("NAME", "PREVIEW_TEXT");
	$arFilter = Array("IBLOCK_ID"=>117, "ID"=>$arResult["PROPERTIES"]["REASONS"]["VALUE"], "ACTIVE"=>"Y");
	$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, Array("nPageSize"=>50), $arSelect);
	while($ob = $res->GetNextElement())
	{
	 $arResult["REASONS"][] = $ob->GetFields();
	}
}
$arResult["CURR_DATE"]=FormatDate("j F", time());
if (time()>strtotime($arResult["PROPERTIES"]["START_DATE"]["VALUE"]) && time()<strtotime($arResult["PROPERTIES"]["SECOND_DATE"]["VALUE"])) {
	$arResult["CURR_ETAP"] = 1;
	$arResult["CURR_PRICE"]= $arResult["PROPERTIES"]["FIRST_PRICE"]["VALUE"];
	$all=strtotime($arResult["PROPERTIES"]["SECOND_DATE"]["VALUE"])-strtotime($arResult["PROPERTIES"]["START_DATE"]["VALUE"]);
	$now=time()-strtotime($arResult["PROPERTIES"]["START_DATE"]["VALUE"]);
	$arResult["CURRENT_PERCENT"]=round($now/$all*100);
} elseif (time()>strtotime($arResult["PROPERTIES"]["SECOND_DATE"]["VALUE"]) && time()<strtotime($arResult["PROPERTIES"]["THIRD_DATE"]["VALUE"])) {
	$arResult["CURR_ETAP"] = 2;
	$arResult["CURR_PRICE"]= $arResult["PROPERTIES"]["SECOND_PRICE"]["VALUE"];
	$all=strtotime($arResult["PROPERTIES"]["THIRD_DATE"]["VALUE"])-strtotime($arResult["PROPERTIES"]["SECOND_DATE"]["VALUE"]);
	$now=time()-strtotime($arResult["PROPERTIES"]["SECOND_DATE"]["VALUE"]);
	$arResult["CURRENT_PERCENT"]=round($now/$all*100);
} elseif (time()>strtotime($arResult["PROPERTIES"]["THIRD_DATE"]["VALUE"]) && time()<strtotime($arResult["PROPERTIES"]["FOURTH_DATE"]["VALUE"])) {
	$arResult["CURR_ETAP"] = 3;
	$arResult["CURR_PRICE"]= $arResult["PROPERTIES"]["THIRD_PRICE"]["VALUE"];
	$all=strtotime($arResult["PROPERTIES"]["FOURTH_DATE"]["VALUE"])-strtotime($arResult["PROPERTIES"]["THIRD_DATE"]["VALUE"]);
	$now=time()-strtotime($arResult["PROPERTIES"]["THIRD_DATE"]["VALUE"]);
	$arResult["CURRENT_PERCENT"]=round($now/$all*100);
} elseif (time()>strtotime($arResult["PROPERTIES"]["THIRD_DATE"]["VALUE"]) && time()<strtotime($arResult["PROPERTIES"]["FIFTH_DATE"]["VALUE"])) {
	$arResult["CURR_ETAP"] = 4;
	$arResult["CURR_PRICE"]= $arResult["PROPERTIES"]["FOURTH_PRICE"]["VALUE"];
	$all=strtotime($arResult["PROPERTIES"]["FIFTH_DATE"]["VALUE"])-strtotime($arResult["PROPERTIES"]["FOURTH_DATE"]["VALUE"]);
	$now=time()-strtotime($arResult["PROPERTIES"]["FOURTH_DATE"]["VALUE"]);
	$arResult["CURRENT_PERCENT"]=round($now/$all*100);
}

if (intval($arResult["PROPERTIES"]["FIRST_PRICE"]["VALUE"])>0 && intval($arResult["PROPERTIES"]["SECOND_PRICE"]["VALUE"])>0 && intval($arResult["PROPERTIES"]["THIRD_PRICE"]["VALUE"])>0 && intval($arResult["PROPERTIES"]["FOURTH_PRICE"]["VALUE"])>0) {
	$arResult["ETAPS_COUNT"]=4;
} elseif (intval($arResult["PROPERTIES"]["FIRST_PRICE"]["VALUE"])>0 && intval($arResult["PROPERTIES"]["SECOND_PRICE"]["VALUE"])>0 && intval($arResult["PROPERTIES"]["THIRD_PRICE"]["VALUE"])>0) {
	$arResult["ETAPS_COUNT"]=3;
} elseif (intval($arResult["PROPERTIES"]["FIRST_PRICE"]["VALUE"])>0 && intval($arResult["PROPERTIES"]["SECOND_PRICE"]["VALUE"])>0) {
	$arResult["ETAPS_COUNT"]=2;
} elseif (intval($arResult["PROPERTIES"]["FIRST_PRICE"]["VALUE"])>0) {
	$arResult["ETAPS_COUNT"]=1;
}

	
		  $arCourse=GetIblockElement($arResult["PROPERTIES"]["COURSE"]["VALUE"]);
		 /*print_r($arCourse);
		 die();*/
		  $arScheduleCourse=GetIblockElement($arResult["PROPERTIES"]["TIME_COURSE"]["VALUE"]);
		  $course_tran_topics_html_text = $arCourse['PROPERTIES']['tran_course_top_html']['VALUE']['TEXT'];
          $course_tran_topics_html_type = $arCourse['PROPERTIES']['tran_course_top_html']['VALUE']['TYPE'];
		 $arResult["COURSE"]["NAME"]=$arCourse["NAME"];
		 $arResult["COURSE"]["CODE"]=$arCourse["CODE"];
		 $arResult["COURSE"]["SCHEDULED"]=$arScheduleCourse;
		 $arResult["COURSE"]["DESCRIPTION"]=htmlspecialchars_decode($arCourse['PROPERTIES']['HTML_DESC']['VALUE']['TEXT']);
		 $arResult["COURSE"]["OBJ"]=htmlspecialchars_decode($arCourse['PROPERTIES']['HTML_OBJECTIVES']['VALUE']['TEXT']);
		 $arResult["COURSE"]["TARGET"]=htmlspecialchars_decode($arCourse['PROPERTIES']['HTML_AUDIENCE']['VALUE']['TEXT']);
          if (($course_tran_topics_html_type=="text") or ($course_tran_topics_html_type=="TEXT")) {
				
              $arResult["COURSE"]["course_topics"] = nl2br($course_tran_topics_html_text);
          } else {
              $arResult["COURSE"]["course_topics"] = $arCourse['PROPERTIES']['tran_course_top_html']['~VALUE']['TEXT'];
          }
		if (strlen($arResult["COURSE"]["course_topics"])==0) {
			  $course_topics_html_text = $arCourse['PROPERTIES']['HTML_ROADMAP']['VALUE']['TEXT'];
			  $course_topics_html_type = $arCourse['PROPERTIES']['HTML_ROADMAP']['VALUE']['TYPE'];
			  if (($course_topics_html_type=="text") or ($course_topics_html_type=="TEXT")) {
				$arResult["COURSE"]["course_topics"] = nl2br($course_topics_html_text);
			  } else {
				$arResult["COURSE"]["course_topics"]  = $arCourse['PROPERTIES']['HTML_ROADMAP']['~VALUE']['TEXT'];
			  }
          }
		  if (strlen($arResult["COURSE"]["course_puproses"])==0) {
			  $arResult["COURSE"]["course_puproses"] = $arCourse['PROPERTIES']['COURSE_PUPROSES']['~VALUE'];
          }
		  
	      $course_desc_html_text = $arCourse['PROPERTIES']['course_desc_new']['VALUE']['TEXT'];
          $course_desc_html_type = $arCourse['PROPERTIES']['course_desc_new']['VALUE']['TYPE'];
		  
		  
		 
		if (($course_desc_html_type=="text") or ($course_desc_html_type=="TEXT")) {
	      	$arResult["COURSE"]["course_description"] = nl2br($course_desc_html_text);
	      } else {
			
	      	$arResult["COURSE"]["course_description"] = $arCourse['PROPERTIES']['course_desc_new']['~VALUE']['TEXT'];
	      }
		
        
			  
	      

	      $course_required_html_text = $arCourse['PROPERTIES']['course_req_new']['VALUE']['TEXT'];
	      $course_required_html_type = $arCourse['PROPERTIES']['course_req_new']['VALUE']['TYPE'];
	      if (($course_required_html_type=="text") or ($course_required_html_type=="TEXT")){
	      	$arResult["COURSE"]["course_required"] = nl2br($course_required_html_text);
	      } else {
	      	$arResult["COURSE"]["course_required"]  = $arCourse['PROPERTIES']['course_req_new']['~VALUE']['TEXT'];
	      }
			
		  $arResult["COURSE"]["course_audience"] = $arCourse['PROPERTIES']['COURSE_AUDIENCE']['~VALUE'];
	GLOBAL $USER;
	
	$arSelect = Array("ID", "NAME", "DETAIL_TEXT", "PROPERTY_name", "PROPERTY_surname", "PROPERTY_review");
	$arFilter = Array("IBLOCK_ID"=> 61, "PROPERTY_course"=> $arResult["PROPERTIES"]["COURSE"]["VALUE"], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
	while($ob = $res->GetNextElement())
	{
	 $arFields = $ob->GetFields();
	 $arResult["REVIEW"][]=array('NAME'=>$arFields["PROPERTY_NAME_VALUE"], "SURNAME"=> $arFields["PROPERTY_SURNAME_VALUE"], "REVIEW_TEXT"=> $arFields["PROPERTY_REVIEW_VALUE"]);
	}
		//print_r($arResult["REVIEW"]);

	if (count($arResult["PROPERTIES"]["PARTNERS"]["VALUE"])>=1) {
		$arSelect = Array("NAME", "PREVIEW_PICTURE");
		$arFilter = Array("IBLOCK_ID"=>118, "ID"=>$arResult["PROPERTIES"]["PARTNERS"]["VALUE"], "ACTIVE"=>"Y");
		$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, Array("nPageSize"=>50), $arSelect);
		while($ob = $res->GetNextElement())
		{
		 $item = $ob->GetFields();
		 $arResult["PARTNERS"][]=array("NAME"=> $item["NAME"], "PREVIEW_PICTURE"=> CFile::GetFileArray($item["PREVIEW_PICTURE"]));
		}
	}
	

		
?> 