<?include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
generatePriceAllHtml();

function generatePriceAllHtml(){
    //$arCity=array(5741, 5742, 5745, 5746, 5744, 5747);
    //для отладки вкл. только украину
    echo ChangePriceKurs();
}

function ChangePriceKurs()  {

    $html='<html
	<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
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

	</head>
	<body>
		<table  cellspacing="0" cellpadding="0" width="824" border="0">
			<tr>
				<td style="font-size: 10pt; height:34px; vertical-align: middle;"  class="border" align="center"><b>Код курса</b></td>
				<td style="font-size: 10pt; vertical-align: middle;"  width="536" class="border" colspan="2"   align="center"><b>Название курса</b></td>
				<td style="font-size: 10pt; vertical-align: middle;" border="1" class="border" width="99" align="center" align="center"><b>Цена старая </b></td>			
				<td style="font-size: 10pt; vertical-align: middle;" border="1" class="border" width="99" align="center" align="center"><b>Цена новая</b></td>
				<td style="font-size: 10pt; vertical-align: middle;" border="1" class="border" width="99" align="center" align="center"><b>Дата начала</b></td>
				<td style="font-size: 10pt; vertical-align: middle;" border="1" class="border" width="99" align="center" align="center"><b>Город</b></td>
			</tr>';

    if(CModule::IncludeModule("iblock"))
    {
        $arCity=array(5745, 5746, 5747);
        $arFilter = Array(
                        "IBLOCK_ID"=> 9, "GLOBAL_ACTIVE"=>"Y", "ACTIVE"=>"Y",
                        ">PROPERTY_STARTDATE" => ConvertDateTime("01.10.2019", "YYYY-MM-DD"),
                        "PROPERTY_CITY" => $arCity
                        );
        $arSelect = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_city", "PROPERTY_startdate", "PROPERTY_schedule_price", "PROPERTY_course_code", "PROPERTY_schedule_price", "PROPERTY_schedule_onl_price");
        $res=CIBlockElement::GetList(Array("PROPERTY_STARTDATE" => "ASC"),
                                     $arFilter,
                                     false,
                                     false,
                                     $arSelect);

        //while ($res=$ar_result->GetNext()){
            /*$arSection[$t]=$res;
            $count=CIBlockSection::GetCount(array("SECTION_ID"=>$res["ID"], "ACTIVE"=>"Y", "GLOBAL_ACTIVE"=>"Y"));
            if (intval($count)>0) {
                $arSection[$t]["IS_PARENT"]="Y";
            } else {
                $arSection[$t]["IS_PARENT"]="N";
            }
            $arSelect = Array("ID", "CODE", "NAME", "PROPERTY_PP_COURSE.NAME",  "PROPERTY_PP_COURSE.CODE", "PROPERTY_PP_COURSE.PROPERTY_COURSE_PRICE", "PROPERTY_PP_COURSE.PROPERTY_COURSE_PRICE_UA", "PROPERTY_PP_COURSE.PROPERTY_COURSE_DURATION", "PROPERTY_PP_COURSE.PROPERTY_SHORT_DESCR", "DATE_ACTIVE_FROM");
            $arFilter = Array("IBLOCK_ID"=> D_TEMPCATALOG_DIRECTIONS_IBLOCK, "ACTIVE_DATE"=>"Y", "PROPERTY_PP_COURSE.ACTIVE"=>"Y", "!NAME"=>"%PTRN%", "SECTION_ID"=>$res["ID"],"ACTIVE"=>"Y");
            $res = CIBlockElement::GetList(Array("PROPERTY_PP_COURSE.CODE" => "ASC"), $arFilter, false, false, $arSelect);*/

            while($ob = $res->GetNextElement())
            {
                $item = $ob->GetFields();
                /*$arSection[$t]["ITEMS"][]=array(
                    "NAME"=>$arFields["PROPERTY_PP_COURSE_NAME"],
                    "CODE"=>$arFields["PROPERTY_PP_COURSE_CODE"],
                    "DURATION"=> $arFields["PROPERTY_PP_COURSE_PROPERTY_COURSE_DURATION_VALUE"],
                    "DESCR"=> $arFields["PROPERTY_PP_COURSE_PROPERTY_SHORT_DESCR_VALUE"],
                    "PRICE_UA"=> $arFields["PROPERTY_PP_COURSE_PROPERTY_COURSE_PRICE_UA_VALUE"],
                    "PRICE"=>$arFields["PROPERTY_PP_COURSE_PROPERTY_COURSE_PRICE_VALUE"]);*/

                /*$html.='<tr >
				<td style="font-size: 10pt; height:34px; vertical-align: middle; background: #d9d9d9;" class="border" align="center" colspan="5">
				<i><b>'.$item["NAME"].'</b></i>
				</td>
				</tr>';*/

                /*}
                //echo $item["DURATION"];
                if (count($section["ITEMS"])>0) {*/


                    //$priceUA = round(($item["schedule_price"] / 35 - $item["schedule_price"] / 35 * 0.3) / 10) * 10;
                    //$priceCeil = $price = fn_getMostNewCityPrice($item["schedule_price"], $item["PRICE_UA"], $cityid, $item["DURATION"]);
                    $price = $item["PROPERTY_SCHEDULE_PRICE_VALUE"];
                    $cityid = $item["PROPERTY_CITY_VALUE"];
                    $colorBackground = 'transparent';
                    $courseCode = $item["PROPERTY_COURSE_CODE_VALUE"];
                    if(isUkraine($cityid))
                    {
                        if(!foundExp($courseCode))
                        {
                            $price += ($price * 0.1);
                            $priceCeil = ceil($price / 100) * 100; // увеличение по Украине на 10% (сентябрь 2019)
                            $cityName = GetCityNameByID($cityid);
                            $html .= '<tr >
                            <td style="font-size: 10pt; height:34px; vertical-align: middle;" class="border" align="center">' . $courseCode . '</td>
                            <td style="font-size: 10pt; vertical-align: middle;" colspan="2" class="border" align="left">' . $item["NAME"] . '</td>
                            <td style="font-size: 10pt; vertical-align: middle; background-color:'.$colorBackground. '" class="border" align="center">' . $item["PROPERTY_SCHEDULE_PRICE_VALUE"] . '</td>
                            <td style="font-size: 10pt; vertical-align: middle; background-color:'.$colorBackground. '" class="border" align="center">' . number_format( $priceCeil, 0, "", " ") . '</td>
                            <td style="font-size: 10pt; vertical-align: middle; background-color:'.$colorBackground. '" class="border" align="center">' . $item["PROPERTY_STARTDATE_VALUE"] . '</td>
                            <td style="font-size: 10pt; vertical-align: middle; background-color:'.$colorBackground. '" class="border" align="center">' . $cityName . '</td>
                            </tr>';
                        }
                    }




            }

       // }

    }

    $html.="</table>
	</body>
	</html>";
    return $html;
}
?>