<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{$title}}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css">
  <!-- Font Awesome -->
<!--   <link rel="stylesheet" href="{{asset('/adminLTE/css/font-awesome.min.css')}}">
 -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/4.4.1/collection/icon/icon.css">
  <!-- jvectormap -->

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jvectormap/2.0.4/jquery-jvectormap.min.css">
  <!-- Theme style -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.8/css/AdminLTE.css">

 <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

 <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.8/css/skins/_all-skins.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>U</b>MS</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg" style="font-size:15px !important;"><b><small>PT. Uninet Media Sakti </small></b></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown notifications-menu">
            <a href="" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
              <i class="fa fa-bell-o"></i>
              <span class="label label-primary">{{ Auth::user()->notifications->where('seen', 0)->count() }}</span>
            </a>
            <ul class="dropdown-menu">
              {{-- <li class="header">
                {{ Auth::user()->notifications->where('idusers') }}
              </li> --}}
              {{-- <li>
                <ul class="menu">
                </ul>
              </li> --}}
              <li class="footer"><a href="{{url('/notifications')}}">View all</a></li>
            </ul>
          </li>
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.8/img/avatar5.png" class="user-image" alt="User Image">
              <span class="hidden-xs">{{Auth::user()->name}}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{url('profile')}}" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">

                  <a href="{{ route('logout') }}"
                          onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();" class="btn btn-default btn-flat">Sign out
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                           @csrf
                  </form>

                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->

        </ul>
      </div>

    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.8/img/avatar5.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{Auth::user()->name}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <!-- home -->
        <li id="menu_home"><a href="{{url('home')}}"><i class="fa fa-dashboard"></i> <span>Home</span></a></li>

        <!-- master -->
        @if (Auth::user()->role_type == "GA")
          <li class="treeview" id="menu_master">
            <a href="#">
              <i class="fa fa-database"></i> <span>Master</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li id="submenu_users"><a href="{{url('users')}}"><i class="fa fa-users"></i> Users</a></li>
              <li id="submenu_categories"><a href="{{url('categories')}}"><i class="fa fa-cubes"></i> Add Categories</a></li>
              <li id="submenu_items"><a href="{{url('items')}}"><i class="fa fa-inbox"></i> Add Items</a></li>
            </ul>
          </li>
        @endif
        <!-- m -->
        {{-- <li><a href=""><i class="fa fa-circle-o text-purple"></i> <span> Micro Services</span></a></li> --}}

        <li id="menu_list_orders"><a href="{{url('orders/')}}"><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span><span>View History</span></a></li>
          @if (Auth::user()->isAdmin())
            <li class="treeview" id="menu_report">
              <a href="#">
                <i class="fa fa-bar-chart"></i> <span>Report Status Order</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li id="submenu_approved"><a href="{{url('report/')}}"><i class="fa fa-check-square"></i> <span>Report Accepted Product</span></a></li>
                <li id="submenu_failed"><a href="{{url('report/failed')}}"><i class="fa fa-times-circle" aria-hidden="true"></i>
                    <span>Report Failed Order </span></a></li>
              </ul>
            </li>
        @endif
          <li id="menu_create-orders"><a href="{{url('orders/create-new/')}}"><i class="fa fa-first-order"></i> <span>Orders</span></a></li>
          <li id="menu_history"><a href="{{url('history/'.Auth::user()->idusers)}}"><i class="glyphicon glyphicon-repeat"></i> <span>Detail Order</span></a></li>

        {{-- <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li> --}}
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @if(session('status_error'))
    <div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-ban"></i> Error!</h4>
      {{session('status_error')}}
    </div>
    @elseif(session('status_info'))
    <div class="alert alert-info alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-info"></i> Info!</h4>
      {{session('status_info')}}
    </div>
    @elseif(session('status_warning'))
    <div class="alert alert-warning alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-warning"></i> Warning!</h4>
      {{session('status_warning')}}
    </div>
    @elseif(session('status_success'))
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-check"></i> Success!</h4>
      {{session('status_success')}}
    </div>
    @elseif($errors->any())
    <div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-ban"></i> Error!</h4>
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{$error}}</li>
        @endforeach
      </ul>
    </div>
  @endif
  {!!$pagecontent!!}
  </div>
</div>

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->

<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fastclick/1.0.6/fastclick.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.8/js/adminlte.min.js"></script>
<!-- Datatables -->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<!-- Sparkline -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-sparklines/2.1.2/jquery.sparkline.min.js"></script>
<!-- jvectormap  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jvectormap/2.0.4/jquery-jvectormap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jvectormap/2.0.4/jquery-jvectormap.min.js"></script>
<!-- SlimScroll -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.8/jquery.slimscroll.min.js"></script>
<!-- ChartJS -->

</script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="dist/js/pages/dashboard2.js"></script>
 --><!-- AdminLTE for demo purposes -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.8/js/demo.js"></script>
<script type="text/javascript">
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  });
  //Date picker
 $('.datepicker').datepicker({
   autoclose: true,
   dateFormat: 'yyyy-mm-dd'
 });

</script>
<script type="text/javascript">
$(document).ready(function() {

  var empty = false;

  $( '#satu, #dua, #tiga').each(function() {

    if ( $('#satu').val().length == 0 && $('#dua').val().length == 0 && $('#tiga').val().length == 0) {
      $('#button ').attr('disabled', 'disabled');
      empty = true;

    }
    if ($('#satu').val().length == 0 && $('#dua').val().length != 0 && $('#tiga').val().length == 0) {
      $('#button ').attr('disabled', 'disabled');
      empty = true;
    }

    if ($('#satu').val().length == 0 && $('#dua').val().length == 0 && $('#tiga').val().length != 0) {
      $('#button ').attr('disabled', 'disabled');
      empty = true;
    }


    if (empty) {
      $('#button').removeAttr('href', 'disabled');
      // $('#test ').removeAttr('disabled');

    }

  });

});
$('#menu_{{$menu}}').addClass('active');
$('#submenu_{{$submenu}}').addClass('active');
</script>
</body>
</html>
