<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$arTime = ParseDateTime(date('d.m.Y H:i:s'), "DD.MM.YYYY HH:MI:SS");
if (isset($_REQUEST['month']) and (isset($_REQUEST['day']))){
	if ((intval($_REQUEST['month'])>0) and (intval($_REQUEST['day'])>0)
	 and (intval($_REQUEST['month'])<13) and (intval($_REQUEST['day'])<32)){
		$arTime["DD"] = intval($_REQUEST['day']);
		$arTime["MM"] = intval($_REQUEST['month']);
	}
}

$GLOBALS["arrTime"] = array("DD" => $arTime["DD"], "MM"=> $arTime["MM"]);
$GLOBALS["arrFilter"] = array("ACTIVE" => "Y", "=PROPERTY_EVENT_DAY" => $arTime["DD"], "=PROPERTY_EVENT_MONTH" => $arTime["MM"]);
?>
<style>
.lgreen:active {
    border: 1px solid #333!important;
    }
</style>

					<script language="JavaScript">
					months = new Array();
					months[1] = 31;months[2] = 28;months[3] = 31;months[4] = 30;months[5] = 31;months[6] = 30;
					months[7] = 31;months[8] = 31;months[9] = 30;months[10] = 31;months[11] = 30;months[12] = 31;
					function FillDays(el)
					{
						var m = el.selectedIndex+1;
						del = el.form.elements['day'];
						del.options.length = 0;
						for (var i=1; i<=months[m]; i++)
						{
							del.options.length = i;
							del.options[i-1].value=i;
							del.options[i-1].text=i+' ';
						}
					}
					function SelectDay(f)
					{
						var m = <?=$arTime["MM"]?>;
						var d = <?=$arTime["DD"]?>;
						f.elements['month'].selectedIndex = m-1;
						f.elements['day'].selectedIndex = d-1;
					}
					</script>

<div class="buble_body" style="-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;">

<div class="bform1">
<h2>Выбрать другой день:</h2><br />
<form name="calendar">
					
					<select name="day"><option></select> <select name="month" onchange="FillDays(this)"><option value="1">января<option value="2">февраля<option value="3">марта<option value="4">апреля<option value="5">мая<option value="6">июня<option value="7">июля<option value="8">августа<option value="9">сентября<option value="10">октября<option value="11">ноября<option value="12">декабря</select>
<br /><br />
					<input type="submit" style="margin: 0 0 5px 0;padding: 4px 2px;border: 1px solid #AACFE4; width:170px;" tabindex="30" class="lgreen" value="Показать"/>
</form>
 </div>
 </div>
					<script type="text/javascript">
					FillDays(document.forms['calendar'].elements['month']);
					SelectDay(document.forms['calendar']);
					</script>

