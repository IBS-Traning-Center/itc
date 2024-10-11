<?php

namespace Local\Util;

use Bitrix\Main\Diag\Debug;
use Bitrix\Main\Loader;
use Bitrix\Main\IO\File;
use \Bitrix\Iblock\Elements\ElementSettingsTable;

/**
 * Class Functions
 * @package Local\Util
 *
 * Различные вспомогательные функции
 */
class Functions
{
    /**
     * Функция добавления svg файла в html
     *
     * @param string $svgName Название файла.
     * @param string $base    Папка с файлом относительно корня сайта.
     * @return string Добавление содержимого файла.
     */
    public static function buildSVG(string $svgName, string $base = 'image'): string
    {
        return file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/' . $base . '/' . $svgName . '.svg');
    }

    /*
     * Функция выводит верное окончание слова
    */
    public static function numWord($value, $words, $show = true): string
    {
        $num = $value % 100;
        if ($num > 19) {
            $num = $num % 10;
        }

        $out = ($show) ?  $value . ' ' : '';
        $out .= match ($num) {
            1 => $words[0],
            2, 3, 4 => $words[1],
            default => $words[2],
        };

        return $out;
    }

    /*
     * Функция получается глобальные настройки сайта
     */
    public static function getSiteSettings(): array
    {
        $elem = ElementSettingsTable::getList([
            'select' => [
                'MONEY_RETURN_LINK'
            ],
            'filter' => [
                'ACTIVE' => 'Y',
                'CODE' => 'global'
            ]
        ])->fetchObject();

        if (!$elem) {
            return [];
        }

        $settings = [];

        if ($elem->getMoneyReturnLink() && $elem->getMoneyReturnLink()->getValue()) {
            $settings['MONEY_RETURN_LINK'] = $elem->getMoneyReturnLink()->getValue();
        }

        return $settings;
    }
}
