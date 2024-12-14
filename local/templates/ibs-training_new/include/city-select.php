<div class="city-select">
<a class="title dropdown-link" href="#">
<?switch ($_SESSION["cityID"]) {
    case CITY_ID_SPB:
        echo "Санкт-Петербургe";
        break;
    case CITY_ID_OMSK:
        echo "Омскe";
        break;
    case CITY_ID_KIEV:
        echo "Киевe";
        break;
    case CITY_ID_ODESSA:
        echo "Одессe";
        break;
    case CITY_ID_DNEPR:
        echo "Днепре";
        break;
	case CITY_ID_MINSK:
        echo "Минске";
        break;
    case CITY_ID_ONLINE:
        echo "Онлайн";
        break;
    default:
        echo "Онлайн";
}?>
<i class="fa fa-caret-down" aria-hidden="true"></i></a>
<ul class="dropdown">
    <li><a data-id="<?=CITY_ID_ONLINE?>" href="<?=$APPLICATION->GetCurPageParam("cityFormSend=".CITY_ID_ONLINE)?>">Онлайн</a></li>
    <?if(false) {?>
    <li><a data-id="<?=CITY_ID_MOSCOW?>" href="<?=$APPLICATION->GetCurPageParam("cityFormSend=".CITY_ID_MOSCOW)?>">Москве</a></li>
    <li><a data-id="<?=CITY_ID_SPB?>" href="<?=$APPLICATION->GetCurPageParam("cityFormSend=".CITY_ID_SPB)?>">Санкт-Петербурге</a></li>
    <li><a data-id="<?=CITY_ID_OMSK?>" href="<?=$APPLICATION->GetCurPageParam("cityFormSend=".CITY_ID_OMSK)?>">Омске</a></li>
    <li><a data-id="<?=CITY_ID_KIEV?>" href="<?=$APPLICATION->GetCurPageParam("cityFormSend=".CITY_ID_KIEV)?>">Киеве</a></li>
    <li><a data-id="<?=CITY_ID_DNEPR?>" href="<?=$APPLICATION->GetCurPageParam("cityFormSend=".CITY_ID_DNEPR)?>">Днепре</a></li>
    <li><a data-id="<?=CITY_ID_ODESSA?>" href="<?=$APPLICATION->GetCurPageParam("cityFormSend=".CITY_ID_ODESSA)?>">Одессе</a></li>
    <?}?>
</ul>
</div>
