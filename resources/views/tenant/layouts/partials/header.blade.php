
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
                   <span>Mar</span>
                   </a>
                </div>
             </div>
             <div class="iq-menu-horizontal">
                <nav class="iq-sidebar-menu">
                <ul id="iq-sidebar-toggle" class="iq-menu d-flex">
                   <li>
                      <a href="#dashboard" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false"><i class="ri-home-line"></i><span>Dashboard</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                   </li>
                   <li class="active">
                      <a href="#menu-design" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="true"><i class="ri-menu-3-line"></i><span>Ventas</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                   </li>
                   <li>
                      <a href="#products" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false"><i class="ri-record-circle-line"></i><span>Productos</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                      <ul id="products" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                         <li><a href="item-lots">Productos</a></li>
                         <li><a href="categories">Categorías</a></li>
                         <li><a href="brands">Marcas</a></li>
                         <li><a href="calendar.html">Series</a></li>
                      </ul>
                   </li>
                   <li>
                      <a href="#ui-elements" class="iq-waves-effect collapsed"  data-toggle="collapse" aria-expanded="false"><i class="ri-file-user-fill"></i><span>Clientes</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                      <ul id="ui-elements" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle" >
                         <li><a href="ui-colors.html">Clientes</a></li>
                         <li><a href="ui-typography.html">Tipos de clientes</a></li>
                      </ul>
                   </li>
                   
                   <li>
                     <a href="#ui-elements" class="iq-waves-effect collapsed"  data-toggle="collapse" aria-expanded="false"><i class="ri-shopping-cart-fill"></i><span>Compras</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                     <ul id="ui-elements" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle" >
                        <li><a href="ui-colors.html">Nuevo</a></li>
                        <li><a href="ui-typography.html">Listado</a></li>
                        <li><a href="ui-typography.html">Gastos diversos</a></li>
                        <li><a href="ui-typography.html">Proveedores</a></li>

                     </ul>
                  </li>
                  <li>
                     <a href="#ui-elements" class="iq-waves-effect collapsed"  data-toggle="collapse" aria-expanded="false"><i class="ri-inbox-archive-fill"></i><span>Inventario</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                     <ul id="ui-elements" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle" >
                        <li><a href="ui-colors.html">Movimientos</a></li>
                        <li><a href="ui-typography.html">Traslados</a></li>
                        <li><a href="ui-typography.html">Devoluciones</a></li>
                        <li><a href="ui-typography.html">Reporte Inventario</a></li>
                     </ul>
                  </li>
                  <li>
                     <a href="#ui-elements" class="iq-waves-effect collapsed"  data-toggle="collapse" aria-expanded="false"><i class="ri-user-3-fill"></i><span>Usuarios/Locales & Series</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                     <ul id="ui-elements" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle" >
                        <li><a href="ui-colors.html">Usuarios</a></li>
                        <li><a href="ui-typography.html">Establecimientos</a></li>
                     </ul>
                  </li>
                  <li>
                     <a href="#ui-elements" class="iq-waves-effect collapsed"  data-toggle="collapse" aria-expanded="false"><i class="ri-funds-box-fill"></i><span>Reportes</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
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
                <ul class="navbar-list">
                   <li>
                      <a href="#" class="search-toggle iq-waves-effect d-flex align-items-center">
                         <img src="{{ asset('vito-bootstrapp/images/user/1.jpg') }}" class="img-fluid rounded mr-3" alt="user">
                         
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