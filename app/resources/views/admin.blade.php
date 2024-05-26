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
    /*フォント変更*/
    body {
            /* font-family: 'Roboto', sans-serif; */
            font-family: "Montserrat", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        }
    /* ボタンの色を変更する */
    .btn-custom {
            background-color: #424242;
            color: white;
            border: none;
            border-radius: 30px;
            padding:0px 10px
    }
    /* 詳細ボタン aタグの文字色を変更*/
    a.custom-link {
            color: #FFFFFF; 
            padding:10px
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
    /* テキストの色をオレンジに設定 */
    .textcolor-orange {
        color: #FF6D05;
    }

    /*フォントを太くする*/
    .custom-font-weight {
        font-weight: 700; /* 400はnormal、700はbold */
    }
</style>
<body>
<div id="app" class="bg-color">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5 d-flex justify-content-center">
            <div><!--ユーザー一覧-->
                <h2 class="text-center text-white custom-font-weight text-uppercase">user list</h2>
                <table>
                    <thead>
                    </thead>
                <tbody>
                    <tr>
                        <th scope='col' class="p-2 textcolor-orange">ユーザー名</th>
                        <th scope='col' class="p-2 textcolor-orange">表示停止投稿</th>
                        <th scope='col'></th>
                    </tr>
                    @foreach($userlists as $userlist) 
                    <tr>
                        <th scope='col' class="p-2 text-white">{{ $userlist['name'] }}</th><!--ここにユーザー名のデータ引っ張って記述-->
                        <th scope='col' class="p-2 text-white">{{ $userlist['post_count'] }}件</th><!--ここにユーザー名のデータ引っ張って記述-->
                        <th scope='col' class="p-2"><!--ユーザー停止-->
                            <button class="btn-custom">
                                <a href="{{ route('userStop',['id'=>$userlist['id']])}}" class="custom-link ">停止</a>
                            </button>
                        </th>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div> 
        </div>
    
        <div class="col-md-7 d-flex justify-content-center">
            <div><!--投稿一覧-->
            <h2 class="text-center text-white custom-font-weight text-uppercase">post list</h2>
                <table>
                    <thead>
                    </thead>
                <tbody>
                    <tr>
                        <th scope='col' class="p-2 textcolor-orange">タイトル</th>
                        <th scope='col' class="p-2 textcolor-orange">違反報告</th>
                        <th scope='col' class="p-2 textcolor-orange">ユーザー名</th>
                        <th scope='col'></th>
                    </tr>
                    @foreach($postlists as $postlist) 
                    <tr>
                        <th scope='col' class="p-2 text-white">{{ $postlist['title'] }}</th><!--ここにタイトルのデータ引っ張って記述-->
                        <th scope='col' class="p-2 text-white">{{ $postlist['violation_count'] }}件</th><!--ここに件数のデータ引っ張って記述-->
                        <th scope='col' class="p-2 text-white">{{ $postlist['user']['name'] }}</th><!--ここにユーザー名のデータ引っ張って記述-->
                        @if($postlist['status']==3)
                        <th scope='col' class="p-2">停止済</th>
                        @else
                        <th scope='col' class="p-2"><!--投稿停止-->
                            <button class="btn-custom">
                                <a href="{{ route('postStop',['id'=>$postlist['id']])}}" class="custom-link ">停止</a>
                            </button>
                        </th>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div> 
        </div> 
    </div>          
</div>
</div>
</div>
</body>
@endsection