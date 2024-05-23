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
    /* 詳細ボタン aタグの文字色を変更*/
    a.custom-link {
        color: #FFFFFF; 
        padding:10px
    }
    /* ボタンの色を変更する */
    .btn-custom {
        background-color: #424242;
        color: white;
        border: none;
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

    <h2 class="page-section-heading text-center text-white custom-font-weight text-uppercase mt-4">post detail</h2>
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6">
                    @if($Post_with_User['image'])
                    <div><img src="{{ asset('img/' . $myId . '/' . $Post_with_User['image']) }}" class="img-fluid" alt="" width="500" height="500"></div><!--画像入れる-->
                    @else
                    @endif
                </div>
                <div class="col-md-6">
                    <div class="row justify-content-center">
                        <div>
                            <!--↓【アイコン表示】（「もしアイコン画像の情報があれば表示させる」とするのでifで囲む）-->
                            @if(Auth::user()->icon)
                            <div class="mr-3 ml-3">
                                <img src="{{ asset('img/mypage/' . Auth::user()->id . '/' . Auth::user()->icon) }}" class="img-fluid rounded-circle" alt="" width="50" height="50">
                            </div>
                            @else
                            @endif
                            <!--↑【アイコン表示】-->
                        </div>
                        <div class="textcolor-darkgray custom-font-weight mt-auto mb-auto">{{ $Post_with_User['user']['name'] }}</div><!--ユーザー名表示-->
                    </div>
                    <table class="ml-5">
                        <tr>
                            <!--row textcolor-darkgray custom-font-weight justify-content-around w-75 mt-2 mb-2-->
                            <th class="p-4">タイトル</th><!--ml-5 mr-3-->
                            <th class="p-4">{{ $Post_with_User['title'] }}</th><!--タイトル表示-->
                        </tr>
                        <tr>
                            <th class="p-4">内容</th>
                            <th class="p-4">{{ $Post_with_User['content'] }}</th><!--内容表示-->  
                        </tr>
                        <tr>
                            <th class="p-4">金額</th>
                            <th class="p-4">{{ $Post_with_User['amount'] }}</th><!--金額表示-->
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <a href="{{ route('editMyPost', ['id' => $myId] )}}">
                <button class='btn-custom m-3'>編集</button><!--buttonの後ろの「type='submit'」削除した-->
            <a>

            <a href="{{ route('post.delete', ['id' => $myId] )}}">
                <button class='btn-custom m-3'>削除</button><!--buttonの後ろの「type='submit'」削除した-->
            <a>
        </div>
    </div>
</body>
    


@endsection