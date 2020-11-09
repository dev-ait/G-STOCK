<div class="side-content-wrap">
    <div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
        <ul class="navigation-left">
            <li class="nav-item {{ request()->is('/') ? 'active' : '' }}" >
                <a class="nav-item-hold" href="{{ route('home') }}">
                    <i class="nav-icon i-Bar-Chart"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
                <div class="triangle"></div>
            </li>
            @can('admin_access_all_page_utilisateurs')
  

            <li class="nav-item @if (Route::current()->getName() == 'users' || Route::current()->getName() == 'permission' ) active @endif"  data-item="utilisateurs">
                <a class="nav-item-hold" href="{{ route('client.index') }}">
                        <i class=" nav-icon i-Male"></i>
                        <span class="nav-text">Utilisateurs</span>
                    </a>
                    <div class="triangle"></div>
            </li>
            @endcan

            <li class="nav-item {{ request()->is('client') ? 'active' : '' }}" >
            <a class="nav-item-hold" href="{{ route('client.index') }}" >
                    <i class=" nav-icon i-Conference"></i>
                    <span class="nav-text">Clients</span>
                </a>
                <div class="triangle"></div>
            </li>

         
  
            @if ($user_logged->inRole($current_user_name_role))


             @if ($user_logged->hasAccess(['product.read']))
    
              
           
             <li class="nav-item @if (Route::current()->getName() == 'product.edit'  ) active @endif {{ request()->is('product/create') ? 'active' : '' }} {{ request()->is('product') ? 'active' : '' }}" data-item="products" >
                <a class="nav-item-hold" href="">
                    <i class="nav-icon i-Shop-2"></i>
                    <span class="nav-text"> Produits</span>
                </a>
                <div class="triangle"></div>
             </li>
                 @endif
    
                 @endif
    
            

            <li class="nav-item {{ request()->is('order')  ? 'active' : '' }}  {{ request()->is('order/create')  ? 'active' : '' }}" data-item="commandes">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Full-Cart"></i>
                    <span class="nav-text">Commandes</span>
                </a>
                <div class="triangle"></div>
            </li>
        </ul>
    </div>

    <div class="sidebar-left-secondary rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
        <!-- Submenu commandes -->
        <ul class="childNav" data-parent="commandes">
            @if ($user_logged->inRole($current_user_name_role)  )
              @if ($user_logged->hasAccess(['order.create']))
            <li class="nav-item ">
                <a class="{{ Route::currentRouteName()=='order/create' ? 'open' : '' }}"
                    href=" {{ route('order.create') }}">
                    <i class="nav-icon i-Add-Cart"></i>
                    <span class="item-name">Nouvelle commande</span>
                </a>
            </li>
             @endif
            @endif
            <li class="nav-item">
                <a href="{{ route('order.index') }}"
                    class="{{ Route::currentRouteName()=='order' ? 'open' : '' }}">
                    <i class="nav-icon i-Checkout"></i>
                    <span class="item-name">liste des commande</span>
                </a>
            </li>
           
        </ul>

         <!-- Submenu products -->
         <ul class="childNav" data-parent="products">
            <li class="nav-item">
                <a href="{{ url('product') }}"
                    class="{{ Route::currentRouteName()=='marque' ? 'open' : '' }}">
                    <i class="nav-icon i-Shopping-Basket"></i>
                    <span class="nav-text"> Produits</span>
                </a>
            </li>

            <li class="nav-item ">
                <a class="nav-item {{ Route::currentRouteName()=='gategorie' ? 'open' : '' }}"
                    href="{{ route('gategorie.index') }}">
                    <i class="nav-icon i-Duplicate-Window"></i>
                    <span class="nav-text">Gategorie</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('marque.index') }}"
                    class="{{ Route::currentRouteName()=='marque' ? 'open' : '' }}">
                    <i class="nav-icon i-Tag-4"></i>
                    <span class="nav-text">Marque</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('modele.index') }}"
                    class="{{ Route::currentRouteName()=='modele' ? 'open' : '' }}">
                    <i class="nav-icon i-This-Side-Up"></i>
                    <span class="nav-text">Modele</span>
                </a>
            </li>
      
           
        </ul>

        <!-- Submenu utilisateurs -->
        <ul class="childNav" data-parent="utilisateurs">
            <li class="nav-item">
                <a href="{{ URL::route('users') }}"
                    class="{{ Route::currentRouteName()=='marque' ? 'open' : '' }}">
                    <i class="nav-icon i-Administrator"></i>
                    <span class="nav-text"> utilisateurs
                    </span>
                    
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ URL::route('permission') }}"
                    class="{{ Route::currentRouteName()=='permission' ? 'open' : '' }}">
                    <i class="nav-icon i-Share"></i>
                    <span class="nav-text"> Assigner Permission
                    </span>
                    
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ URL::route('permission_order') }}"
                    class="{{ Route::currentRouteName()=='menu_pages' ? 'open' : '' }}">
                    <i class="nav-icon i-Share"></i>
                    <span class="nav-text"> Permission Commande
                    </span>
                    
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ URL::route('roles.index') }}"
                    class="{{ Route::currentRouteName()=='roles' ? 'open' : '' }}">
                    <i class="nav-icon i-Search-People"></i>
                    <span class="nav-text"> Roles
                    </span>
                    
                </a>
            </li>

      
           
        </ul>

    </div>
    <div class="sidebar-overlay"></div>
</div>
<!--=============== Left side End ================-->