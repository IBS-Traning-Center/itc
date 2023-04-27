<?php

namespace Luxoft\Dev;

class Tools
{
    public static function timezoneCodeToUTC($code): string
    {
        if(!empty($code)) {
            $dateTime = new \DateTime();
            $dateTime->setTimeZone(new \DateTimeZone($code));
            $utcHour = $dateTime->format('Z') / 3600;
            return 'UTC ' . (($utcHour > 0) ? '+' : '') . $utcHour;
        }
        return '';
    }

    public static function locationPrice(bool $format, int $price, string $location = null, int $duration = null)
    {
        $result = '';
        $currency = 'RUB';
        switch ($location) {
            case 'SPB':
                $result = round(($price-$price/100*10)/10)*10;
                break;
            case 'OMSK':
                $result = round(($price-$price/100*25)/10)*10;
                break;
            case 'UA':
                $currency = 'RUB';
                if ($duration<=39) {
                    $priceOut= 	$duration * 300;
                } else {
                    $priceOut= 	$duration * 225;
                }
            case 'KIEV':
            case 'ODESSA':
            case 'DNEPR':
                break;

            case 'MOSCOW':
            default:
                $result = $price;
                break;
        }

        if($format) {
            $result = \CCurrencyLang::CurrencyFormat($result,  $currency);
        }

        return $result;
    }

    public static function fn_getMostNewCityPrice($price, $price_ua, $cityid, $duration) {
        //$priceUA=$price/35;
        if ($cityid==CITY_ID_MOSCOW) {
            $priceOut = $price;
        } elseif ($cityid==CITY_ID_SPB){
            $priceOut = round(($price-$price/100*10)/10)*10;
        } elseif ($cityid==CITY_ID_OMSK){
            $priceOut = round(($price-$price/100*25)/10)*10;
        } elseif ($cityid==CITY_ID_KIEV){
            if (intval($price_ua)>0) {
                $priceOut=$price_ua;

            } else {
                if ($duration<=39) {
                    $priceOut= 	$duration * 300;
                } else {
                    $priceOut= 	$duration * 225;
                }
            }
        } elseif ($cityid==CITY_ID_ODESSA){
            if (intval($price_ua)>0) {
                $priceOut=round($price_ua*0.9, -2);

            } else {
                if ($duration<=39) {
                    $priceOut= 	$duration * 270;
                } else {
                    $priceOut= 	$duration * 200;
                }
            }
        } elseif ($cityid==CITY_ID_DNEPR){
            if (intval($price_ua)>0) {
                $priceOut=round($price_ua*0.9, -2);

            } else {
                if ($duration<=39) {
                    $priceOut= 	$duration * 270;
                } else {
                    $priceOut= 	$duration * 200;
                }
            }
        } else {
            $priceOut = $price;
        }
        return $priceOut;
    }

     public static function getLangs()
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
     public static function getCities()
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
     public static function getUrl ($is_absolute = true)
    {
        if($is_absolute) {
            $url = $_SERVER['HTTP_X_FORWARDED_PROTO'] . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        } else {
            $url = $_SERVER['REQUEST_URI'];
        }
        return $url;
    }
     public static function reverse_parse_url(array $parts)
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
     public static function queryReplace($arQuery, $url = '')
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

    public static function searchLuxoftName(array $fields, array $validatedFields = []): bool
    {
        $isValidate = count($validatedFields);
        $searchNames = ['luxoft', 'люксофт', 'dxc'];
        $result = false;

        foreach ($fields as $fieldKey => $field) {
            if(
                ($isValidate && !in_array($fieldKey, $validatedFields))
                || gettype($field) !== 'string'
                || empty($field)
            ) {
                continue;
            }

            $field = trim(mb_strtolower($field));
            foreach ($searchNames as $name) {
                if(strpos($field, $name) !== false) {
                    $result = true;
                    break;
                }
            }
        }

        return $result;
    }
}