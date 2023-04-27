<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<table width="100%" cellspacing="0" cellpadding="0" style="margin: 0px; padding: 0px; border: 2px solid rgb(0, 64, 128);">
    <tbody>
    <tr> 							<td valign="middle" height="30" class="pad_null" style="margin: 0px; padding: 0px; background-color: rgb(0, 64, 128);">
            <div style="text-align: left; margin: 0px 0px 0px 15px; font-weight: bold; display: block; font-size: 16px; font-family: Arial, Helvetica, sans-serif; color: rgb(255, 255, 255);"> 									 БЛОГИ ЭКСПЕРТОВ LUXOFT TRAINING 								</div>
        </td>
    </tr>
    <tr>
        <td valign="top" class="pad_null" style="margin: 0px; padding: 0px; background-color: rgb(255, 255, 255);">
            <?
            foreach($arResult as $arBlog)
            {?>
                <?//iwrite($arBlog)?>
                <div style="clear:both">
                    <img src="/images/email/padding10.png" border="0" height="10"  />
                </div>
                <div style="text-align: left; margin: 5px 15px 3px; padding: 0px; font-size: 19px; font-family: Arial, Helvetica, sans-serif;">
                    <img src="<?=$arBlog["PICTURE"]["SRC"]?>" width="80" style="margin: 5px" border="0" align="left" hspace="5" vspace="2"  />
                    <a target="_blank" style="color:#FF6600; text-decoration:underline;font-size:19px;font-family:Arial,Helvetica,sans-serif;" href="http://www.luxoft-training.ru<?=$arBlog["urlToPost"]?>?r1=sbs&r2=<?=date('d_m_Y')?>" ><?=$arBlog["TITLE"]?></a>
					
					<div style="text-align: left; margin: 0px 15px 7px; padding: 0px; font-size: 14px; font-family: Arial, Helvetica, sans-serif; color: rgb(51, 51, 51);">
                    <?=$arBlog["AuthorName"]?>, <?=$arBlog["DATE_PUBLISH"];?>
					</div>
					
					<div style="text-align: left; margin: 10px 15px; padding: 0px; font-size: 12px; font-family: Arial, Helvetica, sans-serif; color: rgb(51, 51, 51);">
						<?=$arBlog["TEXT_FORMATED"]?>
					</div>
				</div>
                
               







            <?
            }
            ?>
        </td>
    </tr>
    </tbody>
</table>