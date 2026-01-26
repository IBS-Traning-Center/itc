<?php

namespace Sprint\Migration;


class Version20260122122742 extends Version
{
    protected $description = "136271 | Стать тренером / Добавить блоки: \"Эксперты...\", \"Студенты...\", \"Как начать...\" | добавление свойства в Иб тренеров";

    protected $moduleVersion = "4.6.1";

    /**
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function up()
    {
        $helper = $this->getHelperManager();
        $iblockId = $helper->Iblock()->getIblockIdIfExists('trainers', 'edu');
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Текст эксперта',
  'ACTIVE' => 'Y',
  'SORT' => '45',
  'CODE' => 'TEXT_EXPERT',
  'DEFAULT_VALUE' => 
  array (
    'TEXT' => '',
    'TYPE' => 'HTML',
  ),
  'PROPERTY_TYPE' => 'S',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => '',
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => 'HTML',
  'IS_REQUIRED' => 'N',
  'USER_TYPE_SETTINGS' => 
  array (
    'height' => 200,
  ),
  'HINT' => '',
));
    
    }

    public function down()
    {
        //your code ...
    }
}
