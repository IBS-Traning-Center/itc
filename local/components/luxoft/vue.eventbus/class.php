<?php
use Bitrix\Main\Application;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();


/**
 * Class VueEventbus
 */
class VueEventbus extends CBitrixComponent
{
  public function executeComponent()
  {
    $this->includeComponentTemplate();
  }

}
