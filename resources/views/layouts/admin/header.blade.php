<!DOCTYPE html>
<html lang="en">
    @php $site = \App\Models\Site::select('site_name', 'banner_image', 'favicon', 'hide_sitename') ->orderBy('updated_at', 'desc')->first(); @endphp @if($site && $site->favicon)
    <link rel="shortcut icon" href="{{ asset('storage/app/public/'.$site->favicon) }}" type="image/x-icon" />
    @endif

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
        <title>{{ $site->site_name }}</title>

        @if ($site && $site->banner_image)
        <link rel="shortcut icon" href="{{ asset('storage/'.$site->banner_image) }}" type="image/x-icon" />
        @endif
        <!-- plugins:css -->

        <link rel="stylesheet" href="{{asset('public/vendors/css/vendor.bundle.base.css')}}" />
        <link rel="stylesheet" href="{{asset('public/vendors/css/vendor.bundle.addons.css')}}" />
        <link rel="stylesheet" href="{{asset('public/vendors/css/bootstrap.min.css')}}" />
        <link href="{{asset('public/vendors/css/bootstrap-icons.css')}}" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Allura&family=EB+Garamond:ital,wght@0,400..800;1,400..800&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
        <!-- endinject -->
        <!-- inject:css -->
        <link rel="stylesheet" href="{{asset('public/css/horizontal-layout/style.css')}}" />
        <link rel="stylesheet" href="{{asset('public/css/horizontal-layout/lms.css')}}" />
        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css" />
        <link rel="stylesheet" href="{{ asset('public/css/jquery.toast.css')}}" />
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css" />
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
        <script src="{{asset('public/js/jquery.toast.js')}}"></script>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.min.js"></script>
        <!-- endinject -->
        <link rel="shortcut icon" href="" />
        <style type="text/css">
            .theme-loader {
                height: 100%;
                width: 100%;
                background-color: #fff;
                position: fixed;
                z-index: 999999;
            }
            @-webkit-keyframes ball-scale {
                0% {
                    -webkit-transform: scale(0);
                    transform: scale(0);
                }
                100% {
                    -webkit-transform: scale(1);
                    transform: scale(1);
                    opacity: 0;
                }
            }
            @keyframes ball-scale {
                0% {
                    -webkit-transform: scale(0);
                    transform: scale(0);
                }
                100% {
                    -webkit-transform: scale(1);
                    transform: scale(1);
                    opacity: 0;
                }
            }
            .ball-scale {
                left: 0;
                margin: 0 auto;
                position: absolute;
                right: 0;
                text-align: center;
                top: 45%;
                width: 100%;
            }
            .ball-scale > div {
                -webkit-animation: ball-scale 1s 0s ease-in-out infinite;
                animation: ball-scale 1s 0s ease-in-out infinite;
                background-color: #148f77;
                border-radius: 100px;
                display: inline-block;
                height: 60px;
                width: 60px;
            }
            .sticky-top {
                position: fixed;
                top: 0;
                width: 100%;
                z-index: 9999;
            }

            .page-body {
                background: #fff;
            }

            @media (min-width: 992px) {
                .page-body {
                    padding-top: 10px !important;
                    margin-top: 0 !important;
                }

                .sidepop {
                    top: 58px !important;
                    height: calc(100vh - 58px) !important;
                    margin-top: 0 !important;
                }

                .user-desktop-header-row {
                    flex-wrap: nowrap;
                    align-items: stretch;
                    min-height: 58px;
                    justify-content: space-between;
                }

                .user-header-brand {
                    flex: 0 0 9%;
                    width: 9%;
                    max-width: 9%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    overflow: hidden;
                    padding-left: 0.25rem;
                    padding-right: 0.25rem;
                }

                .user-header-brand .site-logo {
                    display: block;
                    width: auto;
                    max-width: 100%;
                    max-height: 46px;
                    object-fit: contain;
                }

                .user-header-brand .navbar-brand {
                    margin-right: 0;
                    max-width: 100%;
                }

                .user-header-navigation {
                    flex: 1 1 auto;
                    width: auto;
                    min-width: 0;
                }

                .user-header-navigation .nav-main-tabss {
                    min-height: 58px;
                    justify-content: flex-start !important;
                }

                .user-header-navigation .admin-nav-menu,
                .user-header-navigation .btn-primaryy-lite {
                    display: inline-flex;
                    align-items: center;
                    min-height: 58px;
                    min-width: 0;
                    padding: 6px 6px !important;
                    font-size: 14px !important;
                    line-height: 1.2 !important;
                    white-space: nowrap;
                }

                .user-header-profile {
                    flex: 0 0 280px;
                    width: 280px;
                    max-width: 280px;
                    position: relative;
                    z-index: 2;
                    background: #fff;
                }

                .user-header-profile > div,
                .user-header-profile > div > .row {
                    height: 100%;
                }

                .user-header-profile .header-profile-details {
                    min-width: 0;
                }

                .user-header-profile .header-profile-details > .d-flex {
                    min-width: 0;
                }

                .user-header-profile .header-profile-text {
                    min-width: 0;
                    line-height: 1.15;
                }

                .user-header-profile .header-profile-name-text,
                .user-header-profile .header-profile-text .text-muted {
                    overflow-wrap: anywhere;
                }
            }

            @media (min-width: 992px) and (max-width: 1999.98px) {
                .user-header-navigation .admin-nav-menu,
                .user-header-navigation .btn-primaryy-lite {
                    padding: 6px 4px !important;
                    font-size: 13.5px !important;
                }

                .user-header-navigation .admin-nav-menu i,
                .user-header-navigation .btn-primaryy-lite i {
                    margin-right: 0.25rem !important;
                }

                .user-header-profile {
                    flex-basis: 260px;
                    width: 260px;
                    max-width: 260px;
                }

                .user-header-navigation .logged-as-switcher {
                    padding-left: 0.3rem;
                    padding-right: 0.3rem;
                }

                .user-header-navigation .logged-as-label {
                    display: none;
                }
            }
        </style>
    </head>

    <body>
        <div class="">
        <div class="theme-loader">
            <div class="ball-scale">
                <div></div>
            </div>
        </div>
        <!-- header starts -->
        <div class="container-fluid header-bg sticky-top d-none d-lg-block">
            <div class="row px-2 user-desktop-header-row">
                <div class="col-4 col-md-2 col-lg-1p5 my-auto user-header-brand">
                    @if($site && isset($site->banner_image))
                        <img src="{{ asset('storage/app/public/'.$site->banner_image) }}" class="site-logo" alt="Logo" /> @endif @if($site->hide_sitename==0)
                        <a class="navbar-brand brand-logo" href="{{ url('organizationdashboard') }}">
                            <div id="headerSiteName">{{ $site->site_name ?? '' }}</div>
                        </a>
                    @endif
                </div>
                @if ($errors->any())
                    <div class="row">
                        @foreach ($errors->all() as $error)
                        <div class="col-12 my-3">
                            <p class="alert alert-danger">{!! $error !!}</p>
                        </div>
                        @endforeach
                    </div>
                @endif
                <div class="col-12 col-md-4 col-lg-8p5 my-auto user-header-navigation">
                    <div class="tab-content border-0" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills1" role="tabpanel" aria-labelledby="v-pills-tab-one">
                            <div>
                                <nav>
                                    <div class="nav nav-tabs nav-main-tabss border-bottom-0 d-flex justify-content-start align-items-center flex-nowrap font-smallsize" id="nav-tab" role="tablist">
                                        <a
                                            href="{{url('organizationdashboard')}}"
                                            class="nav-link admin-nav-menu {{ Request::is('organizationdashboard') ? 'active' : '' }}"
                                            id="dab-tab"
                                            role="tab"
                                            aria-controls="dab"
                                            aria-selected="true"
                                        >
                                            <i class="fa-solid fa-house me-2 menu-icon1"></i> Dashboard
                                        </a>

                                        <div class="dropdown">              
                                            <a
                                                class="btn btn-primaryy-lite dropdown-toggle {{ Request::is('coursecatalog') ? 'active' : '' }}"
                                                href="#"
                                                role="button"
                                                id="dropdownMenuCourses"
                                                data-toggle="dropdown"
                                                aria-haspopup="true"
                                                aria-expanded="false"
                                            >
                                                <i class="fa-solid fa-laptop-file me-2 menu-icon2"></i>Course Catalog <i class="fa-solid fa-chevron-down ps-1 fs-7"></i>
                                            </a>

                                            <div class="dropdown-menu drpdwn-menu drpdwnmenu1 px-3 pt-0 pb-3 mt-1" aria-labelledby="dropdownMenuCourses" style="z-index: 99999;">
                                                <div class="row py-2">
                                                    <div class="col-12 col-lg-12 py-3">
                                                        <a class="dropdown-item pt-0" href="{{url('coursecatalog?tab=2')}}">
                                                            <div class="row">
                                                                <div class="col-4 col-md-2 col-lg-1p5 pr-0">
                                                                    <i class="fa-solid fa-chalkboard-user mainmenu-icon"></i>
                                                                </div>
                                                                <div class="col-8 col-md-10 col-lg-10p5">
                                                                    <div>
                                                                        Courses <i class="fa-solid fa-chevron-right ps-1 fs10"></i>
                                                                    </div>
                                                                    <p class="mb-0">
                                                                        View courses, create courses, assign users, view reports and more..
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="col-12 col-lg-12">
                                                        <a class="dropdown-item pt-0" href="{{url('coursecatalog?tab=4')}}">
                                                            <div class="row">
                                                                <div class="col-4 col-md-2 col-lg-1p5 pr-0">
                                                                    <i class="fa-solid fa-folder-tree mainmenu-icon"></i>
                                                                </div>
                                                                <div class="col-8 col-md-10 col-lg-10p5">
                                                                    <div>
                                                                        Categories <i class="fa-solid fa-chevron-right fs10"></i>
                                                                    </div>
                                                                    <p class="mb-0">
                                                                        View categories, create categories, view courses and more..
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="dropdown">
                                            <a
                                                class="btn btn-primaryy-lite dropdown-toggle {{ Request::is('users') ? 'active' : '' }}"
                                                href="#"
                                                role="button"
                                                id="dropdownMenuUsers"
                                                data-toggle="dropdown"
                                                aria-haspopup="true"
                                                aria-expanded="false"
                                            >
                                                <i class="fa-solid fa-user-gear me-2 menu-icon3"></i>User Management <i class="fa-solid fa-chevron-down ps-1 fs-7"></i>
                                            </a>

                                            <div class="dropdown-menu drpdwn-menu drpdwnmenu1 px-3 pt-0 pb-3 mt-1" aria-labelledby="dropdownMenuUsers" style="z-index: 99999;">
                                                <div class="row">
                                                    <div class="col-12 col-lg-12 pt-4 pb-3">
                                                        <a class="dropdown-item pt-0" href="{{url('users?tab=2')}}">
                                                            <div class="row">
                                                                <div class="col-4 col-md-2 col-lg-1p5 pr-0">
                                                                    <i class="fa-solid fa-user-group mainmenu-icon"></i>
                                                                </div>
                                                                <div class="col-8 col-md-10 col-lg-10p5">
                                                                    <div>
                                                                        User <i class="fa-solid fa-chevron-right ps-1 fs10"></i>
                                                                    </div>
                                                                    <p>
                                                                        View users, create users, assign users to courses and more..
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="col-12 col-lg-12">
                                                        <a class="dropdown-item pt-0" href="{{url('users?tab=4')}}">
                                                            <div class="row">
                                                                <div class="col-4 col-md-2 col-lg-1p5 pr-0">
                                                                    <i class="fa-solid fa-users mainmenu-icon"></i>
                                                                </div>
                                                                <div class="col-8 col-md-10 col-lg-10p5">
                                                                    <div>
                                                                        Groups <i class="fa-solid fa-chevron-right fs10"></i>
                                                                    </div>
                                                                    <p>
                                                                        View groups, create groups and assign user to groups
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <a href="{{url('admin/reports')}}" class="nav-link admin-nav-menu {{ Request::is('admin/reports') ? 'active' : '' }}" id="fm-tab" role="tab" aria-controls="fm" aria-selected="false">

                                            <i class="fa-regular fa-file-lines me-2 menu-icon4"></i>Reports
                                        </a>
                                        <div class="dropdown">
                                            <a
                                                class="btn btn-primaryy-lite dropdown-toggle"
                                                href="#"
                                                role="button"
                                                id="dropdownMenuEvaluation"
                                                data-toggle="dropdown"
                                                aria-haspopup="true"
                                                aria-expanded="false"
                                            >
                                                <i class="fa-solid fa-file-circle-check me-2 menu-icon5"></i>Evaluation <i class="fa-solid fa-chevron-down ps-1 fs-7"></i>
                                            </a>

                                            <div class="dropdown-menu drpdwn-menu drpdwnmenu1 px-3 pt-0 pb-3 mt-1" aria-labelledby="dropdownMenuEvaluation" style="z-index: 99999;">
                                                <div class="row">
                                                    <div class="col-12 col-lg-12 pt-4 pb-3">
                                                        <a class="dropdown-item py-0" target="_blank" href="https://assessment.digicat.ai/login">
                                                            <div class="row">
                                                                <div class="col-4 col-md-2 col-lg-1p5 pr-0">
                                                                    <i class="fa-solid fa-laptop-file  mainmenu-icon"></i>
                                                                </div>
                                                                <div class="col-8 col-md-10 col-lg-10p5">
                                                                    <div>
                                                                        Assesment Exam <i class="fa-solid fa-chevron-right ps-1 fs10"></i>
                                                                    </div>
                                                                    <p>
                                                                        Timed assessment evaluating knowledge through structured questions and tasks.
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="col-12 col-lg-12">
                                                        <a class="dropdown-item py-0" href="{{route('admin.exams.create')}}">
                                                            <div class="row">
                                                                <div class="col-4 col-md-2 col-lg-1p5 pr-0">
                                                                    <i class="fa-solid fa-laptop-file mainmenu-icon"></i>
                                                                </div>
                                                                <div class="col-8 col-md-10 col-lg-10p5">
                                                                    <div>
                                                                        Assignment Exam <i class="fa-solid fa-chevron-right fs10"></i>
                                                                    </div>
                                                                    <p>
                                                                        Structured evaluation to measure learners' knowledge and skills.
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="dropdown">
                                            <a
                                                class="btn btn-primaryy-lite dropdown-toggle {{ Request::is('settings') || Request::is('importexport') || Request::is('automation') || Request::is('mail_templates') || Request::is('roles')  ? 'active' : '' }} || {{ Request::is('masters') ? 'active' : '' }}"
                                                href="#"
                                                role="button"
                                                id="dropdownMenuSettings"
                                                data-toggle="dropdown"
                                                aria-haspopup="true"
                                                aria-expanded="false"
                                            >
                                                <i class="fa-solid fa-gear me-2 menu-icon6"></i>Settings <i class="fa-solid fa-chevron-down ps-1 fs-7"></i>
                                            </a>

                                            <div class="dropdown-menu drpdwn-menu px-3 py-0 mt-1" aria-labelledby="dropdownMenuSettings" style="z-index: 99999;">
                                                <div class="row">
                                                    <div class="col-12 col-lg-6 pt-4 pb-3">
                                                        <a class="dropdown-item py-0" href="{{url('settings')}}">
                                                            <div class="row">
                                                                <div class="col-2 pr-0">
                                                                    <i class="fa-solid fa-user-gear mainmenu-icon"></i>
                                                                </div>
                                                                <div class="col-10">
                                                                    <div>
                                                                       Settings <i class="fa-solid fa-chevron-right ps-1 fs10"></i>
                                                                    </div>
                                                                    <p class="">
                                                                        Update logo, update date and time and more..
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="col-12 col-lg-6 pt-4 pb-3">
                                                        <a class="dropdown-item py-0" href="{{url('mail_templates')}}">
                                                            <div class="row">
                                                                <div class="col-2 pr-0">
                                                                    <i class="fa-solid fa-envelopes-bulk mainmenu-icon"></i>
                                                                </div>
                                                                <div class="col-10">
                                                                    <div>
                                                                        Email Templates <i class="fa-solid fa-chevron-right fs10"></i>
                                                                    </div>
                                                                    <p class="">
                                                                        Configure Email Notifications
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="col-12 col-lg-6 pb-3 pt-0">
                                                        <a class="dropdown-item py-0" href="{{url('roles')}}">
                                                            <div class="row">
                                                                <div class="col-2 pr-0">
                                                                    <i class="fa-solid fa-user-lock mainmenu-icon"></i>
                                                                </div>
                                                                <div class="col-10">
                                                                    <div>
                                                                        Roles & Permissions <i class="fa-solid fa-chevron-right ps-1 fs10"></i>
                                                                    </div>
                                                                    <p class="mb-0">
                                                                        Create roles, create permissions, assign roles to users and more
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="col-12 col-lg-6 pb-3 pt-0">
                                                        <a class="dropdown-item py-0" href="{{url('masters')}}">
                                                            <div class="row">
                                                                <div class="col-2 pr-0">
                                                                    <i class="fa-solid fa-globe mainmenu-icon"></i>
                                                                </div>
                                                                <div class="col-10">
                                                                    <div>
                                                                        Masters <i class="fa-solid fa-chevron-right ps-1 fs10"></i>
                                                                    </div>
                                                                    <p class="mb-0">
                                                                        Create goals, course levels, cerificates and more..
                                                                    </p>
                                                                </div>
                                                            </div>
                                                         </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        {{-- Admin login as --}}
                                        @php
                                            $currentActingRole = session('acting_role', 'admin');
                                        @endphp

                                        <div class="dropdown">
                                            <a
                                                class="btn btn-primaryy-lite dropdown-toggle"
                                                href="#"
                                                role="button"
                                                id="dropdownMenuLoginAs"
                                                data-toggle="dropdown"
                                                aria-haspopup="true"
                                                aria-expanded="false"
                                            >
                                                <i class="fa-solid fa-user-gear me-2 menu-icon3"></i>{{ ucfirst($currentActingRole) }} <i class="fa-solid fa-chevron-down ps-1 fs-7"></i>
                                            </a>

                                            <div class="dropdown-menu drpdwn-menu drpdwnmenu1 px-3 py-2 mt-1" aria-labelledby="dropdownMenuLoginAs" style="z-index: 99999;">
                                                <div class="row">
                                                    @if($currentActingRole != 'admin')
                                                    <div class="col-12 col-lg-12 py-2">
                                                        <a class="dropdown-item pt-0" href="{{ route('login.as', ['role' => 'admin']) }}">
                                                            <div class="row">
                                                                <div class="col-4 col-md-2 col-lg-1p5 pr-0">
                                                                    <i class="fa-solid fa-user-shield mainmenu-icon"></i>
                                                                </div>
                                                                <div class="col-8 col-md-10 col-lg-10p5">
                                                                    <div>
                                                                        Admin
                                                                    </div>
                                                                    <p class="mb-0">
                                                                       Login as admin.
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    @endif
                                                    @if($currentActingRole != 'user')
                                                    <div class="col-12 col-lg-12 py-2">
                                                        <a class="dropdown-item pt-0" href="{{ route('login.as', ['role' => 'user']) }}">
                                                            <div class="row">
                                                                <div class="col-4 col-md-2 col-lg-1p5 pr-0">
                                                                    <i class="fa-solid fa-user-group mainmenu-icon"></i>
                                                                </div>
                                                                <div class="col-8 col-md-10 col-lg-10p5">
                                                                    <div>
                                                                        User
                                                                    </div>
                                                                    <p class="mb-0">
                                                                       Login as user.
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    @endif
                                                    @if($currentActingRole != 'teamlead')
                                                    <div class="col-12 col-lg-12 py-2">
                                                        <a class="dropdown-item pt-0" href="{{ route('login.as', ['role' => 'teamlead']) }}">
                                                            <div class="row">
                                                                <div class="col-4 col-md-2 col-lg-1p5 pr-0">
                                                                    <i class="fa-solid fa-users mainmenu-icon"></i>
                                                                </div>
                                                                <div class="col-8 col-md-10 col-lg-10p5">
                                                                    <div>
                                                                        Team lead
                                                                    </div>
                                                                    <p class="mb-0">
                                                                       Login as team lead.
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    @endif
                                                    @if($currentActingRole != 'manager1')
                                                     <div class="col-12 col-lg-12 py-2">
                                                        <a class="dropdown-item pt-0" href="{{ route('login.as', ['role' => 'manager1']) }}">
                                                            <div class="row">
                                                                <div class="col-4 col-md-2 col-lg-1p5 pr-0">
                                                                    <i class="fa-solid fa-users mainmenu-icon"></i>
                                                                </div>
                                                                <div class="col-8 col-md-10 col-lg-10p5">
                                                                    <div>
                                                                        Manager 1
                                                                    </div>
                                                                    <p class="mb-0">
                                                                       Login as manager 1.
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    @endif
                                                    @if($currentActingRole != 'manager2')
                                                    <div class="col-12 col-lg-12 py-2">
                                                       <a class="dropdown-item pt-0" href="{{ route('login.as', ['role' => 'manager2']) }}">
                                                            <div class="row">
                                                                <div class="col-4 col-md-2 col-lg-1p5 pr-0">
                                                                    <i class="fa-solid fa-users mainmenu-icon"></i>
                                                                </div>
                                                                <div class="col-8 col-md-10 col-lg-10p5">
                                                                    <div>
                                                                        Manager 2
                                                                    </div>
                                                                    <p class="mb-0">
                                                                       Login as manager 2.
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        {{-- End admin login as --}}

                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-8 col-md-6 col-lg-2 pe-1 my-auto user-header-profile">
                    <div>
                        <div class="row">
                            <div class="col-lg-10 col-10 header-profile-details my-auto">
                                <div class="d-flex align-items-center">
                                    <div class="header-profile-img-div">
                                        @if(!empty(Auth::user()->profile_image))
                                            <img src="{{ asset('storage/app/public/' . Auth::user()->profile_image) }}" alt="profile" class="rounded-circle" width="40" height="40" >
                                        @else
                                            <img src="{{ asset('public/images/face12.jpg') }}" alt="profile" class="rounded-circle" width="40" height="40">
                                        @endif
                                    </div>
                                    <div class="ps-2 header-profile-text">
                                        <div class="mb-1 header-profile-name-text">{{Auth::user()->first_name." ".Auth::user()->last_name}}</div>
                                        <div class="text-muted fs12 text-truncate">{{Auth::user()->designationdetails->designation_name ?? 'Admin'}}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-2 col-2 px-0 my-auto">
                                <div class="dropdown text-end">
                                    <button type="button" class="btn btn-transparent p-0 border-0 dropdown-toggle drdwn-prof-toggle" data-bs-toggle="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa-solid fa-chevron-down"></i>
                                    </button>

                                    <ul class="dropdown-menu drpdwn-menu drpdwnmenu1 px-3 pt-0 pb-0 mt-3" style="z-index: 99999;">
                                        <div class="row">
                                            <div class="col-12 col-lg-6 pt-4 pb-3">
                                                <a class="dropdown-item pt-0" href="{{ url('admin-profile') }}">
                                                    <div class="row align-items-center">
                                                        <div class="col-4 col-md-2 col-lg-3 pr-0">
                                                            <i class="fa-solid fa-user mainmenu-icon"></i>
                                                        </div>
                                                        <div class="col-8 col-md-10 col-lg-9 pl-0">
                                                            <div>
                                                                Profile <i class="fa-solid fa-chevron-right ps-1 fs10"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-12 col-lg-6 pt-4 pb-3">
                                                <a class="dropdown-item pt-0" href="{{url('change_password')}}">
                                                    <div class="row align-items-center">
                                                        <div class="col-4 col-md-2 col-lg-3 pr-0">
                                                            <i class="fa-solid fa-lock mainmenu-icon"></i>
                                                        </div>
                                                        <div class="col-8 col-md-10 col-lg-9 pl-0">
                                                            <div>
                                                                Change Password <i class="fa-solid fa-chevron-right fs10"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-12 col-lg-6 pt-0 pb-3">
                                                <a class="dropdown-item pt-0" href="{{url('logout')}}">
                                                    <div class="row align-items-center">
                                                        <div class="col-4 col-md-2 col-lg-3 pr-0">
                                                            <i class="fa-solid fa-power-off mainmenu-icon"></i>
                                                        </div>
                                                        <div class="col-8 col-md-10 col-lg-9 pl-0">
                                                            <div>
                                                                Logout <i class="fa-solid fa-chevron-right fs10"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-block d-lg-none">
            <div id="myheader-Sidenav" class="header-sidenav">
                <div class="d-flex justify-content-between align-items-center pl-4 pr-3 pt-3 pb-2">
                    <span class="fw-bold text-blue">MENU</span>
                    <a href="javascript:void(0)" class="closebtn" onclick="closeSideMenu()">&times;</a>
                </div>
                <ul class="px-2 w-95p mb-0">
                    <li class="list-unstyled">
                        <a
                            href="{{url('organizationdashboard')}}"
                            class="nav-link admin-nav-menu {{ Request::is('organizationdashboard') ? 'active' : '' }}"
                            id="dab-tab"
                            role="tab"
                            aria-controls="dab"
                            aria-selected="true"
                        >
                            <i class="fa-solid fa-house me-2 menu-icon1"></i> Dashboard
                        </a>
                    </li>
                    
                    <li class="list-unstyled">
                        <div class="dropdown responsive-sidemanu-dropdown pb-1">
                            <button class="btn responsive-sidemanu-dropdown-btn dropdown-toggle {{ Request::is('coursecatalog') ? 'active' : '' }} my-1" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-laptop-file me-2 menu-icon2 menu-res-icon"></i>Course Catalog <i class="fa-solid fa-chevron-down ps-1 fs-7"></i>
                            </button>
                            <ul class="dropdown-menu py-1">
                                <li class=" ">
                                    <div class="col-12 py-2">
                                        <div class="row align-items-center">
                                            <div class="col-3 pr-0">
                                                <div>
                                                    <i class="fa-solid fa-chalkboard-user mainmenu-icon"></i>
                                                </div>
                                            </div>
                                            <div class="col-9 pl-0">
                                                <div>
                                                    <a class="dropdown-item px-0 pt-0" href="{{url('coursecatalog?tab=2')}}">Courses <i class="fa-solid fa-chevron-right ps-1 fs10"></i></a>
                                                </div>
                                                <p class="submenu-des">
                                                    View courses, create courses, assign users, view reports and more..
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class=" ">
                                    <div class="col-12 py-2">
                                        <div class="row align-items-center">
                                            <div class="col-3 pr-0">
                                                <div>
                                                    <i class="fa-solid fa-folder-tree mainmenu-icon"></i>
                                                </div>
                                            </div>
                                            <div class="col-9 pl-0">
                                                <div>
                                                    <a class="dropdown-item px-0 pt-0" href="{{url('coursecatalog?tab=4')}}">Categories <i class="fa-solid fa-chevron-right ps-1 fs10"></i></a>
                                                </div>
                                                <p class="submenu-des">
                                                    View categories, create categories, view courses and more..
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="list-unstyled">
                        <div class="dropdown responsive-sidemanu-dropdown pb-1">
                            <button class="btn responsive-sidemanu-dropdown-btn dropdown-toggle {{ Request::is('users') ? 'active' : '' }} my-1" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-user-gear me-2 menu-icon3 menu-res-icon"></i>User Management <i class="fa-solid fa-chevron-down ps-1 fs-7"></i>
                            </button>
                            <ul class="dropdown-menu py-1">
                                <li class=" ">
                                    <div class="col-12 py-2">
                                        <div class="row align-items-center">
                                            <div class="col-3 pr-0">
                                                <div>
                                                    <i class="fa-solid fa-user-group mainmenu-icon"></i>
                                                </div>
                                            </div>
                                            <div class="col-9 pl-0">
                                                <div>
                                                    <a class="dropdown-item px-0 pt-0" href="{{url('users?tab=2')}}">Users <i class="fa-solid fa-chevron-right ps-1 fs10"></i></a>
                                                </div>
                                                <p class="submenu-des">
                                                    View users, create users, assign users to courses and more..
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class=" ">
                                    <div class="col-12 py-2">
                                        <div class="row align-items-center">
                                            <div class="col-3 pr-0">
                                                <div>
                                                    <i class="fa-solid fa-folder-tree mainmenu-icon"></i>
                                                </div>
                                            </div>
                                            <div class="col-9 pl-0">
                                                <div>
                                                    <a class="dropdown-item px-0 pt-0" href="{{url('users?tab=4')}}">Groups <i class="fa-solid fa-chevron-right ps-1 fs10"></i></a>
                                                </div>
                                                <p class="submenu-des">
                                                    View groups, create groups and assign user to groups
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="list-unstyled">
                        <a href="{{url('admin/reports')}}" class="nav-link admin-nav-menu {{ Request::is('admin/reports') ? 'active' : '' }}" id="reports-tab" role="tab" aria-controls="fm" aria-selected="false">
                            <i class="fa-regular fa-file-lines me-2 menu-icon4 menu-res-icon"></i>Reports
                        </a>
                    </li>
                    <li class="list-unstyled">
                        <div class="dropdown responsive-sidemanu-dropdown pb-1">
                            <button class="btn responsive-sidemanu-dropdown-btn dropdown-toggle my-1" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-file-circle-check me-2 menu-icon5 menu-res-icon"></i>Evaluation <i class="fa-solid fa-chevron-down ps-1 fs-7"></i>
                            </button>
                            <ul class="dropdown-menu py-1">
                                <li class=" ">
                                    <div class="col-12 py-2">
                                        <div class="row align-items-center">
                                            <div class="col-3 pr-0">
                                                <div>
                                                    <i class="fa-solid fa-laptop-file mainmenu-icon"></i>
                                                </div>
                                            </div>
                                            <div class="col-9 pl-0">
                                                <div>
                                                    <a class="dropdown-item px-0 pt-0" href="https://assessment.digicat.ai/login">Assesment Exam <i class="fa-solid fa-chevron-right ps-1 fs10"></i></a>
                                                </div>
                                                <p class="submenu-des">
                                                    Timed assessment evaluating knowledge through structured questions and tasks.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class=" ">
                                    <div class="col-12 py-2">
                                        <div class="row align-items-center">
                                            <div class="col-3 pr-0">
                                                <div>
                                                    <i class="fa-solid fa-laptop-file mainmenu-icon"></i>
                                                </div>
                                            </div>
                                            <div class="col-9 pl-0">
                                                <div>
                                                    <a class="dropdown-item px-0 pt-0" href="{{route('admin.exams.create')}}">Assignment Exam <i class="fa-solid fa-chevron-right ps-1 fs10"></i></a>
                                                </div>
                                                <p class="submenu-des">
                                                    Structured evaluation to measure learners' knowledge and skills.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="list-unstyled">
                        <div class="dropdown responsive-sidemanu-dropdown pb-1">
                            <button class="btn responsive-sidemanu-dropdown-btn dropdown-toggle {{ Request::is('settings') || Request::is('importexport') || Request::is('automation') || Request::is('mail_templates') || Request::is('roles')  ? 'active' : '' }} || {{ Request::is('masters') ? 'active' : '' }} my-1" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-gear me-2 menu-icon6 menu-res-icon"></i>Settings <i class="fa-solid fa-chevron-down ps-1 fs-7"></i>
                            </button>
                            <ul class="dropdown-menu py-1 mb-3">
                                <li class=" ">
                                    <div class="col-12 py-2">
                                        <div class="row align-items-center">
                                            <div class="col-3 pr-0">
                                                <div>
                                                    <i class="fa-solid fa-user-gear mainmenu-icon"></i>
                                                </div>
                                            </div>
                                            <div class="col-9 pl-0">
                                                <div>
                                                    <a class="dropdown-item px-0 pt-0" href="{{url('settings')}}">Settings <i class="fa-solid fa-chevron-right ps-1 fs10"></i></a>
                                                </div>
                                                <p class="submenu-des">Update logo, update date and time and more..</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class=" ">
                                    <div class="col-12 py-2">
                                        <div class="row align-items-center">
                                            <div class="col-3 pr-0">
                                                <div>
                                                    <i class="fa-solid fa-envelopes-bulk mainmenu-icon"></i>
                                                </div>
                                            </div>
                                            <div class="col-9 pl-0">
                                                <div>
                                                    <a class="dropdown-item px-0 pt-0" href="{{url('mail_templates')}}">Email Templates <i class="fa-solid fa-chevron-right ps-1 fs10"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                 <li class=" ">
                                    <div class="col-12 py-2">
                                        <div class="row align-items-center">
                                            <div class="col-3 pr-0">
                                                <div>
                                                    <i class="fa-solid fa-user-lock mainmenu-icon"></i>
                                                </div>
                                            </div>
                                            <div class="col-9 pl-0">
                                                <div>
                                                    <a class="dropdown-item px-0 pt-0" href="{{url('roles')}}">Roles & Permissions <i class="fa-solid fa-chevron-right ps-1 fs10"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class=" ">
                                    <div class="col-12 py-2">
                                        <div class="row align-items-center">
                                            <div class="col-3 pr-0">
                                                <div>
                                                    <i class="fa-solid fa-globe mainmenu-icon"></i>
                                                </div>
                                            </div>
                                            <div class="col-9 pl-0">
                                                <div>
                                                    <a class="dropdown-item px-0 pt-0" href="{{url('masters')}}">Masters <i class="fa-solid fa-chevron-right ps-1 fs10"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <ul class="prf-menu pl-0">
                            <li class="list-unstyled">
                                <a href="{{url('admin-profile')}}" class="nav-link admin-nav-menu">
                                    <i class="fa-solid fa-user me-1 me-lg-2 menu-icon1 menu-res-icon"></i> Profile
                                </a>
                            </li>

                            <li class="list-unstyled">
                                <a href="{{url('change-password')}}" class="nav-link admin-nav-menu">
                                    <i class="fa-solid fa-lock me-1 me-lg-2 menu-icon2 menu-res-icon"></i> Change Password
                                </a>
                            </li>

                            <li class="list-unstyled">
                                <a href="{{url('logout')}}" class="nav-link admin-nav-menu">
                                    <i class="fa-solid fa-power-off me-1 me-lg-2 menu-icon3 menu-res-icon"></i> Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>

            <div class="row align-items-center mx-0 my-2">
            <div class="col-2">
                <div class="">
                    <span class="SideMenuToggle" onclick="openSideMenu()">&#9776;</span>
                </div>
            </div>
            <div class="col-10 px-0">
                <div class="d-flex align-items-center justify-content-end">
                    <div class="overflow-x-hidden">
                        <h5 class="font-weight-500 mb-0 text-truncate profile-image-styles">Welcome, {{Auth::user()->first_name??''}} {{Auth::user()->last_name??''}}</h5>
                    </div>
                    <button class="btn btn-transparent py-2 px-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasEnd" aria-controls="offcanvasEnd">
                        <div>
                            @if(!empty(Auth::user()->profile_image))
                                <img src="{{ asset('storage/app/public/' . Auth::user()->profile_image) }}" alt="Avatar" class="profile-image-responsive rounded-circle" />
                            @else
                                <img src="{{asset('public/images/face12.jpg')}}" alt="Avatar" class="profile-image-responsive rounded-circle" />
                            @endif
                        </div>
                    </button>
                </div>
            </div>
        </div>

        <div class="offcanvas profile-ofcanvas offcanvas-end" tabindex="-1" id="offcanvasEnd" aria-labelledby="offcanvasEndLabel">
          <div class="offcanvas-header">
            <h4 class="offcanvas-title" id="offcanvasEndLabel">Profile</h4>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body pt-0">
                <div>
                    <h5 class="user-last-login-styles-responsive ll-datails">
                        <span class="opacity-75 font-weight-normal">Last Login :</span>
                        <span class="">
                            @php
                                use Carbon\Carbon;
                                $lastLogin = isset($secondLastLogin->login_time) 
                                    ? Carbon::parse($secondLastLogin->login_time)->setTimezone('Asia/Kolkata') 
                                    : null;
                            @endphp

                            @if($lastLogin)
                                {{ $lastLogin->format('F j, Y g:i a \I\S\T') }}
                            @else
                                No login data
                            @endif
                        </span>
                    </h5>
                </div>
                <div class="row py-2">
                    <div class="col-4 col-md-3 col-lg-3">
                        <div class="user-profile-icons">
                            <i class="fa-solid fa-id-card"></i>
                        </div>
                    </div>
                    <div class="col-8 col-md-9 col-lg-9 my-auto ps-0">
                        <div class="text-start">
                            <h5 class="mb-2">{{$user->emp_id??''}}</h5>
                            <div class="sub-text">Emp Id</div>
                        </div>
                    </div>
                </div>
                <div class="row py-2">
                    <div class="col-4 col-md-3 col-lg-3">
                        <div class="user-profile-icons">
                            <i class="fa-solid fa-user-gear"></i>
                        </div>
                    </div>
                    <div class="col-8 col-md-9 col-lg-9 my-auto ps-0">
                        <div class="text-start">
                            <h5 class="mb-2">{{$user->designationdetails->designation_name??''}}</h5>
                            <div class="sub-text">Designation</div>
                        </div>
                    </div>
                </div>
                <div class="row py-2">
                    <div class="col-4 col-md-3 col-lg-3">
                        <div class="user-profile-icons">
                            <i class="fa-regular fa-user"></i>
                        </div>
                    </div>
                    <div class="col-8 col-md-9 col-lg-9 my-auto ps-0">
                        <div class="text-start">
                            <h5 class="mb-2">{{ ucfirst(session('acting_role', 'admin')) }}</h5>
                            <div class="sub-text">Logged in as</div>
                        </div>
                    </div>
                </div>
                <div class="row py-2">
                    <div class="col-4 col-md-3 col-lg-3">
                        <div class="user-profile-icons">
                            <i class="fa-regular fa-building"></i>
                        </div>
                    </div>
                    <div class="col-8 col-md-9 col-lg-9 my-auto ps-0">
                        <div class="text-start">
                            <h5 class="mb-2">{{$user->departmentdetails->department_name??''}}</h5>
                            <div class="sub-text">Department</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 my-2">
                        <div class="profile-rewards-styles">
                            <div class="row justify-content-center">
                                <div class="col-6 col-md-12 offset-md-0 col-lg-8 offset-lg-2">
                                    <img src="{{asset('public/images/rewards-icon.png')}}" alt="profile" class="mx-auto d-block">
                                </div>
                            </div>
                            <div class="mb-3 text-center">
                                <h5 class="text-white">{{$user->point??'0'}} Points</h5>
                                <div class="text-white opacity-50 fs-7">My Reward Points</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 my-2">
                        <div class="profile-rewards-styles">
                            <div class="row justify-content-center">
                                <div class="col-6 col-md-12 offset-md-0 col-lg-8 offset-lg-2 py-1 py-md-2 my-0 my-md-1">
                                    <img src="{{asset('public/images/awards-badge.png')}}" alt="profile" class="mx-auto img-fluid d-block">
                                </div>
                            </div>
                            <div class="mb-3 text-center">
                                <h5 class="text-white">0</h5>
                                <div class="text-white opacity-50 fs-7">My Awarded Badges</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

                <div class="col-12 page-body content-bg px-0 px-lg-2">

        <script>
            function openSideMenu() {
              document.getElementById("myheader-Sidenav").style.width = "85%";
            }

            function closeSideMenu() {
              document.getElementById("myheader-Sidenav").style.width = "0";
            }
        </script>

        <script type="text/javascript">
            document.querySelectorAll('.dropdown-menu').forEach(function(dropdown) {
                dropdown.addEventListener('click', function(event) {
                    event.stopPropagation();
                });
            });
        </script>
