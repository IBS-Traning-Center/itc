<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<style type="text/css">

.tableworkbg {background-color:#FFFFFF;}
.tableborder {background-color:#5E6B87;}
.tablehead { background-color:#EBF4FB; border-top: solid 1px #93CBEA; border-bottom: solid 1px #C7E2FF; padding-top: 5px; padding-bottom: 5px; background-repeat: repeat-x;}
.tdpadding  {padding-left:5px;}

#content img {
margin-right:0px;
padding:0px;
}
h2 {
	padding:5px  5px 5px 0px;
}

.subscribe
{
    _background:#ebf4fb;
}

.subscribe p
{
    font-size:11px;
    color:#666;
    padding-bottom:10px;
}

.subscribe label
{
    display:block;
    font-weight:bold;
    text-align:right;

    float:left;
    margin:0px 10px 0px 10px;
}
.subscribe label.error {
	color:red;
	display:block;
	font-weight:normal;
	margin:0px 0px 0px 0px;
	padding:0px;
	text-align:left;
	vertical-align:top;
	position: relative;
	left: 200px
}
.subscribe label.red
{
    color: red;
}


.subscribe input
{
    float:left;
    font-size:12px;
    padding:4px 2px;
    border:solid 1px #aacfe4;
    width:185px;
    margin:10px 0 10px 10px;
}
.subscribe input.but
{
    width: 125px;
}

</style>
<script type="text/javascript" src="/bitrix/templates/en/jquery.validate.js"></script>
  <script>
  $(document).ready(function(){
    $("#submit_subscribe").validate();
  });
 </script>
<form action="<?=$arResult["FORM_ACTION"]?>" method="get" id="submit_subscribe">
	<table border="0" cellpadding="3" cellspacing="2" width="100%">

		<tbody><tr class="tablehead">

			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td class="tdpadding"><h2><?echo GetMessage("SUBSCR_NAME")?></h2></td>

			<td class="tdpadding" width="500"><h2><?echo GetMessage("SUBSCR_DESC")?></h2></td>

			<?if($arResult["SHOW_COUNT"]):?>
				<td><font class="tableheadtext"><?echo GetMessage("SUBSCR_CNT")?></font></td>
			<?endif;?>
		</tr>

		<?foreach($arResult["RUBRICS"] as $itemID => $itemValue):?>
		<tr valign="top">
			<td class="tdpadding"><input type="checkbox" name="sf_RUB_ID[]" id="sf_RUB_ID_<?=$itemID?>" value="<?=$itemValue["ID"]?>" checked /></td>

			<td class="tdpadding"><p><label for="sf_RUB_ID_<?=$itemID?>"><?=$itemValue["NAME"]?></label></p></td>

			<td class="tdpadding"><p><?=nl2br($itemValue["DESCRIPTION"]);?></p></td>

			<?if($arResult["SHOW_COUNT"]):?>
				<td align="right"><?=$itemValue["SUBSCRIBER_COUNT"]?></td>
			<?endif?>
		</tr>
		<?endforeach;?>
	</tbody>
</table>
<div class="subscribe" style="background:#ebf4fb;">
<table border="0" cellpadding="2" cellspacing="2">
	<tbody>
	<tr>
		<td><label>E-mail:&nbsp;</label></td>
		<td><input type="text" name="sf_EMAIL" size="20" value="<?=$arResult["EMAIL"]?>" title="<?echo GetMessage("SUBSCR_EMAIL_TITLE")?>" />
		</td>
		<td><input type="submit"  class="but" value="<?echo GetMessage("SUBSCR_BUTTON")?>" /></td>
	</tr>
	</tbody>
</table>

</form>
</div>

<br/ >
<table border="0" cellpadding="0" cellspacing="0" width="100%"><tbody><tr><td class="tableborder"><img src="/images/1.gif" alt="" height="2" width="1"></td></tr></tbody></table>




<div class="subscribe">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody><tr valign="top">
	<td width="40%">
<h2>Изменить настройки</h2>

<p>Если вы уже подписаны на наши рассылки, вы можете изменить ваши настройки - введите ваш e-mail и пароль.</p>


<form action="<?=$arResult["FORM_ACTION"]?>" method="get">
<?echo bitrix_sessid_post();?>
<table border="0" cellpadding="0" cellspacing="2">

<tbody><tr>
	<td><label>E-mail: </label></td>

	<td><input type="text" name="sf_EMAIL" size="25" value="<?=$arResult["EMAIL"]?>" title="<?echo GetMessage("SUBSCR_EMAIL_TITLE")?>" /></td>
</tr>
		<?if($arResult["SHOW_PASS"]=="Y"):?>
<tr>
	<td><label>Пароль:<font class="starrequired">*</font></label></td>

	<td><input type="password" name="AUTH_PASS" size="25" value="" title="<?echo GetMessage("SUBSCR_EDIT_PASS_TITLE")?>" /></td>
</tr>
		<?else:?>
<tr>
	<td><font class="text successcolor"><?echo GetMessage("SUBSCR_EDIT_PASS_ENTERED")?></font><font class="starrequired">*</font><br>
</tr>
		<?endif;?>

<tr><td>&nbsp;</td>
	<td><input  class="but" type="submit" value="<?echo GetMessage("SUBSCR_EDIT_BUTTON")?>" /></td>
</tr>
</tbody></table>
<input type="hidden" name="action" value="authorize" />
</form>




	</td>
	<td class="text" width="0%">&nbsp;</td>
	<td class="tableborder" width="0%"><img src="/images/1.gif" alt="" height="1" width="1"></td>
	<td class="text" width="0%">&nbsp;&nbsp;</td>

	<td width="40%">
<h2>Если вы забыли ваш пароль</h2>

<p>Введите  ваш e-mail и пароль будет тотчас выслан вам<br /><br /></p>

<form action="<?=$arResult["FORM_ACTION"]?>" method="get">
<?echo bitrix_sessid_post();?>
<table border="0" cellpadding="0" cellspacing="2">
<tbody><tr>
	<td><label>E-mail:</label></td>


	<td><input type="text" name="sf_EMAIL" size="25" value="<?=$arResult["EMAIL"]?>" title="<?echo GetMessage("SUBSCR_EMAIL_TITLE")?>" /></p>

</tr>
<tr> <td>&nbsp;</td>
	<td><input type="submit"  class="but" value="<?echo GetMessage("SUBSCR_PASS_BUTTON")?>" /></td>
</tr>
</tbody></table>
<input name="action" value="sendpassword" type="hidden">
</form>

	</td>
	<td class="text" width="0%">&nbsp;</td>
	<td class="tableborder" width="0%"><img src="/images/1.gif" alt="" height="1" width="1"></td>

	<td class="text" width="0%">&nbsp;&nbsp;</td>
	<td width="30%">
<h2>Отписаться</h2>
<p>Если вы хотите отписаться, зайдите в <i>изменение настроек подписок</i>  и нажмите <i>Отписаться.</i></p>
	</td>
</tr>
</tbody></table>

</div>


<!--
<p><span class="starrequired">*&nbsp;</span><?echo GetMessage("SUBSCR_NOTE")?></p>
-->

