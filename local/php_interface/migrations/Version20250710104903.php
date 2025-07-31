<?php

namespace Sprint\Migration;


class Version20250710104903 extends Version
{
    protected $description = "126973 | Доработка форм / Добавление символьного кода API для ИБ REF Города (сп)";

    protected $moduleVersion = "4.6.1";

    /**
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function up()
    {
        $helper = $this->getHelperManager();
        $iblockId = $helper->Iblock()->saveIblock(array (
  'IBLOCK_TYPE_ID' => 'edu_const',
  'LID' => 
  array (
    0 => 'ru',
  ),
  'CODE' => 'edu_cities',
  'API_CODE' => 'cities',
  'NAME' => 'REF Города (сп)',
  'ACTIVE' => 'Y',
  'SORT' => '3000',
  'LIST_PAGE_URL' => '',
  'DETAIL_PAGE_URL' => '',
  'SECTION_PAGE_URL' => '',
  'PICTURE' => '1',
  'DESCRIPTION' => '',
  'DESCRIPTION_TYPE' => 'text',
  'RSS_TTL' => '24',
  'RSS_ACTIVE' => 'Y',
  'RSS_FILE_ACTIVE' => 'N',
  'RSS_FILE_LIMIT' => NULL,
  'RSS_FILE_DAYS' => NULL,
  'RSS_YANDEX_ACTIVE' => 'N',
  'XML_ID' => '51',
  'INDEX_ELEMENT' => 'N',
  'INDEX_SECTION' => 'N',
  'VERSION' => '1',
  'LAST_CONV_ELEMENT' => '0',
  'EDIT_FILE_BEFORE' => '',
  'EDIT_FILE_AFTER' => '',
  'SECTIONS_NAME' => '-',
  'SECTION_NAME' => '-',
  'ELEMENTS_NAME' => 'Просмотреть список городов',
  'ELEMENT_NAME' => 'Город',
  'WORKFLOW' => 'N',
  'SECTION_CHOOSER' => 'L',
  'BIZPROC' => 'N',
  'LIST_MODE' => '',
  'SOCNET_GROUP_ID' => NULL,
  'RIGHTS_MODE' => 'E',
  'SECTION_PROPERTY' => 'N',
  'PROPERTY_INDEX' => 'N',
  'CANONICAL_PAGE_URL' => '',
  'REST_ON' => 'N',
  'FULLTEXT_INDEX' => 'N',
  'EXTERNAL_ID' => '51',
  'LANG_DIR' => '/',
  'IPROPERTY_TEMPLATES' => 
  array (
  ),
  'ELEMENT_ADD' => 'Добавить город',
  'ELEMENT_EDIT' => 'Изменить город',
  'ELEMENT_DELETE' => 'Удалить город',
  'SECTION_ADD' => '-',
  'SECTION_EDIT' => '-',
  'SECTION_DELETE' => '-',
));

    }

    public function down()
    {
        //your code ...
    }
}
