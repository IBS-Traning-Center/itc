<?
$USER_IP=$_SERVER["REMOTE_ADDR"];

if (intval($_REQUEST["cityFormSend"])>0) {
    $_SESSION["cityID"]=intval($_REQUEST["cityFormSend"]);
    LocalRedirect($APPLICATION->GetCurPageParam("", array("cityFormSend")));
} else {
 if (intval($_SESSION["cityID"])==0) {
        switch ($city) {
            case "Санкт-Петербург":
                $cityID=CITY_ID_SPB;
                break;
            case "Омск":
                $cityID=CITY_ID_OMSK;
                break;
            case "Киев":
                $cityID=CITY_ID_KIEV;
                break;
            case "Одесса":
                $cityID=CITY_ID_ODESSA;
                break;
            case "Днепропетровск":
                $cityID=CITY_ID_DNEPR;
                break;
            default:
				if ($country=="UA") {
					$cityID=CITY_ID_KIEV;
				} else {
					$cityID=CITY_ID_MOSCOW;
				}
        }
		if (intval($cityID)>0) {
			$_SESSION["cityID"]=$cityID;
		}
    }
}

?>