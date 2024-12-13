<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("");
?>
<? COption::SetOptionString("main", "agents_use_crontab", "Y");
//echo COption::GetOptionString("main", "agents_use_crontab", "N");
COption::SetOptionString("main", "check_agents", "Y");
//echo COption::GetOptionString("main", "check_agents", "Y");
?>
<? if (intval($_REQUEST["trainer"]) > 0) { ?>
    <? CModule::IncludeModule("iblock");
    $res = CIBlockElement::GetByID($_REQUEST["trainer"]);
    if ($ar_res = $res->GetNextElement()) {
        $arResult = $ar_res->GetFields();
        $arResult["PROPERTIES"] = $ar_res->GetProperties();
    }
    $arSelect = array("ID", "NAME", "DATE_ACTIVE_FROM", "PREVIEW_PICTURE", "DETAIL_PICTURE");
    $arFilter = array("IBLOCK_ID" => 120, "PROPERTY_EXPERT" => $arResult["ID"], "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
    $res = CIBlockElement::GetList(array("SORT" => "ASC"), $arFilter, false, false, $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        $cert["PREVIEW_PICTURE"] = CFile::GetFileArray($arFields["PREVIEW_PICTURE"]);
        $cert["DETAIL_PICTURE"] = CFile::GetFileArray($arFields["DETAIL_PICTURE"]);
        $cert["NAME"] = $arFields["NAME"];
        $arResult["CERT"][] = $cert;
    }
    $arSelect = array("ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_URL");
    $arFilter = array("IBLOCK_ID" => 77, array("LOGIC" => "OR", array("PROPERTY_URL" => "%youtu%"), array("PROPERTY_URL" => "%vimeo%")), "PROPERTY_EXPERT_ID" => $arResult["ID"], "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
    $res = CIBlockElement::GetList(array("SORT" => "ASC"), $arFilter, false, false, $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arVideoFields = $ob->GetFields();

        if (preg_match("#youtu#", $arVideoFields["PROPERTY_URL_VALUE"])) {
            $arUrl = parse_url($arVideoFields["PROPERTY_URL_VALUE"]);
            //print_r($arUrl["query"]);
            parse_str($arUrl["query"], $output);
            $id = $output["v"];
            $video["SRC"] = "http://img.youtube.com/vi/" . $id . "/mqdefault.jpg";
            $video["NAME"] = $arVideoFields["NAME"];
            $video["URL"] = $arVideoFields["PROPERTY_URL_VALUE"];
            $video["ID"] = $id;
            $video["LINK"] = "http://www.youtube.com/embed/" . $id . "?autoplay=1";
            $arResult["VIDEO"][] = $video;
        }
        if (preg_match("#vimeo#", $arVideoFields["PROPERTY_URL_VALUE"])) {
            $arrSplit = preg_split("#/#", $arVideoFields["PROPERTY_URL_VALUE"]);
            $id = $arrSplit[3];
            global $USER;
            $video["SRC"] = "https://i.vimeocdn.com/video/" . $id . "_225x127.jpg";
            $video["NAME"] = $arVideoFields["NAME"];
            $video["URL"] = $arVideoFields["PROPERTY_URL_VALUE"];
            $video["ID"] = $id;
            $video["LINK"] = "http://player.vimeo.com/video/" . $id;
            $arResult["VIDEO"][] = $video;
        }
    }

    $arSelect = array("ID", "NAME", "DATE_ACTIVE_FROM", "DATE_ACTIVE_FROM", "DETAIL_PAGE_URL");
    $arFilter = array("IBLOCK_ID" => 23, "PROPERTY_expert" => $arResult["ID"], "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
    $res = CIBlockElement::GetList(array("DATE_ACTIVE_FROM" => "DESC"), $arFilter, false, false, $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arNewsFields = $ob->GetFields();
        $arResult["NEWS"][] = $arNewsFields;
    }
    $expert_short = nl2br($arResult['PROPERTIES']['expert_short']['VALUE']);
    $expert_name = nl2br($arResult['PROPERTIES']['expert_name']['VALUE']);
    $expert_title = nl2br($arResult['PROPERTIES']['expert_title']['VALUE']);
    $expert_language = nl2br($arResult['PROPERTIES']['expert_language']['VALUE']);
    $expert_area = $arResult['PROPERTIES']['HTML_AREA']['~VALUE']['TEXT'];
    $expert_special = $arResult['PROPERTIES']['HTML_SPECIAL']['~VALUE']['TEXT'];
    $expert_experience = $arResult['PROPERTIES']['HTML_EXPERIENCE']['~VALUE']['TEXT'];
    $expert_teacher = $arResult['PROPERTIES']['HTML_TEACHER']['~VALUE']['TEXT'];
    $expert_edu = $arResult['PROPERTIES']['HTML_EDU']['~VALUE']['TEXT'];
    $expert_certified = $arResult['PROPERTIES']['HTML_CERTIFIED']['~VALUE']['TEXT'];
    $expert_publications = $arResult['PROPERTIES']['HTML_PUBLICATIONS']['~VALUE']['TEXT'];
    $expert_social = $arResult['PROPERTIES']['HTML_SOCIAL']['~VALUE']['TEXT'];

    if ($arResult['PROPERTIES']['HTML_AREA']['VALUE']['TYPE'] == "text")
        $expert_area = nl2br($expert_area);
    if ($arResult['PROPERTIES']['HTML_SPECIAL']['VALUE']['TYPE'] == "text")
        $expert_special = nl2br($expert_special);
    if ($arResult['PROPERTIES']['HTML_EXPERIENCE']['VALUE']['TYPE'] == "text")
        $expert_experience = nl2br($expert_experience);
    if ($arResult['PROPERTIES']['HTML_TEACHER']['VALUE']['TYPE'] == "text")
        $expert_teacher = nl2br($expert_teacher);
    if ($arResult['PROPERTIES']['HTML_EDU']['VALUE']['TYPE'] == "text")
        $expert_edu = nl2br($expert_edu);
    if ($arResult['PROPERTIES']['HTML_CERTIFIED']['VALUE']['TYPE'] == "text")
        $expert_certified = nl2br($expert_certified);
    if ($arResult['PROPERTIES']['HTML_PUBLICATIONS']['VALUE']['TYPE'] == "text")
        $expert_publications = nl2br($expert_publications);
    if ($arResult['PROPERTIES']['HTML_SOCIAL']['VALUE']['TYPE'] == "text")
        $expert_social = nl2br($expert_social);
    ?>
    <?/*function UTF($string) {
	$utf_string=iconv("windows-1251", "UTF-8", $string);
	return $utf_string;
}*/ ?>
    <? $html = '<style>
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
margin-bottom: 18px;
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
</style>'; ?>
    <? $arResult["DETAIL_PICTURE"] = CFile::GetFileArray($arResult["DETAIL_PICTURE"]); ?>
    <? $html .= '	
<div class="trainer-shadow-wrap">
	<table border="0" style="margin-bottom: 30px;">
	<tr>
		<td>
			<img class="photo" style="padding-right: 20px;" border="0" src="' . UTF($arResult["DETAIL_PICTURE"]["SRC"]) . '" width="' . $arResult["DETAIL_PICTURE"]["WIDTH"] . '" height="' . $arResult["DETAIL_PICTURE"]["HEIGHT"] . '"  title="' . UTF($arResult["NAME"]) . '" />
		</td>
		<td style="vertical-align: top;">
			<div class="trener-header">
				<h1 style="color: #004180;font-size: 20px; margin-bottom: 10px; font-weight: normal;"><span itemprop="name">' . UTF($arResult["NAME"]) . ' ' . UTF($expert_name) . '</span></h1>
				<div style="font-style: italic; color: #414042;" class="position"><span itemprop="role">' . UTF($expert_short) . '</span></div>
			</div>
		</td>
    </tr>
	</table>

<div class="trainer-description">' . UTF($arResult['DETAIL_TEXT']) . '</div><div>'; ?>
    <? if (strlen($expert_area) > 0) {
        $html .= '<div class="main-knowledge"><h3>Ключевые области знаний:</h3>' . UTF($expert_area) . '</div>';
    } ?>
    <?/*if (strlen($expert_special)>0) {
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
 }*/
    $html .= '</div>'; ?>
    <?/*if (is_array($arResult["CERT"])) {?>
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


	<?} */ ?>
    <? //print_r($arResult["NEWS"])
    ?>
    <?/*if (is_array($arResult["NEWS"])) {?>
    <?$html.='<div class="news-trainer-wrap"><h3>Новости</h3>';?>
		<?foreach ( $arResult["NEWS"] as $arNews) {?>
        <?$html.='<div class="news-trainer-item"><div class="trainer-news-date">'.date('d.m.Y', strtotime($arNews["DATE_ACTIVE_FROM"])).'</div><a target="_blank" href="http://ibs-training.ru'.$arNews["DETAIL_PAGE_URL"].'">'.UTF($arNews["NAME"]).'</a></div>';?>
		<?}?>
	<?$html.='</div>'?>
    <?}*/ ?>
    <? $html .= '</div>' ?>
<?
    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'UTF-8',
        'format' => 'A4',
        'margin_left' => 30,
        'margin_right' => 30,
        'margin_top' => 30,
        'margin_bottom' => 30,
    ]);
    $mpdf->SetHTMLHeader('<div style="text-align: right;"><img src="/static/images/logo_IBS.png" alt="" title="" border="0"  /></div>');
    $mpdf->SetHTMLFooter('<table class="footer"><tr><td>По всем вопросам обращайтесь <a taget="_blank" style="color: #a1a1a1" href="mailto:' . EMAIL_ADDRESS . '">' . EMAIL_ADDRESS . '</a></td><td style="width: 34%;text-align: center;">{PAGENO}</td><td style="text-align: right;">Версия {DATE j.m.Y}</td></tr></table>');
    $mpdf->WriteHTML($html);
    $filename = "trainer_" . $arResult["CODE"] . ".pdf";
    $mpdf->Output($_SERVER["DOCUMENT_ROOT"] . '/files/' . $filename);
    LocalRedirect('/files/' . $filename . '?rand=' . rand('1000', '9999'));
} elseif (intval($_REQUEST["section"]) > 0) {
    $ar_result = CIBlockSection::GetList(array("LEFT_MARGIN" => "ASC", "SORT" => "ASC"), array("IBLOCK_ID" => D_TEMPCATALOG_DIRECTIONS_IBLOCK, "ID" => intval($_REQUEST["section"]), "GLOBAL_ACTIVE" => "Y", "ACTIVE" => "Y"), false, array());
    $t = 0;
    if ($res = $ar_result->GetNext()) {
        $arSection = $res;
        $count = CIBlockSection::GetCount(array("SECTION_ID" => $res["ID"], "ACTIVE" => "Y", "GLOBAL_ACTIVE" => "Y"));
        if (intval($count) > 0) {
            $arSection[$t]["IS_PARENT"] = "Y";
        } else {
            $arSection[$t]["IS_PARENT"] = "N";
        }
        $arSelect = array("ID", "CODE", "NAME", "PROPERTY_PP_COURSE.NAME",  "PROPERTY_PP_COURSE.CODE", "PROPERTY_PP_COURSE.PROPERTY_COURSE_DURATION", "PROPERTY_PP_COURSE.PROPERTY_SHORT_DESCR", "DATE_ACTIVE_FROM");
        $arFilter = array("IBLOCK_ID" => D_TEMPCATALOG_DIRECTIONS_IBLOCK, "ACTIVE_DATE" => "Y", "PROPERTY_PP_COURSE.ACTIVE" => "Y", "!NAME" => "%PTRN%", "SECTION_ID" => $res["ID"], "ACTIVE" => "Y");
        $res = CIBlockElement::GetList(array("PROPERTY_PP_COURSE.CODE" => "ASC"), $arFilter, false, false, $arSelect);
        while ($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();
            $arSection["ITEMS"][] = array("NAME" => $arFields["PROPERTY_PP_COURSE_NAME"], "CODE" => $arFields["PROPERTY_PP_COURSE_CODE"], "DURATION" => $arFields["PROPERTY_PP_COURSE_PROPERTY_COURSE_DURATION_VALUE"], "DESCR" => $arFields["PROPERTY_PP_COURSE_PROPERTY_SHORT_DESCR_VALUE"]);
        }
        $t++;
    }
    $html = '
		
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
			.footer {
				font-size:8pt; color:#a1a1a1;
				width: 100%;
			}
			.footer td {
				width: 33%;
			}
		</style>
		<setpagefooter name="myFooter1"/>
';
    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'UTF-8',
        'format' => 'A4-L',
        'margin_left' => 30,
        'margin_right' => 30,
        'margin_top' => 20,
    ]);
    $mpdf->SetHTMLHeader('<div style="text-align: right;"><img src="/static/images/logo_IBS.png" alt="" title="" border="0"  /></div>');
    $mpdf->SetHTMLFooter('<table class="footer"><tr><td>По всем вопросам обращайтесь <a style="color: #a1a1a1" href="mailto:' . EMAIL_ADDRESS . '">' . EMAIL_ADDRESS . '</a></td><td style="width: 34%;text-align: center;">{PAGENO}</td><td style="text-align: right;">Версия {DATE j.m.Y}</td></tr></table>');
    $mpdf->WriteHTML($html);
    $mpdf->h2toc = array('H3' => 0);
    $mpdf->h2bookmarks = array('H3' => 0);
    $section = $arSection;

    if ($section["DEPTH_LEVEL"] == 1) {
        $mpdf->WriteHTML('<h3>' . $section["NAME"] . '</h3>', 2);
    } elseif ($section["DEPTH_LEVEL"] == 2) {
        /*if ($section["ID"]==541) {
             $mpdf->AddPage();
        }	*/
        if (count($section["ITEMS"]) > 0) {
            $mpdf->WriteHTML('<h4>' . $section["NAME"] . '</h4>', 2);
        }
    }

    if (count($section["ITEMS"]) > 0) {
        $courses = '<table cellspacing="0" cellpadding="0" class="main-table"><tr class="head"><td>Код</td><td>Название курса, краткое содержание</td><td style="width: 80px">Длит., ч.</td></tr>';
        foreach ($section["ITEMS"] as $item) {
            $courses .= '<tr><td>' . $item["CODE"] . '</td><td><table><tr><td><b>' . $item["NAME"] . '</b></td></tr><tr><td class="descr">' . $item["DESCR"] . '</td></tr></table></td><td class="duration">' . $item["DURATION"] . '</td></tr>';
        }
        $courses .= '</table>';
        $mpdf->WriteHTML($courses);
    }

    if ($section["IS_PARENT"] == "N" && is_array($arSection[$key + 1])) {
        if (count($section["ITEMS"]) > 0) {
            $mpdf->AddPage();
        }
    }
    $info = '	<h4>Об учебном центре IBS Training Center</h4>
			<p><b>IBS Training Center</b> – лидер в области обучения и консалтинга по важнейшим дисциплинам Software Engineering. Учебный центр существует с 2007 г. и предлагает более 150 курсов, тренингов и учебных программ. Обучение проводят более 120 профессиональных тренеров – экспертов-практиков. 
			За это время в IBS Training Center прошли обучение сотрудники ведущих российских и международных компаний. Эффективность обучения подтверждается многочисленными положительными отзывами наших клиентов:</p>
			<p><b>РАЙФФАЙЗЕН БАНК АВАЛЬ</b>: «Неоднократные тренинги, которые проводились экспертами Учебного центра для сотрудников Банка в разрезе информационных технологий, в частности бизнес-аналитики и тестирования, повысили квалификацию участников обучения, дали более глубокое представление о рассматриваемых темах, позволили систематизировать уже имеющиеся знания и найти пути практического их применения».</p>
			<p><b>НОРДЕА БАНК</b>: «Эксперт по управлению и коммуникациями УЦ IBS Дмитрий Башакин на протяжении всего тренинга удерживал внимание аудитории благодаря интересному диалогу, примерам из практики и легкой подаче материала...  Выражаем благодарность за хорошую организацию обучения, высокий профессионализм экспертов и качественно разработанные курсы. Надеемся на дальнейшее сотрудничество с Учебным Центром IBS».</p>
			<p><b>ЛАБОРАТОРИЯ КАСПЕРСКОГО</b>: «Впечатления от тренинга исключительно положительные. Тренер динамично и интересно подавал материал, было интересно слушать и заниматься практическими заданиями. После тренинга в голове остается много полезной и хорошо структурированной информации».</p>
			<p>Обучение проходит в открытом, корпоративном и онлайн-формате. Центры обучения расположены в Москве, Санкт-Петербурге, Омске.<br/>Обучение может быть организовано на территории заказчика, с учетом требований производственного процесса.</p>
		';
    $mpdf->AddPage();
    $mpdf->WriteHTML($info);
    $filename = "catalog_" . $section["CODE"] . ".pdf";
    $mpdf->Output($_SERVER["DOCUMENT_ROOT"] . '/files/' . $filename);
    LocalRedirect('/files/' . $filename . '?rand=' . rand('1000', '9999'));
} elseif (intval($_REQUEST["course"]) > 0) { ?>
    <? //print_r($_REQUEST["course"]);
    ?>
    <?/*function UTF($string) {
	$utf_string=iconv("windows-1251", "UTF-8", $string);
	return $utf_string;
	}*/ ?>
    <?
    $arSelect = array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM"); //IBLOCK_ID и ID обязательно должны быть указаны, см. описание arSelectFields выше
    $arFilter = array("IBLOCK_ID" => 6, "ID" => $_REQUEST["course"]);
    $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arResult = $ob->GetFields();
        $arResult["PROPERTIES"] = $ob->GetProperties();
    }
    $course_puproses = UTF($arResult['PROPERTIES']['course_puproses']['~VALUE']);
    $course_tran_puproses = UTF($arResult['PROPERTIES']['tran_course_puproses']['~VALUE']);
    $course_audience = UTF($arResult['PROPERTIES']['course_audience']['~VALUE']);
    $course_tran_audience = UTF($arResult['PROPERTIES']['tran_course_audience']['~VALUE']);
    $course_linkedcourses = UTF(nl2br($arResult['PROPERTIES']['course_linkedcourses']['VALUE']));
    $course_requirements = UTF(nl2br($arResult['PROPERTIES']['course_requirements']['VALUE']));
    $course_tran_req = UTF(nl2br($arResult['PROPERTIES']['tran_course_req']['VALUE']));
    $course_addsources = UTF($arResult['PROPERTIES']['course_addsources']['~VALUE']);
    $course_other = UTF($arResult['PROPERTIES']['course_other']['~VALUE']);
    /*$course_puproses = checkHtmlN($course_puproses);
    $course_tran_puproses = checkHtmlN($course_tran_puproses);
    $course_audience = checkHtmlN($course_audience);
    $course_tran_audience = checkHtmlN($course_tran_audience);
    $course_addsources = checkHtmlN($course_addsources);
    $course_other = checkHtmlN($course_other);*/


    $course_topics_html_text = UTF($arResult['PROPERTIES']['course_top_html']['VALUE']['TEXT']);
    $course_topics_html_type = $arResult['PROPERTIES']['course_top_html']['VALUE']['TYPE'];
    if (($course_topics_html_type == "text") or ($course_topics_html_type == "TEXT")) {
        $course_topics = UTF(nl2br($course_topics_html_text));
    } else {
        $course_topics = UTF($arResult['PROPERTIES']['course_top_html']['~VALUE']['TEXT']);
    }
    $course_tran_topics_html_text = UTF($arResult['PROPERTIES']['tran_course_top_html']['VALUE']['TEXT']);
    $course_tran_topics_html_type = $arResult['PROPERTIES']['tran_course_top_html']['VALUE']['TYPE'];
    if (($course_tran_topics_html_type == "text") or ($course_tran_topics_html_type == "TEXT")) {
        $course_tran_topics = UTF(nl2br($course_tran_topics_html_text));
    } else {
        $course_tran_topics = UTF($arResult['PROPERTIES']['tran_course_top_html']['~VALUE']['TEXT']);
    }

    $course_desc_html_text = UTF($arResult['PROPERTIES']['course_desc_new']['VALUE']['TEXT']);
    $course_desc_html_type = $arResult['PROPERTIES']['course_desc_new']['VALUE']['TYPE'];


    if (($course_desc_html_type == "text") or ($course_desc_html_type == "TEXT")) {
        $course_description = UTF(nl2br($course_desc_html_text));
    } else {

        $course_description = UTF($arResult['PROPERTIES']['course_desc_new']['~VALUE']['TEXT']);
    }

    $course_tran_desc_html_text = UTF($arResult['PROPERTIES']['tran_course_desc_new']['VALUE']['TEXT']);
    $course_tran_desc_html_type = $arResult['PROPERTIES']['tran_course_desc_new']['VALUE']['TYPE'];
    if (($course_tran_desc_html_type == "text") or ($course_tran_desc_html_type == "TEXT")) {
        $course_tran_description = UTF(nl2br($course_tran_desc_html_text));
    } else {

        $course_tran_description = UTF($arResult['PROPERTIES']['tran_course_desc_new']['~VALUE']['TEXT']);
    }

    $course_linked_html_text = UTF($arResult['PROPERTIES']['course_linked_new']['VALUE']['TEXT']);
    $course_linked_html_type = $arResult['PROPERTIES']['course_linked_new']['VALUE']['TYPE'];
    if (($course_linked_html_type == "text") or ($course_linked_html_type == "TEXT")) {
        $course_linkedcourses = UTF(nl2br($course_linked_html_text));
    } else {

        $course_linkedcourses = UTF($arResult['PROPERTIES']['course_linked_new']['~VALUE']['TEXT']);
    }

    $course_required_html_text = UTF($arResult['PROPERTIES']['course_req_new']['VALUE']['TEXT']);
    $course_required_html_type = $arResult['PROPERTIES']['course_req_new']['VALUE']['TYPE'];
    if (($course_required_html_type == "text") or ($course_required_html_type == "TEXT")) {
        $course_required = nl2br($course_required_html_text);
    } else {
        $course_required = $arResult['PROPERTIES']['course_req_new']['~VALUE']['TEXT'];
    }
    $course_tran_required_html_text = UTF($arResult['PROPERTIES']['tran_course_req']['VALUE']['TEXT']);
    $course_tran_required_html_type = $arResult['PROPERTIES']['tran_course_req']['VALUE']['TYPE'];
    if (($course_tran_required_html_type == "text") or ($course_tran_required_html_type == "TEXT")) {
        $course_tran_required = UTF(nl2br($course_required_html_text));
    } else {
        $course_tran_required = UTF($arResult['PROPERTIES']['tran_course_req']['~VALUE']['TEXT']);
    }

    //print_r($arResult);
    ?>

    <? $html = "<style>
		h1
			{ 
			color: #004180;
			font-size: 20px; 
			margin-bottom: 10px; 
			font-weight: bold;
			}
		a {
		color: #326dab;
		}
		.indent {
			margin-top: 0;
			margin-left: 10px;
			margin-bottom: 20px;
		}
		.st {
			display: block;
			margin-bottom: 8px;
			font-weight: bold;
		}
		body {
			font-size: 14px;
			font-family: tahoma;
		}
			
		.footer {
			font-size:8pt; color:#a1a1a1;
			width: 100%;
		}
		.footer td {
			width: 33%;
		}
	</style>
	<div style='margin-bottom: 20px;'>
		<h1 style='color: #004180;'>" . UTF($arResult['NAME']) . "</h1>
    </div>
	<div style='margin-bottom: 20px;'>
		<span class='st'>Код: </span>"
        . UTF($arResult['PROPERTIES']['course_code']['VALUE']) . "
    </div>
	<div style='margin-bottom: 20px;'>
	    <span class='st'>Длительность:</span> " . UTF($arResult['PROPERTIES']['course_duration']['VALUE']) . " ч.</div>
		<div class=\"item-section\">
		<div class=\"st\">Описание:</div>
		" ?>
    <? if ($course_desc_html_type == "TEXT") { ?>
        <? $html .= "<p class=\"indent\"><div itemprop=\"description\">{$course_description}</div></p>" ?>
    <? } else { ?>
        <? $html .= "<div class=\"indent\"><div itemprop=\"description\">{$course_description}</div></div><br />" ?>
    <? } ?>
    <? $html .= "</div>" ?>

    <? if (!$course_puproses == "") {  ?>
        <? $html .= "   
	<div class=\"item-section\">
	    <div class=\"st\">Цели:</div>
	    <div class=\"indent\">{$course_puproses}</div>
    </div>" ?>
    <? } ?>
    <? if (strlen($course_topics) > 1) {  ?>
        <? $html .= "   
		<div class=\"item-section\">
		<div class=\"st\">Разбираемые темы:</div>
		" ?>
        <? if ($course_topics_html_type == "TEXT") { ?>
            <? $html .= "<p class=\"indent\">{$course_topics}</p>" ?>
        <? } else { ?>
            <? $html .= "<div class=\"indent\">{$course_topics}</div><br />" ?>
        <? } ?>
        <? $html .= "</div>" ?>
    <? } ?>
    <? if ($course_audience) {  ?>
        <? $html .= "<div class=\"item-section\">
		<div class=\"st\">Целевая аудитория:</div>
		<div class=\"indent\">{$course_audience}</div></div>" ?>
    <? } ?>
    <? if (strlen($course_required) > 1) {  ?>
        <? $html .= "<div class=\"item-section\">
		<div class=\"st\">Предварительная подготовка – общее:</div>" ?>
        <? if (strtoupper($course_required_html_type) == "TEXT") { ?>
            <? $html .= "<p class=\"indent\">" . $course_required . "</p>" ?>
        <? } else { ?>
            <? $html .= "<div class=\"indent\">" . UTF($course_required) . "</div><br />" ?>
        <? } ?>
        <? $html .= "</div>" ?>
    <? } ?>
    <? if (strlen($course_linkedcourses) > 1) {  ?>
        <? $html .= "<div class=\"item-section\">
	<div class=\"st\">Рекомендуемые курсы для дальнейшего обучения:</div>" ?>
        <? if ($course_linked_html_type == "TEXT") { ?>
            <? $html .= "<p class=\"indent\">{$course_linkedcourses}</p>" ?>
        <? } else { ?>
            <? $html .= "<div class=\"indent\">{$course_linkedcourses}</div>" ?>
        <? } ?>
        </div>
    <? } ?>


    <? if (!$course_addsources == "") {  ?>
        <? $html .= "<div class=\"item-section\">
	<div class=\"st\">Рекомендуемые дополнительные материалы, источники:</div>
	<div class=\"indent\">{$course_addsources}</div>
	</div>" ?>
    <? } ?>
    <? if (!$course_classrequirements == "") {  ?>
        <? $html .= "<div class=\"item-section\">
		<div class=\"st\"></div>
		<p class=\"indent\">{$course_classrequirements}</p></div>" ?>
    <? } ?>
    <? if (!$course_other == "") {  ?>
        <? $html .= "<div class=\"item-section\">
	<div class=\"st\">Примечание:</div>
	<div class=\"indent\">{$course_other}</div>
	</div>" ?>
    <? } ?>
    <? $APPLICATION->RestartBuffer();

    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'UTF-8',
        'format' => 'A4',
        'margin_left' => 30,
        'margin_right' => 30,
        'margin_top' => 30,
        'margin_bottom' => 30,
    ]);

    $mpdf->SetHTMLHeader('<div style="text-align: right !important; width: 100%;"><img src="/static/images/logo_IBS.png" alt="" title="" border="0"  style="float: right" /></div>');
    $mpdf->SetHTMLFooter('<table class="footer"><tr><td>По всем вопросам обращайтесь <a taget="_blank" style="color: #a1a1a1" href="mailto:' . EMAIL_ADDRESS . '" class="underline">' . EMAIL_ADDRESS . '</a></td><td style="width: 34%;text-align: center;">{PAGENO}</td><td style="text-align: right;">Версия {DATE j.m.Y}</td></tr></table>');
    $mpdf->WriteHtml($html);
    $filename = "training_" . UTF($arResult['PROPERTIES']['course_code']['VALUE']) . ".pdf";
    $mpdf->Output($_SERVER["DOCUMENT_ROOT"] . '/files/' . $filename);
    LocalRedirect('/files/' . $filename . '?rand=' . rand('1000', '9999')); ?>

<? } else {
    if (CModule::IncludeModule("iblock")) {
        $ar_result = CIBlockSection::GetList(array("LEFT_MARGIN" => "ASC", "SORT" => "ASC"), array("IBLOCK_ID" => D_TEMPCATALOG_DIRECTIONS_IBLOCK, "GLOBAL_ACTIVE" => "Y", "ACTIVE" => "Y"), false, array());
        $t = 0;
        while ($res = $ar_result->GetNext()) {
            $arSection[$t] = $res;
            $count = CIBlockSection::GetCount(array("SECTION_ID" => $res["ID"], "ACTIVE" => "Y", "GLOBAL_ACTIVE" => "Y"));
            if (intval($count) > 0) {
                $arSection[$t]["IS_PARENT"] = "Y";
            } else {
                $arSection[$t]["IS_PARENT"] = "N";
            }
            $arSelect = array("ID", "CODE", "NAME", "PROPERTY_PP_COURSE.NAME",  "PROPERTY_PP_COURSE.CODE", "PROPERTY_PP_COURSE.PROPERTY_COURSE_DURATION", "PROPERTY_PP_COURSE.PROPERTY_SHORT_DESCR", "DATE_ACTIVE_FROM");
            $arFilter = array("IBLOCK_ID" => D_TEMPCATALOG_DIRECTIONS_IBLOCK, "ACTIVE_DATE" => "Y", "PROPERTY_PP_COURSE.ACTIVE" => "Y", "!NAME" => "%PTRN%", "SECTION_ID" => $res["ID"], "ACTIVE" => "Y");
            $res = CIBlockElement::GetList(array("PROPERTY_PP_COURSE.CODE" => "ASC"), $arFilter, false, false, $arSelect);
            while ($ob = $res->GetNextElement()) {
                $arFields = $ob->GetFields();
                $arSection[$t]["ITEMS"][] = array("NAME" => $arFields["PROPERTY_PP_COURSE_NAME"], "CODE" => $arFields["PROPERTY_PP_COURSE_CODE"], "DURATION" => $arFields["PROPERTY_PP_COURSE_PROPERTY_COURSE_DURATION_VALUE"], "DESCR" => $arFields["PROPERTY_PP_COURSE_PROPERTY_SHORT_DESCR_VALUE"]);
            }
            $t++;
        }
    } ?>
    <h2>Catalog</h2>
    <form target="_blank">
        <select name="section">
            <? foreach ($arSection as $arSec) { ?>
                <? if (is_array($arSec["ITEMS"]) && count($arSec["ITEMS"]) > 0) { ?>
                    <option value="<?= $arSec["ID"] ?>"><?= $arSec["NAME"] ?></option>
                <? } ?>
            <? } ?>
        </select><br />
        <input name="download" value="Download" type="submit">

    </form>
    <br /><br />
    <? if (CModule::IncludeModule("iblock")) {
        $arSelect = array("ID", "CODE", "NAME", "PROPERTY_expert_name");
        $arFilter = array("IBLOCK_ID" => D_EXPERT_ID_IBLOCK, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
        $res = CIBlockElement::GetList(array("NAME" => "ASC"), $arFilter, false, false, $arSelect);
        while ($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();
            $arTrainer[] = $arFields;
        }
    } ?>
    <h2>Trainer</h2>
    <form target="_blank">
        <select name="trainer">
            <? foreach ($arTrainer as $arTr) { ?>

                <option value="<?= $arTr["ID"] ?>"><?= $arTr["NAME"] ?> <?= $arTr["PROPERTY_EXPERT_NAME_VALUE"] ?></option>

            <? } ?>
        </select><br />
        <input name="download" value="Download" type="submit">
    </form>
    <br /><br />
    <? if (CModule::IncludeModule("iblock")) {
        $arSelect = array("ID", "CODE", "NAME", "PROPERTY_expert_name");
        $arFilter = array("IBLOCK_ID" => 6, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
        $res = CIBlockElement::GetList(array("CODE" => "ASC"), $arFilter, false, false, $arSelect);
        while ($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();
            $arCourses[] = $arFields;
        }
    } ?>
    <h2>Course presentation</h2>
    <form target="_blank">
        <select style="width: 40% !important;" name="course">
            <? foreach ($arCourses as $arCr) { ?>
                <option value="<?= $arCr["ID"] ?>"><?= $arCr["CODE"] ?> <?= $arCr["NAME"] ?></option>
            <? } ?>
        </select><br />
        <input name="download" value="Download" type="submit">
    </form>
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
<? } ?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>