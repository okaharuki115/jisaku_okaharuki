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
        <!--↓この記述を編集したところまではやった-->
        <a href="{{ route('irai', ['id' => $otherId])}}" class="ml-5">
            <button class='btn btn-primary w-25 mt-3'>依頼</button><!--buttonの後ろの「type='submit'」削除した-->
        <a>
        <!--↑この記述を編集したところまではやった-->

        
        <a>違反報告</a><!--リンク先追加-->
        
        <div>
            <button type="button" onClick="history.back()">戻る</button>
        </div>
    </div>


@endsection