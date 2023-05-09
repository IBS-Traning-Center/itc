<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="news-detail">
<div class="social-share">
	<?$share_title=$arResult["PROPERTIES"]["TYPE"]["VALUE"]." '".$arResult["NAME"]."'";?>
	<a target="_blank" class="share-button facebook" href="https://www.facebook.com/dialog/feed?app_id=1421562351392582&link=<?=urlencode("http://www.luxoft-training.com".$APPLICATION->GetCurDir())?>display=popup&caption=<?=rawurlencode($arResult["DETAIL_TEXT"])?>&name=<?=rawurlencode($share_title)?>&picture=http://www.luxoft-training.ru/images/landing/new_logo_67.gif&redirect_uri=<?=urlencode("http://www.luxoft-training.ru".$APPLICATION->GetCurDir())?>"></a>
	<a target="_blank" class="share-button vkontakte" href="http://vkontakte.ru/share.php?&description=<?=rawurlencode($arResult["DETAIL_TEXT"])?>&title=<?=rawurlencode($share_title)?>&url=<?=urlencode("http://www.luxoft-training.com".$APPLICATION->GetCurDir())?>&noparse=false"></a>
	<a target="_blank" class="share-button twitter" href="https://twitter.com/share?&text=<?=rawurlencode($share_title)?>&url=<?=urlencode("http://www.luxoft-training.ru".$APPLICATION->GetCurDir())?>&redirect_uri=<?=urlencode("http://www.luxoft-training.com".$APPLICATION->GetCurDir())?>"></a>
	<a target="_blank" class="share-button linkedin" href="http://www.linkedin.com/shareArticle?mini=true&url=<?=urlencode("http://www.luxoft-training.com".$APPLICATION->GetCurDir())?>&title=<?=rawurlencode($share_title)?>&summary=<?=rawurlencode('Luxoft Training: Курсы и тренинги для программистов, аналитиков, менеджеров проектов, тестировщиков.')?>"></a>
	<a target="_blank" class="share-button plus" href="https://plus.google.com/share?url=<?=urlencode("http://www.luxoft-training.com".$APPLICATION->GetCurDir())?>"></a>
</div>
	<a href="javascript:void(0)" class="up-btn" data-scroll="body"></a>
    <div class="menu-wrapper">
        <div class="landing-logo"><a href="/" target="_blank"><img alt="Luxoft-training" src="/images/landing/logo_landing.png"/></a></div>
        <div class="reg-btn-right">
            <a class="top-reg-btn reg-over"  rel="#overlay-form" href='javascript:void(0)'>Sing Up</a>
        </div>
        <div class="top-menu-wrap">
            <a href="javascript:void(0)" data-scroll="#trener-info" class="menu-item">
                <span class="selected-line"></span>
                Speaker
            </a>
            <a href="javascript:void(0)" data-scroll="#scroll-price" class="menu-item active">
                <span class="selected-line"></span>
               Price
			</a>
			<?if (count($arResult["REVIEW"])>0) {?>
			<a href="javascript:void(0)" data-scroll="#review-scroll" class="menu-item">
                <span class="selected-line"></span>
                Testimonials
             </a>
			<?}?>
            <?if (strlen($arResult["PROPERTIES"]["VIDEO"]["VALUE"]["path"])>0) {?>
			<a href="javascript:void(0)" data-scroll="#video-scroll" class="menu-item">
                <span class="selected-line"></span>
                Video
             </a>
			 <?}?>
			 
			 <a href="javascript:void(0)" data-scroll="#program-scroll" class="menu-item">
                <span class="selected-line"></span>
               Programm
			</a>
			<?/*
             <a href="javascript:void(0)" data-scroll="#partners-scroll" class="menu-item">
                 <span class="selected-line"></span>
                Partners
             </a>*/?>
            <a href="javascript:void(0)" data-scroll="#map-scroll" class="menu-item">
                <span class="selected-line"></span>
               Contacts
            </a>
        </div>
    </div>
    <div id="top" class="top-part">
         <div id="maximage">
            <img class="detail_picture" border="0" src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" style="width: <?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>px; height:  <?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>px;" width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>" height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>" alt="<?=$arResult["NAME"]?>"  title="<?=$arResult["NAME"]?>" />
        </div>
        <div class="bg-bg">
        </div>
        <div class="main-info">
            <div class="info-content">
                <span class="h-info"><div class="left-thing"></div><?=$arResult["PROPERTIES"]["TYPE"]["VALUE"]?><div class="right-thing"></div></span>
                <h1><?=$arResult["NAME"]?></h1>
                <div class="datencity"><?=$arResult["PROPERTIES"]["DATE_N_PLACE"]["VALUE"]?></div>
                <a class="btn-reg reg-over"  rel="#overlay-form" title="Sing up to <?=$arResult["PROPERTIES"]["TYPE"]["VALUE"]?>" href="javascript:void(0)">Sign Up</a>
             </div>
        </div>
    </div>
    <div id="trener-info">
        <div class="trener-h">
            <h2>Speaker</h2>
        </div>
		<div class="trener-section"> 
  <div class="trener-right"> <img src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>" title="" alt=""> </div>
 
  <div class="trener-left"> 
    <?=$arResult["DETAIL_TEXT"]?>
   </div>
   <div style="clear:both"></div>
 </div>
       <div class="trener-section"> 
  <div class="trener-right"> </div>
 
  <div class="trener-left"> 
	<h3>Blog</h3>
    <a href="<?=$arResult["PROPERTIES"]["BLOG"]["VALUE"]?>"><?=$arResult["PROPERTIES"]["BLOG"]["VALUE"]?></a>
   </div>
   <div style="clear:both"></div>
 </div>
    </div>
	<div style="clear:both"></div>
	<br />
    <div id="about-scroll" class='about-gray'>
        <div id="about-wrap">
            <div class="trener-h"><h2>About</h2></div>
            <p>
               <?=$arResult["PREVIEW_TEXT"]?>
            </p>
        </div>
    </div>
	<?if (count($arResult["REASONS"])>0) {?>
    <div class="fv-rsns">
        <div class="rsns-head">
            <h2>
                3 reasons to come
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
			<?$valuta=' EUR'?>
		<?}?>
		<div class="price-info">
			<div class="price-wrap">
				<div class="price-middle">
					<span class="h-info"><div class="left-thing"></div>PRICE<div class="right-thing"></div></span>
				</div>
				<div class="price-count">
					<?=number_format($arResult["PROPERTIES"]["PRICE"]["VALUE"], '0', '', ' ' )?><?=$valuta?>
				</div>
			
				<div class="btn-price-reg">
					<a class="reg-over" rel="#overlay-form" href="javascript:void(0)">SING UP</a>
				</div>
				<div class="img-pay-system">
					<img src="/images/landing/pay-systems.png" alt="pay-system">
				</div>
				<div class="bonuses">
					<div class="bonus-h">5% - 2 or more participants from the same company</div>
				</div>
				<?/*<div class="bonuses">
					<div class="bonus-h">БОНУСЫ УЧАСТНИКАМ:</div>
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
							<div class="bonus-text" >Именной сертификат Luxoft-Training</div>
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
						<?if ($arResult["PROPERTIES"]["BOOK_PRESENT"]["VALUE"]=="Да") {?>
						<div class="bonus-item">
							<img src="/images/landing/book.png"/>
							<div class="bonus-text" >Первым пяти участникам - книга в подарок.</div>
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
							<div class="bonus-text" >Тематическая книга</div>
							<div style="clear:both"></div>
						</div>
						<?}?>
						<?if ($arResult["PROPERTIES"]["PDF"]["VALUE"]=="Да") {?>
						<div class="bonus-item">
							<img src="/images/landing/pdf.png"/>
							<div class="bonus-text" >Презентация спикера</div>
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
				<?*/?>
			</div>
			
		</div>
	</div>
	<?if (count($arResult["REVIEW"])>0) {?>
		<div id="review-scroll" class="video-wrapper">
		<div class='video-h'>
			<h2>TESTIMONIALS</h2>
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
		<?$APPLICATION->IncludeComponent("bitrix:player", ".default", array(
	"PLAYER_TYPE" => "auto",
	"USE_PLAYLIST" => "N",
	"PATH" => $arResult["PROPERTIES"]["VIDEO"]["VALUE"]["path"],
	"PROVIDER" => "video",
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
);?>
	</div>
	</div>
	<?}?>
	<div id="program-scroll" class="course-information-gray">
		<div class="course-center-wrap">
			<div class="course-inform-h">
				<h2>PROGRAMM</h2>
			</div>
			
			<?if (strlen($arResult["COURSE"]["course_topics"])>0) {?>
				<h3>Roadmap:</h3>
				<div class="descr-wrap">
					<?=$arResult["COURSE"]["course_topics"]?>
				</div>
			<?}?>
			
		</div>
	</div>
</div>
<?/*
<div id="partners-scroll" class="partners-wrap">
	<div class="partners-h">
		<h2>Партнеры</h2>
	</div>
	<div class='partners-list'>
		<?$k=0?>
		<?foreach ($arResult["PARTNERS"] as $arPartner) {?>
			<div class="partner-item-wrapper <?if ($k==0) {?> first<?}?>">
				<div class="partner-item">
					<img src="<?=$arPartner["PREVIEW_PICTURE"]["SRC"]?>" title="<?=$arPartner["NAME"]?>" />
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
		<a href="javascript: void(0)" rel="#overlay-partner" class="bcm-prtnr">СТАТЬ ПАРТНЕРОМ</a>
	</div>
	
</div>
<?*/?>
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
           //alert(obj);
           var offset = $(obj).offset();
           $('body').scrollTo(offset.top-89, 800);
           //console.info($(document).scrollTop()+" - "+offset.top);
       });
	   $('.up-btn').click(function(){
           obj=$(this).attr('data-scroll');
           //alert(obj);
           var offset = $(obj).offset();
           $('body').scrollTo(offset.top-89, 800);
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