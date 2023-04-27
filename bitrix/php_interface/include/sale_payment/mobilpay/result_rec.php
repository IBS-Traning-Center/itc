<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?
$pre=$_SERVER["DOCUMENT_ROOT"]."/test2/";
require_once $_SERVER["DOCUMENT_ROOT"].'/bitrix/php_interface/include/sale_payment/mobilpay/Mobilpay/Payment/Request/Abstract.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/bitrix/php_interface/include/sale_payment/mobilpay/Mobilpay/Payment/Request/Card.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/bitrix/php_interface/include/sale_payment/mobilpay/Mobilpay/Payment/Request/Notify.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/bitrix/php_interface/include/sale_payment/mobilpay/Mobilpay/Payment/Recurrence.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/bitrix/php_interface/include/sale_payment/mobilpay/Mobilpay/Payment/Invoice.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/bitrix/php_interface/include/sale_payment/mobilpay/Mobilpay/Payment/Address.php';

$errorCode 		= 0;
$errorType		= Mobilpay_Payment_Request_Abstract::CONFIRM_ERROR_TYPE_NONE;
$errorMessage	= '';

if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') == 0)
{
	
	if(isset($_POST['env_key']) && isset($_POST['data']))
	{
		#calea catre cheia privata
		#cheia privata este generata de mobilpay, accesibil in Admin -> Conturi de comerciant -> Detalii -> Setari securitate
		$privateKeyFilePath = $_SERVER["DOCUMENT_ROOT"].'/bitrix/php_interface/include/sale_payment/mobilpay/live.1EKY-8K1D-2858-J6J2-HY57private.key';
		file_put_contents($pre."success.txt", '1233');
		try
		{
			$objPmReq = Mobilpay_Payment_Request_Abstract::factoryFromEncrypted($_POST['env_key'], $_POST['data'], $privateKeyFilePath);
	    	switch($objPmReq->objPmNotify->action)
	    	{	
			
			#orice action este insotit de un cod de eroare si de un mesaj de eroare. Acestea pot fi citite folosind $cod_eroare = $objPmReq->objPmNotify->errorCode; respectiv $mesaj_eroare = $objPmReq->objPmNotify->errorMessage;
			#pentru a identifica ID-ul comenzii pentru care primim rezultatul platii folosim $id_comanda = $objPmReq->orderId;
	        case 'confirmed':
				#cand action este confirmed avem certitudinea ca banii au plecat din contul posesorului de card si facem update al starii comenzii si livrarea produsului
	        	$errorMessage = $objPmReq->objPmNotify->getCrc();
				$orderID=$objPmReq->orderId;
				CSaleOrder::PayOrder($orderID, "Y");
	            break;
			case 'confirmed_pending':
				#cand action este confirmed_pending inseamna ca tranzactia este in curs de verificare antifrauda. Nu facem livrare/expediere. In urma trecerii de aceasta verificare se va primi o noua notificare pentru o actiune de confirmare sau anulare.
	        	$errorMessage = $objPmReq->objPmNotify->getCrc();
				file_put_contents($pre."success.txt", "confirmed_pending");
	            break;
			case 'paid_pending':
				#cand action este paid_pending inseamna ca tranzactia este in curs de verificare. Nu facem livrare/expediere. In urma trecerii de aceasta verificare se va primi o noua notificare pentru o actiune de confirmare sau anulare.
	        	$errorMessage = $objPmReq->objPmNotify->getCrc();
				file_put_contents($pre."success.txt", "paid_pending");
	            break;
			case 'paid':
				#cand action este paid inseamna ca tranzactia este in curs de procesare. Nu facem livrare/expediere. In urma trecerii de aceasta procesare se va primi o noua notificare pentru o actiune de confirmare sau anulare.
	        	$errorMessage = $objPmReq->objPmNotify->getCrc();
				file_put_contents($pre."success.txt", "paid");
	            break;
			case 'canceled':
				#cand action este canceled inseamna ca tranzactia este anulata. Nu facem livrare/expediere.
	        	$errorMessage = $objPmReq->objPmNotify->getCrc();
				file_put_contents($pre."success.txt", "canceled");
	            break;
			case 'credit':
				#cand action este credit inseamna ca banii sunt returnati posesorului de card. Daca s-a facut deja livrare, aceasta trebuie oprita sau facut un reverse. 
	        	$errorMessage = $objPmReq->objPmNotify->getCrc();
				file_put_contents($pre."success.txt", "credit");
	            break;
	        default:
	        	$errorType		= Mobilpay_Payment_Request_Abstract::CONFIRM_ERROR_TYPE_PERMANENT;
	            $errorCode 		= Mobilpay_Payment_Request_Abstract::ERROR_CONFIRM_INVALID_ACTION;
	            $errorMessage 	= 'mobilpay_refference_action paramaters is invalid';
				file_put_contents($pre."success.txt", 'mobilpay_refference_action paramaters is invalid');
	            break;
	    	}
		}
		catch(Exception $e)
		{
			$errorType 		= Mobilpay_Payment_Request_Abstract::CONFIRM_ERROR_TYPE_TEMPORARY;
			$errorCode		= $e->getCode();
			$errorMessage 	= $e->getMessage();
		}
	}
	else
	{
		$errorType 		= Mobilpay_Payment_Request_Abstract::CONFIRM_ERROR_TYPE_PERMANENT;
		$errorCode		= Mobilpay_Payment_Request_Abstract::ERROR_CONFIRM_INVALID_POST_PARAMETERS;
		$errorMessage 	= 'mobilpay.ro posted invalid parameters';
		file_put_contents($pre."success.txt", "mobilpay.ro posted invalid parameters");
	}
}
else 
{
	$errorType 		= Mobilpay_Payment_Request_Abstract::CONFIRM_ERROR_TYPE_PERMANENT;
	$errorCode		= Mobilpay_Payment_Request_Abstract::ERROR_CONFIRM_INVALID_POST_METHOD;
	$errorMessage 	= 'invalid request metod for payment confirmation';
	file_put_contents($pre."success.txt", "invalid request metod for payment confirmation");
}

header('Content-type: application/xml');
echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
if($errorCode == 0)
{
	echo "<crc>{$errorMessage}</crc>";
}
else
{
	echo "<crc error_type=\"{$errorType}\" error_code=\"{$errorCode}\">{$errorMessage}</crc>";
}

?>