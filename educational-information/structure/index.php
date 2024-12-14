<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Структура и органы управления образовательной организацией");
?>
<h2>Структура и органы управления образовательной организацией</h2>
<div>
    <div>
        <b><br>
        </b><b>Директор АНО ДПО "УЦ ИБС"</b> – Гернер Владимир Александрович.<br>

        <br>
    </div>
    <div>
        <b>Главный бухгалтер –</b> Лелетко Светлана Олеговна.<br>
        <br>
        <b>Коллегиальный орган управления:</b>
        <div>
            Общее собрание работников (созывается не реже раза в год).
        </div>
        <div>
            Совещательный коллегиальный орган управления – педагогический совет (созывается по мере необходимости).
        </div>
        <b><br>
        </b>
    </div>
    <div>
        <b>Адрес расположения структурных подразделений и контакты:</b>
    </div>
    <br>
</div>
<p>
    <b>Телефоны:</b>
    <span class="less">
        <a href="tel:+7 (495) 609-6967">+7 (495) 609-6967</a>,
        <a href="tel:+7 (931) 009-6926">+7 (931) 009-6926</a>
    </span>
</p>
<p>
    <b>E-mail:</b> <span class="less"><a title="Написать письмо" href="mailto:education@ibs.ru">education@ibs.ru</a></span>
</p>
<p>
    <b>Адрес:</b> <span class="less">Россия, 127018, Москва, ул. Складочная, д. 3, стр. 1</span>
</p>
<div class="maps">
    <?
    $MAP_DATA = [
        'yandex_lat' => 55.806100,
        'yandex_lon' => 37.590794,
        'yandex_scale' => 15,
        'PLACEMARKS' => [
                [
                    'TEXT' => 'Офис IBS Training Center',
                    'LAT' => 55.806100,
                    'LON' => 37.590794
                ]
        ]
    ];

    $APPLICATION->IncludeComponent(
        "bitrix:map.yandex.view",
        ".default",
        array(
            "INIT_MAP_TYPE" => "ROADMAP",    // Стартовый тип карты
            "MAP_DATA" => serialize($MAP_DATA),    // Данные, выводимые на карте
            "MAP_WIDTH" => "609",    // Ширина карты
            "MAP_HEIGHT" => "300",    // Высота карты
            "CONTROLS" => array(    // Элементы управления
                0 => "SMALL_ZOOM_CONTROL",
                1 => "TYPECONTROL",
                2 => "SCALELINE",
            ),
            "OPTIONS" => array(    // Настройки
                0 => "ENABLE_SCROLL_ZOOM",
                1 => "ENABLE_DBLCLICK_ZOOM",
                2 => "ENABLE_DRAGGING",
                3 => "ENABLE_KEYBOARD",
            ),
            "MAP_ID" => "gm_1",    // Идентификатор карты
        )
    ); ?>
</div>
<br><? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>