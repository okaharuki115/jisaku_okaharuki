@extends('headerFooter')

@section('content')

    <div></div><!--画像入れる-->
    <div>
        <div>
            <div>タイトル</div>
            <div>{{ $makeRequestData['post']['title'] }}</div><!--タイトル表示-->
        </div>
        <div>
            <div>内容</div>
            <div>{{ $makeRequestData['content'] }}</div><!--内容表示-->
        </div>
        <div>
            <div>電話番号</div>
            <div>{{ $makeRequestData['tel'] }}</div><!--電話番号表示-->
        </div>
        <div>
            <div>メールアドレス</div>
            <div>{{ $makeRequestData['email'] }}</div><!--メールアドレス表示-->
        </div>
        <div>
            <div>期日</div>
            <div>{{ $makeRequestData['limit'] }}</div><!--期日表示-->
        </div>
        <div>
            <div>ステータス</div>
            <div></div><!--ステータス表示　未-->
        </div>
    </div>

    <a  class="ml-5"><!--リンク先追加-->
        <button class='btn btn-primary w-25 mt-3'>修正</button><!--buttonの後ろの「type='submit'」削除した-->
    <a>

    <div>
        <button type="button" onClick="history.back()">戻る</button>
    </div>

@endsection