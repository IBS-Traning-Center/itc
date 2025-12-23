<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Авторизация");
?><?
global $USER;
if ($USER->IsAuthorized())
{
    if (isset($_REQUEST["backurl"]) && strlen($_REQUEST["backurl"])>0)
        LocalRedirect($backurl);
}
?>


<?$APPLICATION->IncludeComponent(
    "bitrix:system.auth.form",
    "new_auth",
    [
        "REGISTER_URL" => "/auth/registration.php",
        "PROFILE_URL" => "/personal/personal.html",
        "AUTH_FORGOT_PASSWORD_URL" => "/auth/forgot_pass.php",
        "SHOW_ERRORS" => "Y"
    ],
    false
);?>

    <br /><br />
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>