<?php

namespace Sprint\Migration;


class Version20260123121218 extends Version
{
    protected $description = "136270 | Стать тренером / Вывести иконки из каталога | поле для отображения разделов на странице тренера ";

    protected $moduleVersion = "4.6.1";

    /**
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function up()
    {
        $helper = $this->getHelperManager();
        $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'IBLOCK_edu_const:courseDirections_SECTION',
  'FIELD_NAME' => 'UF_SHOW_ON_TRENER',
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
    'ru' => 'Показывать раздел на странице стать тренером',
    'ua' => '',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'Показывать раздел на странице стать тренером',
    'ua' => '',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'Показывать раздел на странице стать тренером',
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
