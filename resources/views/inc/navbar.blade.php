<nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <!-- Brand -->
    <a class="navbar-brand" href="#"><h4 class="mt-2">Laravel Blog</h4></a>

    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav h6">
            <li class="nav-item">
                <a class="nav-link active" href="/home">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/about">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/services">Services</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/posts">Blog</a>
            </li>

        </ul>
        <ul class="navbar-nav ml-0">
            <li class="nav-link ml-auto">
                <a href="/posts/create" class="font-weight-bolder lead"><i class="fas fa-edit"></i>&nbspCreate Post</a>
            </li>
        </ul>
        <li class="dropdown ml-auto">
            <a href="#" class="dropdown dropdown-toggle" data-toggle="dropdown" role="button">
                <i class="fas fa-user-circle"></i>
                @if(!empty(\Illuminate\Support\Facades\Auth::user()->name))
                    {{\Illuminate\Support\Facades\Auth::user()->name}}
                    @else
                    Guest
                @endif
{{--                {{\Illuminate\Support\Facades\Auth::user()->name!==null?\Illuminate\Support\Facades\Auth::user()->name : 'Guest'}} <span class="caret"></span>--}}
            </a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="/home">Dashboard</a></li>
                <li>
                    <a href="{{route('logout')}}"
                       onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form id="logout-form" action="{{route('logout')}}" method="POST">
                        {{csrf_field()}}
                    </form>
                </li>
            </ul>
        </li>
    </div>
</nav>
