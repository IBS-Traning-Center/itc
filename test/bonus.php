<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");
?>
<?
$dbAccountCurrency = CSaleUserAccount::GetList(
        array(),
        array(">CURRENT_BUDGET" => "999", "CURRENCY"=> "RUB"),
        false,
        false,
        array("CURRENT_BUDGET", "CURRENCY", "USER_ID")
    );
while ($arAccountCurrency = $dbAccountCurrency->Fetch())
{
	/*echo "<pre>";
    print_r($arAccountCurrency);*/
	$arFilter = array(
			'ID' => $arAccountCurrency["USER_ID"],
		);
		$dbUsers = CUser::GetList($by = 'ID', $order = 'ASC', $arFilter);
		while ($arUser = $dbUsers->Fetch()) 
		{
			//print_r($arUser["NAME"]);
			if (strlen($arUser["NAME"])>2) {
				$NAME=$arUser["LAST_NAME"]." ".$arUser["NAME"];
			} else {
				$NAME=$arUser["LOGIN"];
			}
			$arUsers[]=array("EMAIL"=>$arUser["EMAIL"], "BUDGET"=> intval($arAccountCurrency["CURRENT_BUDGET"]).' '.getCountVal($arAccountCurrency["CURRENT_BUDGET"], array("бонусный балл", "бонусных балла", "бонусных баллов")), "ID"=>$arUser["ID"], "NAME"=> $NAME);
			
		}


   
}
foreach ($arUsers as $key=>$arOneUser) {
		echo "<pre>";
		print_r($arOneUser);
		echo "</pre>";
		//CEvent::Send("SPEND_BONUS", 'ru', $arOneUser);
	}?>