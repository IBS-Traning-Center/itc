<?$APPLICATION->IncludeComponent(
    "luxoft:sef.comp",
    "",
    Array(
    ),
    false
);?>
<?GLOBAL $COURSE_ID;?>
<?global $arCourseInfoID;?> <?$arCourseInfoID = $APPLICATION->IncludeComponent(
    "artions:course.info",
    ".default",
    Array(
        "IBLOCK_TYPE" => "edu",
        "IBLOCK_ID" => "6",
        "ELEMENT_ID" => $COURSE_ID,
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
        "CACHE_NOTES" => ""
    ),
    false
);?>
<div class="white-hilghlight">
    <div class="hight-part">
        <h1><?=$arCourseInfoID["TIMETABLE_INFO"][0]["COURSE_NAME"]?></h1>
        <div class="descript">
            <?=$arCourseInfoID["DESCRIPTION"]?>
        </div>
    </div>

    <?if (is_array($arCourseInfoID["DETAIL_PICTURE"])) {?>
        <div class="picture">
            <img alt="<?=$arCourseInfoID["TIMETABLE_INFO"][0]["COURSE_NAME"]?>" src="<?=$arCourseInfoID["DETAIL_PICTURE"]["SRC"]?>" />
        </div>
    <?}?>
</div>