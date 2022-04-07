<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
         with font-awesome or any other icon font library -->
    <li class="nav-item">
      <a href="{{route('home')}}" class="nav-link">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
          Dashboard
        </p>
      </a>
    </li>

    <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-copy"></i>
        <p>
          Basic Setup
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
              <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Settings</p>
              </a>
          </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Settings</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="../layout/top-nav-sidebar.html" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Gender</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="../layout/top-nav-sidebar.html" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Order Status</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('backend.unit.index')}}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Unit</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="../layout/fixed-sidebar.html" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Address Type</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('backend.district.index')}}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>District</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{route('backend.province.index')}}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Province</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('backend.municipality.index')}}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Munciplity</p>
          </a>
        </li>

      </ul>
    </li>
    <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-chart-pie"></i>
        <p>
          User management
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>User</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('backend.role.index')}}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Role</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('backend.permission.index')}}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Permission</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('backend.module.index')}}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Module</p>
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-chart-pie"></i>
        <p>
          Product Catalog
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="../charts/chartjs.html" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Tag</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('backend.category.index')}}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Category</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('backend.subcategory.index')}}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Sub Category</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('backend.product.index')}}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Product</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('backend.attribute.index')}}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Attribute</p>
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-chart-pie"></i>
        <p>
          Order Management
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="../charts/chartjs.html" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Customer</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="../charts/flot.html" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Order</p>
          </a>
        </li>

      </ul>
    </li>
    <li class="nav-item">
      <a  href="{{ route('logout') }}"
          onclick="event.preventDefault();
        document.getElementById('logout-form').submit();" class="nav-link">
        <i class="nav-icon fas fa-sign-out-alt"></i>
        {{ __('Logout') }}
      </a>

      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
      </form>
    </li>

  </ul>
</nav>
