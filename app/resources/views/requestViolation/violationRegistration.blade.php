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
<main class="py-5">
        <div class="col-md-5 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="card-body">

                    <div class="mx-auto w-50">
                        <table class="table table-borderless" width="600px">
                            <tbody>
                                <tr>
                                    <td class="p-2">{{ $Post_with_User['title'] }}</td><!--タイトル表示-->
                                </tr>
                            
                                <tr>
                                    <td class="p-2">{{ $Post_with_User['content'] }}</td><!--内容表示-->
                                </tr>
                            </tbody>
                        </table>
                    </div>

                        <!--↓バリデーション(6-5P8参照)-->
                        <div class ='panel-body'>
                            @if($errors->any())
                            <div class='alert alert-danger'>
                                <ul>
                                    @foreach($errors->all() as $message)
                                    <li>{{ $message }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                        </div>
                        <!--↑バリデーション(6-5P8参照)-->

                        <form action="{{ route('ihan', ['id' => $ihanId])}}" method="post">
                        @csrf
                        
                            <div>
                                <label for='comment' class='mt-2'>違反コメント</label>
                                <input type='text' class='form-control' name='comment' id='comment'/>
                            </div>

                            <div class='row justify-content-center'>
                                <button type='submit' class='btn btn-custom mt-3'>報告</button>
                            </div> 

                        </form>
                        
                        <div>
                            <button type="button" class='btn sub-btn-custom mt-3' onClick="history.back()">戻る</button>
                        </div>

                    
                    </div>

                </div>
            </div>
        </div>
    </main>
</div>
</body>





@endsection