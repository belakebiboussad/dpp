<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="and Validation" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $html_title or 'Dossier Patient' }}</title>
     <meta name="description" content="{{ $html_description or ' Dossier Patient' }}" />
    <meta name="csrf-token" content="{{csrf_token()}}">

   <!-- app.css is bootstrap.css (slightly modified by Ace template) compiled with less -->
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/font-awesome.css') }}" rel="stylesheet">
    <!-- text fonts -->
    <link rel="stylesheet" href="{{ asset('/css/ace-fonts.css') }}" />

    <!-- ace styles -->
    <link rel="stylesheet" href="{{ asset('/css/ace.css') }}" class="ace-main-stylesheet" id="main-ace-style" />
    <link rel="stylesheet" href="{{ asset('/css/select2.min.css') }}" />
    <!--[if lte IE 9]>
    <link rel="stylesheet" href="
    {{-- {{ asset('/css/ace-part2.css') }}" class="ace-main-stylesheet" /> --}}
    <![endif]-->

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="{{ asset('/css/ace-ie.css') }}" />
    <![endif]-->

    <!-- inline styles related to this page -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/datatables.css') }}"/>
    <link rel="stylesheet" href="{{ asset('/css/chosen.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/bootstrap-datepicker3.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/daterangepicker.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap-multiselect.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/wfmi-style.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap-toggle.min.css') }}">

       <!-- ace settings handler -->
    <script src="{{ asset('/js/ace-extra.min.js') }}"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
</head>