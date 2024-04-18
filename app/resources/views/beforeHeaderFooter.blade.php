<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title><!--たぶんなんか入れる-->

    <div>
        <div>
            <a><!--ロゴ入れる--></a><!--リンク先追加する-->
        </div>
        <div>
            <a href="{{ route('login')}}">ログイン</a>
            <a href="{{ route('newRegistration')}}">新規登録</a>
        </div>
    </div>
</head>
<body>
    @yield('content')<!--←この中に,他ファイルに書いてある(アットマーク)sencion~(アットマーク)endsectionまでの部分が入る-->

    <footer>
    </footer>

</body>
</html>