<?php

namespace Sprint\Migration;


class Version20240815081119 extends Version
{
    protected $description = "112820 | Главная Страница / Свойства ИБ Страницы";

    protected $moduleVersion = "4.6.1";

    /**
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function up()
    {
        $helper = $this->getHelperManager();
        $iblockId = $helper->Iblock()->getIblockIdIfExists('ru_pages', 'edu_const');
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Элемент возвращения денег',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'ELEM_MONEY_RETURN',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'C',
  'MULTIPLE' => 'N',
  'XML_ID' => '',
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'VERSION' => '1',
  'USER_TYPE' => NULL,
  'IS_REQUIRED' => 'N',
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Да',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'Y',
    ),
  ),
));
    
    }

    public function down()
    {
        //your code ...
    }
}
