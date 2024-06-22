<nav class="navbar bg-dark navbar-dark navbar-expand-lg">
    <a href="{{url('/')}}" class="navbar-brand">ZenShop</a>
    <button class="navbar-toggler" data-toggle="collapse" data-target="#collapseDiv">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapseDiv">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item own">
                <a href="#" class="nav-link">Dowload</a>
            </li>
            <li class="nav-item own">
                <a href="#" class="nav-link">Contact</a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item dropdown own">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Products</a>
                <div class="dropdown-menu">
                    <a href="{{url('/products/create')}}" class="dropdown-item">Create</a>
                    <a href="#" class="dropdown-item">View all Products</a>
                    <a href="#" class="dropdown-item">Edit</a>
                </div>
            </li>
            <li class="nav-item dropdown own">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Membership</a>
                <div class="dropdown-menu">
                    <a href="#" class="dropdown-item">Login</a>
                    <a href="#" class="dropdown-item">Register</a>
                    <a href="#" class="dropdown-item">Logout</a>
                </div>
            </li>
            <li class="nav-item own">
                <a href="{{url('carts/show')}}" class="nav-link">Cart
                    <span class="badge bg-danger">
                                            {{count(session('items'))}}

                    </span>
                </a>
            </li>
        </ul>
    </div>
</nav>