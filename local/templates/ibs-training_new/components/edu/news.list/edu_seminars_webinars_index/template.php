<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
if (!function_exists('plural_form')) {
    function plural_form($number, $after) {
        $cases = array(2, 0, 1, 1, 1, 2);
        echo $number . ' ' . $after[($number % 100 > 4 && $number % 100 < 20) ? 2 : $cases[min($number % 10, 5)]];
    }
}
?>
<div class="timetable-section">
    <?php if (count($arResult["ITEMS"]) > 0) { ?>

        <h3 class="timetable-title">Начните учиться бесплатно</h3>

        <div class="timetable-list">
            <? foreach ($arResult["ITEMS"] as $arItem) {
                $arr = ParseDateTime($arItem['PROPERTIES']['startdate']['VALUE'], "DD.MM.YYYY HH:MI:SS");
                $arItem['PROPERTIES']['startdate']['VALUE'] = $arr["DD"] . "." . $arr["MM"] . "." . $arr["YYYY"];
                ?>
                <div class="timetable-item timetable-item_seminar">
                    <div class="timetable-item-wrap">
                        <div class="timetable-name-wrap">
                            <div class="name-n-code-wrap <?=$icon?>">
                                <div class="code-icon-wrap">
                                    <? if(intval($arItem['DURATION'])>0) {?>
                                        <span class="hours"><?=plural_form($arItem['DURATION'], array("час", "часа", "часов"))?></span>
                                    <?}?>
                                </div>
                                <a class="course-name-time" href="<?= $arItem["DETAIL_PAGE_URL"] ?>"><?= $arItem["NAME"] ?></a>
                            </div>
                        </div>
                        <div class="time-price-wrapper clearfix">
                            <? if (count($arResult['TRENER_INFO'][$arItem['ID']])) { ?>
                                <div class="trener-info">Тренер: <a title="Перейти на страницу-карточку преподавателя"
                                                                    href="/about/experts/<?= $arResult['TRENER_INFO'][$arItem['ID']]['CODE'] ?>.html"><?= $arResult['TRENER_INFO'][$arItem['ID']]['NAME'] ?> <?= $arResult['TRENER_INFO'][$arItem['ID']]['~PROPERTY_EXPERT_NAME_VALUE'] ?></a>
                                </div>
                            <? } ?>
                            <? if ($arItem['PROPERTIES']['type_event']['VALUE_ENUM_ID'] != 92 && $arItem['PROPERTIES']['type_event']['VALUE_ENUM_ID'] != 324) { ?>
                                <div class="treners-wrap">Место: <?= $arItem['PROPERTIES']['location']['VALUE'] ?></div>
                            <? } ?>
                            <?if($arItem['PROPERTIES']['LAGUAGE']['VALUE']) {?>
                                <div class="treners-wrap">Язык: <?= $arItem['PROPERTIES']['LAGUAGE']['VALUE'] ?></div>
                            <? } ?>
                            <div class="time-wrapper">
                                Дата и время:
                                <div class="time-wrapper-right">
                                    <div class="timedate">
                                        <? if(strlen($arItem['PROPERTIES']['startdate']['VALUE'])>0) {?>
                                            <?=date("d.m.Y", strtotime($arItem['PROPERTIES']['startdate']['VALUE']))?><br>
                                        <?}?>
                                        <? if(strlen($arItem['PROPERTIES']['enddate']['VALUE'])>0) {?>
                                            <?= date("d.m.Y", strtotime($arItem['PROPERTIES']['enddate']['VALUE']))?><br>
                                        <?}?>
                                    </div>
                                    <? if(strlen($arItem['PROPERTIES']['time']['VALUE'])>0) {?>
                                        <span class="time"><?= $arItem['PROPERTIES']['time']['VALUE'] ?></span>
                                    <?}?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?}?>
        </div>

    <? } ?>

    <? if (count($arResult["ITEMS"]) == 0) { ?>
        <h3 style="padding: 25px 0; text-align: center">В ближайшее время семинары не запланированы</h3>
    <? } ?>
</div>