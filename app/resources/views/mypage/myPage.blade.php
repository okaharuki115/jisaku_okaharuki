@extends('headerFooter')

@section('content')
<style>
        /* 背景色設定 */
        .bg-color {
            background-color: #EABB3A;
            
        }
        /* テキストの色を紺色に設定 */
        .textcolor-navy {
            color: #070868; 
        }
        /* 詳細ボタン aタグの文字色を変更*/
        a.custom-link {
            color: #070868; /* 文字色を紺色に設定 */
            padding:10px
        }
</style>
<div class="bg-color full-height">
    <div>
    <!--上半分-->
        <div class="d-grid gap-3 d-sm-flex justify-content-sm-center p-3">
            <!--↓【アイコン表示】（「もしアイコン画像の情報があれば表示させる」とするのでifで囲む）-->

            <div class="px-4 me-sm-3">
            @if(Auth::user()->icon)
                <img src="{{ asset('img/mypage/' . Auth::user()->id . '/' . Auth::user()->icon) }}" class="img-fluid rounded-circle" alt="" width="60" height="60" >
            @else
            @endif
            </div>
            <!--↑【アイコン表示】-->

            <div class="px-4">
                <div class="textcolor-navy">{{ Auth::user()->name }}</div><!--ユーザー名表示-->
                <div class="textcolor-navy">{{ Auth::user()->email }}</div><!--メールアドレス表示-->
            </div>
        </div>

        
        <div class="d-grid gap-3 d-sm-flex justify-content-sm-end">
            <div class="px-4">
                <a href="{{ route('editMypage')}}" class="custom-link">編集</a><!--,['id' => $mypageId] を書いてたけど消した-->
            </div>  
            <div class="px-4">
                <a href="{{ route('withdraw')}}"  class="custom-link">退会</a>
            </div> 
        </div>

        <div class="row text-center w-75 mx-auto">
            <div class="col-md-3">
                <span class="fa-stack fa-4x">
                    <img src="{{ asset('img/player/player1.jpg') }}" class="img-fluid rounded-circle" alt="" width="80" height="80">
                </span>
                <h4 class="my-3" class="text-white">posted</h6>
                <div><!--自分の投稿履歴-->
                    @foreach($loginPostData as $loginPost)
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="text-white">{{ $loginPost['title'] }}</div><!--タイトルを表示-->
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
                <h4 class="my-3" class="text-white">favorite</h6>
                <div><!--お気に入り投稿履歴-->
                    @foreach($favoritePostData as $favoritePost)
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="text-white">{{ $favoritePost['post']['title'] }}</div><!--タイトルを表示-->
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
                <h4 class="my-3" class="text-white">made a request</h6>
                <div><!--依頼した履歴-->
                    @foreach($makeRequestData as $makeRequest)
                    @if(!empty($makeRequest['post']))
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="text-white">{{ $makeRequest['post']['title'] }}</div><!--タイトルを表示-->
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
                <h4 class="my-3" class="text-white">requested</h6>
                <div><!--依頼（された）履歴-->  
                    @foreach($receiveRequestData as $receiveRequest)
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="text-white">{{ $receiveRequest['title'] }}</div><!--タイトルを表示-->
                            <div>
                                <a href="{{ route('receiveRequestDetail',['id'=>$receiveRequest['id']])}}"  class="custom-link">詳細</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!--  -->


    </div>   
</div>   
        


@endsection