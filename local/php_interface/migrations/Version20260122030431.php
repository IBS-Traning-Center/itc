<?php

namespace Sprint\Migration;


class Version20260122030431 extends Version
{
    protected $description = "136271 | Стать тренером / Добавить блоки: \"Эксперты...\", \"Студенты...\", \"Как начать...\" | добавление свойства в Иб";

    protected $moduleVersion = "4.6.1";

    /**
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function up()
    {
        $helper = $this->getHelperManager();
        $iblockId = $helper->Iblock()->getIblockIdIfExists('reviews', 'edu');
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Показывать на странице стать тренером',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'SHOW_ON_TALENT',
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
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'IS_REQUIRED' => 'N',
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Y',
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
