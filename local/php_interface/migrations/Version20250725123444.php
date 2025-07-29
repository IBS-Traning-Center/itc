<?php

namespace Sprint\Migration;


class Version20250725123444 extends Version
{
    protected $description = "128161 | Создать блок акции для страницы Сертификации | добавлен раздел Сертификация для ИБ Акции и скидки";

    protected $moduleVersion = "4.6.1";

    /**
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function up()
    {
        $helper = $this->getHelperManager();

        $iblockId = $helper->Iblock()->getIblockIdIfExists(
            'promo',
            'edu_const'
        );

        $helper->Iblock()->addSectionsFromTree(
            $iblockId,
            array (
  0 => 
  array (
    'NAME' => 'Java-разработчик',
    'CODE' => 'java-razrabotchik',
    'SORT' => '500',
    'ACTIVE' => 'Y',
    'XML_ID' => '1660',
    'DESCRIPTION' => NULL,
    'DESCRIPTION_TYPE' => 'text',
  ),
  1 => 
  array (
    'NAME' => 'Бизнес-аналитик',
    'CODE' => 'biznes-analitik',
    'SORT' => '500',
    'ACTIVE' => 'Y',
    'XML_ID' => '1658',
    'DESCRIPTION' => NULL,
    'DESCRIPTION_TYPE' => 'text',
  ),
  2 => 
  array (
    'NAME' => 'Системный аналитик',
    'CODE' => 'sistemnyy-analitik',
    'SORT' => '500',
    'ACTIVE' => 'Y',
    'XML_ID' => '1659',
    'DESCRIPTION' => NULL,
    'DESCRIPTION_TYPE' => 'text',
  ),
  3 => 
  array (
    'NAME' => 'Сертификация',
    'CODE' => 'sertifikatsiya',
    'SORT' => '500',
    'ACTIVE' => 'Y',
    'XML_ID' => '1660',
    'DESCRIPTION' => '',
    'DESCRIPTION_TYPE' => 'text',
  ),
)        );
    }

    public function down()
    {
        //your code ...
    }
}
