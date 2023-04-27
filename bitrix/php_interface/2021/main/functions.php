<?php

function timezoneCodeToUTC($code) {
    $dateTime = new DateTime();
    $dateTime->setTimeZone(new DateTimeZone($code));
    $utcHour = $dateTime->format('Z') / 3600;
    return 'UTC ' . (($utcHour > 0) ? '+' : '') . $utcHour;
}
function getLangs()
{
    $results = [];
    if (\Bitrix\Main\Loader::includeModule('iblock')) {
        $db_result = \CIBlockElement::GetList(
            ['SORT' => 'ASC', 'ID' => 'DESC'],
            ['IBLOCK_ID' => EN_IB_LANG, 'ACTIVE' => 'Y'],
            false,
            false,
            ['ID', 'NAME']
        );
        while ($result = $db_result->GetNext()) {
            $results[$result['ID']] = $result['NAME'];
        }
    }
    return $results;
}
function getCities()
{
    $results = [];
    if (\Bitrix\Main\Loader::includeModule('iblock')) {
        $db_result = \CIBlockElement::GetList(
            ['SORT' => 'ASC', 'ID' => 'DESC'],
            ['IBLOCK_ID' => (SITE_ID == 'ru') ? RU_IB_CITIES : EN_IB_CITIES, 'ACTIVE' => 'Y'],
            false,
            false,
            ['IBLOCK_ID', 'ID', 'NAME', 'ACTIVE']
        );
        while ($result = $db_result->GetNext()) {
            $results[$result['ID']] = $result['NAME'];
        }
    }
    return ['37594' => 'Online'];
}
function getUrl ($is_absolute = true)
{
    if($is_absolute) {
        $url = $_SERVER['HTTP_X_FORWARDED_PROTO'] . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    } else {
        $url = $_SERVER['REQUEST_URI'];
    }
    return $url;
}
function reverse_parse_url(array $parts)
{
    $url = '';
    if (!empty($parts['scheme'])) {
        $url .= $parts['scheme'] . ':';
    }
    if (!empty($parts['user']) || !empty($parts['host'])) {
        $url .= '//';
    }
    if (!empty($parts['user'])) {
        $url .= $parts['user'];
    }
    if (!empty($parts['pass'])) {
        $url .= ':' . $parts['pass'];
    }
    if (!empty($parts['user'])) {
        $url .= '@';
    }
    if (!empty($parts['host'])) {
        $url .= $parts['host'];
    }
    if (!empty($parts['port'])) {
        $url .= ':' . $parts['port'];
    }
    if (!empty($parts['path'])) {
        $url .= $parts['path'];
    }
    if (!empty($parts['query'])) {
        if (is_array($parts['query'])) {
            $url .= '?' . http_build_query($parts['query']);
        } else {
            $url .= '?' . $parts['query'];
        }
    }
    if (!empty($parts['fragment'])) {
        $url .= '#' . $parts['fragment'];
    }

    return $url;
}
function queryReplace($arQuery, $url = '')
{
    if(empty($url)) $url = getUrl(false);

    $query = [];
    $url = parse_url($url);

    if(isset($arQuery['*'])) {
        switch ($arQuery['*']) {
            case '_remove_':
                $url['query'] = '';
                break;
        }
    } else {
        parse_str($url['query'],$query);
        foreach ($arQuery as $code => $value) {
            switch ($value) {
                case '_remove_':
                    unset($query[$code]);
                    break;
                default:
                    $query[$code] = $value;
                    break;
            }
        }
        $url['query'] = http_build_query($query);
    }


    if (function_exists('http_build_url')) {
        $url = http_build_url($url);
    } else {
        $url = reverse_parse_url($url);
    }

    return $url;
}
