@extends('beforeHeaderFooter')
@section('content')
        <div>全ユーザーの投稿一覧</div>
        <div>
            <table>
                <thead>
                    <tr>
                        <th></th><!--「詳細」の上部分-->
                        <th></th><!--「アイコン」の上部分-->
                        <th scope='col'>ユーザー名</th><!--col は、そのth要素が列方向に対する見出しであることを示す-->
                        <th scope='col'>タイトル</th>
                        <th scope='col'>金額</th>
                    </tr>
                </thead>
            <tbody>
                @foreach($posts_users as $post_user) 
                <tr>
                    <th>
                        <a href="{{ route('other.detail',['id'=>$post_user['id']])}}">詳細</a>
                    </th>
                    <th></th><!--←(未)アイコン入れる-->
                    <th scope='col'>{{ $post_user['user']['name'] }}</th>
                    <th scope='col'>{{ $post_user['title'] }}</th><!--blade上で変数を表示させるときは波カッコの形で記述する-->
                    <th scope='col'>{{ $post_user['amount'] }}</th>
                </tr>
                @endforeach
            </tbody>
            </table>
        </div>   
@endsection

