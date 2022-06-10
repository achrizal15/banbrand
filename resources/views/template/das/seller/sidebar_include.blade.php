<div class="sidebar">
    <?php
    $user = auth()
        ->guard('sellers')
        ->user();
    ?>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-legacy" data-widget="treeview" role="menu"
            data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('sellers') }}" class="nav-link {{ request()->is('sellers') ? 'active' : '' }}">
                    <i class="nav-icon fa-light fa-house"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>
            @if ($user->is_active == 1 && $user->is_ban == 0)
                <li class="nav-item">
                    <a href="{{ route('sellers.product.index') }}"
                        class="nav-link {{ request()->is('/sellers/product*') ? 'active' : '' }}">
                        <i class="nav-icon fa-light fa-boxes-stacked"></i>
                        <p>
                            Produk
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('sellers.permintaan') }}"
                        class="nav-link {{ request()->is('/sellers/permintaan*') ? 'active' : '' }}">
                        <i class="nav-icon fa-light fa-store"></i>
                        <p>
                            Permintaan
                        </p>
                    </a>
                </li>
                <li
                    class="nav-item has-treeview {{ request()->is('sellers/ordering') || request()->is('sellers/penarikan') ? 'menu-open' : 'a' }}">
                    <a href="#"
                        class="nav-link {{ request()->is('sellers/ordering') || request()->is('sellers/penarikan') ? 'active' : '' }}">
                        <i class="nav-icon fa-light fa-money-from-bracket"></i>
                        <p>
                            Transaksi
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('sellers.penarikan') }}"
                                class="nav-link {{ request()->is('admin/penarikan*') ? 'active' : '' }}">
                                <i class="nav-icon far fa-folder"></i>
                                <p>Penarikan  & Kas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('sellers.ordering') }}"
                                class="nav-link {{ request()->is('sellers/ordering') ? 'active' : '' }}">
                                <i class="nav-icon far fa-folder"></i>
                                <p>Ordering</p>
                            </a>
                        </li>
                    </ul>

                </li>
            @endif

        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
