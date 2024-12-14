<?php

namespace Sprint\Migration;


class Version20240909114021 extends Version
{
    protected $description = "112832 | Раздел \"Тренеры\" / Свойство тегов ИБ тренеров";

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
  'NAME' => 'Теги тренера',
  'ACTIVE' => 'Y',
  'SORT' => '70',
  'CODE' => 'TRAINER_TAGS',
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
    'TABLE_NAME' => 'tags_catalog',
  ),
  'HINT' => '',
));
    
    }

    public function down()
    {
        //your code ...
    }
}
