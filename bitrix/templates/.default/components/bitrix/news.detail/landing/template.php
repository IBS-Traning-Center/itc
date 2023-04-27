<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="news-detail">
<div class="social-share">
	<?$share_title=$arResult["PROPERTIES"]["TYPE"]["VALUE"]." '".$arResult["NAME"]."'";?>
	<a target="_blank" class="share-button facebook" href="https://www.facebook.com/dialog/feed?app_id=1421562351392582&link=<?=urlencode("http://www.luxoft-training.ru".$APPLICATION->GetCurDir())?>display=popup&caption=<?=rawurlencode(iconv("windows-1251", "UTF-8", "Luxoft Training: Курсы и тренинги для программистов, аналитиков, менеджеров проектов, тестировщиков"))?>&name=<?=rawurlencode(iconv("windows-1251", "UTF-8", $share_title))?>&picture=http://www.luxoft-training.ru/images/landing/new_logo_67.gif&redirect_uri=<?=urlencode("http://www.luxoft-training.ru".$APPLICATION->GetCurDir())?>"></a>
	<a target="_blank" class="share-button vkontakte" href="http://vkontakte.ru/share.php?&description=<?=rawurlencode(iconv("windows-1251", "UTF-8", "Luxoft Training: Курсы и тренинги для программистов, аналитиков, менеджеров проектов, тестировщиков."))?>&title=<?=rawurlencode(iconv("windows-1251", "UTF-8", $share_title))?>&url=<?=urlencode("http://www.luxoft-training.ru".$APPLICATION->GetCurDir())?>&noparse=false"></a>
	<a target="_blank" class="share-button twitter" href="https://twitter.com/share?&text=<?=rawurlencode(iconv("windows-1251", "UTF-8", $share_title))?>&url=<?=urlencode("http://www.luxoft-training.ru".$APPLICATION->GetCurDir())?>&redirect_uri=<?=urlencode("http://www.luxoft-training.ru".$APPLICATION->GetCurDir())?>"></a>
	<a target="_blank" class="share-button linkedin" href="http://www.linkedin.com/shareArticle?mini=true&url=<?=urlencode("http://www.luxoft-training.ru".$APPLICATION->GetCurDir())?>&title=<?=rawurlencode(iconv("windows-1251", "UTF-8", $share_title))?>&summary=<?=rawurlencode(iconv("windows-1251", "UTF-8", 'Luxoft Training: Курсы и тренинги для программистов, аналитиков, менеджеров проектов, тестировщиков.'))?>"></a>
	<a target="_blank" class="share-button plus" href="https://plus.google.com/share?url=<?=urlencode("http://www.luxoft-training.ru".$APPLICATION->GetCurDir())?>"></a>
</div>
	
	<a href="javascript:void(0)" class="up-btn" data-scroll="body"></a>
    <div class="menu-wrapper">
        <div class="landing-logo"><a href="/" target="_blank"><img alt="Luxoft-training" src="/images/logo_152.png"/></a></div>
       
	   <div class="reg-btn-right">
			<?if ($arResult["PROPERTIES"]["LANGUAGE"]["VALUE"]!="английский") {?>
				<a class="top-reg-btn reg-over"  rel="#overlay-form" href='javascript:void(0)'>ЗАРЕГИСТРИРОВАТЬСЯ</a>
			<?} else {?>
				<a class="top-reg-btn reg-over"  rel="#overlay-form" href='javascript:void(0)'>SIGN UP</a>
			<?}?>
        </div>
        <div class="top-menu-wrap">
			
            <a href="javascript:void(0)" data-scroll="#trener-info" class="menu-item">
                <span class="selected-line"></span>
                <?if ($arResult["PROPERTIES"]["LANGUAGE"]["VALUE"]!="английский") {?>Тренер<?} else {?>Speaker<?}?>
            </a>
            <a href="javascript:void(0)" data-scroll="#scroll-price" class="menu-item active">
                <span class="selected-line"></span>
                <?if ($arResult["PROPERTIES"]["LANGUAGE"]["VALUE"]!="английский") {?>Стоимость<?} else {?>Price<?}?>
			</a>
			<?if (count($arResult["REVIEW"])>0) {?>
			<a href="javascript:void(0)" data-scroll="#review-scroll" class="menu-item">
                <span class="selected-line"></span>
                 <?if ($arResult["PROPERTIES"]["LANGUAGE"]["VALUE"]!="английский") {?>Отзывы<?} else {?>Testimonials<?}?>
             </a>
			<?}?>
            <?if (strlen($arResult["PROPERTIES"]["VIDEO"]["VALUE"]["path"])>0) {?>
			<a href="javascript:void(0)" data-scroll="#video-scroll" class="menu-item">
                <span class="selected-line"></span>
                 <?if ($arResult["PROPERTIES"]["LANGUAGE"]["VALUE"]!="английский") {?>Видео<?} else {?>Video<?}?>
             </a>
			 <?}?>
			 <a href="javascript:void(0)" data-scroll="#program-scroll" class="menu-item">
                <span class="selected-line"></span>
                <?if ($arResult["PROPERTIES"]["LANGUAGE"]["VALUE"]!="английский") {?>Программа<?} else {?>Roadmap<?}?>
			</a>
             <a href="javascript:void(0)" data-scroll="#partners-scroll" class="menu-item">
                 <span class="selected-line"></span>
                <?if ($arResult["PROPERTIES"]["LANGUAGE"]["VALUE"]!="английский") {?>Партнеры<?} else {?>Partners<?}?>
             </a>
            <a href="javascript:void(0)" data-scroll="#map-scroll" class="menu-item">
                <span class="selected-line"></span>
               <?if ($arResult["PROPERTIES"]["LANGUAGE"]["VALUE"]!="английский") {?>Контакты<?} else {?>Contacts<?}?>
            </a>
        </div>
    </div>
    <div id="top" class="top-part">
         <div id="maximage">
            <img class="detail_picture" border="0" src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" style="width: <?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>px; height:  <?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>px;" width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>" height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>" alt="<?=$arResult["NAME"]?>"  title="<?=$arResult["NAME"]?>" />
        </div>
        <div  class="bg-bg">
        </div>
        <div class="main-info">
            <div class="info-content">
                <span class="h-info"><div class="left-thing"></div><?=$arResult["PROPERTIES"]["TYPE"]["VALUE"]?><div class="right-thing"></div></span>
                <h1><?=$arResult["NAME"]?></h1>
                <div class="datencity"><?=$arResult["PROPERTIES"]["DATE_N_PLACE"]["VALUE"]?></div>
				 <?if ($arResult["PROPERTIES"]["LANGUAGE"]["VALUE"]!="английский") {?>
                <a class="btn-reg reg-over"  rel="#overlay-form" title="Регистрация на <?=$arResult["PROPERTIES"]["TYPE"]["VALUE"]?>" href="javascript:void(0)">ЗАРЕГИСТРИРОВАТЬСЯ</a>
				<?} else {?>
				<a class="btn-reg reg-over"  rel="#overlay-form" title="Sign up for <?=$arResult["PROPERTIES"]["TYPE"]["VALUE"]?>" href="javascript:void(0)">SIGN UP</a>
				<?}?>
             </div>
        </div>
    </div>
    <div id="trener-info">
        <div class="trener-h">
            <h2> <?if ($arResult["PROPERTIES"]["LANGUAGE"]["VALUE"]!="английский") {?>Тренер<?} else {?>Speaker<?}?></h2>
        </div>
        <?=$arResult["DETAIL_TEXT"]?>
    </div>
	<div style="clear:both"></div>
	<br />
    <div id="about-scroll" class='about-gray'>
        <div id="about-wrap">
            <div class="trener-h"><h2><?if ($arResult["PROPERTIES"]["LANGUAGE"]["VALUE"]!="английский") {?>О ЧЁМ<?} else {?>DESCRIPTION<?}?></h2></div>
            <p>
               <?=$arResult["PREVIEW_TEXT"]?>
            </p>
        </div>
    </div>
	<?if (count($arResult["REASONS"])>0) {?>
    <div class="fv-rsns">
        <div class="rsns-head">
            <h2>
             <?if ($arResult["PROPERTIES"]["LANGUAGE"]["VALUE"]!="английский") {?>5 причин, почему нельзя пропускать это событие<?} else {?>5 reasons why you shouldn’t miss this event<?}?>
            </h2>
        </div>
		<div class="rsn-wrap">
			<?foreach ($arResult["REASONS"] as $arReason) {?>
				<div class="un-rsn">
					<div class="rsn-h">
						<?=$arReason["NAME"]?>
					</div>
					<div class="rsn-descr">
						<?=$arReason["PREVIEW_TEXT"]?>
					</div>
				</div>
			<?}?>
			<div style="clear:both"></div>
		</div>
    </div>
	<?}?>
	<div id="price-wrap" class="price-part">
         
		 <div id="maximage2">
            <img class="detail_picture" border="0" src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>" height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>" alt="<?=$arResult["NAME"]?>"  title="<?=$arResult["NAME"]?>" />
		</div>
		
		<div class="bg-bg">
        </div>
		<div id="scroll-price">
		</div>
		<?if ($arResult["PROPERTIES"]["CURRENCY"]["VALUE_ENUM_ID"]==199) {?>
			<?$valuta='<span class="alsrubl">o</span>'?>
		<?} else {?>
			<?$valuta='$'?>
		<?}?>
		<div class="price-info">
			<div class="price-wrap">
				<?if ($arResult["PROPERTIES"]["LANGUAGE"]["VALUE"]!="английский") {?>
				<div class="price-middle">
					<span class="h-info"><div class="left-thing"></div>СТОИМОСТЬ<div class="right-thing"></div></span>
				</div>
				<div class="price-count">
					<?=number_format($arResult["CURR_PRICE"], '0', '', ' ' )?><?=$valuta?>
					<?if (intval($arResult["PROPERTIES"]["TRANSLATION_PRICE"]["VALUE"])>0) {?>
									- <?=number_format($arResult["CURR_PRICE"]+$arResult["PROPERTIES"]["TRANSLATION_PRICE"]["VALUE"], '0', '', ' ' );?><span class="alsrubl">o</span> <span style="font-size: 22px;">(с переводом)</span>
					<?}?>
				</div>
				
				<div class="curr-date">
					<?=$arResult["CURR_DATE"]?>
				</div>
				<?} else {?>
				<div class="price-middle">
					<span class="h-info"><div class="left-thing"></div>PRICE<div class="right-thing"></div></span>
				</div>
				<div class="price-count">
					<?=number_format($arResult["CURR_PRICE"], '0', '', ' ' )?> UAH
					<?if (intval($arResult["PROPERTIES"]["TRANSLATION_PRICE"]["VALUE"])>0) {?>
									- <?=number_format($arResult["CURR_PRICE"]+$arResult["PROPERTIES"]["TRANSLATION_PRICE"]["VALUE"], '0', '', ' ' );?> UAH <span style="font-size: 22px;">(с переводом)</span>
					<?}?>
				</div>
				
				
				<?}?>
				<div class="line-prices">
					<?if ($arResult["PROPERTIES"]["LANGUAGE"]["VALUE"]!="английский") {?>
					<div class="main-line">
					<?if ($arResult["ETAPS_COUNT"]==4) {?>
						<div class="start-place place" style="left:0%; width: 25%">
						<div class="cut">
							<div class="date-prog"><?=FormatDate("j F", strtotime($arResult["PROPERTIES"]["START_DATE"]["VALUE"]))?></div>
						</div>
						<div class="price-down">
								<?=number_format($arResult["PROPERTIES"]["FIRST_PRICE"]["VALUE"], '0', '', ' ' );?><span class="alsrubl">o</span>
								
						</div>
						<?if ($arResult["CURR_ETAP"]==1) {?><div class="flag-current" style="left: <?=$arResult["CURRENT_PERCENT"]?>%"></div><?}?>
						</div>
						<div class="second-place place" style="left:25%; width: 25%">
							<div class="cut">
								<div class="date-prog"><?=FormatDate("j F", strtotime($arResult["PROPERTIES"]["SECOND_DATE"]["VALUE"]))?></div>
							</div>
							<div class="price-down">
								<?=number_format($arResult["PROPERTIES"]["SECOND_PRICE"]["VALUE"], '0', '', ' ' );?><?=$valuta?>
							</div>
							<?if ($arResult["CURR_ETAP"]==2) {?><div class="flag-current" style="left: <?=$arResult["CURRENT_PERCENT"]?>%"></div><?}?>
						</div>
						<div class="third-place place" style="left:50%;  width: 25%">
							<div class="cut">
								<div class="date-prog"><?=FormatDate("j F", strtotime($arResult["PROPERTIES"]["THIRD_DATE"]["VALUE"]))?></div>
							</div>
							<div class="price-down">
								<?=number_format($arResult["PROPERTIES"]["THIRD_PRICE"]["VALUE"], '0', '', ' ' );?><?=$valuta?>
							</div>
							<?if ($arResult["CURR_ETAP"]==3) {?><div class="flag-current" style="left: <?=$arResult["CURRENT_PERCENT"]?>%"></div><?}?>
						</div>
						<div class="fourth-place place" style="left:75%; width: 25%">
							<div class="cut">
								<div class="date-prog"><?=FormatDate("j F", strtotime($arResult["PROPERTIES"]["FOURTH_DATE"]["VALUE"]))?></div>
							</div>
							<div class="price-down">
								<?=number_format($arResult["PROPERTIES"]["FOURTH_PRICE"]["VALUE"], '0', '', ' ' );?><?=$valuta?>
							</div>
							<?if ($arResult["CURR_ETAP"]==4) {?><div class="flag-current" style="left: <?=$arResult["CURRENT_PERCENT"]?>%"></div><?}?>
						</div>
						<div class="last-place place" style="right:2px;">
							<div class="cut">
								<div class="date-prog"><?=FormatDate("j F", strtotime($arResult["PROPERTIES"]["FIFTH_DATE"]["VALUE"]))?></div>
							</div>
						</div>
					<?} elseif ($arResult["ETAPS_COUNT"]==3) {?>
						<div class="start-place place" style="left:0%; width: 33%">
						<div class="cut">
							<div class="date-prog"><?=FormatDate("j F", strtotime($arResult["PROPERTIES"]["START_DATE"]["VALUE"]))?></div>
						</div>
						<div class="price-down">
								<?=number_format($arResult["PROPERTIES"]["FIRST_PRICE"]["VALUE"], '0', '', ' ' );?><?=$valuta?>
								<?if (intval($arResult["PROPERTIES"]["TRANSLATION_PRICE"]["VALUE"])>0) {?>
									- <?=number_format($arResult["PROPERTIES"]["FIRST_PRICE"]["VALUE"]+$arResult["PROPERTIES"]["TRANSLATION_PRICE"]["VALUE"], '0', '', ' ' );?><span class="alsrubl">o</span> <span style="font-size: 10px;">(с переводом)</span>
								<?}?>
						</div>
						<?if ($arResult["CURR_ETAP"]==1) {?><div class="flag-current" style="left: <?=$arResult["CURRENT_PERCENT"]?>%"></div><?}?>
						</div>
						<div class="second-place place" style="left:33%; width: 34%">
							<div class="cut">
								<div class="date-prog"><?=FormatDate("j F", strtotime($arResult["PROPERTIES"]["SECOND_DATE"]["VALUE"]))?></div>
							</div>
							<div class="price-down">
								<?=number_format($arResult["PROPERTIES"]["SECOND_PRICE"]["VALUE"], '0', '', ' ' );?><?=$valuta?>
								<?if (intval($arResult["PROPERTIES"]["TRANSLATION_PRICE"]["VALUE"])>0) {?>
									- <?=number_format($arResult["PROPERTIES"]["SECOND_PRICE"]["VALUE"]+$arResult["PROPERTIES"]["TRANSLATION_PRICE"]["VALUE"], '0', '', ' ' );?><span class="alsrubl">o</span> <span style="font-size: 10px;">(с переводом)</span>
								<?}?>
							</div>
							<?if ($arResult["CURR_ETAP"]==2) {?><div class="flag-current" style="left: <?=$arResult["CURRENT_PERCENT"]?>%"></div><?}?>
						</div>
						<div class="third-place place" style="left:67%;  width: 33%">
							<div class="cut">
								<div class="date-prog"><?=FormatDate("j F", strtotime($arResult["PROPERTIES"]["THIRD_DATE"]["VALUE"]))?></div>
							</div>
							<div class="price-down">
								<?=number_format($arResult["PROPERTIES"]["THIRD_PRICE"]["VALUE"], '0', '', ' ' );?><?=$valuta?>
								<?if (intval($arResult["PROPERTIES"]["TRANSLATION_PRICE"]["VALUE"])>0) {?>
									- <?=number_format($arResult["PROPERTIES"]["THIRD_PRICE"]["VALUE"]+$arResult["PROPERTIES"]["TRANSLATION_PRICE"]["VALUE"], '0', '', ' ' );?><span class="alsrubl">o</span> <span style="font-size: 10px;">(с переводом)</span>
								<?}?>
							</div>
							<?if ($arResult["CURR_ETAP"]==3) {?><div class="flag-current" style="left: <?=$arResult["CURRENT_PERCENT"]?>%"></div><?}?>
						</div>
						<div class="fourth-place place" style="right:2px;">
							<div class="cut">
								<div class="date-prog"><?=FormatDate("j F", strtotime($arResult["PROPERTIES"]["FOURTH_DATE"]["VALUE"]))?></div>
							</div>
						</div>

					<?} elseif ($arResult["ETAPS_COUNT"]==2) {?>
						<div class="start-place place" style="left:0%; width: 50%">
						<div class="cut">
							<div class="date-prog"><?=FormatDate("j F", strtotime($arResult["PROPERTIES"]["START_DATE"]["VALUE"]))?></div>
						</div>
						<div class="price-down">
								<?=number_format($arResult["PROPERTIES"]["FIRST_PRICE"]["VALUE"], '0', '', ' ' );?><?=$valuta?>
						</div>
						<?if ($arResult["CURR_ETAP"]==1) {?><div class="flag-current" style="left: <?=$arResult["CURRENT_PERCENT"]?>%"></div><?}?>
						</div>
						<div class="second-place place" style="left:50%; width: 50%">
							<div class="cut">
								<div class="date-prog"><?=FormatDate("j F", strtotime($arResult["PROPERTIES"]["SECOND_DATE"]["VALUE"]))?></div>
							</div>
							<div class="price-down">
								<?=number_format($arResult["PROPERTIES"]["SECOND_PRICE"]["VALUE"], '0', '', ' ' );?><?=$valuta?>
							</div>
							<?if ($arResult["CURR_ETAP"]==2) {?><div class="flag-current" style="left: <?=$arResult["CURRENT_PERCENT"]?>%"></div><?}?>
						</div>
						<div class="third-place place" style="right:2px;">
							<div class="cut">
								<div class="date-prog"><?=FormatDate("j F", strtotime($arResult["PROPERTIES"]["THIRD_DATE"]["VALUE"]))?></div>
							</div>
						</div>

					<?} elseif ($arResult["ETAPS_COUNT"]==1) {?>
						
						<div class="start-place place" style="left:0; width: 100%">
						<div class="cut">
							<div class="date-prog"><?=FormatDate("j F", strtotime($arResult["PROPERTIES"]["START_DATE"]["VALUE"]))?></div>
						</div>
						<div class="price-down">
								<?=number_format($arResult["PROPERTIES"]["FIRST_PRICE"]["VALUE"], '0', '', ' ' );?><?=$valuta?>
						</div>
						<?if ($arResult["CURR_ETAP"]==1) {?><div class="flag-current" style="left: <?=$arResult["CURRENT_PERCENT"]?>%"></div><?}?>
						</div>
						<div class="second-place place" style="right: 2px;">
							<div class="cut">
								<div class="date-prog"><?=FormatDate("j F", strtotime($arResult["PROPERTIES"]["SECOND_DATE"]["VALUE"]))?></div>
							</div>
						</div>
						
					<?}?>
					</div>
					<?} else {?>
						<div class="main-line">
						<?if ($arResult["ETAPS_COUNT"]==2) {?>
						<div class="start-place place" style="left:0%; width: 50%">
						<div class="cut">
							<div class="date-prog"><?=Date("j F", strtotime($arResult["PROPERTIES"]["START_DATE"]["VALUE"]))?></div>
						</div>
						<div class="price-down">
								<?=number_format($arResult["PROPERTIES"]["FIRST_PRICE"]["VALUE"], '0', '', ' ' );?> UAH
						</div>
						<?if ($arResult["CURR_ETAP"]==1) {?><div class="flag-current" style="left: <?=$arResult["CURRENT_PERCENT"]?>%"></div><?}?>
						</div>
						<div class="second-place place" style="left:50%; width: 50%">
							<div class="cut">
								<div class="date-prog"><?=Date("j F", strtotime($arResult["PROPERTIES"]["SECOND_DATE"]["VALUE"]))?></div>
							</div>
							<div class="price-down">
								<?=number_format($arResult["PROPERTIES"]["SECOND_PRICE"]["VALUE"], '0', '', ' ' );?> UAH
							</div>
							<?if ($arResult["CURR_ETAP"]==2) {?><div class="flag-current" style="left: <?=$arResult["CURRENT_PERCENT"]?>%"></div><?}?>
						</div>
						<div class="third-place place" style="right:2px;">
							<div class="cut">
								<div class="date-prog"><?=Date("j F", strtotime($arResult["PROPERTIES"]["THIRD_DATE"]["VALUE"]))?></div>
							</div>
						</div>
						<?}?>
						</div>
					<?}?>
				</div>
				<div class="btn-price-reg">
					<a class="reg-over" rel="#overlay-form" href="javascript:void(0)"><?if ($arResult["PROPERTIES"]["LANGUAGE"]["VALUE"]!="английский") {?>ЗАРЕГИСТРИРОВАТЬСЯ СЕЙЧАС<?} else {?>SIGN UP<?}?></a>
				</div>
				<?/*
				<div class="img-pay-system">
					<img src="/images/landing/pay-systems.png" alt="pay-system">
				</div>*/?>
				<div class="bonuses">
					<?if ($arResult["PROPERTIES"]["LANGUAGE"]["VALUE"]!="английский") {?>
						<div class="bonus-h">БОНУСЫ УЧАСТНИКАМ:</div>
					<?} else {?>
						<div class="bonus-h">BONUSES:</div>
					<?}?>
					<div class="bonus-list" style="text-align: center;">
						<?if ($arResult["PROPERTIES"]["FARATA_CERT"]["VALUE"]=="Да") {?>
						<div class="bonus-item first">
							<img src="/images/landing/bonus-cert.png"/>
							<div class="bonus-text">Именной сертификат Farata Systems</div>
							<div style="clear:both"></div>
						</div>
						<?}?>
						<?if ($arResult["PROPERTIES"]["LUXOFT_CERT"]["VALUE"]=="Да") {?>
						
						<div class="bonus-item <?if ($arResult["PROPERTIES"]["FARATA_CERT"]["VALUE"]!="Да") {?>first<?}?>">
							<img src="/images/landing/bonus-cert.png"/>
							<div class="bonus-text" ><?if ($arResult["PROPERTIES"]["LANGUAGE"]["VALUE"]!="английский") {?>Именной сертификат Luxoft-Training<?} else {?>Diploma about graduation<?}?></div>
							<div style="clear:both"></div>
						</div>

						<?}?>
						<?if ($arResult["PROPERTIES"]["CERT"]["VALUE"]=="Да") {?>
						<div class="bonus-item <?if ($arResult["PROPERTIES"]["FARATA_CERT"]["VALUE"]!="Да") {?>first<?}?>">
							<img src="/images/landing/bonus-cert.png"/>
							<div class="bonus-text" >Именной сертификат</div>
							<div style="clear:both"></div>
						</div>
						<?}?>
						<?if ($arResult["PROPERTIES"]["GERRARD_CERT"]["VALUE"]=="Да") {?>
						<div class="bonus-item ">
							<img src="/images/landing/bonus-cert.png"/>
							<div class="bonus-text" >Сертификат Gerrard Consulting</div>
							<div style="clear:both"></div>
						</div>
						<?}?>
						<?if ($arResult["PROPERTIES"]["BOOK_PRESENT"]["VALUE"]=="Да") {?>
						<div class="bonus-item">
							<img src="/images/landing/book.png"/>
							<div class="bonus-text" >Первым пяти участникам - книга в подарок</div>
							<div style="clear:both"></div>
						</div>
						<?}?>
						<?if ($arResult["PROPERTIES"]["GIFT"]["VALUE"]=="Да") {?>
						<div class="bonus-item">
							<img src="/images/landing/gift.png"/>
							<div class="bonus-text" >Полезный подарок</div>
							<div style="clear:both"></div>
						</div>
						<?}?>
						<?if ($arResult["PROPERTIES"]["BOOK"]["VALUE"]=="Да") {?>
						<div class="bonus-item">
							<img src="/images/landing/book.png"/>
							<div class="bonus-text" ><?if ($arResult["PROPERTIES"]["LANGUAGE"]["VALUE"]!="английский") {?>Тематическая книга<?} else {?>Useful knowledge & practical experience<?}?></div>
							<div style="clear:both"></div>
						</div>
						<?}?>
						<?if ($arResult["PROPERTIES"]["PDF"]["VALUE"]=="Да") {?>
						<div class="bonus-item">
							<img src="/images/landing/pdf.png"/>
							<div class="bonus-text" ><?if ($arResult["PROPERTIES"]["LANGUAGE"]["VALUE"]!="английский") {?>Презентация спикера<?} else {?>Shared training materials<?}?></div>
							<div style="clear:both"></div>
						</div>
						<?}?>
						<?if ($arResult["PROPERTIES"]["MOVIE"]["VALUE"]=="Да") {?>
						<div class="bonus-item">
							<img src="/images/landing/video-play.png"/>
							<div class="bonus-text" style="width: 95px;">Видеозапись<br/> тренинга</div>
							<div style="clear:both"></div>
						</div>
						<?}?>
					</div>
					<div class="clear:both"></div>
				</div> 
			</div>
		</div>
	</div>
	<?if (count($arResult["REVIEW"])>0) {?>
		<div id="review-scroll" class="video-wrapper">
		<div class='video-h'>
			<h2>Отзывы</h2>
		</div>
		<div class="review-wrap">
		<?foreach ($arResult["REVIEW"] as $arReview) {?>
			<div class="review-item">
				<div class="review-head">
					<?=$arReview["NAME"]?> <?=$arReview["SURNAME"]?> 
				</div>
				<div class="review-body">
					<?=$arReview["REVIEW_TEXT"]?>
				</div>
			</div>
		<?}?>
		</div>
		</div>
	<?}?>
	<?if (strlen($arResult["PROPERTIES"]["VIDEO"]["VALUE"]["path"])>0) {?>
	<div id="video-scroll" class="video-wrapper">
		<div class='video-h'>
			<h2>Видео</h2>
		</div>
		<div class="mc-player">
		<iframe width="100%" height="500" src="<?=$arResult["PROPERTIES"]["VIDEO"]["VALUE"]["path"]?>" frameborder="0" allowfullscreen></iframe>
		<?/*$APPLICATION->IncludeComponent("bitrix:player", ".default", array(
	"PLAYER_TYPE" => "auto",
	"USE_PLAYLIST" => "N",
	"PATH" => $arResult["PROPERTIES"]["VIDEO"]["VALUE"]["path"],
	"PROVIDER" => "youtube",
	"STREAMER" => "",
	"WIDTH" => "855",
	"HEIGHT" => "510",
	"PREVIEW" => "",
	"FILE_TITLE" => "",
	"FILE_DURATION" => "",
	"FILE_AUTHOR" => "",
	"FILE_DATE" => "",
	"FILE_DESCRIPTION" => "",
	"SKIN_PATH" => "/bitrix/components/bitrix/player/mediaplayer/skins",
	"SKIN" => "bekle.zip",
	"CONTROLBAR" => "bottom",
	"WMODE" => "transparent",
	"LOGO" => "",
	"LOGO_LINK" => "",
	"LOGO_POSITION" => "none",
	"WMODE_WMV" => "window",
	"SHOW_CONTROLS" => "Y",
	"SHOW_DIGITS" => "Y",
	"CONTROLS_BGCOLOR" => "FFFFFF",
	"CONTROLS_COLOR" => "000000",
	"CONTROLS_OVER_COLOR" => "000000",
	"SCREEN_COLOR" => "000000",
	"AUTOSTART" => "N",
	"REPEAT" => "list",
	"VOLUME" => "90",
	"MUTE" => "N",
	"PLUGINS" => array(
		0 => "",
		1 => "",
	),
	"ADDITIONAL_FLASHVARS" => "",
	"ADVANCED_MODE_SETTINGS" => "Y",
	"PLAYER_ID" => "",
	"BUFFER_LENGTH" => "10",
	"DOWNLOAD_LINK" => "",
	"DOWNLOAD_LINK_TARGET" => "_self",
	"ADDITIONAL_WMVVARS" => "",
	"ALLOW_SWF" => "Y"
	),
	false
);*/?>
	</div>
	</div>
	<?}?>
	<div id="program-scroll" class="course-information-gray">
		<div class="course-center-wrap">
			<div class="course-inform-h">
				<h2><?if ($arResult["PROPERTIES"]["LANGUAGE"]["VALUE"]!="английский") {?>ПРОГРАММА ТРЕНИНГА<?} else {?>Roadmap<?}?></h2>
			</div>
			<?if (strlen($arResult["PROPERTIES"]["PROGRAM"]["VALUE"]["TEXT"])>0) {?>
				<div class="descr-wrap">
					<?=htmlspecialchars_decode($arResult["PROPERTIES"]["PROGRAM"]["VALUE"]["TEXT"])?>
				</div>
			<?}?>
			<?if (strlen($arResult["COURSE"]["course_topics"])>0) {?>
				<?if ($arResult["PROPERTIES"]["LANGUAGE"]["VALUE"]!="английский") {?><h3>Разбираемые темы:</h3><?} else {?><?}?>
				<?if ($arResult["PROPERTIES"]["LANGUAGE"]["VALUE"]!="английский") {?>
				<div class="descr-wrap">
					<?=$arResult["COURSE"]["course_topics"]?>
				</div>
				<?}?>
			<?}?>
			
		</div>
	</div>
</div>
<div id="partners-scroll" class="partners-wrap">
	<div class="partners-h">
		<?if ($arResult["PROPERTIES"]["LANGUAGE"]["VALUE"]!="английский") {?><h2>Партнеры</h2><?} else {?><h2>Partners</h2><?}?>
	</div>
	<div class='partners-list'>
		<?$k=0?>
		<?foreach ($arResult["PARTNERS"] as $arPartner) {?>
			<div class="partner-item-wrapper <?if ($k==0) {?> first<?}?>">
				<div class="partner-item">
					<?if (strlen($arPartner["LINK"])>0) {?>
						<a href="<?=$arPartner["LINK"]?>">
					<?}?>
					<img src="<?=$arPartner["PREVIEW_PICTURE"]["SRC"]?>" title="<?=$arPartner["NAME"]?>" />
					<?if (strlen($arPartner["LINK"])>0) {?>
					</a>
					<?}?>
				</div>
			</div>
			<?$k++?>
			<?if ($k==3) {?>
				<?$k=0?>
			<?}?>
		<?}?>
	<div style="clear:both"></div>
	</div>
	<div class="partner-btn">
		<a href="javascript: void(0)" rel="#overlay-partner" class="bcm-prtnr"><?if ($arResult["PROPERTIES"]["LANGUAGE"]["VALUE"]!="английский") {?>СТАТЬ ПАРТНЕРОМ<?} else {?>Become a partner<?}?></a>
	</div>
	
</div>

<script>
    $(function(){
		setInterval(fn_checkcoord, 100);
		$('.share-button').click(function(){
										
										window.open($(this).attr('href'),
										"",
										"width="+600+",height="+387+",toolbar=no,left="+600+",top="+387);
										return false;
									});
       $('.menu-item').click(function(){
           obj=$(this).attr('data-scroll');
          
           var offset = $(obj).offset();
		   ;
           $('html, body').animate({scrollTop: offset.top-89}, 1000);
		   //console.info(offset.top)
           //console.info($(document).scrollTop()+" - "+offset.top);
       });
	   $('.up-btn').click(function(){
           obj=$(this).attr('data-scroll');
           //alert(obj);
           var offset = $(obj).offset();
           $('html, body').scrollTo(offset.top-89, 800);
           //console.info($(document).scrollTop()+" - "+offset.top);
       });
	   $('.bcm-prtnr').overlay({
		mask: {
			color: '#000',
			loadSpeed: 200,
			opacity: 0.5
		},
	   });
	   $('.reg-over').overlay({
		top: 10,
		mask: {
			color: '#000',
			
			loadSpeed: 200,
			opacity: 0.5
		},
	   });
    });
    function fn_checkcoord() {
		
		var offset = $('#about-wrap').offset();
		if (offset.left>0) {
			var left=offset.left+990;
		} else {
			left = 990;
		}
		//$('.up-btn').css('left', left+"px");
		$('.menu-item').each(function() {
            obj=$(this).attr('data-scroll');
            first=$('.menu-item:first').attr('data-scroll');
			last=$('.menu-item:last').attr('data-scroll');
            //console.info(obj);
            firstoff=$(first).offset();
            //console.info(firstoff.top);
            if (!!obj) {
                var offset = $(obj).offset();
                if ($(document).scrollTop()>offset.top-90) {
					$('.up-btn').fadeIn();
                    $('.menu-item').removeClass('active');
					if ($(document).scrollTop()+$(window).height() >= $(document).height() - 50) {
						 $('.menu-item').removeClass('active');
						 $('.menu-item:last').addClass('active');
					} else {
						$(this).addClass('active');
						//console.info($(document).scrollTop()+$(window).height());
						//console.info($(document).height());
					}
                } else if ($(document).scrollTop()<firstoff.top-90){
                    $('.menu-item').removeClass('active');
					$('.up-btn').fadeOut();
                }
            }
        });
    }
</script>