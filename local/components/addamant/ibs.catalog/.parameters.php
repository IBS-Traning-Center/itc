<?php

if (!CModule::IncludeModule('vote'))
    return;

/**
 * @var array $arCurrentValues
 */

$arrChannels = array();
$rs = CVoteChannel::GetList();
while ($arChannel=$rs->GetNext())
{
    $arrChannels[$arChannel['SID']] = '['.$arChannel['SID'].'] '.html_entity_decode($arChannel['TITLE']);
}

$arComponentParameters =
    [
        'PARAMETERS' =>
            [
                'VARIABLE_ALIASES' =>
                    [
                        'ELEMENT_ID' => ['NAME' => 'Идентификатор элемента'],
                    ],
                'SEF_MODE' =>
                    [
                        'list' =>
                            [
                                'NAME' => 'Страница общего списка',
                                'DEFAULT' => 'list',
                                'VARIABLES' => [],
                            ],
                        'vote' =>
                            [
                                'NAME' => 'Страница детального просмотра',
                                'DEFAULT' => 'vote',
                                'VARIABLES' => ['ELEMENT_CODE', 'ELEMENT_ID'],
                            ],
                    ],
                'POLLS_COUNT' =>
                    [
                        'PARENT' => 'BASE',
                        'NAME' => 'Количество опросов на странице',
                        'TYPE' => 'STRING',
                        'DEFAULT' => '6',
                    ],
                'FILTER_NAME' =>
                    [
                        'PARENT' => 'DATA_SOURCE',
                        'NAME' => 'Фильтр',
                        'TYPE' => 'STRING',
                        'DEFAULT' => '',
                    ],
                'CHANNEL_SID' => 
                    [
                        'NAME' => 'Группа опросов',
                        'TYPE' => 'LIST',
                        'PARENT' => 'BASE',
                        'VALUES' => $arrChannels,
                        'DEFAULT' => '',
                        'MULTIPLE' => 'N',
                    ],
                'NAV_TEMPLATE' =>
                    [
                        'NAME' => 'Шаблон постраничной навигации',
                        'TYPE' => 'STRING',
                        'PARENT' => 'BASE',
                        'DEFAULT' => 'mrts_default'
                    ]
            ],
    ];

CIBlockParameters::AddPagerSettings(
    $arComponentParameters,
    'Опросы',
    true,
    true,
    true,
    ($arCurrentValues['PAGER_BASE_LINK_ENABLE'] ?? '') === 'Y'
);

CIBlockParameters::Add404Settings($arComponentParameters, $arCurrentValues);
