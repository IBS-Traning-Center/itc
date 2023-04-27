<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<script type="text/javascript" src="/bitrix/templates/en/js/highlight.pack.js"></script>
<!--<script type="text/javascript" src="http://softwaremaniacs.org/media/soft/highlight/highlight.pack.js"></script>
<script type="text/javascript" src="/bitrix/templates/en/js/mashajs/masha.min.js"></script>-->
<?
	$GLOBALS['APPLICATION']->AddHeadScript('/bitrix/templates/en/js/mashajs/masha.js');
	$GLOBALS['APPLICATION']->SetAdditionalCSS('/bitrix/templates/en/masha.css');
	$GLOBALS['APPLICATION']->AddHeadScript('/bitrix/templates/en/js/masha_start.js');
?>


<script type="text/javascript">
function getInternetExplorerVersion()
{
  var rv = -1; // Return value assumes failure.
  if (navigator.appName == 'Microsoft Internet Explorer')
  {
    var ua = navigator.userAgent;
    var re  = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
    if (re.exec(ua) != null)
      rv = parseFloat( RegExp.$1 );
  }
  return rv;
}
function checkVersion()
{
  var ver = getInternetExplorerVersion();
  if ( ver > -1 )
  {
    if ( ver >= 9.0 ) 
         $('div.blog-post-code pre').each(function(i, e) {hljs.highlightBlock(e, '    ')});
    else{
        $("div.blog-post-code pre").wrapInner("<code></code>");        
        $('div.blog-post-code pre').each(function(i, e) {hljs.highlightBlock(e, null, true)});
    }
  }
  else 
  {
    $('div.blog-post-code pre').each(function(i, e) {hljs.highlightBlock(e, '    ')});
  } 
}


  $(document).ready(function() {
    //MaSha.instance = new MaSha();
    hljs.tabReplace = '  ';
    //checkVersion();
    $("div.blog-post-code pre").wrapInner("<code></code>");   
        $('div.blog-post-code pre').each(function(i, e) {hljs.highlightBlock(e, '    ')});
    });
</script>


<?
if (!$this->__component->__parent || empty($this->__component->__parent->__name) || $this->__component->__parent->__name != "bitrix:blog"):
	$GLOBALS['APPLICATION']->SetAdditionalCSS('/bitrix/components/bitrix/blog/templates/.default/style.css');
	$GLOBALS['APPLICATION']->SetAdditionalCSS('/bitrix/components/bitrix/blog/templates/.default/themes/blue/style.css');
endif;
?>
<div id="upmsg-selectable">
    <div class="upmsg-selectable-inner">
        <img src="/bitrix/templates/en/images/textselect/upmsg_arrow.png" alt="">
        <p>Вы можете отметить интересные вам фрагменты текста, которые будут доступны по уникальной ссылке в адресной строке браузера.</p>
        <a href="#" class="upmsg_closebtn"></a>
    </div>
</div>
<div class="blog-post-current" id="selectable-content">
<?
if(strlen($arResult["MESSAGE"])>0)
{
	?>
	<div class="blog-textinfo blog-note-box">
		<div class="blog-textinfo-text">
			<?=$arResult["MESSAGE"]?>
		</div>
	</div>
	<?
}
if(strlen($arResult["ERROR_MESSAGE"])>0)
{
	?>
	<div class="blog-errors blog-note-box blog-note-error">
		<div class="blog-error-text">
			<?=$arResult["ERROR_MESSAGE"]?>
		</div>
	</div>
	<?
}
if(strlen($arResult["FATAL_MESSAGE"])>0)
{
	?>
	<div class="blog-errors blog-note-box blog-note-error">
		<div class="blog-error-text">
			<?=$arResult["FATAL_MESSAGE"]?>
		</div>
	</div>
	<?
}
elseif(strlen($arResult["NOTE_MESSAGE"])>0)
{
	?>
	<div class="blog-textinfo blog-note-box">
		<div class="blog-textinfo-text">
			<?=$arResult["NOTE_MESSAGE"]?>
		</div>
	</div>
	<?
}
else
{
	if(!empty($arResult["Post"])>0)
	{
		$className = "blog-post";
		$className .= " blog-post-first";
		$className .= " blog-post-alt";
		$className .= " blog-post-year-".$arResult["Post"]["DATE_PUBLISH_Y"];
		$className .= " blog-post-month-".IntVal($arResult["Post"]["DATE_PUBLISH_M"]);
		$className .= " blog-post-day-".IntVal($arResult["Post"]["DATE_PUBLISH_D"]);
		?>
		<div class="<?=$className?>">
		<h2 class="blog-post-title"><span><?=$arResult["Post"]["TITLE"]?></span></h2>
		<div class="blog-post-info-back blog-post-info-top">
		<div class="blog-post-info">
			<div class="blog-author">
			<?if($arParams["SEO_USER"] == "Y"):?>
				<noindex>
					<a class="blog-author-icon" href="<?=$arResult["urlToAuthor"]?>" rel="nofollow"></a>
				</noindex>
			<?else:?>
				<a class="blog-author-icon" href="<?=$arResult["urlToAuthor"]?>"></a>

			<?endif;?>
<span class="blog-tab-items">
				<a href="<?=$arBlog["urlToBlog"]?>rss/" title="" class="blog-rss-icon"></a>
			</span>
			<?
			if (COption::GetOptionString("blog", "allow_alias", "Y") == "Y" && array_key_exists("ALIAS", $arResult["BlogUser"]) && strlen($arResult["BlogUser"]["ALIAS"]) > 0)
				$arTmpUser = array(
					"NAME" => "",
					"LAST_NAME" => "",
					"SECOND_NAME" => "",
					"LOGIN" => "",
					"NAME_LIST_FORMATTED" => $arResult["BlogUser"]["~ALIAS"],
				);
			elseif (strlen($arResult["urlToBlog"]) > 0 || strlen($arResult["urlToAuthor"]) > 0)
					$arTmpUser = array(
						"NAME" => $arResult["arUser"]["~NAME"],
						"LAST_NAME" => $arResult["arUser"]["~LAST_NAME"],
						"SECOND_NAME" => $arResult["arUser"]["~SECOND_NAME"],
						"LOGIN" => $arResult["arUser"]["~LOGIN"],
						"NAME_LIST_FORMATTED" => "",
					);
			?>
			<?if($arParams["SEO_USER"] == "Y"):?>
				<noindex>
			<?endif;?>
			<?
			$APPLICATION->IncludeComponent("bitrix:main.user.link",
				'',
				array(
					"ID" => $arResult["arUser"]["ID"],
					"HTML_ID" => "blog_post_".$arResult["arUser"]["ID"],
					"NAME" => $arTmpUser["NAME"],
					"LAST_NAME" => $arTmpUser["LAST_NAME"],
					"SECOND_NAME" => $arTmpUser["SECOND_NAME"],
					"LOGIN" => $arTmpUser["LOGIN"],
					"NAME_LIST_FORMATTED" => $arTmpUser["NAME_LIST_FORMATTED"],
					"USE_THUMBNAIL_LIST" => "N",
					"PROFILE_URL" => $arResult["urlToAuthor"],
					"PROFILE_URL_LIST" => $arResult["urlToBlog"],
					"PATH_TO_SONET_MESSAGES_CHAT" => $arParams["~PATH_TO_MESSAGES_CHAT"],
					"PATH_TO_VIDEO_CALL" => $arParams["~PATH_TO_VIDEO_CALL"],
					"DATE_TIME_FORMAT" => $arParams["DATE_TIME_FORMAT"],
					"SHOW_YEAR" => $arParams["SHOW_YEAR"],
					"CACHE_TYPE" => $arParams["CACHE_TYPE"],
					"CACHE_TIME" => $arParams["CACHE_TIME"],
					"NAME_TEMPLATE" => $arParams["NAME_TEMPLATE"],
					"SHOW_LOGIN" => $arParams["SHOW_LOGIN"],
					"PATH_TO_CONPANY_DEPARTMENT" => $arParams["~PATH_TO_CONPANY_DEPARTMENT"],
					"PATH_TO_SONET_USER_PROFILE" => ($arParams["USE_SOCNET"] == "Y" ? $arParams["~PATH_TO_USER"] : $arParams["~PATH_TO_SONET_USER_PROFILE"]),
					"INLINE" => "Y",
					"SEO_USER" => $arParams["SEO_USER"],
				),
				false,
				array("HIDE_ICONS" => "Y")
			);
			?>
			<?if($arParams["SEO_USER"] == "Y"):?>
				</noindex>
			<?endif;?>
			</div>
			<div class="blog-post-date"><span class="blog-post-day"><?=$arResult["Post"]["DATE_PUBLISH_DATE"]?></span><span class="blog-post-time"><?=$arResult["Post"]["DATE_PUBLISH_TIME"]?></span><span class="blog-post-date-formated"><?=$arResult["Post"]["DATE_PUBLISH_FORMATED"]?></span></div>
		</div>
		</div>
		<div class="blog-post-content">
			<!-- выводим список читаемых курсов преподавателем -->

				<?
				// выберем все активные блоги, привязанные к текущему сайту.
				// результат будет отсортирован сначала по дате создания, затем по названию блога
				// выберутся только необходимые нам поля: Идентификатор блога, Название блога, Адрес блога,
				// Идентификатор владельца блога и Дату создания блога
				//iwrite($arParams);
				$SORT = Array("DATE_CREATE" => "DESC", "NAME" => "ASC");
				$arFilter = Array(
				        "ACTIVE" => "Y",
				        "GROUP_SITE_ID" => SITE_ID,
				        "URL" => $arParams['BLOG_URL'],
				    );
				$arSelectedFields = array("ID", "NAME", "DESCRIPTION", "URL", "OWNER_ID", "DATE_CREATE", "UF_EXPERT_ID");

				$dbBlogs = CBlog::GetList(
				        $SORT,
				        $arFilter,
				        false,
				        false,
				        $arSelectedFields
				    );
				$index = 0;
				while ($arBlog = $dbBlogs->Fetch())
				{
				    $index = $index + 1;
				    $vIDExpert = $arBlog['UF_EXPERT_ID'];
				   //iwrite($vIDExpert);
				}

				?>
				<?if ((strlen($vIDExpert)>0) and ($vIDExpert !== "0")){?>

                    <?$arrIDCourses = GetListIDCoursesByExpertID($vIDExpert);?>
<?if (count($arrIDCourses)>0){?>
                    <?$arrCoursesNamesCodes = GetCoursesNamesCodesByArray($arrIDCourses);?>

					<?if (count($arrCoursesNamesCodes)>0){?>
					    <?$index = 0;?>
						<?//iwrite($arrCoursesNamesCodes);?>
						<div class="floated_right">
							<h2>Некоторые тренинги инструктора:</h2>
							<?foreach ($arrCoursesNamesCodes as $arrCourses){ ?>
								<?if ($index < 5){?>
										<div class="links" style="margin-bottom:3px;"><a href="/training/catalog/course.html?ID=<?=$arrCourses['ID']?>"><?=$arrCourses['CODE']?> <?=$arrCourses['NAME']?></a></div>
								<? } ?>
								<?$index = $index + 1;?>
							<? } ?>
						</div>
					<? } ?>
<? } ?>
				<? } ?>

			<!-- окончание блока -->
			<div class="blog-post-avatar"><?=$arResult["BlogUser"]["AVATAR_img"]?></div>
			<?=$arResult["Post"]["textFormated"]?>
<div class="clear"></div>
			<?if($arResult["POST_PROPERTIES"]["SHOW"] == "Y"):?>
				<p>
				<?foreach ($arResult["POST_PROPERTIES"]["DATA"] as $FIELD_NAME => $arPostField):?>
				<?if(strlen($arPostField["VALUE"])>0):?>
					<b><?=$arPostField["EDIT_FORM_LABEL"]?>:</b>&nbsp;
							<?$APPLICATION->IncludeComponent(
								"bitrix:system.field.view",
								$arPostField["USER_TYPE"]["USER_TYPE_ID"],
								array("arUserField" => $arPostField), null, array("HIDE_ICONS"=>"Y"));?><br />
				<?endif;?>
				<?endforeach;?>
				</p>
			<?endif;?>
		</div>
			<div class="blog-post-meta">
				<div class="blog-post-info-bottom">
				<div class="blog-post-info">
					<div class="blog-author">
					<?if($arParams["SEO_USER"] == "Y"):?>
						<noindex>
							<a class="blog-author-icon" href="<?=$arResult["urlToAuthor"]?>" rel="nofollow"></a>
						</noindex>
					<?else:?>
						<a class="blog-author-icon" href="<?=$arResult["urlToAuthor"]?>"></a>
					<?endif;?>
					<?if($arParams["SEO_USER"] == "Y"):?>
						<noindex>
					<?endif;?>
					<?
					$APPLICATION->IncludeComponent("bitrix:main.user.link",
						'',
						array(
							"ID" => $arResult["arUser"]["ID"],
							"HTML_ID" => "blog_post_".$arResult["arUser"]["ID"],
							"NAME" => $arTmpUser["NAME"],
							"LAST_NAME" => $arTmpUser["LAST_NAME"],
							"SECOND_NAME" => $arTmpUser["SECOND_NAME"],
							"LOGIN" => $arTmpUser["LOGIN"],
							"NAME_LIST_FORMATTED" => $arTmpUser["NAME_LIST_FORMATTED"],
							"USE_THUMBNAIL_LIST" => "N",
							"PROFILE_URL" => $arResult["urlToAuthor"],
							"PROFILE_URL_LIST" => $arResult["urlToBlog"],
							"PATH_TO_SONET_MESSAGES_CHAT" => $arParams["~PATH_TO_MESSAGES_CHAT"],
							"PATH_TO_VIDEO_CALL" => $arParams["~PATH_TO_VIDEO_CALL"],
							"DATE_TIME_FORMAT" => $arParams["DATE_TIME_FORMAT"],
							"SHOW_YEAR" => $arParams["SHOW_YEAR"],
							"CACHE_TYPE" => $arParams["CACHE_TYPE"],
							"CACHE_TIME" => $arParams["CACHE_TIME"],
							"NAME_TEMPLATE" => $arParams["NAME_TEMPLATE"],
							"SHOW_LOGIN" => $arParams["SHOW_LOGIN"],
							"PATH_TO_CONPANY_DEPARTMENT" => $arParams["~PATH_TO_CONPANY_DEPARTMENT"],
							"PATH_TO_SONET_USER_PROFILE" => ($arParams["USE_SOCNET"] == "Y" ? $arParams["~PATH_TO_USER"] : $arParams["~PATH_TO_SONET_USER_PROFILE"]),
							"INLINE" => "Y",
							"SEO_USER" => $arParams["SEO_USER"],
						),
						false,
						array("HIDE_ICONS" => "Y")
					);
					?>
					<?if($arParams["SEO_USER"] == "Y"):?>
						</noindex>
					<?endif;?>
					</div>
					<div class="blog-post-date"><span class="blog-post-day"><?=$arResult["Post"]["DATE_PUBLISH_DATE"]?></span><span class="blog-post-time"><?=$arResult["Post"]["DATE_PUBLISH_TIME"]?></span><span class="blog-post-date-formated"><?=$arResult["Post"]["DATE_PUBLISH_FORMATED"]?></span></div>
				</div>
				</div>
				<div class="blog-post-meta-util">
				<?if($arResult["Post"]["ENABLE_COMMENTS"] == "Y"):?>
					<span class="blog-post-comments-link"><a href=""><span class="blog-post-link-caption"><?=GetMessage("BLOG_BLOG_BLOG_COMMENTS")?></span><span class="blog-post-link-counter"><?=IntVal($arResult["Post"]["NUM_COMMENTS"])?></span></a></span>
				<?endif;?>
					<span class="blog-post-views-link"><a href=""><span class="blog-post-link-caption"><?=GetMessage("BLOG_BLOG_BLOG_VIEWS")?></span><span class="blog-post-link-counter"><?=IntVal($arResult["Post"]["VIEWS"])?></span></a></span>
					<?if(strLen($arResult["urlToHide"])>0):?>
						<span class="blog-post-hide-link"><a href="javascript:if(confirm('<?=GetMessage("BLOG_MES_HIDE_POST_CONFIRM")?>')) window.location='<?=$arResult["urlToHide"]."&".bitrix_sessid_get()?>'"><span class="blog-post-link-caption"><?=GetMessage("BLOG_MES_HIDE")?></span></a></span>
					<?endif;?>
					<?if(strLen($arResult["urlToEdit"])>0):?>
						<span class="blog-post-edit-link"><a href="<?=$arResult["urlToEdit"]?>"><span class="blog-post-link-caption"><?=GetMessage("BLOG_BLOG_BLOG_EDIT")?></span></a></span>
					<?endif;?>
					<?if(strLen($arResult["urlToDelete"])>0):?>
						<span class="blog-post-delete-link"><a href="javascript:if(confirm('<?=GetMessage("BLOG_MES_DELETE_POST_CONFIRM")?>')) window.location='<?=$arResult["urlToDelete"]."&".bitrix_sessid_get()?>'"><span class="blog-post-link-caption"><?=GetMessage("BLOG_BLOG_BLOG_DELETE")?></span></a></span>
					<?endif;?>

				</div>

				<?if(!empty($arResult["Category"]))
				{
					?>
					<div class="blog-post-tag">
						<noindex>
						<?=GetMessage("BLOG_BLOG_BLOG_CATEGORY")?>
						<?
						$i=0;
						foreach($arResult["Category"] as $v)
						{
							if($i!=0)
								echo ",";
							?> <a href="<?=$v["urlToCategory"]?>" rel="nofollow"><?=$v["NAME"]?></a><?
							$i++;
						}
						?>
						</noindex>
					</div>
					<?
				}
				?>
			</div>
		</div>
		<?
	}
	else
		echo GetMessage("BLOG_BLOG_BLOG_NO_AVAIBLE_MES");
}
?>
</div>

<?
//$uri = "http://www.luxoft-training.ru";
//$uri .= $APPLICATION->GetCurPageParam(false, array("ID_TIME", "clear_cache")); 
$uri = $_SERVER["SCRIPT_URI"];
?>
<!--
<iframe src="http://www.facebook.com/plugins/like.php?app_id=108688045898915&amp;href=<?=$uri?>&amp;send=false&amp;layout=standard&amp;width=450&amp;show_faces=true&amp;locale=ru_RU&amp;action=like&amp;colorscheme=light&amp;font=arial&amp;height=50" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:50px;" allowTransparency="true"></iframe>
-->

<div id="fb-root"></div>
 <script>
     window.fbAsyncInit = function() 
    {
         // init the FB JS SDK
         FB.init(
         {
            appId : '225734987442328', 
            channelUrl : '//WWW.LUXOFT-TRAINING.RU',
            status : true, 
            cookie : true, 
            xfbml : true 
        }); 
     }; 
     (function(d)
     {
         var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement('script'); js.id = id; js.async = true;
         js.src = "//connect.facebook.net/ru_RU/all.js";
         ref.parentNode.insertBefore(js, ref);
     }(document));
 </script>

<div class="fb-like" data-href="<?=$uri?>" data-send="false" data-width="450" data-show-faces="false"></div>



<div style="float:right;">
<g:plusone></g:plusone>
</div>
<script type="text/javascript">
  window.___gcfg = {lang: 'ru'};

  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
<div class="clear"></div>

<br />

    <?
    $uri = $APPLICATION->GetCurUri("r1=socialicons");
    $uri_twitter = $APPLICATION->GetCurUri("r1=socialicons&r2=twt");
    ?>
    <script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script>
    <script type="text/javascript"> 
        var YaShareInstance = new Ya.share({
            element: 'ya_share',
            elementStyle: {
                        type: 'none',
                        quickServices: ['', 'yaru', 'vkontakte', 'facebook', 'twitter', 'odnoklassniki', 'moimir', 'lj', 'moikrug', 'evernote', 'greader']
            },
            onready: function(instance) {
                        instance.updateShareLink(
                            "<?echo "http://www.luxoft-training.ru".$uri;?>",
                            "<?echo $arResult["NAME"];?>",
                            {
                               twitter: {link: '<?echo "http://www.luxoft-training.ru".$uri_twitter;?>', title: '<?echo $arResult["NAME"]." @TrainingLuxoft";?>'}
                            }
                        );
            }
        });
        YaShareInstance.updateShareLink('http://www.luxoft-training.ru/', 'УЦ Luxoft');
    </script> 
    <div id="ya_share"></div> 

<?/*$APPLICATION->IncludeComponent(
	"bitrix:asd.share.buttons",
	"",
	Array(
		"ASD_TITLE" => $_REQUEST["title"],
		"ASD_URL" => $_REQUEST["url"],
		"ASD_PICTURE" => $_REQUEST["picture"],
		"ASD_TEXT" => $_REQUEST["text"],
		"ASD_INCLUDE_SCRIPTS" => array("FB_LIKE"),
		"LIKE_TYPE" => "LIKE",
		"FB_LIKE_VIEW" => "button_count"
	)
);*/?> 
<div id="upmsg-selectable">
    <div class="upmsg-selectable-inner">
        <img src="/bitrix/templates/en/images/textselect/upmsg_arrow.png" alt="">
        <p>Вы можете отметить интересные вам фрагменты текста, которые будут доступны по уникальной ссылке в адресной строке браузера.</p>
        <a href="#" class="upmsg_closebtn"></a>
    </div>
</div>