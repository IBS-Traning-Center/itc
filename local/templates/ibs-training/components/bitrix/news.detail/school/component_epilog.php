</div>
</div>
<div id="footer">
    <p>&copy; <?= date('Y') ?> LUXOFT TRAINING</p>
</div>
<a href="#" class="top">top</a>
<ul class="social">
    <? $share_title = $arResult["NAME"]; ?>
    <li>
        <a class="vk" target="_blank" href="http://vkontakte.ru/share.php?&description=<?= rawurlencode(
            'Luxoft Training: Курсы и тренинги для программистов, аналитиков, менеджеров проектов, тестировщиков.'
        ) ?>&title=<?= rawurlencode($share_title) ?>&url=<?= urlencode(
            "http://www.luxoft-training.ru" . $APPLICATION->GetCurDir()
        ) ?>&noparse=false">vk</a>
    </li>
    <li>
        <a class="twitter" target="_blank" href="https://twitter.com/share?&text=<?= rawurlencode(
            $share_title
        ) ?>&url=<?= urlencode(
            "http://www.luxoft-training.ru" . $APPLICATION->GetCurDir()
        ) ?>&redirect_uri=<?= urlencode("http://www.luxoft-training.ru" . $APPLICATION->GetCurDir()) ?>"">twitter</a>
    </li>
    <li>
        <a class="linkedin" target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&url=<?= urlencode(
            "http://www.luxoft-training.ru" . $APPLICATION->GetCurDir()
        ) ?>&title=<?= rawurlencode($share_title) ?>&summary=<?= rawurlencode(
            'Luxoft Training: Курсы и тренинги для программистов, аналитиков, менеджеров проектов, тестировщиков.'
        ) ?>"">linkedin</a>
    </li>
    <li>
        <a class="google" target="_blank" href="https://www.youtube.com/user/LuxoftTrainingCenter/featured">google</a>
    </li>
</ul>
<?
$APPLICATION->SetTitle($arResult["NAME"]);
$APPLICATION->SetPageProperty("title", $arResult["NAME"]);
?>
