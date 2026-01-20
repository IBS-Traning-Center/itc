<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


<?$index = 1;?>
<div class="success-story-list">
						
<?foreach($arResult["ITEMS"] as $arItem):?>
<? $client_otzyv = nl2br($arItem['PROPERTIES']['otzyv']['VALUE']); ?>
<div class="success-item">
							<div style="background: #fff  url(<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>) center center no-repeat; background-size: 120px auto;" class="success-picture">
							</div>
							<div class="succes-name">
								<?echo $arItem["NAME"]?>
							</div>
							<div class="success-description">
								<p><?=$client_otzyv?><</p>
								<?/*<a class="file pdf" href="#">Читать</a>*/?>
							</div>
							
						</div>    	

		
<?endforeach;?>
</div>
<!--
<table width="100%" cellspacing="0" class="info_1">
	<tbody>
    	<tr>
    		<td class="client_speak_name">
        		<p><strong><img src="/images/clients/client_deutschebank_small.jpg">Daniel Marovitz,</strong>
          		<br />Управляющий директор по производству и технологиям Deutsche Bank</p>
				<p  class="client_speak">"Нас привлекла компетенция команды Luxoft. Более 60% сотрудников Luxoft – опытные специалисты, работающие в IT свыше 7 лет; более 80% – дипломированные специалисты или имеют кандидатскую степень. Они работают с такими лидерами рынка, как Boeing и Dell. В Luxoft мы встретили экспертов готовых с пристрастием допрашивать клиента, то, в чем Вы так нуждаетесь при осуществлении сложных комплексных проектов."</p>
       		</td>
       		<td class="client_speak_name">
        		<p><strong><img src="/images/clients/client_renesans_small.gif">Ярослав Медокс,</strong>
          		<br />Директор департамента развития информационных систем КБ Ренессанс Кредит</p>
				<p class="client_speak">"Компания Luxoft проявила себя как компетентный и надежный партнер, обладающий глубокими знаниями в области банковских технологий и способный найти подход к решению самых сложных задач. Cозданный фундамент нашего сотрудничества позволит и в будущем развивать и совершенствовать современные эффективные инструментарии, используемые в КБ Ренессанс Кредит."</p>
       		</td>
		</tr>
	</tbody>
</table>
-->