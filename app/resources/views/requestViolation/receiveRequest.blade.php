@extends('headerFooter')

@section('content')

<div class="mx-auto w-50">
    <table class="table table-borderless" width="600px">
        <tbody>
            <tr>
                <td class="p-2">依頼された投稿のタイトル</td>
                <td class="p-2">{{ $receiveRequestData['post']['title'] }}</td><!--タイトル表示-->
            </tr>
            <tr>
                <td class="p-2">内容</td>
                <td class="p-2">{{ $receiveRequestData['content'] }}</td><!--内容表示-->
            </tr>
            <tr>
                <td class="p-2">電話番号</td>
                <td class="p-2">{{ $receiveRequestData['tel'] }}</td><!--電話番号表示-->
            </tr>
            <tr>
                <td class="p-2">メールアドレス</td>
                <td class="p-2">{{ $receiveRequestData['email'] }}</td><!--メールアドレス表示-->
            </tr>
            <tr>
                <td class="p-2">期日</td>
                <td class="p-2">{{ $receiveRequestData['limit'] }}</td><!--期日表示-->
            </tr>
        </tbody>
    </table>
</div>

<div class="row justify-content-center">
    <div class="col-md-6">
        <a href="{{ route('requestComplete', ['id' => $receiveRequestId])}}" class="ml-5">
            <button class='btn btn-primary w-10 mt-3'>完了</button><!--「完了」ボタン押したらその投稿のステータスが２(完了)になる-->
        <a>
    </div>

    <div class="col-md-6">
        <button type="button" class='btn btn-primary w-10 mt-3' onClick="history.back()">戻る</button>
    </div>
</div>

@endsection












