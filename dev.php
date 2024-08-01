<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("dev");
?>

<?
// Получаем данные из POST-запроса
$name = $_POST['name'];
$time = $_POST['time'];
$kurs_id = $_POST['kurs_id'];
$teacher_id = $_POST['teacher_id'];
$date_begin = $_POST['date_begin'];
$date_end = $_POST['date_end'];
$period = $_POST['period'];
$course_code = $_POST['course_code'];
$course_category = $_POST['course_category'];
$teacher_price = $_POST['teacher_price'];
$duration = $_POST['duration'];
$location = $_POST['location'];


// Создаем новый элемент инфоблока
$element = new CIBlockElement;

// Устанавливаем значения полей элемента
$elementFields = array(
    'IBLOCK_ID' => 9, // ID нужного инфоблока
    'NAME' => $name, //  имя элемента
    'PROPERTY_VALUES' => array(
        'schedule_time' => $time,
        'startdate' => $date_begin,
        'enddate' => $date_end,
        'schedule_duration' => $duration,
        'schedule_course' => $kurs_id,

        // Добавьте остальные поля, которые вы передавали
    ),
);

// Добавляем элемент в инфоблок
if ($elementId = $element->Add($elementFields)) {
    echo "елемент добавлен";
} else {
    echo "ошибка добавления";
}
?>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>