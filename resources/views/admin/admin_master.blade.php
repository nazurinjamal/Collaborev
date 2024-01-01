<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Themesdesign" name="author" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.ico')}}">

        <!-- jquery.vectormap css -->
        <link href="{{ asset('backend/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css')}}" rel="stylesheet" type="text/css" />

        <!-- DataTables -->
        <link href="{{ asset('backend/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="{{ asset('backend/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />  

        <!-- Bootstrap Css -->
        <link href="{{ asset('backend/assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ asset('backend/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{ asset('backend/assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />

        <!-- Plugin css -->
        <link rel="stylesheet" href="{{ asset('backend/assets/libs/@fullcalendar/core/main.min.css')}}" type="text/css">
        <link rel="stylesheet" href="{{ asset('backend/assets/libs/@fullcalendar/daygrid/main.min.css')}}" type="text/css">
        <link rel="stylesheet" href="{{ asset('backend/assets/libs/@fullcalendar/bootstrap/main.min.css')}}" type="text/css">
        <link rel="stylesheet" href="{{ asset('backend/assets/libs/@fullcalendar/timegrid/main.min.css')}}" type="text/css">
    </head>

    <body data-topbar="dark">
    
    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">

            
            @include('admin.body.header')

            <!-- ========== Left Sidebar Start ========== -->
            @include('admin.body.sidebar')
            <!-- Left Sidebar End -->

            

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

               @yield('admin')
                <!-- End Page-content -->
               
                <!-- @include('admin.body.footer') -->
                
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <!-- Right Sidebar -->
       
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        <script src="{{ asset('backend/assets/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{ asset('backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{ asset('backend/assets/libs/metismenu/metisMenu.min.js')}}"></script>
        <script src="{{ asset('backend/assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{ asset('backend/assets/libs/node-waves/waves.min.js')}}"></script>

        
        <!-- apexcharts -->
        <script src="{{ asset('backend/assets/libs/apexcharts/apexcharts.min.js')}}"></script>

        <!-- jquery.vectormap map -->
        <script src="{{ asset('backend/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
        <script src="{{ asset('backend/assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js')}}"></script>

        <!-- Required datatable js -->
        <script src="{{ asset('backend/assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{ asset('backend/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
        
        <!-- Responsive examples -->
        <script src="{{ asset('backend/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
        <script src="{{ asset('backend/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>

        <script src="{{ asset('backend/assets/js/pages/dashboard.init.js')}}"></script>

        <!-- App js -->
        <script src="{{ asset('backend/assets/js/app.js')}}"></script>

                <!-- plugin js -->
                <script src="{{ asset('backend/assets/libs/moment/min/moment.min.js')}}"></script>
        <script src="{{ asset('backend/assets/libs/jquery-ui-dist/jquery-ui.min.js')}}"></script>
        <script src="{{ asset('backend/assets/libs/@fullcalendar/core/main.min.js')}}"></script>
        <script src="{{ asset('backend/assets/libs/@fullcalendar/bootstrap/main.min.js')}}"></script>
        <script src="{{ asset('backend/assets/libs/@fullcalendar/daygrid/main.min.js')}}"></script>
        <script src="{{ asset('backend/assets/libs/@fullcalendar/timegrid/main.min.js')}}"></script>
        <script src="{{ asset('backend/assets/libs/@fullcalendar/interaction/main.min.js')}}"></script>

        <!-- Calendar init -->
        <script src="{{ asset('backend/assets/js/pages/calendar.init.js')}}"></script>

        <script src="{{ asset('backend/assets/js/app.js')}}"></script>

        <script src="{{ asset('backend/assets/libs/jquery-knob/jquery.knob.min.js')}}"></script> 

        <script src="{{ asset('backend/assets/js/pages/jquery-knob.init.js')}}"></script> 
    </body>

</html>