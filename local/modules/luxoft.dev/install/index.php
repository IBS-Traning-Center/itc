<?php

use Bitrix\Main\Loader,
    Bitrix\Main\Application,
    Bitrix\Main\EventManager;

$PathInstall = str_replace("\\", "/", __FILE__);
$PathInstall = substr($PathInstall, 0, strlen($PathInstall) - strlen("/index.php"));
IncludeModuleLangFile($PathInstall . "/index.php");

class luxoft_dev extends CModule
{
    var $MODULE_ID = "luxoft.dev";
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;
    var $MODULE_CSS;

    var $errors;

    function __construct()
    {
        $arModuleVersion = array();

        $path = str_replace("\\", "/", __FILE__);
        $path = substr($path, 0, strlen($path) - strlen("/index.php"));

        if (is_array($arModuleVersion) && array_key_exists("VERSION", $arModuleVersion)) {
            $this->MODULE_VERSION = $arModuleVersion["VERSION"];
            $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        } else {
            $this->MODULE_VERSION = IBLOCK_VERSION;
            $this->MODULE_VERSION_DATE = IBLOCK_VERSION_DATE;
        }

        $this->MODULE_VERSION = '1.0.0';
        $this->MODULE_VERSION_DATE = '02.07.2021';
        $this->MODULE_NAME = "Luxoft";
        $this->MODULE_DESCRIPTION = "";
        $this->PARTNER_NAME = "Ext.team";
        $this->PARTNER_URI = "https://ext.team/";
    }

    function getRoot()
    {
        $local = $_SERVER['DOCUMENT_ROOT'] . '/local';
        if (1 === preg_match('#local[\\\/]modules#', __DIR__) && is_dir($local)) {
            return $local;
        }

        return $_SERVER['DOCUMENT_ROOT'] . BX_ROOT;
    }

    /**
     * Установка БД
     */
    function InstallDB()
    {
        RegisterModule($this->MODULE_ID);
        Loader::includeModule($this->MODULE_ID);
        $connection = Application::getConnection();
    }

    /**
     * Удаление БД
     */
    function UnInstallDB($arParams = array())
    {
        Loader::includeModule($this->MODULE_ID);
        $connection = Application::getConnection();

        UnRegisterModule($this->MODULE_ID);
        return true;
    }

    /**
     * Установка обработчиков событий
     */
    function InstallEvents()
    {
        $eventManager = EventManager::getInstance();
        return true;
    }

    /**
     * Удаление обработчиков событий
     */
    function UnInstallEvents()
    {
        $eventManager = EventManager::getInstance();
        return true;
    }

    /**
     * Установка файлов
     */
    function InstallFiles()
    {
        CopyDirFiles(dirname(__DIR__) . "/install/admin",
            $_SERVER["DOCUMENT_ROOT"] . "/bitrix/admin",
            true
        );
        CopyDirFiles(__DIR__ . '/components', $this->getRoot() . "/components", true, true);
    }

    /**
     * Удаление файлов
     */
    function UnInstallFiles()
    {
        DeleteDirFiles(dirname(__DIR__) . "/install/admin",
            $_SERVER["DOCUMENT_ROOT"] . "/bitrix/admin");
        DeleteDirFilesEx(BX_ROOT . '/components/luxoft');
        DeleteDirFilesEx('/local/components/luxoft');
    }

    /**
     * Установка агентов
     */
    function InstallAgents()
    {

        return true;
    }

    /**
     * Удаление агентов
     */
    function UnInstallAgents()
    {
        \CAgent::RemoveModuleAgents($this->MODULE_ID);
    }

    /**
     * Установка модуля
     */
    function DoInstall()
    {
        if (!IsModuleInstalled($this->MODULE_ID)) {
            $this->InstallFiles();
            $this->InstallDB();
            //$this->InstallEvents();
            //$this->InstallAgents();
        }
    }

    /**
     * Удаление модуля
     */
    function DoUninstall()
    {
        $this->UnInstallFiles();
        $this->UnInstallDB();
        //$this->UnInstallEvents();
        //$this->UnInstallAgents();
    }
}