@extends('headerFooter')

@section('content')
    <div><img src="{{ asset('img/' . $otherId . '/' . $Post_with_User['image']) }}" class="img-fluid" alt="" width="700" height="700"></div><!--【画像表示】-->
    <div>
        <div>
            <!--↓【アイコン表示】-->
            @if($Post_with_User['user']['icon'])
            <div>
                <img src="{{ asset('img/mypage/' . $Post_with_User['user']['id'] . '/' . $Post_with_User['user']['icon']) }}" class="img-fluid" alt="" width="50" height="50">
            </div>
            @else
            @endif
            <!--↑【アイコン表示】-->
            <div>{{ $Post_with_User['user']['name'] }}</div><!--ユーザー名表示-->
        </div>
        <div>
            <div>タイトル</div>
            <div>{{ $Post_with_User['title'] }}</div><!--タイトル表示-->
        </div>
        <div>
            <div>内容</div>
            <div>{{ $Post_with_User['content'] }}</div><!--内容表示-->
        </div>
        <div>
            <div>金額</div>
            <div>{{ $Post_with_User['amount'] }}</div><!--金額表示-->
        </div>
    </div>

    <div>
        <!--いいねされてるとき-->
        <!--like_existを実行するときに ↓この２つを渡す-->
        @if($like_model->like_exist(Auth::user()->id,$otherId))
            <p class="favorite-marke">
            <a class="js-like-toggle loved" href="" data-postid="{{ $otherId }}">いいね済<i class="fas fa-heart"></i></a>
            <span class="likesCount">{{$post_like->likes_count}}</span>
            </p>
        <!--いいねされてないとき-->
        @else
            <p class="favorite-marke">
            <a class="js-like-toggle" href="" data-postid="{{ $otherId }}">いいね<i class="fas fa-heart"></i></a>
            <span class="likesCount">{{$post_like->likes_count}}</span>
            </p>
        @endif​
    </div>

    <div>
        <a href="{{ route('irai', ['id' => $otherId])}}" class="ml-5">
            <button class='btn btn-primary w-10 mt-3'>依頼</button><!--buttonの後ろの「type='submit'」削除した-->
        <a>

        <a href="{{ route('ihan', ['id' => $otherId])}}" class="ml-5">
            <button class='btn btn-primary w-10 mt-3'>違反報告</button><!--buttonの後ろの「type='submit'」削除した-->
        <a>
        
        <div>
            <button type="button" onClick="history.back()" class='btn btn-primary w-10 mt-3'>戻る</button>
        </div>
    </div>


    <!--【いいね機能】-->

    <script>
        $(function () {
            console.log('読み込み');
                var like = $('.js-like-toggle');//いいねのaタグをlikeっていう変数にしてる
                var likePostId;

                like.on('click', function () {//aタグを押したとき
                    var $this = $(this);//
                    likePostId = $this.data('postid');//postidを紐づけ(aタグ内のpostidをとってきてる)
                    $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: '/ajaxlike',  //routeの記述(Ajaxの処理をするとき必要)
                            type: 'POST', //受け取り方法の記述（GETもある）
                            data: {
                                'post_id': likePostId //コントローラーに渡すパラメーター(likePostIdを渡す)
                            },
                    })

                        // Ajaxリクエストが成功した場合
                        .done(function (data) {
                            console.log('成功');
                //lovedクラスを追加
                            $this.toggleClass('loved'); 

                //.likesCountの次の要素のhtmlを「data.postLikesCount」の値に書き換える
                            $this.next('.likesCount').html(data.postLikesCount); 

                        })
                        // Ajaxリクエストが失敗した場合
                        .fail(function (data, xhr, err) {
                //ここの処理はエラーが出た時にエラー内容をわかるようにしておく。
                //とりあえず下記のように記述しておけばエラー内容が詳しくわかります。笑
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