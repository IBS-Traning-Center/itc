<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
				<table cellspacing="0" cellpadding="0" border="0" style="width: 676px; border-collapse:collapse;">
				
				<tr>
					<td>
						<table cellspacing="0" cellpadding="0" border="0" style="width: 676px; border-collapse:collapse;">

            <?
            foreach($arResult as $arBlog)
            {?>
				<?//echo "<pre>"?>
                <?//print_r($arBlog)?>
				<?//echo "</pre>";?>
				<tr>
					<td style="width: 86px; vertical-align: top; padding-bottom: 8px;">
						<img src="<?=$arBlog["PICTURE"]["SRC"]?>" width="80"/>
					</td>
					<td style="width: 590px; vertical-align: top; font-family: Arial; padding-bottom: 8px;">
						<div style="margin-bottom: 10px;">
							<a style="font-family: Arial; font-size: 17px; color: #4f5d73;" href="http://www.luxoft-training.ru<?=$arBlog["urlToPost"]?>?r1=sbs&r2=<?=date('d_m_Y')?>"><?=$arBlog["TITLE"]?></a>
						</div>
					<div style="font-family: Arial; font-size: 17px; color: #4f5d73;">
							<?=$arBlog["AuthorName"]?> <?=$arBlog["DATE_PUBLISH"];?>
					</div>
					</td>
				</tr>
				<tr>
					<td colspan="2" style="padding-bottom:15px;">
						<div style="font-size: 13px; font-family: Arial; color: #404040;" >
							<?=$arBlog["TEXT_FORMATED"]?>
						</div>
					</td>
				</tr>
				<?/*
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
                */?>
               







            <?
            }
            ?>
			</table>
					</td>
				</tr>
				<tr>
					<td colspan="2" style="border: 1px solid #dbdbdb; " >
					</td>
				</tr>
				<tr>
					<td>
						<img src="/images/email/spacer.gif" height="7" alt="" border="0"/>
					</td>
				</tr>
			</table>