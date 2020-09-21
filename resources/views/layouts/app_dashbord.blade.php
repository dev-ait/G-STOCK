<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Gestion de sotck</title>
    
          <!-- Styles css -->

    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href={{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}>
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href={{ asset('assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}>
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href={{ asset('assets/fonts/iconic/css/material-design-iconic-font.min.css') }}>
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href={{ asset('assets/vendor/animate/animate.css') }}>
    <!--===============================================================================================-->	
        <link rel="stylesheet" type="text/css" href={{ asset('assets/vendor/css-hamburgers/hamburgers.min.css') }}>
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href={{ asset('assets/vendor/animsition/css/animsition.min.css') }}>
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href={{ asset('assets/vendor/select2/select2.min.css') }}>
    <!--===============================================================================================-->	
        <link rel="stylesheet" type="text/css" href={{ asset('assets/vendor/daterangepicker/daterangepicker.css') }}>
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href={{ asset('assets_dashbord/sb-admin-2.css') }}>
        <link rel="stylesheet" type="text/css" href={{ asset('assets_dashbord/style.css') }}>
        <link rel="stylesheet" type="text/css" href={{ asset('assets_dashbord/style_icon.css') }}>
        <link rel="stylesheet" type="text/css" href={{ asset('assets/css/main.css') }}>
        <link rel="stylesheet" type="text/css" href={{ asset('assets/css/util.css') }}>
      

 
</head>


<body id="page-top" class="sidebar-toggled bg-panel" data-app>

    <!-- Page Wrapper -->
    <div id="wrapper">
  
     
  
      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column color-content">
  
        <!-- Main Content -->
        <div id="content">
  
          <!-- Topbar -->
          <nav class="navbar z-index navbar-expand navbar-light bg-white topbar  static-top border-bottom">
  
            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
              <i class="fa fa-bars"></i>
            </button>
  
               <!-- logo site -->
              
        
          <img href="/" src="{{ asset('images/logo-v1.png') }}" alt="" class="logo-dashbord">
               
                
          
  
  
            <!-- menu toggle Search -->
  
            <div  class="menu-nav">
              <div class="div1"></div>
              <div class="div1"></div>
              <div class="div1"></div>
            </div>
            
           
            <!-- Topbar Search -->
            <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
              <div class="input-group border-1 border-radius-30">
                <input type="text" class="form-control bg-light border-0 small border-radius-30 pl-4" placeholder="Recherche..." aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                  <button class="btn btn-search border-radius-30 " type="button">
                    <i class="icon-search icon_search "></i>
                  </button>
                </div>
              </div>
            </form>
  
            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
  
              <!-- Nav Item - Search Dropdown (Visible Only XS) -->
              <li class="nav-item dropdown no-arrow d-sm-none">
                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-search fa-fw"></i>
                </a>
                <!-- Dropdown - Messages -->
                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                  <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                      <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                      <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                          <i class="fa fa-search fa-sm"></i>
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </li>
  
              <!-- Nav Item - Alerts -->
              <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-bell fa-fw"></i>
                  <!-- Counter - Alerts -->
                  <span class="badge badge-danger badge-counter">3+</span>
                </a>
                <!-- Dropdown - Alerts -->
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                  <h6 class="dropdown-header">
                    Alerts Center
                  </h6>
                  <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                      <div class="icon-circle bg-primary">
                        <i class="fa fa-file-alt text-white"></i>
                      </div>
                    </div>
                    <div>
                      <div class="small text-gray-500">December 12, 2019</div>
                      <span class="font-weight-bold">A new monthly report is ready to download!</span>
                    </div>
                  </a>
                  <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                      <div class="icon-circle bg-success">
                        <i class="fa fa-donate text-white"></i>
                      </div>
                    </div>
                    <div>
                      <div class="small text-gray-500">December 7, 2019</div>
                      $290.29 has been deposited into your account!
                    </div>
                  </a>
                  <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                      <div class="icon-circle bg-warning">
                        <i class="fa fa-exclamation-triangle text-white"></i>
                      </div>
                    </div>
                    <div>
                      <div class="small text-gray-500">December 2, 2019</div>
                      Spending Alert: We've noticed unusually high spending for your account.
                    </div>
                  </a>
                  <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                </div>
              </li>
  
             
  
              <div class="topbar-divider d-none d-sm-block"></div>
  
              <!-- Nav Item - User Information -->
              <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class=" mt-1 d-none d-lg-inline text-gray-600 mr-3"> {{ Auth::user()->name }} </span>
                
                   <img class="ml-5 mt-2 focus-input100 img-profile icon-user" src="{{ asset('images/user.svg') }}" alt="" >
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                  <a class="dropdown-item" href="#">
                    <i class="fa fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                  </a>
                  <a class="dropdown-item" href="#">
                    <i class="fa fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Settings
                  </a>
                  <a class="dropdown-item" href="#">
                    <i class="fa fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                    Activity Log
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="icon-switch2 fa-sm fa-fw mr-2 text-gray-400"></i>
                    Se déconnecter
                  </a>
                </div>
              </li>
  
            </ul>
  
          </nav>
          <!-- End of Topbar -->
  
    <div class="d-flex">         <!-- Sidebar -->
      <ul class="navbar-nav sidebar sidebar-dark accordion border-right text-menu toglle-side-bare" id="accordionSidebar">

      
    
          <!-- Nav Item - Dashboard -->
          <li class="nav-item   @if (Route::current()->getName() == 'home') active @endif pt-3">
            <a class="nav-link" href="{{ route('home') }}">
              <i class="zmdi zmdi-view-dashboard"></i>
              <span class="text-effet">Tableau de bord</span></a>
          </li>

          <li class="nav-item @if (Route::current()->getName() == 'client.index') active @endif  pt-3">
            <a class="nav-link" href="{{ route('client.index') }}">
              <i class="zmdi zmdi-accounts-list-alt"></i>
              <span class="text-effet">Clients</span></a>
          </li>

       

        
     
         
    
          <!-- Divider -->
          <hr class="sidebar-divider">
    
          <!-- Heading -->
          <div class="sidebar-heading text-effet " style="font-family: Poppins-Regular, sans-serif;">
            GESTION DES PROUITS
          </div>
    
          <!-- Nav Item - Produits Collapse Menu -->
          <li class="nav-item sub-gate @if (Route::current()->getName() == 'product.edit'  || Route::current()->getName() == 'product.index'  || Route::current()->getName() == 'product.create' ) active @endif">
            <a class="nav-link"  href=" {{ route('product.index') }} ">
              <i class="zmdi zmdi-archive"></i>
              <span  > Produits</span>
            </a>
   
          </li>
    
          <!-- Nav Item - Gategorie Collapse Menu -->
          <li class="nav-item sub-gate @if (Route::current()->getName() == 'gategorie.index') active @endif">
            <a class="nav-link collapsed"  href=" {{ route('gategorie.index') }} ">
              <i class="zmdi zmdi-layers"></i>
              <span>Gategorie</span>
            </a>
          
          </li>

           <!-- Nav Item - Marque Collapse Menu -->
           <li class="nav-item sub-gate @if (Route::current()->getName() == 'marque.index') active @endif"   >
            <a class="nav-link"  href=" {{ route('marque.index') }} ">
              <i class="zmdi zmdi-label"></i>
              <span> Marque</span>
            </a>
          
          </li>
    
    
          <!-- Divider -->
          <hr class="sidebar-divider">
    
          <!-- Heading -->
          <div class="sidebar-heading " style="font-family: Poppins-Regular, sans-serif;">
            GESTION DES COMMANDES
          </div>
    
        
    
          <!-- Nav Item - Charts -->
          <li class="nav-item sub-gate  @if (Route::current()->getName() == 'order.create') active @endif">
            <a class="nav-link"  href=" {{ route('order.create') }} ">
              <i class="zmdi zmdi-shopping-cart-plus"></i>
              <span>Nouvelle commande</span></a>
          </li>

          <!-- Nav Item - Charts -->
          <li class="nav-item @if (Route::current()->getName() == 'order.index') active @endif">
            <a class="nav-link" href=" {{ route('order.index') }} ">
              <i class="zmdi zmdi-shopping-cart"></i>
              <span> Gérer les commandes </span></a>
          </li>
    
         
    
   
  
       
      </ul>
      <!-- End of Sidebar -->
  
          
          <!-- Begin Page Content -->
      <div id="block-panel" class="bg-panel container-fluid open-side-bare">
          <div  class=" mt-4 pl-5 pr-5">
  
            @yield('content')
  
        </div>
      </div>
  
  
        </div>
        <!-- End of Main Content -->
  
      
  
      </div>
      <!-- End of Content Wrapper -->
  
    </div>
    <!-- End of Page Wrapper -->
  
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#">
      <i class="fa fa-angle-up"></i>
    </a>
  
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Prêt à Quitter</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Sélectionnez «Déconnexion» ci-dessous si vous êtes prêt à mettre fin à votre session en cours.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary text-white" type="button" data-dismiss="modal">Annuler</button>
            <a class="btn btn-primary" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">Se déconnecter</a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                           @csrf
                        </form>
          </div>
        </div>
      </div>
    </div>



  
    
            <!-- Script JS -->

            <!--===============================================================================================-->
	<script src={{ asset('assets/vendor/jquery/jquery-3.2.1.min.js') }}></script>
    <!--===============================================================================================-->
        <script src={{ asset('assets/vendor/animsition/js/animsition.min.js') }}></script>
    <!--===============================================================================================-->
        <script src={{ asset('assets/vendor/bootstrap/js/popper.js') }}></script>
        <script src={{ asset('assets/vendor/bootstrap/js/bootstrap.min.js') }}></script>
    <!--===============================================================================================-->
        <script src={{ asset('assets/vendor/select2/select2.min.js') }}></script>
    <!--===============================================================================================-->
        <script src={{ asset('assets/vendor/daterangepicker/moment.min.js') }}></script>
        <script src={{ asset('assets/vendor/daterangepicker/daterangepicker.js') }}></script>
    <!--===============================================================================================-->
        <script src={{ asset('assets/vendor/countdowntime/countdowntime.js') }}></script>
    <!--===============================================================================================-->
        <script src={{ asset('assets/js/main.js') }}></script>
    

        <script src={{ asset('assets_dashbord/js/sb-admin-2.js') }}></script>
        <script src={{ asset('assets_dashbord/js/sb-admin-2.min.js') }}></script>


        <link rel="stylesheet" type="text/css" href={{ asset('material-design-iconic-font.min') }}>
        


  
  </body>





</html>
