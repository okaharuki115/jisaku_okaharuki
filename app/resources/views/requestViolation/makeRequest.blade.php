@extends('headerFooter')

@section('content')
<style>
    /*↓背景色をbodyタグ全体に適用させる*/
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }
    body {
        background-color: #EABB3A; /* 好きな背景色に変更 */
    }
    #app {
        flex: 1;
    }
    /* ボタンの色を変更する */
    .btn-custom {
        background-color: #424242;
        color: white;
        border: none;
        border-radius: 10px;
        padding: 10px 20px;
    }
    /* サブボタンの色を変更する */
    .sub-btn-custom {
        background-color: #FFFFFF;
        color: #424242;
        border: 2px solid #424242;
        border-radius: 10px;
        padding: 8px 16px;
    }
    /* テキストの色をチャコールグレーに設定 */
    .textcolor-darkgray {
        /* color: #070868;  */
        color: #424242;
    }
    /*フォントを太くする*/
    .custom-font-weight {
        font-weight: 700; /* 400はnormal、700はbold */
    }
    /* 詳細ボタン aタグの文字色を変更*/
    a.custom-link {
        color: #E58F04; 
        padding:10px
    }
</style>
<body>
    <div id="app" class="bg-color">
        <div class="container d-flex justify-content-center align-items-center">
            <div class="row">
                <div class="col-12">
                    <table class="table table-borderless mt-5 mb-5">
                        <tbody>
                            <tr>
                                <td class="p-3 textcolor-darkgray custom-font-weight">依頼した投稿のタイトル</td>
                                <td class="p-3 textcolor-darkgray custom-font-weight">{{ $makeRequestData['post']['title'] }}</td><!--タイトル表示-->
                            </tr>
                            <tr>
                                <td class="p-3 textcolor-darkgray custom-font-weight">内容</td>
                                <td class="p-3 textcolor-darkgray custom-font-weight">{{ $makeRequestData['content'] }}</td><!--内容表示-->
                            </tr>
                            <tr>
                                <td class="p-3 textcolor-darkgray custom-font-weight">電話番号</td>
                                <td class="p-3 textcolor-darkgray custom-font-weight">{{ $makeRequestData['tel'] }}</td><!--電話番号表示-->
                            </tr>
                            <tr>
                                <td class="p-3 textcolor-darkgray custom-font-weight">メールアドレス</td>
                                <td class="p-3 textcolor-darkgray custom-font-weight">{{ $makeRequestData['email'] }}</td><!--メールアドレス表示-->
                            </tr>
                            <tr>
                                <td class="p-3 textcolor-darkgray custom-font-weight">期日</td>
                                <td class="p-3 textcolor-darkgray custom-font-weight">{{ $makeRequestData['limit'] }}</td><!--期日表示-->
                            </tr>
                        <tbody>
                    </table>  
                </div>
            </div>
        </div>

        <div class="row justify-content-center">

            <a href="{{ route('iraiModification', ['id' => $makeRequestId])}}">
                <button class='btn-custom m-3'>修正</button><!--buttonの後ろの「type='submit'」削除した-->
            <a>
        
            <button type="button" class='btn sub-btn-custom m-3' onClick="history.back()">戻る</button>
        
        </div>

    </div>
</body>


    

                

@endsection


