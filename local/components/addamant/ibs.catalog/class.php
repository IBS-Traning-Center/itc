<?php

namespace Local\Components;

use Bitrix\Iblock\Component\Tools;
use Bitrix\Main\Application;
use Bitrix\Main\Diag\Debug;
use Bitrix\Main\Loader;
use Bitrix\Main\LoaderException;
use CBitrixComponent;
use CComponentEngine;

class CatalogComponent extends CBitrixComponent
{
    public const URL_TEMPLATE_LIST_DEFAULT = '';
    public const URL_TEMPLATE_SECTION_DEFAULT = '#SECTION_CODE#/';
    private const LIST_COMPONENT_PAGE = 'list';
    private const SECTION_COMPONENT_PAGE = 'section';

    /**
     * @var string[] $componentVariables
     */
    private array $componentVariables =
        [
            'SECTION_CODE',
        ];

    /**
     * @param CBitrixComponent|null $component
     *
     * @throws LoaderException
     */
    public function __construct(CBitrixComponent $component = null)
    {
        if (!Loader::includeModule('iblock')) {
            throw new ModuleNotIncludeException('iblock');
        }

        parent::__construct($component);
    }

    /**
     * @param $arParams
     *
     * @return array
     */
    public function onPrepareComponentParams($arParams): array
    {
        /* ------------------------------------------------ 404 ----------------------------------------------------- */
        $arParams['MESSAGE_404'] = trim($arParams['MESSAGE_404'] ?? 'Страница не найдена');
        $arParams['SET_STATUS_404'] = $arParams['SET_STATUS_404'] === 'Y';
        $arParams['SHOW_404'] = $arParams['SHOW_404'] === 'Y';
        $arParams['SECTION_IBLOCK_ID'] = $arParams['SECTION_IBLOCK_ID'] ?? '';

        return $arParams;
    }

    /**
     * @return void
     */
    public function executeComponent(): void
    {
        $componentPage = match ($this->arParams['SEF_MODE'] === 'Y') {
            true => $this->getComponentPageSefMode(),
            false => $this->getComponentPageNoSefMode()
        };

        if (empty($componentPage)) {
            Tools::process404(
                $this->arParams['MESSAGE_404'],
                true,
                $this->arParams['SET_STATUS_404'] === 'Y',
                $this->arParams['SHOW_404'] === 'Y',
                $this->arParams['FILE_404']
            );
            return;
        }

        $this->includeComponentTemplate($componentPage);
    }

    /**
     * @return string
     */
    private function getComponentPageSefMode(): string
    {
        $defaultVariableAliases404 = [];
        $variables = [];
        $defaultUrlTemplates404 =
            [
                'list' => self::URL_TEMPLATE_LIST_DEFAULT,
                'section' => self::URL_TEMPLATE_SECTION_DEFAULT,
            ];

        $engine = new CComponentEngine($this);
        $urlTemplates = CComponentEngine::makeComponentUrlTemplates(
            $defaultUrlTemplates404,
            $this->arParams['SEF_URL_TEMPLATES']
        );

        $variableAliases = CComponentEngine::makeComponentVariableAliases(
            $defaultVariableAliases404,
            $this->arParams['VARIABLE_ALIASES']
        );

        $componentPage = $engine->guessComponentPath(
            $this->arParams['SEF_FOLDER'],
            $urlTemplates,
            $variables
        );

        if (!$componentPage) {
            $componentPage = self::LIST_COMPONENT_PAGE;
        }

        CComponentEngine::initComponentVariables(
            $componentPage,
            $this->componentVariables,
            $variableAliases,
            $variables
        );

        $this->arResult =
            [
                'FOLDER' => $this->arParams['SEF_FOLDER'],
                'URL_TEMPLATES' => $urlTemplates,
                'VARIABLES' => $variables,
                'ALIASES' => $variableAliases,
            ];

        return $componentPage;
    }

    /**
     * @return string
     */
    private function getComponentPageNoSefMode(): string
    {
        $defaultVariableAliases = [];
        $variables = [];

        $variableAliases = CComponentEngine::makeComponentVariableAliases(
            $defaultVariableAliases,
            $this->arParams['VARIABLE_ALIASES']
        );

        CComponentEngine::initComponentVariables(
            false,
            $this->componentVariables,
            $variableAliases,
            $variables
        );

        $context = Application::getInstance()->getContext();
        $request = $context->getRequest();

        $currentPage = $request->getRequestedPageDirectory();
        $escapedCurrentPage = htmlspecialcharsbx($currentPage);

        $componentPage = match (true) {
            !empty($variables['SECTION_CODE']) => self::SECTION_COMPONENT_PAGE,
            default => self::LIST_COMPONENT_PAGE,
        };

        $this->arResult =
            [
                'FOLDER' => '',
                'URL_TEMPLATES' =>
                    [
                        'list' => $escapedCurrentPage,
                        'section' => $escapedCurrentPage . '#SECTION_CODE#/',
                    ],
                'VARIABLES' => $variables,
                'ALIASES' => $variableAliases,
            ];

        return $componentPage;
    }
}
