<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<h2>Настроить выбор курсов</h2>
		<form action=""  name="create-recommend">
			<fieldset>
				<div class="text-box">
					<div class="row recc" >
						<h3>По локации:</h3>
						<div style="float: left">
						<input name="city[]" <?if (in_array(CITY_ID_MOSCOW, $arResult["city"])){?>checked<?}?> value="<?=CITY_ID_MOSCOW?>" type="checkbox" id="lb03"/>
						<label style="padding-left: 5px;" for="lb03">Москва</label><br/>
						<div style="clear:both"></div>
						<input name="city[]" <?if (in_array(CITY_ID_SPB, $arResult["city"])){?>checked<?}?>  value="<?=CITY_ID_SPB?>" type="checkbox" id="lb04"  />
						<label  style="padding-left: 5px;" for="lb04">Санкт-Петербург</label><br/>
						<div style="clear:both"></div>
						<input name="city[]" <?if (in_array(CITY_ID_OMSK, $arResult["city"])){?> checked<?}?>  value="<?=CITY_ID_OMSK?>" type="checkbox" id="lb05"  />
						<label  style="padding-left: 5px;" for="lb05">Омск</label><br/>
						<div style="clear:both"></div>
						<input name="city[]" <?if (in_array(CITY_ID_ONLINE, $arResult["city"])){?>checked<?}?>  value="<?=CITY_ID_ONLINE?>" type="checkbox" id="lb11"  />
						<label  style="padding-left: 5px;" for="lb11">Онлайн</label><br/>
						<div style="clear:both"></div>
						</div>
						<div style="float: left">
						<input name="city[]" <?if (in_array(CITY_ID_KIEV, $arResult["city"])){?>checked<?}?>  value="<?=CITY_ID_KIEV?>" type="checkbox" id="lb06"  />
						<label style="padding-left: 5px;" for="lb06">Киев</label><br/>
						<div style="clear:both"></div>
						<input name="city[]" <?if (in_array(CITY_ID_ODESSA, $arResult["city"])){?>checked<?}?>  value="<?=CITY_ID_ODESSA?>" type="checkbox" id="lb07"  />
						<label style="padding-left: 5px;" for="lb07">Одесса</label><br/>
						<div style="clear:both"></div>
						<input name="city[]" <?if (in_array(CITY_ID_DNEPR, $arResult["city"])){?>checked<?}?>  value="<?=CITY_ID_DNEPR?>" type="checkbox" id="lb08"  />
						<label style="padding-left: 5px;" for="lb08">Днепр</label><br/>
						<div style="clear:both"></div>
						
						</div>
						<div style="clear:both"></div>
					</div>
					<div class="row">
						<h3>По курсу:</h3>
						<input type="text" style="width: 400px;" id="search_field"  value="<?=$arResult["courseNAME"]?>"/>
						<input type="hidden" name="courseid" class="selectedid" value="<?=$arResult["course"]?>"/>
						<div style="clear:both"></div>
						<div style="font-size: 11px; color: #b1b1b1; line-height: 18px;">Автозаполнение. Введите несколько символов из кода или названия курса</div>
					</div>
					<div class="row cat">
						<h3>По направлению каталога:</h3>
						
						<?$next=ceil(count($arResult["cat"])/2)?>
						<?$t=0;?>
						<?foreach ($arResult["cat"] as $key=>$Cat) {?>
							
							<?$t++?>
							<?if ($Cat["DEPTH_LEVEL"]>$arResult["cat"][$key-1]["DEPTH_LEVEL"] && $key!=0) {?>
								<?echo "<div class='indent' id='cat".$arResult["cat"][$key-1]["ID"]."' >"?>
							<?}?>
							<?if ($Cat["DEPTH_LEVEL"]<$arResult["cat"][$key-1]["DEPTH_LEVEL"] && $key!=0) {?>
								</div>
							<?}?>
							
							<div class="cat-item">
							<?$parent="N"?>
							<?if ($arResult["cat"][$key+1]["DEPTH_LEVEL"]>$Cat["DEPTH_LEVEL"] && intval($arResult["cat"][$key+1]["DEPTH_LEVEL"])>0) {?>
								<?$parent="Y"?>
								<div class="plus-btn" data-open="#cat<?=$Cat["ID"]?>" ></div>
							<?}?>
						
							<input class="category-inp" name="category[]" <?if ($parent=="Y") {?>data-inner="#cat<?=$Cat["ID"]?>" <?}?> <?if (in_array($Cat["ID"], $arResult["category"])){?>checked<?}?> value="<?=$Cat["ID"]?>" type="checkbox" id="cb0<?=$Cat["ID"]?>"/>
							<label style="padding-left: 5px;" for="cb0<?=$Cat["ID"]?>"><?=$Cat["NAME"]?></label><br/>
							<div style="clear:both"></div>
							</div>
							<?/*if ($t==11) {?>
								</div><div style="float: left">
							<?}*/?>
						<?}?>
						
						<div style="clear: both">
					</div>

					<style>
						.dropdown {
							height: 300px !important;
						}
						.popup .recc  label {
							width: 230px;
							float: right;
						}
						.popup .cat .cat-item{
							height: 34px;
							padding-left: 23px;
							
							
						}
						.popup .cat .cat-item { 
							padding-top: 5px;
							vertical-align: top!important;
						}
						.popup .cat .cat-item span{ 
							vertical-align: top!important;
						}
						.popup .cat label {
							font: 14px/24px 'SegoeUIRegular';
							float: right;
							width: 530px;
							
						}
						.indent {
							display: none;
							padding-left: 25px;
						}
						.popup .cat .indent label{
							width: 505px;
						}
						.cat-item {
							position: relative;
						}
						.plus-btn {
							cursor: pointer;
							position: absolute;
							left: 0px;
							top: 12px;
							height: 16px;
							width: 16px;
							background: url('/bitrix/templates/en/images/but_plus.gif') no-repeat;
						}
						.plus-btn.clicked {
							background: url('/bitrix/templates/en/images/but_minus.gif') no-repeat;
						}
					</style>
					
				</div>
				
				<div class="bottom-buttons">
					<button name="save" value="ok">Сохранить настройки</button>
					<a href="#" class="close">Отмена</a>
				</div>
			</fieldset>
		</form>
		<script>
		/*
		$('.plus-item').each(function(){
				$(this).bind('click', function() {
					
				})
			})*/
		
		$(document).ready(function(){
			if (location.hash=="#rec-open") {
				$('.openModal').trigger('click');
			}
			$(window).bind('hashchange', function() {
				 if (location.hash=="#rec-open") {
					$('.openModal').trigger('click');
				 }
			});
			$('#search_field').autocomplete({
			source: function(request, response){
			$.ajax({
				type: 'POST',
				dataType: 'json',
				url: '/personal_test/admin/search.php?type=k',
				data:{
					maxRows: 6, // показать первые 12 результатов
					nameStartsWith: request.term // поисковая фраза
				},
				success: function(data){
					response($.map(data, function(item){
						return {
							id: item.id, // ссылка на страницу товара
							label: item.title_ru // наименование товара
						}
					}));
				}
			});
			},
			select: function(event, ui) {
			// по выбору - перейти на страницу товара
			// Вы можете делать вывод результата на экран
			ID = ui.item.id;
			$('.selectedid').val(ID);
			$.getJSON("maills.php?id="+ID, function(data) {
				$('.email-list').val(data.title);
			});
			//return false;
			},
			minLength: 2 // начинать поиск с трех символов
			})
		})
		</script>
