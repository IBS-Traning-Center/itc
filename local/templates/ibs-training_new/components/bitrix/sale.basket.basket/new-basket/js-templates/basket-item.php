<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
?>

<script id="basket-item-template" type="text/html">
    <div class="basket-item-container" id="basket-item-{{ID}}" data-entity="basket-item" data-id="{{ID}}">
        {{#SHOW_RESTORE}}
        <div class="basket-items-list-item-notification">
            <div class="basket-items-list-item-notification-inner basket-items-list-item-notification-removed">
                {{#SHOW_LOADING}}
                <div class="basket-items-list-item-overlay"></div>
                {{/SHOW_LOADING}}
                <div class="basket-items-list-item-removed-container">
                    <div>
                        <?= Loc::getMessage('SBB_BASKET_ITEM_DELETED_MSGVER_1', ['#NAME#' => '<strong>{{NAME}}</strong>']) ?>
                    </div>
                    <div class="basket-items-list-item-removed-block">
                        <a href="javascript:void(0)" data-entity="basket-item-restore-button">
                            <?=Loc::getMessage('SBB_BASKET_ITEM_RESTORE')?>
                        </a>
                        <span class="basket-items-list-item-clear-btn" data-entity="basket-item-close-restore-button"></span>
                    </div>
                </div>
            </div>
        </div>
        {{/SHOW_RESTORE}}
        {{^SHOW_RESTORE}}

        <div class="basket-item-main-container">
            <div class="delete-button-container mobile-delete-btn">
                <button class="delete-item-btn" data-entity="basket-item-delete" title="Удалить из корзины">
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M24.4346 11.4092L22.082 26.5762L22.0166 27H9.68945L9.62305 26.5762L7.27051 11.4092L8.25879 11.2568L10.5459 26H21.1592L23.4463 11.2568L24.4346 11.4092ZM19.1172 5.33008L20.291 8.58301H26V9.58301H6V8.58301H11.7783L11.7178 8.55566L13.1914 5.29395L13.3242 5H18.998L19.1172 5.33008ZM12.8037 8.58301H19.2275L18.2959 6H13.9697L12.8037 8.58301Z" fill="black"/>
                    </svg>
                </button>
            </div>

            <div class="basket-item-content">
                <div class="basket-item-details">
                    <div class="basket-item-meta-row">
                        <div class="meta-item date-info">
                            <div class="meta-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="3.75" y="3.75" width="16.5" height="16.5" stroke="black" stroke-width="1.5"/>
                                    <line x1="4" y1="8.25" x2="20" y2="8.25" stroke="black" stroke-width="1.5"/>
                                    <rect x="7" y="11" width="2" height="2" fill="black"/>
                                    <rect x="11" y="11" width="2" height="2" fill="black"/>
                                    <rect x="15" y="11" width="2" height="2" fill="black"/>
                                    <rect x="7" y="15" width="2" height="2" fill="black"/>
                                    <rect x="11" y="15" width="2" height="2" fill="black"/>
                                    <rect x="15" y="15" width="2" height="2" fill="black"/>
                                </svg>
                            </div>
                            <span class="meta-text">{{DELIVERY_DATE}}</span>
                        </div>

                        <div class="meta-item time-info">
                            <div class="meta-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="12" cy="12" r="9.5" stroke="black"/>
                                    <line x1="11.5" y1="12" x2="11.5" y2="5" stroke="black"/>
                                    <path d="M18 12V13H11V12H18Z" fill="black"/>
                                </svg>
                            </div>
                            <span class="meta-text">{{DELIVERY_TIME}}</span>
                        </div>
                        <div class="tag-container-general">
                            {{#DURATION}}
                            <div class="tag-container">
                                <div class="tag">{{DURATION}}</div>
                            </div>
                            {{/DURATION}}

                            {{#CITY}}
                            <div class="tag-container">
                                <div class="tag">{{CITY}}</div>
                            </div>
                            {{/CITY}}

                            {{^CITY}}
                            {{#CATEGORY_LEVEL}}
                            <div class="tag-container">
                                <div class="tag">{{CATEGORY_LEVEL}}</div>
                            </div>
                            {{/CATEGORY_LEVEL}}
                            {{/CITY}}
                        </div>
                    </div>

                    <div class="basket-item-course-info">
                        <div class="course-title" data-entity="basket-item-name">
                            {{NAME}}
                        </div>

                    </div>
                </div>

                <div class="basket-item-price-section">
                    <div class="quantity-control" data-entity="basket-item-quantity-block">
                        <button class="quantity-btn minus" data-entity="basket-item-quantity-minus">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none">
                                <line x1="6" y1="16" x2="26" y2="16" stroke="#000000" stroke-width="1"/>
                            </svg>
                        </button>

                        <div class="quantity-input-container">
                            <input type="text"
                                   class="quantity-input"
                                   value="{{QUANTITY}}"
                                   data-value="{{QUANTITY}}"
                                   data-entity="basket-item-quantity-field"
                                   id="basket-item-quantity-{{ID}}"
                                   {{#NOT_AVAILABLE}}disabled{{/NOT_AVAILABLE}}
                            readonly>
                        </div>

                        <button class="quantity-btn plus" data-entity="basket-item-quantity-plus">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none">
                                <line x1="16" y1="6" x2="16" y2="26" stroke="#000000" stroke-width="1"/>
                                <line x1="6" y1="16" x2="26" y2="16" stroke="#000000" stroke-width="1"/>
                            </svg>
                        </button>
                    </div>

                    <div class="price-info">
                        {{#SHOW_DISCOUNT_PRICE}}
                        <div class="old-price">
                            {{{FULL_PRICE_FORMATED}}}
                        </div>
                        {{/SHOW_DISCOUNT_PRICE}}

                        <div class="current-price" id="basket-item-price-{{ID}}">
                            {{{PRICE_FORMATED}}}
                        </div>

                        {{#SHOW_DISCOUNT}}
                        <div class="discount-info">
                            <a href="#" class="discount-link" data-entity="basket-item-discount-details">
                                Рассрочка, Скидка, Промо-код
                            </a>
                        </div>
                        {{/SHOW_DISCOUNT}}
                    </div>
                </div>
            </div>

            {{#NOT_AVAILABLE}}
            <div class="basket-items-list-item-warning-container">
                <div class="alert alert-warning">
                    <?=Loc::getMessage('SBB_BASKET_ITEM_NOT_AVAILABLE')?>
                </div>
            </div>
            {{/NOT_AVAILABLE}}

            {{#DELAYED}}
            <div class="basket-items-list-item-warning-container">
                <div class="alert alert-warning">
                    <?=Loc::getMessage('SBB_BASKET_ITEM_DELAYED')?>
                    <a href="javascript:void(0)" data-entity="basket-item-remove-delayed">
                        <?=Loc::getMessage('SBB_BASKET_ITEM_REMOVE_DELAYED')?>
                    </a>
                </div>
            </div>
            {{/DELAYED}}


        </div>
        <div class="delete-button-container desktop-delete-btn">
            <button class="delete-item-btn" data-entity="basket-item-delete" title="Удалить из корзины">
                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M24.4346 11.4092L22.082 26.5762L22.0166 27H9.68945L9.62305 26.5762L7.27051 11.4092L8.25879 11.2568L10.5459 26H21.1592L23.4463 11.2568L24.4346 11.4092ZM19.1172 5.33008L20.291 8.58301H26V9.58301H6V8.58301H11.7783L11.7178 8.55566L13.1914 5.29395L13.3242 5H18.998L19.1172 5.33008ZM12.8037 8.58301H19.2275L18.2959 6H13.9697L12.8037 8.58301Z" fill="black"/>
                </svg>
            </button>
        </div>
        {{/SHOW_RESTORE}}
    </div>
</script>