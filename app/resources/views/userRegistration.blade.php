@extends('beforeHeaderFooter')
@section('content')
    <div>
        <form action="{{ route('newRegistration')}}" method="post">
            @csrf
            <div>
                <div>ユーザー名</div>
                <input type="text" id="name" name="name"/><!--ユーザー名入力欄-->
            </div>
            <div>
                <div>メールアドレス</div>
                <input type="text" id="email" name="email"/><!--メールアドレス入力欄-->
            </div>
            <div>
                <div>アイコン</div>
                <!--ここにアイコン保存欄を作る-->
            </div>
            <div>
                <div>パスワード</div>
                <input type="text" id="password" name="password"/><!--パスワード入力欄-->
            </div>

            <button type="submit">登録</button>
        </form>
    </div>

@endsection