<?php

namespace Sprint\Migration;


class Version20240925135825 extends Version
{
    protected $description = "114933 | Тренер / Не корректно выводятся сертификаты / Свойство сертификатов тренеров";

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
  'NAME' => 'HTML Курсы, сертификаты',
  'ACTIVE' => 'Y',
  'SORT' => '550',
  'CODE' => 'HTML_CERTIFIED',
  'DEFAULT_VALUE' => NULL,
  'PROPERTY_TYPE' => 'S',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'Y',
  'XML_ID' => '351',
  'FILE_TYPE' => 'jpg, gif, bmp, png, jpeg',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'IS_REQUIRED' => 'N',
  'USER_TYPE_SETTINGS' => 'a:1:{s:6:"height";i:200;}',
  'HINT' => '',
));
    
    }

    public function down()
    {
        //your code ...
    }
}
