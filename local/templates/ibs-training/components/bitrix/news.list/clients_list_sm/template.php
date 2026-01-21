<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="clients-wrap" style="border-bottom: 0; padding-bottom: 0;">
    <div class="client-list" style="width: 550px;">
        <a class="prev-client"></a>
        <a class="next-client"></a>
        <div class="client-slider" style="width: 550px;">
            <div class="items">
                <div class="client-section">
                <?$index = 0;?>
                <?foreach($arResult["ITEMS"] as $key=>$arItem):?>
                    <?if ($index==6) {?>
                        </div><div class="client-section">
                        <?$index=0?>
                    <?}?>
                <?//print_r($arItem['PROPERTIES']['otzyv']['VALUE'])?>
                <?$client_otzyv = nl2br($arItem['PROPERTIES']['otzyv']['VALUE']); ?>
                    <div class="client-item" style="width: 137px;">
                         <img  title="<?=$client_otzyv?>" src="<?=$arItem["SMALL_PICTURE"]["src"]?>" alt="<?=$arItem["NAME"]?>">
                    </div>
                 <?$index++?>

                <?endforeach;?>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$('document').ready(function() {
$(".client-slider").scrollable({next: '.next-client', prev: '.prev-client', circular: true}).autoscroll({ autoplay: true, interval: 10000 });
})
</script>



