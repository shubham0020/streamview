<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns:v="urn:schemas-microsoft-com:vml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />
    <!--[if !mso]-->
    <!-- -->
    <link href='https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700' rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Quicksand:300,400,700' rel="stylesheet">
    <!-- <![endif]-->
    <title>{{Setting::get('site_name')}}</title>
    <style type="text/css">
    body {
        width: 100%;
        background-color: #ffffff;
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
            width: 335px !important;
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
    }
    </style>
</head>

<body class="respond" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
    <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="ffffff">
        <tr>
            <td align="left">
                <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">
                    <tr>
                        <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="left" style="width:25px;">
                            <table border="0" align="left" width="0" cellpadding="0" cellspacing="0" class="container590 container591">
                                <tr>
                                    <td align="left" height="70" style="height:70px;">
                                        <a href="" style="display: block; border-style: none !important; border: 0 !important;"><img width="24" border="0" class="mobile-img" style="display: block; width: 24px;" src="img/fav-icon.png" alt="" /></a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td style="padding: 0 0 3px 20px" align="left">
                            <table cellpadding="0" cellspacing="0" border="0" style="border-spacing: 0">
                                <tbody>
                                    <tr>
                                        <td style="font-size: 18px;font-weight: 600;">
									     	For {{$email_data['name']}}
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
    <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="ffffff">
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
                                    <td align="center" height="70" style="height:70px;">
                                        <img width="100" border="0" class="mobile-img" style="display: block; width:100%;border-top-left-radius:10px;border-top-right-radius:10px" src="{{$email_data['video_image']}}" alt="{{Setting::get('site_name')}}" />
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
     <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="ffffff">
        <tr>
            <td align="center">
                <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590" style="background: #000000;padding: 20px 0;border-bottom-left-radius:10px;border-bottom-right-radius:10px;">
                    <tr>
                        <td align="left">
                            <table border="0" align="center" width="100%" cellpadding="0" cellspacing="0" class="container590">
                                <tr>
                                    <td align="left" style="font-size: 18px;color: #ffffff;font-weight: 600;padding: 5px 30px;width:100%">
                                     {{$email_data['video_name']}}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align="left">
                            <table border="0" align="center" width="100%" cellpadding="0" cellspacing="0" class="container590">
                                <tr>
                                    <td align="left" style="font-size: 18px;color: #ffffff;font-weight: 600;padding: 5px 30px;width:100%">
                                        <span align="center" style="border: 1px solid #434344;color: #f5f5f1;background-color: #434344;padding: 2px 4px 2px 4px;border-radius: 4px;margin-right: 10px;font-size: 13px;">
                                            {{date('Y')}}
                                        </span>
                                       
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align="left">
                            <table border="0" align="center" width="100%" cellpadding="0" cellspacing="0" class="container590">
                                <tr>
                                    <td align="left" style="font-size: 14px;color: #ffffff;font-weight: 500;padding: 5px 30px;width:100%">
                                        {!! $email_data['content'] !!}
                                        <a href="{{$email_data['play_video_link']}}" style="color: #ffffff;line-height: 2;padding-left:5px">
                                            {{tr('more_info')}}
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr style="padding: 5px 30px;">
                        <td>
                            <table border="0" align="center" width="90%" cellpadding="0" cellspacing="0" class="container590 half-width">
                                <tr style="font-size: 14px;color: #ffffff;font-weight: 500;">
                                    <td width="48%" style="width:48%;border: solid 2px #e50914;border-radius: 4px;text-decoration: none;border-spacing: 0;background-color: #e50914;padding: 15px;text-align: center;font-size: 15px;font-weight: 600;letter-spacing: 0.5px;">
                                        <a href="{{$email_data['play_video_link']}}" style="color:#ffffff;text-decoration:none">
										{{tr('play')}}
                                        </a>
                                    </td>
                                    <td width="3%" style="width:3%"></td>
                                    <td width="48%" style="width:48%;border: solid 2px #333333;border-radius: 4px;text-decoration: none;border-spacing: 0;background-color:#333333;text-align:center;font-size: 15px;font-weight: 600;letter-spacing: 0.5px">
                                        <a href="{{$email_data['wishlist_link']}}" style="color:#ffffff;text-decoration:none">
										{{tr('my_list')}}
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="ffffff">
        <tr>
            <td align="center">
                <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">
                    <tr>
                        <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="left">
                            <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">
                                <tr>
                                    <td align="left" style="font-size: 18px;color: #000000;font-weight: 600;padding: 5px 0px;width:100%">
                                        {{tr('recently_added')}}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr style="width:100%;display:block">
                    @if($email_data['recent_videos'])

                            @foreach($email_data['recent_videos'] as $recent_video_details)                     
                                <td width="6"> &nbsp; </td>
                                <td style="width:33.33%;" width="33.33%">
                                    <a href="{{$recent_video_details['video_link']}}">
                                        <img width="100" border="0" class="mobile-img" 
                                            style="display: block; width:100%;
                                            border-radius:10px;height: 18em;object-fit: cover;" 
                                            src="{{$recent_video_details['default_image']}}" alt="" 
                                        />
                                    </a>
                                </td>
                                @endforeach
                        @endif
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="ffffff">
        <tr>
            <td align="center">
                <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">
                    <tr>
                        <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="left">
                            <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">
                                <tr>
                                    <td align="left" style="font-size: 18px;color: #000000;font-weight: 600;padding: 5px 0px;width:100%">
                                        {{tr('more_for')}} {{$email_data['name']}}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr style="width:100%;display:block;padding-top:5px">
                    @if($email_data['random_videos'])

                        @foreach($email_data['random_videos'] as $random_videos) 
                            <td width="6"> &nbsp; </td>
                            <td style="width:50%;" width="33.33%">
                                <a href="{{Setting::get('ANGULAR_SITE_URL').'video/'.$random_videos->id}}">
                                    <img width="100" border="0" class="mobile-img" 
                                        style="display: block; width:100%;
                                        border-radius:10px" 
                                        src="{{$random_videos->default_image}}" alt="" 
                                    />
                                </a>
                            </td>
                            @endforeach
                    @endif
                    </tr>
                  
                </table>
            </td>
        </tr>
    </table>

    <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="ffffff">
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
                                    <td align="center" style="background-color: #e50914;border: solid 1px #e50914;color: rgb(255,255,255);font-weight: 600;font-size: 14px;border-radius: 4px;text-decoration: none;text-align: center;padding: 13px 0 13px 0;width: 100%;">
                                       <a href="{{Setting::get('ANGULAR_SITE_URL')}}" style="color:#ffffff;text-decoration:none">
									   {{tr('view_all_tv_and_flims')}}
                                       </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    
    <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="ffffff">
        <tr>
            <td align="left">
                <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">
                    <tr>
                        <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="left">
                            <a href="" style="display: block; border-style: none !important; border: 0 !important;"><img width="24" border="0" class="mobile-img" style="display: block; width: 24px;" src="img/fav-icon.png" alt="" /></a>
                        </td>
                         <td style="padding: 0 0 3px 0px" align="left">
                            <table cellpadding="0" cellspacing="0" border="0" style="border-spacing: 0">
                                <tbody>
                                    <tr>
                                        <td style="font-size: 14px;font-weight: 300;color: rgb(169,166,166);">
                                            Questions? Call 000-800-040-1843 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 12px;font-weight: 600;color: rgb(169,166,166);line-height: 1.5;margin-top:20px;">
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
    <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="ffffff" class="bg_color">
        <tr>
            <td height="40" style="font-size: 40px; line-height: 40px;">&nbsp;</td>
        </tr>
        <tr>
            <td align="center">
                <table border="0" align="center" width="100" cellpadding="0" cellspacing="0" class="container590 bg_color">
                    <tr>
                        <td>
                            <table border="0" width="300" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                                <tr>
                                   
                                    <td align="center" style="color: #888888; font-size: 14px; line-height: 23px;" class="text_color">
                                        <div style="color: #333333; font-size: 14px;font-weight: 600; mso-line-height-rule: exactly; line-height: 23px;">
                                            <a href="{{$email_data['terms_link']}}" style="color: #888888; font-size: 14px; font-weight: 400;">{{tr('terms_conditions')}}</a>
                                        </div>
                                    </td>
                                    <td align="center" style="color: #888888; font-size: 14px; line-height: 23px;" class="text_color">
                                        <div style="color: #333333; font-size: 14px; font-weight: 600; mso-line-height-rule: exactly; line-height: 23px;">
                                            <a href="{{$email_data['privacy_link']}}" style="color: #888888; font-size: 14px; font-weight: 400;">{{tr('privacy')}}</a>
                                        </div>
                                    </td>
                                    <td align="center" style="color: #888888; font-size: 14px; line-height: 23px;" class="text_color">
                                        <div style="color: #333333; font-size: 14px; font-weight: 600; mso-line-height-rule: exactly; line-height: 23px;">
                                            <a href="{{$email_data['help_link']}}" style="color: #888888; font-size: 14px; font-weight: 400;">{{tr('help_center')}}</a>
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
    </table>
</body>

</html>