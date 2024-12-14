</div>
</div>
</div>

	<div class="footer-links">
			<div class="frame">
				<div class="footer-column-1 first">
					<a href="/educational_information/">Сведения об образовательной организации</a><br>
                    <a href="/about/company-details/">Реквизиты</a><br>
					<a href="/vacancies/">Вакансии</a><br>
					<a href="/sitemap.html">Карта сайта</a><br>
					<a target="_blank" href="/terms-of-use/">Условия использования</a><br>
					<a target="_blank" href="/privacy-policy/">Политика в сфере персональных данных</a><br>
					<div class="copyright">© <?=date('Y')?> IBS, all rights reserved</div>
				</div>
				
				<div class="footer-column-2">
					<div class="footer-heading">
						Мы в социальных сетях
					</div>
					<div class="ft-social">
						<a target="_blank" rel="nofollow" class="twitter" href="http://twitter.com/TrainingLuxoft"></a>
						<a target="_blank" rel="nofollow" class="vk" href="http://vkontakte.ru/luxoft_training"></a>
						<a target="_blank" rel="nofollow" class="facebook" href="http://www.facebook.com/TrainingCenterLuxoft"></a>
						<div class="clearfix"></div>
						<a target="_blank" rel="nofollow" class="in" href="http://www.linkedin.com/groups/Luxoft-Training-Center-3880622?trk=myg_ugrp_ovr"></a>
						<a target="_blank" rel="nofollow" class="gplus" href="https://plus.google.com/113581839150350545298/"></a>
						<a target="_blank" rel="nofollow" class="tube" href="http://www.youtube.com/user/LuxoftTrainingCenter"></a>
					</div>
				</div>
				<div class="footer-column-3">
					<div class="footer-heading">
						Сертификаты
					</div>
					<a href="/about/news/69341/"><img style="margin-bottom: 30px;" alt="IIBA" src="/local/assets/images/iiba.png"></a>

				</div>
				<div class="clearfix"></div>
				
			</div>
	</div>

<?/*
<div id="footer">
		<div class="frame">
			<ul class="footer-nav">
				<li><a href="/rss/">RSS</a></li>
				<li><a href="/contacts/">Контакты</a></li>
				<li><a href="/payment/rules.html">Правила и условия покупки услуг на сайте</a></li>
				<li><a href="/about/company-details/">Реквизиты</a></li>
			</ul>
			<?/*<a href="http://www.assist.ru" class="footer-logo"><img src="/images/logo-assist.png" alt="ASSIST" /></a>
			<img src="/images/img-payments.png" alt="" />
		</div>
	</div>*/?>
	<?$APPLICATION->IncludeFile(
    $APPLICATION->GetTemplatePath("/bitrix/templates/.default/en/include_areas/analytics.html"),
    Array(),
    Array("MODE"=>"php")
);?>

<script>
    window.addEventListener('onBitrixLiveChat', function(event){
        var widget = event.detail.widget;
        widget.setOption('checkSameDomain', false);
    });
</script>

<script type="text/javascript">
    (function(w,d,u){
        var s=d.createElement('script');s.async=true;s.src=u+'?'+(Date.now()/60000|0);
        var h=d.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);
    })(window,document,'https://crm.ibs-training.ru/upload/crm/site_button/loader_2_43u4sb.js');
</script>
<!--End of Tawk.to Script-->

</body>

</html>

<script>
$(document).ready(function() {
	
	rNotif();
});
</script>