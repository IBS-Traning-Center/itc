<?

use Bitrix\Main\Loader;
use Bitrix\Main\Web\Json;

function LuxNews()
{
    $user = 'ashkavro';
    $password = 'Roccotrue!';
    $opts = array(
        'http' => array(
            'method' => 'GET',
            'header' => 'Authorization: Basic ' . base64_encode($user . ":" . $password)
        )
    );
    $context = stream_context_create($opts);
    $file = file_get_contents('https://sentinel2.luxoft.com/sen/wiki/rest/promoted-news/latest/newsfeed/14', false, $context);
    $obj = json_decode($file);
    $all = (array)$obj;
    $entries = (array)$all["entries"];
    $new = (array)$entries[0];
    $title = $new["title"];
    $text = $new["renderedHtmlExcerpt"];
    $url = 'https://sentinel2.luxoft.com/sen/wiki/pages/viewpage.action?pageId=' . $new["id"];
    $arNews = array("TITLE" => $title, "TEXT" => $text, "URL" => $url);
    return $arNews;

}

function entitytoUTF($input)
{
    $output = preg_replace_callback("/(&#[0-9]+;)/", function ($m) {
        return mb_convert_encoding($m[1], "UTF-8", "HTML-ENTITIES");
    }, $input);
    return $output;
}

function UTF($string)
{
    $result = $string;
    return $result;
}

function getRandmonFAQ()
{
    $user = 'ashkavro';
    $password = 'Roccotrue!';
    $opts = array(
        'http' => array(
            'method' => 'GET',
            'header' => 'Authorization: Basic ' . base64_encode($user . ":" . $password)
        )
    );
    $context = stream_context_create($opts);
    $file = file_get_contents('https://sentinel2.luxoft.com/sen/wiki/display/LUXTOWN/FAQs?os_authType=basic', false, $context);
    $dom = new domDocument;
    $searchPage = mb_convert_encoding($file, 'HTML-ENTITIES', "UTF-8");
    $dom->loadHTML($searchPage);
    $s = simplexml_import_dom($dom);
//echo "<pre>";
//print_r($s->body->div[3]->div->div[0]->div->div[4]->div[1]->div);
//echo "</pre>";
    foreach ($s->body->div[3]->div->div[0]->div->div[4]->div[1]->div as $razdel) {
        foreach ($razdel->div[1] as $vopros) {
            $arAnswers[] = array("QUESTION" => (string)$vopros->div[0]->span[1], "ANSWER" => $vopros->div[1]->asXML());
        }
    }
    $key = rand(0, count($arAnswers) - 1);
    return $arAnswers[$key];
}

function exportUsers()
{
    CModule::IncludeModule("iblock");
    $client = new SoapClient("https://oro-biztalk-ext.luxoft.com/LuxTrainingUserReceive/Service.svc?wsdl", array('login' => "webuser",
        'password' => "JKHAL:bhv#@@Khja3242aASVdsdf43p", 'trace' => 1, 'exceptions' => 1));
    $filter = array("DATE_REGISTER_1" => date("d.m.Y", strtotime("-1 day")) . " 00:00:00", "DATE_REGISTER_2" => date("d.m.Y", strtotime("-1 day")) . " 23:59:59");
    $rsUsers = CUser::GetList(($by = "LAST_NAME"), ($order = "asc"), $filter);
    $arSend = array();
    while ($arUser = $rsUsers->Fetch()) {
        //print_r($arUser);
        if (strlen($arUser["NAME"]) > 0 && strlen($arUser["LAST_NAME"]) > 0 && strlen($arUser["EMAIL"]) > 0 && strlen($arUser["WORK_COMPANY"]) > 0) {
            $arSend[] = array(
                "email" => htmlspecialchars_decode($arUser["EMAIL"]),
                "firstName" => htmlspecialchars_decode($arUser["NAME"]),
                "lastName" => htmlspecialchars_decode($arUser["LAST_NAME"]),
                "companyName" => htmlspecialchars_decode($arUser["WORK_COMPANY"]));
            $arSendEmail[] = array(
                "email" => htmlspecialchars_decode($arUser["EMAIL"]),
                "firstName" => htmlspecialchars_decode($arUser["NAME"]),
                "lastName" => htmlspecialchars_decode($arUser["LAST_NAME"]),
                "companyName" => htmlspecialchars_decode($arUser["WORK_COMPANY"])
            );
        }
    }

    foreach ($arSend as $send) {
        $result = $client->SaveUser($send);
    }
    $string_send = "<table cellpadding='5' style='border: 1px solid #ccc; border-collapse: collapse;'>";
    foreach ($arSendEmail as $send) {
        $string_send .= "<tr><td style='border: 1px solid #ccc;'>{$send['email']}</td><td style='border: 1px solid #ccc'>{$send['lastName']} {$send['firstName']}</td><td style='border: 1px solid #ccc'>{$send['companyName']}</td></tr>";
    }
    $string_send .= "</table>";
    $arEventFields = array("TABLE" => $string_send);
    CEvent::Send("ADDED_TO_LMS", SITE_ID, $arEventFields);
    return 'exportUsers();';
}


function CreateTrans($TYPE, $SOC, $USERID, $POST_ID)
{
    CModule::IncludeModule("sale");
    CSaleUserAccount::UpdateAccount(
        $USERID,
        "+100",
        "RUB",
        "MANUAL"
    );
    $el = new CIBlockElement;
    $PROP = array();
    if ($TYPE == "GROUP") {
        $PROP["TYPE"] = 193;
    } elseif ($TYPE == "REPOST") {
        $PROP["TYPE"] = 195;
    }
    if ($SOC == "VK") {
        $PROP["NETWORK"] = 191;
    } elseif ($SOC == "TWITTER") {
        $PROP["NETWORK"] = 196;
    } elseif ($SOC == "LINKEDIN") {
        $PROP["NETWORK"] = 198;
    }
    if (strlen($POST_ID) > 0) {
        $PROP["REC_ID"] = $POST_ID;
    }
    //$PROP["TYPE"] = 193;  // свойству с кодом 12 присваиваем значение "Белый"
    //$PROP["NETWORK"] = 191;        // свойству с кодом 3 присваиваем значение 38
    $PROP["USER"] = $USERID;
    $arLoadProductArray = array(
        "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
        "IBLOCK_ID" => 112,
        "PROPERTY_VALUES" => $PROP,
        "NAME" => $PROP["TYPE"] . $PROP["NETWORK"] . $PROP["USER"] . $PROP["REC_ID"],
        "ACTIVE" => "Y",            // активен
    );

    if ($PRODUCT_ID = $el->Add($arLoadProductArray)) {
        return true;
    } else {
        return false;
    }
}

function CheckUsersTrans($TYPE, $SOC, $USERID, $POST_ID)
{
    CModule::IncludeModule("iblock");
    $arSelect = array("ID", "NAME", "DATE_ACTIVE_FROM");
    $arFilter = array("IBLOCK_ID" => 112, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
    $arFilter["PROPERTY_USER"] = $USERID;
    if ($TYPE == "GROUP") {
        $arFilter["PROPERTY_TYPE"] = 193;
    } elseif ($TYPE == "REPOST") {
        $arFilter["PROPERTY_TYPE"] = 195;
    }
    if ($SOC == "VK") {
        $arFilter["PROPERTY_NETWORK"] = 191;
    } elseif ($SOC == "TWITTER") {
        $arFilter["PROPERTY_NETWORK"] = 196;
    } elseif ($SOC == "LINKEDIN") {
        $arFilter["PROPERTY_NETWORK"] = 198;
    }
    if (strlen($POST_ID) > 0) {
        $arFilter["PROPERTY_REC_ID"] = $POST_ID;
    }
    $res = CIBlockElement::GetList(array(), $arFilter, false, array("nPageSize" => 50), $arSelect);
    if ($res->SelectedRowsCount() > 0) {
        return true;
    } else {
        return false;
    }
}

;


function CheckYearLimit($USERID)
{
    $arFilter = array("IBLOCK_ID" => 112, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
    $arFilter["PROPERTY_USER"] = $USERID;
    $arFilter[">DATE_CREATE"] = "01.01." . date("Y");
    $res = CIBlockElement::GetList(array(), $arFilter, false, array("nPageSize" => 50), $arSelect);
    if ($res->SelectedRowsCount() > 5) {
        return false;
    } else {
        return true;
    }
}


function generatePriceAll()
{
    $html = CreateXLSfiles();
    file_put_contents($_SERVER["DOCUMENT_ROOT"] . '/files/ibs-training-price.xls', $html);
}

function CreateXLSfiles($isColored = false)
{
    $textCompany = 'Учебный центр IBS';
    $textCompanyDescription = 'ведущий центр обучения и сертификации в сфере разработки и внедрения ПО';

    $phone = '+7 (495) 609-69-67';
    $phone2 = '+7 (931) 009-69-26';
    $email = 'education@ibs.ru';


    $textFullAddress = 'тел.: ' . '<a href="tel:84956096967">' . $phone . '</a>' . '<br>'
    . '<a href="tel:89310096926">' . $phone2 . '</a>' . '<br>'
    . 'e-mail: ' . '<a href="mailto:education@ibs.ru">' . $email . '</a>';

    $textDocumentName = 'Прайс-лист';
    $textDescriptionPrice = 'Указана стоимость обучения одного слушателя за весь курс на ' . date('d.m.Y');
    $textHeadColumn1 = 'Код курса';
    $textHeadColumn2 = 'Название курса';
    $textHeadColumn3 = 'Длительность, акад. ч';
    $textHeadColumn4 = 'Стоимость, руб.';

    $html .= '<html xmlns:v="urn:schemas-microsoft-com:vml"
	xmlns:o="urn:schemas-microsoft-com:office:office"
	xmlns:x="urn:schemas-microsoft-com:office:excel"
	xmlns="http://www.w3.org/TR/REC-html40">
	<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="Content-Type" content="application/vnd.ms-excel">
	<style>
	body {
		font-family: Times New Roman;
		font-size: 10pt;
		background: white;
	}
	td {mso-number-format:\@; }
	.number0 {mso-number-format:0;}
	.number2 {mso-number-format:Fixed;}
	.border td{
		border:.5pt solid windowtext;
	}
	.border {
		border:.5pt solid windowtext;
	}
	</style>
	<!--[if gte mso 9]>
	<xml>
	<x:ExcelWorkbook>
	  <x:ExcelWorksheets>
	   <x:ExcelWorksheet>
		<x:Name>Sheet1</x:Name>
		<x:WorksheetOptions>
		<x:Print>
		<x:ValidPrinterInfo/>
		<x:Scale>75</x:Scale>
		<x:HorizontalResolution>600</x:HorizontalResolution>
		<x:VerticalResolution>600</x:VerticalResolution>
		</x:Print>
		 
		</x:WorksheetOptions>
	   </x:ExcelWorksheet>
	  </x:ExcelWorksheets>
	</x:ExcelWorkbook>
	</xml>
	<![endif]--> 
	</head>
		<body>
		<table  cellspacing="0" cellpadding="0" width="824" border="0">
			<tr>
				<td rowspan="3" style="border: none;" height="" colspan="2"><img style="padding: 12px;" src="https://ibs-training.ru/static/images/main_logo_mini.png"></td>
				<td colspan="4" style="border: none;" style="font-size: 10pt;" align="right">
					<i><b>'. $textCompany . ' - '. $textCompanyDescription . '</b></i><br/>
				</td>
			</tr>
			<tr>
				<td style="border: none;" colspan="3"></td>
			</tr>
			<tr>
				<td style="border: none;" colspan="4" style="font-size: 10pt;" align="right">' . $textFullAddress . '</td>
			</tr>
			<tr >
				<td valign="middle" style="border: none;" align="center" style="font-size: 16pt; height: 40px; vertical-align: middle;" colspan="6">
					<b>' . $textDocumentName . '</b>
				</td>
			</tr>
			<tr >
				<td valign="bottom" align="center" style="border: none; font-size: 10pt;" colspan="6">' . $textDescriptionPrice . '</td>
			</tr>
			<tr>
				<td style="font-size: 10pt; height:40px; vertical-align: middle;"  class="border" align="center"><b>' . $textHeadColumn1 . '</b></td>
				<td style="font-size: 10pt; vertical-align: middle;"  width="536" class="border" colspan="3"   align="center"><b>' . $textHeadColumn2 . '</b></td>
				<td style="font-size: 10pt; vertical-align: middle;" width="125" class="border" align="center" align="center"><b>' . $textHeadColumn3 . '</b></td>
				<td style="font-size: 10pt; vertical-align: middle;" border="1" class="border" width="115" align="center" align="center"><b>' . $textHeadColumn4 . '</b></td>
			</tr>';

    if (CModule::IncludeModule("iblock")) {

        $parentSection = [];

        $elements = [];
        $sections = [];
        $sectionsLink = [];
        $rs_sections = CIBlockSection::GetList(["LEFT_MARGIN" => "ASC", "SORT" => "ASC"], ["IBLOCK_ID" => D_TEMPCATALOG_DIRECTIONS_IBLOCK, "GLOBAL_ACTIVE" => "Y", "ACTIVE" => "Y", '>ELEMENT_CNT' => 0], ['ELEMENT_SUBSECTIONS' => 'Y', 'CNT_ACTIVE' => 'Y'], ['ID', 'CODE', 'NAME', 'IBLOCK_SECTION_ID', 'DEPTH_LEVEL', 'ELEMENT_CNT']);
        while ($arSection = $rs_sections->GetNext()) {
            if ($arSection['DEPTH_LEVEL'] > 2) {
                $arSection['NAME'] .= ' / ' . $parentSection[$arSection['DEPTH_LEVEL'] - 1]['NAME'];
            }

            $sections[$arSection['ID']] = $arSection;
            $sectionsLink[] = &$sections[$arSection['ID']];

            $parentSection[$arSection['DEPTH_LEVEL']] = $arSection;
        }

        $arSelect = array("IBLOCK_ID", "ID", "CODE", "NAME", "IBLOCK_SECTION_ID", "PROPERTY_PP_COURSE", "PROPERTY_PP_COURSE.NAME", "PROPERTY_PP_COURSE.CODE", "PROPERTY_PP_COURSE.PROPERTY_COURSE_PRICE", "PROPERTY_PP_COURSE.PROPERTY_COURSE_PRICE_UA", "PROPERTY_PP_COURSE.PROPERTY_COURSE_DURATION", "PROPERTY_PP_COURSE.PROPERTY_SHORT_DESCR", "DATE_ACTIVE_FROM");
        $arFilter = array("IBLOCK_ID" => D_TEMPCATALOG_DIRECTIONS_IBLOCK, "ACTIVE_DATE" => "Y", "PROPERTY_PP_COURSE.ACTIVE" => "Y", "!NAME" => "%PTRN%", "ACTIVE" => "Y");
        $rs_elements = CIBlockElement::GetList(["PROPERTY_PP_COURSE.CODE" => "ASC"], $arFilter, false, false, $arSelect);
        while ($arFields = $rs_elements->GetNext()) {
            $item = array(
                "NAME" => $arFields["PROPERTY_PP_COURSE_NAME"],
                "LINK" => $arFields["PROPERTY_PP_COURSE_VALUE"],
                "CODE" => $arFields["PROPERTY_PP_COURSE_CODE"],
                "DURATION" => $arFields["PROPERTY_PP_COURSE_PROPERTY_COURSE_DURATION_VALUE"],
                "DESCR" => $arFields["PROPERTY_PP_COURSE_PROPERTY_SHORT_DESCR_VALUE"],
                "PRICE_UA" => $arFields["PROPERTY_PP_COURSE_PROPERTY_COURSE_PRICE_UA_VALUE"],
                "PRICE" => $arFields["PROPERTY_PP_COURSE_PROPERTY_COURSE_PRICE_VALUE"]
            );

            $CURRENT_PAGE = (CMain::IsHTTPS()) ? "https://" : "http://";
            $CURRENT_PAGE .= $_SERVER["HTTP_HOST"];

            $arSelectCourse = array("ID", "PROPERTY_CHANGE_LINK");
            $arFilterCourse = array("IBLOCK_ID" => 6, "ID" => $arFields["PROPERTY_PP_COURSE_VALUE"]);
            $rs_elementCourse = CIBlockElement::GetList(array(), $arFilterCourse, false, false, $arSelectCourse);
            $ar_elementCourse = $rs_elementCourse->GetNext(false, false);
            if ($ar_elementCourse && strlen($ar_elementCourse['PROPERTY_CHANGE_LINK_VALUE']) > 0) {
                $item['LINK'] = $CURRENT_PAGE . $ar_elementCourse['PROPERTY_CHANGE_LINK_VALUE'];
            } else {
                $item['LINK'] = $CURRENT_PAGE . '/training/catalog/course.html?ID=' . $arFields['PROPERTY_PP_COURSE_VALUE'];
            }

            if (!empty($arFields['IBLOCK_SECTION_ID'])) {
                if ($sections[$arFields['IBLOCK_SECTION_ID']]) {
                    $sections[$arFields['IBLOCK_SECTION_ID']]['ITEMS'][] = $item;
                }
            } else {
                $elements[$item['ID']] = $item;
            }

            unset($item, $arFields);
        }
        unset($res);

        foreach ($sectionsLink as $index => $section) {
            if (!isset($section['ITEMS']) || ($section['ITEMS'] && count($section['ITEMS']) < 1)) {
                continue;
            }
            $html .= '<tr > 
				<td style="font-size: 10pt; height:34px; vertical-align: middle; background: #d9d9d9;" class="border" align="center" colspan="6">
				<i><b>' . $section["NAME"] . '</b></i>
				</td>
				</tr>';

            foreach ($section["ITEMS"] as $item) { // цикл по курсам

                $price = number_format($item["PRICE"], 0, '', ' ');
                $price_ua = number_format($item["PRICE_UA"], 0, '', ' ');

                //$priceUA = round(($item["PRICE"] / 35 - $item["PRICE"] / 35 * 0.3) / 10) * 10;
                //$price = fn_getMostNewCityPrice($item["PRICE"], $item["PRICE_UA"], $cityid, $item["DURATION"]);
                //$priceCeil = ceil($price / 100) * 100;
                if (intval($price) > 0) {
                    $html .=
                        '<tr>' .
                        '<td style="font-size: 10pt; height:45px; vertical-align: middle;" class="border" align="center">' . $item["CODE"] . '</td>' .
                        '<td style="font-size: 10pt; vertical-align: middle;" colspan="3" class="border" align="left"><a href="' . $item['LINK'] . '">' . $item["NAME"] . '</a></td>' .
                        '<td style="font-size: 10pt; vertical-align: middle;" class="border" align="center">' . $item["DURATION"] . '</td>' .
                        '<td style="font-size: 10pt; vertical-align: middle;" class="border" align="center">' . $price . '</td>' .
                        '</tr>';
                }
            }
        }

        $html .= "</table></body></html>";
    }
    return $html;
}

function isUkraine($param)
{
    $uCities = [5745, 5746, 5747];
    return in_array($param, $uCities);
}

// исключения
function foundExp($nameCource)
{
    /* $courses = [
         'REQ-038',
         'REQ-039',
         'REQ-050',
         'REQ-051',
         'REQ-052',
         'REQ-053',
         'REQ-054',
         'REQ-055',
         'REQ-056',
         'REQ-057',
         'REQ-062',
         'REQ-063',
         'ARC-001',
         'ARC-014',
         'SECR-010',
         'ARC-003',
         'EAS-004',
         'EAS-014',
         'EAS-024',
         ];*/

    $patterns = [
        '/^REQ-038$/',
        '/^REQ-039$/',
        '/^REQ-050$/',
        '/^REQ-051$/',
        '/^REQ-052$/',
        '/^REQ-053$/',
        '/^REQ-054$/',
        '/^REQ-055$/',
        '/^REQ-056$/',
        '/^REQ-057$/',
        '/^REQ-062$/',
        '/^REQ-063$/',
        '/^ARC-001$/',
        '/^ARC-014$/',
        '/^SECR-010$/',
        '/^ARC-003$/',
        '/^EAS-004$/',
        '/^EAS-014$/',
        '/^EAS-024$/',
        '/^JVA*/',
        '/^WEB*/',
        '/^DEV*/',
        '/^SDP-0((0[4-9])|([1-3][0-9])|(4[0-5]))$/',
        '/^DB-0((0[2-9])|(1[0-9])|(2[0-9]))$/',
        '/^PM-00[1-8]$/'];

    /*if(in_array($nameCource, $courses))
        return true;
    */

    foreach ($patterns as $item) {
        try {
            if (preg_match($item, $nameCource) == 1) return true;
            else continue;
        } catch (Exception $e) {
            //echo 'Выброшено исключение: ',  $e->getMessage(), "\n";
        }
        //if(strripos($nameCource, $item) === false) continue;
        //else return true;
    }
    return false;
}

function generateCatalogPDF()
{
    try {
        $headerHtml = <<<HTML
            <div style="text-align: right;">
                <img src="{$_SERVER['DOCUMENT_ROOT']}/static/images/logo_ibs.png" alt="" title="" border="0"  />
            </div>
            HTML;

        $footerHtml = <<<HTML
            <table autosize="1" class="footer">
                <tr>
                    <td>По всем вопросам обращайтесь <a style="color: #a1a1a1" href="mailto:education@ibs.ru">education@ibs.ru</a></td>
                    <td style="width: 34%;text-align: center;">{PAGENO}</td>
                    <td style="text-align: right;">Версия {DATE j.m.Y}</td>
                </tr>
            </table>
            HTML;

        $html = <<<HTML
            <style>
                h2 {
                    font-size: 16pt;
                    margin-top: 1pt;
                    margin-bottom: 1pt;
                    color: #3d3d3d;
                }
                h3 {
                    font-size: 12pt;
                    font-weight: bold;
                    margin-bottom: 1pt;
                }
                h4 {
                    font-size: 12pt;
                    font-weight: bold;
                    margin-bottom: 1pt;
                }
                h5 {
                    font-size: 12pt;
                    font-weight: bold;
                    margin-bottom: 1pt;
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
                div.mpdf_toc_level_2 {		
                    margin-left: 2em;
                    text-indent: -3em;
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
            <tocpagebreak 
                links="on"
                paging="on"
                resetpagenum="1"
                pagenumstyle="1"
                odd-header-value="on"
                odd-header-name="myHTMLHeader"
                odd-footer-value="on"
                even-header-name="myHTMLHeader"
                even-header-value="on"
                even-footer-name="myHTMLFooterEven"
                even-footer-value="on"
                toc-bookmarkText="Content list"
                toc-preHTML="&lt;h2&gt;Каталог тренингов IBS Training Center&lt;/h2&gt;&lt;br/&gt;Содержание"
            />
            <setpagefooter name="myFooter1"/>
            HTML;

        $info = <<<HTML
            <h4>Об Учебном центре IBS</h4>
            <p><b>Учебный центр IBS</b> – ведущий центр обучения и сертификации в сфере разработки и внедрения ПО, способствующий реализации современных комплексных ИТ-проектов в России и странах СНГ.</p>
            <p>Учебный центр был основан в 2000 году как внутреннее подразделение компании Luxoft для профессионального развития сотрудников. С 2007 года предоставляет услуги по подготовке ИТ-специалистов и для внешних заказчиков.</p>
            <p>За это время разработано более 300 курсов, тренингов и учебных программ. В процессе обучения участвуют более 120 профессиональных тренеров, являющихся экспертами-практиками. Они активно работают в коммерческой разработке, делятся примерами из своих проектов и обладают опытом реализации конкретных решений.</p>
            <p>Учебный центр проводит корпоративное обучение по всем направлениям в области разработки ПО. Программа курса адаптируется под конкретную команду с учетом потребностей, опыта и квалификации сотрудников. Обучение организуется в удобном формате, как на территории клиента, так и в классах Учебного центра IBS. Для корпоративных клиентов также доступно специальное предложение — экспресс-аудит проектных команд и производственных процессов в ИТ-отделе. Такая аналитика позволяет оценить состояние ИТ-инфраструктуры компании, сформулировать рекомендации по оптимизации и принять меры для снижения и устранения потенциальных рисков.</p>
            HTML;

        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'UTF-8',
            'format' => 'A4-L',
            'margin_left' => 30,
            'margin_right' => 30,
            'margin_top' => 30,
        ]);
        $mpdf->SetHTMLHeader($headerHtml);
        $mpdf->SetHTMLFooter($footerHtml);
        $mpdf->WriteHTML($html);

        if (!Loader::includeModule('iblock')) {
            return null;
        }

        $parentSection = [];
        $elements = [];
        $sections = [];
        $sectionsLink = [];
        $rs_sections = \CIBlockSection::GetList(
            ['LEFT_MARGIN' => 'ASC', 'SORT' => 'ASC'],
            ['IBLOCK_ID' => 94, 'GLOBAL_ACTIVE' => 'Y', 'ACTIVE' => 'Y', '>ELEMENT_CNT' => 0],
            ['ELEMENT_SUBSECTIONS' => 'Y', 'CNT_ACTIVE' => 'Y'],
            ['ID', 'CODE', 'NAME', 'IBLOCK_SECTION_ID', 'DEPTH_LEVEL', 'ELEMENT_CNT']
        );
        while ($arSection = $rs_sections->GetNext()) {
            if ($arSection['DEPTH_LEVEL'] > 2) {
                $arSection['NAME'] .= ' / ' . $parentSection[$arSection['DEPTH_LEVEL'] - 1]['NAME'];
            }
            $sections[$arSection['ID']] = $arSection;
            $sectionsLink[] = &$sections[$arSection['ID']];
            $parentSection[$arSection['DEPTH_LEVEL']] = $arSection;
        }

        $rs_elements = \CIBlockElement::GetList(
            ['PROPERTY_PP_COURSE.CODE' => 'ASC'],
            [
                'ACTIVE' => 'Y',
                'ACTIVE_DATE' => 'Y',
                'PROPERTY_PP_COURSE.ACTIVE' => 'Y',
                'IBLOCK_ID' => D_TEMPCATALOG_DIRECTIONS_IBLOCK,
                '!NAME' => '%PTRN%',
            ],
            false,
            false,
            [
                'IBLOCK_ID',
                'ID',
                'CODE',
                'NAME',
                'IBLOCK_SECTION_ID',
                'PROPERTY_PP_COURSE',
                'PROPERTY_PP_COURSE.NAME',
                'PROPERTY_PP_COURSE.CODE',
                'PROPERTY_PP_COURSE.ACTIVE',
                'PROPERTY_PP_COURSE.XML_ID',
                'PROPERTY_PP_COURSE.PROPERTY_COURSE_PRICE',
                'PROPERTY_PP_COURSE.PROPERTY_COURSE_PRICE_UA',
                'PROPERTY_PP_COURSE.PROPERTY_COURSE_DURATION',
                'PROPERTY_PP_COURSE.PROPERTY_SHORT_DESCR',
                'DATE_ACTIVE_FROM',
            ]
        );
        while ($arElement = $rs_elements->GetNext()) {
            $item = array(
                'NAME' => $arElement['PROPERTY_PP_COURSE_NAME'],
                'URL' => "https://ibs-training.ru/kurs/{$arElement['PROPERTY_PP_COURSE_XML_ID']}.html",
                'CODE' => $arElement['PROPERTY_PP_COURSE_CODE'],
                'DURATION' => $arElement['PROPERTY_PP_COURSE_PROPERTY_COURSE_DURATION_VALUE'],
                'DESCRIPTION' => $arElement['PROPERTY_PP_COURSE_PROPERTY_SHORT_DESCR_VALUE']
            );

            $CURRENT_PAGE = (\CMain::IsHTTPS()) ? 'https://' : 'http://';
            $CURRENT_PAGE .= $_SERVER['HTTP_HOST'];

            $arSelectCourse = ['ID', 'PROPERTY_CHANGE_LINK'];
            $arFilterCourse = ['IBLOCK_ID' => 6, 'ID' => $arElement['PROPERTY_PP_COURSE_VALUE']];
            $rs_elementCourse = \CIBlockElement::GetList([], $arFilterCourse, false, false, $arSelectCourse);
            $ar_elementCourse = $rs_elementCourse->GetNext(false, false);

            if ($ar_elementCourse && strlen((string)$ar_elementCourse['PROPERTY_CHANGE_LINK_VALUE']) > 0) {
                $item['LINK'] = $CURRENT_PAGE . $ar_elementCourse['PROPERTY_CHANGE_LINK_VALUE'];
            } else {
                $item['LINK'] = $CURRENT_PAGE . '/training/catalog/course.html?ID=' . $arElement['PROPERTY_PP_COURSE_VALUE'];
            }

            if (!empty($arElement['IBLOCK_SECTION_ID'])) {
                if ($sections[$arElement['IBLOCK_SECTION_ID']]) {
                    $sections[$arElement['IBLOCK_SECTION_ID']]['ITEMS'][] = $item;
                }
            } else {
                $elements[$item['ID']] = $item;
            }

            unset($item, $arElement);
        }
        unset($res);

        $currentHtml = '';
        $countMainSections = 0;
        foreach ($sectionsLink as $section) {
            if ($section['DEPTH_LEVEL'] == 1) {
                if ($countMainSections > 0) {
                    $currentHtml .= '</table>';
                    $mpdf->WriteHTML($currentHtml);

                    $currentHtml = '';
                    if ($section !== end($sections)) {
                        $mpdf->AddPage();
                    }
                }

                $sectionHeader = <<<HTML
                        <h2><tocentry content="{$section['NAME']}" level="1" />{$section['NAME']}</h2>
                    HTML;
                $mpdf->WriteHTML($sectionHeader, 2);

                $currentHtml .= <<<HTML
                        <table autosize="1" cellspacing="0" cellpadding="0" class="main-table">
                            <tr class="head">
                                <td>Код</td>
                                <td>Название курса, краткое содержание</td>
                                <td style="width: 80px">Длит., ч.</td>
                            </tr>
                        HTML;
                $countMainSections++;
            }

            if (
                $section['DEPTH_LEVEL'] > 2
                && $section['ITEMS'] && count($section['ITEMS']) > 1
            ) {
                $mpdf->WriteHTML($currentHtml);
                $sectionHeader = <<<HTML
                        <tr>
                            <td colspan="3" align="center">
                                <h3><tocentry content="{$section['NAME']}" level="2" />{$section['NAME']}</h3>
                            </td>
                        </tr>
                        HTML;
                $mpdf->WriteHTML($sectionHeader, 2);
                $currentHtml = '';
            }

            if ($section['ITEMS'] && count($section['ITEMS'])) {
                foreach ($section['ITEMS'] as $item) {
                    $currentHtml .= <<<HTML
                            <tr>
                                <td style="width: 8%">{$item['CODE']}</td>
                                <td style="width: 87%">
                                    <table autosize="1">
                                        <tr><td><b><a target="_blank" style="color: #000" href="{$item['URL']}">{$item['NAME']}</a></b></td></tr>
                                        <tr><td class="descr">{$item['DESCRIPTION']}</td></tr>
                                    </table>
                                </td>
                                <td style="width: 5%" class="duration">{$item['DURATION']}</td>
                            </tr>
                            HTML;
                    unset($item);
                }
            }
        }
        $currentHtml .= '</table>';
        $mpdf->WriteHTML($currentHtml);

        $mpdf->AddPage();
        $mpdf->WriteHTML($info);
        $mpdf->Output($_SERVER["DOCUMENT_ROOT"] . '/files/ibs-training-catalog.pdf');
    } catch (\Exception $exception) {
        $strError = $exception->getMessage();
    }

    generatePriceAll();
    return "generateCatalogPDF();";
}

function GetCbrGRN()
{
    CModule::IncludeModule("currency");
    $cbr = simplexml_load_file('http://www.cbr.ru/scripts/XML_daily.asp');
    foreach ($cbr->Valute as $valute) {
        if ($valute->CharCode == "UAH") {
            $DATE_RATE = date("d.m.Y");
            $NEW_RATE['CURRENCY'] = 'GRN';
            $NEW_RATE['RATE_CNT'] = (string)$valute->Nominal;
            $NEW_RATE['RATE'] = str_replace(',', '.', (string)$valute->Value);
            $NEW_RATE['DATE_RATE'] = $DATE_RATE;
            CCurrencyRates::Add($NEW_RATE);
        }
    }
    return "GetCbrGRN();";
}


function createDateRangeArray($strDateFrom, $strDateTo)
{
    // takes two dates formatted as YYYY-MM-DD and creates an
    // inclusive array of the dates between the from and to dates.

    // could test validity of dates here but I'm already doing
    // that in the main script

    $aryRange = array();

    $iDateFrom = mktime(1, 0, 0, substr($strDateFrom, 5, 2), substr($strDateFrom, 8, 2), substr($strDateFrom, 0, 4));
    $iDateTo = mktime(1, 0, 0, substr($strDateTo, 5, 2), substr($strDateTo, 8, 2), substr($strDateTo, 0, 4));

    if ($iDateTo >= $iDateFrom) {
        array_push($aryRange, date('Y-m-d', $iDateFrom)); // first entry
        while ($iDateFrom < $iDateTo) {
            $iDateFrom += 86400; // add 24 hours
            array_push($aryRange, date('Y-m-d', $iDateFrom));
        }
    }
    return $aryRange;
}

/*
function bitrixCleaningArray($arrN, $bFlagEmptyTilde = true){
    foreach($arrN as $key => $value){
        if (strpos($key, "VALUE_ID")!== false){
            unset($arrN[$key]);
            continue;
        }
        if (strpos($key, "_DESCRIPTION")!== false){
            unset($arrN[$key]);
            continue;
        }
        if ($bFlagEmptyTilde){
            if (strpos($key, "~PROPERTY_")!== false){
                unset($arrN[$key]);
                continue;
            }
        }
        if (strpos($key, "PROPERTY_")!== false){
            $newKey = str_replace("PROPERTY_","",$key);
            $newKey = str_replace("_VALUE","",$newKey);
            unset($arrN[$key]);
            $arrN[$newKey] = $value;
        }
    }
    return $arrN;
}
*/
/**
 * Perform a simple text replace
 * This should be used when the string does not contain HTML
 * (off by default)
 */
define('STR_HIGHLIGHT_SIMPLE', 1);

/**
 * Only match whole words in the string
 * (off by default)
 */
define('STR_HIGHLIGHT_WHOLEWD', 2);

/**
 * Case sensitive matching
 * (off by default)
 */
define('STR_HIGHLIGHT_CASESENS', 4);

/**
 * Overwrite links if matched
 * This should be used when the replacement string is a link
 * (off by default)
 */
define('STR_HIGHLIGHT_STRIPLINKS', 8);

/**
 * Highlight a string in text without corrupting HTML tags
 *
 * @param string $text Haystack - The text to search
 * @param array|string $needle Needle - The string to highlight
 * @param bool $options Bitwise set of options
 * @param array $highlight Replacement string
 * @return      Text with needle highlighted
 * @link        http://aidanlister.com/2004/04/highlighting-a-search-string-in-html-text/
 * @author      Aidan Lister <aidan@php.net>
 * @version     3.1.1
 */
function str_highlight($text, $needle, $options = null, $highlight = null)
{
    // Default highlighting
    if ($highlight === null) {
        $highlight = '<strong>\1</strong>';
    }

    // Select pattern to use
    if ($options & STR_HIGHLIGHT_SIMPLE) {
        $pattern = '#(%s)#';
        $sl_pattern = '#(%s)#';
    } else {
        $pattern = '#(?!<.*?)(%s)(?![^<>]*?>)#';
        $sl_pattern = '#<a\s(?:.*?)>(%s)</a>#';
    }

    // Case sensitivity
    if (!($options & STR_HIGHLIGHT_CASESENS)) {
        $pattern .= 'i';
        $sl_pattern .= 'i';
    }

    $needle = (array)$needle;
    foreach ($needle as $needle_s) {
        $needle_s = preg_quote($needle_s);

        // Escape needle with optional whole word check
        if ($options & STR_HIGHLIGHT_WHOLEWD) {
            $needle_s = '\b' . $needle_s . '\b';
        }

        // Strip links
        if ($options & STR_HIGHLIGHT_STRIPLINKS) {
            $sl_regex = sprintf($sl_pattern, $needle_s);
            $text = preg_replace($sl_regex, '\1', $text);
        }

        $regex = sprintf($pattern, $needle_s);
        $text = preg_replace($regex, $highlight, $text);
    }

    return $text;
}

function seconds2minutes($seconds)
{
    return sprintf("%02.2d:%02.2d", floor($seconds / 60), $seconds % 60);
}

function SetPageParams()
{
    CModule::IncludeModule('iblock');
    global $APPLICATION, $arInfo, $aMenuLinks;
    $SHOW_CHILDREN_MENU_ITEMS = $APPLICATION->GetPageProperty("SHOW_CHILDREN_MENU_ITEMS");
    echo "SHOW_CHILDREN_MENU_ITEMS =" . $SHOW_CHILDREN_MENU_ITEMS;
    //die();
    if ($SHOW_CHILDREN_MENU_ITEMS == "Y") {
        if (is_set($arInfo['UPPER_LEVEL'])) {
            $aMenuLinksNew[] = array(
                $arInfo['UPPER_LEVEL']['NAME'],
                $arInfo['UPPER_LEVEL']['SECTION_PAGE_URL'],
                array(),
                array(
                    "FROM_IBLOCK" => true,
                    "IS_PARENT" => true,
                    "DEPTH_LEVEL" => $arInfo['UPPER_LEVEL']["DEPTH_LEVEL"],
                    "UPPER" => true,
                ),
            );
            //iwrite($aMenuLinks);
            //die();
            //$aMenuLinks[] = $aMenuLinksNew;
            //return $aMenuLinks;
        }
    }
}

/*
 * see http://dev.1c-bitrix.ru/community/webdev/user/30201/blog/getcurpageparam-v2-s-podderzhkoy-mnogomernykh-massivov-i-lyubykh-uri/
 *
 */


function nfGetCurPageParam($strParam = '', $arParamKill = array(), $get_index_page = NULL, $uri = FALSE)
{

    if (NULL === $get_index_page) {

        if (defined('BX_DISABLE_INDEX_PAGE'))
            $get_index_page = !BX_DISABLE_INDEX_PAGE;
        else
            $get_index_page = TRUE;

    }

    $sUrlPath = GetPagePath($uri, $get_index_page);
    $strNavQueryString = nfDeleteParam($arParamKill, $uri);

    if ($strNavQueryString != '' && $strParam != '')
        $strNavQueryString = '&' . $strNavQueryString;

    if ($strNavQueryString == '' && $strParam == '')
        return $sUrlPath;
    else
        return $sUrlPath . '?' . $strParam . $strNavQueryString;

}


function nfDeleteParam($arParam, $uri = FALSE)
{

    $get = array();
    if ($uri && ($qPos = strpos($uri, '?')) !== FALSE) {

        $queryString = substr($uri, $qPos + 1);
        parse_str($queryString, $get);
        unset($queryString);

    }

    if (sizeof($get) < 1)
        $get = $_GET;

    if (sizeof($get) < 1)
        return '';

    if (sizeof($arParam) > 0) {

        foreach ($arParam as $param) {

            $search = &$get;
            $param = (array)$param;
            $lastIndex = sizeof($param) - 1;

            foreach ($param as $c => $key) {

                if (array_key_exists($key, $search)) {

                    if ($c == $lastIndex)
                        unset($search[$key]);
                    else
                        $search = &$search[$key];

                }

            }

        }

    }

    return str_replace(
        array('%5B', '%5D'),
        array('[', ']'),
        http_build_query($get)
    );

}

/*
 * http://stackoverflow.com/questions/1251582/beautiful-way-to-remove-get-variables-with-php?lq=1
 *
 */
function removeqsvar($url, $varname)
{
    list($urlpart, $qspart) = array_pad(explode('?', $url), 2, '');
    parse_str($qspart, $qsvars);
    unset($qsvars[$varname]);
    $newqs = http_build_query($qsvars);
    return $urlpart . '?' . $newqs;
}

function getCurrentUrl()
{
    $isHTTPS = (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on");
    $port = (isset($_SERVER["SERVER_PORT"]) && ((!$isHTTPS && $_SERVER["SERVER_PORT"] != "80") || ($isHTTPS && $_SERVER["SERVER_PORT"] != "443")));
    $port = ($port) ? ':' . $_SERVER["SERVER_PORT"] : '';
    $url = ($isHTTPS ? 'https://' : 'http://') . $_SERVER["SERVER_NAME"] . $port . $_SERVER["REQUEST_URI"];

    return urlencode($url);
}

function removeSpecificTags($str)
{
    $arTagsToRemove = array("<blockquote>", "</blockquote>");
    $str = str_replace($arTagsToRemove, "", $str);
    return $str;
}

/**
 * for "mailto" content  - to add title of the page at the header.php to "mailto" attribute
 */
function mailtoShowTitle($t = "title")
{
    global $APPLICATION;
    echo $APPLICATION->AddBufferContent("mailtoGetTitle");
}

function mailtoGetTitle($property_name = "title")
{
    global $my_title, $APPLICATION;
    if ($property_name !== false && strlen($APPLICATION->GetProperty($property_name)) > 0)
        $my_title = $APPLICATION->GetProperty($property_name);
    else
        $my_title = $APPLICATION->sDocTitle;
    return rawurlencode($my_title);
}

?>
