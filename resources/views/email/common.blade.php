<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
@php
    // $logo=asset(Storage::url('uploads/logo/'));
    $logo = \App\Models\Utility::get_file('uploads/logo/');

    $company_logo = Utility::getValByName('company_logo');
@endphp

<head>
    <title>
    </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        #outlook a {
            padding: 0;
        }

        .ReadMsgBody {
            width: 100%;
        }

        .ExternalClass {
            width: 100%;
        }

        .ExternalClass * {
            line-height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table,
        td {
            border-collapse: collapse;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
            -ms-interpolation-mode: bicubic;
        }

        p {
            display: block;
            margin: 13px 0;
        }
    </style>
    <style type="text/css">
        @media only screen and (max-width: 480px) {
            @-ms-viewport {
                width: 320px;
            }

            @viewport {
                width: 320px;
            }
        }
    </style>
    <style type="text/css">
        .outlook-group-fix {
            width: 100% !important;
        }
    </style>
    <link href="https://fonts.googleapis.com/css?family=Open Sans" rel="stylesheet" type="text/css">
    <style type="text/css">
        @media only screen and (min-width: 480px) {
            .mj-column-per-100 {
                width: 100% !important;
                max-width: 100%;
            }
        }
    </style>
    <style type="text/css">
        [owa] .mj-column-per-100 {
            width: 100% !important;
            max-width: 100%;
        }
    </style>
    <style type="text/css">
        @media only screen and (max-width: 480px) {
            table.full-width-mobile {
                width: 100% !important;
            }

            td.full-width-mobile {
                width: auto !important;
            }
        }
    </style>
</head>

<body style="background-color:#f8f8f8;">
    <div style="background-color:#f8f8f8;">


        <table align="center" border="0" cellpadding="0" cellspacing="0" class="" style="width:600px;"
            width="600">
            <tr>
                <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">

                    <div style="background:#ffffff;background-color:#ffffff;Margin:0px auto;max-width:600px;">
                        <!-- Header -->
                        <table align="center" width="100%" border="0" cellspacing="0" cellpadding="0"
                            bgcolor="#ffffff">
                            <tr align="center">
                                <td
                                    style="padding: 14px;border-radius:12px 12px 0 0;background-repeat: no-repeat;background-size:cover; background-image: url(https://anasacademy.uk/wp-content/uploads/2022/02/slider-03new.jpg);">
                                    <img width="80" height="80"
                                        src="https://anasacademy.uk/wp-content/uploads/2022/03/03-5-2.png"
                                        style="border-radius:50%;-ms-interpolation-mode: bicubic;">
                                </td>
                            </tr>
                        </table>
                        <!-- END Header -->

                        <!-- Start Content -->
                        <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation"
                            style="background:#ffffff;background-color:#ffffff;width:100%;">
                            <tbody>
                                <tr>
                                    <td
                                        style="direction:ltr;font-size:0px;padding:20px 0px 20px 0px;padding-bottom:70px;padding-top:30px;text-align:center;vertical-align:top;">
                                        <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td class="" style="vertical-align:top;width:600px;">
                                                    <div class="mj-column-per-100 outlook-group-fix"
                                                        style="font-size:13px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                                                        <table border="0" cellpadding="0" cellspacing="0"
                                                            role="presentation" style="vertical-align:top;"
                                                            width="100%">
                                                            <tr>
                                                                <td align="left"
                                                                    style="font-size:0px;padding:0px 25px 0px 25px;padding-top:0px;padding-right:50px;padding-bottom:0px;padding-left:50px;word-break:break-word;">
                                                                    @yield('content')
                                                                </td>
                                                            </tr>

                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- End Content -->

                        <!-- Footer -->
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#4e54cb"
                            style="border-radius:0 0 12px 12px">
                            <tr>
                                <td class="footer" <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr style="display: flex; padding:10px;">
                                <td class="img" width="50%"><a href="https://anasacademy.uk/" target="_blank"
                                        style="color: #4e54cb; text-decoration: none; height:auto;">
                                        <img class="img logo"
                                            src="https://support.anasacademy.uk//storage/public/Logo-04.png"
                                            style="float: left !important;-ms-interpolation-mode: bicubic;height:auto;padding:10px; width: 135px !important;" /></a>
                                </td>

                                <td class="img d" style="text-align: right;padding-top: 10px; float: right;"
                                    width="50%"><a href="https://twitter.com/anasacademy?lang=ar" target="_blank"
                                        style="color: #4e54cb; text-decoration: none;"></a><a
                                        href="https://www.linkedin.com/company/anasacademy/" target="_blank"
                                        style="color: #4e54cb; text-decoration: none;"><img
                                            src="https://anasacademy.uk/wp-content/uploads/2021/10/Layer-4-1.png"
                                            width="30" height="30" mc:edit="image_15"
                                            style="-ms-interpolation-mode: bicubic; max-width: 40px; margin: 0 5px !important;"
                                            border="0" alt=""></a><a
                                        href="https://www.instagram.com/anasacademy/" target="_blank"
                                        style="color: #4e54cb; text-decoration: none;"><img
                                            src="https://anasacademy.uk/wp-content/uploads/2021/10/Layer-5-1.png"
                                            width="30" height="30" mc:edit="image_15"
                                            style="-ms-interpolation-mode: bicubic; max-width: 40px; margin: 0 5px !important;"
                                            border="0" alt=""></a><a
                                        href="https://www.snapchat.com/add/anasacademy" target="_blank"
                                        style="color: #4e54cb; text-decoration: none;"><img
                                            src="https://anasacademy.uk/wp-content/uploads/2021/10/Layer-1-1.png"
                                            width="30" height="30" mc:edit="image_15"
                                            style="-ms-interpolation-mode: bicubic; max-width: 40px; margin: 0 5px !important;"
                                            border="0" alt=""></a><a
                                        href="https://www.youtube.com/channel/UCglrBLCkL6YnRZYy69-TwUw"
                                        target="_blank" style="color: #4e54cb; text-decoration: none;"><img
                                            src="https://anasacademy.uk/wp-content/uploads/2021/10/Layer-3-1.png"
                                            width="30" height="30" mc:edit="image_13"
                                            style="-ms-interpolation-mode: bicubic; max-width: 40px; margin: 0 5px !important;"
                                            border="0" alt=""></a>
                                </td>
                            </tr>


                        </table>
                        <!-- End Footer-->
                    </div>
                </td>
            </tr>

        </table>
    </div>
</body>

</html>
