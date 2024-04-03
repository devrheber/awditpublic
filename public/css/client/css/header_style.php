<?php

//Set the content-type header and charset.
header("Content-Type: text/css; charset=utf-8");
session_start();
//if (isset($_SESSION["primary_color"]) && isset($_SESSION['secondary_color'])) {
//    $primary_color = $_SESSION["primary_color"];
//    $secondary_color = $_SESSION['secondary_color'];
//} else {
    $primary_color = '#2D2A78';
    $secondary_color = '#2D2A78';
//}
?>

<style>
    body {
        padding: 0;
        margin: 0;
        font-family: 'Roboto', sans-serif !important;
    }

    img {
        max-width: 100%;
    }

    /*login-page-start*/

    .login_wrap {
        width: 100%;
        height: 100vh;
    }

    .login_wrap .row {
        width: 100%;
        margin: 0;
        height: 100%;
    }

    .login_wrap .row .col-md-5,
    .col-md-7 {
        padding: 0 !important;
    }

    .login_wrap .login_left {
        width: 100%;
        padding: 20px;
        height: 100%;
        background: #fff;
        position: relative;
    }

    .login_wrap .login_left .navbar-brand img {
        width: 70px;
    }

    .login_wrap .login_left .dropdown-toggle::after {
        display: inline-block;
        width: 0;
        height: 0;
        margin-left: .255em;
        vertical-align: 0.1em;
        content: "";
        border-top: 0.5em solid;
        border-right: 0.5em solid transparent;
        border-left: 0.5em solid transparent;
        background: transparent;
    }

    .login_wrap .login_left .navbar-nav .dropdown-menu {
        padding: 0;
        border: 1px solid #00000024;
    }

    .login_wrap .login_left .dropdown-item:hover {
        background-color: #b2ebf2;
    }

    .login_wrap .login_left .dropdown-item.active,
    .dropdown-item:active {
        color: #000;
        text-decoration: none;
        background-color: #b2ebf2;
    }

    .login_wrap .login_left form {
        padding-top: 20vh;
        width: 70%;
        margin: 0 auto;
    }

    .login_wrap .login_left form button {
        border-radius: 10px;
        margin-left: auto;
        display: block;
        padding: 10px 40px;
        text-transform: uppercase;
        background: #2D2A78;
        border-color: #2D2A78;
    }

    .login_wrap .navbar form {
        width: 100%;
        padding-top: 0;
    }

    .login_wrap .login_left form .button_login a {
        text-align: right;
        display: block;
        margin-top: 20px;
        color: #2D2A78;
        font-size: 18px;
    }

    .login_wrap .login_left form .form-control {
        border-radius: 10px;
        border-color: #757575;
        color: #212121;
        height: 50px;
    }

    .login_wrap .login_left form label {
        color: #757575;
    }

    .login_wrap .login_left form input::placeholder {
        color: #757575;
    }

    .login_wrap .login_left form .form-control:focus {
        color: #212121;
        background-color: #fff;
        border-color: #2D2A78;
        outline: 0;
        box-shadow: none;
    }

    .login_wrap .login_left .form-group {
        flex-direction: column-reverse;
        display: flex;
    }

    .login_wrap .login_left .form-group input:focus+label,
    .form-group select:focus+label,
    .form-group textarea:focus+label {
        color: #2D2A78;
    }

    .lgn_in_sgn {
        bottom: 0;
        position: absolute;
        text-align: center;
        display: block;
        width: 100%;
    }

    .lgn_in_sgn p {
        font-size: 18px;
    }

    .lgn_in_sgn a {
        color: #2D2A78;
        font-weight: 500;
    }

    .login_right {
        width: 100%;
        background: url(../images/login_right_bg.png);
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: 100%;
        padding-top: 40vh;
        padding-left: 10vh;
    }

    .login_right h2 {
        font-size: 50px;
        color: #ffffff;
        margin-bottom: 20px;
    }

    .login_right h2 span {
        font-weight: bold;
    }

    .login_right p {
        font-size: 20px;
        color: #fff;
    }


    /*login-page-end*/

    /*recovery-password-page-start*/

    .recovery_wrap {
        width: 100%;
        padding: 0;
        margin: 0;
    }

    .recovery_wrap .row {
        padding: 0;
        margin: 0;
    }

    .recovery_wrap .row .col-md-7 {
        padding: 0;
    }

    .recovery_wrap .recovery_left form {
        background: #fff;
        padding: 40px;
        border-radius: 10px;
    }

    .recovery_wrap .navbar-brand img {
        width: 70px;
    }

    .recovery_wrap .recovery_left {
        padding: 10vh 0;
        width: 70%;
        margin: 0 auto;
    }

    .recovery_wrap .recovery_left form a {
        display: block;
        margin-bottom: 30px;
    }

    .recovery_wrap .recovery_left form p {
        padding-bottom: 30px;
    }

    .recovery_wrap .recovery_left form a img {
        width: 70px;
        display: block;
        margin: 0 auto;
    }

    .recovery_wrap .recovery_left h2 {
        text-align: center;
    }

    .recovery_wrap .recovery_left p {
        text-align: center;
    }

    .recovery_wrap .recovery_left form .form-control {
        border-radius: 10px;
        border-color: #757575;
        color: #212121;
        height: 50px;
    }

    .recovery_wrap .recovery_left form label {
        color: #757575;
    }

    .recovery_wrap .recovery_left form input::placeholder {
        color: #757575;
    }

    .recovery_wrap .recovery_left form .form-control:focus {
        color: #212121;
        background-color: #fff;
        border-color: #2D2A78;
        outline: 0;
        box-shadow: none;
    }

    .recovery_wrap .recovery_left .form-group {
        flex-direction: column-reverse;
        display: flex;
    }

    .recovery_wrap .recovery_left .form-group input:focus+label,
    .form-group select:focus+label,
    .form-group textarea:focus+label {
        color: #2D2A78;
    }

    .recovery_wrap .recovery_left .button_snd {
        display: inline-block;
        width: 49%;
        text-align: right;
        margin-top: 30px;
    }

    .recovery_wrap .recovery_left .button_cancel {
        display: inline-block;
        width: 49%;
        margin-top: 30px;
    }

    .recovery_wrap .recovery_left .button_cancel button {
        background: transparent;
        border: none;
        color: #2D2A78;
        cursor: pointer;
    }

    .recovery_wrap .recovery_left .button_snd button {
        background: #2D2A78;
        border-color: #2D2A78;
        padding: 10px 30px;
        cursor: pointer;
        border-radius: 10px;
    }

    .recovery_wrap .recovery_left .language_select {
        width: 30%;
        margin-right: auto;
    }

    .recovery_wrap .recovery_left .language_select select {
        border: none;
        background: transparent;
        margin-top: 30px;
        box-shadow: none;
        outline: none;
    }

    .recovery_wrap .recovery_left .language_select select option {
        background: #b2ebf2 !important;
        padding: 15px !important;
    }

    .recovery_wrap .footer_wrap {
        width: 100%;
        background: #212121;
        padding: 20px;
        margin-top: 0px;
    }

    .recovery_wrap .col-md-12 {
        padding: 0;
    }

    .recovery_wrap .right_ftr {
        display: inline-block;
        width: 49%;
    }

    .recovery_wrap .right_ftr p {
        color: #fff;
        text-align: right;
        margin-bottom: 0;
    }

    .recovery_wrap .left_ftr {
        display: inline-block;
        width: 49%;
    }

    .recovery_wrap .left_ftr a {
        color: #fff;
    }

    /*recovery-password-page-end*/






    /*new-password-page-start*/

    .new_password_wrap {
        width: 100%;
        padding: 0;
        margin: 0;
    }

    .new_password_wrap .navbar-brand img {
        width: 70px;
    }

    .new_password_wrap .row {
        padding: 0;
        margin: 0;
    }

    .new_password_wrap .row .col-md-7 {
        padding: 0;
    }

    .new_password_wrap .new_password_left form {
        padding: 40px;
        border-radius: 10px;
    }

    .new_password_wrap .new_password_left {
        padding: 10vh 0;
        width: 70%;
        margin: 0 auto;
    }

    .new_password_wrap .new_password_left form a {
        display: block;
        margin-bottom: 30px;
    }

    .new_password_wrap .new_password_left form p {
        padding-bottom: 30px;
    }

    .new_password_wrap .new_password_left form a img {
        width: 70px;
        display: block;
        margin: 0 auto;
    }

    .new_password_wrap .new_password_left h2 {
        text-align: center;
    }

    .new_password_wrap .new_password_left p {
        text-align: center;
    }

    .new_password_wrap .new_password_left form .form-control {
        border-radius: 10px;
        border-color: #757575;
        color: #212121;
        height: 50px;
    }

    .new_password_wrap .new_password_left form label {
        color: #757575;
    }

    .new_password_wrap .new_password_left form input::placeholder {
        color: #757575;
    }

    .new_password_wrap .new_password_left form .form-control:focus {
        color: #212121;
        background-color: #fff;
        border-color: #2D2A78;
        outline: 0;
        box-shadow: none;
    }

    .new_password_wrap .new_password_left .form-group {
        flex-direction: column-reverse;
        display: flex;
    }

    .new_password_wrap .new_password_left .form-group input:focus+label,
    .form-group select:focus+label,
    .form-group textarea:focus+label {
        color: #2D2A78;
    }

    .new_password_wrap .new_password_left .button_snd {
        display: inline-block;
        width: 49%;
        text-align: right;
        margin-top: 30px;
    }

    .new_password_wrap .new_password_left .button_cancel {
        display: inline-block;
        width: 49%;
        margin-top: 30px;
    }

    .new_password_wrap .new_password_left .button_cancel button {
        background: transparent;
        border: none;
        color: #2D2A78;
        cursor: pointer;
    }

    .new_password_wrap .new_password_left .button_snd button {
        background: #2D2A78;
        border-color: #2D2A78;
        padding: 10px 30px;
        cursor: pointer;
        border-radius: 10px;
    }

    .new_password_wrap .new_password_left .language_select {
        width: 30%;
        margin-right: auto;
    }

    .new_password_wrap .new_password_left .language_select select {
        border: none;
        background: transparent;
        margin-top: 30px;
        box-shadow: none;
        outline: none;
    }

    .new_password_wrap .new_password_left .language_select select option {
        background: #b2ebf2 !important;
        padding: 15px !important;
    }

    .new_password_wrap .footer_wrap {
        width: 100%;
        background: #212121;
        padding: 20px;
        margin-top: 0px;
    }

    .new_password_wrap .col-md-12 {
        padding: 0;
    }

    .new_password_wrap .right_ftr {
        display: inline-block;
        width: 49%;
    }

    .new_password_wrap .right_ftr p {
        color: #fff;
        text-align: right;
        margin-bottom: 0;
    }

    .new_password_wrap .left_ftr {
        display: inline-block;
        width: 49%;
    }

    .new_password_wrap .left_ftr a {
        color: #fff;
    }

    /*new-password-page-end*/


    /*add-password-page-start*/

    .add_password_wrap {
        width: 100%;
        padding: 0;
        margin: 0;
    }

    .add_password_wrap .navbar-brand img {
        width: 70px;
    }

    .add_password_wrap .row {
        padding: 0;
        margin: 0;
    }

    .add_password_wrap .row .col-md-7 {
        padding: 0;
    }

    .add_password_wrap .add_password_left form {
        padding: 40px;
        border-radius: 10px;
    }

    .add_password_wrap .add_password_left {
        padding: 10vh 0;
        width: 70%;
        margin: 0 auto;
    }

    .add_password_wrap .add_password_left form a {
        display: block;
        margin-bottom: 30px;
    }

    .add_password_wrap .add_password_left form p {
        padding-bottom: 30px;
    }

    .add_password_wrap .add_password_left form a img {
        width: 70px;
        display: block;
        margin: 0 auto;
    }

    .add_password_wrap .add_password_left h2 {
        text-align: center;
    }

    .add_password_wrap .add_password_left h2 span {
        color: #2D2A78;
    }

    .add_password_wrap .add_password_left p {
        text-align: center;
    }

    .add_password_wrap .add_password_left form .form-control {
        border-radius: 10px;
        border-color: #757575;
        color: #212121;
        height: 50px;
    }

    .add_password_wrap .add_password_left form label {
        color: #757575;
    }

    .add_password_wrap .add_password_left form input::placeholder {
        color: #757575;
    }

    .add_password_wrap .add_password_left form .form-control:focus {
        color: #212121;
        background-color: #fff;
        border-color: #2D2A78;
        outline: 0;
        box-shadow: none;
    }

    .add_password_wrap .add_password_left .form-group {
        flex-direction: column-reverse;
        display: flex;
    }

    .add_password_wrap .add_password_left .form-group input:focus+label,
    .form-group select:focus+label,
    .form-group textarea:focus+label {
        color: #2D2A78;
    }

    .add_password_wrap .add_password_left .button_snd {
        display: inline-block;
        width: 100%;
        text-align: right;
        margin-top: 30px;
    }

    .add_password_wrap .add_password_left .button_cancel {
        display: inline-block;
        width: 49%;
        margin-top: 30px;
    }

    .add_password_wrap .add_password_left .button_cancel button {
        background: transparent;
        border: none;
        color: #2D2A78;
        cursor: pointer;
    }

    .add_password_wrap .add_password_left .button_snd button {
        background: #2D2A78;
        border-color: #2D2A78;
        padding: 10px 30px;
        cursor: pointer;
        border-radius: 10px;
    }

    .add_password_wrap .add_password_left .language_select {
        width: 30%;
        margin-right: auto;
    }

    .add_password_wrap .add_password_left .language_select select {
        border: none;
        background: transparent;
        margin-top: 30px;
        box-shadow: none;
        outline: none;
    }

    .add_password_wrap .add_password_left .language_select select option {
        background: #b2ebf2 !important;
        padding: 15px !important;
    }

    .add_password_wrap .footer_wrap {
        width: 100%;
        background: #212121;
        padding: 20px;
        margin-top: 0px;
    }

    .add_password_wrap .col-md-12 {
        padding: 0;
    }

    .add_password_wrap .right_ftr {
        display: inline-block;
        width: 49%;
    }

    .add_password_wrap .right_ftr p {
        color: #fff;
        text-align: right;
        margin-bottom: 0;
    }

    .add_password_wrap .left_ftr {
        display: inline-block;
        width: 49%;
    }

    .add_password_wrap .left_ftr a {
        color: #fff;
    }

    /*add-password-page-end*/

    /*company_wrap-start*/
    .company_wrap {
        width: 100%;
        border-bottom: 1px solid #bdbdbd;
    }

    .company_wrap .navbar-brand img {
        width: 70px;
    }

    .company_wrap .dropdown-toggle::after {
        display: inline-block;
        width: 0;
        height: 0;
        margin-left: .255em;
        vertical-align: 0.1em;
        content: "";
        border-top: 0.5em solid;
        border-right: 0.5em solid transparent;
        border-left: 0.5em solid transparent;
        background: transparent;
    }

    .company_wrap .navbar-nav .dropdown-menu {
        padding: 0;
        border: 1px solid #00000024;
    }

    .company_wrap .dropdown-item:hover {
        background-color: #b2ebf2;
    }

    .company_wrap .dropdown-item.active,
    .dropdown-item:active {
        color: #000;
        text-decoration: none;
        background-color: #b2ebf2;
    }

    .company_wrap .row {
        padding: 0;
        margin: 0;
    }

    .main_cmp_data {
        width: 100%;
        padding: 30px 0;
    }

    .main_cmp_data .center_cmp_data {
        width: 70%;
        margin: 0 auto;
        background: #fff;
        -webkit-box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.35);
        -moz-box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.35);
        box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.35);
        border-radius: 10px;
        padding: 40px;
    }

    .main_cmp_data .center_cmp_data h2 {
        text-align: center;
    }

    .main_cmp_data .center_cmp_data form p {
        padding-bottom: 30px;
        text-align: center;
    }

    .main_cmp_data .form-group {
        flex-direction: column-reverse;
        display: inline-flex;
        width: 48%;
        margin: 12px 7px;
    }

    .main_cmp_data form .form-control {
        border-radius: 10px;
        border-color: #757575;
        color: #212121;
        height: 50px;
    }

    .main_cmp_data form label {
        color: #757575;
    }

    .main_cmp_data form input::placeholder {
        color: #757575;
    }

    .main_cmp_data form .form-control:focus {
        color: #212121;
        background-color: #fff;
        border-color: #2D2A78;
        outline: 0;
        box-shadow: none;
    }

    .main_cmp_data .form-group input:focus+label,
    .form-group select:focus+label,
    .form-group textarea:focus+label {
        color: #2D2A78;
    }

    .main_cmp_data .center_cmp_data .button_snd {
        display: inline-block;
        width: 100%;
        text-align: right;
        margin-top: 30px;
    }

    .main_cmp_data .center_cmp_data .button_snd button {
        background: #2D2A78;
        border-color: #2D2A78;
        padding: 10px 30px;
        cursor: pointer;
        border-radius: 10px;
    }

    .footer_wrap_cmp {
        width: 100%;
        background: #212121;
        padding: 20px 10px;
    }

    .footer_wrap_cmp .left_ftr {
        width: 48%;
        display: inline-block;
    }

    .footer_wrap_cmp .left_ftr a {
        color: #fff;
    }

    .footer_wrap_cmp .right_ftr {
        width: 48%;
        display: inline-block;
        text-align: right;
    }

    .footer_wrap_cmp .right_ftr p {
        color: #fff;
        margin-bottom: 0;
    }

    /*company_wrap-end*/

    /*user_wrap-start*/

    .user_wrap {
        width: 100%;
        border-bottom: 1px solid #bdbdbd;
    }

    .user_wrap .navbar-brand img {
        width: 70px;
    }

    .user_wrap .dropdown-toggle::after {
        display: inline-block;
        width: 0;
        height: 0;
        margin-left: .255em;
        vertical-align: 0.1em;
        content: "";
        border-top: 0.5em solid;
        border-right: 0.5em solid transparent;
        border-left: 0.5em solid transparent;
        background: transparent;
    }

    .user_wrap .navbar-nav .dropdown-menu {
        padding: 0;
        border: 1px solid #00000024;
    }

    .user_wrap .dropdown-item:hover {
        background-color: #b2ebf2;
    }

    .user_wrap .dropdown-item.active,
    .dropdown-item:active {
        color: #000;
        text-decoration: none;
        background-color: #b2ebf2;
    }

    .user_wrap .row {
        padding: 0;
        margin: 0;
    }

    .profile_img {
        text-align: center;
        padding-top: 30px;
    }

    .profile_img a {
        display: block;
        padding-top: 30px;
        font-size: 20px;
        color: #2D2A78;
        font-weight: bold;
    }

    .user_profile_data {
        background: #ffffff;
        width: 70%;
        margin: 50px auto;
        padding: 30px;
        border-radius: 10px; /* Bordes redondeados */
        box-shadow: 0px 0px 10px 2px rgba(0, 0, 0, 0.1); /* Sombra suave y elegante */
    }

    .user_profile_data .row {
        margin: 0;
        padding: 0;
    }

    .user_profile_data h2 {
        text-align: center;
    }

    .user_profile_data p {
        text-align: center;
    }

    .user_profile_data .row {
        margin-top: 50px;
    }

    .user_profile_data .form-group {
        flex-direction: column-reverse;
        display: inline-flex;
        width: 100%;
        margin: 12px 7px;
    }

    .user_profile_data form .form-control {
        border-radius: 10px;
        border-color: #757575;
        color: #212121;
        height: 50px;
    }

    .user_profile_data form label {
        color: #757575;
    }

    .user_profile_data form input::placeholder {
        color: #757575;
    }

    .user_profile_data form .form-control:focus {
        color: #212121;
        background-color: #fff;
        border-color: <?= $primary_color ?>;
        outline: 0;
        box-shadow: none;
    }

    .user_profile_data .form-group input:focus+label,
    .form-group select:focus+label,
    .form-group textarea:focus+label {
        color: #2D2A78;
    }

    .user_profile_data .button_snd button {
        background: <?= $secondary_color ?>;
        border-color: <?= $secondary_color ?>;
        padding: 10px 30px;
        cursor: pointer;
        border-radius: 10px;
    }

    .user_profile_data .button_snd a {
        background: <?= $secondary_color ?>;
        border-color: <?= $secondary_color ?>;
        padding: 10px 30px;
        cursor: pointer;
        border-radius: 10px;
    }

    .user_profile_data .button_snd {
        text-align: right;
        margin-top: 30px;
    }

    /*user_wrap-end*/


    /*branding_wrap_start*/

    .header_wrap {
        width: 100%;
        border-bottom: 1px solid #bdbdbd;
    }

    .header_wrap .navbar-brand img {
        width: 70px;
    }

    .header_wrap .dropdown-toggle::after {
        display: inline-block;
        width: 0;
        height: 0;
        margin-left: .255em;
        vertical-align: 0.1em;
        content: "";
        border-top: 0.5em solid;
        border-right: 0.5em solid transparent;
        border-left: 0.5em solid transparent;
        background: transparent;
    }

    .header_wrap .navbar-nav .dropdown-menu {
        padding: 0;
        border: 1px solid #00000024;
    }

    .header_wrap .dropdown-item:hover {
        background-color: #b2ebf2;
    }

    .header_wrap .dropdown-item.active,
    .dropdown-item:active {
        color: #000;
        text-decoration: none;
        background-color: #b2ebf2;
    }

    .header_wrap .row {
        padding: 0;
        margin: 0;
    }

    .branding_wrap {
        width: 100%;
    }

    .branding_wrap h2 {
        text-align: center;
    }

    .branding_wrap p {
        text-align: center;
    }

    /*branding_wrap_end*/

    .btPageHeadline.btLightSkin:after {
        content: "";
        background: rgba(253, 253, 253, 0.65);
        left: 0;
        top: 0;
        position: absolute;
        width: 100%;
        height: 100%;
    }

    .new_password_wrap {
        width: 100%;
        padding: 0;
        margin: 0;
        height: 100vh;
    }

    .new_password_wrap .row {
        padding: 0;
        margin: 0;
        height: 100%;
    }

    .login_right {
        width: 100%;
        background: url(http://chessmafia.com/php/SEAT/images/client/images/login_right_bg.png);
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: 100%;
        padding-top: 40vh;
        padding-left: 10vh;
    }

    .new_header_wrap {
        padding: 20px 0;
        background: <?= $primary_color; ?>;
    }

    .lang_head_new a {
        color: #fff;
        padding: 0 10px;
    }

    .new_header_wrap a {
        color: #fff;
        font-size: 18px;
    }

    .new_header_wrap a:hover {
        color: #fff;
    }

    .lang_head_new {
        text-align: right;
    }

    /*responsive start*/
    @media screen and (max-width:767px) {
        .login_wrap {
            height: 100%;
        }

        .lgn_in_sgn {
            position: relative;
            padding-top: 50px;
        }

        .login_wrap .login_left form {
            padding-top: 5vh;
        }

        .login_right {
            padding: 20px;
        }

        .login_right h2 {
            font-size: 30px;
        }

        .login_right p {
            font-size: 18px;
        }

        .recovery_wrap {
            height: 100%;
        }

        .recovery_wrap .recovery_left {
            padding-top: 20px;
            width: 100%;
        }

        .recovery_wrap .recovery_left form {
            width: 90%;
            margin: 0 auto;
        }

        .recovery_wrap .recovery_left h2 {
            font-size: 23px;
        }

        .new_password_wrap {
            height: 100%;
        }

        .new_password_wrap .new_password_left {
            padding-top: 20px;
            width: 100%;
        }

        .new_password_wrap .new_password_left form {
            width: 90%;
            margin: 0 auto;
        }

        .new_password_wrap .new_password_left h2 {
            font-size: 24px;
            font-family: "IBMPlexSans-Medium";
        }

        .add_password_wrap {
            height: 100%;
        }

        .add_password_wrap .add_password_left {
            padding-top: 20px;
            width: 100%;
        }

        .add_password_wrap .add_password_left form {
            width: 90%;
            margin: 0 auto;
        }

        .add_password_wrap .add_password_left h2 {
            font-size: 23px;
        }

        .user_profile_data {
            width: 90%;
        }

        .profile_img img {
            width: 150px;
            height: 150px;
        }

        .main_cmp_data .center_cmp_data {
            width: 90%;
            padding: 20px;
        }

        .main_cmp_data .form-group {
            width: 100%;
        }
    }


    @media screen and (min-width: 768px) and (max-width: 1024px) {
        .login_wrap {
            height: 100vh;
        }

        .lgn_in_sgn {
            position: relative;
            padding-top: 50px;
        }

        .login_wrap .login_left form {
            padding-top: 5vh;
            width: 90%;
        }

        .login_right {
            padding-top: 30vh;
            padding-left: 5vh;
        }

        .login_right h2 {
            font-size: 30px;
        }

        .login_right p {
            font-size: 18px;
        }

        .recovery_wrap {
            height: 100%;
        }

        .recovery_wrap .recovery_left {
            padding-top: 20px;
            width: 100%;
        }

        .recovery_wrap .recovery_left form {
            width: 90%;
            margin: 0 auto;
        }

        .recovery_wrap .recovery_left h2 {
            font-size: 23px;
        }

        .new_password_wrap {
            height: 100%;
        }

        .new_password_wrap .new_password_left {
            padding-top: 20px;
            width: 100%;
        }

        .new_password_wrap .new_password_left form {
            width: 90%;
            margin: 0 auto;
        }



        .add_password_wrap {
            height: 100%;
        }

        .add_password_wrap .add_password_left {
            padding-top: 20px;
            width: 100%;
        }

        .add_password_wrap .add_password_left form {
            width: 90%;
            margin: 0 auto;
        }

        .add_password_wrap .add_password_left h2 {
            font-size: 23px;
        }

        .user_profile_data {
            width: 90%;
        }

        .profile_img img {
            width: 150px;
            height: 150px;
        }

        .main_cmp_data .center_cmp_data {
            width: 90%;
            padding: 20px;
        }

        .main_cmp_data .form-group {
            width: 100%;
        }
    }

    .main_cmp_data .center_cmp_data .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 50px;
    }

    .main_cmp_data .center_cmp_data .select2-container .select2-selection--single {
        height: 50px;
    }

    .main_cmp_data .center_cmp_data .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 50px;
    }

    .main_cmp_data .center_cmp_data .select2-container .select2-selection--multiple {
        min-height: 50px;
    }
</style>
