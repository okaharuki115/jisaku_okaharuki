@extends('headerFooter')

@section('content')
    <div>【自分の投稿詳細画面】</div>

    @if($Post_with_User['image'])
    <div><img src="{{ asset('img/' . $myId . '/' . $Post_with_User['image']) }}" class="img-fluid" alt="" width="700" height="700"></div><!--画像入れる-->
    @else
    @endif
    <div>
        <div>
            <!--↓【アイコン表示】（「もしアイコン画像の情報があれば表示させる」とするのでifで囲む）-->
            @if(Auth::user()->icon)
            <div>
                <img src="{{ asset('img/mypage/' . Auth::user()->id . '/' . Auth::user()->icon) }}" class="img-fluid" alt="" width="50" height="50">
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


    <a href="{{ route('editMyPost', ['id' => $myId] )}}" class="ml-5">
        <button class='btn btn-primary w-10 mt-3'>編集</button><!--buttonの後ろの「type='submit'」削除した-->
    <a>

    <a href="{{ route('post.delete', ['id' => $myId] )}}" class="ml-5">
        <button class='btn btn-primary w-10 mt-3'>削除</button><!--buttonの後ろの「type='submit'」削除した-->
    <a>

    <!--↓【いいね機能】-->
    <button type="button" class='btn btn-primary w-10 mt-3' 
            :disabled="hasMyLike(u.likes)" @click="addLike(u.id)">いいね！</button>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.11/vue.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
    <script>

    new Vue({
        el: '#app',
        data: {
            users: [],
            ip: '{{ $ip }}'
        },
        methods: {
            addLike(userId) { // いいね！を追加 ・・・ ①

                const url = '/ajax/like';
                const params = { user_id: userId };
                axios.post(url, params)
                    .then(response => {

                        if(response.data.result === true) { // 追加に成功したらデータを更新

                            this.users = response.data.users;

                        }

                    });

            },
            hasMyLike(likes) { // 自分のIPが含まれているかチェック ・・・ ②

                if(likes.length) {

                    for(let like of likes) {

                        if(like.ip === this.ip) {

                            return true;

                        }

                    }

                }

                return false;

            }
        },
        mounted() {

            axios.get('/ajax/like/user_list')
                .then(response => {

                    this.users = response.data;

                });

        }
    });

    </script>
    <!--↑【いいね機能】-->


@endsection