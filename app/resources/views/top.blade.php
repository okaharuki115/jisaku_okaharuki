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

        /* 背景色設定 */
        /* .bg-color {
            background-color: #EABB3A;
        } */
        /* テキストの色を紺色に設定
        .textcolor-navy {
            color: #070868; 
        } */
        /*フォントを太くする*/
        .custom-font-weight {
            font-weight: 700; /* 400はnormal、700はbold */
        }
        

</style>
<body>
<div id="app" class="bg-color">
    <div>
        
        <h2 class="page-section-heading text-center text-white custom-font-weight text-uppercase p-5">postlist</h2>
            <div class="mx-auto w-50">
                <table class="table table-borderless" width="600px">
                    <thead>
                        <tr>
                            <th></th><!--「詳細」の上部分-->
                            <th></th><!--「アイコン」の上部分-->
                            <th scope='col' class="text-white">ユーザー名</th><!--col は、そのth要素が列方向に対する見出しであることを示す-->
                            <th scope='col' class="text-white">タイトル</th>
                            <th scope='col' class="text-white">金額</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts_users as $post_user) 
                        <tr>
                            <th>
                                <a href="{{ route('other.detail',['id'=>$post_user['id']])}}">詳細</a>
                            </th>
                            <th><!--↓【アイコン表示】-->
                                @if($post_user['user']['icon'])
                                <div>
                                    <img src="{{ asset('img/mypage/' . $post_user['user']['id'] . '/' . $post_user['user']['icon']) }}" class="rounded-circle" alt="" width="50" height="50">
                                </div>
                                @else
                                @endif
                            </th><!--↑【アイコン表示】-->
                            <th scope='col' class="text-white">{{ $post_user['user']['name'] }}</th>
                            <th scope='col' class="text-white">{{ $post_user['title'] }}</th><!--blade上で変数を表示させるときは波カッコの形で記述する-->
                            <th scope='col' class="text-white">{{ $post_user['amount'] }}</th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>   
          
    </div>   
</div>   
</body>
@endsection

