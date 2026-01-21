<?php

namespace Sprint\Migration;


class Version20251222225104 extends Version
{
    protected $description = "135557 | Личный кабинет / Верстка функционала привязки профиля hh.ru и функционала его отвязки. поле для телеграмм";

    protected $moduleVersion = "4.6.1";

    /**
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function up()
    {
        $helper = $this->getHelperManager();
        $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'USER',
  'FIELD_NAME' => 'UF_TELEGRAM',
  'USER_TYPE_ID' => 'string',
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
    'ROWS' => 1,
    'REGEXP' => '',
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => '',
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Телеграм',
    'ua' => '',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => '',
    'ua' => '',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => '',
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
