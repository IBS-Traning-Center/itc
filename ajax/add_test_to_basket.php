<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?$action=$_REQUEST["action"]?>
<?if (CModule::IncludeModule("sale") && CModule::IncludeModule("catalog"))
	{
	   if (($action == "ADD2BASKET" || $action == "BUY") && IntVal($_GET['id'])>0 && IntVal($_GET['quantity']>0))
	    {
				$idTemp = intval($_REQUEST["id"]);
				Add2BasketByProductID($idTemp, $_GET['quantity']);
		}
	}
	if ($action=="BUY") {
		LocalRedirect('/personal/order/make/');
	}
?>