<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Корзина выбранных услуг");
?>
<p>
Вы данной странице вы можете "Оформить заказ",  просмотреть корзину выбранных услуг и отредактировать ее содержимое. "Оформление заказа" подразумевает под собой бронирование мест на тренингах и классах в школах.<br />
Для онлайн оплаты вам будет необходимо принять условия договора оферты на оказание услуг.<br/>
<b>Пожалуйста, будьте готовы предъявить документ о Вашем образовании по просьбе администратора учебного центра.</b>
</p>
<?if(false) {?>
    <?$APPLICATION->IncludeComponent(
        "edu:store.sale.basket.basket",
        "template",
        array(
            "COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
            "COLUMNS_LIST" => array(
                0 => "NAME",
                1 => "PROPS",
                2 => "PRICE",
                3 => "QUANTITY",
                4 => "DELETE",
                5 => "DELAY",
                6 => "DISCOUNT",
            ),
            "AJAX_MODE" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "AJAX_OPTION_HISTORY" => "N",
            "PATH_TO_ORDER" => "/personal/order/make/",
            "HIDE_COUPON" => "N",
            "QUANTITY_FLOAT" => "N",
            "PRICE_VAT_SHOW_VALUE" => "N",
            "SET_TITLE" => "N",
            "AJAX_OPTION_ADDITIONAL" => "",
            "COMPONENT_TEMPLATE" => "template"
        ),
        false
    );?>
<?}?>
<?$APPLICATION->IncludeComponent(
    "luxoft:basket", "page", [], false
);?>
<br />
<p>
 Далее вам будет предложен способ оплаты или выставлен счет в зависимости от какого лица вы будете оплачивать (физ, юрид лицо).
Для  Физического лица возможна оплата услуг по квитанции через банк и также возможна интернет-оплата (процессинг Ассист), оплата от Юридического лица происходит путем безналичного расчета через компанию Заказчика.<br />
</p>


<script>
	$(document).ready(function(){
							$("#basketOrderButton2").click(function() {
	  							pageTracker._trackEvent('Order', 'ObtainOrder', 'personal/cart');
							});
	});
</script>
<?$APPLICATION->IncludeComponent("artions:listcourses.email", ".default", array(
	"IBLOCK_TYPE" => "edu",
	"IBLOCK_ID" => "6",
	"ITEMS_LIMIT" => "10",
	"USER_ID" => CUser::GetID(),
	"AJAX_MODE" => "N",
	"AJAX_OPTION_SHADOW" => "Y",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "N",
	"CACHE_TIME" => "3600",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>