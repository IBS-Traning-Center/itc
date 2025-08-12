<?php
/**
 * @global CMain $APPLICATION
 */
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");
?>
<h2>Контакт по вопросам информационного партнерства и сотрудничества со СМИ:</h2>
<p>
    Наталья Святкина
    <br>e-mail: <a href="mailto:NSvyatkina<?=EMAIL_DOMAIN?>">NSvyatkina<?=EMAIL_DOMAIN?></a>
    <br>Тел.: +7(495) 609-6967 (доб. 5045)
</p>
<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
