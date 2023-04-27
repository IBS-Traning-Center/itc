<?
//if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $SUBSCRIBE_TEMPLATE_RUBRIC;
$SUBSCRIBE_TEMPLATE_RUBRIC=$arRubric;
global $APPLICATION;
?>
<?
	$curDateView = date("d.m.Y");
	$nextWeek = mktime(0, 0, 0, date("m"), date("d")+7,   date("Y"));
	$nextWeekDate = date("d.m.Y", $nextWeek) ;
?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700&amp;subset=cyrillic" rel="stylesheet">
<style type="text/css">
    /* Client-specific Styles */
    #outlook a {
        padding: 0;
    }
    /* Force Outlook to provide a "view in browser" button. */
    #send-body {
        max-width: 650px;
    }
    body {
        width: 100% !important;
    }
    .ReadMsgBody {
        width: 100%;
    }
    .ExternalClass {
        width: 100%;
    }
    /* Force Hotmail to display emails at full width */
    body {
        -webkit-text-size-adjust: none;
    }
    /* Prevent Webkit platforms from changing default text sizes. */
    /* Reset Styles */
    body {
        margin: 0;
        padding: 0;
        background-color: #fff;
        color: #fff;
        font-family: 'Open Sans';
        font-size: 16px;
    }
    img {
        border: 0;
        outline: none;
        text-decoration: none;
    }
    table td {
        border-collapse: collapse;
    }
    #backgroundTable {
        height: 100% !important;
        margin: 0;
        padding: 0;
    }
</style>
<!--[if gte mso 9]>
<style>
    #tableForOutlook {
        width: 650px;
    }
</style>
<![endif]-->
</head>
<body style="margin:0; padding:0; width:100% !important;">
<div style="max-width:650px;" id="send-body">
    <!--[if gte mso 9]>
    <table id="tableForOutlook">
        <tr>
            <td>
    <![endif]-->
    <table width="650"  style="width: 650px;" align="center" border="0" cellspacing="0" cellpadding="0" style="border-collapse:collapse;">
        <tr>
            <td bgcolor="#ffffff" style="" height="375" valign="top">
                <table border="0" cellspacing="0" cellpadding="0" align="center" style="width: 100%; max-width: 650px;">
                    <tr>
                        <td valign="top" align="center">
                            <img src="https://ibs-training.ru/files/alumni-2018-banner.jpg" width="650" alt="Luxoft Alumni Logo">
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="background-color: #ffffff;">
                <table border="0" cellspacing="0" cellpadding="0" style="padding-right: 50px; padding-left: 50px">
                    <tr>
                        <td align="center" valign="top">
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td align="left" valign="top" style="font-family: 'Open Sans'; color: #333333; font-size: 13px; line-height:19px; background-color: #ffffff;" bgcolor="#ffffff">
                            <div style="font-family: 'Open Sans'; color: #333333; font-size: 13px; line-height:19px; background-color: #ffffff;">
                                <span style="color:#033b7a; font-family: 'Open Sans'; font-size: 19px; line-height:20px;">Our Best and brightest minds bring you their latest insights into Luxoft's innovations & emerging global tech trends.</span>
                                <br>
                                <br>
                                <?
                                $html = mb_convert_encoding(implode('', file ('https://www.luxoft.com/web-services/newsletter/alumni.minds.php')), 'windows-1251', 'UTF-8');
                                echo $html;
                                ?>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr>
            <td bgcolor="#ffffff" style="" height="57" valign="top">
                <table border="0" cellspacing="0" cellpadding="0" align="center" style="width: 100%; max-width: 650px;">
                    <tr>
                        <td valign="top" align="center">
                            <img src="https://ibs-training.ru/files/subscribes/alumni2018/155531_EB_Alumni_Newsletter_template_02_hotjobs_650x112px.png" width="650" alt="Luxoft vacancies">
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="background-color: #ffffff;">
                <table border="0" cellspacing="0" cellpadding="0" style="padding-left: 50px">
                    <tr>
                        <td align="center" valign="top">
                            &nbsp;
                        </td>
                    </tr>
                    <tr  >
                        <td>
                            <span style="color:#e25a10; font-family: 'Open Sans'; font-size: 19px; line-height:20px;">We are constantly growing and expanding and it's never too late to grow with us! Some hot vacancies available today:</span>
                        </td>
                    </tr>

                    <tr>
                        <td align="left" valign="top" style="font-family: 'Open Sans'; color: #333333; font-size: 13px; line-height:19px; background-color: #ffffff;" bgcolor="#ffffff">
                            <div style="">
                                <div style="font-family: 'Open Sans'; color: #333333; font-size: 13px; line-height:19px; background-color: #ffffff;">

                                    <?
                                    $html = mb_convert_encoding(implode('', file ('https://www.luxoft.com/web-services/newsletter/alumni.vacancies.en.php')), 'windows-1251', 'UTF-8');
                                    echo $html;
                                    ?>

                                    <div style="margin-top: 5px;padding-top: 3px;">
                                        <span style="color:#333333; font-family: 'Open Sans'; font-size: 15px; line-height:20px;">Find <b>more vacancies</b> in different locations at <a href="https://career.luxoft.com/job-opportunities/" style="text-decoration: none; color:#e25a10; font-weight:bold;">Luxoft Career!</a></span>
                                    </div>
                                </div>
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
            <td bgcolor="#ffffff" style="" height="70" valign="top">
                <table border="0" cellspacing="0" cellpadding="0" align="center" style="width: 100%; max-width: 650px;">
                    <tr>
                        <td valign="top" align="center">
                            <img src="https://ibs-training.ru/files/subscribes/alumni2018/155531_EB_Alumni_Newsletter_template_04_trainings_650x115px.png" width="650" alt="Trainings">
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="background-color: #ffffff;">
                <table border="0" cellspacing="0" cellpadding="0" style="padding-right: 50px; padding-left: 50px">
                    <tr>
                        <td align="center" valign="top">
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td align="left" valign="top" style="font-family: 'Open Sans'; color: #333333; font-size: 13px; line-height:19px; background-color: #ffffff;" bgcolor="#ffffff">
                            <div style="font-family: 'Open Sans'; color: #333333; font-size: 13px; line-height:19px; background-color: #ffffff;">
                                <span style="color: #338bba;  font-family: 'Open Sans'; font-size: 19px; line-height:20px;">Stay connected to Luxoft's Life-long learning program:</span>
                                <?
                                $html = mb_convert_encoding(implode('', file ('https://www.luxoft.com/web-services/newsletter/alumni.trainings.en.php')), 'windows-1251', 'UTF-8');
                                echo $html;
                                ?>
                                <div style="margin-top: 5px;padding-top: 3px;">
                                    <span style="color:#333333; font-weight: normal; font-family: 'Open Sans'; font-size: 15px; line-height:20px;">Find <b>more trainings</b> in different locations at <a style="text-decoration: none; color:#033b7a; font-weight:bold;" href="http://www.luxoft-training.com/">Luxoft Training!</a></span>
                                </div>
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
            <td bgcolor="#ffffff" style="" height="87" valign="top">
                <table border="0" cellspacing="0" cellpadding="0" align="center" style="width: 100%; max-width: 650px;">
                    <tr>
                        <td valign="top" align="center">
                            <img src="https://ibs-training.ru/files/subscribes/alumni2018/155531_EB_Alumni_Newsletter_template_05_events_650x54px.png" width="650" alt="Global Presence">
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="background-color: #ffffff;">
                <table border="0" cellspacing="0" cellpadding="0" style="padding-right: 50px; padding-left: 50px">
                    <tr>
                        <td align="left" valign="top" style="font-family: 'Open Sans'; color: #333333; font-size: 13px; line-height:19px; background-color: #ffffff;" bgcolor="#ffffff">
                            <div style="font-family: 'Open Sans'; color: #333333; font-size: 13px; line-height:19px; background-color: #ffffff;">

                                <span style="color:#e25a10; font-family: 'Open Sans'; font-size: 19px; line-height:20px;">Don't miss out on any of the exciting upcoming online and offline Luxoft event. Webinars, Logeek Nights, conferences, parties and more!</span>
                                <br> <br>
                                <?
                                $html = mb_convert_encoding(implode('', file ('https://www.luxoft.com/web-services/newsletter/alumni.events.en.php')), 'windows-1251', 'UTF-8');
                                echo $html;
                                ?>
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
            <td bgcolor="#ffffff" style="" height="71" valign="top">
                <table border="0" cellspacing="0" cellpadding="0" align="center" style="width: 100%; max-width: 650px;">
                    <tr>
                        <td valign="top" align="center">
                            <img src="https://ibs-training.ru/files/subscribes/alumni2018/155531_EB_Alumni_Newsletter_template_07_speakup_650x105px.png" width="650" alt="Referral Program">
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="background-color: #ffffff;">
                <table border="0" cellspacing="0" cellpadding="0" style="padding-right: 15px; padding-left: 20px;" align="center">

                    <tr>
                        <td align="center" valign="top" style="font-family: 'Open Sans'; color: #333333; font-size: 13px; line-height:19px; background-color: #ffffff;" bgcolor="#ffffff">
                            <div style="font-family: 'Open Sans'; color: #333333; font-size: 13px; line-height:19px; background-color: #ffffff; text-align: center">
                                <span style="color:#aa0040; font-weight: bold; font-family: 'Open Sans'; font-size: 15px; line-height:26px;">Become a featured Speaker at a Luxoft event<br>and share your knowledge and skills with others. <br> Contact us at <a style="text-decoration: none; color: #002d58; font-weight:bold;" href="mailto:<?=EMAIL_B2B?>"><?=EMAIL_B2B?></a></span>

                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" valign="top">
                            &nbsp;
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr>
            <td bgcolor="#002d58" style="" height="105" valign="top">
                <table border="0" cellspacing="0" cellpadding="0" align="center" style="width: 100%; max-width: 650px;">
                    <tr>
                        <td height="15"></td>
                    </tr>
                    <tr>
                        <td valign="top" align="center">
                            <span style="color:#ffffff;  font-family: 'Open Sans'; font-size: 16px; line-height:26px;">Follow us on:</span>
                        </td>
                    </tr>
                    <tr>
                        <td height="10"></td>
                    </tr>
                    <tr>
                        <td valign="top" align="center">

                            <a href="http://www.linkedin.com/companies/luxoft" style="display:inline-block;padding-right:2px;">
                                <img style="vertical-align: -8px" width="31" height="31" src="https://ibs-training.ru/files/subscribes/alumni2018/155531_EB_Alumni_Newsletter_template_icon_linkedin.png" >
                            </a>
                            <img style="" width="2" height="2" src="https://www.luxoft.com/upload/medialibrary/ab0/space.png" >
                            <a href="http://twitter.com/Luxoft" style="display:inline-block;padding-right:2px;">
                                <img style="vertical-align: -8px" width="31" height="31" src="https://ibs-training.ru/files/subscribes/alumni2018/155531_EB_Alumni_Newsletter_template_icon_twitter.png" >
                            </a>
                            <img style="" width="2" height="2" src="https://www.luxoft.com/upload/medialibrary/ab0/space.png" >
                            <a href="http://www.youtube.com/channel/UCDtOIqWxKHTdtmVi8yr_D7Q" style="display:inline-block;padding-right:2px;">
                                <img style="vertical-align: -8px" width="31" height="31" src="https://ibs-training.ru/files/subscribes/alumni2018/155531_EB_Alumni_Newsletter_template_icon_youtube.png" >
                            </a>
                            <img style="" width="2" height="2" src="https://www.luxoft.com/upload/medialibrary/ab0/space.png" >
                            <a href="https://www.facebook.com/Luxoft" style="display:inline-block;padding-right:2px;">
                                <img style="vertical-align: -8px" width="31" height="31" src="https://ibs-training.ru/files/subscribes/alumni2018/155531_EB_Alumni_Newsletter_template_icon_facebook.png" >
                            </a>
                            <img style="" width="2" height="2" src="https://www.luxoft.com/upload/medialibrary/ab0/space.png" >

                            <a href="https://plus.google.com/109881160058685562700" style="display:inline-block;">
                                <img style="vertical-align: -8px" width="31" height="31" src="https://ibs-training.ru/files/subscribes/alumni2018/155531_EB_Alumni_Newsletter_template_icon_google.png" >
                            </a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="background-color: #ffffff;">
                <table border="0" cellspacing="0" cellpadding="0" style="padding-right: 15px; padding-left: 20px;" align="center">

                    <tr>
                        <td align="center" valign="top" style="font-family: 'Open Sans'; color: #333333; font-size: 13px; line-height:19px; background-color: #ffffff;" bgcolor="#ffffff">
                            <div style="font-family: 'Open Sans'; color: #333333; font-size: 13px; line-height:19px; background-color: #ffffff; text-align: center">
                                <span style="font-family: 'Open Sans'; font-size: 11px; line-height:18px;">How Luxoft processes my personal data? <br><br> Your contact information is processed by HR team of LUXOFT GROUP. To learn more about your privacy rights and privacy protection in Luxoft please read our <a style="text-decoration: none; color:#033b7a; font-weight:bold;" href="http://info.luxoft.com/hhp7W4I00L000OIYe000BcD">Privacy Policy</a>. If you have any questions regarding your personal information, want to execute your rights or you have concerns or complaints, want to unsubscribe - please contact us by sending an email to <a style="text-decoration: none; color:#033b7a; font-weight:bold;" href="mailto:LuxoftAlumniClub<?=EMAIL_DOMAIN?>">LuxoftAlumniClub<?=EMAIL_DOMAIN?></a></span>

                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" valign="top">
                            &nbsp;
                        </td>
                    </tr>
                </table>
            </td>
        </tr>


    </table>
    <!--[if gte mso 9]>
    </td></tr></table>
    <![endif]-->
</div>
</body>




<?
$SUBSCRIBE_TEMPLATE_RESULT = true;
if($SUBSCRIBE_TEMPLATE_RESULT)
	return array(
		"SUBJECT"=>"Auto generated newsletter ::  Alumni Newsletter "." ".date("d.m.Y")." - ".$nextWeekDate,
		"BODY_TYPE"=>"html",
		"CHARSET"=>"Windows-1251",
		"DIRECT_SEND"=>"Y",
		"FROM_FIELD"=>$SUBSCRIBE_TEMPLATE_RUBRIC["FROM_FIELD"],
	);
else
	return false;
?>
