@extends('headerFooter')

@section('content')
    <div><!--上半分-->
        <div>
            <!--↓【アイコン表示】（「もしアイコン画像の情報があれば表示させる」とするのでifで囲む）-->
            @if(Auth::user()->icon)
            <div>
                <img src="{{ asset('img/mypage/' . Auth::user()->id . '/' . Auth::user()->icon) }}" >
            </div>
            @else
            @endif
            <!--↑【アイコン表示】-->

            <div>
                <div>{{ Auth::user()->name }}</div><!--ユーザー名表示-->
                <div>{{ Auth::user()->email }}</div><!--メールアドレス表示-->
            </div>
        </div>
        
        <div>
            <a href="{{ route('editMypage')}}">編集</a><!--,['id' => $mypageId] を書いてたけど消した-->
            <a href="{{ route('withdraw')}}">退会</a>
            <a href="{{ route('administer')}}">管理者画面</a>
        </div>
    </div>

    <div><!--下半分-->
        <div>
            <div>（自分の）投稿履歴</div>
            <div>お気に入り投稿履歴</div>
            <div>依頼（した）履歴</div>
            <div>依頼（された）履歴</div>
        </div>

        <div>
            <div>↓（自分の投稿履歴）</div><!--後で消す-->
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

            <div>↓（お気に入り投稿履歴）</div><!--後で消す-->
            <div><!--お気に入り投稿履歴-->
                <!--アットforeach記述-->
                <div>
                    <div></div><!--タイトルを表示-->
                    <div>
                        <a>詳細</a><!--リンク先追加-->
                    </div>
                </div>
                <!--エンドforeach記述-->
            </div>

            <div>↓（依頼した履歴）</div><!--後で消す-->
            <div><!--依頼した履歴-->
            <div>
                @foreach($makeRequestData as $makeRequest)
                <div>
                    <div>{{ $makeRequest['post']['title'] }}</div><!--タイトルを表示-->
                    <div>
                        <a href="{{ route('makeRequestDetail',['id'=>$makeRequest['id']])}}">詳細</a><!--リンク先追加-->
                    </div>
                </div>
                @endforeach
            </div>
            
            

            <div>↓（依頼された履歴）</div><!--後で消す-->
            <div><!--依頼（された）履歴-->
                <!--アットforeach記述-->
                <div>
                    <div></div><!--タイトルを表示-->
                    <div>
                        <a>詳細</a><!--リンク先追加-->
                    </div>
                </div>
                <!--エンドforeach記述-->
            </div>

            
        </div>
    </div>   
        


@endsection