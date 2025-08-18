<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>EtkinlikProjesi</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('panel/assets/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('panel/assets/vendors/css/vendor.bundle.base.css')}}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{asset('panel/assets/vendors/jvectormap/jquery-jvectormap.css')}}">
    <link rel="stylesheet" href="{{asset('panel/assets/vendors/flag-icon-css/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{asset('panel/assets/vendors/owl-carousel-2/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('panel/assets/vendors/owl-carousel-2/owl.theme.default.min.css')}}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{asset('panel/assets/css/style.css')}}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{asset('panel/assets/images/favicon.png')}}"/>
</head>
<body>
<div class="container-scroller">
    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
            <a class="sidebar-brand brand-logo" href="#"><img src="{{asset('panel/assets/images/logo.svg')}}" alt="logo" /></a>
            <a class="sidebar-brand brand-logo-mini" href="#"><img src="{{asset('panel/assets/images/logo-mini.svg')}}" alt="logo" /></a>
        </div>
        <ul class="nav">
            <li class="nav-item profile">
                <div class="profile-desc">
                    <div class="profile-pic">
                        <div class="profile-name"></div>
                    </div>
                    <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
                    <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
                        <a href="#" class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-dark rounded-circle">
                                    <i class="mdi mdi-settings text-primary"></i>
                                </div>
                            </div>
                            <div class="preview-item-content">
                                <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-dark rounded-circle">
                                    <i class="mdi mdi-onepassword text-info"></i>
                                </div>
                            </div>
                            <div class="preview-item-content">
                                <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-dark rounded-circle">
                                    <i class="mdi mdi-calendar-today text-success"></i>
                                </div>
                            </div>
                            <div class="preview-item-content">
                                <p class="preview-subject ellipsis mb-1 text-small">To-do list</p>
                            </div>
                        </a>
                    </div>
                </div>
            </li>
            <li class="nav-item nav-category">
                <span class="nav-link">Navigation</span>
            </li>
            @if(Auth::check() && ( Auth::user()->role === 'admin'))

            <li class="nav-item menu-items">
                <a class="nav-link" href="{{route('admin.index')}}">
                    <span class="menu-icon">
                        <i class="mdi mdi-speedometer"></i>
                    </span>
                    <span class="menu-title">Admin Dashboard</span>
                </a>
            </li>

                    <li class="nav-item menu-items">
                        <a class="nav-link" href="{{route('admin.user-list-page')}}">
                    <span class="menu-icon">
                        <i class="mdi mdi-file-document-box"></i>
                    </span>
                            <span class="menu-title">Yetki Yönetimi</span>
                        </a>
                    </li>

            @endif
            @if(Auth::check() && ( Auth::user()->role === 'organizer'))

                <li class="nav-item menu-items">
                    <a class="nav-link" href="{{route('organizer.index')}}">
                    <span class="menu-icon">
                        <i class="mdi mdi-speedometer"></i>
                    </span>
                        <span class="menu-title">Organizasyonlarınız</span>
                    </a>
                </li>
            @endif
            <li class="nav-item menu-items">
                <a class="nav-link" href="{{route('event.index')}}">
                    <span class="menu-icon">
                        <i class="mdi mdi-playlist-play"></i>
                    </span>
                    <span class="menu-title">Kültür&Sanat Takvimi</span>
                </a>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="{{route('myRegistrations')}}">
                    <span class="menu-icon">
                        <i class="mdi mdi-table-large"></i>
                    </span>
                    <span class="menu-title">Başvurularım</span>
                </a>
            </li>
            @if(Auth::check() && (Auth::user()->role === 'organizer' ))

            <li class="nav-item menu-items">
                <a class="nav-link" href="{{route('organizer.registrations')}}">
                    <span class="menu-icon">
                        <i class="mdi mdi-chart-bar"></i>
                    </span>
                    <span class="menu-title"> Başvuru Yönetimi</span>
                </a>
            </li>

            @endif
                @if(Auth::check() && (Auth::user()->role === 'admin' ))
            <li class="nav-item menu-items">
                <a class="nav-link" href="{{route('category.createPage')}}">
                    <span class="menu-icon">
                        <i class="mdi mdi-contacts"></i>
                    </span>
                    <span class="menu-title">Kategori Oluştur</span>
                </a>
            </li>
            @endif
            <li class="nav-item menu-items">
                <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                    <span class="menu-icon">
                        <i class="mdi mdi-security"></i>
                    </span>
                    <span class="menu-title">User Pages</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="auth">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="{{route('login')}}"> Login </a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{route('register')}}"> Register </a></li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link" style="border: none; background: none; padding: 0.5rem 1rem; color: #6c7293; text-decoration: none;">
                                    <i class="mdi mdi-logout"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </li>

        </ul>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar p-0 fixed-top d-flex flex-row">
            <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
                <a class="navbar-brand brand-logo-mini" href="#"><img src="{{asset('panel/assets/images/logo-mini.svg')}}" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-menu"></span>
                </button>
                <ul class="navbar-nav w-100">

                </ul>
                <ul class="navbar-nav navbar-nav-right">

                    <li class="nav-item dropdown d-none d-lg-block">
                        @if(Auth::check() && (Auth::user()->role === 'organizer'))
                        <a class="nav-link btn btn-success create-new-button" id="createbuttonDropdown" aria-expanded="false" href="{{route('events.createPage')}}">+ Yeni Etkinlik Oluştur</a>
                        @endif
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="createbuttonDropdown">

                            <div class="preview-item-content">
                                <p class="preview-subject ellipsis mb-1">UI Development</p>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item nav-settings d-none d-lg-block">
                        <a class="nav-link" href="#">
                            <i class="mdi mdi-view-grid"></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown border-left">
                        <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-email"></i>
                            <span class="count bg-success"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail"></div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item"></a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="userDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-account-circle"></i>
                            <span class="ml-2">{{ Auth::user()->name ?? 'Giriş Yapınız' }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="{{ route('profile.show') }}">
                                <i class="mdi mdi-account text-primary"></i>
                                Profil
                            </a>
                            <div class="dropdown-divider"></div>
                            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                @csrf
                                <button type="submit" class="dropdown-item" style="border: none; background: none; width: 100%; text-align: left; padding: 0.5rem 1rem;">
                                    <i class="mdi mdi-logout text-danger"></i>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                    <span class="mdi mdi-format-line-spacing"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                @yield('content')
            </div>
        </div>
    </div>
</div>

<!-- plugins:js -->
<!-- Önce jQuery'yi yükle (diğer tüm jQuery eklentilerinden ÖNCE) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Core JS dosyası -->
<script src="{{ asset('panel/assets/vendors/js/vendor.bundle.base.js') }}"></script>

<!-- Plugin js for this page -->
<script src="{{ asset('panel/assets/vendors/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('panel/assets/vendors/progressbar.js/progressbar.min.js') }}"></script>
<script src="{{ asset('panel/assets/vendors/jvectormap/jquery-jvectormap.min.js') }}"></script>
<script src="{{ asset('panel/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<script src="{{ asset('panel/assets/vendors/owl-carousel-2/owl.carousel.min.js') }}"></script>

<!-- Base JS dosyaları -->
<script src="{{ asset('panel/assets/js/off-canvas.js') }}"></script>
<script src="{{ asset('panel/assets/js/hoverable-collapse.js') }}"></script>
<script src="{{ asset('panel/assets/js/misc.js') }}"></script>
<script src="{{ asset('panel/assets/js/settings.js') }}"></script>
<script src="{{ asset('panel/assets/js/todolist.js') }}"></script>
<script src="{{asset('panel/assets/js/dashboard.js')}}"></script>

<!-- End custom js for this page -->
</body>
</html>
