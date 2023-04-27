<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");?>

<?
include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

// DOWNLOAD REMOTE FILES
$ftp_server='ftp.luxoft.csod.com';
$ftp_user_name="luxoft";
$ftp_user_pass="KmUny6gB";
include('Net/SFTP.php');
$sftp = new Net_SFTP($ftp_server); // создаем sftp клиент
if (!$sftp->login($ftp_user_name, $ftp_user_pass)) // попытка логина на sftp сервер
{
    exit('Login Failed');
}
else // успешно
{

	$sftp->chdir('/Reports/Custom_reports/'); // переходим в нужную директорию
	$files = $sftp->rawlist();
	$List = array_filter($files, function($var) { return preg_match("/(ToBitrix_)/i", $var['filename']); }); // берем только файлы для Битрикс


echo "<hr>";

	foreach ($List as $Item => $Attributes)
	{
		if ($Attributes['size'] > 356)
		{
            $path=$_SERVER["DOCUMENT_ROOT"].'/debug/Courses/';
			$filename = $Attributes['filename'];

			$sftp->get('/Reports/Custom_reports/'.$filename, $path.$filename);
			echo "<pre> ";
			echo  $path.$filename;
			echo "</pre>";
		}
	}



}

function debug_to_console( $data ) {
    $output = $data;
    if ( is_array( $output ) )
        $output = implode( ',', $output);

    echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
}

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");

?>