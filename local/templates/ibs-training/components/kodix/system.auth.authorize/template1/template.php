<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


<?
if ($arResult["AUTHORIZED"]) {?>
<p>
Вы успешно авторизованы и можете продолжать работу с сайтом.
</p>
<?
	
} else {

//ShowMessage($arParams["~AUTH_RESULT"]);
ShowMessage($arResult['ERROR']);
?>
<form name="form_auth" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">

	<input type="hidden" name="AUTH_FORM" value="Y" />
	
	<input type="hidden" name="BACK_URL" value="<?=$arResult["BACK_URL"]?>" />
	
	<?if (strlen($arResult["BACKURL"]) > 0) { ?><input type='hidden' name='backurl' value='<?=$arResult["BACKURL"]?>' /><? } ?>
	<?
	foreach ($arResult["POST"] as $key => $value)
	{
		?>
		<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
		<?
	}
	?>
	
	<table class="formTable">
		<tr>
			<th>Ваш E-mail:</th>
		</tr>
		<tr>
			<td><input type="text"  class="usual" name="USER_LOGIN" maxlength="50" class="textfield" value="<?=$arResult["LAST_LOGIN"]?>" /><br /><br /></td>
		</tr>
		<tr>
			<th><?=GetMessage("AUTH_PASSWORD")?></th>
		</tr>
		<tr>
			<td><input type="password" class="usual" name="USER_PASSWORD" maxlength="50" class="textfield" /></td>
		</tr>
		<?
		if ($arResult["STORE_PASSWORD"] == "Y") 
		{
			?>
			<tr>
			<td><label><input type="checkbox" class="usual" id="USER_REMEMBER" name="USER_REMEMBER" value="Y" class="chk" /> <?=GetMessage("AUTH_REMEMBER_ME")?></label></td>
			</tr>
			<?
		} 
		?>
		<?
		if ($arParams["NOT_SHOW_LINKS"] != "Y")
		{
			?>	
		<tr>
			<td>
			<p><a class="dark" href="#" onclick="$(this).parent().next().toggle(); return false;">Забыли пароль?</a></p>
			
			<div class="script_hidden">    	
		        <?=GetMessage("AUTH_GO")?> <a href="<?=$arResult["AUTH_FORGOT_PASSWORD_URL"]?>" title="<?=GetMessage('AUTH_GO_AUTH_FORM') ?>"><?=GetMessage('AUTH_GO_AUTH_FORM') ?></a>. <br />
		        <?=GetMessage("AUTH_MESS_1")?> <a href="<?=$arResult["AUTH_CHANGE_PASSWORD_URL"]?>" title="<?=GetMessage('AUTH_CHANGE_FORM') ?>"><?=GetMessage('AUTH_CHANGE_FORM') ?></a>.
		    </div>
		    </td>
		</tr>
		<?
		}
		?>
		<tr>
        	<td>
        	<div class="sneakySub">
				<input type="submit" id="enter_btn" name="Login" value="<?=GetMessage("AUTH_AUTHORIZE")?>" />
				<i class="l"><!--//--></i>
				<i class="r"><!--//--></i>						
			</div>
        	</td>
        </tr>
	</table>


</form>

<script type="text/javascript">
<!--
<?
if (strlen($arResult["LAST_LOGIN"])>0) 
{ 
	?>
	try{document.form_auth.USER_PASSWORD.focus();}catch(e){}
	<?
}
else
{
	?>
	try{document.form_auth.USER_LOGIN.focus();}catch(e){}
	<?
}
?>
// -->
</script> <? } ?>

