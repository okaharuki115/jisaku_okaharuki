@extends('headerFooter')

@section('content')
    @if($Post_with_User['image'])
    <div><img src="{{ asset('img/' . $myId . '/' . $Post_with_User['image']) }}"></div><!--画像入れる-->
    @else
    @endif
    <div>
        <div>
            <div></div><!--アイコン表示　未-->
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

    <a href="{{ route('editMyPost', ['id' => $myId] )}}" class="ml-5">
        <button class='btn btn-primary w-25 mt-3'>編集</button><!--buttonの後ろの「type='submit'」削除した-->
    <a>

    <a href="{{ route('post.delete', ['id' => $myId] )}}" class="ml-5">
        <button class='btn btn-primary w-25 mt-3'>削除</button><!--buttonの後ろの「type='submit'」削除した-->
    <a>

@endsection