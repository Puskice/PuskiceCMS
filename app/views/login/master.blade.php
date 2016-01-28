<!DOCTYPE html>
<html class="bg-black">
    <head>
        @yield('head')
    </head>
    <body class="bg-black">

        @yield('form')


        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="{{Request::root()}}/assets/admin/js/bootstrap.min.js" type="text/javascript"></script>        

    </body>
</html>