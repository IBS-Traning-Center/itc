<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? $index = 0;?>
<table cellspacing="0" cellpadding="0" border="0" style="width: 676px; border-collapse:collapse;">
							<tr>
								<td colspan="2" style="font-size: 26px; font-family: Arial; color: #c96262; text-align: center; " >
									Our News 
								</td>
							</tr>
						
                   							 
						<tr> 								<td> <img src="/images/email/spacer.gif" height="25" border="0"  /> 								</td> 							</tr>
							
							<?print_r($arResult);?>
							<?if (count($arResult["ITEMS"]) > 0){?>
								<?foreach($arResult["ITEMS"] as $key=>$arItem):?>
							<tr>
								<td style="width: 73px; padding-right: 14px;  vertical-align: top; ">
									<?if ($key==0) {?><img src="/images/digest2014/mag.jpg" /><?}?>
								</td>
								<td style="padding-bottom: 15px;">
									<a style='font-size: 17px; color: #4f5d73; font-family: Arial;' href='http://www.luxoft-training.com<?echo $arItem["DETAIL_PAGE_URL"]?>?utm_source=newsletter&utm_medium=email&utm_campaign=digest_<?=date('m')?>_2015'><?=$arItem["NAME"]?></a>
									<div style="font-size: 13px; color: #404040; font-family: Arial;">
									<?=$arItem["PREVIEW_TEXT"]?>
									</div>
								</td>
							</tr>
							<?endforeach;?>
							<?}?>
							<tr>
								<td colspan="2" style="border: 1px solid #dbdbdb; " >
								</td>
							</tr>
							<tr>
								<td>
									<img src="/images/email/spacer.gif" height="25" alt="" border="0"/>

								</td>
							</tr>
							
						</table>
