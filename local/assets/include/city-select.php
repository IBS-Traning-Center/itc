<div class="simple-style">
<div class="selected-item">
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
    default:
        echo "Москвe";
}?>
</div>
<ul class="selectable-item">
    <li data-id="<?=CITY_ID_MOSCOW?>">Москве</li>
    <li data-id="<?=CITY_ID_SPB?>">Санкт-Петербурге</li>
    <li data-id="<?=CITY_ID_OMSK?>">Омске</li>
    <li data-id="<?=CITY_ID_KIEV?>">Киеве</li>
    <li data-id="<?=CITY_ID_DNEPR?>">Днепре</li>
    <li data-id="<?=CITY_ID_ODESSA?>">Одессе</li>
	<li data-id="<?=CITY_ID_MINSK?>">Минске</li>
</ul>
</div>
