<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Vito - Responsive Bootstrap 4 Admin Dashboard Template</title>
      <!-- Favicon -->
      <link rel="shortcut icon" href="{{ asset('vito-bootstrapp/images/favicon.ico') }}" />
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="{{ asset('vito-bootstrapp/css/bootstrap.min.css') }}">
      <!-- Typography CSS -->
      <link rel="stylesheet" href="{{ asset('vito-bootstrapp/css/typography.css') }}">
      <!-- Style CSS -->
      <link rel="stylesheet" href="{{ asset('vito-bootstrapp/css/style.css') }}">
      <!-- Responsive CSS -->
      <link rel="stylesheet" href="{{ asset('vito-bootstrapp/css/responsive.css') }}">
       <!-- Full calendar -->
       <link rel="stylesheet" href="{{ asset('vito-bootstrapp/fullcalendar/core/main.css') }}">
       <link rel="stylesheet" href="{{ asset('vito-bootstrapp/fullcalendar/daygrid/main.css') }}">
       <link rel="stylesheet" href="{{ asset('vito-bootstrapp/fullcalendar/timegrid/main.css') }}">
       <link rel="stylesheet" href="{{ asset('vito-bootstrapp/fullcalendar/list/main.css') }}">

      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">


   </head>
   <body class="iq-page-menu-horizontal">
    <!-- loader Start -->
    {{-- <div id="loading">
       <div id="loading-center">

       </div>
    </div> --}}
    <!-- loader END -->
    <!-- Wrapper Start -->
    <div class="wrapper">
       <!-- Sidebar  -->
       <!-- TOP Nav Bar -->
       <div class="iq-top-navbar">
          <div class="iq-navbar-custom d-flex align-items-center justify-content-between">
             <div class="iq-sidebar-logo">
                <div class="top-logo">
                   <a href="index.html" class="logo">
                   <img src="images/logo.gif" class="img-fluid" alt="">
                   <span>vito</span>
                   </a>
                </div>
             </div>
             <div class="iq-menu-horizontal">
                <nav class="iq-sidebar-menu">
                <ul id="iq-sidebar-toggle" class="iq-menu d-flex">
                   <li>
                      <a href="#dashboard" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false"><i class="ri-home-line"></i><span>Dashboard</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                      <ul id="dashboard" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                         <li><a href="index.html" class="iq-waves-effect"><i class="ri-home-4-line"></i><span>Dashboard 1</span></a></li>
                         <li><a href="dashboard-1.html" class="iq-waves-effect"><i class="ri-home-3-line"></i><span>Dashboard 2</span></a></li>
                      </ul>
                   </li>
                   <li class="active">
                      <a href="#menu-design" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="true"><i class="ri-menu-3-line"></i><span>Menu Design</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                      <ul id="menu-design" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                         <li class="active"><a href="horizontal-menu.html"><i class="ri-git-commit-line"></i>Horizontal menu</a></li>
                         <li><a href="horizontal-top-menu.html"><i class="ri-text-spacing"></i>Horizontal Top Menu</a></li>
                         <li><a href="two-sidebar.html"><i class="ri-indent-decrease"></i>Two Sidebar</a></li>
                         <li><a href="vertical-top-menu.html"><i class="ri-line-height"></i>Vertical block menu</a></li>
                      </ul>
                   </li>
                   <li>
                      <a href="#menu-level" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false"><i class="ri-record-circle-line"></i><span>Social</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                      <ul id="menu-level" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                         <li>
                            <a href="#mailbox" class="iq-waves-effect collapsed"  data-toggle="collapse" aria-expanded="false"><span>Email</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                            <ul id="mailbox" class="iq-submenu iq-submenu-data collapse">
                               <li><a href="app/index.html">Inbox</a></li>
                               <li><a href="app/email-compose.html">Email Compose</a></li>
                            </ul>
                         </li>
                         <li><a href="chat.html">Chat</a></li>
                         <li><a href="todo.html">Todo</a></li>
                         <li><a href="calendar.html">Calendar</a></li>
                         <li>
                            <a href="#user-info" class="iq-waves-effect collapsed"  data-toggle="collapse" aria-expanded="false"><span>User</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                            <ul id="user-info" class="iq-submenu iq-submenu-data collapse">
                               <li><a href="profile.html">User Profile</a></li>
                               <li><a href="profile-edit.html">User Edit</a></li>
                               <li><a href="add-user.html">User Add</a></li>
                               <li><a href="user-list.html">User List</a></li>
                            </ul>
                         </li>
                      </ul>
                   </li>
                   <li>
                      <a href="#ui-elements" class="iq-waves-effect collapsed"  data-toggle="collapse" aria-expanded="false"><i class="ri-pencil-ruler-line"></i><span>UI Elements</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                      <ul id="ui-elements" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle" style="height: 300px; overflow-y: scroll;">
                         <li><a href="ui-colors.html">colors</a></li>
                         <li><a href="ui-typography.html">Typography</a></li>
                         <li><a href="ui-alerts.html">Alerts</a></li>
                         <li><a href="ui-badges.html">Badges</a></li>
                         <li><a href="ui-breadcrumb.html">Breadcrumb</a></li>
                         <li><a href="ui-buttons.html">Buttons</a></li>
                         <li><a href="ui-cards.html">Cards</a></li>
                         <li><a href="ui-carousel.html">Carousel</a></li>
                         <li><a href="ui-embed-video.html">Video</a></li>
                         <li><a href="ui-grid.html">Grid</a></li>
                         <li><a href="ui-images.html">Images</a></li>
                         <li><a href="ui-list-group.html">list Group</a></li>
                         <li><a href="ui-media-object.html">Media</a></li>
                         <li><a href="ui-modal.html">Modal</a></li>
                         <li><a href="ui-notifications.html">Notifications</a></li>
                         <li><a href="ui-pagination.html">Pagination</a></li>
                         <li><a href="ui-popovers.html">Popovers</a></li>
                         <li><a href="ui-progressbars.html">Progressbars</a></li>
                         <li><a href="ui-tabs.html">Tabs</a></li>
                         <li><a href="ui-tooltips.html">Tooltips</a></li>
                      </ul>
                   </li>
                   
                   <li>
                      <a href="#Pages" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false"><i class="ri-record-circle-line"></i><span>Pages</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                      <ul id="Pages" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                         <li>
                            <a href="#forms" class="iq-waves-effect collapsed"  data-toggle="collapse" aria-expanded="false"><span>Forms</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                            <ul id="forms" class="iq-submenu collapse iq-submenu-data">
                               <li><a href="form-layout.html">Form Elements</a></li>
                               <li><a href="form-validation.html">Form Validation</a></li>
                               <li><a href="form-switch.html">Form Switch</a></li>
                               <li><a href="form-chechbox.html">Form Checkbox</a></li>
                               <li><a href="form-radio.html">Form Radio</a></li>
                            </ul>
                         </li>
                         <li>
                            <a href="#forms-wizard" class="iq-waves-effect collapsed"  data-toggle="collapse" aria-expanded="false"><span>Forms Wizard</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                            <ul id="forms-wizard" class="iq-submenu collapse iq-submenu-data">
                               <li><a href="form-wizard.html">Simple Wizard</a></li>
                               <li><a href="form-wizard-validate.html">Validate Wizard</a></li>
                               <li><a href="form-wizard-vertical.html">Vertical Wizard</a></li>
                            </ul>
                         </li>
                          <li>
                            <a href="#tables" class="iq-waves-effect collapsed"  data-toggle="collapse" aria-expanded="false"><span>Table</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                            <ul id="tables" class="iq-submenu collapse iq-submenu-data">
                               <li><a href="tables-basic.html">Basic Tables</a></li>
                               <li><a href="data-table.html">Data Table</a></li>
                               <li><a href="table-editable.html">Editable Table</a></li>
                            </ul>
                         </li>
                         <li>
                            <a href="#charts" class="iq-waves-effect collapsed"  data-toggle="collapse" aria-expanded="false"><span>Charts</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                            <ul id="charts" class="iq-submenu iq-submenu-data collapse">
                               <li><a href="chart-morris.html">Morris Chart</a></li>
                               <li><a href="chart-high.html">High Charts</a></li>
                               <li><a href="chart-am.html">Am Charts</a></li>
                               <li><a href="chart-apex.html">Apex Chart</a></li>
                            </ul>
                         </li>
                         <li>
                            <a href="#icons" class="iq-waves-effect collapsed"  data-toggle="collapse" aria-expanded="false"><span>Icons</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                            <ul id="icons" class="iq-submenu iq-submenu-data collapse">
                               <li><a href="icon-dripicons.html">Dripicons</a></li>
                               <li><a href="icon-fontawesome-5.html">Font Awesome 5</a></li>
                               <li><a href="icon-lineawesome.html">line Awesome</a></li>
                               <li><a href="icon-remixicon.html">Remixicon</a></li>
                               <li><a href="icon-unicons.html">unicons</a></li>
                            </ul>
                         </li>
                         <li>
                            <a href="#authentication" class="iq-waves-effect collapsed"  data-toggle="collapse" aria-expanded="false"><span>Authentication</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                            <ul id="authentication" class="iq-submenu iq-submenu-data collapse">
                               <li><a href="sign-in.html">Login</a></li>
                               <li><a href="sign-up.html">Register</a></li>
                               <li><a href="pages-recoverpw.html">Recover Password</a></li>
                               <li><a href="pages-confirm-mail.html">Confirm Mail</a></li>
                               <li><a href="pages-lock-screen.html">Lock Screen</a></li>
                            </ul>
                         </li>
                         <li>
                            <a href="#map" class="iq-waves-effect collapsed"  data-toggle="collapse" aria-expanded="false"><span>Maps</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                            <ul id="map" class="iq-submenu iq-submenu-data collapse">
                               <li><a href="pages-map.html">Google Map</a></li>
                               <li><a href="#">Vector Map</a></li>
                            </ul>
                         </li>
                         <li>
                            <a href="#ecommerce" class="iq-waves-effect collapsed"  data-toggle="collapse" aria-expanded="false"><span>eCommerce</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                            <ul id="ecommerce" class="iq-submenu iq-submenu-data collapse" data-parent="#iq-sidebar-toggle">
                               <li><a href="product.html">Product</a></li>
                               <li><a href="itemdetails.html">Item Details</a></li>
                               <li><a href="checkout.html">Checkout</a></li>
                            </ul>
                         </li>
                         <li>
                            <a href="#extra-pages" class="iq-waves-effect collapsed"  data-toggle="collapse" aria-expanded="false"><span>Extra Pages</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                            <ul id="extra-pages" class="iq-submenu iq-submenu-data collapse" data-parent="#iq-sidebar-toggle">
                               <li><a href="pages-timeline.html">Timeline</a></li>
                               <li><a href="pages-invoice.html">Invoice</a></li>
                               <li><a href="blank-page.html">Blank Page</a></li>
                               <li><a href="pages-error.html">Error 404</a></li>
                               <li><a href="pages-error-500.html">Error 500</a></li>
                               <li><a href="pages-pricing.html">Pricing</a></li>
                               <li><a href="pages-pricing-one.html">Pricing 1</a></li>
                               <li><a href="pages-maintenance.html">Maintenance</a></li>
                               <li><a href="pages-comingsoon.html">Coming Soon</a></li>
                               <li><a href="pages-faq.html">Faq</a></li>
                            </ul>
                         </li>
                      </ul>
                   </li>
                </ul>
             </nav>
             </div>
             <nav class="navbar navbar-expand-lg navbar-light p-0">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="ri-menu-3-line"></i>
                </button>
                <div class="iq-menu-bt align-self-center">
                   <div class="wrapper-menu">
                      <div class="main-circle"><i class="ri-arrow-left-s-line"></i></div>
                      <div class="hover-circle"><i class="ri-arrow-right-s-line"></i></div>
                   </div>
                </div>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                   <ul class="navbar-nav ml-auto navbar-list">
                      <li class="nav-item">
                         <a class="search-toggle iq-waves-effect language-title" href="#"><img src="images/small/flag-01.png" alt="img-flaf" class="img-fluid mr-1" style="height: 16px; width: 16px;" />  <i class="ri-arrow-down-s-line"></i></a>
                         <div class="iq-sub-dropdown">
                            <a class="iq-sub-card" href="#"><img src="images/small/flag-02.png" alt="img-flaf" class="img-fluid mr-2" />French</a>
                            <a class="iq-sub-card" href="#"><img src="images/small/flag-03.png" alt="img-flaf" class="img-fluid mr-2" />Spanish</a>
                            <a class="iq-sub-card" href="#"><img src="images/small/flag-04.png" alt="img-flaf" class="img-fluid mr-2" />Italian</a>
                            <a class="iq-sub-card" href="#"><img src="images/small/flag-05.png" alt="img-flaf" class="img-fluid mr-2" />German</a>
                            <a class="iq-sub-card" href="#"><img src="images/small/flag-06.png" alt="img-flaf" class="img-fluid mr-2" />Japanese</a>

                         </div>
                      </li>
                      <li class="nav-item">
                         <a class="search-toggle iq-waves-effect" href="#"><i class="ri-search-line"></i></a>
                         <form action="#" class="search-box">
                            <input type="text" class="text search-input" placeholder="Type here to search...">
                         </form>
                      </li>
                      <li class="nav-item">
                         <a href="#" class="search-toggle iq-waves-effect">
                            <div id="lottie-beil"></div>
                            <span class="bg-danger dots"></span>
                         </a>
                         <div class="iq-sub-dropdown">
                            <div class="iq-card shadow-none m-0">
                               <div class="iq-card-body p-0 ">
                                  <div class="bg-primary p-3">
                                     <h5 class="mb-0 text-white">All Notifications<small class="badge  badge-light float-right pt-1">4</small></h5>
                                  </div>

                                  <a href="#" class="iq-sub-card" >
                                     <div class="media align-items-center">
                                        <div class="">
                                           <img class="avatar-40 rounded" src="images/user/01.jpg" alt="">
                                        </div>
                                        <div class="media-body ml-3">
                                           <h6 class="mb-0 ">Emma Watson Nik</h6>
                                           <small class="float-right font-size-12">Just Now</small>
                                           <p class="mb-0">95 MB</p>
                                        </div>
                                     </div>
                                  </a>
                                  <a href="#" class="iq-sub-card" >
                                     <div class="media align-items-center">
                                        <div class="">
                                           <img class="avatar-40 rounded" src="images/user/02.jpg" alt="">
                                        </div>
                                        <div class="media-body ml-3">
                                           <h6 class="mb-0 ">New customer is join</h6>
                                           <small class="float-right font-size-12">5 days ago</small>
                                           <p class="mb-0">Jond Nik</p>
                                        </div>
                                     </div>
                                  </a>
                                  <a href="#" class="iq-sub-card" >
                                     <div class="media align-items-center">
                                        <div class="">
                                           <img class="avatar-40 rounded" src="images/user/03.jpg" alt="">
                                        </div>
                                        <div class="media-body ml-3">
                                           <h6 class="mb-0 ">Two customer is left</h6>
                                           <small class="float-right font-size-12">2 days ago</small>
                                           <p class="mb-0">Jond Nik</p>
                                        </div>
                                     </div>
                                  </a>
                                  <a href="#" class="iq-sub-card" >
                                     <div class="media align-items-center">
                                        <div class="">
                                           <img class="avatar-40 rounded" src="images/user/04.jpg" alt="">
                                        </div>
                                        <div class="media-body ml-3">
                                           <h6 class="mb-0 ">New Mail from Fenny</h6>
                                           <small class="float-right font-size-12">3 days ago</small>
                                           <p class="mb-0">Jond Nik</p>
                                        </div>
                                     </div>
                                  </a>
                               </div>
                            </div>
                         </div>
                      </li>
                      <li class="nav-item dropdown">
                         <a href="#" class="search-toggle iq-waves-effect">
                           <div id="lottie-mail"></div>
                            <span class="bg-primary count-mail"></span>
                         </a>
                         <div class="iq-sub-dropdown">
                            <div class="iq-card shadow-none m-0">
                               <div class="iq-card-body p-0 ">
                                  <div class="bg-primary p-3">
                                     <h5 class="mb-0 text-white">All Messages<small class="badge  badge-light float-right pt-1">5</small></h5>
                                  </div>
                                  <a href="#" class="iq-sub-card" >
                                     <div class="media align-items-center">
                                        <div class="">
                                           <img class="avatar-40 rounded" src="images/user/01.jpg" alt="">
                                        </div>
                                        <div class="media-body ml-3">
                                           <h6 class="mb-0 ">Nik Emma Watson</h6>
                                           <small class="float-left font-size-12">13 Jun</small>
                                        </div>
                                     </div>
                                  </a>
                                  <a href="#" class="iq-sub-card" >
                                     <div class="media align-items-center">
                                        <div class="">
                                           <img class="avatar-40 rounded" src="images/user/02.jpg" alt="">
                                        </div>
                                        <div class="media-body ml-3">
                                           <h6 class="mb-0 ">Lorem Ipsum Watson</h6>
                                           <small class="float-left font-size-12">20 Apr</small>
                                        </div>
                                     </div>
                                  </a>
                                  <a href="#" class="iq-sub-card" >
                                     <div class="media align-items-center">
                                        <div class="">
                                           <img class="avatar-40 rounded" src="images/user/03.jpg" alt="">
                                        </div>
                                        <div class="media-body ml-3">
                                           <h6 class="mb-0 ">Why do we use it?</h6>
                                           <small class="float-left font-size-12">30 Jun</small>
                                        </div>
                                     </div>
                                  </a>
                                  <a href="#" class="iq-sub-card" >
                                     <div class="media align-items-center">
                                        <div class="">
                                           <img class="avatar-40 rounded" src="images/user/04.jpg" alt="">
                                        </div>
                                        <div class="media-body ml-3">
                                           <h6 class="mb-0 ">Variations Passages</h6>
                                           <small class="float-left font-size-12">12 Sep</small>
                                        </div>
                                     </div>
                                  </a>
                                  <a href="#" class="iq-sub-card" >
                                     <div class="media align-items-center">
                                        <div class="">
                                           <img class="avatar-40 rounded" src="images/user/05.jpg" alt="">
                                        </div>
                                        <div class="media-body ml-3">
                                           <h6 class="mb-0 ">Lorem Ipsum generators</h6>
                                           <small class="float-left font-size-12">5 Dec</small>
                                        </div>
                                     </div>
                                  </a>
                               </div>
                            </div>
                         </div>
                      </li>
                   </ul>
                </div>
                <ul class="navbar-list">
                   <li>
                      <a href="#" class="search-toggle iq-waves-effect d-flex align-items-center">
                         <img src="images/user/1.jpg" class="img-fluid rounded mr-3" alt="user">
                         
                      </a>
                      <div class="iq-sub-dropdown iq-user-dropdown">
                         <div class="iq-card shadow-none m-0">
                            <div class="iq-card-body p-0 ">
                               <div class="bg-primary p-3">
                                  <h5 class="mb-0 text-white line-height">Hello Nik jone</h5>
                                  <span class="text-white font-size-12">Available</span>
                               </div>
                               <a href="profile.html" class="iq-sub-card iq-bg-primary-hover">
                                  <div class="media align-items-center">
                                     <div class="rounded iq-card-icon iq-bg-primary">
                                        <i class="ri-file-user-line"></i>
                                     </div>
                                     <div class="media-body ml-3">
                                        <h6 class="mb-0 ">My Profile</h6>
                                        <p class="mb-0 font-size-12">View personal profile details.</p>
                                     </div>
                                  </div>
                               </a>
                               <a href="profile-edit.html" class="iq-sub-card iq-bg-primary-hover">
                                  <div class="media align-items-center">
                                     <div class="rounded iq-card-icon iq-bg-primary">
                                        <i class="ri-profile-line"></i>
                                     </div>
                                     <div class="media-body ml-3">
                                        <h6 class="mb-0 ">Edit Profile</h6>
                                        <p class="mb-0 font-size-12">Modify your personal details.</p>
                                     </div>
                                  </div>
                               </a>
                               <a href="account-setting.html" class="iq-sub-card iq-bg-primary-hover">
                                  <div class="media align-items-center">
                                     <div class="rounded iq-card-icon iq-bg-primary">
                                        <i class="ri-account-box-line"></i>
                                     </div>
                                     <div class="media-body ml-3">
                                        <h6 class="mb-0 ">Account settings</h6>
                                        <p class="mb-0 font-size-12">Manage your account parameters.</p>
                                     </div>
                                  </div>
                               </a>
                               <a href="privacy-setting.html" class="iq-sub-card iq-bg-primary-hover">
                                  <div class="media align-items-center">
                                     <div class="rounded iq-card-icon iq-bg-primary">
                                        <i class="ri-lock-line"></i>
                                     </div>
                                     <div class="media-body ml-3">
                                        <h6 class="mb-0 ">Privacy Settings</h6>
                                        <p class="mb-0 font-size-12">Control your privacy parameters.</p>
                                     </div>
                                  </div>
                               </a>
                               <div class="d-inline-block w-100 text-center p-3">
                                  <a class="bg-primary iq-sign-btn" href="sign-in.html" role="button">Sign out<i class="ri-login-box-line ml-2"></i></a>
                               </div>
                            </div>
                         </div>
                      </div>
                   </li>
                </ul>
             </nav>
          </div>
       </div>
       <!-- TOP Nav Bar END -->
       <!-- Page Content  -->