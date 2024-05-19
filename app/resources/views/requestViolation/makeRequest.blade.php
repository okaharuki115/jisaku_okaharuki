@extends('headerFooter')

@section('content')

<div class="mx-auto w-50">
    <table class="table table-borderless" width="600px">
        <tbody>
            <tr>
                <td class="p-2">依頼した投稿のタイトル</td>
                <td class="p-2">{{ $makeRequestData['post']['title'] }}</td><!--タイトル表示-->
            </tr>
            <tr>
                <td class="p-2">内容</td>
                <td class="p-2">{{ $makeRequestData['content'] }}</td><!--内容表示-->
            </tr>
            <tr>
                <td class="p-2">電話番号</td>
                <td class="p-2">{{ $makeRequestData['tel'] }}</td><!--電話番号表示-->
            </tr>
            <tr>
                <td class="p-2">メールアドレス</td>
                <td class="p-2">{{ $makeRequestData['email'] }}</td><!--メールアドレス表示-->
            </tr>
            <tr>
                <td class="p-2">期日</td>
                <td class="p-2">{{ $makeRequestData['limit'] }}</td><!--期日表示-->
            </tr>
        <tbody>
    </table>  
</div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <a href="{{ route('iraiModification', ['id' => $makeRequestId])}}" class="ml-5">
                <button class='btn btn-primary w-10 mt-3'>修正</button><!--buttonの後ろの「type='submit'」削除した-->
            <a>
        </div>

        <div class="col-md-6">
            <button type="button" class='btn btn-primary w-10 mt-3' onClick="history.back()">戻る</button>
        </div>
    </div>


    

                

@endsection


