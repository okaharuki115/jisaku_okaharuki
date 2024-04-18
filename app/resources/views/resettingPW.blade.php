@extends('beforeHeaderFooter')
@section('content')
    <div>
        <div>パスワード再設定</div>
        <div>メールアドレスを入力し、送信ボタンを押してください</div>
        <div>メールが届きましたらURLからアクセスしパスワードを再設定してください</div>
    </div>

    <div>
        <form><!--actionとpost追加する-->
            @csrf
            <div>
                <input type="text" id="email" name="email"/><!--メールアドレス入力欄-->
            </div>

            <button type="submit">送信</button>
        </form>
    </div>

@endsection