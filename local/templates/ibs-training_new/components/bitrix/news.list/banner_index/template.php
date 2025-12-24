<?php if (!empty($arResult['ITEMS'][0]['DETAIL_PICTURE']['SRC'])): ?>
    <?php
    $bannerBg = $arResult['ITEMS'][0]['DETAIL_PICTURE']['SRC'];
    ?>
    <div class="ibs-banner">
        <div class="banner-background" style="background-image: linear-gradient(0deg, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('<?=$bannerBg?>');">
            <div class="banner-content">
                <div class="main-text">
                    <?=htmlspecialcharsbx($arResult['ITEMS'][0]['NAME'])?>
                </div>
                <a href="<?=$arResult['ITEMS'][0]['PROPERTIES']['LINK']['VALUE']?>" class="cta-button">
                    <div class="divider"></div>
                    <div class="cta-text">
                        <?=$arResult['ITEMS'][0]['PROPERTIES']['BUTTON']['VALUE'] ?>
                    </div>
                </a>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="ibs-banner">
        <div class="banner-background" style="background: linear-gradient(0deg, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), #333 center/cover no-repeat;">
            <div class="banner-content">
                <div class="main-text">
                    <?=htmlspecialcharsbx($arResult['ITEMS'][0]['NAME'])?>
                </div>

                <a href="<?=$arResult['ITEMS'][0]['PROPERTIES']['LINK']['VALUE']?>" class="cta-button">
                    <div class="divider"></div>
                    <div class="cta-text">
                        <?=$arResult['ITEMS'][0]['PROPERTIES']['BUTTON']['VALUE'] ?>
                    </div>
                </a>
            </div>
        </div>
    </div>
<?php endif; ?>
