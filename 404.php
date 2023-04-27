<?php
/**
 * @var CMain $APPLICATION ;
 */

use Luxoft\Dev\Service\ErrorsService;
use Luxoft\Dev\Enum\ErrorsEnum;
use Bitrix\Main\Application;

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

global $APPLICATION;
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

$application = Application::getInstance();
$context = $application->getContext();
$errorsService = new ErrorsService();
$errorsService->add(ErrorsEnum::ERROR_404, $context->getServer()->get('REQUEST_URI'));

$APPLICATION->RestartBuffer();

@define("ERROR_404", "Y");
CHTTP::SetStatus("404 Not Found");

require($_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/header.php");
$APPLICATION->SetTitle("404 - СТРАНИЦА НЕДОСТУПНА");
$APPLICATION->SetPageProperty("IS_FULL_WIDTH", "Y");
$APPLICATION->SetPageProperty('DONT_SHOW_PAGE_TOP', 'Y');
?>
    <div class="page-404">
        <div class="page-404">
            <img class="page-404_image" src="/images/4041.png">
            <h1 class="page-404__title">404 – Страница не найдена</h1>
            <div class="page-404__description">
                Упс... Кажется, из множества страниц нашего сайта вы оказались как раз на той,<br> которой не существует, или же она была перемещена.
                <br>
                <br>
                Надеемся, вы найдете, что искали, по ссылкам ниже:
            </div>
            <div class="page-404__links">
                <a href="/" class="page-404__link">Главная</a>
                <a href="/training/katalog_kursov/" class="page-404__link">Каталог курсов</a>
                <a href="/timetable/" class="page-404__link">Расписание</a>
            </div>
        </div>
    </div>
    <style>
        .page-404 {
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 1% 0;
        }
        .page-404__image {
            display: block;
        }
        .page-404__title {
            color: #EE5F0E;
            font-weight: 600;
            font-size: 32px;
            padding: 3% 0;
            margin: 0;
        }
        .page-404__description {
            text-align: center;
            font-size: 16px;
            padding: 3% 0;
        }
        .page-404__links {
            padding: 4% 0;
        }
        .page-404__link {
            display: inline-block;
            margin: 0 10px;
            font-size: 18px;
            font-weight: 600;
        }
    </style>
    <?php if (!$errorsService->botDetected()) {?>
        <script type="text/javascript">
            $(document).ready(function () {
                window.targetEvents.error404();
            });
        </script>
    <?php }?>
<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");