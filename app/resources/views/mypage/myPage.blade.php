@extends('headerFooter')

@section('content')
    <div><!--上半分-->
        <div>
            <div><!--ここにアイコンを表示--></div>
            <div>
                <div>{{ Auth::user()->name }}</div><!--ユーザー名表示-->
                <div>{{ Auth::user()->email }}</div><!--メールアドレス表示-->
            </div>
        </div>
        <div>
            <a href="{{ route('editMypage')}}">編集</a><!--,['id' => $mypageId] を書いてたけど消した-->
            <a href="{{ route('withdraw')}}">退会</a><!--リンク先追加-->
            <a>管理者画面</a><!--リンク先追加-->
        </div>
    </div>

    <div><!--下半分-->
        <table>
            <thead>
                <tr>
                    <th scope='col'>（自分の）投稿履歴</th><!--col は、そのth要素が列方向に対する見出しであることを示す-->
                    <th scope='col'>お気に入り投稿履歴</th>
                    <th scope='col'>依頼（した）履歴</th>
                    <th scope='col'>依頼（された）履歴</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><!--自分の投稿履歴-->
                        <!--アットforeach書く-->
                        <tr>
                            <td>タイトル（仮）</td><!--タイトルを表示-->
                            <td>
                                <a>詳細</a><!--リンク先追加-->
                            </td>
                        </tr>
                        <!--アットendforeach書く-->
                    </td>

                    <td><!--お気に入り投稿履歴-->
                        <!--アットforeach書く-->
                        <tr>
                            <td>タイトル（仮）</td><!--タイトルを表示-->
                            <td>
                                <a>詳細</a><!--リンク先追加-->
                            </td>
                        </tr>
                        <!--アットendforeach書く-->
                    </td>

                    <td><!--依頼（した）履歴-->
                        <!--アットforeach書く-->
                        <tr>
                            <td>タイトル（仮）</td><!--タイトルを表示-->
                            <td>
                                <a>詳細</a><!--リンク先追加-->
                            </td>
                        </tr>
                        <!--アットendforeach書く-->
                    </td>

                    <td><!--依頼（された）履歴-->
                        <!--アットforeach書く-->
                        <tr>
                            <td>タイトル（仮）</td><!--タイトルを表示-->
                            <td>
                                <a>詳細</a><!--リンク先追加-->
                            </td>
                        </tr>
                        <!--アットendforeach書く-->
                    </td>
                </tr>
            </tbody>
        </table>
    </div>   
        


@endsection