<?          //>>>>>>>>>>>>>>>>>>>>>>>> USE FOR DEBUG <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
// Debug mode
define('DEBUG', true);          // режим отладки, не создаем/изменяем инфоблоки
define('VISUALITY',true);      // вывод на страницу
define('CONNECT', false);       // скачать файлы с удаленного ресурса
define('DOWNLOAD_ALL', false); // скачать все файлы
define('USE_ALL', false);       // работаем по всеми файлами или c определеннным константой ниже
define('FILE_NAME', 'ToBitrix_48067_05_13_2021_01_03.TXT');
define('NET_SSH2_LOGGING', 2);

if(VISUALITY)
{
    require("/home/bitrix/ext_www/luxoft-training.ru/bitrix/header.php");
    $APPLICATION->SetTitle("Title");
}
include("/home/bitrix/ext_www/luxoft-training.ru/bitrix/modules/main/include/prolog_before.php");

logFile("START UNDER CRON", true); //start logging


// DOWNLOAD REMOTE FILES
if(CONNECT)
{
    $ftp_server = 'ftp.luxoft.csod.com';
    $ftp_user_name = "luxoft";
    $ftp_user_pass = "KmUny6gB";

    include('Net/SFTP.php');
    $sftp = new Net_SFTP($ftp_server); // создаем sftp клиент
    if (!$sftp->login($ftp_user_name, $ftp_user_pass)) // попытка логина на sftp сервер
    {
        logFile("ERROR: Can't connect to ftp.luxoft.csod.com:");
        logFile(print_r($sftp->getLog()));
        exit('Login Failed');
    }
    else // успешно
    {
        logFile("CONNECT TO LMS SUSSEFULL");
        $sftp->chdir('/Reports/Custom_reports/'); // переходим в нужную директорию
        $files = $sftp->rawlist();

        if (DOWNLOAD_ALL) // скачать все файлы
        {
            $List = array_filter($files, function ($var) {
                return preg_match("/(ToBitrix_)/i", $var['filename']);
            }); // берем только файлы для Битрикс
            foreach ($List as $Item => $Attributes) {
                if ($Attributes['size'] > 356) {
                    $filename = $Attributes['filename'];
                    $sftp->get('/Reports/Custom_reports/' . $filename, '/home/bitrix/ext_www/luxoft-training.ru/debug/fortest/' . $filename);
                    if(VISUALITY) {
                        echo "<pre> ";
                        echo $filename . ' added';
                        echo "</pre>";
                    }
                }
            }
        }
        else // скачать только сегодняшний файл
        {
            $List = array_filter($files,
                function ($var)
                {
                    return preg_match("#ToBitrix_48067_" . date('m') . "_" . date('d') . "_" . date('Y') . "(.*)#", $var['filename']);
                }); // берем только файлы для Битрикс
            if (count($List) > 0)
            {
                $filename = reset($List)["filename"]; //$List[array_keys($List)[0]]["filename"];
                $sftp->get('/Reports/Custom_reports/' . $filename, '/home/bitrix/ext_www/luxoft-training.ru/debug/fortest/' . $filename);
                logFile("Download file: " . $filename);
            }
            else {
                logFile("ERROR: File not found at ftp.luxoft.csod.com: " . "#ToBitrix_48067_" . date('m') . "_" . date('d') . "_" . date('Y'));
                exit('File not found');
            }
        }

    }
}


// PARSING DOWNLOADED FILES HERE -> CREATE ARRAY OF COURSES

// временно для отладки
//session_start();
//$arResultArray = $_SESSION['courses'];

if(!$arResultArray)
{
    logFile("START PARSING", true);
    chdir('Courses');
    $files = array();
    $path = '/home/bitrix/ext_www/luxoft-training.ru/debug/fortest/';
    $all = scandir($path);
    if(USE_ALL) // берем все файлы
    {
        $files = $all;
    }
    else // только указанный
    {
        $files = array_filter($all,
            function ($var)
            {
                return preg_match("#".FILE_NAME."#", $var);
                //return preg_match("#ToBitrix_48067_" . date('m') . "_" . date('d') . "_" . date('Y') . "(.*)#", $var);
            });
    }
    if(count($files) == 0)
    {
        logFile("ERROR: File not found at localhost" . "#ToBitrix_48067_" . date('m') . "_" . date('d') . "_" . date('Y'));
        exit('File not found');
    }
    foreach ($files as $Item) // цикл по файлам
    {

        if (strlen($Item) < 3) continue;
        if(VISUALITY) {
            echo $Item . '<br>';
        }
        $content = file_get_contents($path . $Item);

        $array = explode(PHP_EOL, $content);

        foreach ($array as $index => $sItem) // цикл по записям о проведении курсов (одна запись - один день проведения определенного курса)
        {
            if ($index == 0) continue; // пропускаем строку заголовков (первый элмеент в масссиве)
            if (strlen($sItem) == 0) continue; // проупскаем пусту строку (последний элемент в массиве)
            $arItem = explode("\t", $sItem); // массив параметров расписания курса

            $course_status = $arItem[5];
            $course_code = $arItem[9];
            $course_city = $arItem[14];
            $course_location = $arItem[15];

            $course_start_date = $arItem[6];
            $course_end_date = $arItem[7];
            $course_duration = $arItem[16];
            $course_lang = $arItem[19];
            $course_time_break = $arItem[21];

            $dates = array($course_start_date, $course_end_date);
            $city = strlen($course_city) > 0 ? $course_city : $course_location;

            if ($city == "Virtual" && stristr($course_lang, "English")) {
                $city = "Virtual_EN";
            }
            if (!is_array($arResultArray[$city][$course_code])) {
                $arResultArray[$city][$course_code] = $arItem;
            }
            $arResultArray[$city][$course_code]["DATES"][] = $dates;
            $arResultArray[$city][$course_code]["DURATION"] = $arResultArray[$city][$course_code]["DURATION"] + ($course_duration - intval($course_time_break));
        }
        //$res = rename ($path . $Item, $path .'!'.$Item);
    }
    logFile("END PARSING", true);
    //$_SESSION['courses'] = $arResultArray;
    /*echo '<pre>';
    print_r($arResultArray);
    echo '</pre>';*/
}

// CREATING BITRIX INFOBLOCKS
$cities_ru = ["Omsk" => 5742,"St.-Petersburg" => 5744, "Moscow" => 5741, "Kiev" => 5745, "Odessa" => 5746, "Dnepropetrovsk" => 5747, "Virtual" => 14909];
$cities_eu = ["Bucharest" => 34729,"Krakow" => 36978, "Wroclaw" => 55979, "Warsaw" => 55979, "Virtual_EN" => 37594];
$lang_eu = ["Bucharest" => 44384, "Krakow"  => 44383, "Wroclaw" => 44383, "Warsaw" => 44383, "Virtual_EN" => 44383];

// временно для отладки
//$arResultArray = $_SESSION['courses'];
//echo count($arResultArray);

CModule::IncludeModule("iblock");
foreach ($arResultArray as $city=>$arSchedule) // цикл по городам
{
    if(VISUALITY) {
        echo '<br><h2>' . $city . '</h2>';
    }
    if(in_array($city, array_keys($cities_ru))) // курсы в России
    {
        foreach ($arSchedule as $code=>$arCourse) // цикл по курсам
        {
            $arCourse["DATES_NORMAL"] = checkCommonDates($arCourse["DATES"]);
            unset($arCourse["DATES"]);

            $cCode = $arCourse[0];
            $cStatus = $arCourse[5];
            $cFormat = $arCourse[20];
            $cInstructorID = $arCourse[11];
            $cInstructorName = $arCourse[12];

            $arSelect = Array("ID", "NAME");
            $arFilter = Array("IBLOCK_ID"=> 6, "PROPERTY_31"=>trim($cCode)); // "IBLOCK_ID"=> 6 курсы в РФ,  PROPERTY_31 это CODE (таблица b_iblock_element_prop_s6)

            // Метод GetList вернет объект класса CIBlockResult
            $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);

            /*echo '<hr>';
            echo 'PROPERTY_31 это CODE (таблица b_iblock_element_prop_s6)';
            echo '<pre>';
            print_r($res2);
            echo '</pre>';*/

            // Метод GetNextElement класса CIBlockResult вернет объект _CIBElement в котором храняться свойства элемента инфоблока
            if ($ob = $res->GetNextElement()) // курс найден
            {
                $arFields = $ob->GetFields(); // Метод возвращает массив с полями элемента информационного блока (таблица b_iblock_element)

                $arCourse["NAME"] = $arFields["NAME"];
                $arPROP = array();
                $arPROP["course_code"] = $cCode;
                $arPROP["schedule_course"] = $arFields["ID"];

                $arPROP["city"] = $cities_ru[$city];


                if ($arCourse[10] == "CommercialDepartmentRequest" || $arCourse[10] == "PTC_COM Corp" || $arCourse[10] == "PTC_COM Open")
                {
                    $arPROP["INIT"] = 245;
                }
                else
                {
                    $arPROP["INIT"] = 244;
                }

                $arPROP["FORMAT"] = $cFormat;

                // Даты курса, длительность
                $arPROP["startdate"] = $arCourse["DATES_NORMAL"]["START_DATE"];
                if ($arCourse["DATES_NORMAL"]["START_DATE"] != $arCourse["DATES_NORMAL"]["END_DATE"])
                {
                    $arPROP["enddate"] = $arCourse["DATES_NORMAL"]["END_DATE"];
                }

                $arPROP["schedule_time"] = $arCourse["DATES_NORMAL"]["GOOD_TIME"];

                if (strlen($arCourse["DATES_NORMAL"]["BAD_TIME"]) > 0)
                {
                    $arPROP["TIME_INTERVAL"] = $arCourse["DATES_NORMAL"]["BAD_TIME"];
                }
                $arPROP["schedule_duration"] = round($arCourse["DURATION"] / 60);

                // Получении информации о тренере курса
                $ID_TEACHER = "";
                $ID_TEACHER = $cInstructorID != "N/A" ? $cInstructorID : $cInstructorName;
                if (strlen($ID_TEACHER) > 0) // пробуем получить Инструктора
                {
                    $arSelect1 = Array("ID", "NAME");
                    $arFilter1 = Array("IBLOCK_ID" => 56, "PROPERTY_LMS_ID" => $ID_TEACHER); // "IBLOCK_ID" => 56 Тренеры в РФ
                    $res1 = CIBlockElement::GetList(Array(), $arFilter1, false, false, $arSelect1);

                    if ($ob1 = $res1->GetNextElement())
                    {
                        $arTrainerFields = $ob1->GetFields();
                        $arPROP["teacher"] = $arTrainerFields["ID"];
                        $arPROP["string_teacher"] = "";
                    }
                    else
                    {
                        $arPROP["string_teacher"] = $cInstructorName;
                    }
                }
                else
                {
                    if(VISUALITY) {
                        echo 'Error Instructor Id/Name' . $arCourse;
                    }
                    //$arPROP["string_teacher"]=$arCourse["12"];
                }

                // Расписание курса
                $arSelect2 = Array("ID");
                $arFilter2 = Array("IBLOCK_ID" => 9, "PROPERTY_LMS_ID" => $code);
                $res2 = CIBlockElement::GetList(Array(), $arFilter2, false, false, $arSelect2);

                /*echo 'PROPERTY_LMS_ID';
                echo '<pre>';
                print_r($res2);
                echo '</pre>';*/

                if ($ob2 = $res2->GetNextElement()) // курс есть в расписании
                {
                    $arScheduleFields = $ob2->GetFields();
                    $arOLD = GetFullInfoAboutCourse($arScheduleFields["ID"]); // получаем существующие данные из БД по ID курса
                    $ID_CITY = $arPROP["city"];
                    CModule::IncludeModule("iblock");
                    $arNEW = array();
                    $res = CIBlockElement::GetByID($arPROP["teacher"]);
                    if ($ar_res = $res->GetNext())
                    {
                        $arNEW["TEACHER_NAME"] = $ar_res["NAME"];
                    }
                    $res1 = CIBlockElement::GetByID($ID_CITY);
                    if ($ar_res1 = $res1->GetNext())
                    {
                        $arNEW["CITY_NAME"] = $ar_res1["NAME"];
                    }
                    $arNEW["STARTDATE"] = $arPROP["startdate"];
                    $arNEW["ENDDATE"] = $arPROP["enddate"];
                    $arNEW["SCHEDULE_TIME"] = $arPROP["schedule_time"];
                    $changes = 0;
                    $arSendFields = array();
                    $arSendFields["MODIFIED_BY"] = "[Integration with LMS]";
                    $arSendFields["NAME"] = $arOLD["COURSE_CODE"] . " " . $arOLD["COURSE_NAME"];

                    foreach ($arNEW as $key => $VALUE) // проверка на изменения в датах/времени расписания курса
                    {
                        //print_r($VALUE);
                        if ($VALUE != $arOLD[$key] && strlen($VALUE) > 0)
                        {
                            $arSendFields[$key] = "<s style='color: #FF0000'>" . $arOLD[$key] . "</s> <span style='color: #008B45'>" . $VALUE . "</span>";
                            $changes++;
                        }
                        else
                        {
                            $arSendFields[$key] = $arOLD[$key];
                        }
                    }
                    if (intval($changes) > 0) // были изменения в датах/времени
                    {
                        //print_r($arSendFields);
                        if (!DEBUG)
                        {
                            CEvent::Send('UPDATE_COURSE_TIME', SITE_ID, $arSendFields, 'N', 180); // отправляем письмо (зачем?) по 180 шаблону по событию UPDATE_COURSE_TIME
                        }
                    }

                    if (!DEBUG)
                    {
                        CIBlockElement::SetPropertyValuesEx($arScheduleFields["ID"], 9, $arPROP); // обновляем (сохраянем в БД) свойства инфоблока расписания для курса
                    }
                    if(VISUALITY) {
                        echo($city . ", " . $code . ", " . $arCourse["0"] . ", " . $cStatus . ", " . $arCourse["DATES_NORMAL"]["START_DATE"] . " - " . $arCourse["DATES_NORMAL"]["END_DATE"] . ", " . $cInstructorName . " <-------- UPDATED <br/>");
                    }
                    logfile($city . ", "  . $code . ", " . $arCourse["0"] . ", " . $cStatus . ", " . $arCourse["DATES_NORMAL"]["START_DATE"] . " - " . $arCourse["DATES_NORMAL"]["END_DATE"] . ", " . $cInstructorName . " <-------- UPDATED");
                    if ($cStatus == "Cancelled") // курс отменен (закрыт)
                    {
                        if (!DEBUG)
                        {
                            $el = new CIBlockElement;
                            $arLoadProductArray = Array("ACTIVE" => "N");
                            $result = $el->Update($arScheduleFields["ID"], $arLoadProductArray); // CIBlockElement::Update метод обновит значения соотвествующего поля элемента инфоблока
                        }
                        if(VISUALITY) {
                            echo($city . ", "  . $code . ", " . $arCourse["0"] . ", " . $cStatus . ", " . $arCourse["DATES_NORMAL"]["START_DATE"] . " - " . $arCourse["DATES_NORMAL"]["END_DATE"] . ", " . $cInstructorName . " <-------- CANCELLED <br/>");
                        }
                        logfile($city . ", "  . $code . ", " . $arCourse["0"] . ", " . $cStatus . ", " . $arCourse["DATES_NORMAL"]["START_DATE"] . " - " . $arCourse["DATES_NORMAL"]["END_DATE"] . ", " . $cInstructorName . " <-------- UPDATED");
                    }

                    if (!DEBUG) // синхронизируемся с SF
                    {
                        scheduleRU($arScheduleFields["ID"]);
                    }

                }

                else // курса нет в расписании
                {
                    // Создаем новый элемент инфоблока - распсиание курса
                    $arPROP["LMS_ID"] = $code;
                    $el = new CIBlockElement;
                    $arLoadProductArray = Array(
                        "IBLOCK_SECTION_ID" => false,
                        "IBLOCK_ID" => 9,
                        "PROPERTY_VALUES" => $arPROP,
                        "NAME" => $arCourse["NAME"],
                        "ACTIVE" => "Y");

                    if ($PRODUCT_ID = $el->Add($arLoadProductArray)) // CIBlockElement::Add метод добавит новый элемент инфоблока (добавляем новый элемент инфоблока - расписание курсов)
                    {
                        if (!DEBUG)
                        {
                            CModule::IncludeModule("catalog");
                            $arCatFields = array("ID" => $PRODUCT_ID,);
                            CCatalogProduct::Add($arCatFields); // CCatalogProduct::Add метод добавляет (или обновляет) параметры инфоблока в торговом каталоге
                            $arPriceFields = Array(
                                "PRODUCT_ID" => $PRODUCT_ID,
                                "CATALOG_GROUP_ID" => 1,
                                "PRICE" => 1,
                                "CURRENCY" => "EUR");
                            CPrice::Add($arPriceFields); // CPrice::Add метод добавляет новое ценовое предложение (новую цену) для товара (курса)
                        }
                        if(VISUALITY) {
                            echo($city . ", " . $code . ", " . $arCourse["0"] . ", " . $cStatus . ", " . $arCourse["DATES_NORMAL"]["START_DATE"] . " - " . $arCourse["DATES_NORMAL"]["END_DATE"] . ", " . $arCourse["12"] . " <-------- ADDED <br/>");
                        }
                        logfile($city . ", " . $code . ", " . $arCourse["0"] . ", " . $cStatus . ", " . $arCourse["DATES_NORMAL"]["START_DATE"] . " - " . $arCourse["DATES_NORMAL"]["END_DATE"] . ", " . $cInstructorName . " <-------- ADDED");
                    }
                    else
                    {
                        echo "ERROR ADD TO SHEDULE: ".$el->LAST_ERROR;
                    }
                }
            }
            else  // курс НЕ найден
            {
                if(VISUALITY) {
                    echo $city . ", " . $code . ", " . $arCourse["0"] . ", " . $cStatus . ", " . $arCourse["DATES_NORMAL"]["START_DATE"] . " - " . $arCourse["DATES_NORMAL"]["END_DATE"] . ", " . $arCourse["12"] . " <-------- <b>NOT_FOUND</b>" . "<br/>";
                }
                logfile($city . ", " . $code . ", " . $arCourse["0"] . ", " . $cStatus . ", " . $arCourse["DATES_NORMAL"]["START_DATE"] . " - " . $arCourse["DATES_NORMAL"]["END_DATE"] . ", " . $cInstructorName . " <-------- NOT_FOUND");
            }
        }
    }
    else if (in_array($city, array_keys($cities_eu)) ) // курсы в Европе
    {
        foreach ($arSchedule as $code=>$arCourse) // по курсам
        {
            $arCourse["DATES_NORMAL"]=checkCommonDates($arCourse["DATES"]);
            unset($arCourse["DATES"]);

            $cCode = $arCourse[0];
            $cStatus = $arCourse[5];
            $cInstructorID = $arCourse[11];
            $cInstructorName = $arCourse[12];

            $arSelect = Array("ID", "NAME", "PROPERTY_PRICE");
            $arFilter = Array("IBLOCK_ID"=> 97, "CODE"=>trim($cCode)); // "IBLOCK_ID"=> 97 курсы в Европе , "CODE" - код курса

            $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);

            if ($ob = $res->GetNextElement()) // курс найден
            {
                $arFields = $ob->GetFields();
                $arCourse["NAME"]=$arFields["NAME"];
                $arPROP=array();
                $arPROP["COURSE_CODE"]=$cCode;
                $arPROP["COURSE_ID"]=$arFields["ID"];
                $arPROP["DURATION"]=intval($arCourse["DURATION"]/60);
                $arPROP["CITY_ID"] = $cities_eu[$city];
                $arPROP["TIME"]=$arCourse["DATES_NORMAL"]["GOOD_TIME"];
                if (strlen($arCourse["DATES_NORMAL"]["BAD_TIME"])>0)
                {
                    $arPROP["ADDITIONAL_TIME"]=$arCourse["DATES_NORMAL"]["BAD_TIME"];
                }
                $arPROP["STARTDATE"]=$arCourse["DATES_NORMAL"]["START_DATE"];

                if ($arCourse["DATES_NORMAL"]["START_DATE"]!=$arCourse["DATES_NORMAL"]["END_DATE"])
                {
                    $arPROP["ENDDATE"]=$arCourse["DATES_NORMAL"]["END_DATE"];
                }
                $arPROP["LANG"] = $lang_eu[$city];

                $arPROP["LMS_ID"]=$code;
                if ($cInstructorID!="N/A")
                {
                    $ID_TEACHER=$cInstructorID;
                }
                else
                {
                    $ID_TEACHER=$cInstructorName;
                }
                // Получении информации о тренере курса
                $arTrainer="";
                $arSelect1 = Array("ID", "NAME", "PROPERTY_SHORT_NAME");
                $arFilter1 = Array("IBLOCK_ID"=> 98, "PROPERTY_LMS_ID"=>$ID_TEACHER); // "IBLOCK_ID"=> 98 Тренеры в Европе
                $res1 = CIBlockElement::GetList(Array(), $arFilter1, false, false, $arSelect1);
                if ($ob1 = $res1->GetNextElement())
                {
                    $arTrainerFields = $ob1->GetFields();
                    $arPROP["TRAINER_ID"]=$arTrainerFields["ID"];
                    $arTrainer=$arTrainerFields["NAME"]." ".$arTrainerFields["PROPERTY_SHORT_NAME_VALUE"];
                }
                else
                {
                    $arPROP["TRAINER_SIMPLE"]=$cInstructorName;
                }
                // Расписание курса
                $arSelect2 = Array("ID");
                $arFilter2 = Array("IBLOCK_ID"=> 99, "PROPERTY_LMS_ID"=> $code); // "IBLOCK_ID"=> 99 расписание курсов в Европе
                $res2 = CIBlockElement::GetList(Array(), $arFilter2, false, false, $arSelect2);

                if ($ob2 = $res2->GetNextElement()) // курс есть в расписании
                {
                    if (!DEBUG)
                    {
                        $arScheduleFields = $ob2->GetFields();
                        CIBlockElement::SetPropertyValuesEx($arScheduleFields["ID"], 99, $arPROP); // обновляем поля инфоблока (данные расписания курса)
                        if ($cStatus == "Cancelled")
                        {
                            if(!DEBUG)
                            {
                                $el = new CIBlockElement;
                                $arLoadProductArray = Array("ACTIVE" => "N");
                                $result = $el->Update($arScheduleFields["ID"], $arLoadProductArray);
                            }
                            if(VISUALITY) {
                                echo($city . ", " . $code . ", " . $arCourse["0"] . ", " . $cStatus . ", " . $arCourse["DATES_NORMAL"]["START_DATE"] . " - " . $arCourse["DATES_NORMAL"]["END_DATE"] . ", " . $cInstructorName . " <-------- CANCELLED<br/>");
                            }
                        }
                    }

                    if (!DEBUG) // Синхронизируемся с SF
                    {
                        scheduleCOM($arScheduleFields["ID"]);
                    }
                    if(VISUALITY) {
                        echo($city . ", " . $code . ", " . $arCourse["0"] . ", " . $cStatus . ", " . $arCourse["DATES_NORMAL"]["START_DATE"] . " - " . $arCourse["DATES_NORMAL"]["END_DATE"] . ", " . $cInstructorName . " <-------- UPDATED<br/>");
                    }
                    logfile($city . ", " . $code . ", " . $arCourse["0"] . ", " . $cStatus . ", " . $arCourse["DATES_NORMAL"]["START_DATE"] . " - " . $arCourse["DATES_NORMAL"]["END_DATE"] . ", " . $cInstructorName . " <-------- UPDATED");
                }
                else // курса нет в расписании
                {
                    $arPROP["LMS_ID"]=$code;
                    $el = new CIBlockElement;
                    $arLoadProductArray = Array( // "IBLOCK_ID"      => 99 Расписание курсов в Европе
                        "IBLOCK_SECTION_ID" => false,
                        "IBLOCK_ID"      => 99,
                        "PROPERTY_VALUES" => $arPROP,
                        "NAME" => $arCourse["NAME"],
                        "ACTIVE_FROM"=> date("d.m.Y"),
                        "ACTIVE" => "Y"
                    );

                    $arSendNewFields=array("NAME"=> $arPROP["COURSE_CODE"]." ".$arCourse["NAME"], "CITY"=> $city, "DATES"=> $arPROP["STARTDATE"]." - ".$arPROP["ENDDATE"], "TRENER"=> $arTrainer, "PRICE"=> intval($arFields["PROPERTY_PRICE_VALUE"])." euro");

                    if($PRODUCT_ID = $el->Add($arLoadProductArray)) // CIBlockElement::Add метод добавит новый элемент инфоблока (добавляем новый элемент инфоблока - расписание курсов)
                    {
                        if (!DEBUG)
                        {
                            CEvent::Send('NEW_COURSE_TIMETABLE_EN', SITE_ID, $arSendNewFields, 'N', 189); // отправляем письмо по шаблону 189, тип почтового события: NEW_COURSE_TIMETABLE_EN
                            CModule::IncludeModule("catalog");
                            $arCatFields = array(
                                "ID" => $PRODUCT_ID,
                            );
                            CCatalogProduct::Add($arCatFields); // добавляем информацию о новом инфоблоке - расписании курса в каталог
                            $arPriceFields = Array(
                                "PRODUCT_ID" => $PRODUCT_ID,
                                "CATALOG_GROUP_ID" => 1,
                                "PRICE" => $arFields["PROPERTY_PRICE_VALUE"],
                                "CURRENCY" => "EUR"
                            );
                            CPrice::Add($arPriceFields); // добавляем цену
                        }
                        if(VISUALITY) {
                            echo($city . ", " . $code . ", " . $arCourse["0"] . ", " . $cStatus . ", " . $arCourse["DATES_NORMAL"]["START_DATE"] . " - " . $arCourse["DATES_NORMAL"]["END_DATE"] . ", " . $arCourse["12"] . " <-------- ADDED<br/>");
                        }
                        logfile($city . ", " . $code . ", " . $arCourse["0"] . ", " . $cStatus . ", " . $arCourse["DATES_NORMAL"]["START_DATE"] . " - " . $arCourse["DATES_NORMAL"]["END_DATE"] . ", " . $cInstructorName . " <-------- ADDED");
                    }
                    else
                    {
                        echo "ERROR ADD TO SHEDULE: ".$el->LAST_ERROR;
                    }
                }
            }
            else // курс НЕ найден
            {
                if(VISUALITY) {
                    echo $city . ", " . $code . ", " . $arCourse["0"] . ", " . $cStatus . ", " . $arCourse["DATES_NORMAL"]["START_DATE"] . " - " . $arCourse["DATES_NORMAL"]["END_DATE"] . ", " . $arCourse["12"] . " <-------- <b>NOT_FOUND</b>" . "<br/>";
                }
                logfile($city . ", " . $code . ", " . $arCourse["0"] . ", " . $cStatus . ", " . $arCourse["DATES_NORMAL"]["START_DATE"] . " - " . $arCourse["DATES_NORMAL"]["END_DATE"] . ", " . $cInstructorName . " <-------- NOT_FOUND");
            }
        }
    }
}


function checkCommonDates($arDates)
{
    foreach ($arDates as $key=>$date)
    {
        if ($key==0)
        {
            $firstDate=date("d.m.Y", strtotime($date[0]));
        }
        $lastDate=date("d.m.Y", strtotime($date[1]));
        $time=date("H:i", strtotime($date[0]))."-".date("H:i", strtotime($date[1]));
        $arTime[$time]["DATES"][]=$lastDate;
        $arTime[$time]["NAME"]=$time;
    }
    $arResult["START_DATE"]=$firstDate;
    $arResult["END_DATE"]=$lastDate;
    $arResult["TIME"]=$arTime;
    $last_max=0;
    foreach ($arResult["TIME"] as $time=>$dates)
    {
        if (count($dates["DATES"])>$last_max)
        {
            $last_max=count($dates["DATES"]);
            $good_time=$time;
        }

    }
    unset($arResult["TIME"][$good_time]);
    foreach ($arResult["TIME"] as $time=>$bad_dates)
    {
        $string_dates[]=implode(", ", $bad_dates["DATES"])." ".$time;
    }
    if (is_array($string_dates))
    {
        $all_dates=implode("; ",$string_dates);
    }
    $arResult["BAD_TIME"]=$all_dates;
    $arResult["GOOD_TIME"]=$good_time;

    return $arResult;
}

function logFile($textLog, $print_date=false)
{
    $file = '/home/bitrix/ext_www/luxoft-training.ru/debug/logFile.txt';

    $text = "";
    if($print_date)
    {
        $text .= "\r\n" . "=======================" . date('Y-m-d H:i:s') . "=======================" . "\r\n";
    }
    $text .= $textLog . "\r\n";
    $fOpen = fopen($file,'a');
    fwrite($fOpen, $text);
    fclose($fOpen);
}
if(VISUALITY)
{
    require("/home/bitrix/ext_www/luxoft-training.ru/bitrix/footer.php");
}
?>

