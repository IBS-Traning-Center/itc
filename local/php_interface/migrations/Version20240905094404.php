<?php

namespace Sprint\Migration;


class Version20240905094404 extends Version
{
    protected $description = "112833 | Раздел \"Расписание\" | ИБ свойство";

    protected $moduleVersion = "4.6.1";

    /**
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function up()
    {
        $helper = $this->getHelperManager();
        $iblockId = $helper->Iblock()->getIblockIdIfExists('certification', 'catalog');
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Сложность курса',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'COMPLEXITY',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
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
  'VERSION' => '1',
  'USER_TYPE' => NULL,
  'IS_REQUIRED' => 'N',
  'USER_TYPE_SETTINGS' => 'a:0:{}',
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Junior',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'junior',
    ),
    1 => 
    array (
      'VALUE' => 'Middle',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'middle',
    ),
    2 => 
    array (
      'VALUE' => 'Senior',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'senior',
    ),
  ),
));
    
    }

    public function down()
    {
        //your code ...
    }
}
