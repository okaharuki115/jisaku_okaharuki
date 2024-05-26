<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--【いいね機能】ハートのアイコンを使用するためにリンク↓を追加（ハートはFont Awesomeが提供する特定のアイコンで、Font Awesomeを使うためにCSSをHTMLに読み込む）-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <!--↓【いいね機能】作成時に追加-->
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />

    <!-- Bootstrap CSS （いる？）-->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('stylesheet')
</head>


<style>
        /* 背景色設定 */
        .custom-bg {
            background-color: #424242;
            /* background-image: linear-gradient(45deg, #ffcc00, #ff6699); */
            color: white;
        }
        /* フッターを画面の最下部に固定 */
        /* .footer {
            position: relative;
            bottom: 0;
            width: 100%;
        } */
        /* フォント変更 */
        body {
            /* font-family: 'Roboto', sans-serif; */
            font-family: "Montserrat", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        }

</style>


<header class="header">
<div>
    <div class="custom-bg">
        <nav class="navbar navbar-expand-lg text-uppercase navbar-custom" id="mainNav">
            <div class="container-fluid">
            <div class="d-flex justify-content-between w-100">
                <div class="col-md-4"><!--ロゴ(クリックしたらtop.phpに飛ぶ)--><!--center-block-->
                    <a href="{{ route('move.top')}}"><img src="{{ asset('img/logo/logo2.png') }}" class="img-fluid" alt="" width="50" height="50"></a>
                </div>
                
                <div class="col-md-8">
                    <!--↓ログイン後-->
                    @if(Auth::check())
                    <div class="d-flex flex-row justify-content-between"> 

                        <div class="col mt-3">
                            <a href="{{ route('searchPost') }}" class="text-white">投稿検索</a>
                        </div> 

                        <div class="col mt-3">
                            <a href="{{ route('newPost') }}" class="text-white">新規投稿</a>
                        </div> 

                        <div class="col mt-3">
                            <a href="{{ route('login') }}" class="text-white">マイページへ</a>
                        </div>   

                        <div class="col mt-3">
                            <span class="text-white">【ユーザー】{{ Auth::user()->name }}</span><!--ユーザーの名前を表示-->
                        </div> 
                        
                        <div class="mt-3"><!--ログアウト機能-->
                            <a href="#" id="logout" class="my-navbar-item text-white">ログアウト</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: note;">
                                @csrf
                            </form>
                            <script>
                                document.getElementById('logout').addEventListener('click', function(event){
                                event.preventDefault();
                                document.getElementById('logout-form').submit();
                                });
                            </script>
                        </div>

                    </div>    
                    <!--↑ログイン後-->

                        <!--↓ログイン前-->
                        @else
                        <div class="row">
                            <div class="col mt-3">
                                <a href="{{ route('login') }}" class="text-white">ログイン</a><!--Auth内の「login」というルートを通す-->
                            </div>  
                            <div class="col mt-3"> 
                                <a href="{{ route('register') }}" class="text-white">新規登録</a><!--Auth内の「register」というルートを通す-->
                            </div> 
                        </div>
                        
                        @endif
                        <!--↑ログイン前-->
                    
                </div>
            </div>
            </div>
        </nav>    
    </div>
</div>
</header>
@yield('content')<!--←この中に,他ファイルに書いてある(アット)sencion~(アット)endsectionまでの部分が入る-->






</html>