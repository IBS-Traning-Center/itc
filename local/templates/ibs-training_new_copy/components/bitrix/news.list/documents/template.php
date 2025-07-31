<?php
/**
 * @var array $arResult
 */
if(count($arResult['ITEMS'])) {?>
    <div class="documents">
        <ol class="documents__list">
        <?php foreach ($arResult['ITEMS'] as $arItem) {?>
            <li class="documents__item">
                <a class="documents__link"
                    id="<?=$arItem['ID']?>"
                    href="<?=CFile::GetPath($arItem['PROPERTIES']['FILE']['VALUE'])?>"
                    target="_blank"
                ><?=!empty($arItem['PROPERTIES']['LONG_NAME']['VALUE'])
                        ? $arItem['PROPERTIES']['LONG_NAME']['VALUE']
                        :$arItem['NAME']?></a>;
            </li>
        <?php } ?>
        </ol>
    </div>
<?php }?>
<style>
    .documents__item {
        padding: 5px 0;
    }
</style>