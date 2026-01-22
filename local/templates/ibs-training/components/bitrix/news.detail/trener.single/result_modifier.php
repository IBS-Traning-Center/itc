<?
use Bitrix\Iblock\IblockTable;
use Bitrix\Catalog\Product\Price\Calculation;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM", "PREVIEW_PICTURE", "DETAIL_PICTURE");
$arFilter = Array("IBLOCK_ID"=> 120, "PROPERTY_EXPERT"=> $arResult["ID"], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, $arSelect);
while($ob = $res->GetNextElement())
{
 $arFields = $ob->GetFields();
 $cert["PREVIEW_PICTURE"]=CFile::GetFileArray($arFields["PREVIEW_PICTURE"]);
 $cert["DETAIL_PICTURE"]=CFile::GetFileArray($arFields["DETAIL_PICTURE"]);
 $cert["NAME"]=CFile::GetFileArray($arFields["NAME"]);
 $arResult["CERT"][]=$cert;
}
$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_URL");
$arFilter = Array("IBLOCK_ID"=> 77, array("LOGIC"=> "OR", array("PROPERTY_URL"=> "%youtu%"), array("PROPERTY_URL"=> "%vimeo%")), "PROPERTY_EXPERT_ID"=> $arResult["ID"], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array("DATE_CREATE"=>"DESC"), $arFilter, false, false, $arSelect);
while($ob = $res->GetNextElement())
{
$arVideoFields = $ob->GetFields();

if (preg_match("#youtu#", $arVideoFields["PROPERTY_URL_VALUE"])) {
		$arUrl=parse_url($arVideoFields["PROPERTY_URL_VALUE"]);
		//print_r($arUrl["query"]);
		parse_str($arUrl["query"], $output);
		$id=$output["v"];
		$video["SRC"]="https://img.youtube.com/vi/".$id."/mqdefault.jpg";
		$video["NAME"]=$arVideoFields["NAME"];
		$video["URL"]=$arVideoFields["PROPERTY_URL_VALUE"];
		$video["ID"]=$id;
		$video["LINK"]="https://www.youtube.com/embed/".$id."?autoplay=1";
		$arResult["VIDEO"][]=$video;
	}
	if (preg_match("#vimeo#", $arVideoFields["PROPERTY_URL_VALUE"])) {
		$arrSplit=preg_split("#/#", $arVideoFields["PROPERTY_URL_VALUE"]);
		$id=$arrSplit[3];
		$xml = simplexml_load_file('https://vimeo.com/api/v2/video/'.$id.'.xml');
		GLOBAL $USER;
		$video["SRC"]=(string)$xml->video->thumbnail_medium;

		$video["NAME"]=$arVideoFields["NAME"];
		$video["URL"]=$arVideoFields["PROPERTY_URL_VALUE"];
		$video["ID"]=$id;
		$video["LINK"]="https://player.vimeo.com/video/".$id;
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





$courses = [];
$entity = IblockTable::compileEntity('schedule');
$entityClass = $entity->getDataClass();
$list = $entityClass::getList([
    'filter'    => [
        'ACTIVE' => 'Y',
        ">=startdate.VALUE" => date('Y-m-d'),
        'teacher.VALUE' => $arResult['ID']
    ],
    'order'     => ['startdate.VALUE' => 'ASC', 'enddate.VALUE' => 'ASC'],
    'select' => ['ID', 'teacher', 'schedule_course'],
    'cache'     => ['ttl' => 3600],
]);
$collection = $list->fetchCollection();
foreach ($collection as $collectionItem) {
    if($collectionItem->get('schedule_course')) {
        $scheduleCourses[] = $collectionItem->get('schedule_course')->getValue();
    }
}

$arResult['courses'] = getCourses(['filter' => ['ID' =>  array_unique($scheduleCourses)]]);
function getCourses($config = []): array
{
    $coursesPath = '/kurs/';

    $result = [];

    $entity = IblockTable::compileEntity('courses');
    $entityClass = $entity->getDataClass();

    $defaultConfig = [
        'order'     =>  ['CODE' => 'ASC'],
        'filter'    =>  ['ACTIVE' => 'Y'],
        'select'    =>  ['ID','NAME','CODE', 'XML_ID','course_duration','short_descr'],
        'cache'     =>  ['ttl' => 3600],
    ];
    $courseList = $entityClass::getList(array_merge_recursive($defaultConfig, $config));

    $courseCollections = $courseList->fetchCollection();

    foreach ($courseCollections as $course) {
        $result[$course->get('ID')] = [
            'id' => $course->get('ID'),
            'name' => $course->get('NAME'),
            'code' => $course->get('CODE'),
            'duration' => $course->get('course_duration') ? $course->get('course_duration')->getValue() : '',
            'description' => $course->get('short_descr') ? $course->get('short_descr')->getValue() : '',
        ];

        $result[$course->get('ID')]['link'] = $course->get('XML_ID')
            ? $coursesPath . $course->get('XML_ID') . '.html'
            : $coursesPath . $course->get('CODE') . '.html';
    }

    $schedule = getSchedule(['filter' => ['schedule_course.VALUE' => array_keys($result)]]);
    foreach ($schedule as $scheduleItem) {
        if($scheduleItem['courseId'] && $result[$scheduleItem['courseId']]) {
            $course = &$result[$scheduleItem['courseId']];
            $course['schedule'][] = $scheduleItem;
        }
    }

    return $result;
}
function getSchedule($config = [], $isFull = false): array
{
    //TODO сделать цену не обязательной
    global $USER;

    $result = [];

    $defaultConfig = [
        'filter'    => [
            'ACTIVE' => 'Y',
            ">=startdate.VALUE" => date('Y-m-d')
        ],
        'order'     => ['startdate.VALUE' => 'ASC', 'enddate.VALUE' => 'ASC'],
        'select' => [
            '*',
            'CODE',
            'schedule_course',
            'schedule_duration',
            'startdate',
            'enddate',
            'teacher',
            'string_teacher',
            'schedule_time',
            'course_sale',
        ],
        'cache'     => ['ttl' => 3600],
    ];

    $resultConfig = array_merge_recursive($defaultConfig, $config);

    $entity = IblockTable::compileEntity('schedule');
    $entityClass = $entity->getDataClass();

    $list = $entityClass::getList($resultConfig);

    $collection = $list->fetchCollection();
    foreach ($collection as $collectionItem) {

        $currentItem = [
            'id' => $collectionItem->get('ID'),
            'name' => $collectionItem->get('NAME'),
            'code' => $collectionItem->get('CODE'),
            'courseId' => $collectionItem->get('schedule_course') ? $collectionItem->get('schedule_course')->getValue() : '',

            'time' => ($collectionItem->has('schedule_time') && $collectionItem->get('schedule_time')->getValue())
                ? $collectionItem->get('schedule_time')->getValue()
                : '',
            'city' => 'Онлайн',
            'duration' => ($collectionItem->has('schedule_duration') && $collectionItem->get('schedule_duration')->getValue())
                ? $collectionItem->get('schedule_duration')->getValue()
                : '',
            'date' => [
                'start' => ($collectionItem->get('startdate') && $collectionItem->get('startdate')->getValue())
                    ? $collectionItem->get('startdate')->getValue()
                    : '',
                'end' => ($collectionItem->has('enddate') && $collectionItem->get('enddate')->getValue())
                    ? $collectionItem->get('enddate')->getValue()
                    : '',
            ],
        ];

        $currentItem['formLabel'] = $currentItem['date']['start']
            ? date('d.m.Y', strtotime($currentItem['date']['start'])) . ', ' . $currentItem['city']
            : '';

        if ($currentItem['date']['start']) {
            $currentItem['date']['start'] = date('d.m.Y', strtotime($currentItem['date']['start']));
        }

        if ($currentItem['date']['end']) {
            $currentItem['date']['end'] = date('d.m.Y', strtotime($currentItem['date']['end']));
        }

        if($isFull) {
            $currentPrice = \Bitrix\Catalog\PriceTable::getList([
                'filter' => ['PRODUCT_ID' => $currentItem['id'], 'CATALOG_GROUP_ID' => '1'],
                'select' => ['ID', 'PRODUCT_ID', 'CATALOG_GROUP_ID', 'PRICE', 'CURRENCY'],
                'cache' => ['ttl' => 3600],
            ])->fetchObject();

            if ($currentPrice) {
                Calculation::setConfig(['CURRENCY' => 'RUB']);
                $arPrice = \CCatalogProduct::GetOptimalPrice($currentItem['id'], 1, $USER->GetUserGroupArray(), 'N', [[
                    'ID' => $currentPrice->get('ID'),
                    'PRICE' => $currentPrice->get('PRICE'),
                    'CURRENCY' => $currentPrice->get('CURRENCY'),
                    'CATALOG_GROUP_ID' => $currentPrice->get('CATALOG_GROUP_ID'),
                ]]);
            }

            if (!empty($arPrice['RESULT_PRICE'])) {
                $currentItem['sale'] = [
                    'price' => $arPrice['RESULT_PRICE']['BASE_PRICE'],
                    'discountPrice' => $arPrice['RESULT_PRICE']['DISCOUNT_PRICE'],
                    'discount' => $arPrice['RESULT_PRICE']['DISCOUNT'],
                    'percent' => $arPrice['RESULT_PRICE']['PERCENT'],
                    'currency' => $arPrice['RESULT_PRICE']['CURRENCY']
                ];
                unset($arPrice);
            } elseif ($collectionItem->has('schedule_price')
                && $collectionItem->get('schedule_price')->getValue()
            ) {
                $currentItem['sale'] = [
                    'price' => $collectionItem->get('schedule_price')->getValue(),
                    'discountPrice' => $collectionItem->get('schedule_price')->getValue(),
                    'currency' => 'RUB',
                ];
            } else {
                $course = [];
                $currentItem['sale'] = [
                    'price' => $course['sale']['price'],
                    'discountPrice' => $course['sale']['price'],
                    'currency' => 'RUB',
                ];
            }

            if (
                (empty($currentItem['sale']['discountPrice']) || $currentItem['sale']['discountPrice'] === $currentItem['sale']['price'])
                && $collectionItem->get('course_sale')
                && $collectionItem->get('course_sale')->getValue()
            ) {
                $discount = $collectionItem->get('course_sale')->getValue();
                $currentItem['sale']['discountPrice'] = $currentItem['sale']['price'] - ($currentItem['sale']['price'] * $discount / 100);
                $currentItem['sale']['discount'] = $currentItem['sale']['price'] * $discount / 100;
                $currentItem['sale']['percent'] = $discount;
            }

            if ($currentItem['sale']['price'] && $currentItem['sale']['currency']) {
                $currentItem['sale']['priceFormatted'] = \CCurrencyLang::CurrencyFormat(
                    $currentItem['sale']['price'],
                    $currentItem['sale']['currency']
                );
            }

            if ($currentItem['sale']['discountPrice'] && $currentItem['sale']['currency']) {
                $currentItem['sale']['discountPriceFormatted'] = \CCurrencyLang::CurrencyFormat(
                    $currentItem['sale']['discountPrice'],
                    $currentItem['sale']['currency']
                );
            }

            if ($currentItem['sale']['discount'] && $currentItem['sale']['currency']) {
                $currentItem['sale']['discountFormatted'] = \CCurrencyLang::CurrencyFormat(
                    $currentItem['sale']['discount'],
                    $currentItem['sale']['currency']
                );
            }

        }

        $result[] = $currentItem;
    }

    return $result;
}

