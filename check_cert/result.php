<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$connection = Bitrix\Main\Application::getConnection();
$sqlHelper = $connection->getSqlHelper();
use Bitrix\Main\Mail\Event;

$today = date('d.m.Y');

$sql = "SELECT date_to FROM certificates WHERE certificate_number = '".$data['number']."' surname = '".$data['name']."'";
$recordset = $connection->query($sql);
while ($record = $recordset->fetch())
{
    if (strtotime($today) <= strtotime($record['date_to'])) {
        return 2;
    } else {
        return 1;
    }
    return 0;
}