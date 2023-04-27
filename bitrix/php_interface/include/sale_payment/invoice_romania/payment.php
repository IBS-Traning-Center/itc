<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?><?

$ORDER_ID = IntVal($GLOBALS["SALE_INPUT_PARAMS"]["ORDER"]["ID"]);
if ((!isset($ORDER_ID) or $ORDER_ID ==0)){
	$ORDER_ID = $_REQUEST['ORDER_ID'];
}
if (!is_array($arOrder))
	$arOrder = CSaleOrder::GetByID($ORDER_ID);
?><?

/*
Данный документ учитывает только налог с мнемоническим кодом "NDS". Остальные налоги при формировании документа не отображаются

Скопируйте этот файл в папку /bitrix/admin/reports и измените по своему усмотрению

$ORDER_ID - ID текущего заказа

$arOrder - массив атрибутов заказа (ID, доставка, стоимость, дата создания и т.д.)
Следующий PHP код:
print_r($arOrder);
выведет на экран содержимое массива $arOrder.

$arOrderProps - массив свойств заказа (вводятся покупателями при оформлении заказа) следующей структуры:
array(
	"мнемонический код (или ID если мнемонический код пуст) свойства" => "значение свойства"
	)

$arParams - массив из настроек Печатных форм

$arUser - массив из настроек пользователя, совершившего заказ
*/
?><?

$bShowPodpis = true;
if ($_REQUEST['SHOWPODPIS']=="N"){
	$bShowPodpis = false;
}
$db_props = CSaleOrderPropsValue::GetOrderProps($ORDER_ID);
while ($arProps = $db_props->Fetch())
{
    $arOrderProps[$arProps['CODE']] = $arProps['VALUE'];


}
$curr=4.5;
	//iwrite($arOrderProps);
?>
<?/*echo "<pre>"?>
<?print_r($arOrderProps);?>
<?print_r($arOrder);?>
<?echo "</pre>"*/?>
<html>

<head>
    <meta http-equiv=Content-Type content="text/html; charset=windows-1252">
    <meta name=Generator content="Microsoft Word 14 (filtered)">
    <style>
        <!--
            /* Font Definitions */
        @font-face
        {font-family:Calibri;
            panose-1:2 15 5 2 2 2 4 3 2 4;}
            /* Style Definitions */
        p.MsoNormal, li.MsoNormal, div.MsoNormal
        {margin-top:0cm;
            margin-right:0cm;
            margin-bottom:10.0pt;
            margin-left:0cm;
            line-height:115%;
            font-size:11.0pt;
            font-family:"Calibri","sans-serif";}
        .MsoChpDefault
        {font-family:"Calibri","sans-serif";}
        .MsoPapDefault
        {margin-bottom:10.0pt;
            line-height:115%;}
        @page WordSection1
        {size:595.3pt 841.9pt;
            margin:72.0pt 72.0pt 72.0pt 72.0pt;}
        div.WordSection1
        {page:WordSection1;}
        -->
    </style>

</head>

<body lang=RU>

<div class=WordSection1>

<table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 align=left
       width=830 style='width:622.75pt;border-collapse:collapse;margin-left:6.75pt;
 margin-right:6.75pt'>
<tr style='height:15.75pt'>
    <td width=212 nowrap colspan=2 valign=bottom style='width:159.15pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:15.75pt'>
        <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:12.0pt'>Furnizor:</span></b></p>
    </td>
    <td width=386 nowrap colspan=4 valign=bottom style='width:289.2pt;padding:
  0cm 5.4pt 0cm 5.4pt;height:15.75pt'>
        <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b><u><span lang=EN-US style='font-size:12.0pt'>LUXOFT PROFESSIONAL
  ROMANIA S.R.L.</span></u></b></p>
    </td>
    <td width=89 nowrap valign=bottom style='width:66.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'>
        <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='position:absolute;z-index:251658240;margin-left:22px;
  margin-top:2px;width:191px;height:112px'><img width=191 height=112
                                                src="/images/romania-logo.jpg"></span></p>
        <table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 align=left
               style='margin-left:-2.25pt;margin-right:-2.25pt'>
            <tr style='height:15.75pt'>
                <td width=75 nowrap valign=bottom style='width:56.0pt;padding:0cm 0cm 0cm 0cm;
    height:15.75pt'></td>
            </tr>
        </table>
    </td>
    <td width=78 nowrap valign=bottom style='width:58.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=65 nowrap valign=bottom style='width:48.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
</tr>
<tr style='height:31.5pt'>
    <td width=150 nowrap valign=top style='width:112.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:31.5pt'>
        <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:12.0pt'>Sediul:</span></b></p>
    </td>
    <td width=62 nowrap valign=bottom style='width:46.6pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:31.5pt'></td>
    <td width=386 colspan=4 valign=bottom style='width:289.2pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:31.5pt'>
        <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span lang=EN-US style='font-size:12.0pt'>Calea Floresca, nr. 167,
  parter, et. 3 si 6, Sector 1, Bucure&#351;ti</span></p>
    </td>
    <td width=89 nowrap valign=bottom style='width:66.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:31.5pt'></td>
    <td width=78 nowrap valign=bottom style='width:58.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:31.5pt'></td>
    <td width=65 nowrap valign=bottom style='width:48.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:31.5pt'></td>
</tr>
<tr style='height:15.75pt'>
    <td width=212 colspan=2 valign=bottom style='width:159.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'>
        <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:12.0pt'>CIF</span></b></p>
    </td>
    <td width=222 nowrap valign=bottom style='width:166.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'>
        <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:12.0pt'>RO</span></b><span
                style='font-size:12.0pt'>11027001</span></p>
    </td>
    <td width=47 nowrap valign=bottom style='width:35.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=59 nowrap valign=bottom style='width:44.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=58 nowrap valign=bottom style='width:43.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=89 nowrap valign=bottom style='width:66.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=78 nowrap valign=bottom style='width:58.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=65 nowrap valign=bottom style='width:48.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
</tr>
<tr style='height:15.75pt'>
    <td width=212 nowrap colspan=2 valign=bottom style='width:159.15pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:15.75pt'>
        <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:12.0pt'>Nr. Reg. Comer&#355;:</span></b></p>
    </td>
    <td width=222 nowrap valign=bottom style='width:166.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'>
        <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt'>J40/9614/1998</span></p>
    </td>
    <td width=47 nowrap valign=bottom style='width:35.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=59 nowrap valign=bottom style='width:44.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=58 nowrap valign=bottom style='width:43.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=89 nowrap valign=bottom style='width:66.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=78 nowrap valign=bottom style='width:58.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=65 nowrap valign=bottom style='width:48.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
</tr>
<tr style='height:15.75pt'>
    <td width=212 nowrap colspan=2 valign=bottom style='width:159.15pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:15.75pt'>
        <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:12.0pt'>Cont (IBAN):</span></b></p>
    </td>
    <td width=222 nowrap valign=bottom style='width:166.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'>
        <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt'>RO21RZBR0000060007220792</span></p>
    </td>
    <td width=47 nowrap valign=bottom style='width:35.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=59 nowrap valign=bottom style='width:44.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=58 nowrap valign=bottom style='width:43.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=89 nowrap valign=bottom style='width:66.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=78 nowrap valign=bottom style='width:58.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=65 nowrap valign=bottom style='width:48.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
</tr>
<tr style='height:15.75pt'>
    <td width=150 nowrap valign=bottom style='width:112.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'>
        <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:12.0pt'>Banca:</span></b></p>
    </td>
    <td width=62 nowrap valign=bottom style='width:46.6pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=222 colspan="4" nowrap valign=bottom style='width:166.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'>
        <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt'>RAIFFEISEN BANK-AG DOROBANTI</span></p>
    </td>
    <td width=47 nowrap valign=bottom style='width:35.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>

    <td width=89 nowrap valign=bottom style='width:66.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=78 nowrap valign=bottom style='width:58.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=65 nowrap valign=bottom style='width:48.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
</tr>
<tr style='height:15.75pt'>
    <td width=150 nowrap valign=bottom style='width:112.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=62 nowrap valign=bottom style='width:46.6pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=222 nowrap valign=bottom style='width:166.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=47 nowrap valign=bottom style='width:35.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=59 nowrap valign=bottom style='width:44.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=58 nowrap valign=bottom style='width:43.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=89 nowrap valign=bottom style='width:66.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=78 nowrap valign=bottom style='width:58.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=65 nowrap valign=bottom style='width:48.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
</tr>
<tr style='height:15.75pt'>
    <td width=150 nowrap valign=bottom style='width:112.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=62 nowrap valign=bottom style='width:46.6pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=222 nowrap valign=bottom style='width:166.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=47 nowrap valign=bottom style='width:35.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=59 nowrap valign=bottom style='width:44.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=58 nowrap valign=bottom style='width:43.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=89 nowrap valign=bottom style='width:66.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=78 nowrap valign=bottom style='width:58.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=65 nowrap valign=bottom style='width:48.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
</tr>
<tr style='height:16.5pt'>
    <td width=150 nowrap valign=bottom style='width:112.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:16.5pt'></td>
    <td width=448 nowrap colspan=5 valign=bottom style='width:335.8pt;padding:
  0cm 5.4pt 0cm 5.4pt;height:16.5pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:12.0pt'>                          
  F A C T U R &#258;</span></b></p>
    </td>
    <td width=89 nowrap valign=bottom style='width:66.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:16.5pt'></td>
    <td width=78 nowrap valign=bottom style='width:58.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:16.5pt'></td>
    <td width=65 nowrap valign=bottom style='width:48.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:16.5pt'></td>
</tr>
<tr style='height:15.75pt'>
    <td width=150 nowrap valign=bottom style='width:112.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=62 nowrap valign=bottom style='width:46.6pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=222 nowrap valign=bottom style='width:166.5pt;border-top:solid windowtext 1.0pt;
  border-left:solid windowtext 1.0pt;border-bottom:none;border-right:none;
  padding:0cm 5.4pt 0cm 5.4pt;height:15.75pt'>
        <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;color:black'>&nbsp;</span></p>
    </td>
    <td width=47 nowrap valign=bottom style='width:35.55pt;border:none;
  border-top:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:15.75pt'>
        <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;color:black'>&nbsp;</span></p>
    </td>
    <td width=59 nowrap valign=bottom style='width:44.0pt;border:none;border-top:
  solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:15.75pt'>
        <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;color:black'>&nbsp;</span></p>
    </td>
    <td width=58 nowrap valign=bottom style='width:43.15pt;border-top:solid windowtext 1.0pt;
  border-left:none;border-bottom:none;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:15.75pt'>
        <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;color:black'>&nbsp;</span></p>
    </td>
    <td width=89 nowrap valign=bottom style='width:66.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=78 nowrap valign=bottom style='width:58.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=65 nowrap valign=bottom style='width:48.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
</tr>
<tr style='height:15.75pt'>
    <td width=150 nowrap valign=bottom style='width:112.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=62 nowrap valign=bottom style='width:46.6pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=386 nowrap colspan=4 valign=bottom style='width:289.2pt;border-top:
  none;border-left:solid windowtext 1.0pt;border-bottom:none;border-right:solid black 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:15.75pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:12.0pt'>Seria
  si Nr : LUX 2015 - <?=$arOrderProps["ro_id"]?></span></b></p>
    </td>
    <td width=89 nowrap valign=bottom style='width:66.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=78 nowrap valign=bottom style='width:58.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=65 nowrap valign=bottom style='width:48.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
</tr>
<tr style='height:15.75pt'>
    <td width=150 nowrap valign=bottom style='width:112.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=62 nowrap valign=bottom style='width:46.6pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=222 nowrap valign=bottom style='width:166.5pt;border:none;
  border-left:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:15.75pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:12.0pt;
  color:black'>&nbsp;</span></p>
    </td>
    <td width=47 nowrap valign=bottom style='width:35.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=59 nowrap valign=bottom style='width:44.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=58 nowrap valign=bottom style='width:43.15pt;border:none;
  border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:15.75pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:12.0pt'>&nbsp;</span></p>
    </td>
    <td width=89 nowrap valign=bottom style='width:66.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=78 nowrap valign=bottom style='width:58.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=65 nowrap valign=bottom style='width:48.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
</tr>
<tr style='height:15.75pt'>
    <td width=150 nowrap valign=bottom style='width:112.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=62 nowrap valign=bottom style='width:46.6pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=386 nowrap colspan=4 valign=bottom style='width:289.2pt;border-top:
  none;border-left:solid windowtext 1.0pt;border-bottom:none;border-right:solid black 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:15.75pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:12.0pt'>Data:
  </span> <?=date('d.m.Y', strtotime($arOrder['DATE_INSERT_FORMAT']));?></b></p>
    </td>
    <td width=89 nowrap valign=bottom style='width:66.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=78 nowrap valign=bottom style='width:58.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=65 nowrap valign=bottom style='width:48.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
</tr>
<tr style='height:16.5pt'>
    <td width=150 nowrap valign=bottom style='width:112.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:16.5pt'></td>
    <td width=62 nowrap valign=bottom style='width:46.6pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:16.5pt'></td>
    <td width=222 nowrap valign=bottom style='width:166.5pt;border-top:none;
  border-left:solid windowtext 1.0pt;border-bottom:solid windowtext 1.0pt;
  border-right:none;padding:0cm 5.4pt 0cm 5.4pt;height:16.5pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:12.0pt'>&nbsp;</span></p>
    </td>
    <td width=47 nowrap valign=bottom style='width:35.55pt;border:none;
  border-bottom:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:16.5pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:12.0pt;
  color:black'>&nbsp;</span></p>
    </td>
    <td width=59 nowrap valign=bottom style='width:44.0pt;border:none;border-bottom:
  solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:16.5pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:12.0pt'>&nbsp;</span></p>
    </td>
    <td width=58 nowrap valign=bottom style='width:43.15pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:16.5pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:12.0pt'>&nbsp;</span></p>
    </td>
    <td width=89 nowrap valign=bottom style='width:66.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:16.5pt'></td>
    <td width=78 nowrap valign=bottom style='width:58.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:16.5pt'></td>
    <td width=65 nowrap valign=bottom style='width:48.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:16.5pt'></td>
</tr>
<tr style='height:15.75pt'>
    <td width=150 nowrap valign=bottom style='width:112.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=62 nowrap valign=bottom style='width:46.6pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=222 nowrap valign=bottom style='width:166.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=47 nowrap valign=bottom style='width:35.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=59 nowrap valign=bottom style='width:44.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=58 nowrap valign=bottom style='width:43.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=89 nowrap valign=bottom style='width:66.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=78 nowrap valign=bottom style='width:58.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=65 nowrap valign=bottom style='width:48.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
</tr>
<tr style='height:15.75pt'>
    <td width=212 nowrap colspan=2 valign=bottom style='width:159.15pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:15.75pt'>
        <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height: normal'><b><span style='font-size:12.0pt'>Beneficiar :</span></b></p>
    </td>
    <td width=222 class=MsoNormal nowrap valign=bottom style='width:166.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'><p style="margin: 0;" class=MsoNormal><?=$arOrderProps["se_name"]?> <?=$arOrderProps["name"]?></p></td>
    <td width=47 nowrap valign=bottom style='width:35.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=59 nowrap valign=bottom style='width:44.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=58 nowrap valign=bottom style='width:43.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=89 nowrap valign=bottom style='width:66.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=78 nowrap valign=bottom style='width:58.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=65 nowrap valign=bottom style='width:48.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
</tr>
<tr style='height:15.75pt'>
    <td width=212 nowrap colspan=2 valign=top style='width:159.15pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:15.75pt'>
        <p class=MsoNormal style='vertical-align: top;margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:12.0pt'>Sediul/adresa:</span></b> </p>
    </td>
    <td width=222 colspan="2" class=MsoNormal nowrap valign=bottom style='width:166.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'><p style="margin: 0;" class=MsoNormal><?=$arOrderProps["adr"]?></p></td>
    <td width=47 nowrap valign=bottom style='width:35.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=59 nowrap valign=bottom style='width:44.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=58 nowrap valign=bottom style='width:43.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=89 nowrap valign=bottom style='width:66.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=78 nowrap valign=bottom style='width:58.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=65 nowrap valign=bottom style='width:48.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
</tr>
<tr style='height:15.75pt'>
    <td width=220 colspan="2" nowrap valign=bottom style='width:112.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'>
        <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:12.0pt'>CNP:</span></b> </p>
    </td>

    <td width=222 class=MsoNormal nowrap valign=bottom style='width:166.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'><p style="margin: 0;" class=MsoNormal><?=$arOrderProps["CNP"]?></p></td>
    <td width=47 nowrap valign=bottom style='width:35.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=59 nowrap valign=bottom style='width:44.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=58 nowrap valign=bottom style='width:43.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=89 nowrap valign=bottom style='width:66.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=78 nowrap valign=bottom style='width:58.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=65 nowrap valign=bottom style='width:48.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
</tr>
<tr style='height:15.75pt'>
    <td width=212 nowrap colspan=2 valign=bottom style='width:159.15pt; padding:0cm 5.4pt 0cm 5.4pt;height:15.75pt; white-space: nowrap;'>
        <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b><span lang=EN-US style='font-size:12.0pt'>Seria si numar act de
  identitate:</span></b> </p>
    </td>
    <td width=222 class=MsoNormal nowrap valign=bottom style='width:166.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'><p style="margin: 0;" class=MsoNormal><?=$arOrderProps["id"]?></p></td>
    <td width=47 nowrap valign=bottom style='width:35.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=59 nowrap valign=bottom style='width:44.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=58 nowrap valign=bottom style='width:43.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=89 nowrap valign=bottom style='width:66.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=78 nowrap valign=bottom style='width:58.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=65 nowrap valign=bottom style='width:48.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
</tr>
<tr style='height:15.75pt'>
    <td width=212 nowrap colspan=2 valign=bottom style='width:159.15pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:15.75pt'>
        <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b><span style="margin: 0;" style='font-size:12.0pt'>Cont (IBAN):</span></b> </p>
    </td>
    <td class=MsoNormal width=222 nowrap valign=bottom style='width:166.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'><p style="margin: 0;" class=MsoNormal><?=$arOrderProps["iban"]?></p></td>
    <td width=47 nowrap valign=bottom style='width:35.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=59 nowrap valign=bottom style='width:44.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=58 nowrap valign=bottom style='width:43.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=89 nowrap valign=bottom style='width:66.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=78 nowrap valign=bottom style='width:58.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=65 nowrap valign=bottom style='width:48.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
</tr>
<tr style='height:15.75pt'>
    <td width=220 colspan="2" nowrap valign=bottom style='width:112.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'>
        <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:12.0pt'>Banca:</span></b> </p>
    </td>
    <td class=MsoNormal width=222 nowrap valign=bottom style='width:166.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'><p style="margin: 0;" class=MsoNormal><?=$arOrderProps["bank"]?></p></td>
    <td width=47 nowrap valign=bottom style='width:35.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=59 nowrap valign=bottom style='width:44.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=58 nowrap valign=bottom style='width:43.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=89 nowrap valign=bottom style='width:66.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=78 nowrap valign=bottom style='width:58.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=65 nowrap valign=bottom style='width:48.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
</tr>
<tr style='height:15.75pt'>
    <td width=150 nowrap valign=bottom style='width:112.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=62 nowrap valign=bottom style='width:46.6pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=222 nowrap valign=bottom style='width:166.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=47 nowrap valign=bottom style='width:35.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=59 nowrap valign=bottom style='width:44.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=58 nowrap valign=bottom style='width:43.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=89 nowrap valign=bottom style='width:66.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=78 nowrap valign=bottom style='width:58.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=65 nowrap valign=bottom style='width:48.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
</tr>
<tr style='height:15.75pt'>
    <td width=150 nowrap valign=bottom style='width:112.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=62 nowrap valign=bottom style='width:46.6pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=222 nowrap valign=bottom style='width:166.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=47 nowrap valign=bottom style='width:35.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=59 nowrap valign=bottom style='width:44.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=58 nowrap valign=bottom style='width:43.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=89 nowrap valign=bottom style='width:66.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=78 nowrap valign=bottom style='width:58.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=65 nowrap valign=bottom style='width:48.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
</tr>
<tr style='height:15.75pt'>
    <td width=150 nowrap valign=bottom style='width:112.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'>
        <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:12.0pt'>Cota T.V.A.:</span></b><span
                style='font-size:12.0pt'> <b>24%</b></span></p>
    </td>
    <td width=62 nowrap valign=bottom style='width:46.6pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=222 nowrap valign=bottom style='width:166.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=47 nowrap valign=bottom style='width:35.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=59 nowrap valign=bottom style='width:44.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=58 nowrap valign=bottom style='width:43.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=89 nowrap valign=bottom style='width:66.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=78 nowrap valign=bottom style='width:58.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=65 nowrap valign=bottom style='width:48.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
</tr>
<tr style='height:15.75pt'>
    <td width=150 rowspan=3 valign=bottom style='width:112.55pt;border:solid windowtext 1.0pt;
  border-bottom:solid black 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:15.75pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:12.0pt'>Nr.
  crt.</span></b></p>
    </td>
    <td width=284 colspan=2 rowspan=3 style='width:213.1pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0cm 5.4pt 0cm 5.4pt;height:15.75pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span lang=EN-US style='font-size:
  12.0pt'>Denumirea produselor sau a serviciilor</span></b></p>
    </td>
    <td width=47 rowspan=3 style='width:35.55pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0cm 5.4pt 0cm 5.4pt;height:15.75pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:12.0pt'>U.M.</span></b></p>
    </td>
    <td width=59 rowspan=3 style='width:44.0pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0cm 5.4pt 0cm 5.4pt;height:15.75pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:12.0pt'>Cantit.</span></b></p>
    </td>
    <td width=58 rowspan=3 style='width:43.15pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0cm 5.4pt 0cm 5.4pt;height:15.75pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span lang=EN-US style='font-size:
  12.0pt'>Pre&#355; unitar (f&#259;r&#259; TVA)<br>
  - lei -</span></b></p>
    </td>
    <td width=89 rowspan=3 style='width:66.8pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0cm 5.4pt 0cm 5.4pt;height:15.75pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:12.0pt'>Valoarea<br>
  - lei  -</span></b></p>
    </td>
    <td width=78 rowspan=3 valign=bottom style='width:58.8pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0cm 5.4pt 0cm 5.4pt;height:15.75pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:12.0pt'>Valoarea
  TVA                  -lei-</span></b></p>
    </td>
    <td width=65 nowrap valign=bottom style='width:48.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
</tr>
<tr style='height:15.75pt'>
    <td width=65 nowrap valign=bottom style='width:48.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
</tr>
<tr style='height:15.75pt'>
    <td width=65 nowrap valign=bottom style='width:48.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
</tr>

<?
//состав заказа
$t=0;
$db_basket = CSaleBasket::GetList(($b="NAME"), ($o="ASC"), array("ORDER_ID"=>$ORDER_ID));
while ($arItems = $db_basket->Fetch())
{
		//iwrite($arItems)
		$dbBasketProps = CSaleBasket::GetPropsList(
			array("SORT" => "ASC", "ID" => "DESC"),
			array(
					"BASKET_ID" => $arItems["ID"],
					"!CODE" => array("CATALOG.XML_ID", "PRODUCT.XML_ID")
				),
			false,
			false,
			array("NAME", "VALUE")
		);
		while($arBasketPropsTmp = $dbBasketProps->GetNext())
		{
				$arService[$arBasketPropsTmp['NAME']] = $arBasketPropsTmp["VALUE"];
		}
		$t++;
		$lei_price=intval($arItems["PRICE"]*$curr);
		/*echo "<pre>";
		print_r($arItems);
		echo "</pre>";*/
		?>
		<tr style='height:15.75pt'>
    <td width=150 nowrap style='width:112.55pt;border-top:none;border-left:solid windowtext 1.0pt;
  border-bottom:none;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:12.0pt;
  color:black'><?=$t?></span></p>
    </td>
    <td width=284 colspan=2 style='width:213.1pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:15.75pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:12.0pt;
  color:black'>servicii training <?=$arItems["NAME"]?> conform contract Nr <?=$arOrderProps["contract_number"]?>/Date <?=date('d.m.Y', strtotime($arOrder['DATE_INSERT_FORMAT']));?></span></p>
    </td>
    <td width=47 nowrap style='width:35.55pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:15.75pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:12.0pt'>&nbsp;</span></p>
    </td>
    <td width=59 nowrap style='width:44.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:15.75pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:12.0pt'><?=intval($arItems["QUANTITY"])?></span></p>
    </td>
    <td width=58 nowrap style='width:43.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:15.75pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:12.0pt'><?=round($lei_price-$lei_price*24/124, 2)?></span></p>
    </td>
    <td width=89 nowrap style='width:66.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:15.75pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:12.0pt;
  color:black'><?=$lei_price?></span></p>
    </td>
    <td width=78 nowrap style='width:58.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:15.75pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:12.0pt;
  color:black'><?=round($lei_price*24/124, 2)?></span></p>
    </td>
    <td width=65 nowrap valign=bottom style='width:48.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
  </tr>
  <?}?>

<tr style='height:15.75pt'>
    <td width=150 nowrap style='width:112.55pt;border:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:15.75pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:12.0pt;
  color:black'>&nbsp;</span></p>
    </td>
    <td width=284 colspan=2 style='width:213.1pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:15.75pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:12.0pt'>&nbsp;</span></p>
    </td>
    <td width=47 nowrap valign=bottom style='width:35.55pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:15.75pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:12.0pt'>&nbsp;</span></p>
    </td>
    <td width=59 nowrap style='width:44.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:15.75pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:12.0pt'>&nbsp;</span></p>
    </td>
    <td width=58 nowrap style='width:43.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:15.75pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:12.0pt'>&nbsp;</span></b></p>
    </td>
    <td width=89 nowrap valign=bottom style='width:66.8pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:15.75pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:12.0pt'><?=($arOrder["PRICE"]*$curr)?></span></b></p>
    </td>
    <td width=78 nowrap style='width:58.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:15.75pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:12.0pt'><?=round($arOrder["PRICE"]*$curr*24/124, 2)?></span></b></p>
    </td>
    <td width=65 nowrap valign=bottom style='width:48.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
</tr>
<tr style='height:15.75pt'>
    <td width=150 nowrap valign=bottom style='width:112.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=62 valign=bottom style='width:46.6pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=222 valign=bottom style='width:166.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=47 nowrap valign=bottom style='width:35.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=59 nowrap valign=bottom style='width:44.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=58 nowrap valign=bottom style='width:43.15pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0cm 5.4pt 0cm 5.4pt;height:15.75pt'>
        <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal'><b><span style='font-size:12.0pt'>TOTAL</span></b></p>
    </td>
    <td width=167 nowrap colspan=2 valign=bottom style='width:125.6pt;border-top:
  none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:15.75pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:12.0pt'><?=($arOrder["PRICE"]*$curr)?></span></b></p>
    </td>
    <td width=65 nowrap valign=bottom style='width:48.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
</tr>
<tr style='height:15.75pt'>
    <td width=150 nowrap valign=bottom style='width:112.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=62 valign=bottom style='width:46.6pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=222 valign=bottom style='width:166.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=47 nowrap valign=bottom style='width:35.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=59 nowrap valign=bottom style='width:44.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=58 nowrap valign=bottom style='width:43.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=89 nowrap valign=bottom style='width:66.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=78 nowrap valign=bottom style='width:58.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=65 nowrap valign=bottom style='width:48.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
</tr>
<tr style='height:15.75pt'>
    <td width=150 nowrap valign=bottom style='width:112.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=62 valign=bottom style='width:46.6pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=222 valign=bottom style='width:166.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=47 nowrap valign=bottom style='width:35.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=59 nowrap valign=bottom style='width:44.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=58 nowrap valign=bottom style='width:43.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=89 nowrap valign=bottom style='width:66.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=78 nowrap valign=bottom style='width:58.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=65 nowrap valign=bottom style='width:48.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
</tr>
<tr style='height:15.75pt'>
    <td width=434 nowrap colspan=3 valign=bottom style='width:325.65pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:15.75pt'>
        <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt'>Semnatura &#351;i &#351;tampila
  furnizorului</span></p>
    </td>
    <td width=47 nowrap valign=bottom style='width:35.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=59 nowrap valign=bottom style='width:44.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=58 nowrap valign=bottom style='width:43.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=89 nowrap valign=bottom style='width:66.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=78 nowrap valign=bottom style='width:58.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
    <td width=65 nowrap valign=bottom style='width:48.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:15.75pt'></td>
</tr>
</table>

<p class=MsoNormal>&nbsp;</p>

</div>

</body>

</html>
