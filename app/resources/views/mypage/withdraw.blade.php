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
    /* テキストの色をチャコールグレーに設定 */
    .textcolor-darkgray {
        /* color: #070868;  */
        color: #424242;
    }
    /* ボタンの色を変更する */
    .btn-custom {
        background-color: #424242;
        color: white;
        border: none;
        border-radius: 10px;
        padding: 10px 20px;
    }/* サブボタンの色を変更する */
    .sub-btn-custom {
            background-color: #FFFFFF;
            color: #424242;
            border: 2px solid #424242;
            border-radius: 10px;
            padding: 10px 20px;
        }
    /*フォントを太くする*/
    .custom-font-weight {
        font-weight: 700; /* 400はnormal、700はbold */
    }
</style>
<body>
<div id="app" class="bg-color">
<main class="py-5">
        <div class="col-md-5 mx-auto">
            
                <div class="card-body">
                    <div class="card-body">

                        <div class="text-center text-white custom-font-weight">退会されますか</div>

                        <div class="row justify-content-center">
                            <div class="col-md text-center">
                                <form method="post" action="{{ route('destroyUserDelete') }}">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" class='btn sub-btn-custom w-10 mt-3' value="はい">
                                </form>
                            </div>

                            <div class="col-md text-center">
                                <a href="{{ route('login') }}">
                                    <button type='submit' class='btn sub-btn-custom w-10 mt-3'>いいえ</button>
                                </a>
                            </div>
                        </div>

                    </div>

                </div>
            
        </div>
    </main>
</div>
</body>

@endsection