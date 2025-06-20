<?php

namespace Local\Util;

/**
 * ComponentHelper
 *
 * Создает плейсхолдеры в шаблоне
 * При помощи статической функции handle обрабатывает их
 * Класс необходим для вызова некешируемых функций
 */
class ComponentHelper
{
    private $component;
    private $lastPlIndex = 0;
    private $pull = [];

    public function __construct(\CBitrixComponent $component)
    {
        $this->component = $component;
        $this->component->SetResultCacheKeys(['CACHED_TPL', 'CACHED_TPL_PULL']);
        ob_start();
    }

    public function deferredCall($callback, $args = [])
    {
        $plName = $this->getNextPlaceholder();
        echo $plName;
        $this->pull[$plName] = ['callback' => $callback, 'args' => $args];
    }

    public function saveCache()
    {
        $this->component->arResult['CACHED_TPL'] = @ob_get_contents();
        $this->component->arResult['CACHED_TPL_PULL'] = $this->pull;
        ob_get_clean();
        $this->component = null;
    }

    private function getNextPlaceholder()
    {
        return '##PLACEHOLDER_'.(++$this->lastPlIndex).'##';
    }

    public static function handle(\CBitrixComponent $component)
    {
        $buf = &$component->arResult['CACHED_TPL'];
        foreach ($component->arResult['CACHED_TPL_PULL'] as $plName => $params) {
            list($prevPart, $nextPart) = explode($plName, $buf);
            echo $prevPart;
            call_user_func_array($params['callback'], $params['args']);
            $buf = &$nextPart;
        }

        echo $buf;
    }
}