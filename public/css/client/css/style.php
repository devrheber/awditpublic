<?php
//Set the content-type header and charset.
header('Content-Type: text/css; charset=utf-8');
session_start();
if (isset($_SESSION['primary_color']) && isset($_SESSION['secondary_color'])) {
    $primary_color = $_SESSION['primary_color'];
    $secondary_color = $_SESSION['secondary_color'];
} else {
    $primary_color = '#2D2A78';
    $secondary_color = '#2D2A78';
}
function colorBrightness($color)
{
    $r = hexdec(substr($color, 1, 2));
    $g = hexdec(substr($color, 3, 2));
    $b = hexdec(substr($color, 5, 2));
    $brightness = ($r * 299 + $g * 587 + $b * 114) / 1000;
    return $brightness;
}
$text_color = colorBrightness($primary_color) > 128 ? 'rgba(27, 46, 75, 0.9)' : '#FFFFFF';
$dark_text_color = 'rgba(27, 46, 75, 0.9)';
?>
<style>
    *:before,
    *:after {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }

    body {
        background: #F4F8FE;
        padding: 0;
        margin: 0;
    }

    i.fa {
        font-size: 16px;
    }

    p {
        font-size: 16px;
        line-height: 1.42857143;
    }

    select {

        display: inline-block;
        width: 100%;
        height: calc(1.6em + 0.75rem + 2px);
        padding: 0.375rem 1.75rem 0.375rem 0.75rem;
        font-size: 0.9rem;
        font-weight: 400;
        line-height: 1.6;
        color: #495057;
        vertical-align: middle;
        background: #fff url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='4' height='5' viewBox='0 0 4 5'%3e%3cpath fill='%23343a40' d='M2 0L0 2h4zm0 5L0 3h4z'/%3e%3c/svg%3e") no-repeat right 0.75rem center/8px 10px;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
    }

    /* Agrega un margen derecho a la imagen SVG */
    select::-webkit-calendar-picker-indicator {
        margin-right: 1rem;
    }

    input[type='date']::-webkit-calendar-picker-indicator {
        background: #fff url("data:image/svg+xml,<svg xmlns=' http: //www.w3.org/2000/svg' viewBox='0 0 4 5'><path d='M2 0L0 2h4zm0 5L0 3h4z'/></svg>") no-repeat center center;
        width: 1em;
        height: 1em;
        padding: 0;
        border: none;
        margin-right: 2px;
    }

    .modal-title {
        font-family: 'IBM Plex Sans';
        font-style: normal;
        font-weight: 600;
        font-size: 20px;
        line-height: 26px;
    }

    .form-group label {
        text-transform: uppercase;
        font-family: 'IBM Plex Sans';
        font-style: normal;
        font-weight: 500;
        font-size: 11px;
        line-height: 14px;
        letter-spacing: 0.55px;

        color: rgba(27, 46, 75, 0.5);

    }

    .form-group .form-control {
        /* background: #FFFFFF; */
        border: 1px solid #C0CCDA;

        font-family: 'IBM Plex Sans';
        font-style: normal;
        font-weight: 400;
        font-size: 14px;
        line-height: 18px;
        letter-spacing: -0.07px;
    }

    .form-group .form-control::placeholder {


        color: #CBD6E1;
    }

    .change-pass-li:hover {
        cursor: pointer;

    }

    /* Use this if you use icon embedded in placeholder (examples 1 & 2) */
    .form-control-placeholdericon {
        font-family: Roboto, FontAwesome, 'Material Icons';
    }

    /* Use this if you use icon added with pure CSS (example 3) */
    [class*='form-group-icon-'] {
        position: relative;
    }

    [class*='form-group-icon-']>input {
        padding-left: 32px;
    }

    [class*='form-group-icon-']:before {
        font-family: 'Material Icons';
        position: absolute;
        color: rgba(0, 0, 0, .54);
        left: 0;
        bottom: 0;
        font-size: 24px;
    }

    .form-group-icon-search:before {
        content: '\e8b6';
    }

    /* Use this if you use icon added with HTML tag (example 4) */
    .form-group-icon {
        position: relative;
    }

    .form-group-icon>input {
        padding-left: 32px;
    }

    .form-group-icon>i {
        position: absolute;
        color: rgba(0, 0, 0, .54);
        left: 0;
        bottom: calc(0.375rem - 1px);
    }

    /* Use this if you append icon added with HTML tag (example 5) */
    .form-icon-append {
        position: relative;
    }

    .form-icon-append>input {
        padding-right: 32px;
    }

    .form-icon-append>i {
        position: absolute;
        color: rgba(0, 0, 0, .54);
        right: 0;
        bottom: calc(0.375rem - 1px);
    }

    .form-icon-append>i:hover {
        cursor: pointer;
    }

    .table td,
    .table th {
        padding: 0.75rem;
        vertical-align: middle;
        border-top: 0px solid #dee2e6;
    }

    .table th {
        border-bottom: 2px solid #dee2e6;
    }

    .bg-success {
        background-color: #61CE00 !important;
    }

    .bg-danger {
        background-color: #E24042 !important;
    }

    .text-success {
        color: #61CE00 !important;
    }

    .text-danger {
        color: #E24042 !important
    }

    .table thead {
        text-transform: uppercase !important;
        font-size: .7rem;
        color: <?= $dark_text_color ?>;
        opacity: .9;
    }

    .table th:first-child,
    .table td:first-child {
        padding-left: 1.3rem;
    }

    .dataTables_filter {
        display: none;
    }

    .dataTables_info {
        padding-left: 20px;
    }

    .dataTables_paginate {
        padding-right: 20px;
    }

    .dataTables_info,
    .dataTables_paginate {
        font-weight: 700;
        color: <?= $dark_text_color ?>;
    }

    .paginate_button.current {
        display: none !important;
    }

    .paginate_button {}

    /* Estilo para el encabezado h1 */
    .logo-awdit {
        color: <?= $primary_color ?>;
        font-weight: 700;
        margin-bottom: 0;
    }

    .logo-awdit-2 {
        color: <?= $primary_color ?>;
    }

    .header {
        position: fixed;
        z-index: 10;
        top: 0;
        left: 0;

        background: #FBFBFC;
        width: 100%;
        height: 55px;
        line-height: 50px;
        color: #fff;
    }

    .header .logo {
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .header .navbar-expand-lg .navbar-nav .dropdown-menu {
        width: 300px;
        padding: 10px;
    }

    .rht_drp_head {
        width: 45%;
        display: inline-block;
        margin-left: 5px;
        vertical-align: middle;
    }

    .left_drp_head {
        width: 50%;
        display: inline-block;
        vertical-align: middle;
    }

    .left_drp_head h4 {
        font-size: 15px;
    }

    .demo-questionnaire-btn {
        background: <?= $primary_color ?>;
        border-color: <?= $primary_color ?>;
        color: <?= $text_color ?>;
    }

    .questionary_drp_cont a.btn.btn-primary {
        width: 100%;
        margin: 0;
        background: <?= $secondary_color ?>;
        border-color: <?= $secondary_color ?>;
    }

    .questionary_drp_cont .btn-primary {
        color: #fff;
        background-color: <?= $secondary_color ?>;
        border-color: <?= $secondary_color ?>;
    }

    .header {
        border-bottom: 1px solid #E5EEFC;
    }

    .header #menu-action {
        display: block;
        align-items: center;
        float: left;
        width: 60px;
        height: 55px;
        line-height: 50px;
        margin-right: 15px;

        text-decoration: none;
        text-align: center;
        color: #C3CDDA;
        background: #FBFBFC;
        border: 1px solid #E5EEFC;
        /* background: rgba(0, 0, 0, 0.15); */
        /* font-size: 13px; */
        /* text-transform: uppercase; */
        letter-spacing: 1px;
        -webkit-transition: all 0.2s ease-in-out;
        transition: all 0.2s ease-in-out;
    }

    .header #menu-action i {
        display: inline-block;
        margin: 0 5px;
    }

    .header #menu-action span {
        width: 0px;
        display: none;
        overflow: hidden;
        -webkit-transition: all 0.2s ease-in-out;
        transition: all 0.2s ease-in-out;
    }

    .header #menu-action:hover {
        background: rgba(0, 0, 0, 0.05);
    }

    .header #menu-action.active {
        width: 250px;
        -webkit-transition: all 0.2s ease-in-out;
        transition: all 0.2s ease-in-out;
    }

    .header #menu-action.active span {
        display: inline;
        width: auto;
        -webkit-transition: all 0.2s ease-in-out;
        transition: all 0.2s ease-in-out;
    }

    .sidebar {
        position: fixed;
        z-index: 10;
        left: 0;
        top: 55px;
        height: 100%;
        width: 60px;
        background: #FBFBFC;
        border: 1px solid #E5EEFC;
        /* text-align: center; */
        -webkit-transition: all 0.2s ease-in-out;
        transition: all 0.2s ease-in-out;
        padding-top: 1rem;
    }

    .sidebar-subtitle {
        margin-left: 1.3rem;
        font-size: 10px;
        margin-top: 1.5rem;
    }

    .sidebar-selected,
    .sidebar-selected i,
    .sidebar-selected span {
        color: <?= $primary_color ?>;
    }

    .sidebar-selected svg path,
    .sidebar-selected svg circle {

        stroke: <?= $primary_color ?>;
    }



    .profile-btn {
        transition: all 0.2s ease-in-out;
    }

    .profile_button_text {
        margin-left: 0.7rem;
    }

    /* .sidebar:hover, */
    /* .sidebar.hovered, */
    .sidebar.active {
        width: 250px;
        -webkit-transition: all 0.2s ease-in-out;
        transition: all 0.2s ease-in-out;
    }

    .sidebar ul {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    .sidebar ul li {
        display: block;
    }

    .sidebar ul li a {
        display: block;
        position: relative;
        white-space: nowrap;
        overflow: hidden;
        /* border-bottom: 1px solid #ddd; */
        color: #444;
        text-align: left;
    }

    .sidebar ul li a i,
    .sidebar ul li a svg {
        display: inline-block;

        line-height: 30px;
        text-align: center;
        margin-left: 22px;
        margin-right: 17px;
        -webkit-animation-duration: 0.7s;
        -moz-animation-duration: 0.7s;
        -o-animation-duration: 0.7s;
        animation-duration: 0.7s;
        -webkit-animation-fill-mode: both;
        -moz-animation-fill-mode: both;
        -o-animation-fill-mode: both;
        animation-fill-mode: both;
    }



    .sidebar ul li a span {
        display: inline-block;
        height: 30px;
        line-height: 30px;
    }

    /* .sidebar ul li a:hover {
        background-color: <?= $secondary_color ?>;
        color: #fff;
    } */
    .profile-btn {
        background-color: white;
    }

    .main {
        position: relative;
        display: block;
        top: 40px;
        left: 0;
        padding: 15px;
        /* padding-left: 75px; */
        -webkit-transition: all 0.2s ease-in-out;
        transition: all 0.2s ease-in-out;
        margin-bottom: 80px;
    }

    .main.active {
        padding-left: 200px;
        -webkit-transition: all 0.2s ease-in-out;
        transition: all 0.2s ease-in-out;
    }

    .main .jumbotron {
        background-color: #fff;
        padding: 30px !important;
        border: 1px solid #dfe8f1;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
    }

    .main .jumbotron h1 {
        font-size: 24px;
        margin: 0;
        padding: 0;
        margin-bottom: 12px;
    }

    .sidebar ul li a.nav-link {
        padding: 0;
    }

    .sidebar ul li.nav-item.has-sub ul {
        padding: 10px;
    }

    .sidebar ul li.nav-item.has-sub ul li a {
        padding: 10px;
        border: none;
    }

    @-webkit-keyframes swing {
        20% {
            -webkit-transform: rotate3d(0, 0, 1, 15deg);
            transform: rotate3d(0, 0, 1, 15deg);
        }

        40% {
            -webkit-transform: rotate3d(0, 0, 1, -10deg);
            transform: rotate3d(0, 0, 1, -10deg);
        }

        60% {
            -webkit-transform: rotate3d(0, 0, 1, 5deg);
            transform: rotate3d(0, 0, 1, 5deg);
        }

        80% {
            -webkit-transform: rotate3d(0, 0, 1, -5deg);
            transform: rotate3d(0, 0, 1, -5deg);
        }

        100% {
            -webkit-transform: rotate3d(0, 0, 1, 0deg);
            transform: rotate3d(0, 0, 1, 0deg);
        }
    }

    @keyframes swing {
        20% {
            -webkit-transform: rotate3d(0, 0, 1, 15deg);
            -ms-transform: rotate3d(0, 0, 1, 15deg);
            transform: rotate3d(0, 0, 1, 15deg);
        }

        40% {
            -webkit-transform: rotate3d(0, 0, 1, -10deg);
            -ms-transform: rotate3d(0, 0, 1, -10deg);
            transform: rotate3d(0, 0, 1, -10deg);
        }

        60% {
            -webkit-transform: rotate3d(0, 0, 1, 5deg);
            -ms-transform: rotate3d(0, 0, 1, 5deg);
            transform: rotate3d(0, 0, 1, 5deg);
        }

        80% {
            -webkit-transform: rotate3d(0, 0, 1, -5deg);
            -ms-transform: rotate3d(0, 0, 1, -5deg);
            transform: rotate3d(0, 0, 1, -5deg);
        }

        100% {
            -webkit-transform: rotate3d(0, 0, 1, 0deg);
            -ms-transform: rotate3d(0, 0, 1, 0deg);
            transform: rotate3d(0, 0, 1, 0deg);
        }
    }

    .swing {
        -webkit-transform-origin: top center;
        -ms-transform-origin: top center;
        transform-origin: top center;
        -webkit-animation-name: swing;
        animation-name: swing;
    }

    .bs-callout {
        padding: 20px;
        margin: 20px 0;
        border: 1px solid #eee;
        border-left-width: 5px;
        border-radius: 3px;
        background: white;
    }

    table {
        background: white;
    }

    .bs-callout h4 {
        margin-top: 0;
        margin-bottom: 5px;
    }

    .bs-callout p:last-child {
        margin-bottom: 0;
    }

    .bs-callout code {
        border-radius: 3px;
    }

    .bs-callout+.bs-callout {
        margin-top: -5px;
    }

    .bs-callout-default {
        border-left-color: #777;
    }

    .bs-callout-default h4 {
        color: #777;
    }

    .bs-callout-primary {
        border-left-color: #428bca;
    }

    .bs-callout-primary h4 {
        color: #428bca;
    }

    .bs-callout-success {
        border-left-color: #5cb85c;
    }

    .bs-callout-success h4 {
        color: #5cb85c;
    }

    .bs-callout-danger {
        border-left-color: #d9534f;
    }

    .bs-callout-danger h4 {
        color: #d9534f;
    }

    .bs-callout-warning {
        border-left-color: #f0ad4e;
    }

    .bs-callout-warning h4 {
        color: #f0ad4e;
    }

    .bs-callout-info {
        border-left-color: #5bc0de;
    }

    .bs-callout-info h4 {
        color: #5bc0de;
    }

    .header .navbar-brand {
        line-height: normal;
        color: #fff;
    }

    .header .navbar-nav .nav-link {
        line-height: normal;
        color: #fff;
    }

    .header .navbar-expand-lg .navbar-nav .dropdown-menu {
        right: 0;
        left: auto;
    }

    .profile_drp_img img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-top: .2rem;
    }

    .profile-drp-img-active {
        margin-left: 1.5rem;
    }

    .profile-drp-img-deactive {
        margin-left: 0.75rem;
    }

    .header .navbar-toggler {
        background-color: #fff;
    }

    .side-bar-profile {
        margin-bottom: 2.5rem;
    }

    .global_wrapper {
        padding-top: 10px;
    }

    .agenda_item_wrap {
        padding-top: 0;
        padding-left: 45px;
    }

    .global_box {
        background: #FFFFFF;
        border: 1px solid #E5EEFC;
        border-radius: 4px;
        padding: 10px;
        margin-bottom: 10px;
        /* box-shadow: 0px 0px 5px 0px rgb(223 223 223); */
    }

    .global_box h4 {
        color: #000;
        text-align: center;
    }

    .global_box p {
        color: #000;
        text-align: center;
    }

    .global_box .row:nth-child(1) .col-6:nth-child(1) {
        font-size: 1.5rem;
        font-weight: bolder;
        color: <?= $dark_text_color ?>;
        margin-bottom: 1rem;
    }

    .global_box .row:nth-child(1) .col-6:nth-child(2) {
        font-weight: 600;
        color: #61CD00;
    }

    .global_box .summary-card-title {
        font-family: 'IBM Plex Sans';
        font-style: normal;
        font-weight: 600;
        font-size: 12px;
        line-height: 16px;
        color: <?= $dark_text_color ?>;
        text-transform: uppercase;
    }

    .global_box .summary-card-icon {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 2rem;
        height: 2rem;
        margin-top: 1rem;
        margin-right: 1rem;
        background-color: green;
        border-radius: 4px;
        color: white;
    }

    .main_global_wrap a {
        text-decoration: none;
        display: inline-block;
        width: 100%;
    }

    .event_rht_global {
        background: #fff;
        padding: 10px;
        margin-bottom: 10px;
        box-shadow: 0px 0px 5px 0px rgb(223 223 223);
    }

    h2.global_title {
        font-size: 25px;
        text-transform: capitalize;
        margin-bottom: 10px;
        background: <?= $primary_color ?>;
        padding: 10px;
        color: #fff;
    }

    .btn-summary {
        background: #FFFFFF;
        border: 0.6px solid #8392A5;
        border-radius: 4px;
        margin-right: .2rem;
    }

    .btn-generate-report {
        background: <?= $primary_color ?> !important;
        color: <?= $text_color ?> !important;
        border-radius: 4px;
        border: none;
        /* border: 2px solid <?= $primary_color ?>; */
    }

    .file-brand-input {

        color: transparent !important;



    }

    .file-brand-input::-webkit-file-upload-button {
        visibility: hidden;
    }

    .file-brand-input::before {
        content: 'Select a file';
        background: <?= $primary_color ?> !important;
        color: <?= $text_color ?> !important;
        display: inline-block;
        color: #FFFFFF !important;
        border-radius: 4px;
        white-space: nowrap;
        padding: 10px 54px;
        margin-left: auto;

        border: none;
        outline: none;
        white-space: nowrap;

        cursor: pointer;
        font-family: 'IBM Plex Sans';
        font-style: normal;
        font-weight: 400;
        font-size: 14px;
        line-height: 18px;
        letter-spacing: -0.07px;
        margin-left: 10%;
        border-radius: 8px;


    }

    .file-brand-input::after {
        display: none;
    }

    .file-brand-input:hover::before {
        border-color: black;
    }

    .file-brand-input:active::before {
        background: -webkit-linear-gradient(top, #e3e3e3, #f9f9f9);
    }

    .btn-modal-update {
        background: <?= $primary_color ?> !important;
        color: <?= $text_color ?> !important;
        border: 2px solid <?= $primary_color ?>;
    }

    .btn-modal-delete {
        background: #E24042 !important;
        color: <?= $text_color ?> !important;
    }

    .event_rht_global h3 {
        font-size: 22px;
        text-transform: capitalize;
        margin-bottom: 10px;
        background: <?= $primary_color ?>;
        /* padding: 10px; */
        color: #fff;
    }

    .global_rht_frm select {
        height: 50px;
    }

    .global_rht_frm select:focus {
        outline: none;
        box-shadow: none;
        border-color: <?= $primary_color ?>;
    }

    .supplier_wrapper {
        padding-top: 50px;
    }

    .supplier_wrapper .row {
        font-size: 1rem;
        font-weight: bold;
        text-transform: capitalize;
        margin-bottom: 0;
        background: white;
        padding: 25px;
        box-shadow: 0px 0px 5px 0px rgb(223 223 223);
        padding: 10px;
        color: <?= $dark_text_color ?>;
    }

    .legend-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-direction: row;

        padding: 10px;
        color: <?= $dark_text_color ?>;
        background: #FFFFFF;
        border: 1px solid #E5EEFC;
        border-radius: 4px;
    }

    .events-container {
        flex-direction: column;
        align-items: flex-start;
    }

    .events-card {
        min-height: 22vh;
        max-height: 22vh;
        overflow: auto;
        overflow-x: hidden;
    }

    .events-list {
        width: 100%;
        padding: 10px;
        background-color: white;
        margin-top: .05rem;
        background: #FFFFFF;
        border: 1px solid #E5EEFC;
        border-radius: 4px;
    }

    .events-list p {
        margin-bottom: .6rem;
    }

    .view-profile-two-cards {
        padding-left: 2em;
        padding-right: 5em;
        min-height: 247px;
    }

    .view-profile-edit-card {
        background-color: white;
        border: 1px solid rgb(223 223 223);
        border-radius: 4px;
        padding-top: .5rem;
        padding-bottom: .5rem;
        display: flex;
        flex-direction: column;
    }

    .view-profile-edit-card-title,
    .view-profile-edit-card-content {
        padding-right: 20px;
        padding-left: 20px;
    }

    .view-profile-edit-card-title {
        border-bottom: 1px solid rgb(223 223 223);
        padding-bottom: 0.5rem;
        margin-bottom: .5rem;
    }

    .view-profile-edit-card-title-text {
        font-size: 20px;
        font-weight: bold;
        text-transform: capitalize;
        color: <?= $dark_text_color ?>;
    }

    .view-profile-edit-card-title-icon i {
        font-size: 1.5em;
        color: <?= $primary_color ?>;
        cursor: pointer
    }

    .view-profile-edit-logo {
        /* position: absolute; */
        bottom: 0;
        left: 2rem;
        font-size: 3rem !important;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: <?= $primary_color ?> !important;
        color: <?= $text_color ?> !important;
        border: none !important;
        display: inline-flex !important;
        border-radius: 0.7rem !important;
        padding: .2rem !important;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        color: <?= $text_color ?> !important;
        border-right: none !important;
    }

    .sector_multiple_dropdown {
        display: flex;
        flex-direction: column;
    }

    .select2 .select2-container .select2-container--default {
        width: 100% !important;
    }

    .select2-container--multiple .select2-selection__rendered {
        flex-direction: row !important;
    }

    .select2-selection__choice__remove {
        order: 3 !important;
    }

    .btn-change-password {
        white-space: normal !important;
        align-items: center;
        color: #808997 !important;
        background: transparent;
        border: 2px solid rgb(223 223 223);
        font-weight: 700;
        box-sizing: border-box;
    }

    .btn-change-password i {
        font-size: 1.4rem;
        margin-right: 0.5rem;
    }

    .btn-download {
        border: 2px solid #007BFF !important;
    }

    .events-header p {
        text-transform: uppercase;
        color: #b6b6b6;
        font-size: 11px;
    }

    .events-content p {
        color: <?= $dark_text_color ?>;
        font-weight: 600;
        margin-bottom: 0rem !important;
        font-size: .8rem;
    }

    .events-content {
        margin-bottom: .5rem;
    }

    .events-content .btn-circle {
        width: 25px;
        height: 25px;
        border-radius: 50%;
        background-color: <?= $primary_color ?>;
        color: <?= $text_color ?>;
        font-size: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
    }

    .events-content .btn-circle i {
        line-height: 1;
        margin-left: 1px;
    }

    .legend-container .title {
        font-size: 20px;
        font-weight: bold;
        margin-right: 20px;
        text-transform: capitalize;
    }

    .legend-container .legends {
        display: flex;
        flex-direction: row;
    }

    .legend {
        display: flex;
        flex-direction: row;
        align-items: center;
        margin-right: 10px;
        text-transform: uppercase;
        font-weight: bold;
    }

    .legend-container .circle {}

    .legend-container .green {
        background-color: #3BD1AC;
    }

    .legend-container .blue {
        background-color: #5CA7F6;
    }

    .legend-container .text {
        font-size: .7rem;
    }

    .inner_summary_graph {
        padding: 25px;
        background: #FFFFFF;
        border: 1px solid #E5EEFC;
        border-radius: 4px;
    }

    .inner_summary_graph .chart-container {
        position: relative;
        margin: auto;
        height: 38vh;
        width: 100%;
    }

    .row.summary_graph_right {
        margin-top: 20px;
    }

    .summary_graph_right {
        margin: 0;
        padding: 15px;
        background: #fff;
        box-shadow: 0px 0px 5px 0px rgb(223 223 223);
    }

    .summary_graph_right h3 {
        width: 100%;
        font-size: 18px;
        text-transform: uppercase;
        color: <?= $primary_color ?>;
    }

    .summary_graph_right h5 {
        text-transform: capitalize;
    }

    .summary_graph_right .col-md-4 {
        padding: 15px;
    }

    .questionary_data_wrap {
        padding-bottom: 20px;
    }

    .questionary_data_wrap .inner_questionary_data {
        padding: 25px;
        box-shadow: 0px 0px 5px 0px rgb(223 223 223);
        background: #fff;
    }

    .questionary_data_wrap #chartdiv {
        width: 100%;
        height: 500px;
    }

    .questionary_data_wrap h2 {
        font-size: 25px;
        text-transform: capitalize;
        margin-bottom: 10px;
        background: <?= $primary_color ?>;
        padding: 10px;
        color: #fff;
    }

    .footer_wrapper {
        padding: 5px;
        background: #fff;
        height: 40px;
        bottom: 0;
        position: fixed;
        width: 100%;
        border-top: 1px solid #d9d9d9;
        padding-left: 60px;
        color: #B6B6B6;
        text-transform: uppercase;
        margin-left: 0rem !important;
        font-family: 'IBM Plex Sans';
        font-style: normal;
        font-weight: 400;
        font-size: 10px;
        line-height: 13px;

        letter-spacing: -0.251px;
        color: #969696;

    }

    /* .footer_wrapper p {
        color: #fff;
        text-align: center;
        margin-bottom: 0;
    } */
    .main.active .footer_wrapper {
        padding-left: 270px;
    }

    .dash_box_set {
        padding: 20px;
        background: #fff;
        margin: 10px 0;
        box-shadow: 0px 0px 5px 0px rgb(223 223 223);
    }

    .dash_box_set .left_dash_box {
        width: 48%;
        display: inline-block;
        vertical-align: middle;
    }

    .dash_box_set .right_dash_box {
        width: 45%;
        display: inline-block;
        vertical-align: middle;
        margin-left: 5px;
    }

    .dash_box_set .left_dash_box i {
        background: <?= $primary_color ?>;
        width: 35px;
        height: 35px;
        line-height: 35px;
        text-align: center;
        color: #fff;
        border-radius: 50%;
    }

    .title-section {
        font-family: 'IBM Plex Sans';
        font-style: normal;
        font-weight: 600;
        font-size: 10px;
        line-height: 13px;
        /* identical to box height, or 130% */

        letter-spacing: 1px;

        color: <?= $dark_text_color ?>;
        text-transform: uppercase;
    }

    .title-section span:last-of-type {
        color: <?= $primary_color ?>;
    }

    .subtitle-section {
        font-family: 'IBM Plex Sans';
        font-style: normal;
        font-weight: 600;
        font-size: 26px;
        line-height: 34px;
        color: <?= $dark_text_color ?>;
    }

    .summary_card_min_max {
        font-family: 'IBM Plex Sans';
        font-style: normal;
        font-weight: 600;
        font-size: 25px;
        line-height: 32px;
    }

    .summary_card_percentage {
        font-family: 'IBM Plex Sans';
        font-style: normal;
        font-weight: 500;
        font-size: 14px;
        line-height: 18px;
        text-align: right;

        color: #6DD400;


    }

    .client_dashboard_set {
        margin-top: 20px;
    }

    .client_dashboard_set a {
        display: inline-block;
        width: 100%;
        text-decoration: none;
    }

    .client_dashboard_set p {
        color: #000;
        margin-bottom: 0;
    }

    .right_dash_box span {
        text-align: right;
        font-size: 22px;
        color: <?= $primary_color ?>;
        width: 100%;
        display: inline-block;
    }

    .right_dash_box p {
        text-align: right;
        padding-bottom: 10px;
    }

    .left_dash_box p {
        padding-top: 10px;
    }

    .dash_main_title {
        background: <?= $primary_color ?>;
        color: #fff;
    }

    .header .navbar-expand-lg .navbar-nav .dropdown-menu a.dropdown-item {
        line-height: normal;
        padding: .30rem 1.5rem;
    }

    .header .navbar-expand-lg .navbar-nav .dropdown-menu small {
        padding: 0 1.5rem;
        color: <?= $primary_color ?>;
        width: 100%;
        display: inline-block;
        line-height: normal;
    }

    .lang_head_new {
        text-align: right;
    }

    .lang_head_new a {
        color: #fff;
        padding: 0 10px;
    }

    .new_header_wrap a {
        color: #fff;
        font-size: 18px;
    }

    .new_header_wrap {
        padding: 20px 0;
        background: <?= $primary_color ?>;
    }

    .main_questionary_wrap {
        padding-top: 50px;
    }

    .main_questionary_wrap .questionary_title h2 {
        text-align: center;
    }

    .main_questionary_wrap .questionary_title p {
        text-align: center;
    }

    .search_question input {
        height: 50px;
    }

    .search_question input:focus {
        box-shadow: none;
        outline: none;
        border-color: <?= $primary_color ?>;
    }

    .search_question .btn-secondary {
        color: #fff;
        background-color: <?= $primary_color ?>;
        border-color: <?= $primary_color ?>;
    }

    .search_question .btn-secondary.focus,
    .btn-secondary:focus {
        box-shadow: none;
    }

    .main_questionary_wrap .search_question p {
        text-align: left;
        background: <?= $primary_color ?>;
        padding: 10px;
        margin: 10px 0;
        color: #fff;
    }

    .main_questionary_wrap .search_question p span {
        width: 35px;
        height: 35px;
        line-height: 35px;
        background: #fff;
        display: inline-block;
        text-align: center;
        margin-right: 10px;
        color: <?= $primary_color ?>;
        font-weight: bold;
    }

    .search_question h4 {
        font-size: 20px;
        padding: 10px 0;
    }

    .question_collapse_set .card {
        background: transparent;
        border: none;
    }

    .question_collapse_set .col-md-4 .form-group {
        width: 50%;
        display: inline-block;
        vertical-align: middle;
        margin-bottom: 0;
    }

    .question_collapse_set .col-md-4 .form-group select {
        height: 50px;
    }

    .question_collapse_set .col-md-4 .delet_que {
        width: 48%;
        display: inline-block;
        vertical-align: middle;
        height: 50px;
        color: #fff;
        background-color: <?= $primary_color ?>;
        border-color: <?= $primary_color ?>;
    }

    .question_collapse_set .card-header.collapsed {
        margin-bottom: 10px;
        background: #fff;
    }

    .question_collapse_set .accordion p {
        text-align: left;
    }

    .question_collapse_set .card-header span {
        /* width: 35px; */
        width: 35px;
        height: 35px;
        line-height: 35px;
        background: <?= $primary_color ?>;
        display: inline-block;
        text-align: center;
        margin-right: 10px;
        color: #ffffff;
        font-weight: bold;
    }

    .question_collapse_set .col-md-4 .form-group select:focus {
        outline: none;
        box-shadow: none;
        border-color: <?= $primary_color ?>;
    }

    .main_question_rht_btn {
        text-align: right;
    }

    .main_question_rht_btn .cancel_question {
        background: transparent;
        color: <?= $primary_color ?>;
        border-color: <?= $primary_color ?>;
    }

    .main_question_rht_btn .save_question {
        color: #fff;
        background-color: <?= $primary_color ?>;
        border-color: <?= $primary_color ?>;
    }

    .main_question_rht_btn .btn:focus {
        box-shadow: none;
        outline: none;
    }

    .add_new_question {
        color: #fff;
        background-color: <?= $primary_color ?>;
        border-color: <?= $primary_color ?>;
    }

    .add_new_question i {
        margin-right: 10px;
    }

    .que_btn_set {
        padding: 15px 0;
    }

    .left_view_profile_img {
        width: 300px;
        height: 300px;
        line-height: 300px;
        border-radius: 50%;
        background: #fff;
        text-align: center;
        display: block;
        margin: 0 auto;
    }

    .left_view_profile_img img {
        width: 250px;
        height: 250px;
        border-radius: 50%;
        object-fit: cover;
    }

    .right_view_profile {
        padding: 10px;
        /*height: 300px;
    overflow-y: scroll;*/
    }

    .right_view_profile input {
        height: 50px;
    }

    .right_view_profile input:focus {
        box-shadow: none;
        outline: none;
        border-color: <?= $primary_color ?>;
    }

    .right_view_profile .btn-primary {
        color: #fff;
        background-color: <?= $secondary_color ?>;
        border-color: <?= $secondary_color ?>;
    }

    .right_view_profile .form-group {
        margin-bottom: 5px;
    }

    .right_view_profile input {
        background: transparent !important;
        border: none;
        padding: 0;
        color: <?= $primary_color ?>;
        display: inline-block;
        width: auto;
        height: auto;
    }

    .user_profile_data .profile_img img {
        object-fit: cover;
    }

    .view_profile_table {
        padding-top: 20px;
        padding-bottom: 20px;
        border-top: 1px solid #d9d9d9;
    }

    .view_profile_table .btn.btn-default.add-row {
        background: <?= $secondary_color ?>;
        color: #fff;
        margin-bottom: 10px;
    }

    .view_profile_table_inner i.fa.fa-trash {
        background: #d51a1a;
        padding: 10px;
        border-radius: 10px;
        color: #fff;
    }

    .view_profile_table_inner i.fa.fa-pencil {
        background: <?= $primary_color ?>;
        padding: 10px;
        border-radius: 10px;
        color: #fff;
    }

    .view_profile_table_inner .table thead tr {
        background: <?= $primary_color ?>;
    }

    .view_profile_table_inner .table thead tr th {
        color: #fff;
    }

    .view_profile_table_inner i.fa.fa-save {
        background: <?= $primary_color ?>;
        padding: 10px;
        border-radius: 10px;
        color: #fff;
    }

    .view_profile_table_inner .page-item.active .page-link {
        color: #fff;
        background-color: <?= $primary_color ?>;
        border-color: <?= $primary_color ?>;
    }

    .view_profile_table_inner .table tbody tr:nth-child(odd) {
        background: #fff;
    }

    .profile_details_view {
        padding-bottom: 20px;
    }

    .view_profile_table_user {
        padding-top: 20px;
        padding-bottom: 20px;
        border-top: 1px solid #d9d9d9;
    }

    .view_profile_table_user i.fa.fa-trash {
        background: #d51a1a;
        padding: 10px;
        border-radius: 10px;
        color: #fff;
    }

    .view_profile_table_user i.fa.fa-pencil {
        background: <?= $secondary_color ?>;
        padding: 10px;
        border-radius: 10px;
        color: #fff;
    }

    .view_profile_table_user .table thead tr {
        background: <?= $primary_color ?>;
    }

    .view_profile_table_user .table thead tr th {
        color: #fff;
    }

    .view_profile_table_user i.fa.fa-save {
        background: <?= $primary_color ?>;
        padding: 10px;
        border-radius: 10px;
        color: #fff;
    }

    .view_profile_table_user .table tbody tr:nth-child(odd) {
        background: #fff;
    }

    .edit_profile_frm_st input {
        height: 50px;
    }

    .edit_profile_frm_st input:focus {
        box-shadow: none;
        outline: none;
        border-color: <?= $primary_color ?>;
    }

    .save_edit_prf {
        color: #fff;
        background-color: <?= $secondary_color ?>;
        border-color: <?= $secondary_color ?>;
    }

    .save_edit_prf:hover {
        color: #fff;
        background-color: <?= $primary_color ?>;
        border-color: <?= $primary_color ?>;
    }

    .edit-brand .btn-primary {
        color: #fff;
        background-color: <?= $secondary_color ?>;
        border-color: <?= $secondary_color ?>;
    }

    .cancel_edit_prf {
        color: <?= $primary_color ?>;
        background-color: transparent;
        border-color: <?= $primary_color ?>;
    }

    .cancel_edit_prf:hover {
        color: #fff;
        background-color: <?= $primary_color ?>;
        border-color: <?= $primary_color ?>;
    }

    .profile_img img {
        object-fit: cover;
    }

    .view_profile_table_user h2 {
        color: <?= $primary_color ?>;
        font-size: 25px;
        padding: 10px 0;
    }

    .view_profile_table_user table tr td {
        vertical-align: middle;
    }

    .view_profile_table_user table tr td img {
        max-width: 100%;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
    }

    .view_profile_table_user table tr td .btn-primary {
        color: #fff;
        background-color: <?= $secondary_color ?>;
        border-color: <?= $secondary_color ?>;
    }

    .view_profile_table_inner table tr td img {
        max-width: 100%;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
    }

    .view_profile_table_inner table tr td .btn-primary {
        color: #fff;
        background-color: <?= $primary_color ?>;
        border-color: <?= $primary_color ?>;
    }

    .view_profile_table_inner table tr td {
        vertical-align: middle;
    }

    .view_profile_table h2 {
        color: <?= $primary_color ?>;
        font-size: 25px;
        padding: 10px 0;
    }

    .view_profile_table_user #edit_cl_prf {
        display: none;
    }

    .view_profile_table_user #edit_cl_prf i.fa.fa-times {
        background: #d51a1a;
        padding: 10px;
        border-radius: 10px;
        color: #fff;
    }

    tr#add_row_roles {
        display: none;
    }

    .color_edit_comp {

        background: <?= $primary_color ?>;
        display: inline-block;
        margin: 10px;
        border-radius: 1rem;
        color: <?= $dark_text_color ?> !important;
    }

    .color_edit_comp::before {
        content: '';
        border: none;
    }

    .color_edit_comp1 {

        background: <?= $secondary_color ?>;
        display: inline-block;
        margin: 10px;
        border-radius: 1rem;
    }

    .color_edit_comp,
    .color_edit_comp1 {
        width: 72px;
        height: 48px;
        border: none;


    }

    input[type="color"] {
        -webkit-appearance: none;
        border: none;
        width: 72px;
        height: 48px;
        overflow: hidden;
    }

    input[type="color"]::-webkit-color-swatch-wrapper {
        padding: 0;
    }

    input[type="color"]::-webkit-color-swatch {
        border: none;
    }

    .view-profile-edit-logo p {
        color: <?= $dark_text_color ?> !important;
        font-size: .8rem;
    }

    .edit_company_left_sec .browse_btn_edit_set {
        display: none;
    }

    .edit_company_left_sec a.customize_btn_set {
        display: block;
        color: #fff;
        background-color: <?= $secondary_color ?>;
        border-color: <?= $secondary_color ?>;
    }

    .edit_company_left_sec .profile_img {
        text-align: center;
    }

    .profile_details_view span.form-control {
        background: transparent;
        display: inline-block;
        width: 80%;
        border: none;
        color: <?= $primary_color ?>;
        padding-left: 0;
    }

    .user_profile_data input {
        height: 50px;
    }

    .user_profile_data input:focus {
        box-shadow: none;
        outline: none;
        border-color: <?= $primary_color ?>;
    }

    .edit_comp_rht_set input {
        height: 50px;
    }

    .edit_comp_rht_set input:focus {
        box-shadow: none;
        outline: none;
        border-color: <?= $primary_color ?>;
    }

    .select2-container--default.select2-container--focus .select2-selection--multiple {
        border-color: <?= $primary_color ?>;
    }

    .select2-container {
        width: 100% !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 50px;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 50px;
    }

    .select2-container--default .select2-selection--single {
        height: 50px !important;
        line-height: 50px !important;
    }

    /*Supplier page css*/
    .supplier_pg_form_set .form-group {
        display: inline-block;
        margin: 15px 15px;
    }

    .supplier_pg_form_set .select2-container .select2-selection--single {
        height: 50px;
    }

    .supplier_pg_form_set .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 50px;
    }

    .supplier_pg_form_set .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 50px;
    }

    .supplier_pg_form_set select {
        height: 50px;
    }

    .supplier_pg_form_set input#datepicker {
        height: 50px;
    }

    .supplier_pg_form_set .gj-datepicker-bootstrap [role=right-icon] button {
        width: 50px;
        background: #fff;
    }

    .supplier_pg_form_set .gj-datepicker-bootstrap [role=right-icon] button .gj-icon,
    .gj-datepicker-bootstrap [role=right-icon] button .material-icons {
        top: 15px;
        left: 15px;
        color: <?= $primary_color ?>;
    }

    .supplier_pg_form_set span i.fa.fa-plus {
        width: 50px;
        height: 50px;
        line-height: 50px;
        text-align: center;
        background: #ffffff;
        color: <?= $primary_color ?>;
    }

    .location_supplier_set {
        padding: 50px 0;
    }

    .location_supplier_set a {
        display: inline-block;
        width: 100%;
        text-decoration: none;
    }

    .location_supplier_set .inner_locat_supply {
        padding: 40px;
        background: #fff;
        width: 100%;
        margin: 10px 0;
        box-shadow: 0px 0px 5px 0px rgb(223 223 223);
        text-align: center;
    }

    .location_supplier_set .inner_locat_supply i.fa.fa-plus {
        background: <?= $primary_color ?>;
        width: 35px;
        height: 35px;
        line-height: 35px;
        text-align: center;
        color: #fff;
        border-radius: 50%;
    }

    .location_supplier_set .inner_locat_supply h4 {
        color: #000;
        font-size: 18px;
        margin-top: 10px;
    }

    .location_supplier_set .inner_locat_supply h2 {
        color: <?= $primary_color ?>;
        font-size: 30px;
        font-weight: bold;
    }

    .invite_supply_right .progress {
        margin-bottom: 10px;
    }

    .invite_supply_right {
        background: #fff;
        padding: 20px;
        box-shadow: 0px 0px 5px 0px rgb(223 223 223);
    }

    .inner_progress p {
        margin-bottom: 5px;
    }

    .invite_supply_right .inner_progress {
        margin-bottom: 20px;
    }

    .invite_supply_right .progress-bar {
        background-color: <?= $primary_color ?> !important;
    }

    .custom-progress-bar {
        background-color: <?= $primary_color ?> !important;
    }

    form.supplier_pg_form_set {
        background: <?= $primary_color ?>;
    }

    .inner_size_locate {
        text-align: center;
        background: #F4F8FE;
        padding: 10px;
        margin: 10px 0;
        /* width: 100%; */
        border-radius: .7rem;
        color: <?= $dark_text_color ?>;
        width: 130px;
        height: 70px;
    }

    .inner_size_locate h3 {
        /* color: #ffffff; */
        margin-bottom: 0;
    }

    .inner_size_locate p {
        text-transform: uppercase;
        font-size: .7rem;
        opacity: .8;
        margin-bottom: 0rem;
        /* color: #ffffff; */
    }

    .questionnaire_inner_size_locate {
        height: 70px;
    }

    .location_supplier_graph {
        padding: 25px;
        box-shadow: 0px 0px 5px 0px rgb(223 223 223);
        background: #fff;
        margin-top: 20px;
    }

    .location_supplier_graph .chart-container {
        position: relative;
        margin: auto;
        height: 50vh;
        width: 100%;
    }

    .location_size_supply {
        padding-bottom: 50px;
    }

    .questionary_title .btn-info {
        color: #fff;
        background-color: <?= $secondary_color ?>;
        border-color: <?= $secondary_color ?>;
    }

    .right_day_list_agenda .btn-info {
        color: #fff;
        background-color: <?= $secondary_color ?>;
        border-color: <?= $secondary_color ?>;
    }

    .right_supplier_table {
        text-align: right;
    }

    .right_supplier_table .btn {
        color: #fff;
        background-color: <?= $secondary_color ?>;
        border-color: <?= $secondary_color ?>;
    }

    .right_supplier_table .btn i {
        margin-right: 5px;
    }

    .suppliers_tables {
        padding-bottom: 50px;
    }

    .suppliers_tables h2 {
        font-size: 25px;
        color: <?= $primary_color ?>;
    }

    .suppliers_tables table.table {
        margin-top: 20px;
    }

    .suppliers_tables thead tr {
        background: <?= $primary_color ?>;
    }

    .suppliers_tables thead tr th {
        color: #fff;
    }

    .suppliers_tables tbody tr:nth-child(odd) {
        background: #fff;
    }

    .suppliers_tables i.fa.fa-eye {
        width: 35px;
        height: 35px;
        line-height: 35px;
        background: <?= $primary_color ?>;
        text-align: center;
        color: #fff;
        border-radius: 10px;
    }

    .suppliers_tables i.fa.fa-trash {
        width: 35px;
        height: 35px;
        line-height: 35px;
        background: #d00707;
        text-align: center;
        color: #fff;
        border-radius: 10px;
    }

    .pending_suppliers_tables {
        padding-bottom: 50px;
    }

    .pending_suppliers_tables h2 {
        font-size: 25px;
        color: <?= $primary_color ?>;
    }

    .pending_suppliers_tables table.table {
        margin-top: 20px;
    }

    .pending_suppliers_tables thead tr {
        background: <?= $primary_color ?>;
    }

    .pending_suppliers_tables thead tr th {
        color: #fff;
    }

    .pending_suppliers_tables tbody tr:nth-child(odd) {
        background: #fff;
    }

    .pending_suppliers_tables i.fa.fa-send {
        width: 35px;
        height: 35px;
        line-height: 35px;
        background: <?= $primary_color ?>;
        text-align: center;
        color: #fff;
        border-radius: 10px;
    }

    .pending_suppliers_tables i.fa.fa-trash {
        width: 35px;
        height: 35px;
        line-height: 35px;
        background: #d00707;
        text-align: center;
        color: #fff;
        border-radius: 10px;
    }

    .delete_suppliers_tables h2 {
        font-size: 25px;
        color: <?= $primary_color ?>;
    }

    .delete_suppliers_tables table.table {
        margin-top: 20px;
    }

    .delete_suppliers_tables thead tr {
        background: <?= $primary_color ?>;
    }

    .delete_suppliers_tables thead tr th {
        color: #fff;
    }

    .delete_suppliers_tables tbody tr:nth-child(odd) {
        background: #fff;
    }

    .delete_suppliers_tables i.fa.fa-send {
        width: 35px;
        height: 35px;
        line-height: 35px;
        background: <?= $primary_color ?>;
        text-align: center;
        color: #fff;
        border-radius: 10px;
    }

    .delete_suppliers_tables i.fa.fa-trash {
        width: 35px;
        height: 35px;
        line-height: 35px;
        background: #d00707;
        text-align: center;
        color: #fff;
        border-radius: 10px;
    }

    .delete_suppliers_tables a.btn.btn-primary {
        color: #fff;
        background-color: <?= $primary_color ?>;
        border-color: <?= $primary_color ?>;
    }

    .sidenav_inner {
        position: fixed;
        height: 100vh !important;
        width: 220px;
    }

    .sidenav_inner a {
        width: 100%;
        /* display: block; */
        /* padding: 10px 0; */
        /* color: #fff; */
        color: #000;
        background: #fff;
        /* padding-left: 10px; */
        text-decoration: none;
    }

    .sidenav-inner-text {
        margin-bottom: 0 !important;
    }

    .sidenav-inner-item {
        padding-left: 1rem;
        padding-right: 1rem;
        border-radius: .5rem;
    }

    .sidenav-inner-selected,
    .sidenav-inner-selected p {
        background-color: <?= $primary_color ?> !important;
        color: <?= $text_color ?> !important;
    }

    .sidenavbar_inner_titles {
        text-transform: uppercase;
        font-size: .8rem;
        /* color: <?= $dark_text_color ?>; */
        opacity: .8;
        margin-bottom: .1rem;
    }

    .sidenav_inner a:hover,
    .sidenav_inner p:hover {
        color: <?= $primary_color ?>;
        /* color: #fff; */
    }

    .sidenav_inner {
        background: white;
        padding: 20px;
    }

    .sidenav_inner .dropdown-btn {
        width: 100%;
        background: #fff;
        border: none;
        outline: none;
        box-shadow: none;
        padding: 10px;
        margin-bottom: 10px;
    }

    .sidenav_inner .dropdown-container {
        padding: 10px;
        background: #fff;
        margin-bottom: 10px;
    }

    .sidenav_inner .dropdown-container a {
        color: #000;
        padding-left: 10px;
        text-decoration: none;
    }

    .sidenav_inner .dropdown-container a.active {
        background-color: <?= $primary_color ?>;
        color: #fff;
    }

    /*.sidenav_inner .dropdown-container {
    display: none;
}*/
    .invite_sent_rht_main {
        padding: 20px;
    }

    .invite_sent_rht_main form input {
        width: 100%;
        height: 40px;
        padding: 0 10px;
    }

    .invite_sent_rht_main a.btn {
        width: 100%;
        background-color: <?= $secondary_color ?>;
        border-color: <?= $secondary_color ?>;
        color: #fff;
    }

    .invite_sent_rht_main .btn-primary {
        color: #fff;
        background-color: <?= $secondary_color ?>;
        border-color: <?= $secondary_color ?>;
    }

    a {
        /* color: <?= $primary_color ?>; */
    }

    .invite_send_table h2 {
        font-size: 18px;
        font-weight: bold;
    }

    .invite_sent_rht_main a.btn i {
        margin-right: 5px;
    }

    .invite_send_table .table thead th {
        border: none;
    }

    .invite_send_table .table tbody td {
        border: none;
    }

    .invite_send_table .table-bordered {
        border: none;
    }

    .inner_left_nw_invite_img img {
        max-width: 100%;
    }

    .inner_left_nw_invite_img {
        height: 119px;
        width: 119px;
        margin: 0 auto;
        display: block;
        border-radius: 50%;
    }

    .inner_left_nw_invite_img img {
        border-radius: 50%;
        object-fit: cover;
        width: 100%;
        height: 100%;
    }

    .new_invite_right input {
        height: 50px;
        border-radius: 10px;
    }

    .new_invite_right input:focus {
        outline: none;
        box-shadow: none;
        border-color: <?= $primary_color ?>;
    }

    .new_invite_right .btn.btn-primary.cancel_btn_invite {
        color: <?= $primary_color ?>;
        background-color: transparent;
        border-color: <?= $primary_color ?>;
    }

    .new_invite_right .send_btn_invite {
        color: #fff;
        background-color: <?= $secondary_color ?>;
        border-color: <?= $secondary_color ?>;
    }

    .new_invite_right {
        border: 2px solid <?= $primary_color ?>;
        padding: 40px;
        border-radius: 20px;
        background: #fff;
    }

    .read_invite_set a {
        color: #000;
        font-size: 20px;
    }

    .read_invite_set a i {
        margin-right: 5px;
    }

    .read_invite_profile_img {
        width: 50px;
        height: 50px;
        display: inline-block;
        border-radius: 50%;
        vertical-align: middle;
    }

    .read_invite_profile_img img {
        border-radius: 50%;
        object-fit: cover;
        max-width: 100%;
    }

    .read_invite_content {
        display: inline-block;
        vertical-align: middle;
        margin-left: 10px;
    }

    .read_invite_content h3 {
        font-size: 18px;
    }

    .read_invite_content p {
        font-size: 18px;
        margin: 0;
    }

    .read_invite_date {
        display: inline-block;
        vertical-align: middle;
    }

    .read_invite_date {
        display: inline-block;
        vertical-align: middle;
        margin-left: 10px;
    }

    .read_invite_date h3 {
        font-size: 18px;
        margin: 0;
    }

    .read_invite_date .btn.btn-primary {
        background: <?= $primary_color ?>;
        border-color: <?= $primary_color ?>;
        color: #fff;
    }

    .read_invite_right {
        text-align: right;
    }

    .row.read_invite_set_row {
        padding-top: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid <?= $primary_color ?>;
    }

    .row.read_invite_set_row1 {
        padding-top: 15px;
        padding-bottom: 15px;
    }

    .row.read_invite_set_row1 h2 {
        font-size: 18px;
        font-weight: bold;
    }

    .row.read_invite_set_row1 form textarea {
        width: 100%;
        background: #fff;
        border: none;
        padding: 10px;
        box-shadow: none;
        outline: none;
    }

    .row.read_invite_set_row1 .resend-subject {
        width: 100%;
        background: #fff;
        border: none;
        padding: 10px;
        box-shadow: none;
        outline: none;
    }

    .row.read_invite_set_row1 .btn.btn-primary {
        background: <?= $primary_color ?>;
        border-color: <?= $primary_color ?>;
        color: #fff;
        margin-top: 15px;
    }

    .re-send-invite-set {
        padding: 20px;
        background: transparent;
        border: 2px solid <?= $primary_color ?>;
        border-radius: 15px;
        margin-top: 20px;
    }

    .re_send_invite_profile_img {
        width: 50px;
        height: 50px;
        display: inline-block;
        border-radius: 50%;
        vertical-align: middle;
    }

    .re_send_invite_profile_img img {
        border-radius: 50%;
        object-fit: cover;
        max-width: 100%;
    }

    .re_send_invite_profile {
        padding: 20px;
        background: <?= $primary_color ?>;
        border-radius: 10px;
    }

    .re_send_invite_content {
        display: inline-block;
        vertical-align: middle;
        margin-left: 10px;
    }

    .re_send_invite_content h3 {
        font-size: 18px;
        color: #fff;
    }

    .re-send-invite-set .btn.btn-primary.cancel_btn_re {
        color: <?= $primary_color ?>;
        background-color: transparent;
        border-color: <?= $primary_color ?>;
    }

    .re-send-invite-set .send_btn_re {
        color: #fff;
        background-color: <?= $primary_color ?>;
        border-color: <?= $primary_color ?>;
        margin-left: 10px;
    }

    .re-send-invite-set form {
        margin: 15px 0;
    }

    .re-send-invite-set form textarea {
        width: 100%;
        background: #fff;
        border: none;
        padding: 10px;
        box-shadow: none;
        outline: none;
        margin-bottom: 15px;
    }

    .read_ticket_set a {
        color: #000;
        font-size: 20px;
    }

    .read_ticket_set a i {
        margin-right: 5px;
    }

    .read_ticket_profile_img {
        width: 50px;
        height: 50px;
        display: inline-block;
        border-radius: 50%;
        vertical-align: middle;
    }

    .read_ticket_profile_img img {
        border-radius: 50%;
        object-fit: cover;
        max-width: 100%;
    }

    .read_ticket_content {
        display: inline-block;
        vertical-align: middle;
        margin-left: 10px;
    }

    .read_ticket_content h3 {
        font-size: 18px;
    }

    .read_ticket_content p {
        font-size: 18px;
        margin: 0;
    }

    .read_ticket_date {
        display: inline-block;
        vertical-align: middle;
    }

    .read_ticket_date {
        display: inline-block;
        vertical-align: middle;
        margin-left: 10px;
    }

    .read_ticket_date h3 {
        font-size: 18px;
        margin: 0;
    }

    .read_ticket_date .btn.btn-primary {
        background: <?= $primary_color ?>;
        border-color: <?= $primary_color ?>;
        color: #fff;
    }

    .read_ticket_right {
        text-align: right;
    }

    .row.read_ticket_set_row {
        padding-top: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid <?= $primary_color ?>;
    }

    .row.read_ticket_set_row1 {
        padding-top: 15px;
        padding-bottom: 15px;
    }

    .row.read_ticket_set_row1 h2 {
        font-size: 18px;
        font-weight: bold;
    }

    .row.read_ticket_set_row1 form textarea {
        width: 100%;
        background: #fff;
        border: none;
        padding: 10px;
        box-shadow: none;
        outline: none;
    }

    .row.read_ticket_set_row1 .btn.btn-primary {
        background: <?= $primary_color ?>;
        border-color: <?= $primary_color ?>;
        color: #fff;
        margin-top: 15px;
    }

    .box_ticket_assign {
        text-align: center;
        background: <?= $primary_color ?>;
        padding: 20px;
    }

    .box_ticket_assign h3 {
        text-align: center;
        color: #fff;
        font-size: 18px;
        margin-bottom: 20px;
    }

    .ticket_assign_img {
        width: 50px;
        height: 50px;
        display: block;
        border-radius: 50%;
        vertical-align: middle;
        margin: 0 auto;
    }

    .ticket_assign_img img {
        border-radius: 50%;
        object-fit: cover;
        max-width: 100%;
    }

    .box_ticket_assign a i {
        margin-right: 5px;
    }

    .box_ticket_assign .btn.btn-primary {
        background: #fff !important;
        border-color: #fff !important;
        color: <?= $primary_color ?> !important;
        margin-top: 18px !important;
    }

    .new_supplier_reminder_set .btn.btn-primary {
        padding: 10px 40px;
        background: <?= $primary_color ?>;
        border-color: <?= $primary_color ?>;
    }

    .new_supplier_reminder_set h2 {
        font-size: 18px;
        font-weight: bold;
    }

    .new_supplier_reminder_set {
        padding: 20px 0;
        border-top: 1px solid <?= $primary_color ?>;
    }

    .new_supplier_reminder_set .table thead th {
        border: none;
    }

    .new_supplier_reminder_set .table tbody td {
        border: none;
    }

    .new_supplier_reminder_set .table-bordered {
        border: none;
    }

    .left_info_graph .pie-chart {
        background: radial-gradient(circle closest-side,
                white 0,
                white 20.72%,
                transparent 20.72%,
                transparent 74%,
                white 0),
            conic-gradient(#ffc850 0,
                #ffc850 43.7%,
                #ef5350 0,
                #ef5350 70.1%,
                #b03459 0,
                #b03459 100%);
        position: relative;
        width: 100%;
        min-height: 350px;
        margin: 0;
        outline: none;
        box-shadow: 0px 0px 5px 0px rgba(176, 176, 176, 1);
        border-radius: 15px;
    }

    .left_info_graph .pie-chart h2 {
        position: absolute;
        text-align: center;
        width: 100%;
    }

    .left_info_graph .pie-chart figcaption {
        position: absolute;
        bottom: 1em;
        right: 1em;
        font-size: smaller;
        text-align: right;
    }

    .left_info_graph .pie-chart span:after {
        display: inline-block;
        content: '';
        width: 0.8em;
        height: 0.8em;
        margin-left: 0.4em;
        height: 0.8em;
        border-radius: 0.2em;
        background: currentColor;
    }

    .left_info_graph .pie-chart1 {
        background: radial-gradient(circle closest-side, white 0, white 20.72%, transparent 20.72%, transparent 74%, white 0), conic-gradient(#ffc850 0, #ffc850 50%, #ef5350 0, #ef5350 100%);
        position: relative;
        width: 100%;
        min-height: 350px;
        margin: 0;
        outline: none;
        box-shadow: 0px 0px 5px 0px rgba(176, 176, 176, 1);
        border-radius: 15px;
    }

    .left_info_graph .pie-chart1 h2 {
        position: absolute;
        text-align: center;
        width: 100%;
    }

    .left_info_graph .pie-chart1 figcaption {
        position: absolute;
        bottom: 1em;
        right: 1em;
        font-size: smaller;
        text-align: right;
    }

    .left_info_graph .pie-chart1 span:after {
        display: inline-block;
        content: '';
        width: 0.8em;
        height: 0.8em;
        margin-left: 0.4em;
        height: 0.8em;
        border-radius: 0.2em;
        background: currentColor;
    }

    .left_info-title h3 {
        margin: 0;
        font-weight: bold;
    }

    .left_info-title p {
        display: inline-block;
        margin-right: 5px;
        padding: 10px 0;
    }

    .right-info-drp select {
        width: 50%;
        height: 50px;
        padding: 10px;
    }

    .info-table-wrap {
        padding: 20px 0
    }

    .info-table-wrap .table .thead-dark th {
        color: #fff;
        background-color: <?= $primary_color ?>;
        border-color: <?= $primary_color ?>;
    }

    .info_question-table {
        padding: 20px 0
    }

    .info_question-table .table .thead-dark th {
        color: #fff;
        background-color: <?= $primary_color ?>;
        border-color: <?= $primary_color ?>;
    }

    .supplier-info-wrapper .back_btn {
        padding: 20px 0;
        color: #000;
        display: inline-block;
    }

    .supplier-info-wrapper .back_btn i {
        margin-right: 5px;
    }

    .row.left_info_graph {
        padding: 20px 0;
    }

    .info_question-table tr td .btn-primary.dlt_btn {
        color: #fff;
        background-color: #e34b4b;
        border-color: #e34b4b;
    }

    .inner_left_agenda .btn.btn-primary {
        background: <?= $secondary_color ?>;
        border-color: <?= $secondary_color ?>;
        color: #fff;
        display: block;
        margin: 0 auto;
    }

    #addevent .btn-primary {
        color: #fff;
        background: <?= $secondary_color ?>;
        border-color: <?= $secondary_color ?>;
    }

    #editeventmodal .btn-primary {
        color: #fff;
        background: <?= $secondary_color ?>;
        border-color: <?= $secondary_color ?>;
    }

    .event_type_set {
        padding-top: 20px;
        padding-right: 10px;
        padding-left: 10px;
    }

    .new_event_st {
        padding: 20px;
        border: 1px solid <?= $primary_color ?>;
        border-radius: 20px;
    }

    .event_type_set ul {
        padding: 0;
        margin: 0;
    }

    .event_type_set ul li {
        list-style-type: none;
        margin: 10px 0;
    }

    .event_type_set ul li span {
        width: 15px;
        height: 15px;
        border-radius: 50%;
        margin-right: 5px;
        display: inline-block;
        vertical-align: middle;
    }

    .event_type_set ul li:first-child span {
        background: #DB1B1D;
    }

    .event_type_set ul li:nth-child(2) span {
        background: #F5AC00;
    }

    .event_type_set ul li:nth-child(3) span {
        background: #3BD0AE;
    }

    .event_type_set ul li:last-child span {
        background: #572FFF;
    }

    .calendar-events-dates {
        font-family: 'IBM Plex Sans';
        background: white;
        padding: 0.7rem;
        box-shadow: 0px 0px 5px 0px rgb(223 223 223);
        border-radius: 2px;
    }

    .calendar-events-dates-header {
        display: flex;
    }


    .calendar-button,
    .calendar-today {
        display: flex;
        width: 40px;
        border: 1px solid rgb(223 223 223);
        text-align: center;
        border-radius: 5px;
        color: <?= $dark_text_color ?>;
        align-items: center;
        justify-content: center;
        height: 35px;
    }

    .calendar-today {

        width: 80px;
        opacity: .7;

    }

    .calendar-date {
        padding-right: 175px;
        font-weight: 700;
        font-size: 1.4rem;
        margin: auto;
        /* Añadimos esta propiedad */
    }

    .calendar-button:first-child {
        border-right: none;
        border-top-right-radius: 0px;
        border-bottom-right-radius: 0px;
    }

    .calendar-button:last-child {
        border-top-left-radius: 0px;
        border-bottom-left-radius: 0px;
    }

    .event-day-month {
        opacity: .6;
        font-size: .8rem;
    }



    .event-day-week {
        font-weight: 600;
        text-transform: uppercase;
        font-size: 1.1rem;

    }

    .event-day-month,
    .event-day-week {
        color: <?= $dark_text_color ?>;
        text-align: center;
    }

    .event-details {
        border: 1px solid #3BD0AE;
        border-left: 3px solid #3BD0AE;
        padding-top: 6px;
        padding-bottom: 6px;
    }

    .event-time-range {
        color: #3BD0AE;
        font-size: .7rem;
        font-weight: bold;
    }

    .even-name {
        font-weight: 600;
        opacity: .9;
    }

    .even-content {
        opacity: .6;
        font-size: .65rem;
    }


    .upcoming-event-name {
        font-weight: 700;
        font-size: 1rem;

    }

    .upcoming-event-name::first-letter {
        text-transform: capitalize;

    }

    .upcoming-event-date {
        font-weight: 500;
        opacity: .8;
        font-size: small;
    }

    .event_type_set ul li p {
        display: inline-block;
        margin: 0;
        vertical-align: middle;
    }

    .inner_left_agenda {
        background: white;
        padding: 0;
        padding-left: 1px;
        position: fixed;
        height: 100vh;
        width: 320px;
    }

    .inner_left_agenda form .form-check {
        margin-left: 15px;
        margin-bottom: 15px;
    }

    .inner_left_agenda .btn.btn-primary i {
        margin-right: 5px;
    }

    .inner_left_agenda .app {
        /* width: 80%; */
        height: 30%;
        margin: 0;
        margin-bottom: 15px;
        display: block;
        background: white;
        /* margin-right: 40px; */
    }

    .inner_left_agenda .app__main {
        background: #fbf9fa;
        width: 100%;
        /* height: 100%; */
    }


    .inner_left_agenda .app .calendar {
        padding: 10px;
        background: white;
    }

    .inner_left_agenda .app .calendar .datepicker table {
        width: 100%;
        background: transparent;
    }

    .inner_left_agenda .app .datepicker thead tr:first-child th,
    .datepicker tfoot tr th {
        cursor: pointer;
        color: <?= $primary_color ?>;
    }

    .inner_left_agenda .app .datepicker .dow {
        border-bottom: 1px solid #e7e7e7;
        color: #9b8079;
        font-size: 13px;
    }

    .inner_left_agenda .app .datepicker-days tbody td:nth-child(6),
    .datepicker-days tbody td:nth-child(7) {
        color: #D44;
    }

    .inner_left_agenda .app .datepicker td,
    .datepicker th {
        text-align: center;
        width: 20px;
        height: 40px;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        border-radius: 4px;
        border: none;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
    }

    .inner_left_agenda .app .datepicker table tr td.today:hover,
    .datepicker table tr td.today:hover:hover,
    .datepicker table tr td.today.disabled:hover,
    .datepicker table tr td.today.disabled:hover:hover,
    .datepicker table tr td.today:active,
    .datepicker table tr td.today:hover:active,
    .datepicker table tr td.today.disabled:active,
    .datepicker table tr td.today.disabled:hover:active,
    .datepicker table tr td.today.active,
    .datepicker table tr td.today:hover.active,
    .datepicker table tr td.today.disabled.active,
    .datepicker table tr td.today.disabled:hover.active,
    .datepicker table tr td.today.disabled,
    .datepicker table tr td.today:hover.disabled,
    .datepicker table tr td.today.disabled.disabled,
    .datepicker table tr td.today.disabled:hover.disabled,
    .datepicker table tr td.today[disabled],
    .datepicker table tr td.today:hover[disabled],
    .datepicker table tr td.today.disabled[disabled],
    .datepicker table tr td.today.disabled:hover[disabled] {
        background-color: <?= $primary_color ?>;
    }

    .inner_left_agenda .app .datepicker.dropdown-menu th,
    .datepicker.datepicker-inline th,
    .datepicker.dropdown-menu td,
    .datepicker.datepicker-inline td {
        padding: 4px 5px;
    }

    .inner_left_agenda .app .today.day {
        background: <?= $primary_color ?>;
        color: #fff;
    }

    .inner_left_agenda .app .datepicker table tr td.active:hover,
    .datepicker table tr td.active:hover:hover,
    .datepicker table tr td.active.disabled:hover,
    .datepicker table tr td.active.disabled:hover:hover,
    .datepicker table tr td.active:active,
    .datepicker table tr td.active:hover:active,
    .datepicker table tr td.active.disabled:active,
    .datepicker table tr td.active.disabled:hover:active,
    .datepicker table tr td.active.active,
    .datepicker table tr td.active:hover.active,
    .datepicker table tr td.active.disabled.active,
    .datepicker table tr td.active.disabled:hover.active,
    .datepicker table tr td.active.disabled,
    .datepicker table tr td.active:hover.disabled,
    .datepicker table tr td.active.disabled.disabled,
    .datepicker table tr td.active.disabled:hover.disabled,
    .datepicker table tr td.active[disabled],
    .datepicker table tr td.active:hover[disabled],
    .datepicker table tr td.active.disabled[disabled],
    .datepicker table tr td.active.disabled:hover[disabled] {
        background-color: #17bdce;
        color: #fff !important;
    }

    .inner_left_agenda p.month_title_set {
        text-align: center;
        font-weight: bold;
        font-size: 18px;
    }

    .right_day_list_agenda ul li {
        list-style: none;
    }

    .right_day_list_agenda ul li span {
        display: inline-block;
        vertical-align: middle;
    }

    .right_day_list_agenda ul li h4 {
        display: inline-block;
        vertical-align: middle;
        margin: 0;
        padding-left: 15px;
        font-size: 20px;
        line-height: normal;
    }

    .right_day_list_agenda ul li p {
        display: inline-block;
        vertical-align: middle;
        margin: 0;
    }

    .right_day_list_agenda ul li a {
        display: inline-block;
        width: 100%;
        padding: 10px;
        color: #000;
        background: #fff;
        margin: 10px 0;
        text-decoration: none;
    }

    .right_day_list_agenda ul {
        padding: 20px;
        background: <?= $primary_color ?>;
        border-radius: 15px;
    }

    .right_day_list_agenda {
        margin-top: 30px;
    }

    .right_day_list_agenda h2 {
        text-align: center;
        padding-bottom: 20px;
        font-weight: bold;
    }

    .right_day_list_agenda .modal .btn.btn-primary {
        background: <?= $primary_color ?>;
        border-color: <?= $primary_color ?>;
        color: #fff;
        padding: 10px 20px;
        display: inline-block;
    }

    .right_day_list_agenda .modal p {
        margin: 0;
        padding: 5px 0px;
    }

    .right_day_list_agenda .modal .col-md-12 {
        padding-top: 20px;
        padding-bottom: 20px;
    }

    .right_day_list_agenda .modal h3 {
        font-size: 22px;
        margin: 0;
        padding: 10px 0;
    }

    .right_day_list_agenda .modal .col-md-12 .form-check {
        margin-top: 15px;
    }

    .supplier_que_table table {
        width: 100%;
    }

    .supplier_que_table table th {
        text-align: left;
        border-bottom: 1px solid #ccc;
    }

    .supplier_que_table table th,
    table td {
        padding: 0.4em;
    }

    .supplier_que_table table.fold-table>tbody>tr.view td,
    table.fold-table>tbody>tr.view th {
        cursor: pointer;
    }

    .supplier_que_table table.fold-table>tbody>tr.view td:first-child,
    table.fold-table>tbody>tr.view th:first-child {
        position: relative;
        padding-left: 20px;
    }

    .supplier_que_table table.fold-table>tbody>tr.view td:first-child:before,
    table.fold-table>tbody>tr.view th:first-child:before {
        position: absolute;
        top: 50%;
        left: 5px;
        width: 9px;
        height: 16px;
        margin-top: -8px;
        font: 16px fontawesome;
        color: #999;
        content: '';
        transition: all 0.3s ease;
    }

    .supplier_que_table table.fold-table>tbody>tr.view:nth-child(4n-1) {
        background: #eee;
    }

    /*.supplier_que_table table.fold-table > tbody > tr.view:hover {
  background: #000;
}*/
    .supplier_que_table table.fold-table>tbody>tr.view.open {
        background: <?= $primary_color ?>;
        color: white;
    }

    .supplier_que_table table.fold-table>tbody>tr.view.open td:first-child:before,
    table.fold-table>tbody>tr.view.open th:first-child:before {
        transform: rotate(-180deg);
        color: #333;
    }

    .supplier_que_table table.fold-table>tbody>tr.fold {
        display: none;
    }

    .supplier_que_table table.fold-table>tbody>tr.fold.open {
        display: table-row;
    }

    .supplier_que_table .fold-content {
        padding: 0.5em;
    }

    .supplier_que_table .fold-content h3 {
        margin-top: 0;
    }

    .supplier_que_table .fold-content>table {
        border: 2px solid #ccc;
    }

    .supplier_que_table .fold-content>table>tbody tr:nth-child(even) {
        background: #eee;
    }

    .inner_observe_que {
        display: none;
    }

    .inner_observe_que #hide {
        background: <?= $primary_color ?>;
        border: 1px solid <?= $primary_color ?>;
        color: #fff;
        padding: 10px 20px;
        display: inline-block;
    }

    .supplier_que_table .btn.btn-primary {
        background: <?= $primary_color ?>;
        border: 1px solid <?= $primary_color ?>;
        color: #fff;
        padding: 10px 20px;
        display: inline-block;
    }

    .supplier_que_table .form-check {
        display: inline-block;
        margin: 0 5px;
    }

    .other_file_que .card {
        margin: 10px 0;
    }

    .other_file_que .card .btn.btn-link.collapsed .fa.fa-minus {
        display: none;
    }

    .other_file_que .card .fa.fa-minus {
        display: inline-block;
    }

    .other_file_que .card .btn.btn-link.collapsed .fa.fa-plus {
        display: inline-block;
    }

    .other_file_que .card .fa.fa-plus {
        display: none;
    }

    .other_file_que h3 {
        font-size: 20px;
        padding: 15px 0;
        font-weight: bold;
        color: <?= $primary_color ?>;
    }

    .other_file_que .card .btn.btn-link {
        color: <?= $primary_color ?>;
    }

    .other_file_que .card table .btn.btn-primary {
        background: <?= $primary_color ?>;
        border-color: <?= $primary_color ?>;
        margin-right: 10px;
    }

    .other_file_que .more {
        display: inline-block;
        float: right;
    }

    .other_file_que .more-menu {
        width: 100px;
    }

    /* More Button / Dropdown Menu */
    .other_file_que .more-btn,
    .more-menu-btn {
        background: none;
        border: 0 none;
        line-height: normal;
        overflow: visible;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        width: 100%;
        text-align: left;
        outline: none;
        cursor: pointer;
    }

    .other_file_que .more-dot {
        background-color: #aab8c2;
        margin: 0 auto;
        display: inline-block;
        width: 7px;
        height: 7px;
        margin-right: 1px;
        border-radius: 50%;
        transition: background-color 0.3s;
    }

    .other_file_que .more-menu {
        position: absolute;
        top: 10%;
        left: 90%;
        z-index: 900;
        float: left;
        padding: 10px 0;
        margin-top: 9px;
        background-color: #fff;
        border: 1px solid #ccd8e0;
        border-radius: 4px;
        box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.25);
        opacity: 0;
        transform: translate(0, 15px) scale(.95);
        transition: transform 0.1s ease-out, opacity 0.1s ease-out;
        pointer-events: none;
    }

    .other_file_que .more-menu-caret {
        position: absolute;
        top: -10px;
        left: 12px;
        width: 18px;
        height: 10px;
        float: left;
        overflow: hidden;
    }

    .other_file_que .more-menu-caret-outer,
    .more-menu-caret-inner {
        position: absolute;
        display: inline-block;
        margin-left: -1px;
        font-size: 0;
        line-height: 1;
    }

    .other_file_que .more-menu-caret-outer {
        border-bottom: 10px solid #c1d0da;
        border-left: 10px solid transparent;
        border-right: 10px solid transparent;
        height: auto;
        left: 0;
        top: 0;
        width: auto;
    }

    .other_file_que .more-menu-caret-inner {
        top: 1px;
        left: 1px;
        border-left: 9px solid transparent;
        border-right: 9px solid transparent;
        border-bottom: 9px solid #fff;
    }

    .other_file_que .more-menu-items {
        margin: 0;
        list-style: none;
        padding: 0;
    }

    .other_file_que .more-menu-item {
        display: block;
    }

    .other_file_que .more-menu-btn {
        min-width: 100%;
        color: #66757f;
        cursor: pointer;
        display: block;
        font-size: 13px;
        line-height: 18px;
        padding: 5px 20px;
        position: relative;
        white-space: nowrap;
    }

    .other_file_que .more-menu-item:hover {
        background-color: <?= $primary_color ?>;
    }

    .other_file_que .more-menu-item:hover .more-menu-btn {
        color: #fff;
    }

    .other_file_que .more-btn:hover .more-dot,
    .show-more-menu .more-dot {
        background-color: #516471;
    }

    .other_file_que .show-more-menu .more-menu {
        opacity: 1;
        transform: translate(0, 0) scale(1);
        pointer-events: auto;
    }

    /*.other_file_que .card h5 {display: inline-block;}*/
    .folder_btn_que {
        display: inline-block;
        float: right;
    }

    .folder_btn_que .btn-primary {
        color: #fff;
        background-color: <?= $primary_color ?>;
        border-color: <?= $primary_color ?>;
    }

    .right_day_list_agenda .modal .form-check {
        margin-left: 15px;
    }

    .right_day_list_agenda .modal .col-md-12 {
        padding-top: 0 !important;
        padding-bottom: 10px !important;
    }

    .ad_drp_que1 {
        display: none;
    }

    .other_file_que .dropbtn {
        background-color: #3498DB;
        color: white;
        padding: 16px;
        font-size: 16px;
        border: none;
        cursor: pointer;
    }

    .other_file_que .dropbtn:hover,
    .dropbtn:focus {
        background-color: #2980B9;
    }

    .other_file_que .dropdown {
        position: relative;
        display: inline-block;
    }

    .other_file_que .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f1f1f1;
        min-width: 160px;
        overflow: auto;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .other_file_que .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .other_file_que .dropdown a:hover {
        background-color: #ddd;
    }

    .other_file_que .show {
        display: block;
    }

    /*psk css 20-02-21*/
    .w-90 {
        width: 90%;
        margin: 0 auto;
    }

    .main {
        /* padding-bottom: 62px; */
        margin-bottom: 0;
    }

    a {
        text-decoration: none;
        outline: none;
    }

    a:focus,
    a:hover {
        outline: none;
        text-decoration: none;
    }

    .bg_btn {
        background: <?= $secondary_color ?>;
        border: 1px solid transparent;
        color: #fff;
        font-size: 14px;
        line-height: 1.5;
        font-weight: 500;
        padding: 10px;
        cursor: pointer;
        transition: all ease .5s;
        display: flex;
        justify-content: center;
        align-items: center;
        /*display: inline-block;*/
    }

    .bg_btn:hover,
    .bg_btn:focus {
        border-color: <?= $secondary_color ?>;
        color: <?= $secondary_color ?>;
        background: transparent;
        text-decoration: none;
    }

    .que_btn_set .btn-primary {
        color: #fff;
        background-color: <?= $secondary_color ?>;
        border-color: <?= $secondary_color ?>;
    }

    .view_btn {
        min-width: 80px;
        border-radius: 25px;
        padding: 4px 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
    }

    .view_btn .fa {
        margin-right: 5px;
    }

    .mr-10 {
        margin-right: 10px;
    }

    .mr-20 {
        margin-right: 20px;
    }

    .mr-30 {
        margin-right: 30px;
    }

    .select2_pp {}

    .calender {
        margin-left: 10%;
    }

    .select2-container--open .select2-dropdown--below {
        border-radius: 0;
    }

    .select2-container--default .select2-search--dropdown .select2-search__field {
        outline: none;
    }

    .select2-container--default .select2-search--dropdown .select2-search__field {
        border: 1px solid #aaa;
        border-radius: 30px;
    }

    .step_one .select2-container--default .select2-selection--single {
        /*border-radius: 0;
    border: 0;
    border-bottom: 1px solid #979797;*/
        background: <?= $primary_color ?>;
        color: #fff;
        border-radius: 30px !important;
        outline: none;
    }

    .step_one .select2-container--default.select2-container--open.select2-container--below .select2-selection--single,
    .step_one .select2-container--default.select2-container--open.select2-container--below .select2-selection--multiple {
        border-bottom-left-radius: 30px;
        border-bottom-right-radius: 30px;
    }

    .step_one .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 1.5;
        font-size: 16px;
        color: inherit;
        padding-left: 15px;
        padding-right: 30px;
        height: 100%;
        align-items: center;
        display: flex;
        outline: none;
    }

    .step_one .select2-container--default .select2-selection--single .select2-selection__placeholder {
        color: inherit;
    }

    .step_one .select2-container--default .select2-selection--single,
    .step_one .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 43px;
        /*height: 100%;*/
        right: 8px;
    }

    .step_one .select2-container--default .select2-selection--single .select2-selection__arrow b {
        width: 15px;
        height: 10px;
        border: 0;
        /*background: url(../images/arrow-down.png);*/
        background: url(http://chessmafia.com/php/SEAT/images/client/images/arrow-down.svg);
        background-position: 95% center !important;
        background-repeat: no-repeat !important;
        -webkit-transition: -webkit-transform .5s ease-in-out;
        -ms-transition: -ms-transform .5s ease-in-out;
        transition: transform .5s ease-in-out;
        transform: translate(-50%, -50%) rotate(0deg);
        margin-left: 0;
    }

    .step_one .select2-container--open.select2-container--default .select2-selection--single .select2-selection__arrow b {
        transform: translate(-50%, -50%) rotate(180deg);
    }

    .step_one .select2-results__option {
        font-weight: 600;
    }

    #locationbody .btn-info {
        color: #fff;
        background-color: <?= $secondary_color ?>;
        border-color: <?= $secondary_color ?>;
    }

    .calender input {
        /* background: <?= $primary_color ?>; */
        /* color: #fff; */
        /* border-radius: 30px; */
        /* outline: none; */
        text-align: center;
        /* outline: none; */
        height: 43px;
        /* border: none; */
        cursor: pointer;
    }

    .calender input::placeholder {
        /* Chrome, Firefox, Opera, Safari 10.1+ */
        color: #fff;
        opacity: 1;
        /* Firefox */
    }

    .calender input:-ms-input-placeholder {
        /* Internet Explorer 10-11 */
        color: #fff;
    }

    .calender input::-ms-input-placeholder {
        /* Microsoft Edge */
        color: #fff;
    }

    .plus_icon {
        border-radius: 50%;
        width: 43px;
        min-width: 43px;
        height: 43px;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .top_sec {
        /* background: #cce6e8; */
        /* padding: 7px 5px; */
    }

    .bottom_sec {
        display: flex;
        margin-top: 20px;
    }

    .count_cl .rw {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 30px;
    }

    .count_cl .li_itm {
        margin-bottom: 20px;
        /*margin-right: 20%;*/
        text-align: center;
    }

    .count_cl .li_itm:last-child {
        margin-right: 0;
    }

    .count_cl .li_itm h3 {
        font-size: 56px;
        font-weight: bold;
        color: <?= $primary_color ?>;
        margin: 0;
    }

    .count_cl .li_itm p {
        font-size: 16px;
        color: #444;
        margin: 0;
    }

    .sm_title {
        display: inline-block;
        font-size: 16px;
        font-weight: 500;
        color: #777;
        margin-bottom: 20px;
    }

    .txt .sm_title {
        font-size: inherit;
    }

    /* .table_pp .table{
  margin-bottom: 0;
}
.table_pp .table thead tr{
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.table_pp .table thead th {
    vertical-align: middle;
    border-bottom: 2px solid #dee2e6;
    border: none;
    padding: 0;
    line-height: 0;
} */
    .latest_cl {
        padding: 20px 30px;
        border: 1px solid #00000020;
        border-radius: 25px;
        margin-top: 20px;
    }

    .latest_cl .rw {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .lst .li_itm h4 {
        font-size: 16px;
        color: #000;
        margin: 0;
    }

    .lst .li_itm h4 .checkbox_ps {
        margin-bottom: 0;
    }

    .ques_apply {
        padding: 20px 50px;
    }

    .ques_apply .count_cl .li_itm h3 {
        font-size: 46px;
    }

    .check_option {
        /* max-width: 80%;
  margin: 0 auto;
  display: flex;
  align-items: center;
  justify-content: flex-start;*/
    }

    .qus_text {
        margin-top: 20px;
    }

    .qus_text label {
        font-size: 14px;
        color: #c3c3c3;
        font-style: italic;
    }

    .qus_text p {
        font-size: 14px;
        color: #000;
    }

    .percentage_sign {
        font-size: 14px;
        color: #c3c3c3;
        margin-top: 10px;
        margin-right: 20px;
    }

    .qus_text .supplier_wrapper {
        padding-top: 0;
    }

    .qus_text .inner_summary_graph {
        margin-top: 0;
    }

    .piechart svg,
    .piechart {
        background: radial-gradient(circle closest-side, white 0, white 20.72%, transparent 20.72%, transparent 74%, white 0), conic-gradient(#ffc850 0, #ffc850 50%, #ef5350 0, #ef5350 100%);
        border-radius: 15px;
        box-shadow: 0px 0px 5px 0px rgb(176 176 176);
        text-align: center;
    }

    .questionnaire-main .left_info_graph .pie-chart1 {
        min-height: 400px;
    }

    /*checkbox ps*/
    .checkbox_ps {
        display: inline-block;
        position: relative;
        padding-left: 35px;
        margin-bottom: 20px;
        cursor: pointer;
        font-size: 14px;
        /*color: #484848;*/
        color: inherit;
        font-weight: 500;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    .checkbox_ps .checkbx {
        line-height: initial;
    }

    .checkbox_ps input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
    }

    .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 18px;
        width: 18px;
        background-color: #fff;
        border: 1px solid #dedede;
        transition: all .4s ease-in-out;
    }

    .checkbox_ps:hover input~.checkmark {
        /*background-color: #ccc;*/
        border-color: <?= $primary_color ?>;
    }

    .checkbox_ps .checkmark:after {
        content: '';
        position: absolute;
        left: 5px;
        top: 0;
        width: 7px;
        height: 12px;
        border: solid <?= $primary_color ?>;
        border-width: 0 2px 2px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
        display: none;
    }

    .checkbox_ps input:checked~.checkmark:after {
        display: block;
    }

    /*supplier page*/
    .slide_tgl_btn {
        cursor: pointer;
    }

    .justify-content-space {
        justify-content: space-between;
    }

    .add_fold_sec .latest_cl {}

    .add_head {
        margin-top: 15px;
    }

    .add_head .view_btn .fa {
        margin-right: 5px;
    }

    .all_down_txt {
        font-size: 16px;
        color: #000;
        font-weight: 500;
        cursor: pointer;
    }

    .all_down_txt .fa {
        margin-left: 5px;
    }

    .folder_wr {
        background: #cce6e8;
        padding: 7px 5px;
        margin-top: 20px;
        margin-bottom: 20px;
        position: relative;
    }

    .dots {
        margin-left: 20px;
        color: #000;
    }

    .fld_list {
        padding: 0 10px;
        margin-bottom: 10px;
    }

    .fld_list:last-child {
        margin-bottom: 0;
    }

    .bg {
        background: #e1f7f9;
    }

    .fld_list2 {
        display: flex;
        justify-content: space-between;
        padding: 5px;
    }

    .fld_list2 .fld_name {
        margin-right: 20px;
        color: #c3c3c3;
        font-size: 14px;
    }

    .fld_list2 .fld_name:last-child {
        margin-right: 0;
    }

    .fld_list2 .txt {
        color: #000;
        font-size: 14px;
    }

    .fld_list2 .lft {
        width: 60%;
        display: flex;
    }

    .fld_list .fld_name {
        font-size: 14px;
        color: #000;
    }

    .fld_name .fa {
        margin-right: 10px;
    }

    .dot_pop_bx {
        right: 0;
    }

    .folder_pop {
        position: absolute;
        background: #fff;
        min-width: 200px;
        padding: 10px;
        border: 1px solid #eee;
        z-index: 1;
    }

    .folder_pop a {
        font-size: 16px;
        color: #000;
        display: block;
        margin-bottom: 7px;
    }

    .add_fold_sec .text_wrap {
        display: flex;
        align-items: center;
        width: 60%;
    }

    .add_fold_sec .text_wrap .li_itm {
        margin-right: 70px;
    }

    .action_wrap {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .action_wrap .li_itm {
        margin-right: 15px;
    }

    .action_wrap .li_itm:last-child {
        margin-right: 0;
    }

    .observation .folder_wr {
        margin-top: 0;
        background: none;
        padding: 0;
    }

    .observation .folder_wr .fld_list {
        padding: 0;
    }

    .observation .fld_list .fld_name {
        margin-right: 20px;
        color: #c3c3c3;
    }

    .observation .fld_list .txt {
        color: #000;
        font-size: 14px;
    }

    .observation .latest_cl .rw {
        justify-content: flex-end;
    }

    .observation .input_pp {
        margin-bottom: 20px;
    }

    .input_pp {
        position: relative;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: nowrap;
        flex-wrap: nowrap;
        -ms-flex-align: stretch;
        width: 100%;
        align-items: center;
    }

    .input_pp .form-control {
        border-radius: 30px;
        box-shadow: none;
        outline: none;
        width: calc(100% - 80px);
        margin-right: 30px;
    }

    .add_nw_fldr .modal-content {
        border-radius: 0;
    }

    .add_nw_fldr .modal-body {
        padding: 20px;
    }

    .add_nw_fldr .input_pp .form-control {
        width: 100%;
        margin: 0;
    }

    .add_nw_fldr h4 {
        font-size: 16px;
        font-weight: 700;
        color: #000;
        margin-bottom: 15px;
    }

    .add_nw_fldr .action_wrap {
        justify-content: flex-end;
        margin-top: 30px;
    }

    .new_file_pop .attach_file {
        cursor: pointer;
        background: #e1f7f9;
        padding: 5px;
        margin-top: 15px;
        margin-bottom: 15px;
    }

    .new_file_pop .attach_file label {
        margin: 0;
    }

    .new_file_pop .input_pp .form-control {
        height: 80px;
    }

    .new_file_pop .input_pp {
        margin-top: 10px;
    }

    .attach_file.bg {
        padding: 5px 10px;
        font-size: 14px;
        color: #000;
    }

    .attach_file.bg label {
        white-space: nowrap;
    }

    .attach_file .file_nm {
        margin-left: 10px;
    }

    .update_btn {
        text-align: left;
    }

    .attach_file {
        cursor: pointer;
        display: flex;
        align-items: center;
    }

    .attach_file label {
        margin: 0;
        cursor: pointer;
    }

    .attach_file form {
        display: flex;
    }

    .attach_file [type='file'] {
        height: 0;
        overflow: hidden;
        width: 0;
    }

    .attach_file [type='file']+label {
        background: none;
        border: none;
        border-radius: 5px;
        color: #000;
        font-size: 14px;
        cursor: pointer;
        display: inline-block;
        width: 100%;
        font-size: inherit;
        font-weight: 400;
        outline: none;
        padding: 1rem 50px;
        padding: 0;
        position: relative;
        -webkit-transition: all 0.3s;
        transition: all 0.3s;
        /*vertical-align: middle;*/
        margin-bottom: 0;
    }

    .question_wp .fld_list .txt {
        margin-right: 10%;
    }

    .question_wp .fld_list2 {
        padding: 5px 15px;
        margin-bottom: 15px;
    }

    .question_observ .folder_wr {
        margin: 0;
        background: none;
        padding: 0;
    }

    .question_observ .title_head {
        margin-bottom: 20px;
    }

    .question_observ .title_head .title {
        color: #000;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
    }

    .question_observ .title_head .title span {
        /* color: #c3c3c3;*/
        font-weight: 400;
    }

    .question_observ .folder_wr .fld_list {
        padding: 0;
    }

    .check_option {
        max-width: 100%;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: flex-start;
    }

    .check_option .checkbox_ps {
        margin-right: 30px;
        padding-left: 30px;
    }

    .question_observ .attach_file {
        padding: 5px 10px;
        margin-bottom: 10px;
        display: flex;
        justify-content: space-between;
        cursor: default;
    }

    .qus_obs_list {
        border-bottom: 2px solid #00000020;
        padding-bottom: 20px;
        margin-bottom: 20px;
    }

    .qus_obs_list:last-child {
        border-bottom: 0;
        padding-bottom: 0;
        margin-bottom: 0;
    }

    .hide_requirment {
        background: #eee;
        padding: 20px;
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .hide_requirment .sm_title {
        font-weight: 400;
        cursor: pointer;
        margin: 0;
    }

    /*create_questionnaire_pop*/
    .create_questionnaire_pop .modal-header {
        flex-wrap: wrap;
        justify-content: center;
        border: none;
    }

    .create_questionnaire_pop h4 {
        font-size: 20px;
    }

    .create_questionnaire_pop p {
        margin-bottom: 0;
        color: #777;
    }

    .create_questionnaire_pop .modal-content {
        border-radius: 20px;
        padding: 20px;
    }

    .cr_qus_nm {
        margin-bottom: 20px;
        border-bottom: 1px solid #eee;
        padding-bottom: 20px;
    }

    .cr_qus_nm a {
        margin-bottom: 15px;
    }

    .cr_qus_nm a:last-child {
        margin-bottom: 0;
    }

    .create_questionnaire_pop .modal-content .view_btn {
        padding: 10px;
    }

    .create_question_page {}

    .question_sec {
        padding-bottom: 110px;
    }

    .question_sec .head_bg {
        padding: 10px 15px;
        background: #eee;
    }

    .question_sec .head_bg h4 {
        font-size: 22px;
    }

    .question_sec .sm_title {
        color: #000;
        margin-bottom: 15px;
    }

    .question_sec .input_pp {
        margin-bottom: 10px;
    }

    .question_sec .input_pp .form-control {
        margin-right: 0;
        width: 100%;
    }

    .add_rqrm_btn {
        margin-bottom: 10px;
        display: inline-block;
    }

    .link {
        font-size: 14px;
        line-height: 1.1;
        color: <?= $primary_color ?>;
    }

    .link:hover {
        color: inherit;
    }

    .no_apply {
        margin-top: 20px;
    }

    .no_apply .checkbox_ps {
        margin-bottom: 10px;
    }

    .question_sec .action_wrap {
        justify-content: flex-end;
        width: 100%;
        margin-top: 20px;
    }

    .disable {
        -webkit-user-modify: read-only;
        pointer-events: none;
        opacity: .4;
    }

    .group_wrp {
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .arrow_dwn {
        width: 15px;
        height: 10px;
        border: 0;
        background: url(http://chessmafia.com/php/SEAT/images/client/images/arrow-down.svg);
        background-position: 95% center !important;
        background-repeat: no-repeat !important;
        -webkit-transition: -webkit-transform .5s ease-in-out;
        -ms-transition: -ms-transform .5s ease-in-out;
        transition: transform .5s ease-in-out;
        transform: translateY(-50%) rotate(0deg);
        position: absolute;
        top: 50%;
        right: 10px;
        left: auto;
        margin: 0;
    }

    .group_btn {
        height: 43px;
        min-width: 100px;
        background: <?= $primary_color ?>;
        border: 1px solid transparent;
        line-height: 1.5;
        font-size: 16px;
        color: #fff;
        padding-left: 15px;
        padding-right: 30px;
        align-items: center;
        display: flex;
        outline: none;
    }

    .group_btn:focus,
    .group_btn:hover {
        color: #fff;
    }

    .txt {
        color: #000;
        font-size: 14px;
    }

    .question_sec .group_wrp .folder_pop {
        top: 45px;
    }

    .question_sec .group_wrp .folder_pop a {
        text-align: center;
    }

    .question_sec .group_wrp .folder_pop .txt {
        font-weight: 500;
    }

    .show_rqe {
        cursor: pointer;
    }

    .show-filters {
        display: flex;
    }

    .hide-filters {
        display: none;
    }

    .locat_table_nw .btn:focus {
        outline: none;
        box-shadow: none;
    }

    .locat_table_nw .btn.btn-success.exploder {
        background: <?= $secondary_color ?>;
        border-color: <?= $secondary_color ?>;
    }

    .add_fold_sec .btn-info {
        color: #fff;
        background-color: <?= $secondary_color ?>;
        border-color: <?= $secondary_color ?>;
    }

    .folder_wr .btn-info {
        color: #fff;
        background-color: <?= $secondary_color ?>;
        border-color: <?= $secondary_color ?>;
    }

    .locat_table_nw .btn-danger {
        color: #fff;
        background-color: <?= $primary_color ?>;
        border-color: <?= $primary_color ?>;
    }

    .questionary_inner_data {
        padding: 0;
    }

    .questionary_inner_data li {
        display: inline-block;
        margin-right: 10px;
        vertical-align: middle;
    }

    .questionary_inner_data li .btn-primary {
        color: #fff;
        background-color: <?= $primary_color ?>;
        border-color: <?= $primary_color ?>;
    }

    /*psk css end*/
    @media screen and (max-width: 767px) {
        .events-card {
            max-height: max-content;
            overflow: hidden;
        }

        .edit_comp_rht_set {
            padding-top: 20px;
        }

        .que_btn_set a {
            width: 100%;
            margin: 10px 0;
        }

        .main.active {
            padding-left: 0;
        }

        .header .navbar-expand-lg .navbar-nav .dropdown-menu {
            width: 100%;
        }

        .header .navbar-collapse {
            background: <?= $primary_color ?>;
            padding: 10px;
        }

        .footer_wrapper p {
            color: #fff;
            text-align: right;
            width: 80%;
            display: block;
            margin-right: 0;
            margin-left: auto;
        }

        table {
            display: block;
            width: 100%;
            overflow-x: auto;
        }

        .inner_summary_graph {
            padding: 10px;
            margin-bottom: 20px;
        }

        .chart-container {
            height: 30vh;
        }

        .questionary_data_wrap .inner_questionary_data {
            padding: 10px 0;
        }

        .questionary_data_wrap #chartdiv {
            height: 300px;
        }

        .left_view_profile_img img {
            width: 150px;
            height: 150px;
        }

        .left_info_graph .pie-chart {
            margin: 10px 0;
        }

        .questionary_inner_data li {
            word-break: break-all;
            white-space: normal;
            width: 100% !important;
            display: block;
            margin-bottom: 15px;
        }
    }

    @media screen and (max-width: 992px) {
        .left_view_profile_img {
            width: 100%;
            height: auto;
            line-height: normal;
        }

        .left_view_profile_img {
            width: auto;
            height: auto;
            line-height: normal;
            background: transparent;
            border-radius: 0;
        }
    }

    /* reply the message in the  client module */
    .reply_ticket_section {
        border: 1px solid <?= $primary_color ?>;
        height: 350px;
        border-radius: 25px;
        padding: 1%;
    }

    .accept_location_data {
        width: 100%;
        background: #fff;
        border: none;
        padding: 10px;
        box-shadow: none;
        outline: none;
    }

    .opt_nw_bx {
        margin-left: -60px;
    }

    .inner_left_agenda .app__main .calendar .month {
        display: block;
        width: 23%;
        height: 54px;
        line-height: 54px;
        float: left;
        margin: 1%;
        cursor: pointer;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        border-radius: 4px;
    }

    .inner_left_agenda .app__main .calendar .year {
        display: block;
        width: 23%;
        height: 54px;
        line-height: 54px;
        float: left;
        margin: 1%;
        cursor: pointer;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        border-radius: 4px;
    }

    #exampleModal form .form-check.col-md-12 {
        padding-left: 2.25rem;
        margin-bottom: 15px;
    }

    #exampleModal form input:focus {
        outline: none;
        box-shadow: none;
        border-color: <?= $primary_color ?>;
    }

    #exampleModal form textarea:focus {
        outline: none;
        box-shadow: none;
        border-color: <?= $primary_color ?>;
    }

    #exampleModal .modal-footer .btn.btn-primary {
        background: <?= $primary_color ?>;
        border-color: <?= $primary_color ?>;
        color: #fff;
        font-weight: 600;
    }

    .new_invite_right .select2-selection {
        height: 40px !important;
    }

    .new_invite_right .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 38px;
    }

    .new_invite_right .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 38px;
    }

    .new_invite_right .select2.select2-container {
        width: 100% !important;
    }

    .new_invite_right select {
        height: 40px;
    }

    .new_invite_right ul#select2-questionnaire-container {
        display: block;
        padding-top: 5px;
    }

    .new_que_chart1 {
        /* box-shadow: 0px 0px 5px 0px rgb(176, 176, 176); */
        background: #fff;
        border-radius: 15px;
        padding: 20px;
    }

    .new_que_chart1 #answerpiechart #idealvsreal {
        width: 100px !important;
        height: 100px !important;
        margin: 0 auto;
        font-size: 18px !important;
        display: block;
    }

    .que_setting_pg_new .right_que_setting_pg_new {
        padding: 15px;
        border: 1px solid #9b9b9b;
        border-radius: 15px;
    }

    .que_setting_pg_new .left_que_setting_pg_new {
        padding: 15px;
        border: 1px solid #9b9b9b;
        border-radius: 15px;
    }

    .left_que_setting_pg_new .switch {
        position: relative;
        display: inline-block;
        width: 46px;
        height: 18px;
    }

    .left_que_setting_pg_new .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .left_que_setting_pg_new .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .left_que_setting_pg_new .slider:before {
        padding: 5;
        position: absolute;
        content: '';
        height: 13px;
        width: 13px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .left_que_setting_pg_new input:checked+.slider {
        background-color: <?= $primary_color ?>;
    }

    .left_que_setting_pg_new input:focus+.slider {
        box-shadow: 0 0 1px <?= $primary_color ?>;
    }

    .left_que_setting_pg_new input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .left_que_setting_pg_new .slider.round {
        border-radius: 34px;
    }

    .left_que_setting_pg_new .slider.round:before {
        border-radius: 50%;
    }

    .invite_sent_wrapper {
        padding-left: 45px;
    }

    .invite_sent_wrapper ul#select2-questionnaire-container {
        display: inline-block;
        padding-top: 0;
        top: 0px;
        position: relative;
        margin: 0;
        vertical-align: middle;
    }

    .invite_sent_wrapper span.select2-search.select2-search--inline {
        display: inline-block;
        vertical-align: middle;
        height: 100%;
    }

    .message-right-container {
        margin-left: 220px;
        margin-right: 0px;
        width: 100%;
    }

    /*.btn-primary{
    background:<?= $secondary_color ?> !important;
    border-color:<?= $secondary_color ?> !important;
}*/
    .right_que_setting_pg_new .btn-info {
        color: #fff;
        background-color: <?= $secondary_color ?>;
        border-color: <?= $secondary_color ?>;
    }

    .brand-secondary-color {
        background-color: <?= $secondary_color ?>;
        border-color: <?= $secondary_color ?>;
    }

    .hidden {
        display: none;
    }

    .footer-href a {
        color: #B6B6B6 !important;
    }
</style>
