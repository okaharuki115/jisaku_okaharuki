@extends('headerFooter')

@section('content')

    <div>
        <div>
            <div>依頼された投稿のタイトル</div>
            <div>{{ $receiveRequestData['post']['title'] }}</div><!--タイトル表示-->
        </div>
        <div>
            <div>内容</div>
            <div>{{ $receiveRequestData['content'] }}</div><!--内容表示-->
        </div>
        <div>
            <div>電話番号</div>
            <div>{{ $receiveRequestData['tel'] }}</div><!--電話番号表示-->
        </div>
        <div>
            <div>メールアドレス</div>
            <div>{{ $receiveRequestData['email'] }}</div><!--メールアドレス表示-->
        </div>
        <div>
            <div>期日</div>
            <div>{{ $receiveRequestData['limit'] }}</div><!--期日表示-->
        </div>
        
    </div>

    <a href="{{ route('requestComplete', ['id' => $receiveRequestId])}}" class="ml-5">
        <button class='btn btn-primary w-10 mt-3'>完了</button><!--「完了」ボタン押したらその投稿のステータスが２(完了)になる-->
    <a>

    <div>
        <button type="button" onClick="history.back()">戻る</button>
    </div>

@endsection












