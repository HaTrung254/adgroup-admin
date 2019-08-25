<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content={{csrf_token()}}>

    <title>ADGROUP</title>
    <link rel="stylesheet" href="@asset('/css/app.css')"></link>
    <link rel="stylesheet" href="@asset('/dist/plugins/font-awesome/css/font-awesome.min.css')">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')">
    <!-- Theme style -->
    <link rel="stylesheet" href="@asset('/dist/css/adminlte.min.css')">
    <!-- iCheck -->
    <link rel="stylesheet" href="@asset('/dist/plugins/iCheck/flat/blue.css')">
    <!-- Morris chart -->
    <link rel="stylesheet" href="@asset('/dist/plugins/morris/morris.css')">
    <!-- jvectormap -->
    <link rel="stylesheet" href="@asset('/dist/plugins/jvectormap/jquery-jvectormap-1.2.2.css')">
    <!-- Date Picker -->
    <link rel="stylesheet" href="@asset('/dist/plugins/datepicker/datepicker3.css')">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="@asset('/dist/plugins/daterangepicker/daterangepicker-bs3.css')">

    <link rel="stylesheet" href="@asset('/dist/plugins/summernote/css/summernote-bs4.css')">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- IonIcons -->
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <style type="text/css">
        .nav-sidebar li:nth-child({{!empty($navNumber) ? $navNumber : "1"}}) {

        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
@guest @yield('content') @else
    <div class="wrapper" id="app">
        <!-- Header -->
    @include('layouts.header')
    <!-- Sidebar -->
    @include('layouts.sidebar')
        <div class="content-wrapper">
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12" style="margin-top: 20px">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">{{ !empty($title) ? $title : "ADGROUP" }}</h3>
                                    @if(!empty($hasSearch))
                                        <div class="card-tools">
                                            <div class="input-group input-group-sm">
                                                <input type="text" name="table_search" class="form-control float-right"
                                                       placeholder="Tìm kiếm">
                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i>
                                                    </button>
                                                    <a href="{{ $routeCreate }}" style="margin-left: 10px" class="pull-right btn btn-success">
                                                        <i class="fa fa-plus"></i> Thêm
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0">
                                    @yield('content')
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                </div><!--/. container-fluid -->
            </section>
            <!-- /.content -->
        </div>

    <!-- Footer -->
        @include('layouts.footer')
    </div>
    <!-- ./wrapper -->
@endguest
<!-- jQuery -->
<script src="@asset('/dist/plugins/jquery/jquery.min.js')"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="@asset('/dist/plugins/bootstrap/js/bootstrap.bundle.min.js')"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="@asset('/dist/plugins/daterangepicker/daterangepicker.js')"></script>
<!-- datepicker -->
<script src="@asset('/dist/plugins/datepicker/bootstrap-datepicker.js')"></script>
<!-- Slimscroll -->
<script src="@asset('/dist/plugins/slimScroll/jquery.slimscroll.min.js')"></script>
<!-- FastClick -->
<script src="@asset('/dist/plugins/fastclick/fastclick.js')"></script>

<script src="@asset('/dist/plugins/summernote/js/summernote-bs4.min.js')"></script>
<!-- AdminLTE App -->
<script src="@asset('/dist/js/adminlte.js')"></script>
<script type="text/javascript">
    $(function () {
        $('.textarea').summernote();
        $('.btnDelete').click( function (e) {
            if(confirm("Bạn có chắc chắn muốn xóa?")) {
                return true;
            } else {
                e.preventDefault();
                return false;
            }
        });
        $('.nav-sidebar li:nth-child({{!empty($navNumber) ? $navNumber : "1"}}) a').addClass('active');
    })
</script>
@yield('javascript')
</body>
</html>