<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    {{-- @if ($setting && $setting->image)
        <title>{{ $setting->site_title }}</title>
        <link rel="icon" type="image/x-icon" href="{{ $setting->image_path }}" />
    @else
        <title>{{ config('app.name', 'Travel Portal') }}</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('front_assets/img/logo.png') }}" />
    @endif --}}

    {{-- @if ($setting && $setting->description)
        <meta name="description" content="{{ $setting->description }}">
    @endif --}}

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://cdn.jsdelivr.net/npm/boxicons/css/boxicons.min.css" rel="stylesheet">

    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    {{-- <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" /> --}}

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}" />
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}">



    <script src="{{ asset('assets/js/config.js') }}"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.2.0/chart.min.js" />


    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.0/dist/chart.umd.min.js"></script>

    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">


    <style>
        .dataTables_filter {
            margin-bottom: 5px;
            font-size: 13px;
        }

        .table.dataTable {
            width: 100% !important;
        }

        .dataTables_paginate,
        .dataTables_info,
        .dataTables_length {
            font-size: 13px;
        }

        .paginate_button.current {
            font-size: 12px;
        }

        .paginate_button.current:hover {
            font-size: 12px;
        }

        .paginate_button.next {
            font-size: 12px;
        }

        .paginate_button.next:hover {
            font-size: 12px;
        }
    </style>
    @stack('custom_css')
</head>

<body>
