<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->

<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> CRUD | RATUL HASAN</title>

        <link rel="shortcut icon" href="{{ asset('public/favicon.ico') }}" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    {{--<link href="{{ asset('public/admin-panel/img/logo.png') }}" rel="icon" />--}}
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('public/admin-panel/css/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('public/admin-panel/css/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('public/admin-panel/css/Ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('public/admin-panel/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('public/admin-panel/css/_all-skins.min.css') }}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

        <!-- REQUIRED JS SCRIPTS -->
        <!-- jQuery 3 -->
        <script src="{{ asset('public/admin-panel/js/jquery/dist/jquery.min.js') }}"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="{{ asset('public/admin-panel/css/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <!-- FastClick -->
        <script src="{{ asset('public/admin-panel/js/fastclick/lib/fastclick.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('public/admin-panel/js/adminlte.min.js') }}"></script>
        <!-- SlimScroll -->
        <script src="{{ asset('public/admin-panel/js/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
        <!-- REQUIRED JS SCRIPTS -->
        <!-- Optionally, you can add Slimscroll and FastClick plugins.
             Both of these plugins are recommended to enhance the
             user experience. -->
  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <style>
            .alert1-success {
                /*position: absolute;*/
                z-index:99999;
                vertical-align:top;
                color: #ffffff;
                background-color: #67BA5B;
                border-color: #d6e9c6;
                /*background-color: #ebf8a4;
                border-color: #a2d246;*/
                overflow: hidden;
                right: 0;
                left: 230px;
                padding: 15px;
                position: fixed;
            }
            .alert1-danger {
                position: absolute;
                z-index:99999;
                vertical-align:top;
                color: #ffffff;
                background-color: #a94442;
                border-color: #ebccd1;
                overflow: hidden;
                right: 0;
                left: 230px;
                padding: 15px;
            }
            .box {
                box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
                transition: all 0.3s cubic-bezier(.25,.8,.25,1);
            }
            .required{
                color: red;
            }
            tr:hover td {
                background: #FFFF95 !important;
            }
            .table thead > tr > th, .table tbody > tr > td, .table tfoot > tr > td {
                padding: 2px;
            }
            .table thead > tr > th {
                padding: 5px;
            }
            .label{
                line-height: 3;
            }
            #loading {
                background-color: #00BFBA;
                color: white;
                display: none;
                left: 0;
                opacity: 1;
                position: fixed;
                text-align: center;
                top: 0;
                width: 100%;
                z-index: 25000;
            }
            #error_loading {
                background-color: #ff0000;
                color: white;
                display: none;
                left: 0;
                opacity: 1;
                position: fixed;
                text-align: center;
                top: 0;
                width: 100%;
                z-index: 25000;
            }
            .overlayDiv {
                background-color: #222;
                height: 1000px;
                left: 0;
                opacity: 0.7;
                position: absolute;
                top: 0;
                width: 100%;
                z-index: 100;
                cursor:wait;
            }
            /*.box:hover {
                !*box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);*!
                box-shadow: 0 8px 10px rgba(0,0,0,0.25), 0 5px 5px rgba(0,0,0,0.22);
            }*/
        </style>

</head>
<body class="skin-blue sidebar-mini fixed">
<div id="loading" style="display: none;">
    <h3>Loading...Please wait</h3>
    <div class="overlayDiv"></div>
</div>
<div id="error_loading" style="display: none;">
    <h3>Error connection...Please refresh the page.</h3>
    <div class="overlayDiv"></div>
</div>
<div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">
      @include('admin.pages.header')
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
        @include('admin.pages.navbar')
    <!-- /.sidebar -->
    </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
      <section class="content-header">

          <h1>
              CRUD
          </h1>
          <ol class="breadcrumb">
              <li><a href="{{ (Request::segment(1)) }}"><i class="fa fa-dashboard"></i> {{ ucwords(Request::segment(1)) }}</a></li>
          </ol>
      </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
        @yield('main_content')

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- Default to the left -->
    <strong>Copyright &copy; 2017 <a href="https://besofty.com" target="_blank">BeSofty</a>.</strong> All rights reserved.
      <!-- To the right -->
      <div class="pull-right hidden-xs">
          {{--Anything you want--}}This page took {{ (microtime(true) - LARAVEL_START) }} seconds to render
      </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="pull-right-container">
                    <span class="label label-danger pull-right">70%</span>
                  </span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
</body>
</html>