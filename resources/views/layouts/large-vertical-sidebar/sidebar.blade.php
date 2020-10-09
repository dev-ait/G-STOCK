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
            <li class="nav-item {{ request()->is('client') ? 'active' : '' }}" >
            <a class="nav-item-hold" href="{{ route('client.index') }}">
                    <i class=" nav-icon i-Conference"></i>
                    <span class="nav-text">Clients</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item @if (Route::current()->getName() == 'product.edit') active @endif {{ request()->is('product/create') ? 'active' : '' }} {{ request()->is('product') ? 'active' : '' }}" >
                <a class="nav-item-hold" href="{{ route('product.index') }}">
                    <i class="nav-icon i-Shop-2"></i>
                    <span class="nav-text"> Produits</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item {{ request()->is('gategorie') ? 'active' : '' }}" >
                <a class="nav-item-hold" href="{{ route('gategorie.index') }}">
                    <i class="nav-icon i-Duplicate-Window"></i>
                    <span class="nav-text">Gategorie</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item {{ request()->is('marque') ? 'active' : '' }}" >
                <a class="nav-item-hold" href="{{ route('marque.index') }}">
                    <i class="nav-icon i-Tag-4"></i>
                    <span class="nav-text">Marque</span>
                </a>
                <div class="triangle"></div>
            </li>

            <li class="nav-item {{ request()->is('order')  ? 'active' : '' }}  {{ request()->is('order/create')  ? 'active' : '' }}" data-item="widgets">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Full-Cart"></i>
                    <span class="nav-text">Commandes</span>
                </a>
                <div class="triangle"></div>
            </li>
        </ul>
    </div>

    <div class="sidebar-left-secondary rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
        <!-- Submenu Dashboards -->
        <ul class="childNav" data-parent="widgets">
            <li class="nav-item ">
                <a class="{{ Route::currentRouteName()=='order/create' ? 'open' : '' }}"
                    href=" {{ route('order.create') }}">
                    <i class="nav-icon i-Add-Cart"></i>
                    <span class="item-name">Nouvelle commande</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('order.index') }}"
                    class="{{ Route::currentRouteName()=='order' ? 'open' : '' }}">
                    <i class="nav-icon i-Checkout"></i>
                    <span class="item-name">liste des commande</span>
                </a>
            </li>
           
        </ul>

    </div>
    <div class="sidebar-overlay"></div>
</div>
<!--=============== Left side End ================-->