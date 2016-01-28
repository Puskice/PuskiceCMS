<!DOCTYPE html>
<html>
    <head>
        @yield('head')
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        @yield('header')
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                @yield('sidebar')
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        {{__($title)}}
                        <small><!--it all starts here--></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> {{__($title)}}</a></li>
                        <!-- <li><a href="#">Examples</a></li>
                        <li class="active">Blank page</li> -->
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    @yield('errorReporting')
                    @yield('content')

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->


        @yield('footer')
    </body>
</html>
