<?php

namespace Sprint\Migration;


class Version20240820093442 extends Version
{
    protected $description = "112827 / Страница \"О Нас / Контакты\" / Свойства ИБ";

    protected $moduleVersion = "4.6.1";

    /**
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function up()
    {
        $helper = $this->getHelperManager();
        $iblockId = $helper->Iblock()->getIblockIdIfExists('CONTACTS', 'land');
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Карта',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'MAP',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'S',
  'ROW_COUNT' => '4',
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
  'VERSION' => '1',
  'USER_TYPE' => NULL,
  'IS_REQUIRED' => 'N',
  'USER_TYPE_SETTINGS' => 'a:0:{}',
  'HINT' => '',
));
    
    }

    public function down()
    {
        //your code ...
    }
}
