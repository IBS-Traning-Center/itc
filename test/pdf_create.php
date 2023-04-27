<?php
include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
/*
$html='
<pagefooter name="myFooter1" content-left="" content-center="{PAGENO}" content-right="Версия {DATE j.m.Y}" footer-style="font-size:8pt; color:#a1a1a1;" footer-style-left="" />
<style>
   h2 {
   font-size: 14pt;
   margin-top: 1pt;
   margin-bottom: 1pt;
   color: #3d3d3d;
   }
   h3 {
    font-size: 14pt;
    font-weight: bold;
   }
   h4 {
    font-size: 12pt;
    font-weight: bold;
   }
   body {
    font-family: Arial;
   }
    div.mpdf_toc {
       line-height: 16px;
       font-family: Arial;
    }
    a.mpdf_toc_a  {
	 font-size: 9pt;
     color: black !important;
     text-decoration: none;
    }
    div.mpdf_toc_level_1 {
	margin-left: 1em;
	text-indent: -2em;

    }
    .main-table {
        width: 100%;
        border-collapse: collapse;
    }
    .main-table table td{
    border: none;
    padding: 0;
    margin: 0;
    }
    .main-table table td.descr{
    border: none;
    padding: 5px;
    }
    .main-table .head td{
        color: #3d3d3d;
        padding: 5px;
        border-top: none;
        font-size: 12px;
    }
    .main-table td.duration{
        text-align: center;
    }
    .main-table td {
        font-size: 12px;
        padding: 10px;
        border-bottom: 1px solid #000000;
    }
</style>
<tocpagebreak paging="on" links="on"  toc-preHTML="&lt;h2&gt;Каталог тренингов Luxoft Training&lt;/h2&gt;&lt;br/&gt;Содержание" toc-bookmarkText="Content list" resetpagenum="1" pagenumstyle="1"  odd-header-value="on" odd-header-name="myHTMLHeader" even-header-name="myHTMLHeader" even-header-value="on" odd-footer-value="on" even-footer-name="myHTMLFooterEven" even-footer-value="on"/>
<setpagefooter name="myFooter1"/>
';

$mpdf = new \Mpdf\Mpdf([
	'mode' => 'UTF-8',
	'format' => 'A4-L',
	'margin_left' => 30,
	'margin_right' => 30,
	'margin_top' => 20,
]);
$mpdf->SetHTMLHeader('<div style="text-align: right;"><img src="/images/luxoft_training_pdf.jpg" alt="" title="" border="0"  /></div>');
$mpdf->WriteHTML($html);

$mpdf->h2toc = array('H3'=>0);
$mpdf->h2bookmarks = array('H3'=>0);

include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if(CModule::IncludeModule("iblock"))
{
    $ar_result=CIBlockSection::GetList(Array("LEFT_MARGIN"=> "ASC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>"94", "GLOBAL_ACTIVE"=>"Y", "ACTIVE"=>"Y"),false, Array());
    $t=0;
    while ($res=$ar_result->GetNext()){
        $arSection[$t]=$res;
        $count=CIBlockSection::GetCount(array("SECTION_ID"=>$res["ID"], "ACTIVE"=>"Y", "GLOBAL_ACTIVE"=>"Y"));
        if (intval($count)>0) {
            $arSection[$t]["IS_PARENT"]="Y";
        } else {
            $arSection[$t]["IS_PARENT"]="N";
        }
        $arSelect = Array("ID", "CODE", "NAME", "PROPERTY_PP_COURSE.NAME",  "PROPERTY_PP_COURSE.CODE", "PROPERTY_PP_COURSE.PROPERTY_COURSE_DURATION", "PROPERTY_PP_COURSE.PROPERTY_SHORT_DESCR", "DATE_ACTIVE_FROM");
        $arFilter = Array("IBLOCK_ID"=>94, "ACTIVE_DATE"=>"Y", "PROPERTY_PP_COURSE.ACTIVE"=>"Y", "!NAME"=>"%PTRN%", "SECTION_ID"=>$res["ID"],"ACTIVE"=>"Y");
        $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
        while($ob = $res->GetNextElement())
        {
           $arFields = $ob->GetFields();
           $arSection[$t]["ITEMS"][]=array("NAME"=>$arFields["PROPERTY_PP_COURSE_NAME"], "CODE"=>$arFields["PROPERTY_PP_COURSE_CODE"],"DURATION"=> $arFields["PROPERTY_PP_COURSE_PROPERTY_COURSE_DURATION_VALUE"], "DESCR"=> $arFields["PROPERTY_PP_COURSE_PROPERTY_SHORT_DESCR_VALUE"] );

        }
        $t++;
    }

}
foreach ($arSection as $key=>$section) {
	if ($section["DEPTH_LEVEL"]==1) {
        $mpdf->WriteHTML('<h3>'.iconv("windows-1251", "UTF-8", $section["NAME"]).'</h3>',2);
    } elseif ($section["DEPTH_LEVEL"]==2) {
		if ($section["ID"]==541) {
			 $mpdf->AddPage();

		}
        $mpdf->WriteHTML('<h4>'.iconv("windows-1251", "UTF-8",$section["NAME"]).'<tocentry content="'.iconv("windows-1251", "UTF-8", $section["NAME"]).'" level="1" /></h4>',2);
    }

    if (count($section["ITEMS"])>0) {
        $courses='<table cellspacing="0" cellpadding="0" class="main-table"><tr class="head"><td>Код</td><td>Название курса, краткое содержание</td><td style="width: 80px">Длит., ч.</td></tr>';
        foreach ($section["ITEMS"] as $item) {
            $courses.='<tr><td>'.$item["CODE"].'</td><td><table><tr><td><b>'.iconv("windows-1251", "UTF-8", $item["NAME"]).'</b></td></tr><tr><td class="descr">'.iconv("windows-1251", "UTF-8", $item["DESCR"]).'</td></tr></table></td><td class="duration">'.$item["DURATION"].'</td></tr>';
        }
        $courses.='</table>';
        $mpdf->WriteHTML($courses);
    }
    if ($section["IS_PARENT"]=="N" && is_array($arSection[$key+1])) {
        $mpdf->AddPage();
    }
}
$mpdf->Output($_SERVER["DOCUMENT_ROOT"].'/files/luxoft_training_catalog_price.pdf');
*/
generateCatalogPDF();
