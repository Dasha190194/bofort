<?php

use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var string $subject
 * @var \amnah\yii2\user\models\User $user
 * @var \amnah\yii2\user\models\Profile $profile
 * @var \amnah\yii2\user\models\UserToken $userToken
 */

$url = Url::toRoute(["/user/confirm", "token" => $userToken->token], true);
?>



<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Подтверждение Email</title>
    <style>
        /* -------------------------------------
            GLOBAL RESETS
        ------------------------------------- */
        img {
            border: none;
            -ms-interpolation-mode: bicubic;
            max-width: 100%; }
        body {
            background-color: #ffffff;
            font-family: sans-serif;
            -webkit-font-smoothing: antialiased;
            font-size: 14px;
            line-height: 1.4;
            margin: 0;
            padding: 0;
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%; }
        table {
            border-collapse: separate;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
            width: 100%; }
        table td {
            font-family: sans-serif;
            font-size: 14px;
            vertical-align: top; }
        /* -------------------------------------
            BODY & CONTAINER
        ------------------------------------- */
        .body {
            background-color: #ffffff;
            width: 100%; }
        /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
        .container {
            display: block;
            Margin: auto;
            /* makes it centered */
            max-width: 700px;
            padding: 10px;
            width: 700px; }
        /* This should also be a block element, so that it will fill 100% of the .container */

        .container-footer {
            display: block;
            Margin: auto;
            /* makes it centered */
            max-width: 700px;
            padding: 10px;
        }
        /* This should also be a block element, so that it will fill 100% of the .container */

        .content {

            box-sizing: border-box;
            display: block;
            Margin: 0 auto;
            max-width: 700px;
            padding: 10px; }
        /* -------------------------------------
            HEADER, FOOTER, MAIN
        ------------------------------------- */
        .main {
            background-color: #F1F3F9;
            border-radius: 15px;
            width: 100%; }
        .wrapper {
            box-sizing: border-box;
            padding: 30px 30px 30px 30px; }
        .content-block {
            padding-bottom: 10px;
            padding-top: 10px;
        }
        .email-logo {
            text-align: center;
        }
        .email-logo img {
            width: 125px;
            height: auto !important;
            padding-bottom: 25px;
        }
        .copy-left {
            text-align: center !important;
            padding: 10px 0px 10px 10px;
            font-size: 13px;
            line-height: 18px;
            vertical-align: middle;
            color: #05355d }
        .copy-right {
            text-align: right;
            padding: 10px 0 10px 0;
            width: 100px;
            vertical-align: middle; }
        .footer {
            clear: both;
            Margin-top: 10px;
            text-align: center;
            width: 100%; }
        .footer td,
        .footer p,
        .footer span,
        .footer a {
            color: #05355d;
            font-size: 12px;
            text-align: left;
            padding: 0 1%;
            line-height: 20px; }
        /* -------------------------------------
            TYPOGRAPHY
        ------------------------------------- */
        h1,
        h2,
        h3,
        h4 {
            color: #05355d;
            font-family: sans-serif;
            font-weight: 400;
            line-height: 1.4;
            margin: 0;
            margin-top: 10px;
            Margin-bottom: 30px; }
        h1 {
            font-size: 20px;
            font-weight: 500;
            text-align: center; }
        p,
        ul,
        ol {
            font-family: sans-serif;
            font-size: 16px;
            font-weight: normal;
            margin: 0;
            Margin-bottom: 15px;
            color: #05355d;
            line-height: 25px; }
        p li,
        ul li,
        ol li {
            list-style-position: inside;
            margin-left: 5px; }
        a {
            color: #05355d;
            text-decoration: underline; }
        /* -------------------------------------
            BUTTONS
        ------------------------------------- */
        .btn {
            box-sizing: border-box;
            width: 100%; }
        .btn > tbody > tr > td {
            padding-bottom: 15px; }
        .btn table {
            width: auto; }
        .btn table td {
            background-color: #ffffff;
            border-radius: 5px;
            text-align: center; }
        .btn a {
            background-color: #ffffff;
            border: solid 1px #3498db;
            border-radius: 5px;
            box-sizing: border-box;
            color: #05355d;
            cursor: pointer;
            display: inline-block;
            font-size: 14px;
            font-weight: bold;
            margin: 0;
            padding: 12px 25px;
            text-decoration: none;
            text-transform: capitalize; }
        .btn-primary table td {
            background-color: #3498db; }
        .btn-primary a {
            background-color: #3498db;
            border-color: #3498db;
            color: #ffffff; }
        /* -------------------------------------
            OTHER STYLES THAT MIGHT BE USEFUL
        ------------------------------------- */
        .last {
            margin-bottom: 0; }
        .first {
            margin-top: 0; }
        .align-center {
            text-align: center; }
        .align-right {
            text-align: right; }
        .align-left {
            text-align: left; }
        .clear {
            clear: both; }
        .mt0 {
            margin-top: 0; }
        .mb0 {
            margin-bottom: 0; }
        .preheader {
            color: transparent;
            display: none;
            height: 0;
            max-height: 0;
            max-width: 0;
            opacity: 0;
            overflow: hidden;
            mso-hide: all;
            visibility: hidden;
            width: 0; }
        .powered-by a {
            text-decoration: none; }
        hr {
            border: 0;
            border-bottom: 1px solid #f6f6f6;
            Margin: 20px 0; }
        /* -------------------------------------
            RESPONSIVE AND MOBILE FRIENDLY STYLES
        ------------------------------------- */
        @media only screen and (max-width: 620px) {
            table[class=body] h1 {
                font-size: 24px !important;
                margin-bottom: 20px !important;
                line-height: 1.2 !important; }
            table[class=body] p,
            table[class=body] ul,
            table[class=body] ol,
            table[class=body] td,
            table[class=body] span,
            table[class=body] a {
                font-size: 13px !important; }
            table[class=body] .wrapper,
            table[class=body] .article {
                padding: 10px !important; }
            table[class=body] .content {
                padding: 0 !important; }
            table[class=body] .container {
                padding: 0 !important;
                width: 100% !important; }
            table[class=body] .main {
                border-left-width: 0 !important;
                border-radius: 0 !important;
                border-right-width: 0 !important; }
            table[class=body] .btn table {
                width: 100% !important; }
            table[class=body] .btn a {
                width: 100% !important; }
            table[class=body] .img-responsive {
                height: auto !important;
                max-width: 100% !important;
                width: auto !important; }}

    </style>
</head>
<body class="">
<div class="header" style="background: #043058; padding: 10px;">
    <a class="navbar-brand" href="https://bofort.ru"><img src="https://bofort.ru/img/web-logo.svg" alt="Бофорт"></a>
</div>
<table border="0" cellpadding="0" cellspacing="0" class="body">
    <tr>
        <td>&nbsp;</td>
        <td class="container">
            <div class="content">
                <table style="padding: 0 30px 20px 30px;">
                    <tr>
                        <td class="wrapper">
                            <table border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="color: #05355d;">
                                        <h2>Бофорт - подтверждение Email</h2>

                                        <p>Пожалуйста, подтвердите ваш email, перейдя по ссылке ниже:</p>

                                        <p><?= Html::a($url, $url) ?></p>
                                    </td>
                                </tr>

                            </table>

                        </td>
                    </tr>

                    <!-- END MAIN CONTENT AREA -->
                </table>



                <table class="" style="width: 100%; padding: 0 30px 20px 30px;">
                    <tr>

                        <td class="container-footer" style="text-align: center; padding: 10px 0px 10px 10px; font-size: 13px; line-height: 18px; color: #05355d;">
                            <div class="content">
                                2019 © <a href="https://bofort.ru" style="color: #05355d;">Bofort.ru</a>, Москва, Петровско-Разумовский проезд, 15
                            </div>
                        </td>
                    </tr>
                </table>

                <!-- END CENTERED WHITE CONTAINER -->
            </div>
        </td>
        <td>&nbsp;</td>
    </tr>
</table>
</body>
</html>