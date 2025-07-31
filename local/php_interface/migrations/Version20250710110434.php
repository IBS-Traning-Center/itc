<?php

namespace Sprint\Migration;


class Version20250710110434 extends Version
{
    protected $description = "126973 | Доработка форм / Почтовые шаблоны формы Получить консультацию сертификатов";

    protected $moduleVersion = "4.6.1";

    /**
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function up()
    {
        $helper = $this->getHelperManager();
        $helper->Event()->saveEventType('FORM_FILLING_get_consultation', array (
  'LID' => 'ua',
  'EVENT_TYPE' => 'email',
  'NAME' => 'Заповнена web-форма "get_consultation"',
  'DESCRIPTION' => '#RS_FORM_ID# - ID форми
#RS_FORM_NAME# - Ім\'я форми
#RS_FORM_SID# - SID форми
#RS_RESULT_ID# - ID результата
#RS_DATE_CREATE# - Дата заповнення форми
#RS_USER_ID# - ID користувача
#RS_USER_EMAIL# - E-mail користувача
#RS_USER_NAME# - Прізвище, ім\'я користувача
#RS_USER_AUTH# - Користувач був авторизований?
#RS_STAT_GUEST_ID# - ID відвідувача
#RS_STAT_SESSION_ID# - ID сесії
#cert_direction# - Направление сертификации
#cert_direction_RAW# - Направление сертификации (оригінальне значення)
#name# - Имя
#name_RAW# - Имя (оригінальне значення)
#email# - Email
#email_RAW# - Email (оригінальне значення)
#phone# - Телефон
#phone_RAW# - Телефон (оригінальне значення)
#company# - Компания
#company_RAW# - Компания (оригінальне значення)
#question# - Ваш вопрос или комментарий
#question_RAW# - Ваш вопрос или комментарий (оригінальне значення)
#job# - Должность
#job_RAW# - Должность (оригінальне значення)
#client_id# - Client ID(Yandex)
#client_id_RAW# - Client ID(Yandex) (оригінальне значення)
#privacy_policy# - Ознакомлен с политикой обработки персональных данных
#privacy_policy_RAW# - Ознакомлен с политикой обработки персональных данных (оригінальне значення)
#agree_of_subject# - Cоглашаюсь с условиями обработки персональных данных
#agree_of_subject_RAW# - Cоглашаюсь с условиями обработки персональных данных (оригінальне значення)
',
  'SORT' => '100',
));
            $helper->Event()->saveEventType('FORM_FILLING_get_consultation', array (
  'LID' => 'ru',
  'EVENT_TYPE' => 'email',
  'NAME' => 'Заполнена web-форма "get_consultation"',
  'DESCRIPTION' => '#RS_FORM_ID# - ID формы
#RS_FORM_NAME# - Имя формы
#RS_FORM_SID# - SID формы
#RS_RESULT_ID# - ID результата
#RS_DATE_CREATE# - Дата заполнения формы
#RS_USER_ID# - ID пользователя
#RS_USER_EMAIL# - EMail пользователя
#RS_USER_NAME# - Фамилия, имя пользователя
#RS_USER_AUTH# - Пользователь был авторизован?
#RS_STAT_GUEST_ID# - ID посетителя
#RS_STAT_SESSION_ID# - ID сессии
#cert_direction# - Направление сертификации
#cert_direction_RAW# - Направление сертификации (оригинальное значение)
#name# - Имя
#name_RAW# - Имя (оригинальное значение)
#email# - Email
#email_RAW# - Email (оригинальное значение)
#phone# - Телефон
#phone_RAW# - Телефон (оригинальное значение)
#company# - Компания
#company_RAW# - Компания (оригинальное значение)
#question# - Ваш вопрос или комментарий
#question_RAW# - Ваш вопрос или комментарий (оригинальное значение)
#job# - Должность
#job_RAW# - Должность (оригинальное значение)
#client_id# - Client ID(Yandex)
#client_id_RAW# - Client ID(Yandex) (оригинальное значение)
#privacy_policy# - Ознакомлен с политикой обработки персональных данных
#privacy_policy_RAW# - Ознакомлен с политикой обработки персональных данных (оригинальное значение)
#agree_of_subject# - Cоглашаюсь с условиями обработки персональных данных
#agree_of_subject_RAW# - Cоглашаюсь с условиями обработки персональных данных (оригинальное значение)
',
  'SORT' => '100',
));
            $helper->Event()->saveEventMessage('FORM_FILLING_get_consultation', array (
  'LID' => 
  array (
    0 => 'ru',
  ),
  'ACTIVE' => 'Y',
  'EMAIL_FROM' => '#DEFAULT_EMAIL_FROM#',
  'EMAIL_TO' => 'education@ibs.ru',
  'SUBJECT' => 'P#RS_RESULT_ID# Заявка на получение консультации сертификации',
  'MESSAGE' => '<div style="font-family:Arial,Helvetica,sans-serif;font-size:13px;">
	<p>
 <b>Заявка на получение консультации сертификации</b>
	</p>
<p>
 <b>Направление сертификации:</b>#cert_direction#
	</p>
	<p>
 <b>Имя:</b> #name#
	</p>
	<p>
 <b>E-mail:</b>&nbsp;#email#
	</p>
	<p>
 <b>Телефон:</b> #phone#
	</p>
	<p>
 <b>Компания:</b> #company#
	</p>
	<p>
 <b>Вопрос:</b>&nbsp;#question#
	</p>
	<p>
		 ---------------------------------------- Письмо создано автоматически
	</p>
	<p>
		 Все вопросы и пожелания :&nbsp;<a href="mailto:education@ibs.ru" target="_blank">education@ibs.ru</a>
	</p>
</div>
 <br>',
  'BODY_TYPE' => 'html',
  'BCC' => '',
  'REPLY_TO' => '',
  'CC' => '',
  'IN_REPLY_TO' => '',
  'PRIORITY' => '',
  'FIELD1_NAME' => '',
  'FIELD1_VALUE' => '',
  'FIELD2_NAME' => '',
  'FIELD2_VALUE' => '',
  'SITE_TEMPLATE_ID' => '',
  'ADDITIONAL_FIELD' => 
  array (
  ),
  'LANGUAGE_ID' => '',
  'EVENT_TYPE' => '[ FORM_FILLING_get_consultation ] Заполнена web-форма "get_consultation"',
));
            $helper->Event()->saveEventMessage('FORM_FILLING_get_consultation', array (
  'LID' => 
  array (
    0 => 'ru',
  ),
  'ACTIVE' => 'Y',
  'EMAIL_FROM' => '#DEFAULT_EMAIL_FROM#',
  'EMAIL_TO' => '#email#',
  'SUBJECT' => 'P#RS_RESULT_ID# Заявка на получение консультации сертификации',
  'MESSAGE' => '<div style="font-family:Arial,Helvetica,sans-serif;font-size:13px;">
	<p>
		 Здравствуйте, #name#!
	</p>
	<p>
		 Спасибо за заявку на получение консультации сертификации
	</p>
	<p>
	Наши специалисты в скором времени Вам ответят
	</p>
	<p>
		 С уважением,<br>
		 IBS Training Center<br>
 <a href="https://ibs-training.ru/">ibs-training.ru</a><br>
		 email: <a href="mailto:education@ibs.ru">education@ibs.ru</a><br>
		 телефоны: <a href="tel:84956096967">+7 (495) 609-69-67</a>, <a href="tel:89310096926">+7 (931) 009-69-26</a>
	</p>
	<p>
		 ------------------------------------------------------- Данное письмо сгенерировано автоматически. Если оно к Вам попало по ошибке, пожалуйста, просто проигнорируйте его.
	</p>
</div>
 <br>',
  'BODY_TYPE' => 'html',
  'BCC' => '#DEFAULT_EMAIL_FROM#',
  'REPLY_TO' => '',
  'CC' => '',
  'IN_REPLY_TO' => '',
  'PRIORITY' => '',
  'FIELD1_NAME' => '',
  'FIELD1_VALUE' => '',
  'FIELD2_NAME' => '',
  'FIELD2_VALUE' => '',
  'SITE_TEMPLATE_ID' => '',
  'ADDITIONAL_FIELD' => 
  array (
  ),
  'LANGUAGE_ID' => 'ru',
  'EVENT_TYPE' => '[ FORM_FILLING_get_consultation ] Заполнена web-форма "get_consultation"',
));
        }

    public function down()
    {
        //your code ...
    }
}
