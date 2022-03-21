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


       </ul>
   </nav>
   <!-- /.sidebar-menu -->
</div>
