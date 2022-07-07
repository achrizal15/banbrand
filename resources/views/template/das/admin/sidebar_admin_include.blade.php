<div class="sidebar">

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-legacy" data-widget="treeview" role="menu"
            data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('admin') }}" class="nav-link {{ request()->is('admin') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>

            <li class="nav-item has-treeview {{ request()->is('admin/sellers*') ? 'menu-open' : 'a' }}">
                <a href="#" class="nav-link {{ request()->is('admin/sellers*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-building"></i>
                    <p>
                        Sellers
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="/admin/sellers?condition=approved"
                            class="nav-link {{ request()->is('admin/sellers*') ? 'active' : '' }}">
                            <i class="nav-icon far fa-folder"></i>
                            <p>Approved Sellers</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/sellers?condition=approval"
                            class="nav-link {{ request()->is('admin/sellers*') ? 'active' : '' }}">
                            <i class="nav-icon far fa-folder"></i>
                            <p>Approval Sellers</p>
                        </a>
                    </li>
                </ul>

            </li>
            <li class="nav-item">
                <a href="{{ route('admin.customers.index') }}"
                    class="nav-link {{ request()->is('admin/customers*') ? 'active' : '' }}">
                    <i class="nav-icon fa-solid fa-users"></i>
                    <p>
                        Customers
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.kas') }}"
                    class="nav-link {{ request()->is('admin/kas*') ? 'active' : '' }}">
                    <i class="fa-solid nav-icon fa-file-chart-pie"></i>
                    <p>
                       Kas
                    </p>
                </a>
            </li>
        
            <li
                class="nav-item has-treeview {{ request()->is('admin/products*') || request()->is('admin/categorys*') ? 'menu-open' : 'a' }}">
                <a href="#"
                    class="nav-link {{ request()->is('admin/products*') || request()->is('admin/categorys*') ? 'active' : '' }}">
                    <i class="nav-icon fa-solid fa-boxes-stacked"></i>
                    <p>
                        Products
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('admin.products.index') }}"
                            class="nav-link {{ request()->is('admin/products*') ? 'active' : '' }}">
                            <i class="nav-icon far fa-folder"></i>
                            <p>List Products</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.categorys.index') }}"
                            class="nav-link {{ request()->is('admin/categorys*') ? 'active' : '' }}">
                            <i class="nav-icon far fa-folder"></i>
                            <p>Product Category</p>
                        </a>
                    </li>
                </ul>

            </li>
            <li
                class="nav-item has-treeview {{ request()->is('admin/transaksi*') ? 'menu-open' : 'a' }}">
                <a href="#"
                    class="nav-link {{ request()->is('admin/transaksi*')  ? 'active' : '' }}">
      
                    <i class="nav-icon fa-solid fa-money-from-bracket"></i>
                    <p>
                     Transaksi
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('admin.transaksi') }}"
                            class="nav-link {{ request()->is('admin/transaksi') ? 'active' : '' }}">
                            <i class="nav-icon far fa-folder"></i>
                            <p>Verifikasi Pembayaran</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.transaksi.ordering') }}"
                            class="nav-link {{ request()->is('admin/transaksi/ordering*') ? 'active' : '' }}">
                            <i class="nav-icon far fa-folder"></i>
                            <p>Ordering</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.transaksi.refund') }}"
                            class="nav-link {{ request()->is('admin/transaksi/refund*') ? 'active' : '' }}">
                            <i class="nav-icon far fa-folder"></i>
                            <p>Refund</p>
                        </a>
                    </li>
                </ul>

            </li>
            <li class="nav-item">
                <a href="{{ route('admin.setting.index') }}"
                    class="nav-link {{ request()->is('admin/setting*') ? 'active' : '' }}">
                    <i class="fa-solid fa-folder-gear nav-icon"></i>
                    <p>
                       Setting
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.users.index') }}"
                    class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}">
                    <i class="fa-solid fa-user-gear nav-icon"></i>
                    <p>
                      User
                    </p>
                </a>
            </li>

        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
