<?if (((file_exists($filename2) or (file_exists($filename1)))
and ((strstr($filename1, '_inc')) or (strstr($filename2, '_inc'))) ) ) {?>
                </div>
<? } ?>
				</div><!-- end id = column2  -->
	<div class="clear"></div>
	<div class="print-padding">
	<div>
		<a href="#"  rel="nofollow" onclick="window.print();">Печать</a>
	</div>
	<div>
		<a href="#"  rel="nofollow" onclick="SetPrintCSS(false)" id="print_link_back">Выйти из версии для печати</a>
	</div>
	</div> 
	</div><!-- end id = content  -->

		<div id="footer">
           <?$APPLICATION->IncludeFile(
					$APPLICATION->GetTemplatePath("/bitrix/templates/en/include_areas_main_v5/footer.html"),
					Array(),
					Array("MODE"=>"php")
			);?>
		</div> <!-- end id = footer  -->
	</div><!-- end id = container  -->
<script>
	$(document).ready(function() {
		
		if (location.hash=="#print") {
			SetPrintCSS(true);
		}
	})
</script>
<?$APPLICATION->IncludeFile(
    $APPLICATION->GetTemplatePath("/bitrix/templates/en/include_areas/analytics.html"),
    Array(),
    Array("MODE"=>"php")
);?>


 </body>
</html>