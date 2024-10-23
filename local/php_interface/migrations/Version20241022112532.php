<?php

namespace Sprint\Migration;


class Version20241022112532 extends Version
{
    protected $description = "116073 | Нет элемента для вывода градации специалистов / Новое свойство Для кого";

    protected $moduleVersion = "4.6.1";

    /**
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function up()
    {
        $helper = $this->getHelperManager();
        $iblockId = $helper->Iblock()->getIblockIdIfExists('seminars', 'edu');
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Для кого',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'ELEMENT_FOR',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'S',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'Y',
  'XML_ID' => '',
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => 'directory',
  'IS_REQUIRED' => 'N',
  'USER_TYPE_SETTINGS' => 
  array (
    'size' => 1,
    'width' => 0,
    'group' => 'N',
    'multiple' => 'N',
    'TABLE_NAME' => 'whocourse',
  ),
  'HINT' => '',
));
    
    }

    public function down()
    {
        //your code ...
    }
}
