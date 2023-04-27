<?
$USER_IP=$_SERVER["REMOTE_ADDR"];

//$USER_IP='85.238.125.212';
/*
define("CITY_ID_ONLINE", 14909);
define("CITY_ID_OMSK", 5742);
define("CITY_ID_MOSCOW", 5741);
define("CITY_ID_KIEV", 5745);
define("CITY_ID_DNEPR", 5747);
define("CITY_ID_ODESSA", 5746);
define("CITY_ID_SPB", 5744);
define("CITY_ID_MINSK", 28042);
define("CITY_ID_NOVOROSSIYSK", 33125);
define("CITY_ID_NOVOSIBIRSK", 9190);
 */
if (intval($_REQUEST["cityFormSend"])>0) {
    $_SESSION["cityID"]=intval($_REQUEST["cityFormSend"]);
    LocalRedirect($APPLICATION->GetCurPageParam("", array("cityFormSend")));
} else {
 if (intval($_SESSION["cityID"])==0) {
        //print_r($_COOKIE["cityID"]);
       //$geo_xml=simplexml_load_file('http://ipgeobase.ru:7020/geo?ip='.$USER_IP);
       //$city=iconv('UTF-8', 'windows-1251', (string)$geo_xml->ip->city);
		//$country=iconv('UTF-8', 'windows-1251', (string)$geo_xml->ip->country);
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