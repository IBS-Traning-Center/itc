<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

function getMessages($mess,$arResult){
	$messages = '';
	foreach( $mess as $key2 => $message2){
		if ($_SESSION['TALK_'.$arResult['managerid']]['USER']==$message2["NAME"]) {
			$name="Я";
		} else {
			$name=$message2["NAME"];
		}
		$messages .= '<div class="line"><span class="time">'.date('H:i:s',strtotime($message2['DATE_CREATE'])).'</span>';
		$messages .= '<div class="kons-name '.($message2["NAME"]!='auto'?($_SESSION['TALK_'.$arResult['managerid']]['USER']==$message2["NAME"]?"green":"red"):'note').'"><b>'.$name.'</b></div> <div class="message">'.$message2['PREVIEW_TEXT'].'</div>';
		$messages .= '</div>';
	}
	return $messages;
}?>

<?if ($arResult['ACTION'] == 'MANAGERLIST'): if(isset($arParams['WINDOW']) && $arParams['WINDOW']=='') $arParams['WINDOW'] = 'userWin';?>

	
	<?=plugJS(true)?>
	<script src="<?=jCallJs('talkClient.js?'.rand())?>"></script>
	<?if (intval($arResult['MANAGERS']["ONLINE"])>0) {?>
	<div class="users" href="<?=jCallLocation('j_call='.$arResult['j_callId'])?>">
	<?foreach($arResult['MANAGERS'] as $key => $user):?>
		<?if ( $user[1] == 'Y' ):?>
			<?$arUsers[]=$key;?>
		<?endif;?>
	<?endforeach;?>
	<?if ($arResult['MANAGERS'][$_SESSION["KONS_ID"]][1]=="Y") {?>
		<?$id=$_SESSION["KONS_ID"]?>
	<?} else {?>
		<?$keyus=rand(0, $arResult['MANAGERS']["ONLINE"]-1)?>
		<?$_SESSION["KONS_ID"]=$arUsers[$keyus]?>
		<?$id=$arUsers[$keyus]?>
	<?}?>
	<div class="<?=$arParams['WINDOW']?> Y cons-open" id="<?=$id?>"></div>
	
	<?/*foreach($arResult['MANAGERS'] as $key => $user):?>
		<?if ( $user[1] == 'Y' ):?>
			<li class="<?=$arParams['WINDOW']?> <?=$user[1]?>a" id="<?=$key?>"><?=$user[0]?></li>
		<?endif;?>
	<?endforeach;*/?>
	<?unset($_SESSION["page_for_bla"]);
$_SESSION["page_for_bla"]="http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];?>
</div>
<?}?>
<script type="text/javascript"><?=getMessage('JS')?> </script>
<?endif;?>

<?if ( $arResult['ACTION'] == 'STARTTALK' ):?>
	<div class="Talk" id="m<?=$arResult['managerid']?>">
	   <div class="UserInfo">
	    	<?if($arResult['MANAGER_INFO']['PERSONAL_PHOTO'] > 0 ):?>	
				<? $img = CFile::ResizeImageGet($arResult['MANAGER_INFO']['PERSONAL_PHOTO'],array('height'=>60,width=>60));?>
				<img src="<?=$img['src']?>" border="0" class="avatar"/>
			<?else:?>
				<img class="avatar" src="/bitrix/components/maevrika/talk.manager/templates/.default/images/consult_top/ava.png"/>
			<?endif;?>
	    	<div class="name"><?=$arResult['MANAGER_INFO']['NAME']?></div>
	    	<div class="prof"><?=$arResult['MANAGER_INFO']['WORK_PROFILE']?></div>
	    </div>
	
	 <input type="hidden" id="timerinterval" value="4s"/><!-- <?=$arParams["USER_ACTIVITY_INTERVAL"]?> -->
	 <div class="text">
		<div class="line">-<?=date('d.m.Y H:i:s')?>-</div>
			<?=getMessages($arResult['MESSAGES'],$arResult);?>
	</div>
	<!-- <b><?=getMessage('CAPTION2')?></b> -->
	 <div class="message">
		<textarea class="input"></textarea>
		<input type="submit" class="send" value="<?=getMessage('SEND')?>" mgid="<?=$arResult['managerid']?>"
	href="<?=jCallLocation('j_call='.$arResult['j_callId'].'&managerid='.$arResult['managerid'])?>"/>
	<br style="clear:both;"/>
	 </div>
	</div><script type="text/javascript">startTimer(jQuery('#timerinterval').val(),'<?=$arResult['managerid']?>');</script>
<?endif;?><?if ( $arResult['ACTION'] == 'STARTTALKWIN' ):?>
	<?//GLOBAL $templateLocation; $templateLocation = $this->GetFile();?>
	<html><head>
	<link type="text/css" href="<?=dirname($this->GetFile())?>/styleWin.css" rel="stylesheet" />
	<?=plugJS()?>
	<script src="<?=jCallJs('talkClient.js?'.rand())?>"></script>
	<title><?=getMessage('TITTLE')?></title>
	</head>
	<body><div class="TalkWin">
		 <div class="UserInfo">
			<?if($arResult['MANAGER_INFO']['PERSONAL_PHOTO'] > 0 ):?>	
				<? $img = CFile::ResizeImageGet($arResult['MANAGER_INFO']['PERSONAL_PHOTO'],array('height'=>60,width=>60));?>
				<img src="<?=$img['src']?>" border="0" class="avatar"/>
			<?else:?>
				<img class="avatar" src="/bitrix/components/maevrika/talk.manager/templates/.default/images/consult_top/ava.png"/>
			<?endif;?>
			<div class="name"><?=$arResult['MANAGER_INFO']['NAME'] ?></div>
			<div class="additionally"><?=$arResult['MANAGER_INFO']['WORK_POSITION']?></div>
	    </div>
	<div class="Talk" id="m<?=$arResult['managerid']?>">
	 <input type="hidden" id="timerinterval" value="2s"/>
	 <div></div>
	 <div class="text">
		<?=getMessages($arResult['MESSAGES'],$arResult);?>
	</div>
	<!-- <b><?=getMessage('CAPTION2')?></b> -->
	 <div class="my-message">
		<textarea placeholder="Введите текст сообщения..." class="input"></textarea>
		<input type="submit" class="send" value="<?=getMessage('SEND')?>" mgid="<?=$arResult['managerid']?>"
	href="<?=jCallLocation('j_call='.$arResult['j_callId'].'&managerid='.$arResult['managerid'])?>"/><br style="clear:both;"/>
	 </div>
	</div>
	</div>
	<script type="text/javascript"><?=getMessage('JS')?> startTimer(jQuery('#timerinterval').val(),'<?=$arResult['managerid']?>');</script>
	</body>
	</html>
<?endif;?><?if ( $arResult['ACTION'] == 'SEND' ):?>
<?$APPLICATION->RestartBuffer();?>
ok
<?die;?>
<?endif;?>
<?if ( $arResult['ACTION'] == 'GETLAST' ):?>
<?$APPLICATION->RestartBuffer();?>
	<?=getMessages($arResult['MESSAGES'],$arResult);?>
<?die;?>
<?endif;?>