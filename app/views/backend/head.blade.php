@section('head')
    <meta charset="UTF-8">
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
    <title>{{__($title)}} {{Trans::_t(__(Config::get('settings.admin_title')))}}</title>
    <link rel="icon" href="http://www.puskice.org/repo/images/favicon.ico" type="image/x-icon">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- bootstrap 3.0.2 -->
    <link href="{{URL::asset('assets/admin/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="{{URL::asset('assets/admin/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="{{URL::asset('assets/admin/css/ionicons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <!-- <link href="{{URL::asset('assets/admin/css/morris/morris.css')}}" rel="stylesheet" type="text/css" /> -->
    <!-- jvectormap -->
    <link href="{{URL::asset('assets/admin/css/jvectormap/jquery-jvectormap-1.2.2.css')}}" rel="stylesheet" type="text/css" />
    <!-- fullCalendar -->
    <link href="{{URL::asset('assets/admin/css/fullcalendar/fullcalendar.css')}}" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="{{URL::asset('assets/admin/css/daterangepicker/daterangepicker-bs3.css')}}" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="{{URL::asset('assets/admin/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{URL::asset('assets/admin/css/AdminLTE.css')}}" rel="stylesheet" type="text/css" />

    <!-- jQuery 2.0.2 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="{{URL::asset('assets/admin/js/bootstrap.min.js')}}" type="text/javascript"></script>

    <link rel="stylesheet" type="text/css" href="{{URL::asset('assets/admin/fancybox/jquery.fancybox.css')}}" media="screen" />
    <script type="text/javascript" src="{{URL::asset('assets/admin/fancybox/jquery.fancybox.pack.js')}}"></script>

    <link rel="stylesheet" type="text/css" href="{{URL::asset('assets/admin/chosen/chosen.css')}}" media="screen" />
    <script type="text/javascript" src="{{URL::asset('assets/admin/chosen/chosen.jquery.min.js')}}"></script>

    <link rel="stylesheet" type="text/css" href="{{URL::asset('assets/admin/datepicker/bootstrap-datetimepicker.min.css')}}" media="screen" />
    <script type="text/javascript" src="{{URL::asset('assets/admin/datepicker/moment.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('assets/admin/datepicker/bootstrap-datetimepicker.min.js')}}"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
@stop