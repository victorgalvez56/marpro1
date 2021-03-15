@php
@endphp
<html>
@if(false)
<!-- <div> {!! $company->getFooterExtranetDashboard() !!}</div> --> //se obtiene el html
@endif

<head>
    <style>
        @import url("https://fonts.googleapis.com/css?family=Prompt:400,500,600,700|Roboto");

        body {
            background: #f5f5f5;
            font-family: "Roboto", sans-serif;
            margin: 0;
        }

        html {
            overflow-x: hidden;
            position: relative;
            min-height: 100%;
            background: #f5f5f5;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            color: #003f6f;
            font-family: "Prompt", sans-serif;
            margin: 10px 0;
        }

        h1 {
            line-height: 43px;
        }

        h2 {
            line-height: 35px;
        }

        h3 {
            line-height: 30px;
        }

        h3 small {
            color: #444444;
        }

        h4 {
            line-height: 22px;
        }

        h4 small {
            color: #444444;
        }

        h5 small {
            color: #444444;
        }

        * {
            outline: none !important;
        }

        a:hover {
            outline: 0;
            text-decoration: none;
        }

        a:active {
            outline: 0;
            text-decoration: none;
        }

        a:focus {
            outline: 0;
            text-decoration: none;
        }

        /*inicio Estilos personalizados*/
        .color-prim {
            background-color: #003f6f !important;
        }

        .color-side {
            background-color: #003f6f !important;
        }

        .container {
            width: auto;
        }

        .container-alt {
            margin-left: auto;
            margin-right: auto;
            padding-left: 15px;
            padding-right: 15px;
        }

        .footer {
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            bottom: 0px;
            color: #003f6f;
            text-align: left !important;
            padding: 10px;
            position: absolute;
            right: 0;
            left: 240px;
        }

        #wrapper {
            height: 100%;
            overflow: hidden;
            width: 100%;
        }

        .page {
            bottom: 0;
            left: 0;
            right: 0;
            top: 0;
        }

        .social-links li a {
            -webkit-border-radius: 50%;
            background: #03a9f4;
            border-radius: 50%;
            color: #ffffff;
            display: inline-block;
            height: 30px;
            line-height: 30px;
            text-align: center;
            width: 30px;
        }

        /* ============== Bootstrap-custom ===================*/
        .row {
            margin-right: -10px;
            margin-left: -10px;
        }

        .col-lg-1,
        .col-lg-10,
        .col-lg-11,
        .col-lg-12,
        .col-lg-2,
        .col-lg-3,
        .col-lg-4,
        .col-lg-5,
        .col-lg-6,
        .col-lg-7,
        .col-lg-8,
        .col-lg-9,
        .col-md-1,
        .col-md-10,
        .col-md-11,
        .col-md-12,
        .col-md-2,
        .col-md-3,
        .col-md-4,
        .col-md-5,
        .col-md-6,
        .col-md-7,
        .col-md-8,
        .col-md-9,
        .col-sm-1,
        .col-sm-10,
        .col-sm-11,
        .col-sm-12,
        .col-sm-2,
        .col-sm-3,
        .col-sm-4,
        .col-sm-5,
        .col-sm-6,
        .col-sm-7,
        .col-sm-8,
        .col-sm-9,
        .col-xs-1,
        .col-xs-10,
        .col-xs-11,
        .col-xs-12,
        .col-xs-2,
        .col-xs-3,
        .col-xs-4,
        .col-xs-5,
        .col-xs-6,
        .col-xs-7,
        .col-xs-8,
        .col-xs-9 {
            padding-left: 10px;
            padding-right: 10px;
        }

        .breadcrumb {
            background-color: transparent;
            margin-bottom: 15px;
            margin-top: 5px;
        }

        .dropdown-menu {
            padding: 4px 0;
            border: 0;
        }

        .dropdown-menu>li>a {
            padding: 6px 20px;
        }

        .bg-primary {
            background-color: #03a9f4 !important;
        }

        .bg-success {
            background-color: #01ba9a !important;
        }

        .bg-info {
            background-color: #18bae2 !important;
        }

        .bg-warning {
            background-color: #f8ca4e !important;
        }

        .bg-danger {
            background-color: #f62f37 !important;
        }

        .bg-muted {
            background-color: #d0d0d0 !important;
        }

        .bg-inverse {
            background-color: #212121 !important;
        }

        .bg-purple {
            background-color: #7e57c2 !important;
        }

        .bg-pink {
            background-color: #ec407a !important;
        }

        .bg-white {
            background-color: #ffffff !important;
        }

        .text-white {
            color: #ffffff;
        }

        .text-danger {
            color: #f62f37;
        }

        .text-muted {
            color: #898989;
        }

        .text-primary {
            color: #03a9f4;
        }

        .text-warning {
            color: #f8ca4e;
        }

        .text-success {
            color: #01ba9a;
        }

        .text-info {
            color: #18bae2;
        }

        .text-pink {
            color: #ec407a;
        }

        .text-purple {
            color: #7e57c2;
        }

        .text-dark {
            color: #2a323c !important;
        }

        .form-control {
            -moz-border-radius: 2px;
            -moz-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
            -webkit-border-radius: 2px;
            -webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
            background-color: #fafafa;
            border-radius: 2px;
            border: 1px solid #eeeeee;
            box-shadow: none;
            height: 38px;
            color: rgba(0, 0, 0, 0.6);
            font-size: 14px;
        }

        .form-control:focus {
            background: #ffffff;
            border: 1px solid #e0e0e0;
            box-shadow: none;
        }

        .input-lg {
            height: 46px;
            padding: 10px 16px;
            font-size: 16px;
            line-height: 1.3333333;
            border-radius: 3px;
        }

        .input-sm {
            height: 30px;
            padding: 5px 10px;
            font-size: 12px;
            line-height: 1.5;
            border-radius: 3px;
        }

        .label-primary {
            background-color: #03a9f4;
        }

        .label-success {
            background-color: #01ba9a;
        }

        .label-info {
            background-color: #18bae2;
        }

        .label-warning {
            background-color: #f8ca4e;
        }

        .label-danger {
            background-color: #f62f37;
        }

        .label-dark {
            background-color: #2a323c;
        }

        .badge {
            text-transform: uppercase;
            padding: 3px 7px 4px;
            font-size: 11px;
            margin-top: 1px;
        }

        .badge-xs {
            font-size: 9px;
        }

        .badge-xs,
        .badge-sm {
            -webkit-transform: translate(0, -2px);
            -ms-transform: translate(0, -2px);
            -o-transform: translate(0, -2px);
            transform: translate(0, -2px);
        }

        .badge-primary {
            background-color: #03a9f4;
        }

        .badge-success {
            background-color: #01ba9a;
        }

        .badge-info {
            background-color: #18bae2;
        }

        .badge-warning {
            background-color: #f8ca4e;
        }

        .badge-danger {
            background-color: #f62f37;
        }

        .badge-dark {
            background-color: #2a323c;
        }

        .popover {
            border-radius: 3px;
        }

        .pagination>li>a {
            background-color: #ffffff;
            border: 1px solid #dddddd;
            color: #373e4a;
        }

        .pagination>li>span {
            background-color: #ffffff;
            border: 1px solid #dddddd;
            color: #373e4a;
        }

        .pagination>.active>a,
        .pagination>.active>span,
        .pagination>.active>a:hover,
        .pagination>.active>span:hover,
        .pagination>.active>a:focus,
        .pagination>.active>span:focus {
            background-color: #03a9f4;
            border-color: #03a9f4;
        }

        .tabs {
            background-color: #ffffff;
            margin: 0 auto;
            padding: 0px;
            position: relative;
            white-space: nowrap;
            width: 100%;
        }

        .tabs li.tab {
            background-color: #ffffff;
            display: block;
            float: left;
            margin: 0;
            text-align: center;
        }

        .tabs li.tab a {
            -moz-transition: color 0.28s ease;
            -ms-transition: color 0.28s ease;
            -o-transition: color 0.28s ease;
            -webkit-transition: color 0.28s ease;
            color: #ee6e73;
            display: block;
            height: 100%;
            text-decoration: none;
            transition: color 0.28s ease;
            width: 100%;
        }

        .tabs li.tab a.active {
            color: #03a9f4 !important;
        }

        .tabs .indicator {
            background-color: #03a9f4;
            bottom: 0;
            height: 2px;
            position: absolute;
            will-change: left, right;
        }

        .tabs-top .indicator {
            top: 0;
        }

        .nav.nav-tabs+.tab-content {
            background: #ffffff;
            margin-bottom: 30px;
            padding: 30px;
        }

        .tabs-vertical-env {
            margin-bottom: 30px;
        }

        .tabs-vertical-env .tab-content {
            background: #ffffff;
            display: table-cell;
            margin-bottom: 30px;
            padding: 30px;
            vertical-align: top;
        }

        .tabs-vertical-env .nav.tabs-vertical {
            display: table-cell;
            min-width: 120px;
            vertical-align: top;
            width: 150px;
        }

        .tabs-vertical-env .nav.tabs-vertical li.active>a {
            background-color: #ffffff;
            border: 0;
        }

        .tabs-vertical-env .nav.tabs-vertical li>a {
            color: #333333;
            text-align: center;
            white-space: nowrap;
        }

        .nav.nav-tabs>li.active>a {
            background-color: #ffffff;
            border: 0;
        }

        .nav.nav-tabs>li>a,
        .nav.tabs-vertical>li>a {
            background-color: transparent;
            border-radius: 0;
            border: none;
            color: #333333 !important;
            cursor: pointer;
            line-height: 50px;
            font-weight: 500;
            padding-left: 20px;
            padding-right: 20px;
            font-family: "Prompt", sans-serif;
        }

        .nav.nav-tabs>li>a:hover,
        .nav.tabs-vertical>li>a:hover {
            color: #03a9f4 !important;
        }

        .tab-content {
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
            color: #777777;
        }

        .nav.nav-tabs>li:last-of-type a {
            margin-right: 0px;
        }

        .nav.nav-tabs {
            border-bottom: 0;
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
        }

        .nav-tabs.nav-justified>.active>a,
        .nav-tabs.nav-justified>.active>a:hover,
        .nav-tabs.nav-justified>.active>a:focus,
        .tabs-vertical-env .nav.tabs-vertical li.active>a {
            border: none;
        }

        .nav-tabs>li.active>a,
        .nav-tabs>li.active>a:focus,
        .nav-tabs>li.active>a:hover,
        .tabs-vertical>li.active>a,
        .tabs-vertical>li.active>a:focus,
        .tabs-vertical>li.active>a:hover {
            color: #03a9f4 !important;
        }

        /* ==============Helper Classes===================*/
        .p-0 {
            padding: 0px !important;
        }

        .p-t-0 {
            padding-top: 0px !important;
        }

        .p-t-10 {
            padding-top: 10px !important;
        }

        .p-b-10 {
            padding-bottom: 10px !important;
        }

        .m-0 {
            margin: 0px !important;
        }

        .m-r-5 {
            margin-right: 5px;
        }

        .m-r-10 {
            margin-right: 10px;
        }

        .m-r-15 {
            margin-right: 15px !important;
        }

        .m-l-10 {
            margin-left: 10px;
        }

        .m-l-15 {
            margin-left: 15px;
        }

        .m-t-5 {
            margin-top: 5px !important;
        }

        .m-t-0 {
            margin-top: 0px;
        }

        .m-t-10 {
            margin-top: 10px !important;
        }

        .m-t-15 {
            margin-top: 15px !important;
        }

        .m-t-20 {
            margin-top: 20px;
        }

        .m-t-30 {
            margin-top: 30px !important;
        }

        .m-t-40 {
            margin-top: 40px !important;
        }

        .m-b-0 {
            margin-bottom: 0px;
        }

        .m-b-5 {
            margin-bottom: 5px;
        }

        .m-b-10 {
            margin-bottom: 10px;
        }

        .m-b-15 {
            margin-bottom: 15px;
        }

        .m-b-30 {
            margin-bottom: 30px;
        }

        .w-xs {
            min-width: 80px;
        }

        .w-sm {
            min-width: 95px;
        }

        .w-md {
            min-width: 110px;
        }

        .w-lg {
            min-width: 140px;
        }

        .m-h-50 {
            min-height: 50px;
        }

        .l-h-34 {
            line-height: 34px;
        }

        .font-light {
            font-weight: 300;
        }

        .wrapper-md {
            padding: 20px;
        }

        .pull-in {
            margin-left: -15px;
            margin-right: -15px;
        }

        .b-0 {
            border: none !important;
        }

        .no-border {
            border: none;
        }

        .bx-shadow {
            -moz-box-shadow: 0px 1px 2px 0px rgba(0, 0, 0, 0.1);
            -webkit-box-shadow: 0px 1px 2px 0px rgba(0, 0, 0, 0.1);
            box-shadow: 0px 1px 2px 0px rgba(0, 0, 0, 0.1);
        }

        .mx-box {
            max-height: 380px;
            min-height: 380px;
        }

        .thumb-sm {
            height: 32px;
            width: 32px;
        }

        .thumb-md {
            height: 48px;
            width: 48px;
        }

        .thumb-lg {
            height: 88px;
            width: 88px;
        }

        .grid-structure .grid-container {
            background-color: #f5f5f5;
            margin-bottom: 10px;
            padding: 10px 20px;
        }

        .icon-list div {
            cursor: pointer;
            line-height: 40px;
            white-space: nowrap;
        }

        .icon-list i {
            -webkit-transition: all 0.2s;
            -webkit-transition: font-size 0.2s;
            display: inline-block;
            font-size: 14px;
            margin: 0;
            text-align: center;
            transition: all 0.2s;
            transition: font-size 0.2s;
            vertical-align: middle;
            width: 40px;
        }

        .icon-list .col-md-3:hover i {
            -o-transform: scale(2);
            -webkit-transform: scale(2);
            moz-transform: scale(2);
            transform: scale(2);
        }

        .ionicon-list i {
            font-size: 16px;
        }

        .ionicon-list .col-md-3:hover i {
            -o-transform: scale(2);
            -webkit-transform: scale(2);
            moz-transform: scale(2);
            transform: scale(2);
        }

        @-webkit-keyframes cd-bounce-1 {
            0% {
                opacity: 0;
                -webkit-transform: scale(0.5);
            }

            60% {
                opacity: 1;
                -webkit-transform: scale(1.2);
            }

            100% {
                -webkit-transform: scale(1);
            }
        }

        @-moz-keyframes cd-bounce-1 {
            0% {
                opacity: 0;
                -moz-transform: scale(0.5);
            }

            60% {
                opacity: 1;
                -moz-transform: scale(1.2);
            }

            100% {
                -moz-transform: scale(1);
            }
        }

        @-o-keyframes cd-bounce-1 {
            0% {
                opacity: 0;
                -o-transform: scale(0.5);
            }

            60% {
                opacity: 1;
                -o-transform: scale(1.2);
            }

            100% {
                -o-transform: scale(1);
            }
        }

        @keyframes cd-bounce-1 {
            0% {
                opacity: 0;
                -webkit-transform: scale(0.5);
                -moz-transform: scale(0.5);
                -ms-transform: scale(0.5);
                -o-transform: scale(0.5);
                transform: scale(0.5);
            }

            60% {
                opacity: 1;
                -webkit-transform: scale(1.2);
                -moz-transform: scale(1.2);
                -ms-transform: scale(1.2);
                -o-transform: scale(1.2);
                transform: scale(1.2);
            }

            100% {
                opacity: 1;
                -webkit-transform: scale(1);
                -moz-transform: scale(1);
                -ms-transform: scale(1);
                -o-transform: scale(1);
                transform: scale(1);
            }
        }

        /* Bounce 2 */
        @-webkit-keyframes cd-bounce-2 {
            0% {
                opacity: 0;
                -webkit-transform: translateX(-100px);
            }

            60% {
                opacity: 1;
                -webkit-transform: translateX(20px);
            }

            100% {
                -webkit-transform: translateX(0);
            }
        }

        @-moz-keyframes cd-bounce-2 {
            0% {
                opacity: 0;
                -moz-transform: translateX(-100px);
            }

            60% {
                opacity: 1;
                -moz-transform: translateX(20px);
            }

            100% {
                -moz-transform: translateX(0);
            }
        }

        @-o-keyframes cd-bounce-2 {
            0% {
                opacity: 0;
                -o-transform: translateX(-100px);
            }

            60% {
                opacity: 1;
                -o-transform: translateX(20px);
            }

            100% {
                opacity: 1;
                -o-transform: translateX(0);
            }
        }

        @keyframes cd-bounce-2 {
            0% {
                opacity: 0;
                -webkit-transform: translateX(-100px);
                -moz-transform: translateX(-100px);
                -ms-transform: translateX(-100px);
                -o-transform: translateX(-100px);
                transform: translateX(-100px);
            }

            60% {
                opacity: 1;
                -webkit-transform: translateX(20px);
                -moz-transform: translateX(20px);
                -ms-transform: translateX(20px);
                -o-transform: translateX(20px);
                transform: translateX(20px);
            }

            100% {
                opacity: 1;
                -webkit-transform: translateX(0);
                -moz-transform: translateX(0);
                -ms-transform: translateX(0);
                -o-transform: translateX(0);
                transform: translateX(0);
            }
        }

        /* Dropdown */
        @-webkit-keyframes dropdownOpen {
            0% {
                opacity: 0;
                -webkit-transform: scale(0);
            }

            100% {
                -webkit-transform: scale(1);
            }
        }

        @-moz-keyframes dropdownOpen {
            0% {
                opacity: 0;
                -moz-transform: scale(0);
            }

            100% {
                -moz-transform: scale(1);
            }
        }

        @-o-keyframes dropdownOpen {
            0% {
                opacity: 0;
                -o-transform: scale(0);
            }

            100% {
                -o-transform: scale(1);
            }
        }

        @keyframes dropdownOpen {
            0% {
                opacity: 0;
                -webkit-transform: scale(0);
                -moz-transform: scale(0);
                -ms-transform: scale(0);
                -o-transform: scale(0);
                transform: scale(0);
            }

            100% {
                opacity: 1;
                -webkit-transform: scale(1);
                -moz-transform: scale(1);
                -ms-transform: scale(1);
                -o-transform: scale(1);
                transform: scale(1);
            }
        }

        /* Progressbar Animated */
        @-webkit-keyframes animationProgress {
            from {
                width: 0;
            }
        }

        @keyframes animationProgress {
            from {
                width: 0;
            }
        }

        /* Portlets loader */
        @-webkit-keyframes loaderAnimate {
            0% {
                -webkit-transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(220deg);
            }
        }

        @-moz-keyframes loaderAnimate {
            0% {
                -moz-transform: rotate(0deg);
            }

            100% {
                -moz-transform: rotate(220deg);
            }
        }

        @-o-keyframes loaderAnimate {
            0% {
                -o-transform: rotate(0deg);
            }

            100% {
                -o-transform: rotate(220deg);
            }
        }

        @keyframes loaderAnimate {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(220deg);
            }
        }

        @-webkit-keyframes loaderAnimate2 {
            0% {
                box-shadow: inset #555 0 0 0 8px;
                -webkit-transform: rotate(-140deg);
            }

            50% {
                box-shadow: inset #555 0 0 0 2px;
            }

            100% {
                box-shadow: inset #555 0 0 0 8px;
                -webkit-transform: rotate(140deg);
            }
        }

        @-moz-keyframes loaderAnimate2 {
            0% {
                box-shadow: inset #555 0 0 0 8px;
                -moz-transform: rotate(-140deg);
            }

            50% {
                box-shadow: inset #555 0 0 0 2px;
            }

            100% {
                box-shadow: inset #555 0 0 0 8px;
                -moz-transform: rotate(140deg);
            }
        }

        @-o-keyframes loaderAnimate2 {
            0% {
                box-shadow: inset #555 0 0 0 8px;
                -o-transform: rotate(-140deg);
            }

            50% {
                box-shadow: inset #555 0 0 0 2px;
            }

            100% {
                box-shadow: inset #555 0 0 0 8px;
                -o-transform: rotate(140deg);
            }
        }

        @keyframes loaderAnimate2 {
            0% {
                box-shadow: inset #555 0 0 0 8px;
                -webkit-transform: rotate(-140deg);
                -moz-transform: rotate(-140deg);
                -ms-transform: rotate(-140deg);
                transform: rotate(-140deg);
            }

            50% {
                box-shadow: inset #555 0 0 0 2px;
            }

            100% {
                box-shadow: inset #555 0 0 0 8px;
                -webkit-transform: rotate(140deg);
                -moz-transform: rotate(140deg);
                -ms-transform: rotate(140deg);
                transform: rotate(140deg);
            }
        }

        @keyframes loaderAnimate2 {
            0% {
                box-shadow: inset #999 0 0 0 17px;
                transform: rotate(-140deg);
            }

            50% {
                box-shadow: inset #999 0 0 0 2px;
            }

            100% {
                box-shadow: inset #999 0 0 0 17px;
                transform: rotate(140deg);
            }
        }

        @media print {

            .logo,
            .page-title,
            .breadcrumb,
            .footer {
                display: none !important;
                margin: 0px !important;
                padding: 0px !important;
            }

            .left {
                display: none;
            }

            .right-bar {
                display: none !important;
            }

            .content {
                margin-top: 0px;
                padding-top: 0px;
            }

            .content-page {
                margin-left: 0px !important;
                margin-top: 0px;
            }
        }

        .bs-example-modal {
            position: relative;
            top: auto;
            right: auto;
            bottom: auto;
            left: auto;
            z-index: 1;
            display: block;
        }

        .responsive-utilities td.is-visible {
            background-color: #d9f3ee;
            color: #01ba9a;
        }

        .icon-demo-content {
            text-align: center;
            color: #898989;
        }

        .icon-demo-content i {
            display: block;
            font-size: 28px;
            color: #2a323c;
            margin-bottom: 5px;
        }

        .icon-demo-content .col-sm-6 {
            margin-bottom: 30px;
        }

        .icon-demo-content .col-sm-6:hover i {
            color: #03a9f4;
        }

        /*

        /* ============== Buttons===================*/
        .btn {
            border-radius: 5px;
            padding: 6px 14px;
        }

        .btn-md {
            padding: 8px 18px;
        }

        .btn-group-lg>.btn,
        .btn-lg {
            padding: 10px 16px !important;
            font-size: 16px;
        }

        .btn-group-sm>.btn,
        .btn-sm {
            padding: 5px 10px !important;
        }

        .btn-group-xs>.btn,
        .btn-xs {
            padding: 1px 5px !important;
        }

        .btn-group.open .dropdown-toggle {
            -webkit-box-shadow: 0 0 0 100px rgba(0, 0, 0, 0.1) inset;
            box-shadow: 0 0 0 100px rgba(0, 0, 0, 0.1) inset;
        }

        .btn-primary,
        .btn-success,
        .btn-info,
        .btn-warning,
        .btn-danger,
        .btn-inverse,
        .btn-purple,
        .btn-pink,
        .btn-orange,
        .btn-brown,
        .btn-teal {
            color: #ffffff !important;
        }

        .btn-default {
            background-color: #ffffff;
            border-color: rgba(42, 50, 60, 0.2);
        }

        .btn-default:hover,
        .btn-default:focus,
        .btn-default:active,
        .btn-default.active,
        .btn-default.focus,
        .btn-default:active,
        .btn-default:focus,
        .btn-default:hover,
        .open>.dropdown-toggle.btn-default {
            background-color: rgba(42, 50, 60, 0.07) !important;
            border: 1px solid rgba(42, 50, 60, 0.2) !important;
        }

        .btn-primary {
            background-color: #003f6f !important;
            border: 1px solid #003f6f !important;
        }

        .btn-primary:hover,
        .btn-primary:focus,
        .btn-primary:active,
        .btn-primary.active,
        .btn-primary.focus,
        .btn-primary:active,
        .btn-primary:focus,
        .btn-primary:hover,
        .open>.dropdown-toggle.btn-primary {
            background-color: #0398db !important;
            border: 1px solid #0398db !important;
        }

        .btn-success {
            background-color: #01ba9a !important;
            border: 1px solid #01ba9a !important;
        }

        .btn-success:hover,
        .btn-success:focus,
        .btn-success:active,
        .btn-success.active,
        .btn-success.focus,
        .btn-success:active,
        .btn-success:focus,
        .btn-success:hover,
        .open>.dropdown-toggle.btn-success {
            background-color: #01a185 !important;
            border: 1px solid #01a185 !important;
        }

        .btn-info {
            background-color: #18bae2 !important;
            border: 1px solid #18bae2 !important;
        }

        .btn-info:hover,
        .btn-info:focus,
        .btn-info:active,
        .btn-info.active,
        .btn-info.focus,
        .btn-info:active,
        .btn-info:focus,
        .btn-info:hover,
        .open>.dropdown-toggle.btn-info {
            background-color: #16a7cb !important;
            border: 1px solid #16a7cb !important;
        }

        .btn-warning {
            background-color: #f8ca4e !important;
            border: 1px solid #f8ca4e !important;
        }

        .btn-warning:hover,
        .btn-warning:focus,
        .btn-warning:active,
        .btn-warning.active,
        .btn-warning.focus,
        .btn-warning:active,
        .btn-warning:focus,
        .btn-warning:hover,
        .open>.dropdown-toggle.btn-warning {
            background-color: #f7c335 !important;
            border: 1px solid #f7c335 !important;
        }

        .btn-danger {
            background-color: #f62f37 !important;
            border: 1px solid #f62f37 !important;
        }

        .btn-danger:active,
        .btn-danger:focus,
        .btn-danger:hover,
        .btn-danger.active,
        .btn-danger.focus,
        .btn-danger:active,
        .btn-danger:focus,
        .btn-danger:hover,
        .open>.dropdown-toggle.btn-danger {
            background-color: #f5171f !important;
            border: 1px solid #f5171f !important;
        }

        .btn-dark {
            background-color: #2a323c !important;
            border: 1px solid #2a323c !important;
            color: #ffffff;
        }

        .btn-dark:hover,
        .btn-dark:focus,
        .btn-dark:active,
        .btn-dark.active,
        .btn-dark.focus,
        .btn-dark:active,
        .btn-dark:focus,
        .btn-dark:hover,
        .open>.dropdown-toggle.btn-dark {
            background-color: #20262d !important;
            border: 1px solid #20262d !important;
            color: #ffffff;
        }

        .btn-link {
            color: #2a323c;
        }

        .btn-link:hover {
            color: #03a9f4;
        }

        .fileupload {
            overflow: hidden;
            position: relative;
        }

        .fileupload input.upload {
            cursor: pointer;
            filter: alpha(opacity=0);
            font-size: 20px;
            margin: 0;
            opacity: 0;
            padding: 0;
            position: absolute;
            right: 0;
            top: 0;
        }

        /* ==============Maintenance===================*/
        .user-card p.info-text {
            line-height: 26px;
            margin-top: 15px;
        }

        .card.direccion {
            padding: 20px;
            border: 1px solid #ffffff;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        /*File: Responsive*/
        @media only screen and (max-width: 6000px) and (min-width: 700px) {
            .wrapper.right-bar-enabled .right-bar {
                right: 0;
                z-index: 99;
            }
        }

        @media (min-width: 768px) and (max-width: 991px) {
            body {
                overflow-x: hidden;
            }
        }

        @media (max-width: 767px) {
            body {
                overflow-x: hidden;
            }

            .content-page {
                margin-left: 0 !important;
            }

            .enlarged .left.side-menu {
                margin-left: -75px;
            }

            .mobile-sidebar {
                left: 0;
            }

            .mobile-content {
                left: 250px;
                right: -250px;
            }

            .wrapper-page {
                width: 90%;
            }

            .navbar-nav .open .dropdown-menu {
                background-color: #ffffff;
                box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.26);
                left: auto;
                position: absolute;
                right: 0;
            }

            .footer {
                left: 0 !important;
            }

            .side-menu.left,
            .sidebar-inner {
                overflow: scroll !important;
            }
        }

        @media (max-width: 620px) {
            .topbar-left {
                width: 70px !important;
            }

            .logo {
                display: none !important;
            }

            .logo-sm {
                display: inline-block !important;
            }
        }

        @media (max-width: 480px) {
            .side-menu {
                z-index: 10 !important;
            }

            .button-menu-mobile {
                display: block;
            }

            .search-bar {
                display: none !important;
            }
        }

        @media (max-width: 420px) {
            .hide-phone {
                display: none !important;
            }
        }
    </style>
</head>

<body>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-sm-6">
                    <div class="card direccion">
                        <h4 class="card-header">OFICINA PRINCIPAL</h4>
                        <div class="card-body">
                            <h5 class="card-address" style="margin-bottom:0;">
                                <i class="fa fa-map-marker"></i>Av. P. Thouars Nro. 5056
                            </h5>
                            <p class="text-muted">
                                <i class="fa fa-map-marker"></i> Perú, Lima, Miraflores
                            </p>
                            <p><i class="fa fa-phone"></i> (01) 242 3637</p>
                            <a href="https://goo.gl/maps/2CLdgq57pUz3Xi737" target="_blank" class="btn btn-lg btn-primary">Abrir mapa <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                <!-- <div class="col-sm-6">
                    <div class="card direccion">
                        <h4 class="card-header">OFICINA COMERCIAL</h4>
                        <div class="card-body">
                            <h5 class="card-address" style="margin-bottom:0;">
                                <i class="fa fa-map-marker"></i> Av. Petit
                                Thouars 5056 Miraflores
                            </h5>
                            <p class="text-muted">
                                <i class="fa fa-map-marker"></i> A media
                                cuadra de la Av. Angamos
                            </p>
                            <p>
                                <i class="fa fa-phone"></i> (01) 242 3634 -
                                (01) 242 3637
                            </p>
                            <a href="https://goo.gl/maps/qb859Y4hM5Tym4yd7" target="_blank" class="btn btn-lg btn-primary">Abrir mapa <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</body>

</html>