<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");
?>
<?if (intval($_REQUEST["trainer"])>0) { ?>
<?CModule::IncludeModule("iblock");
$res = CIBlockElement::GetByID($_REQUEST["trainer"]);
if($ar_res = $res->GetNextElement()) {
  $arResult=$ar_res->GetFields();
  $arResult["PROPERTIES"]=$ar_res->GetProperties();
}
$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM", "PREVIEW_PICTURE", "DETAIL_PICTURE");
$arFilter = Array("IBLOCK_ID"=> 120, "PROPERTY_EXPERT"=> $arResult["ID"], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, $arSelect);
while($ob = $res->GetNextElement())
{
 $arFields = $ob->GetFields();
 $cert["PREVIEW_PICTURE"]=CFile::GetFileArray($arFields["PREVIEW_PICTURE"]);
 $cert["DETAIL_PICTURE"]=CFile::GetFileArray($arFields["DETAIL_PICTURE"]);
 $cert["NAME"]=$arFields["NAME"];
 $arResult["CERT"][]=$cert;
}
$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_URL");
$arFilter = Array("IBLOCK_ID"=> 77, array("LOGIC"=> "OR", array("PROPERTY_URL"=> "%youtu%"), array("PROPERTY_URL"=> "%vimeo%")), "PROPERTY_EXPERT_ID"=> $arResult["ID"], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, $arSelect);
while($ob = $res->GetNextElement())
{
$arVideoFields = $ob->GetFields();

if (preg_match("#youtu#", $arVideoFields["PROPERTY_URL_VALUE"])) {
		$arUrl=parse_url($arVideoFields["PROPERTY_URL_VALUE"]);
		//print_r($arUrl["query"]);
		parse_str($arUrl["query"], $output);
		$id=$output["v"];
		$video["SRC"]="http://img.youtube.com/vi/".$id."/mqdefault.jpg";
		$video["NAME"]=$arVideoFields["NAME"];
		$video["URL"]=$arVideoFields["PROPERTY_URL_VALUE"];
		$video["ID"]=$id;
		$video["LINK"]="http://www.youtube.com/embed/".$id."?autoplay=1";
		$arResult["VIDEO"][]=$video;
	}
	if (preg_match("#vimeo#", $arVideoFields["PROPERTY_URL_VALUE"])) {
		$arrSplit=preg_split("#/#", $arVideoFields["PROPERTY_URL_VALUE"]);
		$id=$arrSplit[3];
		GLOBAL $USER;
		$video["SRC"]="https://i.vimeocdn.com/video/".$id."_225x127.jpg";
		$video["NAME"]=$arVideoFields["NAME"];
		$video["URL"]=$arVideoFields["PROPERTY_URL_VALUE"];
		$video["ID"]=$id;
		$video["LINK"]="http://player.vimeo.com/video/".$id;
		$arResult["VIDEO"][]=$video;
	}
}

$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM", "DATE_ACTIVE_FROM", "DETAIL_PAGE_URL");
$arFilter = Array("IBLOCK_ID"=> 23, "PROPERTY_expert"=> $arResult["ID"], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array("DATE_ACTIVE_FROM"=>"DESC"), $arFilter, false, false, $arSelect);
while($ob = $res->GetNextElement())
{
 $arNewsFields = $ob->GetFields();
 $arResult["NEWS"][]=$arNewsFields;
}
$expert_short = nl2br($arResult['PROPERTIES']['expert_short']['VALUE']);
$expert_name = nl2br($arResult['PROPERTIES']['expert_name']['VALUE']);
$expert_title = nl2br($arResult['PROPERTIES']['expert_title']['VALUE']);
$expert_language = nl2br($arResult['PROPERTIES']['expert_language']['VALUE']);
$expert_area = $arResult['PROPERTIES']['HTML_AREA']['~VALUE']['TEXT'];
$expert_special = $arResult['PROPERTIES']['HTML_SPECIAL']['~VALUE']['TEXT'];
$expert_experience = $arResult['PROPERTIES']['HTML_EXPERIENCE']['~VALUE']['TEXT'];
$expert_teacher =$arResult['PROPERTIES']['HTML_TEACHER']['~VALUE']['TEXT'];
$expert_edu = $arResult['PROPERTIES']['HTML_EDU']['~VALUE']['TEXT'];
$expert_certified = $arResult['PROPERTIES']['HTML_CERTIFIED']['~VALUE']['TEXT'];
$expert_publications = $arResult['PROPERTIES']['HTML_PUBLICATIONS']['~VALUE']['TEXT'];
$expert_social = $arResult['PROPERTIES']['HTML_SOCIAL']['~VALUE']['TEXT'];

if ($arResult['PROPERTIES']['HTML_AREA']['VALUE']['TYPE'] == "text" )
	$expert_area = nl2br($expert_area);
if ($arResult['PROPERTIES']['HTML_SPECIAL']['VALUE']['TYPE'] == "text" )
	$expert_special = nl2br($expert_special);
if ($arResult['PROPERTIES']['HTML_EXPERIENCE']['VALUE']['TYPE'] == "text" )
	$expert_experience = nl2br($expert_experience);
if ($arResult['PROPERTIES']['HTML_TEACHER']['VALUE']['TYPE'] == "text" )
	$expert_teacher = nl2br($expert_teacher);
if ($arResult['PROPERTIES']['HTML_EDU']['VALUE']['TYPE'] == "text" )
	$expert_edu = nl2br($expert_edu);
if ($arResult['PROPERTIES']['HTML_CERTIFIED']['VALUE']['TYPE'] == "text" )
	$expert_certified = nl2br($expert_certified);
if ($arResult['PROPERTIES']['HTML_PUBLICATIONS']['VALUE']['TYPE'] == "text" )
	$expert_publications = nl2br($expert_publications);
if ($arResult['PROPERTIES']['HTML_SOCIAL']['VALUE']['TYPE'] == "text" )
	$expert_social = nl2br($expert_social);
?>
<?function UTF($string) {
	$utf_string=$string;
	return $utf_string;
}?>
<?$html='<style>
body {
	font-size: 13px;
	font-family: tahoma;
}
p {
	margin-bottom: 14px;
}
a {
	color: #326dab;
}
.trainer-shadow-wrap .photo{
}
.trainer-shadow-wrap h1 {
	font-size: 20px;
	margin-bottom: 10px;
	font-weight: normal;
}
.trainer-shadow-wrap .position {
	font-style: italic;
	color: #414042;
}
.trainer-shadow-wrap  .trener-header {
	width: 290px;
	float: left;
	margin-bottom: 20px;
}
.trainer-shadow-wrap  .trainer-description {
	margin-bottom: 18px;
}
.trainer-shadow-wrap  .main-knowledge {
	margin-bottom: 18px;
}
.news-trainer-wrap {
	margin-bottom: 20px;
}
.news-trainer-wrap h3{
margin-bottom: 20px;
}
.news-trainer-item {
	font-size: 14px;
	margin-bottom: 14px;
}
.trainer-news-date {
	display: inline-block;
	margin-right: 32px;
	color: #808285;
}
.footer {
    font-size:8pt; color:#a1a1a1;
    width: 100%;
}
.footer td {
    width: 33%;
}
</style>';?>
<?$arResult["DETAIL_PICTURE"]=CFile::GetFileArray($arResult["DETAIL_PICTURE"]);?>
<?$html.='	
<div class="trainer-shadow-wrap">
	<table border="0" style="margin-bottom: 30px;">
	<tr>
		<td>
			<img class="photo" style="padding-right: 30px;" border="0" src="'.$arResult["DETAIL_PICTURE"]["SRC"].'" width="'.$arResult["DETAIL_PICTURE"]["WIDTH"].'" height="'.$arResult["DETAIL_PICTURE"]["HEIGHT"].'"  title="'.UTF($arResult["NAME"]).'" />
		</td>
		<td style="vertical-align: top;">
			<div class="trener-header">
				<h1 style="color: #004180;font-size: 20px; margin-bottom: 10px; font-weight: normal;"><span itemprop="name">'.UTF($arResult["NAME"]).' '.UTF($expert_name).'</span></h1>
				<div style="font-style: italic; color: #414042;" class="position"><span itemprop="role">'.UTF($expert_short).'</span></div>
			</div>
		</td>
    </tr>
	</table>

<div class="trainer-description">'.UTF($arResult['DETAIL_TEXT']).'</div><div>';?>
  <?if (strlen($expert_area)>0) {
   $html.='<div class="main-knowledge"><h3>Ключевые области знаний:</h3>'.UTF($expert_area).'</div>';
  } ?>
  <?if (strlen($expert_special)>0) {
    $html.='<div class="main-knowledge"><h3>Специализации:</h3>'.UTF($expert_special).'</div>';
  }?>
  <?if (strlen($expert_experience)>0) {
    $html.='<div class="main-knowledge"><h3>Профессиональный опыт:</h3>'.UTF($expert_experience).'</div>';
  } ?>

  <?if (strlen($expert_edu)>0) {
   $html.=' <div class="main-knowledge"><h3>Образование:</h3>'.UTF($expert_edu).'</div>';
  } ?>
  <?if (strlen($expert_publications)>0) {
    $html.='<div class="main-knowledge"><h3>Публикации:</h3>'.UTF($expert_publications).'</div>';
  } ?>
  <?if (strlen($expert_social)>0) {
   $html.='<div class="main-knowledge"><h3>Социальная сфера:</h3>'.UTF($expert_social).'</div>';
 }
$html.='</div>';?>
	<?if (is_array($arResult["CERT"])) {?>
    <?$html.='<div class="cert-wrap"><h3>Сертификаты</h3>'?>
			<?$t=0?>
			<?foreach ($arResult["CERT"] as $key=>$arCert) {?>
				<?$html.='<div style="margin-bottom: 14px;" class="cert-item">'.UTF($arCert["NAME"]).'</div>'?>
			<?$t++?>
			<?}?>
	<?$html.='</div>'?>
	<?}?>
	<?if (is_array($arResult["VIDEO"])) {?>
    <?$html.='<div class="video-wrap"><h3>Видео</h3>'?>

					<?foreach ($arResult["VIDEO"] as $key=>$arVideo) {?>
                       <?$html.='<div style="margin-bottom: 14px;" class="cert-item-text"><a target="_blank" href="'.$arVideo["LINK"].'">'.UTF($arVideo["NAME"]).'</a></div>';?>
						<?$t++?>

					<?}?>

    <?$html.='</div>'?>


	<?} ?>
	<?//print_r($arResult["NEWS"])?>
	<?/*if (is_array($arResult["NEWS"])) {?>
    <?$html.='<div class="news-trainer-wrap"><h3>Новости</h3>';?>
		<?foreach ( $arResult["NEWS"] as $arNews) {?>
        <?$html.='<div class="news-trainer-item"><div class="trainer-news-date">'.date('d.m.Y', strtotime($arNews["DATE_ACTIVE_FROM"])).'</div><a target="_blank" href="http://ibs-training.ru'.$arNews["DETAIL_PAGE_URL"].'">'.UTF($arNews["NAME"]).'</a></div>';?>
		<?}?>
	<?$html.='</div>'?>
    <?}*/?>
<?$html.='</div>'?>
<?
$mpdf = new \Mpdf\Mpdf([
    'mode' => 'UTF-8',
    'format' => 'A4',
    'margin_left' => 20,
    'margin_right' => 20,
    'margin_top' => 30,
    'margin_bottom' => 30,
]);
$mpdf->SetHTMLHeader('<div style="text-align: right;"><img src="/images/luxoft_training_pdf_new.jpg" alt="" title="" border="0"  /></div>');
$mpdf->SetHTMLFooter('<table class="footer"><tr><td>По всем вопросам обращайтесь <a taget="_blank" style="color: #a1a1a1" href="mailto:'.EMAIL_ADDRESS.'">'.EMAIL_ADDRESS.'</a></td><td style="width: 34%;text-align: center;">{PAGENO}</td><td style="text-align: right;">Версия {DATE j.m.Y}</td></tr></table>');
$mpdf->WriteHTML($html);
$filename="trainer_".$arResult["CODE"].".pdf";
$mpdf->Output($_SERVER["DOCUMENT_ROOT"].'/files/'.$filename);
LocalRedirect('/files/'.$filename.'?rand='.rand('1000', '9999'));

?>
<?} else {?>
<?if(CModule::IncludeModule("iblock"))
{
    $arSelect = Array("ID", "CODE", "NAME", "PROPERTY_expert_name" );
    $arFilter = Array("IBLOCK_ID"=> D_EXPERT_ID_IBLOCK, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
	$res = CIBlockElement::GetList(Array("NAME" => "ASC"), $arFilter, false, false, $arSelect);
        while($ob = $res->GetNextElement())
        {
           $arFields = $ob->GetFields();
		   $arTrainer[]=$arFields;
        }


}?>
<form target="_blank">
<select name="trainer">
<?foreach ($arTrainer as $arTr) {?>

	<option value="<?=$arTr["ID"]?>"><?=$arTr["NAME"]?> <?=$arTr["PROPERTY_EXPERT_NAME_VALUE"]?></option>

<?}?>
</select>
<input name="download" value="Download" type="submit">
</form>
<?}?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
