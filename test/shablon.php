<head>
    <style>
        body {
            margin: 0;
            padding: 0;
        }
        #our_template table{
            background-color: white;
            border-collapse:collapse;
        }
    </style>
</head>
<body>
<div id="our_template" style="width: 600px;">
<table cellspacing="0" cellpadding="0" border="0" bgcolor="white" width="600" style="border-collapse:collapse; border:none;">
<tbody>
<tr>
	<td style="padding-top: 28px;">
		<a href="http://ibs-training.ru"><img src="http://ibs-training.ru/images/elearn/logo.jpg"/></a>
	</td>
</tr>
<tr>
	<td style="text-align: center;">
		<img src="http://ibs-training.ru/images/elearn/information-about-coreses.jpg"/>
	</td>
</tr>
<tr>
	<td style="padding: 0 20px; color: #00407f; font-family: Arial; font-size: 14px;" >
		<div style="">Приглашаем Вас посетить следующие курсы и семинары, которые состоятся в <span style="color:#ff6600;font-weight:bold;">ближайшее время</span>:</div>
		<div>#LIST_COURSES_SM#</div>
		<div><span style="color:#ff6600;font-weight:bold;">Важно!</span> Чтобы зарегистрироваться: на заинтересовавший Вас курс, необходимо заполнить заявку в IntHR. Сделать это можно прямо из <a target="_blank" style="text-decoration:underline;font-weight:bold;" href="https://inthr.luxoft.com/inthrwebapp/aspx_PTC/CreateRequestInternal.aspx?Context=0">Каталога курсов</a> или <a target="_blank" style="text-decoration:underline;font-weight:bold;" href="https://inthr.luxoft.com/IntHRWebApp/aspx_PTC/CreateRequestTraining.aspx?Context=0">Расписания курсов</a>. Участие в тренингах бесплатное, при условии утверждения руководителем заявки на соответствующий курс в IntHR</div>
	</td>
</tr>
<tr>
	<td style="padding: 28px 20px 0; color: #00407f; font-family: Arial; font-size: 14px;">
		<table  cellspacing="0" cellpadding="0" border="0"  style="border-collapse:collapse; border:none; width: 100%">
			<tr>
				<td valign="top" style="width: 60px;"><img src="http://ibs-training.ru/images/elearn/owl.jpg"/></td>
				<td valign="top" style="color: #00407f; font-family: Arial; font-size: 14px;"  ><div style="color: #00407f; font-family: Arial; font-size: 22px; margin-bottom: 16px;">LUXOFT TRAINING NEWS</div>
				<p><b>#HEADER_NEWS#</b></p>
                <div>#CONTENT_NEWS#</div>
				</td>
			</tr>
		</table>
	</td>
</tr>
<tr>
	<td style="padding: 51px 20px 0;">
		<table cellspacing="0" cellpadding="0" border="0"  style="border-collapse:collapse; border:none; width: 100%">
			<tr>
				<td style="padding: 13px 20px 30px; color: #00407f; font-family: Arial; font-size: 14px; background: #edf2f6;">
					<div style="color: #e25a10; text-align: center; font-size: 22px; font-weight: bold; margin-bottom: 15px;">ВОПРОС? ОТВЕТ!</div>
					<div>
						<p><b>Вопрос:</b> #QUESTION#</p>
						<p>#ANSWER#</p>
					</div>
				</td>
			</tr>
		</table>
	</td>
</tr>
<tr>
	<td style="padding: 27px 20px 0; color: #00407f; font-family: Arial; font-size: 14px;">
		<div style="font-size: 22px; font-weight: bold; text-align: center; margin-bottom: 16px;">ПОДРОБНЕЕ О КУРСАХ</div>
		#LIST_COURSES_B#
	</td>
</tr>
<tr>
	<td style="padding: 20px 20px 0;">
		<table cellspacing="0" cellpadding="0" border="0"  style="border-collapse:collapse; border:none; width: 100%">
			<tr>
				<td style="padding: 13px 10px 30px 20px; width: 257px; color: #00407f; font-family: Arial; font-size: 12px; background: #edf2f6;">
					<p style="font-size: 12px; margin-bottom: 14px; color: #00407f;"><b>C уважением,<br/> Команда Luxoft Training</b></p>
                <div style="font-size: 12px; color: #00407f;">
                    <a style="text-decoration:underline; " href="mailto:<?=EMAIL_ADDRESS_TRAINING?>"><?=EMAIL_ADDRESS_TRAINING?></a><br/>
                    <a style="text-decoration:underline; " href="http://ibs-training.ru/">ibs-training.ru</a> &ndash; сайт Luxoft Training <br/>
                    <a style="text-decoration:underline; " href="https://sentinel2.luxoft.com/sen/wiki/display/HRDEP/Luxoft+Training">Luxtown 2.0</a> &ndash; внутренний портал Luxoft Training, вся необходимая информация для сотрудников<br/>
<a style="text-decoration:underline; " href="https://e-learning.luxoft.com">E-learning</a> &ndash; библиотека самообразования
</div>
				</td>
				<td style="padding: 13px 20px 30px  15px; color: #00407f; font-family: Arial; font-size: 12px; background: #edf2f6;">
				<div style="margin-bottom: 4px;"><span style="font-weight:bold;font-size:12px;">Москва</span> – Галина Вишневская, (850) 2514</div>
                <div style="margin-bottom: 4px;"><span style="font-weight:bold;font-size:12px;">Киев</span> – Ирина Смирнова, (851) 4809</div>
                <div style="margin-bottom: 4px;"><span style="font-weight:bold;font-size:12px;">Омск</span> – Дарья Судейкина, (850) 3953</div>
                <div style="margin-bottom: 4px;"><span style="font-weight:bold;font-size:12px;">Санкт-Петербург</span> – Юлия Васильева, (850) 3409</div>
                <div style="margin-bottom: 4px;"><span style="font-weight:bold;font-size:12px;">Одесса</span> – Елена Чантурия, (851) 4010</div>
                <div style="margin-bottom: 4px;"><span style="font-weight:bold;font-size:12px;">Днепропетровск</span> – Ирина Палько, (851) 4910</div>
				</td>
			</tr>
		</table>
	</td>
</tr>
<tr>
	<td style="padding: 20px 20px 0; color: #00407f; font-family: Arial; font-size: 12px;">
		С наилучшими пожелания, <br/>
		Luxoft Training
	</td>
</tr>
<tr>
	<td style="padding: 20px 20px 30px;">
		<img src="http://ibs-training.ru/images/elearn/footer.jpg"/>
	</td>
</tr>
</table>
</div>
</body>
