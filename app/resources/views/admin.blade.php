<!--アットextends('headerFooter')-->
<!--アットextends('layouts.auth')-->
@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div>【管理者画面】</div>

                <div>
                    <div>ユーザー一覧</div>
                    <table>
                        <thead>
                        </thead>
                    <tbody>
                        @foreach($userlists as $userlist) 
                        <tr>
                            <th scope='col'>{{ $userlist['name'] }}</th><!--ここにユーザー名のデータ引っ張って記述-->
                            <th scope='col'>{{ $userlist['post_count'] }}件</th><!--ここにユーザー名のデータ引っ張って記述-->
                            <th scope='col'><a href="{{ route('userStop',['id'=>$userlist['id']])}}">停止</a></th><!--ユーザー停止-->
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div> 

                <div>
                    <div>投稿一覧</div>
                    <table>
                        <thead>
                        </thead>
                    <tbody>
                        @foreach($postlists as $postlist) 
                        <tr>
                            <th scope='col'>{{ $postlist['title'] }}</th><!--ここにタイトルのデータ引っ張って記述-->
                            <th scope='col'>{{ $postlist['violation_count'] }}件</th><!--ここに件数のデータ引っ張って記述-->
                            <th scope='col'>{{ $postlist['user']['name'] }}</th><!--ここにユーザー名のデータ引っ張って記述-->
                            @if($postlist['status']==3)
                            <th scope='col'>停止済</th>
                            @else
                            <th scope='col'><a href="{{ route('postStop',['id'=>$postlist['id']])}}">停止</a></th><!--投稿停止-->
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div> 





            </div>
        </div>
    </div>
</div>
@endsection