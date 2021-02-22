
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="and Validation" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
    <title>@yield('title')</title>
    <meta name="description" content="{{ $html_description or ' Dossier Patient' }}" />
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link href="{{ asset('/css/font-awesome.css') }}" rel="stylesheet"> 
    <link rel="stylesheet" href="{{ asset('/css/jquery-ui.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}" />
    <!-- text fonts -->
    <link rel="stylesheet" href="{{ asset('/css/ace-fonts.css') }}" />
    <!-- ace styles -->
    <link rel="stylesheet" href="{{ asset('/css/ace.css') }}" class="ace-main-stylesheet" id="main-ace-style" />
    <link rel="stylesheet" href="{{ asset('/css/ace-skins.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('/css/select2.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/datatables.css') }}"/>
    <link rel="stylesheet" href="{{ asset('/css/chosen.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/bootstrap-datepicker3.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/daterangepicker.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap-multiselect.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/wfmi-style.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap-toggle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/jquery.timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/fullcalendar/fullcalendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/fullcalendar/fullcalendar.print.min.css') }}" media='print'>
    <link rel="stylesheet" href="{{ asset('/css/jquery-editable-select.css') }}" media='print'>
    <link rel="stylesheet" href="{{ asset('/css/bootstrap-timepicker.min.css') }}" />
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet"href="{{ asset('/css/styles.css') }}">