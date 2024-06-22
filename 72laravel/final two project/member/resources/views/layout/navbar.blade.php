<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{url('/')}}">Coder</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            @if(Auth::check())
                @if(Auth::user()->hasRole('Manager'))
                    <li class="nav-item active">
                        <a class="nav-link" href="{{url('/admin')}}">Admin <span class="sr-only">(current)</span></a>
                    </li>
                    @else
                    @endif
                @endif
                @if(Auth::check())
                    @if(Auth::user()->hasRole('Manager') || Auth::user()->hasRole('PostsWriter'))
                        <li class="nav-item active">
                            <a class="nav-link" href="{{url('/postsCreator/posts/create')}}">Post Gen<span class="sr-only">(current)</span></a>
                        </li>
                    @else
                    @endif
                @endif
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Dropdown
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    @if(Auth::check())
                        <a class="dropdown-item" href="{{url('/users/logout')}}">Logout</a>
                    @else
                        <a class="dropdown-item" href="{{url('/users/login')}}">Login</a>
                        <a class="dropdown-item" href="{{url('/users/register')}}">Register</a>
                        @endif
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#">Disabled</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>