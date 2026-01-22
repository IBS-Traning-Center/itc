<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? /*,http://jquery.bassistance.de/treeview/lib/jquery.cookie.js http://jquery.bassistance.de/treeview/jquery.treeview.js
		persist: "cookie"*/?>






<?//iwrite($arResult["ELEMENTS"]);?>
<div class="not-main-page gray" id="middle-content">
		<div class="frame no-top-padding">
			<div class="main-catalog main-catalog-single">
				<div class="course-items-list">
								<?foreach($arResult["ITEMS"] as $arSection):?>
								<div class="course-item">
									<div class="course-code">
										<?=$arSection['PROPERTY_PP_COURSE_CODE']?>
                                        <? if($arSection["PARAM"]["PROPERTY_NEW_ICON_VALUE"] == "Да"){ ?>
                                            <i class="icon newone">new</i>
                                        <?}?>
									</div>
									<div class="course-content">
										<div class="course-heading">
											<div class="course-name"><a href="/training/catalog/course.html?ID=<?=$arSection['PROPERTY_PP_COURSE_VALUE']?>"><?=$arSection['PROPERTY_PP_COURSE_NAME']?></a></div>
											<div class="course-duration"><span><?=$arSection['PARAM']['PROPERTY_COURSE_DURATION_VALUE']?> ч.</span></div>
										</div>
										<div class="course-description">
										<?=$arSection['PARAM']["PROPERTY_SHORT_DESCR_VALUE"]?>
										</div>
									</div>
								</div>
								<?endforeach;?>
								
							</div>
						
				</div>
			</div>
	</div>