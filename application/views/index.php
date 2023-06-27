<!DOCTYPE html>
<!--
Template Name: Rubick - HTML Admin Dashboard Template
Author: Left4code
Website: http://www.left4code.com/
Contact: muhammadrizki@left4code.com
Purchase: https://themeforest.net/user/left4code/portfolio
Renew Support: https://themeforest.net/user/left4code/portfolio
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en" class="light">
    <!-- BEGIN: Head -->
    <head>
        <meta charset="utf-8">
        <link href="<?php echo base_url('/assets/dist/images/logo.svg'); ?>" rel="shortcut icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Rubick admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
        <meta name="keywords" content="admin template, Rubick Admin Template, dashboard template, flat admin template, responsive admin template, web app">
        <meta name="author" content="LEFT4CODE">
        <title>SPK Penilaian Karyawan Kontrak</title>
        <!-- BEGIN: CSS Assets-->
        <link rel="stylesheet" href="<?php echo base_url('/assets/dist/css/app.css'); ?>" />
        <!-- END: CSS Assets-->
    </head>
    <!-- END: Head -->
    <body class="py-5">
        <!-- BEGIN: Mobile Menu -->
        <div class="mobile-menu md:hidden">
            <div class="mobile-menu-bar">
                <a href="" class="flex mr-auto">
                    <img alt="Rubick Tailwind HTML Admin Template" class="w-6" src="<?php echo base_url('/assets/dist/images/logo.svg'); ?>">
                </a>
                <a href="javascript:;" id="mobile-menu-toggler"> <i data-feather="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i> </a>
            </div>
            <ul class="border-t border-white/[0.08] py-5 hidden">
                <li>
                    <a href="<?php echo base_url("home")?>" class="menu">
                        <div class="menu__icon"> <i data-feather="home"></i> </div>
                        <div class="menu__title"> Home </div>
                    </a>
                </li>
                
            </ul>
        </div>
        <!-- END: Mobile Menu -->
        <!-- BEGIN: Top Bar -->
        <div class="border-b border-white/[0.08] -mt-10 md:-mt-5 -mx-3 sm:-mx-8 px-3 sm:px-8 pt-3 md:pt-0 mb-10">
            <div class="top-bar-boxed flex items-center">
                <!-- BEGIN: Logo -->
                <a href="" class="-intro-x hidden md:flex">
                    <img alt="Rubick Tailwind HTML Admin Template" class="w-6" src="<?php echo base_url('/assets/dist/images/logo.svg'); ?>">
                    <span class="text-white text-lg ml-3"> SPK APP </span> 
                </a>
                <!-- END: Logo -->
                <!-- BEGIN: Breadcrumb -->
                <nav aria-label="breadcrumb" class="-intro-x h-full mr-auto">
                    <ol class="breadcrumb breadcrumb-light">
                        <li class="breadcrumb-item"><a href="#">Application</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Home</li>
                    </ol>
                </nav>
                <!-- END: Breadcrumb -->
                <!-- BEGIN: Account Menu -->
                <div class="intro-x dropdown w-8 h-8">
                    <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in scale-110" role="button" aria-expanded="false" data-tw-toggle="dropdown">
                        <img alt="Rubick Tailwind HTML Admin Template" src="<?php echo base_url('/assets/dist/images/profile-11.jpg'); ?>">
                    </div>
                    <div class="dropdown-menu w-56">
                        <ul class="dropdown-content bg-primary/80 before:block before:absolute before:bg-black before:inset-0 before:rounded-md before:z-[-1] text-white">
                            <li class="p-2">
                                <div class="font-medium">Johnny Depp</div>
                                <div class="text-xs text-white/60 mt-0.5 dark:text-slate-500">Software Engineer</div>
                            </li>
                            <li>
                                <hr class="dropdown-divider border-white/[0.08]">
                            </li>
                            <li>
                                <a href="" class="dropdown-item hover:bg-white/5"> <i data-feather="user" class="w-4 h-4 mr-2"></i> Profile </a>
                            </li>
                            <li>
                                <a href="" class="dropdown-item hover:bg-white/5"> <i data-feather="edit" class="w-4 h-4 mr-2"></i> Add Account </a>
                            </li>
                            <li>
                                <a href="" class="dropdown-item hover:bg-white/5"> <i data-feather="lock" class="w-4 h-4 mr-2"></i> Reset Password </a>
                            </li>
                            <li>
                                <a href="" class="dropdown-item hover:bg-white/5"> <i data-feather="help-circle" class="w-4 h-4 mr-2"></i> Help </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider border-white/[0.08]">
                            </li>
                            <li>
                                <a href="" class="dropdown-item hover:bg-white/5"> <i data-feather="toggle-right" class="w-4 h-4 mr-2"></i> Logout </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- END: Account Menu -->
            </div>
        </div>
        <!-- END: Top Bar -->
        <!-- BEGIN: Top Menu -->
        <nav class="top-nav">
            <ul>
                <li>
                    <a href="<?php echo base_url("home")?>" class="top-menu top-menu--active">
                        <div class="top-menu__icon"> <i data-feather="home"></i> </div>
                        <div class="top-menu__title"> Home  </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:;" class="top-menu">
                        <div class="top-menu__icon"> <i data-feather="box"></i> </div>
                        <div class="top-menu__title"> Menu Layout <i data-feather="chevron-down" class="top-menu__sub-icon"></i> </div>
                    </a>
                    <ul class="">
                        <li>
                            <a href="index.html" class="top-menu">
                                <div class="top-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="top-menu__title"> Side Menu </div>
                            </a>
                        </li>
                        <li>
                            <a href="simple-menu-light-dashboard-overview-1.html" class="top-menu">
                                <div class="top-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="top-menu__title"> Simple Menu </div>
                            </a>
                        </li>
                        <li>
                            <a href="top-menu-light-dashboard-overview-1.html" class="top-menu">
                                <div class="top-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="top-menu__title"> Top Menu </div>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- END: Top Menu -->
        <!-- BEGIN: Content -->
        <div class="content">
            <h2 class="intro-y text-lg font-medium mt-10">
                Users Layout
            </h2>
            <div class="grid grid-cols-12 gap-6 mt-5">
                <!-- BEGIN: Users Layout -->
                <div class="intro-y col-span-12 md:col-span-6 lg:col-span-4">
                    <div class="box">
                        <div class="flex items-start px-5 pt-5">
                            <div class="w-full flex flex-col lg:flex-row items-center">
                                <div class="w-16 h-16 image-fit">
                                    <img alt="Rubick Tailwind HTML Admin Template" class="rounded-full" src="<?php echo base_url('/assets/dist/images/profile-12.jpg'); ?>">
                                </div>
                                <div class="lg:ml-4 text-center lg:text-left mt-3 lg:mt-0">
                                    <a href="" class="font-medium">Kate Winslet</a> 
                                    <div class="text-slate-500 text-xs mt-0.5">Software Engineer</div>
                                </div>
                            </div>
                            <div class="absolute right-0 top-0 mr-5 mt-3 dropdown">
                                <a class="dropdown-toggle w-5 h-5 block" href="javascript:;" aria-expanded="false" data-tw-toggle="dropdown"> <i data-feather="more-horizontal" class="w-5 h-5 text-slate-500"></i> </a>
                                <div class="dropdown-menu w-40">
                                    <div class="dropdown-content">
                                        <a href="" class="dropdown-item"> <i data-feather="edit-2" class="w-4 h-4 mr-2"></i> Edit </a>
                                        <a href="" class="dropdown-item"> <i data-feather="trash" class="w-4 h-4 mr-2"></i> Delete </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center lg:text-left p-5">
                            <div>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 20</div>
                            <div class="flex items-center justify-center lg:justify-start text-slate-500 mt-5"> <i data-feather="mail" class="w-3 h-3 mr-2"></i> katewinslet@left4code.com </div>
                            <div class="flex items-center justify-center lg:justify-start text-slate-500 mt-1"> <i data-feather="instagram" class="w-3 h-3 mr-2"></i> Kate Winslet </div>
                        </div>
                        <div class="text-center lg:text-right p-5 border-t border-slate-200/60 dark:border-darkmode-400">
                            <button class="btn btn-primary py-1 px-2 mr-2">Message</button>
                            <button class="btn btn-outline-secondary py-1 px-2">Profile</button>
                        </div>
                    </div>
                </div>
                <!-- END: Users Layout -->
            </div>
        </div>
        <!-- END: Content -->
        <!-- BEGIN: Dark Mode Switcher-->
        <div data-url="top-menu-dark-users-layout-3.html" class="dark-mode-switcher cursor-pointer shadow-md fixed bottom-0 right-0 box border rounded-full w-40 h-12 flex items-center justify-center z-50 mb-10 mr-10">
            <div class="mr-4 text-slate-600 dark:text-slate-200">Dark Mode</div>
            <div class="dark-mode-switcher__toggle border"></div>
        </div>
        <!-- END: Dark Mode Switcher-->
        
        <!-- BEGIN: JS Assets-->
        <script src="<?php echo base_url('/assets/dist/js/app.js'); ?>"></script>
        <!-- END: JS Assets-->
    </body>
</html>