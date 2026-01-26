<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<?if ($arResult["isFormErrors"] == "Y"):?><?=$arResult["FORM_ERRORS_TEXT"];?><?endif;?>

<?=$arResult["FORM_NOTE"]?>

<?if ($arResult["isFormNote"] != "Y")
{
?>
<?=$arResult["FORM_HEADER"]?>
		<div class="left-column">
            <div class="label">
                ФИО
            </div>
                        <input type="text" name="form_text_680" value="">
                        <div class="label">
                            Город
                        </div>
                        <input type="text" name="form_text_681" value="">
                          <div class="label">
                            Компания
                          </div>
                          <input type="text" name="form_text_682" value="">
                          <div class="label">
                            Должность
                          </div>
                          <input type="text" name="form_text_683" value="">
                          <div class="label">
                              Email
                          </div>
                          <input type="text" name="form_email_684" value="">
                          <div class="label">
                              Телефон
                          </div>
                          <input type="text" name="form_text_685" value="">
						   <input type="hidden" name="form_hidden_694" value="<?=$APPLICATION->GetCurPage();?>">
                      </div>
                      <div class="right-column">
                          <div class="label">
                              Сообщение
                          </div>
                          <textarea name="form_textarea_686"></textarea>
                      </div>
                      <div class="clearfix"></div>
                      <input class="orange rfloat" type="submit" name="web_form_apply" value="Заказать">
                      <a class="cancel rfloat" href="javascript:void(0)">Отмена</a>
                      <div class="clearfix"></div>
<?=$arResult["FORM_FOOTER"]?>
<?
} //endif (isFormNote)
?>