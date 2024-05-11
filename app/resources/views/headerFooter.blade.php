<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('stylesheet')
</head>

<body>
    <div>
        <nav>
            <div><!--ロゴ(クリックしたらtop.phpに飛ぶ)-->
                <a href="{{ route('move.top')}}"><img src="{{ asset('img/logo/logo2.png') }}" class="img-fluid" alt=""></a>
            </div>
            
            <div>
                <!--ログイン中の場合-->
                @if(Auth::check())
                    <span>{{ Auth::user()->name }}</span><!--ユーザーの名前を表示-->
                    
                    <!--ログアウト機能-->
                    <a href="#" id="logout" class="my-navbar-item">ログアウト</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: note;">
                         @csrf
                    </form>
                    <script>
                        document.getElementById('logout').addEventListener('click', function(event){
                        event.preventDefault();
                        document.getElementById('logout-form').submit();
                        });
                    </script>
                    <!--ログアウト機能-->

                <!--ログイン中でない場合-->
                @else
                    <a href="{{ route('login') }}">ログイン</a><!--Auth内の「login」というルートを通す-->
                    <a href="{{ route('register') }}">新規登録</a><!--Auth内の「register」というルートを通す-->
                @endif
            </div>

            <!--↓いらんくなったら消す-->
            <div>--------------------------------------------------------------------</div>
            
        </nav>


        
    </div>
    @yield('content')<!--←この中に,他ファイルに書いてある(アット)sencion~(アット)endsectionまでの部分が入る-->

    <!--↓いらんくなったら消す-->
    <div>--------------------------------------------------------------------</div>

    <footer>
        <!--ログイン中の場合（ログイン中でない場合はfooter表示しないので、elseは記述しない？）-->
        @if(Auth::check())
            <a href="{{ route('searchPost') }}">投稿検索</a>
            <a href="{{ route('newPost') }}">新規投稿</a>
            <a href="{{ route('login') }}">マイページへ</a>
        @endif
    </footer>

</body>
</html>