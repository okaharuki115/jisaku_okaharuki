@extends('headerFooter')
@section('content')
        <div>【検索結果】</div>
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
                @foreach($posts as $post) 
                <tr>
                    <th>
                        <a href="{{ route('other.detail',['id'=>$post['id']])}}">詳細</a>
                    </th>
                    <th><!--↓【アイコン表示】-->
                        @if($post['user']['icon'])
                            <div>
                                <img src="{{ asset('img/mypage/' . $post['user']['id'] . '/' . $post['user']['icon']) }}" class="img-fluid" alt="" width="50" height="50">
                            </div>
                        @else
                        @endif
                    </th><!--↑【アイコン表示】-->

                    <th scope='col'>{{ $post['user']['name'] }}</th>
                    <th scope='col'>{{ $post['title'] }}</th>
                    <th scope='col'>{{ $post['amount'] }}</th>
                </tr>
                @endforeach
            </tbody>
            </table>
        </div>  
        
        <div>
            <button type="button" onClick="history.back()" class='btn btn-primary w-10 mt-3'>戻る</button>
        </div>
@endsection

