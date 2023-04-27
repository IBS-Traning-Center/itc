<?
chdir('Courses');
$files = scandir(getcwd());
foreach($files as $Item) // цикл по файлам
{

    if(strlen($Item) < 3) continue;
    $content = file_get_contents(getcwd().'/'.$Item);

    $array = explode(PHP_EOL, $content);

    foreach($array as $index => $sItem) // цикл по записям о проведении курсов (одна запись - один день проведения определенного курса)
    {
        if($index == 0) continue; // пропускаем строку заголовков (первый элмеент в масссиве)
        if(strlen($sItem) == 0) continue; // проупскаем пусту строку (последний элемент в массиве)
        $arItem= explode("\t", $sItem); // массив параметров расписания курса

        $course_status = $arItem[5];
        $course_code = $arItem[9];
        $course_city = $arItem[14];
        $course_location = $arItem[15];

        $course_start_date = $arItem[6];
        $course_end_date = $arItem[7];
        $course_duration = $arItem[16];
        $course_lang = $arItem[19];
        $course_time_break = $arItem[21];

        $dates=array($course_start_date, $course_end_date);
        $city = strlen($course_city) > 0 ? $course_city : $course_location;

        if ($city=="Virtual" && stristr($course_lang, "English"))
        {
            $city="Virtual_EN";
        }
        if (!is_array($arResultArray[$city][$course_code]))
        {
            $arResultArray[$city][$course_code]=$arItem;
        }
        $arResultArray[$city][$course_code]["DATES"][]=$dates;
        $arResultArray[$city][$course_code]["DURATION"]=$arResultArray[$city][$course_code]["DURATION"]+($course_duration-intval($course_time_break));
    }
}

$end = true;

?>