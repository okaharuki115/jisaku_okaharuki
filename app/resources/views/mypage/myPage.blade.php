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
        /*↑背景色をbodyタグ全体に適用させる*/

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
        /* 詳細ボタン aタグの文字色を変更*/
        a.custom-link {
            color: #424242; 
            padding:10px;
            font-weight:bold;
        }
        /* ボタンの色を変更する */
        .btn-custom {
            background-color: #FFFFFF;
            color: #424242;
            border: none;
            border-radius: 30px;
        }
        /*フォントを太くする*/
        .custom-font-weight {
            font-weight: 700; /* 400はnormal、700はbold */
        }
        /* テキストをグラデーションにする */
        .text-gradient {
            background: linear-gradient(45deg, #00B2B2, #f79200);
            -webkit-background-clip: text;
            color: transparent;
            /* background-clip: text; */
        }
</style>
<body>
<div id="app">
    <div>
    <!--上半分-->

        <div class="row d-flex justify-content-center  mt-3">
            
                <!--↓【アイコン表示】（「もしアイコン画像の情報があれば表示させる」とするのでifで囲む）-->

                <div class="mt-3 ml-3"><!--me-sm-3-->
                @if(Auth::user()->icon)
                    <img src="{{ asset('img/mypage/' . Auth::user()->id . '/' . Auth::user()->icon) }}" class="img-fluid rounded-circle" alt="" width="60" height="60" >
                @else
                @endif
                </div>
                <!--↑【アイコン表示】-->

                
                    <div class="text-white custom-font-weight mt-3 p-2">{{ Auth::user()->name }}</div><!--ユーザー名表示-->
                    <div class="text-white custom-font-weight mt-3 p-2">{{ Auth::user()->email }}</div><!--メールアドレス表示-->
                
            

            
                 
                    <div>
                        <button type="button" class="btn-custom mt-3  p-2">
                            <a href="{{ route('editMypage')}}" class="custom-link">編集</a><!--,['id' => $mypageId] を書いてたけど消した-->
                        </button>
                    </div>  
                    <div>
                        <button type="button" class="btn-custom mt-3 ml-2 p-2">
                            <a href="{{ route('withdraw')}}" class="custom-link">退会</a>
                        </button>
                    </div> 
                 
            
        </div>

        <div class="row d-flex justify-content-center">

            <div class="col-md-10">
                <div class="row text-center w-78 mx-auto m-4">
                    <div class="col-md-3">
                        <span class="fa-stack fa-4x">
                            <img src="{{ asset('img/blueIcon/posted.jpg') }}" class="img-fluid rounded-circle" alt="" width="120" height="120">
                        </span>
                        <h1 class="my-3 text-gradient custom-font-weight">posted</h1>
                        <div><!--自分の投稿履歴-->
                            @foreach($loginPostData as $loginPost)
                            <div class="container">
                                <div class="row justify-content-center mt-2 mb-2">
                                    <div class="text-white custom-font-weight">{{ $loginPost['title'] }}</div><!--タイトルを表示-->
                                    <div>
                                        <a href="{{ route('myDetail',['id'=>$loginPost['id']])}}" class="custom-link">詳細</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-3">
                        <span class="fa-stack fa-4x">
                            <img src="{{ asset('img/blueIcon/favorite.jpg') }}" class="img-fluid rounded-circle" alt="" width="120" height="120">
                        </span>
                        <h1 class="my-3 text-gradient custom-font-weight">favorite</h1>
                        <div><!--お気に入り投稿履歴-->
                            @foreach($favoritePostData as $favoritePost)
                            <div class="container">
                                <div class="row justify-content-center mt-2 mb-2">
                                    <div class="text-white custom-font-weight">{{ $favoritePost['post']['title'] }}</div><!--タイトルを表示-->
                                    <div>
                                        <a href="{{ route('other.detail',['id'=>$favoritePost['post']['id']])}}"  class="custom-link">詳細</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-3">
                        <span class="fa-stack fa-4x">
                            <img src="{{ asset('img/blueIcon/makerequest.jpg') }}" class="img-fluid rounded-circle" alt="" width="120" height="120">
                        </span>
                        <h1 class="my-3 text-gradient custom-font-weight">made a request</h1>
                        <div><!--依頼した履歴-->
                            @foreach($makeRequestData as $makeRequest)
                            @if(!empty($makeRequest['post']))
                            <div class="container">
                                <div class="row justify-content-center mt-2 mb-2">
                                    <div class="text-white custom-font-weight">{{ $makeRequest['post']['title'] }}</div><!--タイトルを表示-->
                                    <div>
                                        <a href="{{ route('makeRequestDetail',['id'=>$makeRequest['id']])}}"  class="custom-link">詳細</a>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-3">
                        <span class="fa-stack fa-4x">
                            <img src="{{ asset('img/blueIcon/requested.jpg') }}" class="img-fluid rounded-circle" alt="" width="120" height="120">
                        </span>
                        <h1 class="my-3 text-gradient custom-font-weight">requested</h1>
                        <div><!--依頼（された）履歴-->  
                            @foreach($receiveRequestData as $receiveRequest)
                            <div class="container">
                                <div class="row justify-content-center mt-2 mb-2">
                                    <div class="text-white custom-font-weight">{{ $receiveRequest['title'] }}</div><!--タイトルを表示-->
                                    <div>
                                        <a href="{{ route('receiveRequestDetail',['id'=>$receiveRequest['id']])}}"  class="custom-link">詳細</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
        <!--  -->


    </div>   
</div>  
</body> 
        


@endsection