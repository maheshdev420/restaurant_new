<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Dashboard 2</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('/admin-assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('/admin-assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <!--   <link rel="stylesheet" href="{{ asset('/admin-assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/admin-assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}"> -->

    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('/admin-assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/admin-assets/dist/css/adminlte.min.css') }}">
    <!-- TOASTR -->
    <link rel="stylesheet" href="{{ asset('/admin-assets/plugins/toastr/toastr.min.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('/admin-assets/plugins/summernote/summernote-bs4.min.css') }}">

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <!-----Custom Style Sheet------->
    <link rel="stylesheet" href="{{ asset('/admin-assets/assets/css/style.css') }}">



    <!-- jQuery -->
    <script src="{{ asset('/admin-assets/plugins/jquery/jquery.min.js') }}"></script>


</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="{{ asset('/admin-assets/dist/img/AdminLTELogo.png') }}"
                alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>

            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->

                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-comments"></i>
                        <span class="badge badge-danger navbar-badge">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="{{ asset('/admin-assets/dist/img/user1-128x128.jpg') }}" alt="User Avatar"
                                    class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Brad Diesel
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">Call me whenever you can...</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">

                            <!-- Message Start -->
                            <div class="media">
                                <img src="{{ asset('/admin-assets/dist/img/user8-128x128.jpg') }}" alt="User Avatar"
                                    class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        John Pierce
                                        <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">I got your message bro</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->

                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="{{ asset('/admin-assets/dist/img/user3-128x128.jpg') }}" alt="User Avatar"
                                    class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Nora Silvester
                                        <span class="float-right text-sm text-warning"><i
                                                class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">The subject goes here</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                    </div>
                </li>


                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>


                <!----Legacy User menu---->
                <li class="nav-item dropdown user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        @if (Auth::guard('web')->check() == true && Auth::guard('web')->user()->pro_img != null)
                            <img src="{{ asset('/admin-assets/assets/img/profile_img/admin/') }}/{{ auth()->user()->pro_img }}"
                                class="user-image img-circle elevation-2" alt="User Image">
                        @else
                            <img src="{{ asset('/admin-assets/assets/img/profile_img/admin/admin.png') }}"
                                class="user-image img-circle elevation-2" alt="User Image">
                        @endif
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <!-- User image -->
                        <li class="user-header bg-primary">
                            @if (Auth::guard('web')->check() == true && Auth::guard('web')->user()->pro_img != null)
                                <img src="{{ asset('/admin-assets/assets/img/profile_img/admin/') }}/{{ auth()->user()->pro_img }}"
                                    class="img-circle elevation-2" alt="User Image">
                            @else
                                <img src="{{ asset('/admin-assets/assets/img/profile_img/admin/admin.png') }}"
                                    class="img-circle elevation-2" alt="User Image">
                            @endif

                            <p> {{ auth()->user()->name }} </p>
                        </li>
                        <!-- Menu Body -->
                        {{-- <li class="user-body">
              <div class="row">
                <div class="col-4 text-center">
                  <a href="#">Followers</a>
                </div>
                <div class="col-4 text-center">
                  <a href="#">Sales</a>
                </div>
                <div class="col-4 text-center">
                  <a href="#">Friends</a>
                </div>
              </div>
              <!-- /.row -->
            </li> --}}
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <a href="{{ route('admin.getinfo') }}" class="btn btn-default btn-flat">Profile</a>
                            <a href="{{ route('admin.logout') }}" class="btn btn-default btn-flat float-right">Sign
                                out</a>
                        </li>
                    </ul>
                </li>


            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">


            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        @if (Auth::guard('web')->check() == true && Auth::guard('web')->user()->pro_img != null)
                            <img src="{{ asset('/admin-assets/assets/img/profile_img/admin/') }}/{{ auth()->user()->pro_img }}"
                                class="img-circle elevation-2" alt="User Image">
                        @else
                            <img src="{{ asset('/admin-assets/assets/img/profile_img/admin/admin.png') }}"
                                class="img-circle elevation-2" alt="User Image">
                        @endif
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ auth()->user()->name }}</a>
                    </div>
                </div>

                @if (Session::has('flash-success'))
                    <p class="admin-toastr" onclick="toastr_success('{{ session('flash-success') }}')"></p>
                @endif
                @if (Session::has('flash-error'))
                    <p class="admin-toastr" onclick="toastr_danger('{{ session('flash-error') }}')"></p>
                @endif


                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->


                        <li class="nav-item ">
                            <a href="{{ route('admin.dashboard') }}"
                                class="nav-link {{ Route::currentRouteName() == 'admin.dashboard' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        @if (Auth::guard('web')->check() == true)
                            <!----All-Users----->
                            <li class="nav-item">
                                <a href="{{ route('all_user') }}"
                                    class="nav-link {{ Route::currentRouteName() == 'all_user' ? 'active' : '' }}">
                                    <i class="nav-icon fa fa-users"></i>
                                    <p>Users</p>
                                </a>
                            </li>

                            <!----All-Subadmin----->
                            <li
                                class="nav-item {{ Route::currentRouteName() == 'admin.all_subadmin' ? 'menu-open' : '' }}">
                                <a href="#"
                                    class="nav-link {{ Route::currentRouteName() == 'admin.all_subadmin' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-solid fa-user-shield"></i>
                                    <p>
                                        Subadmin
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href=""
                                            class="nav-link {{ Route::currentRouteName() == 'admin.all_subadmin' ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>All Subadmin</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif

                        <!----All-Blogs----->
                        {{-- <li class="nav-item">
                            <a href="{{ route('all_blog') }}"
                                class="nav-link {{ Route::currentRouteName() == 'all_blog' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-solid fa-blog"></i>
                                <p>Blogs</p>
                            </a>
                        </li> --}}

                        <!----All-Pages----->
                        {{-- <li class="nav-item">
                            <a href=""
                                class="nav-link {{ Route::currentRouteName() == 'allpageslist' ? 'active' : '' }}">
                                <i class="nav-icon fa fa-sticky-note"></i>
                                <p>Pages</p>
                            </a>
                        </li> --}}

                        <!----New-Category----->
                        <li class="nav-item">
                            <a href="{{ route('allcategorieslist') }}"
                                class="nav-link {{ Route::currentRouteName() == 'allcategorieslist' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tags"></i>
                                <p>New Categories</p>
                            </a>
                        </li>
                        <!----Tags----->
                        {{-- <li class="nav-item ">
                            <a href="" class="nav-link">
                                <i class="nav-icon fas fa-tags"></i>
                                <p>All Tags
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href=""
                                        class="nav-link {{ Route::currentRouteName() == 'alltagslist' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tags</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Sub Tags</p>
                                    </a>
                                </li>
                            </ul>
                        </li> --}}




                        <!----All Categories----->
                        {{-- <li
                            class="nav-item {{ Route::currentRouteName() == 'get_parent_categories' || Route::currentRouteName() == 'get_child_categories' || Route::currentRouteName() == 'get_subchild_categories' ? 'menu-open' : '' }}">
                            <a href=""
                                class="nav-link {{ Route::currentRouteName() == 'get_parent_categories' || Route::currentRouteName() == 'get_child_categories' || Route::currentRouteName() == 'get_subchild_categories' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tags"></i>
                                <p>Categories
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href=""
                                        class="nav-link {{ Route::currentRouteName() == 'get_parent_categories' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Parent Category</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href=""
                                        class="nav-link {{ Route::currentRouteName() == 'get_child_categories' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Child Category</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href=""
                                        class="nav-link {{ Route::currentRouteName() == 'get_subchild_categories' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Sub-Child Category</p>
                                    </a>
                                </li>
                            </ul>
                        </li> --}}

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield ("content")
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <!-- <footer class="main-footer">
      <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.2.0-rc
      </div>
    </footer> -->
    </div>
    <!-- ./wrapper -->

    <script type="text/javascript">
        var base_url = "<?php echo url('') . '/'; ?>"
        var csrf_token = "{{ csrf_token() }}"
    </script>

    <!-- REQUIRED SCRIPTS -->

    <!-- Bootstrap -->
    <script src="{{ asset('/admin-assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>


    <!-- overlayScrollbars -->
    <script src="{{ asset('/admin-assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('/admin-assets/dist/js/adminlte.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('/admin-assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- jquery-validation -->
    <script src="{{ asset('/admin-assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>

    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <!-- <script src="{{ asset('/admin-assets/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
<script src="{{ asset('/admin-assets/plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('/admin-assets/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
<script src="{{ asset('/admin-assets/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script> -->
    <!-- ChartJS -->
    <script src="{{ asset('/admin-assets/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- toastr -->
    <script src="{{ asset('/admin-assets/plugins/toastr/toastr.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('/admin-assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/admin-assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/admin-assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('/admin-assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/admin-assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('/admin-assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/admin-assets/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('/admin-assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('/admin-assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('/admin-assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('/admin-assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('/admin-assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('/admin-assets/assets/js/adminjs.js') }}"></script>

    <!-- SweetAlert2 -->
    <!-- <script src="{{ asset('/admin-assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>





</body>

</html>
