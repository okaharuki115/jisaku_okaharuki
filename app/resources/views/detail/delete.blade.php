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
        <main class="py-2">
                <div class="col-md-7 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-body">
                                <div class="container">
                                    <div class="row gx-4 gx-lg-5 align-items-center">
                                        <div class="col-md-6">
                                            <div><img src="{{ asset('img/' . $postDeleteId . '/' . $deletePost['image']) }}" class="img-fluid" alt="" width="700" height="700"></div><!--【画像表示】-->
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <table>
                                                <tr>
                                                    <th class="p-3">{{ $deletePost['title']}}</th>
                                                </tr>
                                                
                                                <tr>
                                                    <th class="p-3">{{ $deletePost['amount']}}</th>
                                                </tr>

                                                <tr>
                                                    <th class="p-3">{{ $deletePost['content']}}</th>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                        <div class="row justify-content-center">
                            
                            <a href="{{ route('delete.complete', ['id' => $postDeleteId] )}}" class="ml-5">
                                <button class='btn btn-custom m-3'>削除</button>
                            </a> 
                          
                        
                            <button type="button" class='btn btn-custom m-3' onClick="history.back()">戻る</button>
                            
                        </div>
                    
                </div>
            </main>
    </div>
</body>





@endsection