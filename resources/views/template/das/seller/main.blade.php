<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ isset($title) ? $title : 'BANBRAND' }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- meta content base_url --}}

    @include("template.head_include")
    
</head>

<body class="hold-transition sidebar-mini sidebar-mini layout-fixed">
    <div class="loader">
        <i class="fas fa-spinner fa-spin loader-icon"></i>
    </div>
    <div class="wrapper">
        <!-- Navbar -->

        <nav class="main-header navbar navbar-expand navbar-dark navbar-teal">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>

            </ul>

            <!-- SEARCH FORM -->
            <form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search"
                        aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Messages Dropdown Menu -->
                <li class="nav-item">
                    <a class="nav-link"  href="/logout/sellers">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </li>
                {{-- <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        Ach Rizal
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right show">
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
                </li> --}}

            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar elevation-4 sidebar-light-indigo">
            <!-- Brand Logo -->
            <a href="#" class="brand-link navbar-teal">
                <img src="{{ asset('images/banbrand.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" width="60px"
                    style="opacity: .8">
                <span class="brand-text text-white">Banbrand</span>
            </a>
            
            <!-- Sidebar -->
            @include("template.das.seller.sidebar_include")
            <!-- /.sidebar -->
        </aside>
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">{{ $title }}</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <?php $bread = explode('/', url()->current());
                            $bread = array_splice($bread, 3);
                            $links=[];
                            ?>

                            <ol class="breadcrumb float-sm-right">

                                @foreach ($bread as $key => $item)
                                    @if ($loop->last)
                                        <?php
                                        if (strpos($item, '?') == true) {
                                            $item = substr($item, 0, strpos($item, '?'));
                                        } ?>
                                        <li class="breadcrumb-item active">{{ ucwords($item) }}</li>
                                    @else
                                        <?php
                                        array_push($links, $item);
                                        $link = implode($links, '/')  ?>
                                        <li class="breadcrumb-item">
                                            <a href="/{{ $link }}">{{ ucwords($item) }}</a>
                                        </li>                           
                                    @endif
                                @endforeach
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>


            @yield("content")
        </div>
    </div>
    @include("template.footer_include")
    <script>

    </script>
</body>

</html>
