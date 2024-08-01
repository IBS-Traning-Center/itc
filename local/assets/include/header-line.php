<div class="sec-wrap">
    <div class="section">
        <div class="login-header-wrap">
            <?$APPLICATION->IncludeComponent(
                "bitrix:menu",
                "user",
                Array(
                    "ROOT_MENU_TYPE"	=>	"user",
                    "MAX_LEVEL"	=>	"1",
                    "USE_EXT"	=>	"Y"
                )
            );?>
        </div>
        <div class="personal-header-wrap">
            <a href="/personal_test/" class="briefcase-icon">Личный кабинет</a>
        </div>
        <div class="basket-header-wrap">
			<div class="basketSmall">
            <?$APPLICATION->IncludeComponent("bitrix:sale.basket.basket.small", "new-design", Array(
                    "PATH_TO_BASKET" => "/personal/cart",	// Страница корзины
                    "PATH_TO_ORDER" => "/personal/order.php",	// Страница оформления заказа
                    "SHOW_DELAY" => "Y",
                    "SHOW_NOTAVAIL" => "Y",
                    "SHOW_SUBSCRIBE" => "Y"
                ),
                false
            );?>
            </div>
            <a href="/personal/cart/" class="sm-basket-icon">Корзина</a>
        </div>
    </div>
    <nav class="horizontal-nav" id="oblique-nav">
        <div id="triangle-bottomleft"></div>
        <div class="top-right-corner">
            <span class="lang"><a class="opacity-transition ru" title="" rel="nofollow" href="http://www.luxoft-training.com">En</a></span>
            <span class="lang  active"><a class="opacity-transition ru" title="" href="/">Ru</a></span>
        </div>
    </nav>
    <div class="clearfix"></div>
</div>