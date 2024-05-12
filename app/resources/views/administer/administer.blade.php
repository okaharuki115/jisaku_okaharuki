<!--管理者画面はabmin.blade.phpで表示させるので、このファイルはのちに消す-->
@extends('headerFooter')
@section('content')
        <div>【管理者画面】</div>

        <div>
            <div>ユーザー一覧</div>
            <table>
                <thead>
                </thead>
            <tbody>
                <!--アットforeach-->
                <tr>
                    <th scope='col'>名前（仮）</th><!--ここにユーザー名のデータ引っ張って記述-->
                    <th scope='col'><a>再開</a></th><!--リンク先追加-->
                </tr>
                <!--アットendforeach-->
            </tbody>
            </table>
        </div> 

        <div>
            <div>投稿一覧</div>
            <table>
                <thead>
                </thead>
            <tbody>
                <!--アットforeach-->
                <tr>
                    <th scope='col'>タイトル（仮）</th><!--ここにタイトルのデータ引っ張って記述-->
                    <th scope='col'>〇〇件（仮）</th><!--ここに件数のデータ引っ張って記述-->
                    <th scope='col'>名前（仮）</th><!--ここにユーザー名のデータ引っ張って記述-->
                    <th scope='col'><a>停止</a></th><!--リンク先追加-->
                </tr>
                <!--アットendforeach-->
            </tbody>
            </table>
        </div> 
        
        
@endsection

