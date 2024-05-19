@extends('headerFooter')

@section('content')
    <!--上半分-->
        <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
            <!--↓【アイコン表示】（「もしアイコン画像の情報があれば表示させる」とするのでifで囲む）-->
            <div class="px-4 me-sm-3">
            @if(Auth::user()->icon)
                <img src="{{ asset('img/mypage/' . Auth::user()->id . '/' . Auth::user()->icon) }}" class="img-fluid" alt="" width="60" height="60" >
            @else
            @endif
            </div>
            <!--↑【アイコン表示】-->

            <div class="px-4">
                <div>{{ Auth::user()->name }}</div><!--ユーザー名表示-->
                <div>{{ Auth::user()->email }}</div><!--メールアドレス表示-->
            </div>
        </div>
        
        <div class="d-grid gap-3 d-sm-flex justify-content-sm-end">
            <div class="px-4">
                <a href="{{ route('editMypage')}}">編集</a><!--,['id' => $mypageId] を書いてたけど消した-->
            </div>  
            <div class="px-4">
                <a href="{{ route('withdraw')}}">退会</a>
            </div> 
        </div>
    

    <div class="mx-auto w-75"><!--下半分-->
        <div class="row gx-4 gx-lg-5 row-cols-4 row-cols-md-4 row-cols-xl-4 justify-content-center">
            <div>（自分の）投稿履歴</div>
            <div>お気に入り投稿履歴</div>
            <div>依頼（した）履歴</div>
            <div>依頼（された）履歴</div>
        </div>

        <div class="row gx-4 gx-lg-5 row-cols-4 row-cols-md-4 row-cols-xl-4 justify-content-center">
            
            <div><!--自分の投稿履歴-->
                
                @foreach($loginPostData as $loginPost)
                <div>
                    <div>{{ $loginPost['title'] }}</div><!--タイトルを表示-->
                    <div>
                        <a href="{{ route('myDetail',['id'=>$loginPost['id']])}}">詳細</a>
                    </div>
                </div>
                @endforeach
            </div>

            <div><!--お気に入り投稿履歴-->
                
                @foreach($favoritePostData as $favoritePost)
                <div>
                    <div>{{ $favoritePost['post']['title'] }}</div><!--タイトルを表示-->
                    <div>
                        <a href="{{ route('other.detail',['id'=>$favoritePost['post']['id']])}}">詳細</a>
                    </div>
                </div>
                @endforeach
            </div>

            
            <div><!--依頼した履歴-->
            
            <div>
                @foreach($makeRequestData as $makeRequest)
                @if(!empty($makeRequest['post']))
                <div>
                    <div>{{ $makeRequest['post']['title'] }}</div><!--タイトルを表示-->
                    <div>
                        <a href="{{ route('makeRequestDetail',['id'=>$makeRequest['id']])}}">詳細</a>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
            </div>
            
            
            <div><!--依頼（された）履歴-->
                
                @foreach($receiveRequestData as $receiveRequest)
                <div>
                    <div>{{ $receiveRequest['title'] }}</div><!--タイトルを表示-->
                    <div>
                        <a href="{{ route('receiveRequestDetail',['id'=>$receiveRequest['id']])}}">詳細</a>
                    </div>
                </div>
                @endforeach
            </div>

            
        </div>
    </div>   
        


@endsection