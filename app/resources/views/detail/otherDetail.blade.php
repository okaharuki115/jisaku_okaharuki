@extends('headerFooter')

@section('content')
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
        <a>依頼</a><!--リンク先追加-->
        <a>違反報告</a><!--リンク先追加-->
        <a>戻る</a><!--リンク先追加-->
    </div>


@endsection