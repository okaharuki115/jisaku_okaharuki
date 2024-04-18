@extends('beforeHeaderFooter')
@section('content')
    <div>
        <form><!--actionとpost追加する-->
            @csrf
            <div>
                <div>メールアドレス</div>
                <input type="text" id="email" name="email"/><!--メールアドレス入力欄-->
            </div>
            <div>
                <div>パスワード</div>
                <input type="text" id="password" name="password"/><!--パスワード入力欄-->
            </div>

            <button type="submit">ログイン</button>
        </form>

        <div>
            <a href="{{ route('newRegistration')}}">新規ユーザー登録</a><!--リンク先追加-->
            <a href="{{ route('rePassword')}}">パスワード再設定</a><!--リンク先追加-->
        </div>
    </div>

@endsection