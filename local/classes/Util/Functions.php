<?php

namespace Local\Util;

use Bitrix\Main\Diag\Debug;
use Bitrix\Main\Loader;
use Bitrix\Main\IO\File;

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
}
