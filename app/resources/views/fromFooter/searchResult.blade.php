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
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        /*フォントを太くする*/
        .custom-font-weight {
            font-weight: 700; /* 400はnormal、700はbold */
        }
        /* ボタンの色を変更する */
        .btn-custom {
            /* background-color: #424242;
            color: white;
            border: none;
            border-radius: 30px; */
            background: linear-gradient(45deg, #00B2B2, #f79200);/*f79200*/
            color: white;
            border: none;
            border-radius: 30px;
        }
        /* テキストの色をチャコールグレーに設定 */
        .textcolor-darkgray {
            /* color: #070868;  */
            color: #424242;
        }
        /* テキストの色を茶色に設定 */
        .textcolor-brown {
            /* color: #FF6D05; */
            color: #B28500;
        }
        /* サブボタンの色を変更する */
        .sub-btn-custom {
            background-color: #FFFFFF;
            color: #424242;
            border: 2px solid #424242;
            border-radius: 10px;
            padding: 8px 16px;
        }
        /* 詳細ボタン aタグの文字色を変更*/
        a.custom-link {
            color: #FFFFFF; 
            padding:10px
        }

</style>
<body>
<div id="app" class="bg-color d-flex flex-column min-vh-100">

    <h2 class="page-section-heading text-center textcolor-darkgray custom-font-weight text-uppercase p-4">search results</h2>
        <div class="mx-auto w-50">
            <table class="table table-borderless" width="600px">
                <thead>
                    <tr>
                        <th></th><!--「詳細」の上部分-->
                        <th></th><!--「アイコン」の上部分-->
                        <th scope='col' class="textcolor-brown">ユーザー名</th><!--col は、そのth要素が列方向に対する見出しであることを示す-->
                        <th scope='col' class="textcolor-brown">タイトル</th>
                        <th scope='col' class="textcolor-brown">金額</th>
                    </tr>
                </thead>
            <tbody>
                @foreach($posts as $post) 
                <tr>
                    <th>
                        <button type="button" class="btn-custom">
                            <a href="{{ route('other.detail',['id'=>$post['id']])}}" class="custom-link">詳細</a>
                        </button>
                    </th>
                    <th><!--↓【アイコン表示】-->
                        @if($post['user']['icon'])
                            <div>
                                <img src="{{ asset('img/mypage/' . $post['user']['id'] . '/' . $post['user']['icon']) }}" class="img-fluid rounded-circle" alt="" width="50" height="50">
                            </div>
                        @else
                        @endif
                    </th><!--↑【アイコン表示】-->

                    <th scope='col' class="text-white">{{ $post['user']['name'] }}</th>
                    <th scope='col' class="text-white">{{ $post['title'] }}</th>
                    <th scope='col' class="text-white">{{ $post['amount'] }}</th>
                </tr>
                @endforeach
            </tbody>
            </table>
        </div>  
        
        <div class="row justify-content-center">
            <button type="button" onClick="history.back()" class='sub-btn-custom custom-font-weight mb-3 text-center'>戻る</button>
        </div>
</div>
</body>
@endsection

