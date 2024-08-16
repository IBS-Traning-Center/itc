<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("blue_title", "Контакты Luxoft Training");
$APPLICATION->SetPageProperty("title", "Контакты Luxoft Training");
$APPLICATION->SetPageProperty("keywords", "Адрес УЦ Luxoft, как проехать Luxoft, контакты Люксофт, телефон Люксофт, Luxoft Москва, luxoft Киев, Люксофт Омск, Luxoft Training, адрес Luxoft Training");
$APPLICATION->SetPageProperty("description", "Курсы по программированию: Москва, Санкт-Петербург, Омск, Киев, Днепропетровск, Одесса.");
$APPLICATION->SetTitle("Контакты Luxoft Training  ");
?><?switch ($_SESSION["cityID"]) {
    case CITY_ID_SPB:
		LocalRedirect('/contacts/sankt-peterburg/');
        break;
    case CITY_ID_OMSK:
		LocalRedirect('/contacts/omsk/');
        break;
    case CITY_ID_KIEV:
        LocalRedirect('/contacts/kiev/');
        break;
    case CITY_ID_ODESSA:
        LocalRedirect('/contacts/odessa/');
        break;
    case CITY_ID_DNEPR:
		LocalRedirect('/contacts/dnepr/');
        break;
	case CITY_ID_MINSK:
		LocalRedirect('/contacts/minsk/');
        break;
    default:
		LocalRedirect('/contacts/moscow/');
}?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>