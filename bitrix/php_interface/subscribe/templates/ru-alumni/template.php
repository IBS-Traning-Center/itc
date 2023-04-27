<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $SUBSCRIBE_TEMPLATE_RUBRIC;
$SUBSCRIBE_TEMPLATE_RUBRIC=$arRubric;
global $APPLICATION;
?>
<?/*
Alumni Edit

http://ibs-training.ru/rss/city/alumni.html
http://ibs-training.ru/bitrix/admin/fileman_file_edit.php?lang=ru&site=ru&path=/rss/city/alumni.html&full_src=Y
http://ibs-training.ru/bitrix/admin/fileman_file_edit.php?lang=ru&site=ru&path=/bitrix/templates/en/components/edu/news.list/edu_allcity_rss_alumni/template.php&full_src=Y
/bitrix/admin/fileman_file_edit.php?path=%2Fbitrix%2Ftemplates%2F.default%2Fcomponents%2Fartions%2Fsuper.component%2Fsubscribe.reward.alumni%2Ftemplate.php&full_src=Y&site=ru&lang=ru&&filter=Y&set_filter=Y
http://www.luxoft.ru/rss/alumni.vacancies.php
*/?>
<?
$curDateView = date("d.m.Y");
$nextmonth = mktime(0, 0, 0, date("m"), date("d")+14,   date("Y"));
$next2WeekDate = date("d.m.Y", $nextmonth) ;
?>
<html>
<body style="margin:0; padding:0; width:600px!important;">
<div style="width:600px;" id="send-body">
<table style="background-color:#ffffff;" width="600" align="left" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td bgcolor="#042557" style="background-image: url('/images/newsletter-al/bg-top.gif'); background-repeat: repeat-x;" height="75" valign="top">

        <table border="0" cellspacing="0" cellpadding="0" align="center" style="width: 100%; max-width: 600px;">

            <tr>
                <td valign="top" align="center">

                    <table width="490" border="0" cellspacing="0" cellpadding="0" align="left">

                        <tr>
                            <td style="padding-top: 13px; padding-left: 10px; padding-right: 30px;">

                                <table width="410" align="left">

                                    <tr>
                                        <td style="color: #ffffff; font-size: 30px; font-weight:bold; font-family: arial;">
                                            <img src="/images/newsletter-al/alumni-newsletter-header.png" width="304" height="19" alt="Luxoft Alumni Newsletter" border="0" />
                                        </td>

                                    </tr>

                                    <tr>
                                        <td style="color: #ffffff; font-size: 13px; font-family: arial;">
                                            <?=$curDateView?>
                                        </td>

                                    </tr>

                                </table>
                            </td>

                        </tr>

                    </table>

                    <table width="90" align="left" border="0" cellspacing="0" cellpadding="0">

                        <tr>
                            <td style="padding-top: 20px; padding-left: 10px; color: #c4cbf1; font-size: 11px; font-family: arial;" height="25" valign="top" align="left" width="300">
                                <a href="http://www.luxoft.com/">
                                    <img src="/images/newsletter-al/alumni-newsletter-logo.png" width="65" height="31" alt="Luxoft Logo" border="0" />
                                </a>
                            </td>

                        </tr>

                    </table>
                </td>

            </tr>

        </table>
    </td>
</tr>
<tr>
    <td height="182" valign="top" bgcolor="#f4f4f4">
        <img src="/images/newsletter-al/pinguin.jpg" width="600" height="182" alt="Luxoft Alumni Newsletter Logo" border="0" />
    </td>
</tr>
<tr>
    <td style="background-color: #ffffff;" valign="top">

        <table border="0" cellspacing="0" cellpadding="0" align="center" style="width: 100%; max-width: 600px;">

            <tr>
                <td valign="top" align="center" >

                    <table width="440" border="0" cellspacing="0" cellpadding="0" align="left">

                        <tr>
                            <td style="color:#333333; font-family: arial; font-size:11px; padding-top: 0px; padding-left: 45px; padding-right: 13px;">
                                Уважаемые участники клуба!<br />
                                Luxoft представляет Вашему вниманию очередной выпуск Alumni newsletter.
                                В этом выпуске мы собрали для Вас только самую актуальную информацию и самые интересные новости.
                                Надеемся, что этот выпуск окажется полезным для Вас!
								<br />
                                <br />
                         						<font size="4"><b><a style="font-size: 16px;  color: rgb(17, 78, 136);" href="#news" >НОВОСТИ</a> 
								<br />
                                <br />
                             						<a style="font-size: 16px;  color: rgb(17, 78, 136);" href="#vacancy" >ГОРЯЩИЕ ВАКАНСИИ LUXOFT</a> 
								<br />
                                <br />
                             						<a style="font-size: 16px;  color: rgb(17, 78, 136);" href="#vnesh" >ВНЕШНИЕ ВАКАНСИИ </a> 
								<br />
                                <br />
								<a style="font-size: 16px;  color: rgb(17, 78, 136);" href="#raspis" >РАСПИСАНИЕ ТРЕНИНГОВ УЧЕБНОГО ЦЕНТРА LUXOFT </a></b></font> 
								<br />
                                <br />
                            </td>

                        </tr>

                    </table>

                    <table width="130" align="left" border="0" cellspacing="0" cellpadding="0">

                        <tr>
                            <td style="padding-top: 60px; padding-left: 0px; color: #114e88; font-size: 11px; font-family: arial; font-weight:bold;" valign="top" align="left" width="300">
                                Федоренко Вероника<br />
                                Luxoft Alumni Club
                            </td>

                        </tr>

                    </table>
                </td>

            </tr>

        </table>
    </td>
</tr>
<tr>
    <td height="20">
        &nbsp;
    </td>
</tr>
<tr>
    <td height="30" valign="middle" class="pad_null" style="margin: 0px; padding: 0px; background-color: rgb(0, 64, 128);">
        <a name="news"></a> 
		<div style="text-align: left; margin-left:25px; font-weight: bold; display: block; font-size: 14px; font-family: Arial,Helvetica,sans-serif; color: rgb(255, 255, 255);">
            НОВОСТИ
        </div>
    </td>
</tr>
<tr>
    <td height="10">
        &nbsp;
    </td>
</tr>
<tr>
    <td>

        <table border="0" cellspacing="0" cellpadding="0" align="center" style="width: 100%; max-width: 600px;">

            <tr>
                <td valign="top" align="left" style="color: #333333; font-size: 12px; font-family: arial; padding-left: 45px; padding-right: 45px;">
                    <div id="edit_text_secondary">
                        <?
                        CModule::IncludeModule("iblock");
                        $arSelect = Array("ID", "NAME", "PREVIEW_TEXT");
                        $arFilter = Array(
                            "IBLOCK_ID" => 123,
                            "ACTIVE" => "Y",
                        );
                        $arOrder = array("DATE_ACTIVE_FROM" => "DESC");
                        $res = CIBlockElement::GetList($arOrder, $arFilter, false, array("nTopCount"=>1), $arSelect);
                        while($ob = $res->GetNextElement())
                        {
                            $arFields = $ob->GetFields();

                            ?>
                              <?=$arFields["PREVIEW_TEXT"]?>
                        <? } ?>


                    </div>
                </td>

            </tr>

        </table>
    </td>
</tr>
<tr>
    <td height="20">
        &nbsp;
    </td>
</tr>
<tr>
    <td height="30" valign="middle" class="pad_null" style="margin: 0px; padding: 0px; background-color: rgb(0, 64, 128);">
         <a name="vacancy"></a>  
		<div style="text-align: left; margin-left:25px; font-weight: bold; display: block; font-size: 14px; font-family: Arial,Helvetica,sans-serif; color: rgb(255, 255, 255);">
            ГОРЯЩИЕ ВАКАНСИИ LUXOFT
        </div>
    </td>
</tr>
<tr>
    <td height="20">
        &nbsp;
    </td>
</tr>
<tr>
    <td>

        <table border="0" cellspacing="0" cellpadding="0" align="center" style="width: 100%; max-width: 600px;">

            <tr>
                <td valign="top" style="color: #333333; font-size: 11px; font-family: arial; padding-left: 45px; padding-right: 45px;">
                    <div>
                        <a style="margin: 3px 0px 9px; font-size: 13px; text-decoration:underline; font-weight:bold; color: #114e88; display: inline;" href="http://www.luxoft.com/careers/hot/">Посмотреть весь список горящих вакансий Luxoft России и
                            Украины</a>
                        <br><br>
                        Уважаемые участники клуба, вы можете направить свое резюме на заинтересовавшую вас вакансию, либо выступить в качестве рекомендателя.
                        Для этого вы можете воспользоваться <a style="color: #114e88; display: inline;" href="http://www.luxoft.ru/careers/recomends.html">автоматической программой сбора рекомендаций</a>.
                        В случае если рекомендация поступит до <b><?=$next2WeekDate?></b> включительно, рекомендатель получит бонус, при условии выхода кандидата на работу.
                        <br> <br>
                    </div>
                </td>

            </tr>

        </table>
    </td>
</tr>
<tr>
    <td height="5">
        &nbsp;
    </td>
</tr>
<tr>
    <td style="background-color: #ffffff;" valign="top">





 <?
        $html = implode('', file ('http://www.luxoft.com/web-services/newsletter/alumni.vacancies.ru.php'));
        echo $html;
        ?>






    </td>
</tr>
<tr>
    <td height="20">
        &nbsp;
    </td>
</tr>
<tr>
    <td height="30" valign="middle" class="pad_null" style="margin: 0px; padding: 0px; background-color: rgb(0, 64, 128);">
        <a name="vnesh"></a>  
		<div style="text-align: left; margin-left:25px; font-weight: bold; display: block; font-size: 14px; font-family: Arial,Helvetica,sans-serif; color: rgb(255, 255, 255);">
            ВНЕШНИЕ ВАКАНСИИ
        </div>
    </td>
</tr>
<tr>
    <td height="20">
        &nbsp;
    </td>
</tr>
<tr>
    <td>

        <table border="0" cellspacing="0" cellpadding="0" align="center" style="width: 100%; max-width: 600px;">

            <tr>
                <td valign="top" style="color: #333333; font-size: 11px; font-family: arial; padding-left: 45px; padding-right: 45px;">
                    <div>
                        <a style="margin: 3px 0px 9px; font-size: 13px; text-decoration:underline; font-weight:bold; color: #114e88; display: inline;" href="/job/">Посмотреть весь список внешних вакансий</a>

                    </div>
                </td>

            </tr>

        </table>
    </td>
</tr>
<tr>
    <td height="5">
        &nbsp;
    </td>
</tr>
<tr>
    <td style="background-color: #ffffff;" valign="top">
        <table border="0" cellspacing="0" cellpadding="0" align="center" style="width: 100%; max-width: 600px;">
            <tr>
                <td valign="top" align="center">
                    <table width="570" cellspacing="0" cellpadding="0" border="0" align="left">
                        <tbody>
                        <tr>
                            <td style="color:#333333; font-family: arial; font-size:11px; padding-top: 0px; padding-left: 42px; padding-right: 13px;">
                                <!--
                                <div style="font-weight:bold; font-size:13px;color:#f26e24;margin-bottom:5px;margin-top:5px;">Бонус 1000$</div>
                                <div style="font-weight:bold; font-size:13px;color:#333333; margin-bottom:5px;">Крупнейшая российская компания, специализирующаяся на торговле модной одеждой, обувью и аксессуарами для всех возрастов. </div>
                                <ul style="color: #114e88; margin: 0 0 0 23px; padding: 0 0 0 0px; font-size: 12px;">
                                    <li style="padding: 0 0 3px; margin: 0;"><span style="color: #114e88; font-family: Helvetica, Arial, sans-serif;"><a style="color: #114e88;" href="#">Learning the language of the moose</a></span></li>
                                    <li style="padding: 0 0 3px; margin: 0;"><span style="color: #114e88; font-family: Helvetica, Arial, sans-serif;"><a style="color: #114e88;" href="#">Surviving 'Mosselukta</a></span></li>
                                    <li style="padding: 0 0 3px; margin: 0;"><span style="color: #114e88; font-family: Helvetica, Arial, sans-serif;"><a style="color: #114e88;" href="#">Climbing Gald?piggen - the facts</a></span></li>
                                </ul>
                                <br />
                                <div style="font-weight:bold; font-size:13px;color:#f26e24;margin-bottom:5px;margin-top:5px;">Бонус 1000$</div>
                                <div style="font-weight:bold; font-size:13px;color:#333333; margin-bottom:5px;">Крупнейшая российская компания, специализирующаяся на торговле модной одеждой, обувью и аксессуарами для всех возрастов. </div>
                                <ul style="color: #114e88; margin: 0 0 0 23px; padding: 0 0 0 0px; font-size: 12px;">
                                    <li style="padding: 0 0 3px; margin: 0;"><span style="color: #114e88; font-family: Helvetica, Arial, sans-serif;"><a style="color: #114e88;" href="#">Learning the language of the moose</a></span></li>
                                    <li style="padding: 0 0 3px; margin: 0;"><span style="color: #114e88; font-family: Helvetica, Arial, sans-serif;"><a style="color: #114e88;" href="#">Surviving 'Mosselukta</a></span></li>
                                    <li style="padding: 0 0 3px; margin: 0;"><span style="color: #114e88; font-family: Helvetica, Arial, sans-serif;"><a style="color: #114e88;" href="#">Climbing Gald?piggen - the facts</a></span></li>
                                </ul>
                                <br />
                                -->
								<?$file_pers=file_get_contents('http://www.luxoft-personnel.ru/rss/subscribe-feed.html');?>
								<?echo $file_pers;?>
                                <?/*$APPLICATION->IncludeComponent("artions:super.component", "subscribe.reward.alumni", array(
                                        "CACHE_TYPE" => "N",
                                        "CACHE_TIME" => "3600",
                                        "IBLOCK_TYPE" => "personnel",
                                        "IDBLOCK_VAC" => "6",
                                        "ID_REWARD" => "12"
                                    ),
                                    false
                                );*/?>
                                <br /><br />

                                <p style="margin: 0pt 0pt 10px;  font-size: 12px; color:#333333;">
                                    Cообщаем Вам, что с данного момента действует автоматизированная система сбора рекомендаций на корпоративном сайте Luxoft: <a style="font-size: 12px; color: #114e88; display: inline;" href="http://www.luxoft.ru/careers/recomends.html">http://www.luxoft.ru/careers/recomends.html</a>.

                                    После заполнения предоставленной формы, Ваша рекомендация автоматически поступит в систему для дальнейшей обработки.
                                </p>
                                <div style="font-weight: bold; color:#333333; display: block; font-size: 14px; padding: 3px 0pt 3px 0px;">Что является рекомендацией на вакансию:</div>
                                <ul style="color: #114e88; margin: 0 0 0 23px; padding: 0 0 0 0px; font-size: 12px;">
                                    <li style="padding: 0 0 3px; margin: 0;"><span style="color: #333333; font-family: Helvetica, Arial, sans-serif;">Рекомендация представляет собой любую информацию о потенциальном кандидате (внешнем): достаточно сообщить ФИО кандидата &#43; любой контакт для связи &#43; информацию о предполагаемой позиции, на которую претендует кандидат;</span></li>
                                    <li style="padding: 0 0 3px; margin: 0;"><span style="color: #333333; font-family: Helvetica, Arial, sans-serif;">Наличие резюме желательно, но не обязательно;</span></li>
                                    <li style="padding: 0 0 3px; margin: 0;"><span style="color: #333333; font-family: Helvetica, Arial, sans-serif;">Рекомендатель не обязан подтверждать как личные, так и профессиональные качества кандидата;</span></li>
                                    <li style="padding: 0 0 3px; margin: 0;"><span style="color: #333333; font-family: Helvetica, Arial, sans-serif;">Рекомендатель не обязан подтверждать заинтересованность кандидата к рассмотрению вакансий;</span></li>
                                    <li style="padding: 0 0 3px; margin: 0;"><span style="color: #333333; font-family: Helvetica, Arial, sans-serif;">Рекомендатель не отвечает за успешное прохождение рекомендованным кандидатом испытательного срока.</span></li>
                                </ul>


                            </td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>

    </td>
</tr>



<tr>
    <td height="20">
        &nbsp;
    </td>
</tr>
<tr>
    <td height="30" valign="middle" class="pad_null" style="margin: 0px; padding: 0px; background-color: rgb(0, 64, 128);">
        <a name="raspis"></a>  
		<div style="text-align: left; margin-left:25px; font-weight: bold; display: block; font-size: 14px; font-family: Arial,Helvetica,sans-serif; color: rgb(255, 255, 255);">
            РАСПИСАНИЕ ТРЕНИНГОВ УЧЕБНОГО ЦЕНТРА LUXOFT
        </div>
    </td>
</tr>
<tr>
    <td height="20">
        &nbsp;
    </td>
</tr>

<tr>
<td style="background-color: #ffffff;" valign="top">
<table border="0" cellspacing="0" cellpadding="0" align="center" style="width: 100%; max-width: 600px;">
<tr>
<td valign="top" align="center">
<table width="600" cellspacing="0" cellpadding="0" border="0" align="left">
<tbody>
<tr>
    <td style="color:#333333; font-family: arial; font-size:11px; padding-top: 0px; padding-left: 42px; padding-right: 42px;">

        <?
        $html = implode('', file ('http://ibs-training.ru/rss/city/alumni.html'));
        echo $html;
        ?>







    </td>
</tr>
</tbody>
</table>
</td>
</tr>
</table>

</td>
</tr>

<tr>
    <td height="5">
        &nbsp;
    </td>
</tr>
<tr>
    <td>

        <table border="0" cellspacing="0" cellpadding="0" align="center" style="width: 100%; max-width: 600px;">

            <tr>
                <td valign="top" style="color: #333333; font-size: 11px; font-family: arial; padding-left: 45px; padding-right: 45px;">
                    <div>
                        <a style="margin: 3px 0px 9px; font-size: 13px; text-decoration:underline; font-weight:bold; color: #114e88; display: inline;" href="http://ibs-training.ru/timetable/">Весь список курсов</a>

                    </div>
                </td>

            </tr>

        </table>
    </td>
</tr>
<tr>
    <td height="40">
        &nbsp;
    </td>
</tr>

<tr>
    <td bgcolor="#061322" style="background-image: url('/images/newsletter-al/bg-footer.gif'); background-repeat: repeat-x;" height="160" valign="top">

        <table border="0" cellspacing="0" cellpadding="0" align="center" style="width: 100%; max-width: 600px;">

            <tr>
                <td height="10">&nbsp;</td>
            </tr>

            <tr>
                <td valign="top" align="center">

                    <table width="400" border="0" cellspacing="0" cellpadding="0" align="left">

                        <tr>
                            <td style="padding-top: 0px; padding-left: 10px; padding-right: 30px;">

                                <table width="380" align="left">

                                    <tr>
                                        <td width="100%" valign="top" style="font-size: 11px; font-family: arial; color: #fff; line-height: 17px" align="left">


                                            Внимание! Если Ваш адрес случайно попал в базу рассылки, и Вы больше не хотите получать информацию для участников Alumni Club, просто перейдите по следующей
                                            <a style="color:#ffffff; text-decoration:underline;" href="http://ibs-training.ru/unsubscribe/?mid=#MAIL_ID#&mhash=#MAIL_MD5#">ссылке</a> для автоматической отписки.

                                        </td>

                                    </tr>


                                </table>
                            </td>

                        </tr>

                    </table>

                    <table width="150" align="left" border="0" cellspacing="0" cellpadding="0">

                        <tr>
                            <td style="padding-top: 0px; padding-left: 18px; font-size: 11px; font-family: arial; color: #fff; line-height: 17px" valign="top" align="right">

                                <b>С уважением,<br />
                                    Luxoft Alumni Club<br /></b>
                                <a style="color:#ffffff; text-decoration:underline;" href="http://www.luxoft.com/">www.luxoft.com</a>


                            </td>

                        </tr>

                    </table>
                </td>

            </tr>

            <tr>
                <td height="10">
                    &nbsp;
                </td>
            </tr>

            <tr>
                <td height="2" style="background-image: url('/images/newsletter-al/line-footer.gif'); background-repeat: repeat-x; background-color: #172331; line-height: 2px;  font-size: 2px;" bgcolor="#172331"></td>

            </tr>



            <tr>
                <td valign="top" align="center">

                    <table width="220" border="0" cellspacing="0" cellpadding="0" align="left">

                        <tr>
                            <td style="padding-top: 13px; padding-left: 10px; padding-right: 30px;">

                                <table width="210" border="0" cellspacing="0" cellpadding="0">

                                    <tr>
                                        <td style="font-size: 12px;  font-family: arial; color: #93b6da; line-height: 20px; font-weight: bold;" align="left">
                                            <a href="https://www.facebook.com/Luxoft" style="width: 22px; height: 22px; color: #fff;"><img alt="Facebook" src="/images/newsletter-al/footer_facebook.png" style="vertical-align: middle;" width="22" height="22"
                                                                                                                                           border="0" /></a>

                                        </td>
                                        <td width="15">
                                            &nbsp;
                                        </td>
                                        <td width="170" style="font-size: 12px; font-family: arial; color: #93b6da; line-height: 14px; font-weight: bold;" align="left">
                                            <a style="color:#ffffff; text-decoration:underline;" href="https://www.facebook.com/Luxoft">Luxoft</a>&nbsp;<a style="color:#ffffff; text-decoration:underline;" href="https://www.facebook.com/Luxoft.Russia">Luxoft-ru</a><br >
                                            <a style="color:#ffffff; text-decoration:underline;" href="https://www.facebook.com/Luxoft.Poland">Luxoft-pl</a>&nbsp;<a style="color:#ffffff; text-decoration:underline;" href="https://www.facebook.com/Luxoft.Romania">Luxoft-ro</a>&nbsp;<a style="color:#ffffff; text-decoration:underline;" href="https://www.facebook.com/Luxoft.Ukraine">Luxoft-ua</a>
                                        </td>
                                    </tr>

                                </table>
                            </td>

                        </tr>

                    </table>

                    <table width="320" align="right" border="0" cellspacing="0" cellpadding="0">

                        <tr>
                            <td style="padding-top: 13px; padding-left: 18px; font-size: 12px; font-family: arial; color: #fff; line-height: 20px" valign="top">

                                <table border="0" cellspacing="0" cellpadding="0" align="right">

                                    <tr>

                                        <td width="15">
                                            &nbsp;
                                        </td>
                                        <td>
                                            <a href="http://www.linkedin.com/companies/luxoft" style="width: 22px; height: 22px; color: #fff;"><img alt="Linkedin" src="/images/newsletter-al/footer_linkedin.png" style="vertical-align: middle;" width="22" height="22"
                                                                                                                                                    border="0" /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <a href="http://twitter.com/Luxoft_tweets" style="width: 22px; height: 22px; color: #fff;"><img alt="Twitter" src="/images/newsletter-al/footer_tweeter.png" style="vertical-align: middle;" width="22" height="22" border="0"
                                                    /></a>&nbsp;&nbsp;&nbsp;&nbsp;

                                            <a href="http://www.youtube.com/Luxoftvideo" style="width: 22px; height: 22px; color: #fff;"><img alt="Youtube" src="/images/newsletter-al/footer_youtube.png" style="vertical-align: middle;" width="22" height="22"
                                                                                                                                              border="0" /></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                            <a href="https://plus.google.com/109881160058685562700" style="width: 22px; height: 22px; color: #fff;"><img alt="Google+" src="/images/newsletter-al/footer_google.png" style="vertical-align: middle;" width="22"
                                                                                                                                                         height="22" border="0" /></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <td width="15">
                                            &nbsp;
                                        </td>
                                        <td  style="">
                                            <a href="http://www.luxoft.com/">
                                                <img src="/images/newsletter-al/alumni-newsletter-logo.png" width="65" height="31" alt="Luxoft Logo" border="0" />
                                            </a>

                                        </td>
                                        <td width="15">
                                            &nbsp;
                                        </td>
                                        <td width="15">
                                            &nbsp;
                                        </td>
                                    </tr>

                                </table>
                            </td>

                        </tr>

                    </table>
                </td>

            </tr>
            <tr>
                <td height="10">
                    &nbsp;
                </td>
            </tr>
        </table>
    </td>
</tr>
</table>
</div>
</body>
</html>
<?
$SUBSCRIBE_TEMPLATE_RESULT = true;
if($SUBSCRIBE_TEMPLATE_RESULT)
    return array(
        "SUBJECT"=>"Luxoft Russia and Ukraine Alumni Club Newsletter"." ".date("d.m.Y"),
        "BODY_TYPE"=>"html",
        "CHARSET"=>"Windows-1251",
        "DIRECT_SEND"=>"Y",
        "FROM_FIELD"=>$SUBSCRIBE_TEMPLATE_RUBRIC["FROM_FIELD"],
    );
else
    return false;
?>