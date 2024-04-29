<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title><!--たぶんなんか入れる-->
</head>

<body>
    <div>
        <nav>
            <div>
                <a><!--ここにロゴ入れる--></a><!--リンク先追加-->
            </div>
            
            <div>
                <!--ログイン中の場合-->
                @if(Auth::check())
                    <span>{{ Auth::user()->name }}</span><!--ユーザーの名前を表示-->
                    
                    <!--↓編集（未）-->
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
                    <!--↑編集（未）-->

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
            <a>投稿検索</a><!--リンク先追加する-->
            <a href="{{ route('newPost') }}">新規投稿</a>
        @endif
    </footer>

</body>
</html>