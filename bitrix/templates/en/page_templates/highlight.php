			<div id="rotating_headlines" class="box_headline"> <!-- область где смена изображений -->
				<div class="headline_article">
						<div style="" id="rotating_headlines_1" class="headline_article_holder">
							<div class="headline_image">
							<img src="/upload/iblock/6a9/highlight_3.jpg" alt="" title="Luxoft is a global engineering and high-end IT outsourcing services company with the largest capabilities in Eastern Europe" align="left" width="262" height="163" />
							<a class="white" href="/about/">Luxoft is a global engineering and high-end IT outsourcing services company with the largest capabilities in Eastern Europe</a>
					   		</div>
					   </div>
				</div>
				<div class="headline_article">
						<div id="rotating_headlines_2" class="headline_article_holder" style="display: none;">
							<div class="headline_image">
							<img src="/upload/iblock/dc8/highlight_2.jpg" alt="" title="Competition is fierce in the investment community. Faced with the challenges to optimize business performance and increase market" align="left" width="262" height="163" />
							<a class="" href="/industries/finance.html">Competition is fierce in the investment community. Faced with the challenges to optimize business performance and increase market</a>
					   		</div>

					   </div>
				</div>
				<div class="headline_article">
						<div id="rotating_headlines_3" class="headline_article_holder" style="display: none;">
							<div class="headline_image">
							<img src="/upload/iblock/0cd/highlight_1.jpg" alt="" title="Luxoft Integrated IT Services family leverages innovative processes, technologies, delivery models and accumulated best practices" align="left" width="262" height="163" />
							<a class="white" href="/about/">Luxoft Integrated IT Services family leverages innovative processes, technologies, delivery models and accumulated best practices</a>

					   		</div>
					   </div>
				</div>
				<div class="player">
						<ul id="rotating_headlines_player">
								<li><a class="active" href="#rotating_headlines_1" title="Engineering Business Performance">1</a></li>
								<li><a class="" href="#rotating_headlines_2" title="Luxoft Experience in Banking &amp; Finance">2</a></li>
								<li><a class="" href="#rotating_headlines_3" title="Luxoft Services">3</a></li>
						</ul>
				</div> <!-- end id = player кнопочки для плеера -->
		 	</div> <!-- end id = rotating_headlines  -->
			<?
			global $USER;
			if (!$USER->IsAdmin()) {
			?>
			<script type="text/javascript" src="/bitrix/templates/en/js_main/compress.js"></script>
			<? } ?>
			<script type="text/javascript">
				var rotating_headlines_tabs = new RotatingHeadlines('rotating_headlines', 10);
			</script>