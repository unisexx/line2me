<!DOCTYPE html>

<!--

This is a starter template page. Use this page to start your new project from

scratch. This page gets rid of all links and provides the needed markup only.

-->

<html>

<head>
  <base href="{{ url('/') }}/"  />
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ระบบจัดการข้อมูล</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="AdminLTE-2.4.2/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="AdminLTE-2.4.2/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="AdminLTE-2.4.2/bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="AdminLTE-2.4.2/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="AdminLTE-2.4.2/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="AdminLTE-2.4.2/dist/css/skins/skin-blue.min.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <style>
    .panel .has-error{background:#dd4b39;}
  </style>
</head>

<!--

BODY TAG OPTIONS:

=================

Apply one or more of the following classes to get the

desired effect

|---------------------------------------------------------|

| SKINS         | skin-blue                               |

|               | skin-black                              |

|               | skin-purple                             |

|               | skin-yellow                             |

|               | skin-red                                |

|               | skin-green                              |

|---------------------------------------------------------|

|LAYOUT OPTIONS | fixed                                   |

|               | layout-boxed                            |

|               | layout-top-nav                          |

|               | sidebar-collapse                        |

|               | sidebar-mini                            |

|---------------------------------------------------------|

-->

<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">



<!-- Header -->

@include('include.adminlte.header')



<!-- Left Menu -->

@include('include.adminlte.left_menu')



  



  <!-- Content Wrapper. Contains page content -->

  @yield('content')

  <!-- /.content-wrapper -->



  



  <!-- Main Footer -->

  @include('include.adminlte.footer')



  <!-- Right Sidebar -->

  @include('include.adminlte.right_sidebar')





  <!-- Add the sidebar's background. This div must be placed

  immediately after the control sidebar -->

  <div class="control-sidebar-bg"></div>

</div>

<!-- ./wrapper -->





<!-- REQUIRED JS SCRIPTS -->



<!-- jQuery 3 -->

<script src="AdminLTE-2.4.2/bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap 3.3.7 -->

<script src="AdminLTE-2.4.2/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- AdminLTE App -->

<script src="AdminLTE-2.4.2/dist/js/adminlte.min.js"></script>



<!-- DataTables -->

<script src="AdminLTE-2.4.2/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>

<script src="AdminLTE-2.4.2/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<!-- SlimScroll -->

<script src="AdminLTE-2.4.2/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>

<!-- FastClick -->

<script src="AdminLTE-2.4.2/bower_components/fastclick/lib/fastclick.js"></script>



<!-- Optionally, you can add Slimscroll and FastClick plugins.

     Both of these plugins are recommended to enhance the

     user experience. -->



{!! js_notify() !!}


<script>

$.ajaxSetup({

  headers: {

      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

      }

    });

</script>

  

<script>

  $(function () {

    $('#tableSticker').DataTable();

  })

</script>

</body>

</html>