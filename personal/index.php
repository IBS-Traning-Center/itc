<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Персональный раздел");
?><p>В личном кабинете Вы можете проверить текущее состояние корзины, ход выполнения Ваших заказов, просмотреть или изменить личную информацию, а также подписаться на новости и другие информационные рассылки. </p>

<h2>Личная информация</h2>
<blockquote>
<ul>
	<li><a href="profile/">Изменить регистрационные данные</a></li>
	<li><a href="profile/?change_password=yes">Изменить пароль</a></li>
	<li><a href="/auth/forgot_pass.html">Забыли пароль?</a></li>
</ul>
</blockquote>
<h2>Заказы</h2>
<blockquote>
<ul>
	<li><a href="order/">Ознакомиться с состоянием заказов</a></li>
	<li><a href="cart/">Посмотреть содержимое корзины</a></li>
	<li><a href="cart/">Посмотреть отложенные услуги</a></li>

	<li><a href="order/?filter_history=Y">Посмотреть историю заказов</a></li>
</ul>
</blockquote>
<h2>Подписка</h2>
<blockquote>
<ul>
	<li><a href="subscribe/">Изменить подписку</a></li>
</ul>
</blockquote>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>