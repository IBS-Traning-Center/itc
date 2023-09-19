<?php

use Bitrix\Main\ModuleManager;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Application;
use Bitrix\Main\SystemException;

Loc::loadMessages(__FILE__);

class itc_catalog extends CModule
{
    public function __construct()
    {
        $arModuleVersion = [];
        include(__DIR__ . '/version.php');

        $this->MODULE_ID = 'itc.catalog';
        $this->MODULE_VERSION = $arModuleVersion['VERSION'];
        $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        $this->MODULE_NAME = Loc::getMessage('ITC_CATALOG_MODULE_NAME');
        $this->MODULE_DESCRIPTION = Loc::getMessage('ITC_CATALOG_MODULE_DESC');
        $this->PARTNER_NAME = Loc::getMessage('ITC_CATALOG_PARTNER_NAME');
        $this->PARTNER_URI = 'https://ext.team/';
    }

    public function doInstall()
    {
        try {
            ModuleManager::registerModule($this->MODULE_ID);
            $this->installDB();
        } catch (SystemException $e) {
            $GLOBALS['APPLICATION']->throwException($e->getMessage());
            return false;
        }

        return true;
    }

    public function doUninstall()
    {
        try {
            $this->uninstallDB();
            ModuleManager::unregisterModule($this->MODULE_ID);
        } catch (SystemException $e) {
            $GLOBALS['APPLICATION']->throwException($e->getMessage());
            return false;
        }

        return true;
    }

    public function installDB()
    {}

    public function uninstallDB()
    {}
}