<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns:v="urn:schemas-microsoft-com:vml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />
    <!--[if !mso]-->
    <!-- -->
    <!-- <![endif]-->
    <title>{{tr('welcome_email')}}</title>
    <style type="text/css">
    body {
        width: 100%;
        background-color: #000;
        margin: 0;
        padding: 0;
        -webkit-font-smoothing: antialiased;
        mso-margin-top-alt: 0px;
        mso-margin-bottom-alt: 0px;
        mso-padding-alt: 0px 0px 0px 0px;
        font-family:'Lato', 'Helvetica Neue', Helvetica, Arial, sans-serif;
    }

    p,
    h1,
    h2,
    h3,
    h4 {
        margin-top: 0;
        margin-bottom: 0;
        padding-top: 0;
        padding-bottom: 0;
    }

    span.preheader {
        display: none;
        font-size: 1px;
    }

    html {
        width: 100%;
    }

    table {
        font-size: 14px;
        border: 0;
    }

    .bg-grey{
        background-color: #161616;
        border: 2px solid rgba(255, 255, 255, 0.08);
        box-shadow: 0 6px 16px rgb(0 0 0 / 30%);
        padding: 20px 0;
        border-radius: 10px;
        margin:2em 0;
    }

    /* ----------- responsivity ----------- */

    @media only screen and (max-width: 640px) {

        /*------ top header ------ */
        .main-header {
            font-size: 20px !important;
        }

        .main-section-header {
            font-size: 28px !important;
        }

        .show {
            display: block !important;
        }

        .hide {
            display: none !important;
        }

        .align-center {
            text-align: center !important;
        }

        .no-bg {
            background: none !important;
        }

        /*----- main image -------*/
        .main-image img {
            width: 440px !important;
            height: auto !important;
        }

        /* ====== divider ====== */
        .divider img {
            width: 440px !important;
        }

        /*-------- container --------*/
        .container590 {
            width: 440px !important;
        }

        .container590 td {
            text-align: center !important;
        }

        .container580 {
            width: 400px !important;
        }

        .main-button {
            width: 220px !important;
        }

        /*-------- secions ----------*/
        .section-img img {
            width: 320px !important;
            height: auto !important;
        }

        .team-img img {
            width: 100% !important;
            height: auto !important;
        }

        .container590.container591 {
            width: 200px!important;
        }

    }

    @media only screen and (max-width: 479px) {

        /*------ top header ------ */
        .main-header {
            font-size: 18px !important;
        }

        .main-section-header {
            font-size: 26px !important;
        }

        /* ====== divider ====== */
        .divider img {
            width: 280px !important;
        }

        /*-------- container --------*/
        .container590 {
            width: 95% !important;
        }

        .container580 {
            width: 260px !important;
        }

        /*-------- secions ----------*/
        .section-img img {
            width: 280px !important;
            height: auto !important;
        }
        .container590.container591 {
            width: 200px!important;
        }
        .container590.half-width{
            width: 80%!important;
        }
        .resp-padding-sm{
            padding: 0em 1em!important;
        }
        .mobile-img.responsive-img{
            max-width: 25em!important;
            margin:auto;
        }
        .resp-flex{
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5em;
        }

        .resp-pd-left-sm{
            padding-left: 1em;
        }
    }
    </style>
</head>

<body class="respond" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgcolor="#00000" style="background-color:#000!important">
    <table border="0" cellpadding="0" cellspacing="0" bgcolor="#161616" class="container590" width="590" style="max-width:590px;margin: auto;padding: 10px 20px;border-bottom-left-radius:10px;border-bottom-right-radius:10px;">
        <tr>
            <td align="left">
                <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590 resp-padding-sm">
                   <!--  <tr>
                        <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
                    </tr> -->
                    <tr>
                        <td align="left" style="width:25px;">
                            <table border="0" align="left" width="0" cellpadding="0" cellspacing="0" class="container590 container591">
                                <tr>
                                    <td align="left" height="70" style="height:70px;">
                                        <a href="" style="display: block; border-style: none !important; border: 0 !important;"><img width="24" border="0" class="mobile-img" style="display: block; width: 24px;" src="{{Setting::get('site_icon')}}" alt="{{Setting::get('site_name')}}" /></a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td style="padding: 0 0 3px 20px" align="left">
                            <table cellpadding="0" cellspacing="0" border="0" style="border-spacing: 0">
                                <tbody>
                                    <tr>
                                        <td style="font-size: 18px;font-weight: 600;font-family: Arial, sans-serif, 'Open Sans';color:#ffffff;">
                                             {{Setting::get('site_name')}} 
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="000">
        <tr>
            <td align="center">
                <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">
                    <tr>
                        <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="center">
                            <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">
                                <tr>
                                    <td align="center" height="50" style="height:50px;">
                                        <img width="100" border="0" class="mobile-img responsive-img" style="display: block; width:100%;border-top-left-radius:10px;border-top-right-radius:10px; max-height: 20em;object-fit: cover;" src="{{asset('images/welcome.png')}}" alt="{{Setting::get('site_name')}}" />
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#161616" class="container590" width="590" style="max-width:590px;margin:2em auto;padding: 10px 20px;border-radius: 10px;border: 2px solid rgba(255, 255, 255, 0.08);box-shadow: 0 6px 16px rgb(0 0 0 / 30%);">
        <tr>
            <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
        </tr>
        <tr>
            <td align="center">
                <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">
                    <tr>
                        <td align="left">
                            <table border="0" align="center" width="100%" cellpadding="0" cellspacing="0" class="container590">
                                <tr>
                                    <td align="center" style="font-size: 25px;color: #ffffff;font-weight: 600;padding: 5px 30px;width:100%;text-align: center;font-family: Arial, sans-serif, 'Open Sans'">
                                        Welcome!
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                            <table border="0" align="center" width="100%" cellpadding="0" cellspacing="0" class="container590">
                                <tr>
                                    <td align="left" style="font-size: 16px;color: #ffffff;font-weight: 500;padding: 5px 30px;width:100%;text-align: center;font-family: Arial, sans-serif, 'Open Sans'">
                                        <?= $email_data['content']; ?>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr style="padding: 5px 30px;margin-top: 2em;">
                        <td>
                            <table border="0" align="center" width="90%" cellpadding="0" cellspacing="0" class="container590 half-width" style="margin-top: 1em;">
                                <tr style="font-size: 14px;color: #ffffff;font-weight: 500;">
                                    <td width="45%" style="width:48%;border: solid 2px #e50914;border-radius: 4px;text-decoration: none;border-spacing: 0;background-color: #e50914;padding: 15px;text-align: center;font-size: 15px;font-weight: 600;letter-spacing: 0.5px;">
                                        <a href="{{route('moderator.dashboard')}}" title="Confirm Your Account" target="_self" style="font-family: Arial, sans-serif, 'Open Sans';color:#ffffff;text-decoration:none">
                                            Content Creator Login
                                        </a>
                                    </td>
                                    
                                    <td width="6%" style="width:6%;"></td>

                                    <td width="45%" style="width:48%;border: solid 2px #e50914;border-radius: 4px;text-decoration: none;border-spacing: 0;background-color: #e50914;padding: 15px;text-align: center;font-size: 15px;font-weight: 600;letter-spacing: 0.5px;">
                                        <a href="{{Setting::get('ANGULAR_SITE_URL')}}" target="_self" style="font-family: Arial, sans-serif, 'Open Sans';color:#ffffff;text-decoration:none">
                                            {{tr('visit_our_website')}}
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-size: 13px;color: #ffffff;font-weight: 500;padding: 5px 0px;width:100%;text-align: center;font-family: Arial, sans-serif, 'Open Sans'">
                            <table table border="0" align="center" width="90%" cellpadding="0" cellspacing="0" class="container590 half-width">
                                <p style="margin:0.5em 0;font-family: Arial, sans-serif, 'Open Sans'">If you have any questions, just reply to this email</p>
                                <p style="font-family: Arial, sans-serif, 'Open Sans'">we're always happy to help out.</p>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
        </tr>
    </table>    
    <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="000">
        <tr>
            <td align="left">
                <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">
                    <tr>
                        <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
                    </tr>
                    <tr class="resp-flex">
                        <td align="left">
                            <a href="" style="display: block; border-style: none !important; border: 0 !important;"><img width="24" border="0" class="mobile-img" style="display: block; width: 24px;" src="{{Setting::get('site_icon')}}" alt="{{Setting::get('site_name')}}" /></a>
                        </td>
                         <td style="padding: 0 0 3px 0px" align="left">
                            <table cellpadding="0" cellspacing="0" border="0" style="border-spacing: 0">
                                <tbody>
                                    <!-- <tr>
                                        <td style="font-family: Arial, sans-serif, 'Open Sans';font-size: 14px;font-weight:400;color: #ccc;">
                                            Questions? Call 000-800-040-1843 
                                        </td>
                                    </tr> -->
                                    <tr>
                                        <td class="resp-pd-left-sm" style="font-family: Arial, sans-serif, 'Open Sans';font-size: 12px;font-weight: 600;color:#ccc;line-height: 1.8;margin-top:20px;">
                                            {{Setting::get('tag_name')}}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="000" class="bg_color">
        <tr>
            <td height="40" style="font-size: 40px; line-height: 40px;">&nbsp;</td>
        </tr>
        <tr>
            <td align="center">
                <table border="0" align="center" width="100" cellpadding="0" cellspacing="0" class="container590 bg_color">
                    <tr>
                        <td>
                            <table border="0" width="300" align="left" cellpadding="0" cellspacing="0" style="font-family: Arial, sans-serif, 'Open Sans';border-collapse:collapse;mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                                <tr>
                                    <!-- <td align="center" style="font-family: Arial, sans-serif, 'Open Sans';color: #ccc; font-size: 14px; line-height: 23px;" class="text_color">
                                        <div style="color: #333333; font-size: 14px; font-weight: 600; mso-line-height-rule: exactly; line-height: 23px;">
                                            <a href="#" style="font-family: Arial, sans-serif, 'Open Sans';color: #ccc; font-size: 14px; font-weight: 400;">Unsubscribe</a>
                                        </div>
                                    </td> -->
                                    <td align="center" style="font-family: Arial, sans-serif, 'Open Sans';color: #ccc; font-size: 14px; line-height: 23px;" class="text_color">
                                        <div style="color: #333333; font-size: 14px;font-weight: 600; mso-line-height-rule: exactly; line-height: 23px;">
                                            <a href="{{Setting::get('ANGULAR_SITE_URL')}}page/terms" style="font-family: Arial, sans-serif, 'Open Sans';color: #ccc; font-size: 14px; font-weight: 400;">Terms of Use</a>
                                        </div>
                                    </td>
                                    <td align="center" style="font-family: Arial, sans-serif, 'Open Sans';color: #ccc; font-size: 14px; line-height: 23px;" class="text_color">
                                        <div style="color: #333333; font-size: 14px; font-weight: 600; mso-line-height-rule: exactly; line-height: 23px;">
                                            <a href="{{Setting::get('ANGULAR_SITE_URL')}}page/privacy" style="font-family: Arial, sans-serif, 'Open Sans';color: #ccc; font-size: 14px; font-weight: 400;">Privacy</a>
                                        </div>
                                    </td>
                                    <td align="center" style="font-family: Arial, sans-serif, 'Open Sans';color: #ccc; font-size: 14px; line-height: 23px;" class="text_color">
                                        <div style="color: #333333; font-size: 14px; font-weight: 600; mso-line-height-rule: exactly; line-height: 23px;">
                                            <a href="{{Setting::get('ANGULAR_SITE_URL')}}page/help" style="font-family: Arial, sans-serif, 'Open Sans';color: #ccc; font-size: 14px; font-weight: 400;">Help Center</a>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <table border="0" width="2" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                                <tr>
                                    <td width="2" height="10" style="font-size: 10px; line-height: 10px;"></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td height="40" style="font-size: 40px; line-height: 40px;">&nbsp;</td>
        </tr>
    </table>
</body>

</html>