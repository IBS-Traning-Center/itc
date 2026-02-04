<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

/**
 * @var array $arParams
 */
?>
<script id="basket-total-template" type="text/html">
    <div class="right-column" data-entity="basket-checkout-aligner">

        {{#HAS_COUPON_FIELD}}
        <div class="coupon-section">
            <div class="form-group">
                <label for="coupon-input"><?= Loc::getMessage('SBB_COUPON_ENTER_MSGVER_1') ?></label>
                <div class="input-with-btn">
                    <input type="text" id="coupon-input" class="form-control"
                           placeholder="Введите промо-код" data-entity="basket-coupon-input">
                    <button type="button" class="btn-coupon" data-entity="basket-coupon-apply">Применить</button>
                </div>
            </div>
        </div>
        {{/HAS_COUPON_FIELD}}

        <div class="total-title">
            <?= Loc::getMessage('SBB_TOTAL_MSGVER_1') ?>
        </div>

        <div class="total-prices">
            {{#DISCOUNT_PRICE_FORMATED}}
            <span class="total-old">{{{PRICE_WITHOUT_DISCOUNT_FORMATED}}}</span>
            {{/DISCOUNT_PRICE_FORMATED}}

            <span class="total-current" data-entity="basket-total-price">
				{{{PRICE_FORMATED}}}
			</span>
        </div>

        {{#DISCOUNT_PRICE_FORMATED}}
        <div class="total-savings">
            Ваша выгода: <span class="savings-amount">{{{DISCOUNT_PRICE_FORMATED}}}</span>
        </div>
        {{/DISCOUNT_PRICE_FORMATED}}

        {{#WEIGHT_FORMATED}}
        <div class="weight-info">
            <?= Loc::getMessage('SBB_WEIGHT_MSGVER_1', ['#WEIGHT_FORMATED#' => '{{{WEIGHT_FORMATED}}}']) ?>
        </div>
        {{/WEIGHT_FORMATED}}

        {{#SHOW_VAT}}
        <div class="vat-info">
            <?= Loc::getMessage('SBB_VAT_MSGVER_1', ['#VAT_SUM_FORMATED#' => '{{{VAT_SUM_FORMATED}}}']) ?>
        </div>
        {{/SHOW_VAT}}

        <button class="btn-order{{#DISABLE_CHECKOUT}} disabled{{/DISABLE_CHECKOUT}}"
                data-entity="basket-checkout-button"
                id="basket-checkout-button">
            <?=Loc::getMessage('SBB_ORDER')?>
        </button>

        <a href="#" class="conditions-link">Условия рассрочки</a>


        <div id="agreement-checkboxes-container"></div>
        {{#HAS_COUPON_FIELD}}
        <div class="applied-coupons">
            {{#COUPON_LIST}}
            <div class="coupon-alert alert-{{CLASS}}">
				<span class="coupon-text">
					<strong>{{COUPON}}</strong> - <?=Loc::getMessage('SBB_COUPON')?> {{JS_CHECK_CODE}}
					{{#DISCOUNT_NAME}}({{DISCOUNT_NAME}}){{/DISCOUNT_NAME}}
				</span>
                <span class="remove-coupon" data-entity="basket-coupon-delete" data-coupon="{{COUPON}}">
					<?=Loc::getMessage('SBB_DELETE')?>
				</span>
            </div>
            {{/COUPON_LIST}}
        </div>
        {{/HAS_COUPON_FIELD}}
    </div>
</script>
