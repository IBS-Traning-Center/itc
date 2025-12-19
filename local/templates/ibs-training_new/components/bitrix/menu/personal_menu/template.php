<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<?if (!empty($arResult)):?>
    <nav class="lk-menu">
        <?foreach ($arResult as $arItem):?>

            <?php
            $icon = $arItem['PARAMS']['ICON'] ?? null;
            $iconPath = $icon
                ? __DIR__ . '/images/' . $icon . '.svg'
                : null;
            ?>

            <?if ($arItem['SELECTED']):?>
                <div class="lk-menu__item is-active">
                <span class="lk-menu__icon">
                    <?if ($iconPath && file_exists($iconPath)) {
                        include $iconPath;
                    }?>
                </span>
                    <span class="lk-menu__text"><?=$arItem['TEXT']?></span>
                </div>
            <?else:?>
                <a href="<?=$arItem['LINK']?>" class="lk-menu__item">
                <span class="lk-menu__icon">
                    <?if ($iconPath && file_exists($iconPath)) {
                        include $iconPath;
                    }?>
                </span>
                    <span class="lk-menu__text"><?=$arItem['TEXT']?></span>
                </a>
            <?endif?>

        <?endforeach;?>
    </nav>
<?endif;?>
