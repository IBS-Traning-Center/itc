<?php

namespace Sprint\Migration;


class Version20240815081139 extends Version
{
    protected $description = "112820 | Главная Страница / Разделы ИБ Страницы";

    protected $moduleVersion = "4.6.1";

    /**
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function up()
    {
        $helper = $this->getHelperManager();

        $iblockId = $helper->Iblock()->getIblockIdIfExists(
            'ru_pages',
            'edu_const'
        );

        $helper->Iblock()->addSectionsFromTree(
            $iblockId,
            array (
  0 => 
  array (
    'NAME' => 'Главная',
    'CODE' => 'ru_home',
    'SORT' => '500',
    'ACTIVE' => 'Y',
    'XML_ID' => '',
    'DESCRIPTION' => '',
    'DESCRIPTION_TYPE' => 'text',
    'CHILDS' => 
    array (
      0 => 
      array (
        'NAME' => ' Группы курсов',
        'CODE' => 'ru_home_groups-courses',
        'SORT' => '500',
        'ACTIVE' => 'Y',
        'XML_ID' => '',
        'DESCRIPTION' => '',
        'DESCRIPTION_TYPE' => 'text',
      ),
      1 => 
      array (
        'NAME' => ' Новые курсы',
        'CODE' => 'ru_home_teaser-cards',
        'SORT' => '500',
        'ACTIVE' => 'Y',
        'XML_ID' => '',
        'DESCRIPTION' => '',
        'DESCRIPTION_TYPE' => 'text',
      ),
      2 => 
      array (
        'NAME' => 'Сертификаты',
        'CODE' => 'ru_home_certificates',
        'SORT' => '500',
        'ACTIVE' => 'Y',
        'XML_ID' => '',
        'DESCRIPTION' => '',
        'DESCRIPTION_TYPE' => 'text',
      ),
      3 => 
      array (
        'NAME' => 'Направления обучения',
        'CODE' => 'ru_home_categories-course',
        'SORT' => '500',
        'ACTIVE' => 'Y',
        'XML_ID' => '',
        'DESCRIPTION' => '',
        'DESCRIPTION_TYPE' => 'text',
      ),
      4 => 
      array (
        'NAME' => 'Слайдер',
        'CODE' => 'ru_home_slider',
        'SORT' => '500',
        'ACTIVE' => 'Y',
        'XML_ID' => '',
        'DESCRIPTION' => '',
        'DESCRIPTION_TYPE' => 'text',
      ),
      5 => 
      array (
        'NAME' => 'Сотрудники - крутые',
        'CODE' => 'sotrydniki_krytie',
        'SORT' => '500',
        'ACTIVE' => 'Y',
        'XML_ID' => '',
        'DESCRIPTION' => '',
        'DESCRIPTION_TYPE' => 'text',
      ),
    ),
  ),
)        );
    }

    public function down()
    {
        //your code ...
    }
}
