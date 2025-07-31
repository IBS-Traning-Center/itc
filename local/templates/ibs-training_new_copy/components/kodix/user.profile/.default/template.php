<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>

<div class="personal twoCols clear">
	<div class="lCol">
		<div class="inner">

<?$APPLICATION->IncludeComponent(
				"bitrix:menu",
				"order",
				Array(
					"ROOT_MENU_TYPE"	=>	"order",
					"MAX_LEVEL"	=>	"1",
					"USE_EXT"	=>	"N"
				)
			);?>
<div class="gBlock"><div class="text">
<?
kdxShowErrors($arResult["ERRORS"]["GLOBAL"]);

$is_disabled["U_NAME"] = ($arResult["NOT_DISABLED"]["U_NAME"]) ? '' : ' disabled="disabled"';
$is_disabled["U_LAST_NAME"] = ($arResult["NOT_DISABLED"]["U_LAST_NAME"]) ? '' : ' disabled="disabled"';
$is_disabled["U_EMAIL"] = ($arResult["NOT_DISABLED"]["U_EMAIL"]) ? '' : ' disabled="disabled"';
$is_disabled["U_DOB"] = ($arResult["NOT_DISABLED"]["U_DOB"]) ? '' : ' disabled="disabled"';
$is_disabled["U_PHONE"] = ($arResult["NOT_DISABLED"]["U_PHONE"]) ? '' : ' disabled="disabled"';

?>
<?=$arResult["RESULT"]?>
<form method="post" action="/personal/personal.php" name="regform" enctype="multipart/form-data">
<input type="hidden" name="UPDATE_USER" value="Y" />
<table class="formTable">
	<tbody>
		<tr>
			<th colspan="2">
				Имя *:
			</th>
		</tr>
		<tr>
			<td>
				<input type="text" class="textfield" name="U_NAME" value="<?=$arResult["POST"]["U_NAME"]?>" />
			</td>
			<td>
				<?kdxShowErrors($arResult["ERRORS"]["U_NAME"]);?>
			</td>
		</tr>
		<tr>
			<th colspan="2">
				Фамилия *:
			</th>
		</tr>
		<tr>
			<td>
				<input type="text" class="textfield" name="U_LAST_NAME" value="<?=$arResult["POST"]["U_LAST_NAME"]?>" />
			</td>
			<td>
				<?kdxShowErrors($arResult["ERRORS"]["U_LAST_NAME"]);?>
			</td>
		</tr>		
		<tr>
			<th colspan="2">
				Телефон :
			</th>
		</tr>
		<tr>
			<td class="phone">
				+ <input type="text" class="textfield phone1" name="U_PHONE_1" value="<?=$arResult["POST"]["U_PHONE_1"]?>" />
				  <input type="text" class="textfield phone2" name="U_PHONE_2" value="<?=$arResult["POST"]["U_PHONE_2"]?>" />
				  <input type="text" class="textfield phone3" name="U_PHONE_3" value="<?=$arResult["POST"]["U_PHONE_3"]?>" />
			</td>
			<td>
				<?kdxShowErrors($arResult["ERRORS"]["U_PHONE"]);?>
			</td>
		</tr>
		<tr>
			<th colspan="2">
				Эл. почта *:
			</th>
		</tr>
		<tr>
			<td>
				<input type="text" class="textfield" name="U_EMAIL" value="<?=$arResult["POST"]["U_EMAIL"]?>" />
			</td>
			<td>
				<?kdxShowErrors($arResult["ERRORS"]["U_EMAIL"]);?>
			</td>
		</tr>		
			
		<tr>
			<th colspan="2">
				Дата рождения:
			</th>
		</tr>
		<tr>
			<td class="dob">
				  <input onfocus="initDOB(this,'дд')" onblur="initDOB(this,'дд')" type="text" class="textfield dob1" name="U_DOB_D" value="<?=$arResult["POST"]["U_DOB_D"]?>" />
				  <input onfocus="initDOB(this,'мм')" onblur="initDOB(this,'мм')" type="text" class="textfield dob2" name="U_DOB_M" value="<?=$arResult["POST"]["U_DOB_M"]?>" />
				  <input onfocus="initDOB(this,'гггг')" onblur="initDOB(this,'гггг')" type="text" class="textfield dob3" name="U_DOB_Y" value="<?=$arResult["POST"]["U_DOB_Y"]?>" />
			</td>
			<td>
				<?kdxShowErrors($arResult["ERRORS"]["U_DOB"]);?>
			</td>
		</tr>
		<tr>
			<th colspan="2">
				Рассылка:
			</th>
		</tr>
		<tr>
			<td class="dob">
				  <input type="checkbox" name="U_SUBSCR" value="Y"<?=($arResult["POST"]["U_SUBSCR"]=="Y")?' checked="checked"':''?> /> Получать информационные сообщения сайта
			</td>
			<td>
				<?kdxShowErrors($arResult["ERRORS"]["U_SUBSCR"]);?>
			</td>
		</tr>
		
	</tbody>
	<tfoot>
		<tr> 		
			<td>
			<div class="sneakySub">
				<input type="submit" name="register_submit_button" value="Сохранить" />
				<i class="l"><!--//--></i>
				<i class="r"><!--//--></i>						
			</div>
			</td>			
		</tr>
		<tr>
			<td>
				<p><span class="starrequired">*</span> &ndash; обязательные поля</p>
			</td>
		</tr>
	</tfoot>
</table>



</form>
	</div>
	<i class="c c2"><!--/--></i>
	<i class="c c3"><!--/--></i>
	<i class="c c4"><!--/--></i>
</div>
		</div>	
	</div>
	<div class="rCol">
		<div class="inner">
			<ul class="list">
				<li class="more link" onclick="$(this).next().toggle();">Изменить пароль</li>
				<li class="virgin<?=($arResult["CHANGE_PASS"])?'': ' script_hidden'?>">
					<?kdxShowErrors($arResult["ERRORS"]["CHANGE_PASS"]);?>					
					<form method="post" action="/personal/personal.php">
					<input type="hidden" name="CHANGE_PASS" value="Y" />
					<table class="formTable">
						<tr>
							<td colspan="2">Текущий пароль</td>
						</tr>
						<tr>
							<td><input type="password" class="textfield" name="CUR_PASS" /></td>							
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td colspan="2">Новый пароль</td>
						</tr>
						<tr>
							<td><input type="password" class="textfield" name="NEW_PASS" /></td>							
							<td>Не менее 6 символов</td>
						</tr>
						<tr>
							<td>
								<div class="sneakySub">
									<input type="submit" name="change_pass_button" value="Изменить пароль" />
									<i class="l"><!--//--></i>
									<i class="r"><!--//--></i>						
								</div>
							</td>
						</tr>						
					</table>
					</form>
				</li>
				<? /*<li class="more link" onclick="$(this).next().toggle();">Удалить аккаунт</li>
				<li class="virgin link<?=($arResult["REMOVE_USER"])?'': ' script_hidden'?>">
					<?kdxShowErrors($arResult["ERRORS"]["REMOVE_USER"]);?>
					<form method="post">
						<input type="hidden" name="REMOVE_USER" value="Y" />
						<table class="formTable">
							<tr>
								<td colspan="2">Текущий пароль</td>
							</tr>
							<tr>
								<td><input type="password" class="textfield" name="CUR_PASS" /></td>							
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td>
								Вы уверены, что хотите удалить Ваш аккаунт?<br />
									<div class="sneakySub">
										<input type="submit" name="account_remove_button" value="Да, удалите мой аккаунт" />
										<i class="l"><!--//--></i>
										<i class="r"><!--//--></i>						
									</div>
								</td>
							</tr>						
						</table>
					</form>
				</li>*/?>
				
			</ul>
		</div>
	</div>
</div>
