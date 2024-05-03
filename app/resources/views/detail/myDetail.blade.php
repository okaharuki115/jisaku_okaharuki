@extends('headerFooter')

@section('content')

<form action="{{ route('editMyPost')}}" method="post"><!--ルート名変更未-->
    @csrf
    <!--ここに↓の画像版記述-->
    <input type='hidden' class='form-control' name='title' value="{{ $Post_with_User['user']['name']}}"/>
    <input type='hidden' class='form-control' name='title' value="{{ $Post_with_User['title']}}"/>
    <input type='hidden' class='form-control' name='content' id='content' value="{{ $Post_with_User['content']}}"/>
    <input type='hidden' class='form-control' name='amount' id='amount' value="{{ $Post_with_User['amount']}}"/>

    
    <div></div><!--画像入れる-->
    <div>
        <div>
            <div></div><!--アイコン表示-->
            <div>{{ $Post_with_User['user']['name'] }}</div><!--ユーザー名表示-->
        </div>
        <div>
            <div>タイトル</div>
            <div>{{ $Post_with_User['title'] }}</div><!--タイトル表示-->
        </div>
        <div>
            <div>内容</div>
            <div>{{ $Post_with_User['content'] }}</div><!--内容表示-->
        </div>
        <div>
            <div>金額</div>
            <div>{{ $Post_with_User['amount'] }}</div><!--金額表示-->
        </div>
    </div>

    <div>
        <div class='row justify-content-center'>
            <button type='submit' class='btn btn-primary w-25 mt-3'>編集</button>
        </div> 
    </div>
</form>

<a>削除</a><!--リンク先追加--><!--削除ボタンはformタグの外に記述でいい？-->

@endsection