<?php

namespace Local\Util;

use Bitrix\Main\Loader;
use Bitrix\Main\SystemException;

/**
 * Class FormHelper
 * @package Local\Util
 *
 * Вспомогательные функции для работы с веб-формами
 */
class FormHelper
{
    /**
     * Получить ID формы по её символьному коду (SID)
     *
     * @param string $sid Символьный код формы
     * @return int|null ID формы или null, если форма не найдена
     * @throws SystemException
     */
    public static function getFormIdBySid(string $sid): ?int
    {
        if (!Loader::includeModule('form')) {
            throw new SystemException('Модуль form не подключен');
        }

        $rsForms = \CForm::GetList(
            $by = 's_id',
            $order = 'asc',
            ['SID' => $sid]
        );

        if ($form = $rsForms->Fetch()) {
            return (int)$form['ID'];
        }

        return null;
    }
}
