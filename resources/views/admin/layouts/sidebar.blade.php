<div class="sidebar" data-background-color="white" data-active-color="danger">

    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="" class="simple-text">
                OthyShop Admin
            </a>
        </div>

        <ul class="nav">
            <li>
                <a href="{{url('/admin')}}">
                    <i class="fa fa-desktop"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li>
                <a href="{{url('admin/products/create')}}">
                    <i class="fa fa-plus"></i>
                    <p>Add Product</p>
                </a>
            </li>
            <li>
                <a href="{{url('admin/products')}}">
                    <i class="fa fa-tasks"></i>
                    <p>View Products</p>
                </a>
            </li>
            <li>
                <a href="{{url('admin/orders')}}">
                    <i class="fa fa-shopping-cart"></i>
                    <p>Orders</p>
                </a>
            </li>
            <li>
                <a href="{{url('admin/users')}}">
                    <i class="fa fa-users"></i>
                    <p>Users</p>
                </a>
            </li>
        </ul>
    </div>
</div>