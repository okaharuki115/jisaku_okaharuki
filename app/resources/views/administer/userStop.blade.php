<!--アットextends('headerFooter')-->
<!--アットextends('layouts.auth')-->
@extends('layouts.auth')

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
        <main class="py-4">
            <div class="col-md-5 mx-auto mt-5">
                      
                <div class="text-center custom-font-weight text-white">{{ $stopUser['name'] }}</div>
                <div class="text-center custom-font-weight text-white">このユーザーを停止させますか</div>
                <div class="row justify-content-center">
                    <div class="col text-center">
                        <form method="post" action="{{ route('userStopComplete',['id'=>$userStopId]) }}">
                            @csrf
                            @method('delete')
                            <input type="submit" class='btn btn-custom  mt-3' value="はい">
                        </form>
                    </div>
                    <div class="col-md text-center">
                        <div onClick="history.back()"class='btn btn-custom mt-3'>いいえ</div>
                    </div>
                </div>

                       
            </div>
        </main>
    </div>
</body>

@endsection