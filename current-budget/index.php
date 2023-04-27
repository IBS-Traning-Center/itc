<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("current_budget");?>
<?php
$now = new DateTime();
$dbAccountCurrency = CSaleUserAccount::GetList(
    array("CURRENT_BUDGET" => "DESC"),
    array(">CURRENT_BUDGET" => "999", "CURRENCY" => "RUB", ">TIMESTAMP_X" => $now->modify('-365 day')->format('d.m.Y H:i:s')),
    false,
    false,
    array("CURRENT_BUDGET", "CURRENCY", "TIMESTAMP_X", "USER_ID")
);
while ($arAccountCurrency = $dbAccountCurrency->Fetch()) {
    $arFilter = array(
        'ID' => $arAccountCurrency["USER_ID"],
    );
    $dbUsers = CUser::GetList($by = 'ID', $order = 'ASC', $arFilter);
    while ($arUser = $dbUsers->Fetch()) {
        if (strlen($arUser["NAME"]) > 2) {
            $NAME = $arUser["LAST_NAME"] . " " . $arUser["NAME"];
        } else {
            $NAME = $arUser["LOGIN"];
        }
        $arCourses = array();
        if (!stristr($arUser["EMAIL"], 'luxoft') && !stristr($arUser["EMAIL"], 'vigandt') && !stristr($arUser["EMAIL"], 'david.guseinov') && !stristr($arUser["EMAIL"], 'vita_moskalets@ukr.net')) {

            $arSelect = array("ID", "NAME", "PROPERTY_SCH_COURSE.NAME",);
            $arFilter = array("IBLOCK_ID" => 108, "PROPERTY_USER" => $arAccountCurrency["USER_ID"], "!PROPERTY_CERT" => false);
            $res = CIBlockElement::GetList(array(), $arFilter, false, array("nPageSize" => 50), $arSelect);
            while ($ob = $res->GetNextElement()) {
                $arFields = $ob->GetFields();
                if (strlen($arFields["PROPERTY_SCH_COURSE_NAME"]) > 0) {
                    $arCourses[] = $arFields["PROPERTY_SCH_COURSE_NAME"] . "<br>";
                }

            }
            $str_courses = "";
            $str_courses = implode("<br>", $arCourses);
            $arUsers[] = array(
                "EMAIL" => $arUser["EMAIL"],
                "BUDGET" => intval($arAccountCurrency["CURRENT_BUDGET"]) . ' ' . getCountVal($arAccountCurrency["CURRENT_BUDGET"], array("бонусный балл", "бонусных балла", "бонусных баллов")),
                "TIME" => $arAccountCurrency["TIMESTAMP_X"],
                "ID" => $arUser["ID"],
                "NAME" => $NAME,
                "COURSES" => $str_courses);
        }
    }
}
echo "<table class='table'>";
foreach ($arUsers as $key => $arOneUser) {
    echo "<tr><td style='padding: 5px;'>" . ($key + 1) . "</td><td style='padding: 5px;'>" . $arOneUser["NAME"] . "</td><td style='padding: 5px;'>[" . $arOneUser["EMAIL"] . "]</td><td style='padding: 5px; min-width: 150px;'>" . $arOneUser["BUDGET"] . "</td><td style='padding: 5px; min-width: 150px;'>" . $arOneUser["TIME"] . "</td><td style='padding: 5px;'>" . $arOneUser["COURSES"] . "</td></tr>";
}
echo "</table>"; ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>