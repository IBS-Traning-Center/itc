<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$out='<div class="news-detail nobackround">';?>
        <?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
        <?$out.='<table style="width: 100%;"><tr><td style="width: 75%; padding-top: 20px;"><h1>'.$arResult["NAME"].'</h1></td><td style="vertical-align: top; text-align: right;"><img src="/static/images/logo_new.png" alt="" title="" border="0"  /></td></tr></table>';?>
        <?endif;?>
         <?$out.='<dl class="">'?>
            <?if ($arResult['CODE']){?>
            <?$out.='<dt>Code:</dt>';?>
            <?$out.='<dd>'.$arResult['CODE'].'</dd>'?>
            <? } ?>

            <?if ($arResult[PROPERTIES]['COURSE_DURATION']['VALUE']){?>
				<?$out.='<dt>Duration:</dt>'?>
				<?$out.='<dd>'.$arResult[PROPERTIES]["COURSE_DURATION"]["VALUE"].' hours</dd>'?>
            <? } ?>
            <?if ($arResult[PROPERTIES]['COURSE_TYPE']['VALUE']){?>
            <?$out.='<dt>Type:</dt>'?>
            <?$out.='<dd>'.$arResult[PROPERTIES]["COURSE_TYPE"]["VALUE"].'</dd>'?>
            <? } ?>
            <?/*if ($arResult["PROPERTIES"]['HTML_DESC']['~VALUE']['TEXT']){?>
            <?$out.='<dt>Description:</dt>';?>
            <?$out.='<dd>'.$arResult["PROPERTIES"]['HTML_DESC']['~VALUE']['TEXT'].'</dd>';?>
            <?}*/?>

            <?if ($arResult[PROPERTIES]['HTML_AUDIENCE']['~VALUE']['TEXT']){?>
            <?$out.='<dt>Target Audience:</dt>';?>
            <?$out.='<dd>'.removeSpecificTags($arResult[PROPERTIES]['HTML_AUDIENCE']['~VALUE']['TEXT']).'</dd>';?>
            <? } ?>
            <?if ($arResult[PROPERTIES]['HTML_OBJECTIVES']['~VALUE']['TEXT']){?>
            <?$out.='<dt>Objectives:</dt>';?>
            <?$out.='<dd>'.removeSpecificTags($arResult[PROPERTIES]["HTML_OBJECTIVES"]["~VALUE"]["TEXT"]).'</dd>';?>
            <? } ?>

            <?if ($arResult[PROPERTIES]['COURSE_AUDIENCE']['VALUE'] && !$arResult[PROPERTIES]['HTML_AUDIENCE']['~VALUE']['TEXT']){?>
            <?$out.='<dt>Target Audience:</dt>';?>
            <?$out.='<dd>'.nl2br($arResult[PROPERTIES]["COURSE_AUDIENCE"]["VALUE"]).'</dd>';?>
            <? } ?>
            <?if ($arResult[PROPERTIES]['COURSE_PUPROSES']['VALUE'] && !$arResult[PROPERTIES]['HTML_OBJECTIVES']['~VALUE']['TEXT']){?>
            <?$out.='<dt>Objectives:</dt>'?>
            <?$out.='<dd>'.nl2br($arResult[PROPERTIES]['COURSE_PUPROSES']['VALUE']).'</dd>'?>
            <? } ?>




            <?if ($arResult[PROPERTIES]['HTML_ROADMAP']['~VALUE']['TEXT']){?>
				<?$out.='<dt>Roadmap:</dt>';?>
				<?$out.='<dd>'.removeSpecificTags($arResult[PROPERTIES]['HTML_ROADMAP']['~VALUE']['TEXT']).'</dd>';?>
            <? } ?>
            <?if ($arResult[PROPERTIES]['HTML_PREREQUISITES']['~VALUE']['TEXT']){?>
				<?$out.='<dt>Prerequisites:</dt>';?>
				<?$out.='<dd>'.removeSpecificTags($arResult[PROPERTIES]['HTML_PREREQUISITES']['~VALUE']['TEXT']).'</dd>';?>
            <? } ?>
            <?if ($arResult[PROPERTIES]['HTML_RECOMMENDED']['~VALUE']['TEXT']){?>
            <?$out.='<dt>Recommended Reading:</dt>';?>
            <?$out.='<dd>'.removeSpecificTags($arResult[PROPERTIES]['HTML_RECOMMENDED']['~VALUE']['TEXT']).'</dd>';?>
            <? } ?>
            <?if ($arResult[PROPERTIES]['COURSE_OTHER']['VALUE']){?>
            <?$out.='<dt>Other:</dt>';?>
            <?$out.='<dd>'.nl2br($arResult[PROPERTIES]['COURSE_OTHER']['VALUE']).'</dd>';?>
            <? } ?>
            <?if ($arResult[PROPERTIES]['COURSE_RELATED']['VALUE']){?>
            <?$out.='<dt>Related Courses:</dt>';?>
            <?$out.='<dd>'.nl2br($arResult[PROPERTIES]['COURSE_RELATED']['VALUE']).'</dd>';?>
            <? } ?>
            <?if (is_array($arResult["LINKED"]) && !empty($arResult["LINKED"])){?>
            <?$out.='<dt>Related Courses:</dt>'?>
            <?$out.='<dd><ul>'?>
            <?foreach ($arResult["LINKED"] as $arLinkedCourse){ ?>
                     <?$out.=' <li>'.$arLinkedCourse["CODE"].' <a href="http://www.luxoft-training.com/'.$arLinkedCourse["DETAIL_PAGE_URL"].'">'.$arLinkedCourse["NAME"].'</a></li>'?>
            <? } ?>
            <?$out.='</ul></dd>'?>
            <? } ?>
			<?if ($arResult["PROPERTIES"]['PRICE']['VALUE']) {?>
				 <?$out.='<dt>Price:</dt>'?>
				<?$out.='<dd>'?>
					<?$out.=CurrencyFormat($arResult["PROPERTIES"]["PRICE"]["VALUE"], "EUR").'<br/>
All fees above can change according to training location and delivery mode and are subject to change while scheduling.<br/>
For individual participants the price is as displayed. For legal entities VAT is added to the displayed price.
				</dd>';?>
			<?}?>
<?$out.='</dl></div>';?>

<?$html = '
	<style>

	body {
		font-family: Arial;
		font-size: 16px;
	}

	h1 {
		
		font-size: 24px;
		color: #004281;
		font-size: 32px;
	}
	dt {
		font-weight: bold;
	}
	dd {
		margin-bottom: 15px;
	}
	</style>

	<body>
	
	';?>

<?$html.=$out?>
<?$html.="</body>"?>
<? $mpdf = new \Mpdf\Mpdf([
    'mode' => 'UTF-8',
    'format' => [250, 351],
]);
$mpdf->WriteHTML($html);
$name=$USER_ID;

$mpdf->Output($_SERVER["DOCUMENT_ROOT"]."/pdf/ARC-001.pdf");?>
