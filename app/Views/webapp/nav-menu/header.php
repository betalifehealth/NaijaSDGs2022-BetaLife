<!DOCTYPE html>
<html lang="en">


<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?php echo $page_title; ?> | BetaLife</title>
	
	<meta name="description" content="Some description for the page"/>
    <link rel="icon" type="image/png" sizes="16x16" href="http://betalifehealth.com/images/logo/logo-500.png">
	<!-- <link href="<?php echo base_url().'/webapp/vendor/bootstrap-select/dist/css/bootstrap-select.min.css'; ?>" rel="stylesheet" type="text/css"/> -->
	<link href="<?php echo base_url().'/webapp/vendor/owl-carousel/owl.carousel.css'; ?>" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url().'/webapp/css/style.css?v=1.0.2'; ?>" rel="stylesheet" type="text/css"/>
</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">
        <div class="main-content">
            <!--**********************************
                Nav header start
            ***********************************-->
            <div class="nav-header">
                <a href="<?php echo base_url(); ?>" class="brand-logo">
                    <!-- <img class="logo-abbr" src="public/images/logo.png" alt=""> -->
                    <!-- <img class="logo-compact" src="public/images/logo-text.png" alt="">
                    <img class="brand-title" src="public/images/logo-text.png" alt=""> -->
                </a>

                <div class="nav-control">
                    <div class="hamburger">
                        <span class="line"></span><span class="line"></span><span class="line"></span>
                    </div>
                </div>
            </div>
            <!--**********************************
                Nav header end
            ***********************************-->
            
            <!--**********************************
                Header start
            ***********************************-->
            <div class="header">
                <div class="header-content">
                    <nav class="navbar navbar-expand">
                        <div class="collapse navbar-collapse justify-content-between">
                            <div class="header-left">
                                <div class="dashboard_bar">
                                    <?php echo $page_title; ?>
                                </div>
                            </div>

                            <ul class="navbar-nav header-right">
                                <li class="nav-item dropdown header-profile">
                                    <a class="nav-link" href="javascript:;" role="button" data-toggle="dropdown">
                                        <?php if (session('logo') && file_exists('uploads/images/logo/'.session('logo'))) { ?>
                                            <img src="<?php echo base_url().'/uploads/images/logo/'.session('logo'); ?>" width="20" alt=""/>
                                        <?php } else { ?>
                                            <img src="<?php echo base_url().'/webapp/images/doctors-image-small.png'; ?>" width="20" alt=""/>
                                        <?php } ?>
                                        <div class="header-info">
                                            <span>Hello, <strong><?php echo session('name'); ?></strong></span>
                                        </div>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="<?php echo base_url().'/profile'; ?>" class="dropdown-item ai-icon">
                                            <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                            <span class="ml-2">Profile </span>
                                        </a>
                                        <a href="<?php echo base_url().'/logout'; ?>" class="dropdown-item ai-icon">
                                            <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                            <span class="ml-2">Logout </span>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
            
            <!--**********************************
                Header end ti-comment-alt
            ***********************************-->

            <!--**********************************
                Sidebar start
            ***********************************-->
            <div class="deznav">
                <div class="deznav-scroll">
                    <ul class="metismenu" id="menu">
                        <li>
                            <a href="<?php echo base_url().'/dashboard'; ?>" class="ai-icon" aria-expanded="false">
                                <i class="flaticon-381-notification"></i>
                                <span class="nav-text">Dashboard</span>
                            </a>
                        </li>
                        <?php if (session('acct_type') == 'hospital') { ?>
                            <li>
                                <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                                    <i class="flaticon-381-networking"></i>
                                    <span class="nav-text">Blood Donation</span>
                                </a>
                                <ul aria-expanded="false">
                                    <li><a href="<?php echo base_url().'/request-blood'; ?>">New Blood Request</a></li>
                                    <li><a href="<?php echo base_url().'/accept-donors'; ?>">Accept Donors</a></li>
                                    <li><a href="<?php echo base_url().'/my-activities'; ?>">My Activities</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="<?php echo base_url().'/wallet'; ?>" class="ai-icon" aria-expanded="false">
                                    <i class="flaticon-381-briefcase"></i>
                                    <span class="nav-text">Wallet</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="ai-icon" aria-expanded="false">
                                    <i class="flaticon-381-notification"></i>
                                    <span class="nav-text">Notification</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="ai-icon" aria-expanded="false">
                                    <i class="flaticon-381-heart"></i>
                                    <span class="nav-text">Health Insurance</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url().'/visitors'; ?>" class="ai-icon" aria-expanded="false">
                                    <i class="fa fa-users"></i>
                                    <span class="nav-text">Visitor's List</span>
                                </a>
                            </li>
                        <?php } elseif (session('acct_type') == 'blood-bank') { ?>
                            <li>
                                <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                                    <i class="flaticon-381-networking"></i>
                                    <span class="nav-text">Donate Blood</span>
                                </a>
                                <ul aria-expanded="false">
                                    <li><a href="<?php echo base_url().'/browse-blood-requests'; ?>">Browse Requests</a></li>
                                    <li><a href="<?php echo base_url().'/browse-activities'; ?>">Pending Activities</a></li>
                                    <li><a href="#">Chat</a></li>
                                </ul>
                            </li>
                            
                            <li>
                                <a href="<?php echo base_url().'/wallet'; ?>" class="ai-icon" aria-expanded="false">
                                <i class="flaticon-381-briefcase"></i>
                                    <span class="nav-text">Wallet</span>
                                </a>
                            </li>
                            
                            <li>
                                <a href="<?php echo base_url().'/inventory'; ?>" class="ai-icon" aria-expanded="false">
                                <i class="fa fa-university"></i>
                                    <span class="nav-text">Inventory</span>
                                </a>
                            </li>
                        <?php } elseif (session('acct_type') == 'pharmacy') { ?>
                            <li>
                                <a href="<?php echo base_url().'/health-insurance'; ?>" class="ai-icon" aria-expanded="false">
                                    <i class="flaticon-381-heart"></i>
                                    <span class="nav-text">Health Insurance</span>
                                </a>
                            </li>

                            <li>
                                <a href="<?php echo base_url().'/wallet'; ?>" class="ai-icon" aria-expanded="false">
                                    <i class="flaticon-381-briefcase"></i>
                                    <span class="nav-text">Wallet</span>
                                </a>
                            </li>
                        <?php } ?>
                        
                        <li>
                            <a href="<?php echo base_url().'/settings' ?>" class="ai-icon" aria-expanded="false">
                                <i class="flaticon-381-settings-2"></i>
                                <span class="nav-text">Settings</span>
                            </a>
                        </li>
                    </ul>
                
                    <div class="plus-box bg-white">
                        
                    </div>
                    <div class="copyright">
                        <p class="fs-14 font-w200"><strong class="font-w400">BetaLife</strong> <span class="font-weight-bold">&copy; <?php echo date("Y"); ?></span> All Rights Reserved</p>
                    </div>
                </div>
            </div>