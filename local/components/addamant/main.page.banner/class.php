<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @global CMain $APPLICATION
 */

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\SystemException;
use CBitrixComponent;
use \Bitrix\Iblock\SectionTable;
use \Bitrix\Iblock\Model\Section;

Loc::loadMessages(__FILE__);

class MainPageBannerComponent extends CBitrixComponent
{

    /* Массив результата запроса в ИБ */
    private $bannerIBResult;
    private $iblocksIds;

    /* Проверка подключения компонента */
    /**
     * @throws \Bitrix\Main\LoaderException
     * @throws SystemException
     */
    private function checkModules()
    {

        if (!Loader::includeModule('iblock')) {
            throw new SystemException(
                Loc::getMessage('IBLOCK_IS_NOT_INITIALIZED')
            );
        }

        return true;
    }

    /* проверяем и получаем ids инфоблоков */
    private function getIblocksIds()
    {
        if ($this->arParams['IBLOCKS_IDS_TITLE_MAIN_PAGE_BANNER']) {
            $ids = explode(',', $this->arParams['IBLOCKS_IDS_TITLE_MAIN_PAGE_BANNER']);

            foreach ($ids as $id) {
                $this->iblocksIds[] = trim($id);
            }
        }

        $this->arResult['CATALOG_LINK'] = ($this->arParams['CATALOG_LINK_TITLE_MAIN_PAGE_BANNER']) ?: '/training/katalog_kursov/';
    }

    /* Получаем элементы из раздела инфоблока */
    public function getCatalogIblockSections()
    {
        if (empty($this->iblocksIds)) {
            return false;
        }

        return $this->bannerIBResult = SectionTable::getList([
            'filter' => [
                'IBLOCK_ID' => $this->iblocksIds,
                'ACTIVE' => 'Y',
                'GLOBAL_ACTIVE' => 'Y'
            ],
            'select' => [
                'ID',
                'NAME',
                'SORT',
                'CODE',
                'IBLOCK_ID',
                'IBLOCK_SECTION_PAGE_URL' => 'IBLOCK.SECTION_PAGE_URL',
            ]
        ])->fetchAll();
    }

    /* Удаляем лишние разделы у которых свойство UF_SHOW_ON_MAIN_PAGE = нет */
    public function deleteUnnecessaryResults()
    {
        if (empty($this->iblocksIds) || empty($this->bannerIBResult)) {
            return false;
        }

        foreach ($this->iblocksIds as $id) {
            $entity = Section::compileEntityByIblock($id);

            foreach ($this->bannerIBResult as $key => $item) {
                if ($item['IBLOCK_ID'] == $id) {
                    $section = $entity::getList([
                        'filter' => [
                            'IBLOCK_ID' => $id,
                            'ID' => $item['ID'],
                            'ACTIVE' => 'Y',
                            'GLOBAL_ACTIVE' => 'Y'
                        ],
                        'select' => [
                            'UF_SHOW_ON_MAIN_PAGE',
                            'UF_MAIN_PAGE_IMAGE'
                        ]
                    ])->fetch();

                    $this->bannerIBResult[$key]['IMAGE'] = $section['UF_MAIN_PAGE_IMAGE'];

                    if (!$section['UF_SHOW_ON_MAIN_PAGE']) {
                        unset($this->bannerIBResult[$key]);
                    }
                }
            }
        }
    }

    /* Записываем результат в переменную */
    public function makeItemsResult()
    {
        $this->arResult['ITEMS'] = $this->bannerIBResult;
    }

    public function executeComponent(): void
    {
        $this->checkModules();

        $this->getIblocksIds();
        $this->getCatalogIblockSections();
        $this->deleteUnnecessaryResults();
        $this->makeItemsResult();

        $this->includeComponentTemplate();
    }
}
