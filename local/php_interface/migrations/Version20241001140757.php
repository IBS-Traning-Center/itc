<?php

namespace Sprint\Migration;


class Version20241001140757 extends Version
{
    protected $description = "115008 | Комплексные программы / Не работает форма записи на курс + замечания по форме / изменил описание формы";

    protected $moduleVersion = "4.6.1";

    /**
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function up()
    {
        $helper = $this->getHelperManager();
        $formHelper = $helper->Form();
        $formId = $formHelper->saveForm(array (
  'NAME' => 'Записаться на курс (комплексные программы)',
  'SID' => 'sign_course_complex',
  'BUTTON' => 'Сохранить',
  'C_SORT' => '3200',
  'FIRST_SITE_ID' => NULL,
  'IMAGE_ID' => NULL,
  'USE_CAPTCHA' => 'N',
  'DESCRIPTION' => 'Продолжая, я подтверждаю, что ознакомлен с <a href="/terms-of-use/">Условиями использования</a> и <a href="/privacy-policy/">Порядком обработки персональных данных</a>',
  'DESCRIPTION_TYPE' => 'html',
  'FORM_TEMPLATE' => '',
  'USE_DEFAULT_TEMPLATE' => 'Y',
  'SHOW_TEMPLATE' => NULL,
  'MAIL_EVENT_TYPE' => 'FORM_FILLING_sign_course_complex',
  'SHOW_RESULT_TEMPLATE' => NULL,
  'PRINT_RESULT_TEMPLATE' => NULL,
  'EDIT_RESULT_TEMPLATE' => NULL,
  'FILTER_RESULT_TEMPLATE' => '',
  'TABLE_RESULT_TEMPLATE' => '',
  'USE_RESTRICTIONS' => 'N',
  'RESTRICT_USER' => '0',
  'RESTRICT_TIME' => '0',
  'RESTRICT_STATUS' => '',
  'STAT_EVENT1' => 'form',
  'STAT_EVENT2' => 'sign_course_complex',
  'STAT_EVENT3' => '',
  'LID' => NULL,
  'C_FIELDS' => '0',
  'QUESTIONS' => '10',
  'STATUSES' => '1',
  'arSITE' => 
  array (
    0 => 'ru',
  ),
  'arMENU' => 
  array (
    'ru' => 'Отправить',
    'ua' => '',
  ),
  'arGROUP' => 
  array (
  ),
  'arMAIL_TEMPLATE' => 
  array (
  ),
));
    }

    public function down()
    {
        //your code ...
    }
}

