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
            border-radius: 30px;
        }
        /*フォントを太くする*/
        .custom-font-weight {
            font-weight: 700; /* 400はnormal、700はbold */
        }
</style>
<body>
<div id="app">
    <div>
    <!--上半分-->
        <div class="row">
            <div class="col-md-1"><!--d-grid gap-3 d-sm-flex justify-content-sm-center p-3--><!--col-md-1-->
                <!--↓【アイコン表示】（「もしアイコン画像の情報があれば表示させる」とするのでifで囲む）-->

                <div class="mt-3 ml-3"><!--me-sm-3-->
                @if(Auth::user()->icon)
                    <img src="{{ asset('img/mypage/' . Auth::user()->id . '/' . Auth::user()->icon) }}" class="img-fluid rounded-circle" alt="" width="60" height="60" >
                @else
                @endif
                </div>
                <!--↑【アイコン表示】-->

                <div class="px-4">
                    <div class="textcolor-darkgray custom-font-weight mt-1">{{ Auth::user()->name }}</div><!--ユーザー名表示-->
                    <div class="textcolor-darkgray custom-font-weight mt-1">{{ Auth::user()->email }}</div><!--メールアドレス表示-->
                </div>
            </div>

            <div class="col-md-10">
                <div class="row text-center w-75 mx-auto">
                    <div class="col-md-3">
                        <span class="fa-stack fa-4x">
                            <img src="{{ asset('img/player/player1.jpg') }}" class="img-fluid rounded-circle" alt="" width="80" height="80">
                        </span>
                        <h4 class="my-3 textcolor-darkgray custom-font-weight">posted</h6>
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
                            <img src="{{ asset('img/player/player2.jpg') }}" class="img-fluid rounded-circle" alt="" width="80" height="80">
                        </span>
                        <h4 class="my-3 textcolor-darkgray custom-font-weight">favorite</h6>
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
                            <img src="{{ asset('img/player/player3.jpg') }}" class="img-fluid rounded-circle" alt="" width="80" height="80">
                        </span>
                        <h4 class="my-3 textcolor-darkgray custom-font-weight">made a request</h6>
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
                            <img src="{{ asset('img/player/player4.jpg') }}" class="img-fluid rounded-circle" alt="" width="80" height="80">
                        </span>
                        <h4 class="my-3 textcolor-darkgray custom-font-weight">requested</h6>
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

            <div class="col-md-1"><!--d-grid gap-3 d-sm-flex justify-content-sm-end-->
                <div class="row">   
                    <div>
                        <button type="button" class="btn-custom mt-3 mr-2 p-2">
                            <a href="{{ route('editMypage')}}" class="custom-link">編集</a><!--,['id' => $mypageId] を書いてたけど消した-->
                        </button>
                    </div>  
                    <div>
                        <button type="button" class="btn-custom mt-2 mr-2 p-2">
                            <a href="{{ route('withdraw')}}" class="custom-link">退会</a>
                        </button>
                    </div> 
                </div> 
            </div>
        </div>
        <!--  -->


    </div>   
</div>  
</body> 
        


@endsection