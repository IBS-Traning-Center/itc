<?php

namespace Sprint\Migration;


class Version20250721185434 extends Version
{
    protected $description = "127814 | Выгрузить доработки на копию сайта | выгрузка ИБ Уровни сертификации";

    protected $moduleVersion = "4.6.1";

    /**
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function up()
    {
        $helper = $this->getHelperManager();
        $helper->Iblock()->saveIblockType(array (
  'ID' => 'edu_const',
  'SECTIONS' => 'Y',
  'EDIT_FILE_BEFORE' => '',
  'EDIT_FILE_AFTER' => '',
  'IN_RSS' => 'N',
  'SORT' => '200',
  'LANG' => 
  array (
    'ru' => 
    array (
      'NAME' => 'RU Справочники, блоки с разделами',
      'SECTION_NAME' => 'Разделы',
      'ELEMENT_NAME' => 'Элементы',
    ),
  ),
));
        $iblockId = $helper->Iblock()->saveIblock(array (
  'IBLOCK_TYPE_ID' => 'edu_const',
  'LID' => 
  array (
    0 => 'ru',
  ),
  'CODE' => 'urovni-sertifikatsii',
  'API_CODE' => NULL,
  'NAME' => 'Уровни сертификации',
  'ACTIVE' => 'Y',
  'SORT' => '50',
  'LIST_PAGE_URL' => '',
  'DETAIL_PAGE_URL' => '',
  'SECTION_PAGE_URL' => '',
  'PICTURE' => NULL,
  'DESCRIPTION' => '',
  'DESCRIPTION_TYPE' => 'text',
  'RSS_TTL' => '24',
  'RSS_ACTIVE' => 'Y',
  'RSS_FILE_ACTIVE' => 'N',
  'RSS_FILE_LIMIT' => NULL,
  'RSS_FILE_DAYS' => NULL,
  'RSS_YANDEX_ACTIVE' => 'N',
  'XML_ID' => '',
  'INDEX_ELEMENT' => 'Y',
  'INDEX_SECTION' => 'Y',
  'VERSION' => '1',
  'LAST_CONV_ELEMENT' => '0',
  'EDIT_FILE_BEFORE' => '',
  'EDIT_FILE_AFTER' => '',
  'SECTIONS_NAME' => 'Разделы',
  'SECTION_NAME' => 'Раздел',
  'ELEMENTS_NAME' => 'Элементы',
  'ELEMENT_NAME' => 'Элемент',
  'WORKFLOW' => 'N',
  'SECTION_CHOOSER' => 'L',
  'BIZPROC' => 'N',
  'LIST_MODE' => '',
  'SOCNET_GROUP_ID' => NULL,
  'RIGHTS_MODE' => 'S',
  'SECTION_PROPERTY' => 'N',
  'PROPERTY_INDEX' => 'N',
  'CANONICAL_PAGE_URL' => '',
  'REST_ON' => 'N',
  'FULLTEXT_INDEX' => 'N',
  'EXTERNAL_ID' => '',
  'LANG_DIR' => '/',
  'IPROPERTY_TEMPLATES' => 
  array (
  ),
  'ELEMENT_ADD' => 'Добавить элемент',
  'ELEMENT_EDIT' => 'Изменить элемент',
  'ELEMENT_DELETE' => 'Удалить элемент',
  'SECTION_ADD' => 'Добавить раздел',
  'SECTION_EDIT' => 'Изменить раздел',
  'SECTION_DELETE' => 'Удалить раздел',
));
        $helper->Iblock()->saveIblockFields($iblockId, array (
  'IBLOCK_SECTION' => 
  array (
    'NAME' => 'Привязка к разделам',
    'IS_REQUIRED' => 'N',
    'DEFAULT_VALUE' => 
    array (
      'KEEP_IBLOCK_SECTION_ID' => 'N',
    ),
    'VISIBLE' => 'Y',
  ),
  'ACTIVE' => 
  array (
    'NAME' => 'Активность',
    'IS_REQUIRED' => 'Y',
    'DEFAULT_VALUE' => 'Y',
    'VISIBLE' => 'Y',
  ),
  'ACTIVE_FROM' => 
  array (
    'NAME' => 'Начало активности',
    'IS_REQUIRED' => 'N',
    'DEFAULT_VALUE' => '',
    'VISIBLE' => 'Y',
  ),
  'ACTIVE_TO' => 
  array (
    'NAME' => 'Окончание активности',
    'IS_REQUIRED' => 'N',
    'DEFAULT_VALUE' => '',
    'VISIBLE' => 'Y',
  ),
  'SORT' => 
  array (
    'NAME' => 'Сортировка',
    'IS_REQUIRED' => 'N',
    'DEFAULT_VALUE' => '500',
    'VISIBLE' => 'Y',
  ),
  'NAME' => 
  array (
    'NAME' => 'Название',
    'IS_REQUIRED' => 'Y',
    'DEFAULT_VALUE' => '',
    'VISIBLE' => 'Y',
  ),
  'PREVIEW_PICTURE' => 
  array (
    'NAME' => 'Картинка для анонса',
    'IS_REQUIRED' => 'N',
    'DEFAULT_VALUE' => 
    array (
      'FROM_DETAIL' => 'N',
      'UPDATE_WITH_DETAIL' => 'N',
      'DELETE_WITH_DETAIL' => 'N',
      'SCALE' => 'N',
      'WIDTH' => '',
      'HEIGHT' => '',
      'IGNORE_ERRORS' => 'N',
      'METHOD' => 'resample',
      'COMPRESSION' => 95,
      'USE_WATERMARK_TEXT' => 'N',
      'WATERMARK_TEXT' => '',
      'WATERMARK_TEXT_FONT' => '',
      'WATERMARK_TEXT_COLOR' => '',
      'WATERMARK_TEXT_SIZE' => '',
      'WATERMARK_TEXT_POSITION' => 'tl',
      'USE_WATERMARK_FILE' => 'N',
      'WATERMARK_FILE' => '',
      'WATERMARK_FILE_ALPHA' => '',
      'WATERMARK_FILE_POSITION' => 'tl',
      'WATERMARK_FILE_ORDER' => '',
    ),
    'VISIBLE' => 'Y',
  ),
  'PREVIEW_TEXT_TYPE' => 
  array (
    'NAME' => 'Тип описания для анонса',
    'IS_REQUIRED' => 'Y',
    'DEFAULT_VALUE' => 'text',
    'VISIBLE' => 'Y',
  ),
  'PREVIEW_TEXT' => 
  array (
    'NAME' => 'Описание для анонса',
    'IS_REQUIRED' => 'N',
    'DEFAULT_VALUE' => '',
    'VISIBLE' => 'Y',
  ),
  'DETAIL_PICTURE' => 
  array (
    'NAME' => 'Детальная картинка',
    'IS_REQUIRED' => 'N',
    'DEFAULT_VALUE' => 
    array (
      'SCALE' => 'N',
      'WIDTH' => '',
      'HEIGHT' => '',
      'IGNORE_ERRORS' => 'N',
      'METHOD' => 'resample',
      'COMPRESSION' => 95,
      'USE_WATERMARK_TEXT' => 'N',
      'WATERMARK_TEXT' => '',
      'WATERMARK_TEXT_FONT' => '',
      'WATERMARK_TEXT_COLOR' => '',
      'WATERMARK_TEXT_SIZE' => '',
      'WATERMARK_TEXT_POSITION' => 'tl',
      'USE_WATERMARK_FILE' => 'N',
      'WATERMARK_FILE' => '',
      'WATERMARK_FILE_ALPHA' => '',
      'WATERMARK_FILE_POSITION' => 'tl',
      'WATERMARK_FILE_ORDER' => '',
    ),
    'VISIBLE' => 'Y',
  ),
  'DETAIL_TEXT_TYPE' => 
  array (
    'NAME' => 'Тип детального описания',
    'IS_REQUIRED' => 'Y',
    'DEFAULT_VALUE' => 'text',
    'VISIBLE' => 'Y',
  ),
  'DETAIL_TEXT' => 
  array (
    'NAME' => 'Детальное описание',
    'IS_REQUIRED' => 'N',
    'DEFAULT_VALUE' => '',
    'VISIBLE' => 'Y',
  ),
  'XML_ID' => 
  array (
    'NAME' => 'Внешний код',
    'IS_REQUIRED' => 'Y',
    'DEFAULT_VALUE' => '',
    'VISIBLE' => 'Y',
  ),
  'CODE' => 
  array (
    'NAME' => 'Символьный код',
    'IS_REQUIRED' => 'N',
    'DEFAULT_VALUE' => 
    array (
      'UNIQUE' => 'Y',
      'TRANSLITERATION' => 'Y',
      'TRANS_LEN' => 100,
      'TRANS_CASE' => 'L',
      'TRANS_SPACE' => '-',
      'TRANS_OTHER' => '-',
      'TRANS_EAT' => 'Y',
      'USE_GOOGLE' => 'N',
    ),
    'VISIBLE' => 'Y',
  ),
  'TAGS' => 
  array (
    'NAME' => 'Теги',
    'IS_REQUIRED' => 'N',
    'DEFAULT_VALUE' => '',
    'VISIBLE' => 'Y',
  ),
  'SECTION_NAME' => 
  array (
    'NAME' => 'Название',
    'IS_REQUIRED' => 'Y',
    'DEFAULT_VALUE' => '',
    'VISIBLE' => 'Y',
  ),
  'SECTION_PICTURE' => 
  array (
    'NAME' => 'Картинка для анонса',
    'IS_REQUIRED' => 'N',
    'DEFAULT_VALUE' => 
    array (
      'FROM_DETAIL' => 'N',
      'UPDATE_WITH_DETAIL' => 'N',
      'DELETE_WITH_DETAIL' => 'N',
      'SCALE' => 'N',
      'WIDTH' => '',
      'HEIGHT' => '',
      'IGNORE_ERRORS' => 'N',
      'METHOD' => 'resample',
      'COMPRESSION' => 95,
      'USE_WATERMARK_TEXT' => 'N',
      'WATERMARK_TEXT' => '',
      'WATERMARK_TEXT_FONT' => '',
      'WATERMARK_TEXT_COLOR' => '',
      'WATERMARK_TEXT_SIZE' => '',
      'WATERMARK_TEXT_POSITION' => 'tl',
      'USE_WATERMARK_FILE' => 'N',
      'WATERMARK_FILE' => '',
      'WATERMARK_FILE_ALPHA' => '',
      'WATERMARK_FILE_POSITION' => 'tl',
      'WATERMARK_FILE_ORDER' => '',
    ),
    'VISIBLE' => 'Y',
  ),
  'SECTION_DESCRIPTION_TYPE' => 
  array (
    'NAME' => 'Тип описания',
    'IS_REQUIRED' => 'Y',
    'DEFAULT_VALUE' => 'text',
    'VISIBLE' => 'Y',
  ),
  'SECTION_DESCRIPTION' => 
  array (
    'NAME' => 'Описание',
    'IS_REQUIRED' => 'N',
    'DEFAULT_VALUE' => '',
    'VISIBLE' => 'Y',
  ),
  'SECTION_DETAIL_PICTURE' => 
  array (
    'NAME' => 'Детальная картинка',
    'IS_REQUIRED' => 'N',
    'DEFAULT_VALUE' => 
    array (
      'SCALE' => 'N',
      'WIDTH' => '',
      'HEIGHT' => '',
      'IGNORE_ERRORS' => 'N',
      'METHOD' => 'resample',
      'COMPRESSION' => 95,
      'USE_WATERMARK_TEXT' => 'N',
      'WATERMARK_TEXT' => '',
      'WATERMARK_TEXT_FONT' => '',
      'WATERMARK_TEXT_COLOR' => '',
      'WATERMARK_TEXT_SIZE' => '',
      'WATERMARK_TEXT_POSITION' => 'tl',
      'USE_WATERMARK_FILE' => 'N',
      'WATERMARK_FILE' => '',
      'WATERMARK_FILE_ALPHA' => '',
      'WATERMARK_FILE_POSITION' => 'tl',
      'WATERMARK_FILE_ORDER' => '',
    ),
    'VISIBLE' => 'Y',
  ),
  'SECTION_XML_ID' => 
  array (
    'NAME' => 'Внешний код',
    'IS_REQUIRED' => 'N',
    'DEFAULT_VALUE' => '',
    'VISIBLE' => 'Y',
  ),
  'SECTION_CODE' => 
  array (
    'NAME' => 'Символьный код',
    'IS_REQUIRED' => 'N',
    'DEFAULT_VALUE' => 
    array (
      'UNIQUE' => 'Y',
      'TRANSLITERATION' => 'Y',
      'TRANS_LEN' => 100,
      'TRANS_CASE' => 'L',
      'TRANS_SPACE' => '-',
      'TRANS_OTHER' => '-',
      'TRANS_EAT' => 'Y',
      'USE_GOOGLE' => 'N',
    ),
    'VISIBLE' => 'Y',
  ),
  'LOG_SECTION_ADD' => 
  array (
    'NAME' => 'LOG_SECTION_ADD',
    'IS_REQUIRED' => 'N',
    'DEFAULT_VALUE' => NULL,
    'VISIBLE' => 'Y',
  ),
  'LOG_SECTION_EDIT' => 
  array (
    'NAME' => 'LOG_SECTION_EDIT',
    'IS_REQUIRED' => 'N',
    'DEFAULT_VALUE' => NULL,
    'VISIBLE' => 'Y',
  ),
  'LOG_SECTION_DELETE' => 
  array (
    'NAME' => 'LOG_SECTION_DELETE',
    'IS_REQUIRED' => 'N',
    'DEFAULT_VALUE' => NULL,
    'VISIBLE' => 'Y',
  ),
  'LOG_ELEMENT_ADD' => 
  array (
    'NAME' => 'LOG_ELEMENT_ADD',
    'IS_REQUIRED' => 'N',
    'DEFAULT_VALUE' => NULL,
    'VISIBLE' => 'Y',
  ),
  'LOG_ELEMENT_EDIT' => 
  array (
    'NAME' => 'LOG_ELEMENT_EDIT',
    'IS_REQUIRED' => 'N',
    'DEFAULT_VALUE' => NULL,
    'VISIBLE' => 'Y',
  ),
  'LOG_ELEMENT_DELETE' => 
  array (
    'NAME' => 'LOG_ELEMENT_DELETE',
    'IS_REQUIRED' => 'N',
    'DEFAULT_VALUE' => NULL,
    'VISIBLE' => 'Y',
  ),
));
    $helper->Iblock()->saveGroupPermissions($iblockId, array (
  'administrators' => 'X',
  'everyone' => 'R',
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Тип',
  'ACTIVE' => 'Y',
  'SORT' => '5',
  'CODE' => 'TYPE',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
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
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Базовый',
      'DEF' => 'N',
      'SORT' => '10',
      'XML_ID' => 'base',
    ),
    1 => 
    array (
      'VALUE' => 'Специалист',
      'DEF' => 'N',
      'SORT' => '20',
      'XML_ID' => 'specialist',
    ),
    2 => 
    array (
      'VALUE' => 'Профессионал',
      'DEF' => 'N',
      'SORT' => '30',
      'XML_ID' => 'pro',
    ),
  ),
));
            $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Строчка над заголовком',
  'ACTIVE' => 'Y',
  'SORT' => '10',
  'CODE' => 'UP_TITLE',
  'DEFAULT_VALUE' => '',
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
  'VERSION' => '1',
  'USER_TYPE' => NULL,
  'IS_REQUIRED' => 'N',
  'USER_TYPE_SETTINGS' => 'a:0:{}',
  'HINT' => '',
));
            $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Иконка',
  'ACTIVE' => 'Y',
  'SORT' => '20',
  'CODE' => 'ICON',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'F',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => '',
  'FILE_TYPE' => 'jpg, gif, bmp, png, jpeg, webp, svg',
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
            $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Стоимость',
  'ACTIVE' => 'Y',
  'SORT' => '30',
  'CODE' => 'COST',
  'DEFAULT_VALUE' => '',
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
  'VERSION' => '1',
  'USER_TYPE' => NULL,
  'IS_REQUIRED' => 'N',
  'USER_TYPE_SETTINGS' => 'a:0:{}',
  'HINT' => '',
));
            $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Сертификат действует',
  'ACTIVE' => 'Y',
  'SORT' => '40',
  'CODE' => 'PERIOD',
  'DEFAULT_VALUE' => '',
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
  'VERSION' => '1',
  'USER_TYPE' => NULL,
  'IS_REQUIRED' => 'N',
  'USER_TYPE_SETTINGS' => 'a:0:{}',
  'HINT' => '',
));
            $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Заголовок опций',
  'ACTIVE' => 'Y',
  'SORT' => '50',
  'CODE' => 'PROPS_TITLE',
  'DEFAULT_VALUE' => '',
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
  'VERSION' => '1',
  'USER_TYPE' => NULL,
  'IS_REQUIRED' => 'N',
  'USER_TYPE_SETTINGS' => 'a:0:{}',
  'HINT' => '',
));
            $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Опции',
  'ACTIVE' => 'Y',
  'SORT' => '60',
  'CODE' => 'PROPS',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'E',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'Y',
  'XML_ID' => '',
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => 'edu_const:urovni-sertifikatsii-optsii',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'VERSION' => '1',
  'USER_TYPE' => NULL,
  'IS_REQUIRED' => 'N',
  'USER_TYPE_SETTINGS' => 'a:0:{}',
  'HINT' => '',
));
            $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Код кнопок (вставлять по одной)',
  'ACTIVE' => 'Y',
  'SORT' => '70',
  'CODE' => 'BUTTONS_CODE',
  'DEFAULT_VALUE' => 
  array (
    'TYPE' => 'TEXT',
    'TEXT' => '',
  ),
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
  'VERSION' => '1',
  'USER_TYPE' => 'HTML',
  'IS_REQUIRED' => 'N',
  'USER_TYPE_SETTINGS' => 
  array (
    'height' => 80,
  ),
  'HINT' => '',
));
            $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Шапка модалки с формой',
  'ACTIVE' => 'Y',
  'SORT' => '80',
  'CODE' => 'MODAL_FORM_CODE',
  'DEFAULT_VALUE' => 
  array (
    'TYPE' => 'HTML',
    'TEXT' => '',
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
  'VERSION' => '1',
  'USER_TYPE' => 'HTML',
  'IS_REQUIRED' => 'N',
  'USER_TYPE_SETTINGS' => 
  array (
    'height' => 200,
  ),
  'HINT' => '',
));
            $helper->UserOptions()->saveElementForm($iblockId, array (
  'Параметры|edit1' => 
  array (
    'ID' => 'ID',
    'ACTIVE' => 'Активность',
    'NAME' => 'Название',
    'CODE' => 'Символьный код',
    'XML_ID' => 'Внешний код',
    'SORT' => 'Сортировка',
    'IBLOCK_ELEMENT_PROP_VALUE' => 'Значения свойств',
    'PROPERTY_TYPE' => 'Тип',
    'PROPERTY_UP_TITLE' => 'Строчка над заголовком',
    'PROPERTY_ICON' => 'Иконка',
    'PROPERTY_COST' => 'Стоимость',
    'PROPERTY_PERIOD' => 'Сертификат действует',
    'PROPERTY_PROPS_TITLE' => 'Заголовок опций',
    'PROPERTY_PROPS' => 'Опции',
    'PROPERTY_BUTTONS_CODE' => 'Код кнопок (вставлять по одной)',
    'PROPERTY_MODAL_FORM_CODE' => 'Шапка модалки с формой',
    'PREVIEW_TEXT' => 'Описание для анонса',
  ),
  'SEO|edit14' => 
  array (
    'IPROPERTY_TEMPLATES_ELEMENT_META_TITLE' => 'Шаблон META TITLE',
    'IPROPERTY_TEMPLATES_ELEMENT_META_KEYWORDS' => 'Шаблон META KEYWORDS',
    'IPROPERTY_TEMPLATES_ELEMENT_META_DESCRIPTION' => 'Шаблон META DESCRIPTION',
    'IPROPERTY_TEMPLATES_ELEMENT_PAGE_TITLE' => 'Заголовок элемента',
    'IPROPERTY_TEMPLATES_ELEMENTS_PREVIEW_PICTURE' => 'Настройки для картинок анонса элементов',
    'IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_ALT' => 'Шаблон ALT',
    'IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_TITLE' => 'Шаблон TITLE',
    'IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_NAME' => 'Шаблон имени файла',
    'IPROPERTY_TEMPLATES_ELEMENTS_DETAIL_PICTURE' => 'Настройки для детальных картинок элементов',
    'IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_ALT' => 'Шаблон ALT',
    'IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_TITLE' => 'Шаблон TITLE',
    'IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_NAME' => 'Шаблон имени файла',
    'SEO_ADDITIONAL' => 'Дополнительно',
    'TAGS' => 'Теги',
  ),
  'Разделы|edit2' => 
  array (
    'SECTIONS' => 'Разделы',
  ),
));
        $helper->UserOptions()->saveSectionForm($iblockId, array (
  'Раздел|edit1' => 
  array (
    'ID' => 'ID',
    'ACTIVE' => 'Раздел активен',
    'SORT' => 'Сортировка',
    'NAME' => 'Название',
    'CODE' => 'Символьный код',
    'USER_FIELDS_ADD' => 'Добавить пользовательское свойство',
  ),
));
    $helper->UserOptions()->saveElementGrid($iblockId, array (
  'views' => 
  array (
    'default' => 
    array (
      'name' => NULL,
      'columns' => 
      array (
        0 => 'NAME',
        1 => 'ACTIVE',
        2 => 'SORT',
        3 => 'ID',
        4 => 'PROPERTY_COST',
      ),
      'sort_by' => NULL,
      'sort_order' => NULL,
      'page_size' => NULL,
      'saved_filter' => NULL,
      'custom_names' => 
      array (
      ),
      'columns_sizes' => 
      array (
        'expand' => 1,
        'columns' => 
        array (
        ),
      ),
      'sticked_columns' => 
      array (
      ),
      'last_sort_by' => 'sort',
      'last_sort_order' => 'asc',
    ),
  ),
  'filters' => 
  array (
  ),
  'current_view' => 'default',
));

    }

    public function down()
    {
        //your code ...
    }
}
