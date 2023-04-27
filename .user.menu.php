<?
$aMenuLinks = Array(
	Array(
		"Вход", 
		"/auth/index.html", 
		Array(), 
		Array(), 
		'!$USER->IsAuthorized()'
	),
	Array(
		"Регистрация", 
		"/auth/registration.html", 
		Array(), 
		Array(), 
		'!$USER->IsAuthorized()' 
	)
);
?>