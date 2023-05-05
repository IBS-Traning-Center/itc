<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
/**
 * @global CMain $APPLICATION ;
 */
$APPLICATION->SetTitle("Заказы");

$APPLICATION->IncludeComponent(
    "bitrix:sale.order.ajax",
    "new",
    [
        "PAY_FROM_ACCOUNT" => "Y",    // Позволять оплачивать с внутреннего счета
        "COUNT_DELIVERY_TAX" => "N",    // Рассчитывать налог для доставки
        "COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
        "ONLY_FULL_PAY_FROM_ACCOUNT" => "N",    // Позволять оплачивать с внутреннего счета только в полном объеме
        "ALLOW_AUTO_REGISTER" => "Y",    // Оформлять заказ с автоматической регистрацией пользователя
        "SEND_NEW_USER_NOTIFY" => "Y",    // Отправлять пользователю письмо, что он зарегистрирован на сайте
        "PROP_1" => "",    // Не показывать свойства для типа плательщика "Физическое лицо" (ru)
        "PROP_3" => "",    // Не показывать свойства для типа плательщика "Юридическое лицо" (ru)
        "PROP_2" => "",    // Не показывать свойства для типа плательщика "Физическое лицо" (sl)
        "PROP_4" => "",    // Не показывать свойства для типа плательщика "Юридическое лицо (для юридических лиц-резидентов России)" (sl)
        "PATH_TO_BASKET" => "/personal/cart/",    // Страница корзины
        "PATH_TO_PERSONAL" => "/personal_test/orders/",    // Страница персонального раздела
        "PATH_TO_PAYMENT" => "/personal/order/payment/",    // Страница подключения платежной системы
        "SET_TITLE" => "Y",    // Устанавливать заголовок страницы
    ],
    false
);
?>
    <script>
        $(document).ready(function () {
            $("#basketOrderButton2").click(function () {
                pageTracker._trackEvent('Order', 'CreateOrder', '/personal/order/make');
            });
            $('#order_form form[action="https://sun.assist.ru/shops/cardpayment.cfm"]').submit(function () {
                pageTracker._trackEvent('Order', 'OnlineOrder', $REQUEST['ORDER_ID']);
            });
        });
    </script>
<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>