<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="viho admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities." />
        <meta name="keywords" content="admin template, viho admin template, dashboard template, flat admin template, responsive admin template, web app" />
        <meta name="author" content="pixelstrap" />
        <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon" />
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon" />
        <title>viho - Premium Admin Template</title>
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/fontawesome.css') }}" />
        <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
        <style type="text/css">
            body {
                text-align: center;
                margin: 0 auto;
                width: 650px;
                font-family: work-Sans, sans-serif;
                background-color: #f6f7fb;
                display: block;
            }
            ul {
                margin: 0;
                padding: 0;
            }
            li {
                display: inline-block;
                text-decoration: unset;
            }
            a {
                text-decoration: none;
            }
            h5 {
                margin: 10px;
                color: #777;
            }
            .text-center {
                text-align: center;
            }
            .main-bg-light {
                background-color: #fafafa;
            }
            .title {
                color: #444444;
                font-size: 22px;
                font-weight: bold;
                margin-top: 20px;
                margin-bottom: 0;
                padding-bottom: 0;
                text-transform: capitalize;
                display: inline-block;
                line-height: 1;
            }
            .menu {
                width: 100%;
            }
            .menu li a {
                text-transform: capitalize;
                color: #444;
                font-size: 16px;
                margin-right: 15px;
                font-weight: 600;
            }
            .main-logo {
                padding: 10px 20px;
            }
            .product-box .product {
                border: 1px solid #ddd;
                text-align: center;
                position: relative;
                margin: 0 15px;
            }
            .product-info {
                margin-top: 15px;
            }
            .product-info h6 {
                line-height: 1;
                margin-bottom: 0;
                padding-bottom: 5px;
                font-size: 14px;
                font-family: "Open Sans", sans-serif;
                color: #777;
                margin-top: 0;
            }
            .product-info h4 {
                font-size: 16px;
                color: #444;
                font-weight: 700;
                margin-bottom: 0;
                margin-top: 5px;
                padding-bottom: 5px;
                line-height: 1;
            }
            .add-with-banner > td {
                padding: 0 15px;
            }
            .footer-social-icon tr td img {
                margin-left: 5px;
                margin-right: 5px;
            }
            .temp-social td {
                display: inline-block;
            }
            .temp-social td i {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                display: flex;
                justify-content: center;
                align-items: center;
                color: #2B6ED4;
                //- padding:10px;
                background-color: #2B6ED43d;
                transition: all 0.5s ease;
            }
            .temp-social td:nth-child(n + 2) {
                margin-left: 15px;
            }
        </style>
    </head>
    <body style="margin: 20px auto;">
        <table align="center" border="0" cellpadding="0" cellspacing="0" style="background-color: #fff; -webkit-box-shadow: 0px 0px 14px -4px rgba(0, 0, 0, 0.2705882353); box-shadow: 0px 0px 14px -4px rgba(0, 0, 0, 0.2705882353);">
            <tbody>
                <tr>
                    <td>
                        <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tbody>
                                <tr class="header">
                                    <td align="left" valign="top"><img class="main-logo" src="{{ asset('assets/images/logo/logo.png') }}" /></td>
                                    <td class="menu" align="right">
                                        <ul>
                                            <li style="display: inline-block; text-decoration: unset;">
                                                <a href="javascript:void(0)" style="text-transform: capitalize; color: #444; font-size: 16px; margin-right: 15px; text-decoration: none;">Home</a>
                                            </li>
                                            <li style="display: inline-block; text-decoration: unset;">
                                                <a href="javascript:void(0)" style="text-transform: capitalize; color: #444; font-size: 16px; margin-right: 15px; text-decoration: none;">Whishlist</a>
                                            </li>
                                            <li style="display: inline-block; text-decoration: unset;">
                                                <a href="javascript:void(0)" style="text-transform: capitalize; color: #444; font-size: 16px; margin-right: 15px; text-decoration: none;">my cart</a>
                                            </li>
                                            <li style="display: inline-block; text-decoration: unset;">
                                                <a href="javascript:void(0)" style="text-transform: capitalize; color: #444; font-size: 16px; margin-right: 15px; text-decoration: none;">Contact</a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tbody>
                                <tr>
                                    <td><img src="{{ asset('assets/images/email-template/1.jpg') }}" alt="" style="width: 100%;" /></td>
                                </tr>
                            </tbody>
                        </table>
                        <h4 class="title" style="text-align: center;">Additional 50% Off</h4>
                        <h5 style="text-align: center;color: #aba8a8;font-size: 14px;}">On clothes for kids,women & Mens Wear</h5>
                        <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top: 30px;">
                            <thead>
                                <tr></tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="product-box hover">
                                            <div class="product border-theme br-0"><img src="{{ asset('assets/images/email-template/2.png') }}" alt="product" style="width: 100%;" /></div>
                                            <div class="product-info">
                                                <a href="javascript:void(0)" tabindex="0" style="text-align: center;"> <h6 style="text-align: center;">When an unknown.</h6></a>
                                                <h4 style="text-align: center;">$45.00</h4>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="product-box hover">
                                            <div class="product border-theme br-0"><img class="img-fluid" src="{{ asset('assets/images/email-template/7.png') }}" alt="product" /></div>
                                            <div class="product-info">
                                                <div class="rating"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></div>
                                                <a href="javascript:void(0)" tabindex="0" style="text-align: center;"> <h6 style="text-align: center;">When an unknown.</h6></a>
                                                <h4 style="text-align: center;">$45.00</h4>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="product-box hover">
                                            <div class="product border-theme br-0"><img class="img-fluid" src="{{ asset('assets/images/email-template/8.png') }}" alt="product" /></div>
                                            <div class="product-info">
                                                <div class="rating"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></div>
                                                <a href="javascript:void(0)" tabindex="0" style="text-align: center;"> <h6 style="text-align: center;">When an unknown.</h6></a>
                                                <h4 style="text-align: center;">$45.00</h4>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="main-bg-light" border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top: 40px;">
                            <tbody>
                                <tr>
                                    <td height="45" style="mso-line-height-rule: exactly; line-height: 45px;"></td>
                                </tr>
                                <tr class="add-with-banner" align="center">
                                    <td><img src="{{ asset('assets/images/email-template/3.png') }}" /></td>
                                    <td>
                                        <div style="border-top: 1px solid #f02e4e; mso-line-height-rule: exactly;" data-border-bottom-color="Week Border"></div>
                                        <a href="javascript:void(0)">
                                            <div
                                                class="Heading"
                                                align="center"
                                                style="color: #333333; font-weight: 600; font-size: 23px; letter-spacing: 1px; line-height: 35px; mso-line-height-rule: exactly; margin-top: 15px;"
                                                data-color="Week Heading"
                                                data-size="Week Heading"
                                                data-min="15"
                                                data-max="43"
                                            >
                                                This Week's Sale
                                            </div>
                                            <div
                                                class="Heading"
                                                align="center"
                                                style="color: #333333; font-weight: 600; font-size: 25px; letter-spacing: 1px; line-height: 35px; mso-line-height-rule: exactly; margin-bottom: 15px;"
                                                data-color="Week Heading"
                                                data-size="Week Heading"
                                                data-min="15"
                                                data-max="45"
                                            >
                                                Save Up To 50%
                                            </div>
                                        </a>
                                        <div style="border-bottom: 1px solid #f02e4e; mso-line-height-rule: exactly;" data-border-bottom-color="Week Border"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td height="45" style="mso-line-height-rule: exactly; line-height: 45px;"></td>
                                </tr>
                            </tbody>
                        </table>
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tbody>
                                <tr align="center">
                                    <td>
                                        <a href="javascript:void(0)"><img src="{{ asset('assets/images/email-template/cosmetic.jpg') }}" style="width: 100%;" /></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top: 30px;">
                            <tbody>
                                <tr class="add-with-banner" align="center">
                                    <td>
                                        <a href="javascript:void(0)"><img src="{{ asset('assets/images/email-template/6.png') }}" style="width: 100%;" /></a>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)"><img src="{{ asset('assets/images/email-template/5.png') }}" style="width: 100%;" /></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="main-bg-light text-center top-0" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tbody>
                                <tr>
                                    <td style="padding: 30px;">
                                        <div>
                                            <h4 class="title" style="margin: 0; text-align: center;">Follow us</h4>
                                        </div>
                                        <table border="0" cellpadding="0" cellspacing="0" align="center" style="margin-top: 20px;">
                                            <tbody>
                                                <tr class="temp-social">
                                                    <td>
                                                        <a href="javascript:void(0)"><i class="fa fa-facebook"></i></a>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0)"><i class="fa fa-youtube-play"></i></a>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0)"><i class="fa fa-twitter"></i></a>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0)"><i class="fa fa-google-plus"></i></a>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0)"><i class="fa fa-linkedin"> </i></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div style="border-top: 1px solid #ddd; margin: 20px auto 0;"></div>
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 20px auto 0;">
                                            <tbody>
                                                <tr>
                                                    <td><a href="javascript:void(0)" style="color: #2B6ED4; font-size: 14px; text-transform: capitalize; font-weight: 600;">Want to change how you receive these emails?</a></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p style="font-size: 14px; margin: 8px 0; color: #aba8a8;">2021 - 22 Copy Right by Themeforest powerd by Pixel Strap</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><a href="javascript:void(0)" style="color: #2B6ED4; font-size: 14px; text-transform: capitalize; font-weight: 600; margin: 0; text-decoration: underline;">Unsubscribe</a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </body>
</html>
