<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$datetolink=date('d_m_Y')?>
<table width="100%" cellspacing="0" cellpadding="0" style="margin: 0px; padding: 0px; border: 2px solid rgb(0, 64, 128);">
    <tbody>
    <tr>
        <td valign="middle" height="30" style="margin: 0px; padding: 0px; background-color: rgb(0, 64, 128);" class="pad_null">
            <div style="text-align: left; margin: 0px 0px 0px 15px; font-weight: bold; display: block; font-size: 16px; font-family: Arial, Helvetica, sans-serif; color: rgb(255, 255, 255);"> 								 НОВОСТИ LUXOFT TRAINING 							</div>
        </td>
    </tr>
    <tr>
        <td valign="top" style="margin: 0px; padding: 0px; background-color: rgb(255, 255, 255);" class="pad_null">


<?foreach($arResult["ITEMS"] as $arItem):?>
     <div style="text-align: left; margin: 10px 15px; padding: 0px; font-size: 12px; font-family: Arial, Helvetica, sans-serif; color: rgb(28, 84, 141);">
          <b>
              <a style="margin:3px 0px 9px 0px;text:decoration:underline; font-size:12px; color:#1C548D; display:inline;" href="http://www.luxoft-training.ru<?=$arItem["DETAIL_PAGE_URL"]?>?r1=sbs&r2=<?=$datetolink?>"><?=$arItem["NAME"]?></a>
          </b>
          <br/>
         <br/>
         <?=$arItem["PREVIEW_TEXT"]?>
        <br/>

	</div>
<?endforeach;?>
        </td>
    </tr>
    </tbody>
</table>
