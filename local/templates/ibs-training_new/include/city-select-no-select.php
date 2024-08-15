<div class="city-select">
    <a class="title dropdown-link" href="#">
        <?
        switch ($_SESSION["cityID"]) {
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
        } ?>
        <i class="fa fa-caret-down" aria-hidden="true"></i></a>
    <ul class="dropdown">
        <li><a data-id="<?= CITY_ID_ONLINE ?>" href="javascript:void(0)">Онлайн</a></li>
        <?
        if (false) { ?>
            <li><a data-id="<?= CITY_ID_MOSCOW ?>" href="javascript:void(0)">Москве</a></li>
            <li><a data-id="<?= CITY_ID_SPB ?>" href="javascript:void(0)">Санкт-Петербурге</a></li>
            <li><a data-id="<?= CITY_ID_OMSK ?>" href="javascript:void(0)">Омске</a></li>
            <li><a data-id="<?= CITY_ID_KIEV ?>" href="javascript:void(0)">Киеве</a></li>
            <li><a data-id="<?= CITY_ID_DNEPR ?>" href="javascript:void(0)">Днепре</a></li>
            <li><a data-id="<?= CITY_ID_ODESSA ?>" href="javascript:void(0)">Одессе</a></li>
        <?
        } ?>
    </ul>
</div>
