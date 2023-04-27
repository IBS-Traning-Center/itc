<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?//phpinfo();
?>
	<style type="text/css">
    #counter br { clear: both; }
    .cntSeparator {
        font-size: 54px;
        margin: 0px 4px;
        color: #000;
        line-height: 56px;
    }
    .desc { margin: 7px 3px; }
    .desc div {
        float: left;
        font-family: Arial;
        width: 70px;
        margin-right: 65px;
        font-size: 13px;
        font-weight: bold;
        color: #000;
    }
    .cntDigit {
        margin-left: 3px;
    }
    .tran-time {
        margin-bottom: 10px;
        font-size: 15px;
    }


	</style>
	<?$c_time= strtotime($arResult["PROPERTIES"]["countdown_time"]["VALUE"])-time()?>
    <?$time=seconds2times($c_time)?>
     <?foreach ($time as $key=>$tm) {?>
        <?if (strlen($tm)==0) {?>
            <?$time[$key]="00";?>
        <?} elseif (strlen($tm)==1) {?>
            <?$time[$key]="0".$tm;?>
        <?}?>
    <?}?>
    <?if (intval($c_time)>0) {?>
    <?$strtime=$time[3].":".$time[2].":".$time[1].":".$time[0]?>
	<script type="text/javascript">
            $(function(){

                $('#counter').countdown({
                    digitWidth: 41,
                    digitHeight: 60,
                    digitImages: 3,
                    image: '/images/flippers.png',
                    startTime: '<?=$strtime?>'
                });
                
            })
        </script>
    <?}?>
	
   <?
   global $main_header;
   ?>
    <? $main_header=$APPLICATION->GetPageProperty("main_header");


    ?>
	
        <h2><?=$arResult["NAME"]?></h2>

	<?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
        <h3><?=$arResult["DISPLAY_ACTIVE_FROM"]?></h3>
	<?endif;?>
	<?if  (intval($c_time)>0) {?>
		<br/>
		<div class="tran-time"><b>До окончания акции осталось: </b></div>
		<div class="indent">
            <div id="counter">

            </div>
        </div>
	<?}?>
	<?foreach($arResult["FIELDS"] as $code=>$value):?>
			<?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?=$value;?>
	<?endforeach;?>

	<?
	$publication = $arResult['DETAIL_TEXT'];
	?>
    <?=$publication?>

<br /><br />


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
                            "<?echo "http://ibs-training.ru".$uri;?>",
                            "<?echo $arResult["NAME"];?>",
                            {
                               twitter: {link: '<?echo "http://ibs-training.ru".$uri_twitter;?>', title: '<?echo $arResult["NAME"]." @TrainingLuxoft";?>'}
                            }
                        );
            }
        });
        YaShareInstance.updateShareLink('http://ibs-training.ru/', 'УЦ Luxoft');
    </script> 
    <div id="ya_share"></div> 



