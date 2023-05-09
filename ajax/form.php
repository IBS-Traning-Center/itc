<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if($_POST['addField'] !== '') die();
global $USER; global $formAnswer;
$formAnswer = ['type' => 'ok', 'message' => ''];
if(CModule::IncludeModule("form")) {

    $formId = htmlspecialchars($_POST['WEB_FORM_ID']);

    foreach ($_POST as $postKey => $postValue) {
        $result[$postKey] = htmlspecialchars($postValue);
    }

    $fid = '';
    foreach ($_FILES as $item) {
        if (!empty($item['name']) && $item['name'] != '') {
            $arr_file = [
                "name" => $item['name'],
                "size" => $item['size'],
                "tmp_name" => $item['tmp_name'],
                "type" => $item['type'],
                "old_file" => "",
                "del" => "Y",
                "MODULE_ID" => ""
            ];
            $result['file'] = $arr_file;
        }
    }

    CForm::GetDataByID($formId,
        $form,
        $questions,
        $answers,
        $dropdown,
        $multiselect);

    $arValues = [];

    foreach ($answers as $key => $answer){
        $item = $answer[0];
        $code = 'form_'.$item['FIELD_TYPE'].'_'.$item['ID'];
        if(empty($result[$key])) continue;
        $arValues[$code] = $result[$key];
    }

    if ($RESULT_ID = CFormResult::Add($formId, $arValues)) {
        $formAnswer['message'] = 'Ваша заявка получена';
        CFormCRM::onResultAdded($formId, $RESULT_ID);
        CFormResult::SetEvent($RESULT_ID);
        CFormResult::Mail($RESULT_ID);
    } else {
        global $strError;
        $formAnswer['type'] = 'error';
        $formAnswer['message'] = $strError;
    }

} else {
    $formAnswer = [
        'type' => 'error',
        'message' => 'На сайте ведутся технические работы, попробуйте позже.'
    ];
}

echo json_encode($formAnswer, JSON_UNESCAPED_UNICODE);