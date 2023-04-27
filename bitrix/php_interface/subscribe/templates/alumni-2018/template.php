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
        max-width: 1000px;
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
    td > div > p{
        color:#033b7a;
        font-family: 'Open Sans';
        font-size: 14px;
        line-height:20px;
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
    <div style="max-width:1000px;" id="send-body">
        <!--[if gte mso 9]>
    <table id="tableForOutlook">
        <tr>
            <td>
    <![endif]-->
        <table width="1000" style="width: 1000px;" align="center" border="0" cellspacing="0" cellpadding="0"
            style="border-collapse:collapse;">
            <tr>
                <td bgcolor="#ffffff" style="" height="auto" valign="top">
                    <table border="0" cellspacing="0" cellpadding="0" align="center"
                        style="width: 100%; max-width: 1000px;">
                        <tr>
                            <td valign="top" align="center">
                                <img src="https://ibs-training.ru/files/subscribes/alumni2020/banner-top.jpg"
                                    width="1000" alt="Luxoft Alumni Logo">
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="background-color: #ffffff;">
                    <table border="0" cellspacing="0" cellpadding="0" style="padding-right: 165px; padding-left: 150px">
                        <tr>
                            <td align="center" valign="top">
                                &nbsp;
                            </td>
                        </tr>




                        <tr>
                            <td align="left" valign="top"
                                style="font-family: 'Open Sans'; color: #333333; font-size: 13px; line-height:19px; background-color: #ffffff;"
                                bgcolor="#ffffff">
                                <div style="font-family: 'Open Sans'; color: #333333; font-size: 13px; line-height:19px; background-color: #ffffff;">
                                    <p>Hello, Luxoft Alumni Newsletter subscribers!</p>
                                        <p>We start with <b>good news:</b> as you may have noticed, the newsletter has a new
                                        design. Not only that, but we have also created <a href="https://career.luxoft.com/alumni/">Luxoft Alumni Club page.</a> Here,
                                        you can stay up to date and participate in Luxoft life even as a former
                                        employee. In addition, you can also keep your finger to the pulse of Luxoft by
                                        joining the Luxoft Alumni Club on Workplace. The only thing you need to visit <a href="https://career.luxoft.com/alumni/">Luxoft Alumni Club page</a> and find the tab <b>"Connect with Other  Alumni."</b> Even when you move on from Luxoft,
                                        you'll still have access to this group.</p>
                                        <p>Through these new hubs for Luxoft alumni, you can stay informed on:</p>
                                        <p style="font-size: 13px;">
                                        &#8226; Luxoft news<br>
                                        &#8226; Luxoft job opportunities (including hot vacancies)<br>
                                        &#8226; Local alumni meetups<br>
                                        &#8226; Events, trainings, quizzes, surveys, and livestreams all available to former
                                        employees</p>
                                        <p>Naturally, all of this is entirely voluntary, but as you're subscribed to the
                                        newsletter, these new methods of staying close to Luxoft will only enhance your
                                        connection.</p>
                                        <p>To make sure we stick by that mission of continually improving the connection
                                        between Luxoft and our alumni, we would also appreciate it if you were to fill
                                        in the alumni survey on the <a href="https://career.luxoft.com/alumni/">Luxoft Alumni Club page.</a> The feedback we get is
                                        instrumental to developing in directions catered to our alumni.</p>
                                        <p>We look forward to staying in touch with each and every one of you.</p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td align="center" valign="top">
                                &nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td align="left" valign="top"
                                style="font-family: 'Open Sans'; color: #333333; font-size: 13px; line-height:19px; background-color: #ffffff;"
                                bgcolor="#ffffff">
                                <div
                                    style="font-family: 'Open Sans'; color: #333333; font-size: 13px; line-height:19px; background-color: #ffffff;">
                                    <span
                                        style="color:#033b7a; font-family: 'Open Sans'; font-size: 20px; line-height:26px;">Keep
                                        up to date with all that's going on at Luxoft!<br>News, Innovations, New
                                        Positions, Opportunities & Trainings</span>
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
                <td bgcolor="#ffffff" style="" height="57" valign="top">
                    <table border="0" cellspacing="0" cellpadding="0" align="center"
                        style="width: 100%; max-width: 1000px;">
                        <tr>
                            <td valign="top" align="center">
                                <img src="https://ibs-training.ru/files/subscribes/alumni2020/luxoft-minds.jpg"
                                    width="1000" alt="Luxoft vacancies">
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="background-color: #ffffff;">
                    <table border="0" cellspacing="0" cellpadding="0" style="padding-right: 165px; padding-left: 150px">
                        <tr>
                            <td align="center" valign="top">
                                &nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td align="left" valign="top"
                                style="font-family: 'Open Sans'; color: #333333; font-size: 13px; line-height:19px; background-color: #ffffff;"
                                bgcolor="#ffffff">
                                <div
                                    style="font-family: 'Open Sans'; color: #333333; font-size: 13px; line-height:19px; background-color: #ffffff;">
                                    <span
                                        style="color:#033b7a; font-weight: 700; font-family: 'Open Sans'; font-size: 20px; line-height:26px;">Our
                                        Best and brightest minds bring you their latest insights into Luxoft's
                                        innovations & emerging global tech trends.</span>
                                    <br>
                                    <br>
                                    <?
                                $html = mb_convert_encoding(implode('', file ('https://www.luxoft.com/web-services/newsletter/alumni.minds.php')), 'utf-8', 'windows-1251');
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
                    <table border="0" cellspacing="0" cellpadding="0" align="center"
                        style="width: 100%; max-width: 1000px;">
                        <tr>
                            <td valign="top" align="center">
                                <img src="https://ibs-training.ru/files/subscribes/alumni2020/hot-jobs.jpg"
                                    width="1000" alt="Luxoft vacancies">
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="background-color: #ffffff;">
                    <table border="0" cellspacing="0" cellpadding="0" style="padding-right: 165px; padding-left: 150px">
                        <tr>
                            <td align="center" valign="top">
                                &nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span
                                    style="color:#033b7a; font-weight: 700; font-family: 'Open Sans'; font-size: 20px; line-height:26px;">We
                                    are constantly growing and expanding and it's never too late to grow with us! Some
                                    hot vacancies available today:</span>
                            </td>
                        </tr>

                        <tr>
                            <td align="left" valign="top"
                                style="font-family: 'Open Sans'; color: #333333; font-size: 13px; line-height:19px; background-color: #ffffff;"
                                bgcolor="#ffffff">
                                <div style="">
                                    <div
                                        style="font-family: 'Open Sans'; color: #333333; font-size: 13px; line-height:19px; background-color: #ffffff;">

                                        <?
                                    $html = mb_convert_encoding(implode('', file ('https://www.luxoft.com/web-services/newsletter/alumni.vacancies.en.php')), 'UTF-8', 'windows-1251');
                                    echo $html;
                                    ?>

                                        <div style="margin-top: 5px;padding-top: 3px;">
                                            <span
                                                style="color:#333333; font-family: 'Open Sans'; font-size: 15px; line-height:20px;">Find
                                                more vacancies in different locations at <a
                                                    href="https://career.luxoft.com/job-opportunities/"
                                                    style="text-decoration: none; color:#033b7a; font-weight:bold;">Luxoft
                                                    Career!</a></span>
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
                    <table border="0" cellspacing="0" cellpadding="0" align="center"
                        style="width: 100%; max-width: 1000px;">
                        <tr>
                            <td valign="top" align="center">
                                <img src="https://ibs-training.ru/files/subscribes/alumni2020/trainings.jpg"
                                    width="1000" alt="Trainings">
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="background-color: #ffffff;">
                    <table border="0" cellspacing="0" cellpadding="0" style="padding-right: 165px; padding-left: 150px">
                        <tr>
                            <td align="center" valign="top">
                                &nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td align="left" valign="top"
                                style="font-family: 'Open Sans'; color: #333333; font-size: 13px; line-height:19px; background-color: #ffffff;"
                                bgcolor="#ffffff">
                                <div
                                    style="font-family: 'Open Sans'; color: #333333; font-size: 13px; line-height:19px; background-color: #ffffff;">
                                    <span
                                        style="color: #033b7a; font-weight: 700; font-family: 'Open Sans'; font-size: 20px; line-height:26px;">Stay
                                        connected to Luxoft's Life-long learning program:</span>
                                    <?
                                $html = mb_convert_encoding(implode('', file ('https://www.luxoft.com/web-services/newsletter/alumni.trainings.en.php')), 'UTF-8', 'windows-1251');
                                echo $html;
                                ?>
                                    <div style="margin-top: 5px;padding-top: 3px;">
                                        <span
                                            style="color:#333333; font-weight: normal; font-family: 'Open Sans'; font-size: 15px; line-height:20px;">Find
                                            more trainings in different locations at <a
                                                style="text-decoration: none; color:#033b7a; font-weight:bold;"
                                                href="http://www.luxoft-training.com/">Luxoft Training!</a></span>
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
                    <table border="0" cellspacing="0" cellpadding="0" align="center"
                        style="width: 100%; max-width: 1000px;">
                        <tr>
                            <td valign="top" align="center">
                                <img src="https://ibs-training.ru/files/subscribes/alumni2020/upcoming-events.jpg"
                                    width="1000" alt="Global Presence">
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="background-color: #ffffff;">
                    <table border="0" cellspacing="0" cellpadding="0" style="padding-right: 200px; padding-left: 150px">
                        <tr>
                            <td align="center" valign="top">
                                &nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td align="left" valign="top"
                                style="font-family: 'Open Sans'; color: #333333; font-size: 13px; line-height:19px; background-color: #ffffff;"
                                bgcolor="#ffffff">
                                <div
                                    style="font-family: 'Open Sans'; color: #333333; font-size: 13px; line-height:19px; background-color: #ffffff;">

                                    <span
                                        style="color:#033b7a; font-weight: 700; font-family: 'Open Sans'; font-size: 20px; line-height:26px;">Don't
                                        miss out on any of the exciting upcoming online and offline Luxoft event.
                                        Webinars, Logeek Nights, conferences, parties and more!</span>
                                    <br> <br>
                                    <?
                                $html = mb_convert_encoding(implode('', file ('https://www.luxoft.com/web-services/newsletter/alumni.events.en.php')), 'UTF-8', 'windows-1251');
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
            <!--
        <? /*
        <tr>
            <td bgcolor="#ffffff" style="" height="71" valign="top">
                <table border="0" cellspacing="0" cellpadding="0" align="center" style="width: 100%; max-width: 1000px;">
                    <tr>
                        <td valign="top" align="center">
                            <img src="https://ibs-training.ru/files/subscribes/alumni2018/155531_EB_Alumni_Newsletter_template_07_speakup_650x105px.png" width="1000" alt="Referral Program">
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        */ ?>
        -->
            <tr>
                <td style="background-color: #00346A; padding-top:20px;">
                    <table border="0" cellspacing="0" cellpadding="0" style="padding-right: 15px; padding-left: 20px;"
                        align="center">

                        <tr>
                            <td align="center" valign="top" style="font-family: 'Open Sans'; color: #fff; font-size: 13px; line-height:19px;>
                            <div style=" font-family: 'Open Sans' ; color: #333333; font-size: 13px; line-height:19px;
                                background-color: #ffffff; text-align: center">
                                <span
                                    style="color:#fff; font-family: 'Open Sans'; font-size: 20px; line-height:26px;">Become
                                    a featured Speaker at a Luxoft event<br>and share your knowledge and skills with
                                    others. <br> Contact us at <a
                                        style="text-decoration: none; color: #fff; font-weight:bold;"
                                        href="mailto:<?=EMAIL_B2B?>"><?=EMAIL_B2B?></a></span>

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
        <td bgcolor="#EFEFEF" style="" height="105" valign="top">
            <table border="0" cellspacing="0" cellpadding="0" align="center" style="width: 100%; max-width: 1000px;">
                <tr>
                    <td height="15"></td>
                </tr>
                <tr>
                    <td valign="top" align="center">
                        <span
                            style="color:#00346A;  font-family: 'Open Sans'; font-size: 20px; line-height:26px;">Follow
                            us on:</span>
                    </td>
                </tr>
                <tr>
                    <td height="15"></td>
                </tr>
                <tr>
                    <td valign="top" align="center">
                        <a href="http://twitter.com/Luxoft" style="display:inline-block;padding-right:2px;">
                            <img style="vertical-align: -8px" width="43" height="43"
                                src="https://ibs-training.ru/files/subscribes/alumni2020/twitter.jpg">
                        </a>
                        <img style="" width="10" height="10"
                            src="https://www.luxoft.com/upload/medialibrary/ab0/space.png">
                        <a href="http://www.youtube.com/channel/UCDtOIqWxKHTdtmVi8yr_D7Q"
                            style="display:inline-block;padding-right:2px;">
                            <img style="vertical-align: -8px" width="43" height="43"
                                src="https://ibs-training.ru/files/subscribes/alumni2020/youtube.jpg">
                        </a>
                        <img style="" width="10" height="10"
                            src="https://www.luxoft.com/upload/medialibrary/ab0/space.png">
                        <a href="http://www.linkedin.com/companies/luxoft"
                            style="display:inline-block;padding-right:2px;">
                            <img style="vertical-align: -8px" width="43" height="43"
                                src="https://ibs-training.ru/files/subscribes/alumni2020/linkedin.jpg">
                        </a>
                        <img style="" width="10" height="10"
                            src="https://www.luxoft.com/upload/medialibrary/ab0/space.png">
                        <a href="https://www.facebook.com/Luxoft" style="display:inline-block;padding-right:2px;">
                            <img style="vertical-align: -8px" width="43" height="43"
                                src="https://ibs-training.ru/files/subscribes/alumni2020/facebook.jpg">
                        </a>
                        <img style="" width="10" height="10"
                            src="https://www.luxoft.com/upload/medialibrary/ab0/space.png">
                        <a href="https://plus.google.com/109881160058685562700" style="display:inline-block;">
                            <img style="vertical-align: -8px" width="43" height="43"
                                src="https://ibs-training.ru/files/subscribes/alumni2020/google.jpg">
                        </a>
                    </td>
                </tr>
                <tr>
                    <td height="25"></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td style="background-color: #ffffff;">
            <table border="0" cellspacing="0" cellpadding="0" style="padding-right: 15px; padding-left: 20px;"
                align="center">
                <tr>
                    <td height="25"></td>
                </tr>
                <tr>
                    <td align="center" valign="top"
                        style="font-family: 'Open Sans'; color: #333333; font-size: 16px; line-height:19px; background-color: #ffffff;"
                        bgcolor="#ffffff">
                        <div
                            style="font-family: 'Open Sans'; color: #333333; font-size: 14px; line-height:19px; background-color: #ffffff; text-align: center">
                            <span style="font-family: 'Open Sans'; font-size: 13px; line-height:18px;">How Luxoft
                                processes my personal data? <br><br> Your contact information is processed by HR team of
                                LUXOFT GROUP. To learn more about your privacy rights and privacy protection in Luxoft
                                please read our <a style="text-decoration: none; color:#033b7a; font-weight:bold;"
                                    href="http://info.luxoft.com/hhp7W4I00L000OIYe000BcD">Privacy Policy</a>. If you
                                have any questions regarding your personal information, want to execute your rights or
                                you have concerns or complaints, want to unsubscribe - please contact us by sending an
                                email to <a style="text-decoration: none; color:#033b7a; font-weight:bold;"
                                    href="mailto:<?=EMAIL_ALUMNI?>"><?=EMAIL_ALUMNI?></a></span>

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
