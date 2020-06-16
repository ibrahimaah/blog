<nav class="navbar navbar-expand-lg navbar-light mb-5">
    <a class="navbar-brand" href="/"><strong>Blog</strong></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" 
    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse nav-div-ul" id="navbarSupportedContent">
        <ul class="navbar-nav w-100 nav-ul">

            <li class="nav-item {{ Request::is('/') ? 'active' : ''}}">
                <a class="nav-link" href="/">Home</a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="nav_menu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Categories
                </a>
                <div class="dropdown-menu dropdown-menu-right"aria-labelledby="nav_menu">
                @php($categories = App\Category::all())
                @isset($categories)
                    @foreach($categories as $category)
                        <a class="dropdown-item" href="{{route('postsByCat',$category->id)}}">
                            {{ $category->name }}
                        </a> 
                    @endforeach
                @endisset
                </div>
            </li>

            <li class="nav-item {{ Request::is('about') ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('about') }}">About </a>
            </li>

            <li class="nav-item {{ Request::is('contact') ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('contact') }}">Contact</a>
            </li>
    
            <li class="nav-item dropdown list-right">

                <a class="nav-link dropdown-toggle"
                    href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                    Hello {{Auth::user()->name ?? 'guest'}}

                </a>

                <div class="dropdown-menu dropdown-menu-right"
                     aria-labelledby="navbarDropdownMenuLink">

                @if(Auth::check())
                   @can('do-every-thing')
                        <a class="dropdown-item" href="{{route('posts.index')}}">
                            Posts
                        </a>
                        <a class="dropdown-item" href="{{ route('categories.index') }}">
                            Categories
                        </a>
                        <a class="dropdown-item" href="{{ route('tags.index') }}">
                            Tags
                        </a>
                        <a class="dropdown-item" href="{{ route('comments.index') }}">
                            Comments
                        </a>
                        <a class="dropdown-item" href="{{ route('users.index') }}">
                            Users
                        </a>
                    @endcan
                        <a class="dropdown-item" href="{{ route('logout')}}">
                            LogOut
                        </a>
                    @else
                        <a class="dropdown-item" href="{{ route('login') }}">
                            Login
                        </a>
                        <a class="dropdown-item" href="{{ route('register') }}">
                            Sign Up
                        </a>
                @endif
                    
                </div>
            </li>
        </ul>   
    </div>
</nav> 