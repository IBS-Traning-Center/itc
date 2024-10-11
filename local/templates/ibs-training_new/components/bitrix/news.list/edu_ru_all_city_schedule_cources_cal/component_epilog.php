<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
{
	die();
}?>

<? if(count($arResult["ELEMENTS"])==0) {?>
	<div class="frame">К сожалению, на данную тематику нет запланированных курсов в открытом расписании. <a href="/training/katalog_kursov/?qcat=<?=$_REQUEST["qcat"]?>">Искать курс в каталоге</a></div><br/></br/>
<?}?>