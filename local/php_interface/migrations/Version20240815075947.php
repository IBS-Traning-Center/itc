<?php

namespace Sprint\Migration;


class Version20240815075947 extends Version
{
    protected $description = "112820 | Главная Страница / Пользовательские поля для каталогов";

    protected $moduleVersion = "4.6.1";

    /**
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function up()
    {
        $helper = $this->getHelperManager();
        $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'IBLOCK_edu_const:new_programms_SECTION',
  'FIELD_NAME' => 'UF_SHOW_ON_MAIN_PAGE',
  'USER_TYPE_ID' => 'boolean',
  'XML_ID' => '',
  'SORT' => '100',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'DEFAULT_VALUE' => 0,
    'DISPLAY' => 'CHECKBOX',
    'LABEL' => 
    array (
      0 => '',
      1 => '',
    ),
    'LABEL_CHECKBOX' => '',
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Показывать раздел на главной странице',
    'ua' => '',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'Показывать раздел на главной странице',
    'ua' => '',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'Показывать раздел на главной странице',
    'ua' => '',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => '',
    'ua' => '',
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => '',
    'ua' => '',
  ),
));
        $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'IBLOCK_edu_const:new_programms_SECTION',
  'FIELD_NAME' => 'UF_MAIN_PAGE_IMAGE',
  'USER_TYPE_ID' => 'file',
  'XML_ID' => '',
  'SORT' => '100',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'LIST_WIDTH' => 0,
    'LIST_HEIGHT' => 0,
    'MAX_SHOW_SIZE' => 0,
    'MAX_ALLOWED_SIZE' => 0,
    'EXTENSIONS' => 
    array (
    ),
    'TARGET_BLANK' => 'N',
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Фон для главной страницы',
    'ua' => '',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'Фон для главной страницы',
    'ua' => '',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'Фон для главной страницы',
    'ua' => '',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => '',
    'ua' => '',
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => '',
    'ua' => '',
  ),
));
        $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'IBLOCK_edu_const:courseDirections_SECTION',
  'FIELD_NAME' => 'UF_SHOW_ON_MAIN_PAGE',
  'USER_TYPE_ID' => 'boolean',
  'XML_ID' => '',
  'SORT' => '100',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'DEFAULT_VALUE' => 0,
    'DISPLAY' => 'CHECKBOX',
    'LABEL' => 
    array (
      0 => '',
      1 => '',
    ),
    'LABEL_CHECKBOX' => '',
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Показывать раздел на главной странице',
    'ua' => '',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'Показывать раздел на главной странице',
    'ua' => '',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'Показывать раздел на главной странице',
    'ua' => '',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => '',
    'ua' => '',
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => '',
    'ua' => '',
  ),
));
        $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'IBLOCK_edu_const:courseDirections_SECTION',
  'FIELD_NAME' => 'UF_MAIN_PAGE_IMAGE',
  'USER_TYPE_ID' => 'file',
  'XML_ID' => '',
  'SORT' => '100',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'LIST_WIDTH' => 0,
    'LIST_HEIGHT' => 0,
    'MAX_SHOW_SIZE' => 0,
    'MAX_ALLOWED_SIZE' => 0,
    'EXTENSIONS' => 
    array (
    ),
    'TARGET_BLANK' => 'N',
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Фон для главной страницы',
    'ua' => '',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'Фон для главной страницы',
    'ua' => '',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'Фон для главной страницы',
    'ua' => '',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => '',
    'ua' => '',
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => '',
    'ua' => '',
  ),
));
    }

    public function down()
    {
        //your code ...
    }
}
