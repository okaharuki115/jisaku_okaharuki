@extends('headerFooter')

@section('content')
    <div><img src="{{ asset('img/' . $otherId . '/' . $Post_with_User['image']) }}"></div><!--【画像表示】-->
    <div>
        <div>
            <!--↓【アイコン表示】-->
            @if($Post_with_User['user']['icon'])
            <div>
                <img src="{{ asset('img/mypage/' . $Post_with_User['user']['id'] . '/' . $Post_with_User['user']['icon']) }}">
            </div>
            @else
            @endif
            <!--↑【アイコン表示】-->
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
        <a href="{{ route('irai', ['id' => $otherId])}}" class="ml-5">
            <button class='btn btn-primary w-10 mt-3'>依頼</button><!--buttonの後ろの「type='submit'」削除した-->
        <a>

        <a href="{{ route('ihan', ['id' => $otherId])}}" class="ml-5">
            <button class='btn btn-primary w-10 mt-3'>違反報告</button><!--buttonの後ろの「type='submit'」削除した-->
        <a>
        
        <div>
            <button type="button" onClick="history.back()" class='btn btn-primary w-10 mt-3'>戻る</button>
        </div>
    </div>


@endsection