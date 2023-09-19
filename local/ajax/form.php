<?
declare(strict_types=1);

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
require_once($_SERVER['DOCUMENT_ROOT']. "/local/lib/bitrix24.rest/CRest.php");
global $USER;

$formAnswer = ['type' => 'error', 'message' => ''];
function subscribe($email)
{
    global $formAnswer;
    if (CModule::IncludeModule('subscribe') && !empty($email)) {
        global $USER;
        $email = htmlspecialchars($email);

        $subscribeFields = array(
            "USER_ID" => ($USER->IsAuthorized() ? $USER->GetID() : false),
            "FORMAT" => "html",
            "EMAIL" => $email,
            "ACTIVE" => "Y",
            "CONFIRMED" => "Y",
            "SEND_CONFIRM" => "N",
            "RUB_ID" => [3]
        );

        $subscr = new CSubscription;
        $ID = $subscr->Add($subscribeFields);

        if (class_exists('CRest')) {
            \CRest::call(
                'crm.lead.add',
                [
                    'fields' => [
                        'TITLE' => 'Подписка на дайджест' ,
                        'UF_ITC_SOURSE' => '26',
                        'EMAIL' => [
                            ["VALUE" => $email, "VALUE_TYPE" => "WORK"],
                        ],
                        'ASSIGNED_BY_ID' => '29',
                        'CREATED_BY_ID' => '29',
                    ]
                ]
            );
        }

        if ($ID > 0) {
            CSubscription::Authorize($ID);
            $formAnswer = [
                'type' => 'ok',
                'message' => 'Благодарим вас за подписку на наши новости.',
            ];
        } else {
            $formAnswer = [
                'type' => 'error',
                'title' => 'Внимание',
                'message' => 'Сожалеем, на сайте ведуться технические работы, попробуйте подписаться позже.'
            ];
        }
    }
}

if (
    isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH'])
    && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
)
{
    if ($_POST['addField'] !== '' && check_bitrix_sessid()) {
        $formAnswer = [
            'type' => 'error_1',
            'message' => 'addField'
        ];
        echo \Bitrix\Main\Web\Json::encode($formAnswer);
        exit;
    }

    $action = $_POST['form-name'];
    switch ($action) {
        case 'subscribe':
            if (empty($_POST['email']) || !CModule::IncludeModule('subscribe')) {
                $formAnswer = array(
                    'type' => 'error',
                );
                echo \Bitrix\Main\Web\Json::encode($formAnswer);
                exit;
            }

            $subscription = CSubscription::GetByEmail(trim($_POST['email']));
            if ($subscription->ExtractFields("str_")) {
                $formAnswer = [
                    'type' => 'ok',
                    'title' => 'Спасибо',
                ];
                echo \Bitrix\Main\Web\Json::encode($formAnswer);
                exit;
            }

            subscribe($_POST['email']);
            echo \Bitrix\Main\Web\Json::encode($formAnswer);
            exit;

            break;
        default:
            if (CModule::IncludeModule("form")) {

                $formId = (intval($_POST['form-id'])) ? htmlspecialchars($_POST['form-id']) : '1';
                $formFields = array();
                foreach ($_POST as $postKey => $postValue) {
                    $formFields[strtoupper($postKey)] = htmlspecialchars($postValue);
                }

                CForm::GetDataByID($formId, $form, $questions, $answers, $dropdown, $multiselect);
                $requiredCount = 0;
                $result = array();

                foreach ($_FILES as $keyFile => $item) {
                    if (!empty($item['name']) && $item['name'] != '') {
                        if (is_array($item['name'])) {
                            $arr_file = [
                                "name" => $item['name'][0],
                                "size" => $item['size'][0],
                                "tmp_name" => $item['tmp_name'][0],
                                "type" => $item['type'][0],
                            ];
                        } else {
                            $arr_file = [
                                "name" => $item['name'],
                                "size" => $item['size'],
                                "tmp_name" => $item['tmp_name'],
                                "type" => $item['type'],
                            ];
                        }
                        $formFields[strtoupper($keyFile)] = $arr_file;
                    }
                }
                foreach ($questions as $keyQuestion => $question) {
                    if (!empty($formFields[strtoupper($question['VARNAME'])])) {
                        $result[$question['ID']] = $formFields[strtoupper($question['VARNAME'])];
                        if ($question['REQUIRED'] === 'Y') $requiredCount++;
                    }
                }

                $arValues = [];
                foreach ($answers as $key => $answer) {
                    $item = $answer[0];
                    $code = 'form_' . $item['FIELD_TYPE'] . '_' . $item['ID'];
                    if (empty($result[$item['QUESTION_ID']])) continue;
                    if ($item['FIELD_TYPE'] !== 'file') {
                        $arValues[$code] = $result[$item['QUESTION_ID']];
                    } else {
                        $arValues[$code] = $result[$item['QUESTION_ID']];
                    }
                }

                $formAnswer['$answers'] = $answers;
                $formAnswer['$result'] = $result;
                $formAnswer['$questions'] = $questions;
                $formAnswer['$formFields'] = $formFields;
                $formAnswer['$arValues'] = $arValues;

                if (count($arValues) && count($arValues) >= $requiredCount) {
                    if ($RESULT_ID = CFormResult::Add($formId, $arValues)) {
                        $application = \Bitrix\Main\Application::getInstance();
                        $request = $application->getContext()->getRequest();
                        CFormResult::SetField($RESULT_ID, 'CLIENT_ID_YANDEX', $request->getCookieRaw('_ym_uid'));
                        CFormResult::SetField($RESULT_ID, 'CLIENT_ID_GOOGLE', $request->getCookieRaw('_ga'));

                        $formAnswer['type'] = 'ok';
                        CFormCRM::onResultAdded($formId, $RESULT_ID);
                        CFormResult::SetEvent($RESULT_ID);
                        CFormResult::Mail($RESULT_ID);
                    } else {
                        global $strError;
                        $formAnswer['type'] = 'error_2';
                        $formAnswer['message'] = $strError;
                    }
                } else {
                    $formAnswer = array(
                        'type' => 'error_3',
                    );
                }

            } else {
                $formAnswer = array(
                    'type' => 'error_4',
                );
            }
    }
}


echo \Bitrix\Main\Web\Json::encode($formAnswer);