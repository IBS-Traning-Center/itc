<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
<style type="text/css">
    /* Client-specific Styles */
    #outlook a {
        padding: 0;
    }
    /* Force Outlook to provide a "view in browser" button. */
    #send-body {
        max-width: 600px;
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
        font-family: arial;
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
        width: 600px;
    }
</style>
<![endif]-->
</head>
<body style="margin:0; padding:0; width:100% !important;">
<div style="max-width:600px;" id="send-body">
    <!--[if gte mso 9]>
    <table id="tableForOutlook">
        <tr>
            <td>
    <![endif]-->
    <table width="600"  style="width: 600px;" align="center" border="0" cellspacing="0" cellpadding="0" style="border-collapse:collapse;">
        <tr>
            <td bgcolor="#ffffff" style="" height="375" valign="top">
                <table border="0" cellspacing="0" cellpadding="0" align="center" style="width: 100%; max-width: 600px;">
                    <tr>
                        <td valign="top" align="center">
                            <img src="http://offer.luxoft.com/rs/170-LIB-021/images/w-header.png" width="600" alt="Luxoft Alumni Logo">
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="background-color: #ffffff;">
                <table border="0" cellspacing="0" cellpadding="0" style="padding-right: 20px; padding-left: 20px">
                    <tr>
                        <td align="center" valign="top">
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td align="left" valign="top" style="font-family: arial; color: #333333; font-size: 13px; line-height:19px; background-color: #ffffff;" bgcolor="#ffffff">
                            <div style="font-family: arial; color: #333333; font-size: 13px; line-height:19px; background-color: #ffffff;">
                                <span style="color:#e25a10; font-weight: bold; font-family: arial; font-size: 23px; line-height:26px;">Keep updated, read the main <b>Luxoft news!</b> Global company news for this month:</span>
                                <br>
                                <br>
 <?
        $html = implode('', file ('http://www.luxoft.com/web-services/newsletter/alumni.news.en.php'));
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
            <td bgcolor="#ffffff" style="" height="57" valign="top">
                <table border="0" cellspacing="0" cellpadding="0" align="center" style="width: 100%; max-width: 600px;">
                    <tr>
                        <td valign="top" align="center">
                            <img src="http://offer.luxoft.com/rs/170-LIB-021/images/w-stripe-luxoft-vacancies.png" width="600" alt="Luxoft vacancies">
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="background-color: #ffffff;">
                <table border="0" cellspacing="0" cellpadding="0" style="padding-right: 15px; padding-left: 20px">
                    <tr>
                        <td align="center" valign="top">
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td align="left" valign="top" style="font-family: arial; color: #333333; font-size: 13px; line-height:19px; background-color: #ffffff;" bgcolor="#ffffff">
                            <div style="">
                            <div style="font-family: arial; color: #333333; font-size: 13px; line-height:19px; background-color: #ffffff;">
                                <span style="color:#e25a10; font-weight: bold; font-family: arial; font-size: 23px; line-height:26px;">We are constantly growing - <b>grow with us!</b> Some hot vacancies available today:</span>
                                <br>
                                <?
        $html = implode('', file ('http://www.luxoft.com/web-services/newsletter/alumni.vacancies.en.random-categories.php'));
        echo $html;
        ?>
                            <?/*
                            <table cellspacing="0" cellpadding="0" border="0" width="100%" style="margin:15px 0 5px; font-family: 'Arial', serif; color: #333333; border: 0px; border-collapse: collapse; padding: 0px;">
                                <tbody>
                                <tr style="border: 0px; margin: 0px; padding: 0px;">
                                    <td valign="top" align="right" style="padding:7px 8px 0 0; border: 0px;margin: 0px;">
                                        <div style="line-height:0px;">
                                            <img style="line-height:0px;" width="7" height="9" align="top" src="http://offer.luxoft.com/rs/luxoftinternational/images/orange-bullet.png" alt="bullet">
                                        </div>
                                    </td>
                                    <td valign="top" align="left" style="padding:0px 0px 3px 0; border: 0px;margin: 0px;">
                                        <a style="text-decoration: none; color:#033b7a; font-size:13px;" href="#">Senior Atlassian Engineer (Solution Architect)</a><span style="font-size:12px;color:#666666;">(Other)</span>
                                        <br>
                                    </td>
                                </tr>
                                <tr style="border: 0px; margin: 0px; padding: 0px;">
                                    <td valign="top" align="right" style="padding:7px 8px 0 0; border: 0px;margin: 0px;">
                                        <div style="line-height:0px;">
                                            <img style="line-height:0px;" width="7" height="9" align="top" src="http://offer.luxoft.com/rs/luxoftinternational/images/orange-bullet.png" alt="bullet">
                                        </div>
                                    </td>
                                    <td valign="top" align="left" style="padding:0px 0px 3px 0; border: 0px;margin: 0px;">
                                        <a style="text-decoration: none; color:#033b7a; font-size:13px;" href="#">
                                            Senior Java/XSLT Developer</a><span style="font-size:12px;color:#666666;">(Other)</span>
                                        <br>
                                    </td>
                                </tr>
                                <tr style="border: 0px; margin: 0px; padding: 0px;">
                                    <td valign="top" align="right" style="padding:7px 8px 0 0; border: 0px;margin: 0px;">
                                        <div style="line-height:0px;">
                                            <img style="line-height:0px;" width="7" height="9" align="top" src="http://offer.luxoft.com/rs/luxoftinternational/images/orange-bullet.png" alt="bullet">
                                        </div>
                                    </td>
                                    <td valign="top" align="left" style="padding:0px 0px 3px 0; border: 0px;margin: 0px;">
                                        <a style="text-decoration: none; color:#033b7a; font-size:13px;" href="#">Senior Atlassian Engineer (Solution Architect)</a><span style="font-size:12px;color:#666666;">(.Net)</span>
                                        <br>
                                    </td>
                                </tr>
                                <tr style="border: 0px; margin: 0px; padding: 0px;">
                                    <td valign="top" align="right" style="padding:7px 8px 0 0; border: 0px;margin: 0px;">
                                        <div style="line-height:0px;">
                                            <img style="line-height:0px;" width="7" height="9" align="top" src="http://offer.luxoft.com/rs/luxoftinternational/images/orange-bullet.png" alt="bullet">
                                        </div>
                                    </td>
                                    <td valign="top" align="left" style="padding:0px 0px 3px 0; border: 0px;margin: 0px;">
                                        <a style="text-decoration: none; color:#033b7a; font-size:13px;" href="#">
                                            Economist to Corporate reporting department</a><span style="font-size:12px;color:#666666;">(Java)</span>
                                        <br>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
*/?>
                                <div style="margin-top: 5px;padding-top: 3px;">
                                    <span style="color:#333333; font-weight: normal; font-family: arial; font-size: 15px; line-height:20px;">One click to build the international career! Find more vacancies in different locations at <a href="http://www.luxoft.com/careers/" style="text-decoration: none; color:#033b7a; font-weight:bold;">Luxoft Career!</a></span>
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
            <td bgcolor="#ffffff" style="" height="57" valign="top">
                <table border="0" cellspacing="0" cellpadding="0" align="center" style="width: 100%; max-width: 600px;">
                    <tr>
                        <td valign="top" align="center">
                            <img src="http://offer.luxoft.com/rs/170-LIB-021/images/w-stripe-global-career-vacancies.png" width="600" alt="Global Career Vacancies">
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="background-color: #ffffff;">
                <table border="0" cellspacing="0" cellpadding="0" style="padding-right: 15px; padding-left: 20px">
                    <tr>
                        <td align="center" valign="top">
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td align="left" valign="top" style="font-family: arial; color: #333333; font-size: 13px; line-height:19px; background-color: #ffffff;" bgcolor="#ffffff">
                            <div style="font-family: arial; color: #333333; font-size: 13px; line-height:19px; background-color: #ffffff;">
                                <span style="color:#e25a10; font-weight: bold; font-family: arial; font-size: 23px; line-height:26px;">GlobalCareer recruitment agency helps develop an international career in one click!</span>
                                <br>
                                <p>
                                    Help your friends in getting their dream job, and you can receive a reward for it!
                                </p>
                                <p>
                                    Our recruitment agency informs you of available vacancies, and of a chance for you to receive a proper bonus for a successful recommendation.
                                </p>
                                <p>
                                    Presently, our clients have a wide variety of<strong> vacant roles</strong>, and you can advise candidates (your friends or ex-colleagues) for them. The complete list of the positions is posted at our website, use the links:
                                </p>
                                <ul>
                                    <li><a style="text-decoration: none; color:#033b7a; font-weight:bold;" href="mailto:http://www.luxoft-personnel.ru/job/">Russian Vacancies</a></li>
                                    <li><a style="text-decoration: none; color:#033b7a; font-weight:bold;" href="mailto:http://www.luxoft-personnel.com/job/">International Vacancies</a></li>
                                </ul>
                                <p>
                                    <u></u>Please send your recommendations to our e-mail: <a style="text-decoration: none; color:#033b7a; font-weight:bold;" href="mailto:info@globalcareer.eu">info@globalcareer.eu</a> with the note <br/>&laquo;I recommend&raquo;.&nbsp;We would be grateful for your information about relevant candidates!
                                </p>
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
                <table border="0" cellspacing="0" cellpadding="0" align="center" style="width: 100%; max-width: 600px;">
                    <tr>
                        <td valign="top" align="center">
                            <img src="http://offer.luxoft.com/rs/170-LIB-021/images/w-stripe-referral-program.png" width="600" alt="Referral Program">
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="background-color: #ffffff;">
                <table border="0" cellspacing="0" cellpadding="0" style="padding-right: 15px; padding-left: 20px">
                    <tr>
                        <td align="center" valign="top">
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td align="left" valign="top" style="font-family: arial; color: #333333; font-size: 13px; line-height:19px; background-color: #ffffff;" bgcolor="#ffffff">
                            <div style="font-family: arial; color: #333333; font-size: 13px; line-height:19px; background-color: #ffffff;">
                                <span style="color:#e25a10; font-weight: bold; font-family: arial; font-size: 23px; line-height:26px;">You can get an extra bonus!</span>
                                <br>
                                <p>
                                    <strong>Referral Program</strong>&nbsp;is an internal program of Recruitment Department, which enables to attract specialists from the market for closing of existing and prospective vacancies in the company.&nbsp;
                                </p>
                                <p>
                                    <strong>Who can participate in the program? Everyone</strong>! It is applicable for both&nbsp;employees of the company&nbsp;and<strong>&nbsp;</strong>external recommenders.
                                </p>
                                <p>
                                    <strong>How to get a bonus? </strong>Fill in the recommendation form on our <a style="text-decoration: none; color:#033b7a; font-weight:bold;" href="http://www.luxoft.com/careers/referral/">corporate web-site</a>.
                                </p>
                                <p>
                                    As soon as your IT friend <strong>passes our recruitment process and is hired</strong>, you recommendation became applicable for a bonus! You&rsquo;ll get it <strong>in 3 months after your friend started working</strong>.
                                </p>
                                <p>
                                    The amount of the bonus for successful recommendation depends on the level of closed vacancy.
                                </p>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#ffffff" style="" height="70" valign="top">
                <table border="0" cellspacing="0" cellpadding="0" align="center" style="width: 100%; max-width: 600px;">
                    <tr>
                        <td valign="top" align="center">
                            <img src="http://offer.luxoft.com/rs/170-LIB-021/images/w-stripe-trainings.png" width="600" alt="Trainings">
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="background-color: #ffffff;">
                <table border="0" cellspacing="0" cellpadding="0" style="padding-right: 15px; padding-left: 20px">
                    <tr>
                        <td align="center" valign="top">
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td align="left" valign="top" style="font-family: arial; color: #333333; font-size: 13px; line-height:19px; background-color: #ffffff;" bgcolor="#ffffff">
                            <div style="font-family: arial; color: #333333; font-size: 13px; line-height:19px; background-color: #ffffff;">
                                <p>
                                    Thanks to an extensive experience of top Luxoft professionals, Luxoft Training offers deep and advanced knowledge of best practices of software development, project management, software and system engineering. <br/>
                                    <br/><b>Nearest courses:</b>
                                </p>


                                <?
        $html = implode('', file ('http://www.luxoft-training.com/ajax/alamni.php'));
        echo $html;


        ?>
                               <?/*
                                <table cellspacing="0" cellpadding="0" border="0" width="100%" style="margin:15px 0 5px; font-family: 'Arial', serif; color: #333333; border: 0px; border-collapse: collapse; padding: 0px;">
                                    <tbody>
                                    <tr style="border: 0px; margin: 0px; padding: 0px;">
                                        <td valign="top" align="right" style="padding:7px 8px 0 0; border: 0px;margin: 0px;">
                                            <div style="line-height:0px;">
                                                <img style="line-height:0px;" width="7" height="9" align="top" src="http://offer.luxoft.com/rs/luxoftinternational/images/orange-bullet.png" alt="bullet">
                                            </div>
                                        </td>
                                        <td valign="top" align="left" style="padding:0px 0px 3px 0; border: 0px;margin: 0px;">
                                            <a style="text-decoration: none; color:#033b7a; font-size:13px;" href="#">Oct 25, 2015, PTRN-028_ONL Secure Coding in C and C++</a> <span style="font-size:12px;color:#666666;">(Online)</span>
                                            <br>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                */ ?>
                                <div style="margin-top: 5px;padding-top: 3px;">
                                    <span style="color:#333333; font-weight: normal; font-family: arial; font-size: 15px; line-height:20px;">Find <b>more trainings</b> in different locations at <a style="text-decoration: none; color:#033b7a; font-weight:bold;" href="http://www.luxoft-training.com/">Luxoft Training!</a></span>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#ffffff" style="" height="87" valign="top">
                <table border="0" cellspacing="0" cellpadding="0" align="center" style="width: 100%; max-width: 600px;">
                    <tr>
                        <td valign="top" align="center">
                            <img src="http://offer.luxoft.com/rs/170-LIB-021/images/w-stripe-global-presence.png" width="600" alt="Global Presence">
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="background-color: #ffffff;">
                <table border="0" cellspacing="0" cellpadding="0" style="padding-right: 15px; padding-left: 20px">
                    <tr>
                        <td align="center" valign="top">
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td align="left" valign="top" style="font-family: arial; color: #333333; font-size: 13px; line-height:19px; background-color: #ffffff;" bgcolor="#ffffff">
                            <div style="font-family: arial; color: #333333; font-size: 13px; line-height:19px; background-color: #ffffff;">
                                <span style="color:#e25a10; font-weight: bold; font-family: arial; font-size: 23px; line-height:26px;">Opportunities to work in an open world. Become a part of our global team!</span>
                                <br> <br>
                                <img src="http://offer.luxoft.com/rs/170-LIB-021/images/w-stripe-map.png" alt="Map" width="561">
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="background-color: #ffffff;" valign="top">
                <table border="0" cellspacing="0" cellpadding="0" width="90%" style="padding-right: 15px; padding-left: 20px">
                    <tr>
                        <td valign="top" style="">
                            <div class="mktEditable">
						<span style="color:#000000; font-weight: bold; font-family: arial; font-size: 15px; line-height:20px;">Kind regards,<br>
						</span>
						<span style="color:#666666; font-weight: normal; font-family: arial; font-size: 14px; line-height:20px;">
						<a style="text-decoration: none; color:#033b7a; font-size:17px; font-weight: bold;" href="mailto:VFedorenko<?=EMAIL_DOMAIN?>">Veronika Fedorenko</a>&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tel: &#43; 495 967 8030 ext 5912<br>
						 HR Analyst<br>
						 Luxoft Russia<br>
						 HR MAC </span>
                            </div>
                        </td>
                    </tr>
                </table>
                <br>
                <img src="http://offer.luxoft.com/rs/170-LIB-021/images/w-footer.png" width="600" height="62" alt="Alumni Footer" border="0">
            </td>
        </tr>
        <tr>
            <td height="30">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td style="background-color: #ffffff;" valign="top">
                <table cellspacing="0" cellpadding="0" border="0" align="center" style="width: 100%; max-width: 600px; padding-right: 15px;  padding-left: 20px">
                    <tbody>
                    <tr>
                        <td valign="top" align="center">
                            <table width="280" cellspacing="0" cellpadding="0" border="0" align="left" >
                                <tbody>
                                <tr>
                                    <td style="padding-top: 0px; padding-right: 15px; padding-left: 0px; color: #333333; line-height:17px; font-size: 14px; font-family: 'Arial', serif;">
							<span style="color: #8A8A8A; font-family: 'Calibri', sans-serif; font-size: 12px; font-weight: normal;"><strong>Why am I receiving this email?</strong><br/>
							You are subscribed to receive this e-mail because you are a valued member of Luxoft's community and we would like to keep you informed of latest company's news<br>
							</span>
                                        <br/>
							<span style="color: #8A8A8A; font-family: 'Calibri', sans-serif; font-size: 12px; font-weight: normal; text-decoration:underline;">
							<a style="color: #8A8A8A;  text-decoration:underline;" href="http://ibs-training.ru/unsubscribe/?mid=#MAIL_ID#&mhash=#MAIL_MD5#">Click here to unsubscribe our email</a> <br>
							</span>
                                        <br/>
							<span style="color: #8A8A8A; font-family: 'Calibri', sans-serif; font-size: 12px; font-weight: normal;">
							© 2015 Luxoft, all rights reserved <br>
							</span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <table width="260" align="left">
                                <tbody>
                                <tr>
                                    <td style="padding-top: 0px;line-height:21px; padding-left: 12px; color: #333333; font-size: 14px; font-family: 'Arial', serif;">
                                        <div id="edit_right_column-1" class="mktEditable">
                                            <span style="text-align: left; margin-top: 5px; margin-bottom: 0px; color: #8A8A8A; font-family: 'Arial', sans-serif; font-weight: normal; font-size: 8pt;"><b>Follow us on:</b></span>&nbsp; <br/>
								<span style="text-align: left; margin-top: 0px; margin-bottom: 0px; color: #8A8A8A; font-family: 'Arial', sans-serif; font-weight: normal; font-size: 8pt;">
								<a href="http://www.linkedin.com/companies/luxoft"><img style="vertical-align:-8px;" src="http://offer.luxoft.com/rs/luxoftinternational/images/linkedin-26x26.gif" border="0" width="26" height="26" alt="LinkedIn" title="LinkedIn"></a>
								<a href="http://twitter.com/Luxoft"><img style="vertical-align:-8px;" src="http://offer.luxoft.com/rs/luxoftinternational/images/twitter-26x26.gif" border="0" width="26" height="26" alt="Twitter" title="Twitter"></a>
								<a href="http://www.youtube.com/channel/UCDtOIqWxKHTdtmVi8yr_D7Q"><img style="vertical-align:-8px;" src="http://offer.luxoft.com/rs/luxoftinternational/images/youtube-26x26.gif" border="0" width="26" height="26" alt="YouTube" title="YouTube"></a>
								<a href="https://www.facebook.com/Luxoft"><img style="vertical-align:-8px;" src="http://offer.luxoft.com/rs/luxoftinternational/images/facebook-26x26.gif" border="0" width="26" height="26" alt="Facebook" title="Facebook"></a>
								<a href="https://plus.google.com/109881160058685562700"><img style="vertical-align:-8px;" src="http://offer.luxoft.com/rs/luxoftinternational/images/gplus-26x26.gif" border="0" width="26" height="26" alt="Google Plus" title="Google Plus"></a>
								</span>
                                            <br>
                                            <br>
								<span style="color: #8A8A8A; font-family: 'Calibri', sans-serif; font-size: 12px; font-weight: normal;">
								<strong>Luxoft Global Operations GmbH</strong><br>
								 Gubelstrasse, 24<br>
								 6300 Zug, Switzerland <br>
								<br>
								</span>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td height="30">
                &nbsp;
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
		"CHARSET"=>"UTF-8",
		"DIRECT_SEND"=>"Y",
		"FROM_FIELD"=>$SUBSCRIBE_TEMPLATE_RUBRIC["FROM_FIELD"],
	);
else
	return false;
?>
