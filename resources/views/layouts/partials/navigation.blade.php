<nav class="navbar navbar-default navbar-expand-md navbar-dark fixed-top">

     <a class="navbar-brand" href="{{ url('/') }}">
         {{ trans('app.name') }}
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa fa-bars" aria-hidden="true"></i>
    </button>

    <div class="collapse navbar-collapse" id="mainNavbar">

        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/newshub">뉴스허브</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/posts">포스트</a>
            </li>
            <li class="nav-item">
                <a class="nav-link off" href="#">샵리스트</a>
            </li>
            <li class="nav-item">
                <a class="nav-link off" href="#">용어사전</a>
            </li>
        </ul>


        <ul class="nav justify-content-end">
            <!-- Authentication Links -->
            @if (Auth::guest())
                <li class="nav-item">
                     <a class="nav-link" href="{{ route('sessions.create') }}">로그인</a>
                </li>
                <li class="nav-item nav-pills nav-justified">
                     <a class="nav-link active" href="{{ route('users.create') }}">회원 가입</a>
                </li>
            @else

            @if(!empty(Auth::user()->getRoleNames()))
                @foreach(Auth::user()->getRoleNames() as $v)

                    @if($v === 'administer')
                       <li class="nav-item">
                         <a href="{{ route('posts.create') }}" class="nav-link">
                           <i class="fa fa-plus-circle"></i> {{ trans('forum.posts.create') }}
                         </a>
                       </li>

                       <li class="nav-item">
                          <a href="{{ route('newshub.create') }}" class="nav-link">
                           <i class="fa fa-plus-circle"></i> {{ trans('forum.newshub.create') }}
                          </a>
                       </li>
                        
                     @endif
                 @endforeach
            @endif

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown01">
                        <a class="dropdown-item" href="{{ route('sessions.destroy') }}">
                            Logout
                        </a>

                        <form id="logout-form" action="" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </li>
            @endif
        </ul>

    </div>
</nav>
