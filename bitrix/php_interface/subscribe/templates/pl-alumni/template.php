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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
    <title>title</title>
    <style type="text/css">
            /* Client-specific Styles
        * {outline:1px dotted #000000;}*/
        #outlook a{padding:0;} /* Force Outlook to provide a "view in browser" button.
 */
        #send-body{max-width:600px;}
        body{width:100% !important;} .ReadMsgBody{width:100%;} .ExternalClass{width:100%;} /* Force Hotmail to display emails at full width */
        body{-webkit-text-size-adjust:none;} /* Prevent Webkit platforms from changing default text sizes.
 */
            /* Reset Styles */
        body{margin:0; padding:0; background-color: #fff; color: #fff; font-family: arial; font-size: 16px;}
        img{border:0; outline:none; text-decoration:none;}
        table td{border-collapse:collapse;}
        #backgroundTable{height:100% !important; margin:0; padding:0;}
    </style>
    <!--[if gte mso 9]>
    <style>
        #tableForOutlook {
            width:600px;
        }
    </style>
    <![endif]-->
</head>
<body style="margin:0; padding:0; width:600px!important;">
<div style="width:600px;" id="send-body">
<!--[if gte mso 9]>
<table id="tableForOutlook">
    <tr>
        <td>
<![endif]-->
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
                                Dear Club Members!<br />
                                Luxoft is pleased to present you the next issue of the Alumni newsletter.
                                You will find relevant information and interesting news in this issue. We hope it will be useful for you!
								<br />
                                <br />
                         						<font size="4"><b><a style="font-size: 16px;  color: rgb(17, 78, 136);" href="#news" >NEWS</a> 
								<br />
                                <br />
                             						<a style="font-size: 16px;  color: rgb(17, 78, 136);" href="#vacancy" >LUXOFT HOT JOBS</a> 
								<br />
                                <br />
                             						<a style="font-size: 16px;  color: rgb(17, 78, 136);" href="#vnesh" >EXTERNAL VACANCIES</a> 
								<br />
                                <br />
								<a style="font-size: 16px;  color: rgb(17, 78, 136);" href="#raspis" >TRAINING SCHEDULE OF LUXOFT TRAINING CENTER</a></b></font> 
								<br />
                                <br />
                            </td>

                        </tr>

                    </table>

                    <table width="130" align="left" border="0" cellspacing="0" cellpadding="0">

                        <tr>
                            <td style="padding-top: 60px; padding-left: 0px; color: #114e88; font-size: 11px; font-family: arial; font-weight:bold;" valign="top" align="left" width="300">
                                
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
            NEWS
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
                            "IBLOCK_ID" => 124,
                            "ACTIVE" => "Y",
                        );
                        $arOrder = array("DATE_ACTIVE_FROM" => "DESC");
                        $res = CIBlockElement::GetList($arOrder, $arFilter, false, array("nTopCount"=>1), $arSelect);
                        while($ob = $res->GetNextElement())
                        {
                            $arFields = $ob->GetFields();
                            $arFields["PREVIEW_TEXT"] =  str_replace("<a ","<a style='text-decoration:underline; color: #114e88; display: inline;' ", $arFields["PREVIEW_TEXT"]);

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
            LUXOFT HOT JOBS
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
                <td valign="top" style="color: #333333; font-size: 12px; font-family: arial; padding-left: 45px; padding-right: 45px;">
                    <div>
                        <a style="margin: 3px 0px 9px; font-size: 13px; text-decoration:underline; font-weight:bold; color: #114e88; display: inline;" href="http://www.luxoft.com/job-opportunities/?POLAND-LOCATIONS=Y&arrFilter_ff[NAME]=&arrFilter_pf[cities]=&set_filter=Y">See the whole list of hot Luxoft vacancies</a>
                        <br><br><b>Dear Club Members,</b><br /><br />
                        You can send your CV to apply for a job you are interested in or take part in our referral program. You can use our <a style="color: #114e88; display: inline;" href="http://www.luxoft.com/careers/referral/">automatic recommendation collection program</a> for this. If a reference is submitted up until <b><?=$next2WeekDate?></b> and a candidate starts working then a referee will get Luxoft’s referral bonus.


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
        $html = implode('', file ('http://www.luxoft.com/web-services/newsletter/alumni.vacancies.pl.php'));
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
            EXTERNAL VACANCIES
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
                        <a style="margin: 3px 0px 9px; font-size: 13px; text-decoration:underline; font-weight:bold; color: #114e88; display: inline;" href="http://www.luxoft-personnel.com/job/">See the whole list of external vacancies</a>

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
                                <?/*$APPLICATION->IncludeComponent("artions:super.component", "subscribe.alumni.en", Array(
                                        "CACHE_TYPE" => "N",	// Тип кеширования
                                        "CACHE_TIME" => "3600",	// Время кеширования (сек.)
                                        "IBLOCK_TYPE" => "personnel",	// Тип информационного блока:
                                        "IDBLOCK_VAC" => "33",	// Код информационного блока
                                        "ID_REWARD" => "",	// Бонус за вакансию
                                    ),
                                    false
                                );*/?>

                                

                                <p style="margin: 0pt 0pt 10px;  font-size: 12px; color:#333333;">Please be advised that from today on you can use the automatic referral collection program at Luxoft corporate website: <a style="font-size: 12px; color: #114e88; display: inline;" href="http://www.luxoft.com/careers/referral/">http://www.luxoft.com/careers/referral/</a>.
When the form provided is filled out your reference is automatically entered into the system for further processing.</p>
                                <div style="font-weight: normal; color:#333333; display: block; font-size: 14px; padding: 3px 0pt 3px 0px;"><b>What is a Referral Bonus?</b></div><p style="margin: 0pt 0pt 10px;  font-size: 12px; color:#333333;"> A reference is any information about a potential candidate fitting Luxoft’s vacancies (external).<br />
                                    Just send us:</p>
                                <ul style="color: #114e88; margin: 0 0 0 23px; padding: 0 0 0 0px; font-size: 12px;">
                                    <li style="padding: 0 0 3px; margin: 0;"><span style="color: #333333; font-family: Helvetica, Arial, sans-serif;">The candidate’s name, any contact information, and information about the position the candidate is interested in;</span></li>
                                    <li style="padding: 0 0 3px; margin: 0;"><span style="color: #333333; font-family: Helvetica, Arial, sans-serif;">CV is preferable, but not mandatory;</span></li>
                                    <li style="padding: 0 0 3px; margin: 0;"><span style="color: #333333; font-family: Helvetica, Arial, sans-serif;">A referee is not required to validate both personal and professional qualities of the candidate;</span></li>
                                    <li style="padding: 0 0 3px; margin: 0;"><span style="color: #333333; font-family: Helvetica, Arial, sans-serif;">A referee is not required to confirm the interest of the candidate to consider Luxoft’s vacancies;</span></li>
                                    <li style="padding: 0 0 3px; margin: 0;"><span style="color: #333333; font-family: Helvetica, Arial, sans-serif;">A referee is not responsible for the successful results of the probationary period by the recommended candidate.</span></li>
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
            TRAINING SCHEDULE OF LUXOFT TRAINING CENTER
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
        $html = implode('', file ('http://ibs-training.ru/rss/city/alumni.poland-online.html'));
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
                        <a style="margin: 3px 0px 9px; font-size: 13px; text-decoration:underline; font-weight:bold; color: #114e88; display: inline;" href="http://www.luxoft-training.com/schedule/">View all courses starting soon</a>

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


                                            If your email was included in the newsletter database accidentally and you don't want to receive information for Luxoft Alumni Club members just click the following <a style="color:#ffffff; text-decoration:underline;" href="http://ibs-training.ru/unsubscribe/?mid=#MAIL_ID#&mhash=#MAIL_MD5#">link</a> to unsubscribe automatically.


                                        </td>

                                    </tr>


                                </table>
                            </td>

                        </tr>

                    </table>

                    <table width="150" align="left" border="0" cellspacing="0" cellpadding="0">

                        <tr>
                            <td style="padding-top: 0px; padding-left: 18px; font-size: 11px; font-family: arial; color: #fff; line-height: 17px" valign="top" align="right">

                                <b>Best Regards,<br />
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

                                            <a style="color:#ffffff; text-decoration:underline;" href="https://www.facebook.com/Luxoft.Poland">Luxoft-pl</a>&nbsp;
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
                                            <a href="http://twitter.com/Luxoft" style="width: 22px; height: 22px; color: #fff;"><img alt="Twitter" src="/images/newsletter-al/footer_tweeter.png" style="vertical-align: middle;" width="22" height="22" border="0"
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
<!--[if gte mso 9]>
</td>
</tr>
</table>
<![endif]-->
</div>
</body>
</html>
<?
$SUBSCRIBE_TEMPLATE_RESULT = true;
if($SUBSCRIBE_TEMPLATE_RESULT)
    return array(
        "SUBJECT"=>"Luxoft Poland Alumni Club Newsletter"." ".date("d.m.Y"),
        "BODY_TYPE"=>"html",
        "CHARSET"=>"Windows-1251",
        "DIRECT_SEND"=>"Y",
        "FROM_FIELD"=>$SUBSCRIBE_TEMPLATE_RUBRIC["FROM_FIELD"],
    );
else
    return false;
?>