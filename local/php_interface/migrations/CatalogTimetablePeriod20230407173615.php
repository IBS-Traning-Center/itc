<?php

namespace Sprint\Migration;


class CatalogTimetablePeriod20230407173615 extends Version
{
    protected $description = "";

    protected $moduleVersion = "4.2.4";

    /**
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function up()
    {
        $helper = $this->getHelperManager();
        $hlblockId = $helper->Hlblock()->saveHlblock(array (
  'NAME' => 'ItcCatalogTimetablePeriod',
  'TABLE_NAME' => 'itc_catalog_timetable_period',
  'LANG' => 
  array (
    'ru' => 
    array (
      'NAME' => 'ITC Расписание: Период',
    ),
    'en' => 
    array (
      'NAME' => 'ITC Course: Period',
    ),
  ),
));
        $helper->Hlblock()->saveField($hlblockId, array (
  'FIELD_NAME' => 'UF_NAME',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => 'NAME',
  'SORT' => '100',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'Y',
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
    'en' => 'Name',
    'ru' => 'Название',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Name',
    'ru' => 'Название',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Name',
    'ru' => 'Название',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => 'Name',
    'ru' => 'Название',
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => 'Name',
    'ru' => 'Название',
  ),
));
            $helper->Hlblock()->saveField($hlblockId, array (
  'FIELD_NAME' => 'UF_XML_ID',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => 'XML_ID',
  'SORT' => '100',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'Y',
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
    'en' => 'Code',
    'ru' => 'Код',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Code',
    'ru' => 'Код',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Code',
    'ru' => 'Код',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => 'Code',
    'ru' => 'Код',
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => 'Code',
    'ru' => 'Код',
  ),
));
            $helper->Hlblock()->saveField($hlblockId, array (
  'FIELD_NAME' => 'UF_SORT',
  'USER_TYPE_ID' => 'integer',
  'XML_ID' => 'SORT',
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
    'MIN_VALUE' => 0,
    'MAX_VALUE' => 0,
    'DEFAULT_VALUE' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'Sort',
    'ru' => 'Сортировка',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Sort',
    'ru' => 'Сортировка',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Sort',
    'ru' => 'Сортировка',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => 'Sort',
    'ru' => 'Сортировка',
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => 'Sort',
    'ru' => 'Сортировка',
  ),
));
            $helper->Hlblock()->saveField($hlblockId, array (
  'FIELD_NAME' => 'UF_DEF',
  'USER_TYPE_ID' => 'boolean',
  'XML_ID' => 'DEF',
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
    'en' => 'Default',
    'ru' => 'По умолчанию',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Default',
    'ru' => 'По умолчанию',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Default',
    'ru' => 'По умолчанию',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => 'Default',
    'ru' => 'По умолчанию',
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => 'Default',
    'ru' => 'По умолчанию',
  ),
));
            $helper->Hlblock()->saveField($hlblockId, array (
  'FIELD_NAME' => 'UF_DATE_BEGIN',
  'USER_TYPE_ID' => 'date',
  'XML_ID' => 'DATE_BEGIN',
  'SORT' => '100',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'DEFAULT_VALUE' => 
    array (
      'TYPE' => 'NONE',
      'VALUE' => '',
    ),
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'Date Begin',
    'ru' => 'Дата начала',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Date Begin',
    'ru' => 'Дата начала',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Date Begin',
    'ru' => 'Дата начала',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => 'Date Begin',
    'ru' => 'Дата начала',
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => 'Date Begin',
    'ru' => 'Дата начала',
  ),
));
            $helper->Hlblock()->saveField($hlblockId, array (
  'FIELD_NAME' => 'UF_DATE_END',
  'USER_TYPE_ID' => 'date',
  'XML_ID' => 'DATE_END',
  'SORT' => '100',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'DEFAULT_VALUE' => 
    array (
      'TYPE' => 'NONE',
      'VALUE' => '',
    ),
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'Date End',
    'ru' => 'Дата окончания',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Date End',
    'ru' => 'Дата окончания',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Date End',
    'ru' => 'Дата окончания',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => 'Date End',
    'ru' => 'Дата окончания',
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => 'Date End',
    'ru' => 'Дата окончания',
  ),
));
            $helper->Hlblock()->saveField($hlblockId, array (
  'FIELD_NAME' => 'UF_DESCRIPTION',
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
    'DEFAULT_VALUE' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Описание',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'Описание',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'Описание',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
            $helper->Hlblock()->saveField($hlblockId, array (
  'FIELD_NAME' => 'UF_FULL_DESCRIPTION',
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
    'DEFAULT_VALUE' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Полное описание',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'Полное описание',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'Полное описание',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
        }

    public function down()
    {
        //your code ...
    }
}
