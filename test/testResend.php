<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$connection = Bitrix\Main\Application::getConnection();
$sqlHelper = $connection->getSqlHelper();
use Bitrix\Main\Mail\Event;

$sql = "SELECT * FROM b_event WHERE  DATE_EXEC >= '15.05.2020' AND SUCCESS_EXEC = 'F'";
$recordset = $connection->query($sql);
while ($record = $recordset->fetch())
{
    if($record['EVENT_NAME'] !== 'EVENTS_SUBSCRIBE') {
        $result = CEvent::send($record['EVENT_NAME'],$record['LID'], unserialize($record['C_FIELDS']), $record['DUPLICATE'], $record['MESSAGE_ID']);
        echo '<pre>'.print_r($result).'</pre>';
        CEvent::CheckEvents();
    }
}