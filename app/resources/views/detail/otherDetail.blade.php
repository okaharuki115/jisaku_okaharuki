@extends('headerFooter')

@section('content')
<style>
    /*【いいね機能】いいねを押したときに追加するclassの内容を記述*/
    .loved i {
    color: red !important;
    }
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

<h2 class="page-section-heading text-center text-white custom-font-weight text-uppercase mt-4">post detail</h2>
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6"><img src="{{ asset('img/' . $otherId . '/' . $Post_with_User['image']) }}" class="img-fluid" alt="" width="500" height="500"></div><!--【画像表示】-->
            <div class="col-md-6">
                <div class="row justify-content-center">
                    <div><!--↓【アイコン表示】-->
                        @if($Post_with_User['user']['icon'])
                        <div class="mr-3 ml-3">
                            <img src="{{ asset('img/mypage/' . $Post_with_User['user']['id'] . '/' . $Post_with_User['user']['icon']) }}" class="img-fluid rounded-circle" alt="" width="50" height="50">
                        </div>
                        @else
                        @endif
                    </div><!--↑【アイコン表示】-->
                    <div class="custom-font-weight textcolor-darkgray mt-auto mb-auto">{{ $Post_with_User['user']['name'] }}</div><!--ユーザー名表示-->
                </div>
                <table class="ml-5">
                    <tr>
                        <th class="p-4">タイトル</th>
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

    <div class="d-flex justify-content-center">
        @if(Auth::user())
        <div>
            <!--いいねされてるとき-->
            <!--いいねされてるかどうかを、like_existメソッド(Like.php内に記述)で確認-->
            <!-- 　　　　　　　　　　　　　　like_existに ↓この２つのidを渡す -->
            @if($like_model->like_exist(Auth::user()->id,$otherId))
                <p class="favorite-marke">
                <!--「data-postid」はaタグ内に格納するpostid、「$otherId」はotherDetail.phpを表示させるためのotherDetailメソッド(at D‥Controller)から渡されたid情報-->
                <a class="js-like-toggle loved" href="" data-postid="{{ $otherId }}"><i class="fas fa-heart fa-2x"></i></a>
                <span class="likesCount">{{$post_like->likes_count}}</span><!--$post_likeはotherDetailメソッド(at D‥Controller)から渡された-->
                </p>
            <!--いいねされてないとき-->
            @else
                <p class="favorite-marke">
                <a class="js-like-toggle" href="" data-postid="{{ $otherId }}"><i class="fas fa-heart fa-2x"></i></a>
                <span class="likesCount">{{$post_like->likes_count}}</span>
                </p>
            @endif
        </div>
        @else
        <div>
            <a href="{{ route('login') }}">ログイン</a>後お気に入り登録可能です
        </div>
        @endif
    </div>

    <div class="row justify-content-center">
        <a href="{{ route('irai', ['id' => $otherId])}}" class="ml-5 text-center">
            <button class='btn btn-custom m-3'>依頼</button><!--buttonの後ろの「type='submit'」削除した-->
        <a>

        <a href="{{ route('ihan', ['id' => $otherId])}}" class="ml-5 text-center">
            <button class='btn btn-custom m-3'>違反報告</button><!--buttonの後ろの「type='submit'」削除した-->
        <a>
        
        <div class="ml-5 text-center">
            <button type="button" onClick="history.back()" class='btn sub-btn-custom m-3'>戻る</button>
        </div>
    </div>
</div>
</body>


    <!--【いいね機能】-->

    <script>
        $(function () {
            console.log('読み込み');
                //変数の宣言
                //いいねのaタグをlikeっていう変数にしてる(aタグのclass=js-like-toggleに紐づいてる)
                var like = $('.js-like-toggle');
                var likePostId;

                like.on('click', function () {//aタグを押したとき
                    var $this = $(this);//(このthisは上の行のlikeを指す)thisをjQueryオブジェクトとして、変数$thisに格納→後のコードで使うため
                    likePostId = $this.data('postid');//postidを紐づけ(aタグ内のpostidをとってきてる)($this→like→.js-like-toggle→aタグのclassの.js-like-toggleとさかのぼって、結果aタグに紐づくことになる)
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '/ajaxlike',  //routeの記述(Ajaxの処理をするときは必ずいる)→これによってweb.phpのルーティングが実行される（？）
                        type: 'POST', //受け取り方法の記述（GETもある）
                        data: {
                            'post_id': likePostId //コントローラーに渡すパラメーター(likePostIdを渡す)
                        },
                    })

                        // Ajaxリクエストが成功した場合
                        //引数dataに、(D‥Contrillerで)return response()->json()で返した値（postLikesCount）が入ってる
                        .done(function (data) {
                            console.log('成功');
                            //lovedクラスを追加(色をリアルタイムで変更するため)
                            $this.toggleClass('loved'); 

                            //.likesCountの次の要素のhtmlを「data.postLikesCount」の値に書き換える
                            $this.next('.likesCount').html(data.postLikesCount); 
                        })

                        // Ajaxリクエストが失敗した場合
                        .fail(function (data, xhr, err) {
                            //ここの処理はエラーが出た時にエラー内容をわかるようにしておく
                            // console.log('エラー');
                            // console.log(err);
                            // console.log(xhr);
                            console.log('エラーが発生しました:');
                            console.log('ステータスコード:', xhr.status);
                            console.log('レスポンステキスト:', xhr.responseText);
                            console.log('ステータス:', status);
                            console.log('エラー:', error);
                        });
                    
                    return false;
                });
        });
    </script>
@endsection