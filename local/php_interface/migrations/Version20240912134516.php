<?php

namespace Sprint\Migration;


class Version20240912134516 extends Version
{
    protected $description = "112825 | Страница \"Бесплатного семинара\" | свойство ИБ";

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
  'NAME' => 'Содержание семинара',
  'ACTIVE' => 'Y',
  'SORT' => '70',
  'CODE' => 'content',
  'DEFAULT_VALUE' => 
  array (
    'TYPE' => 'HTML',
    'TEXT' => '',
  ),
  'PROPERTY_TYPE' => 'S',
  'ROW_COUNT' => '6',
  'COL_COUNT' => '45',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => '20',
  'FILE_TYPE' => 'jpg, gif, bmp, png, jpeg',
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
