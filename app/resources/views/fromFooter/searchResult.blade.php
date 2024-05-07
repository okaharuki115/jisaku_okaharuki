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
                <!-- アットforeach書く -->
                <tr>
                    <th>
                        <a>詳細</a><!--リンク先追加-->
                    </th>
                    <th><!--↓【アイコン表示】-->
                        <!-- アットif書く -->
                        <div>
                            <!--img記述-->
                        </div>
                        <!-- アットelse書く -->
                        <!-- アットendif書く -->
                    </th><!--↑【アイコン表示】-->

                    <th scope='col'><!--ユーザー名のデータ引っ張って記述--></th>
                    <th scope='col'><!--タイトルのデータ引っ張って記述--></th>
                    <th scope='col'><!--金額のデータ引っ張って記述--></th>
                </tr>
                <!-- アットendforeach書く -->
            </tbody>
            </table>
        </div>  
        
        <div>
            <button type="button" onClick="history.back()">戻る</button>
        </div>
@endsection

