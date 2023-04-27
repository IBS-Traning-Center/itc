<?php
declare(strict_types=1);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use Luxoft\Dev\Service\ErrorsService;
use Luxoft\Dev\Enum\ErrorsEnum;

$postData = file_get_contents('php://input');
$data = json_decode($postData, true);
$errorsService = new ErrorsService();
$errorsService->add(
    ErrorsEnum::ERROR_JS,
    $data['url'],
    [
        'line' =>   $data['line'],
        'col' =>    $data['col'],
        'msg' =>    $data['msg'],
    ]
);