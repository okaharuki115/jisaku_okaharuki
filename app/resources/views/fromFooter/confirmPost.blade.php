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
    /* テキストの色をチャコールグレーに設定 */
    .textcolor-darkgray {
            color: #424242; 
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
    /*フォントを太くする*/
    .custom-font-weight {
        font-weight: 700; /* 400はnormal、700はbold */
    }
</style>
<body>
    <div id="app" class="bg-color">
        <main class="py-4">
                <div class="col-md-5 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-body">

                            <form action="{{ route('complete.post')}}" method="post">
                                    @csrf
                                    <input type='hidden' class='form-control' name='title' value="{{ $newData['title']}}"/>
                                    <input type='hidden' class='form-control' name='amount' id='amount' value="{{ $newData['amount']}}"/>
                                    <input type='hidden' class='form-control' name='content' id='content' value="{{ $newData['content']}}"/>
                                    <input type="hidden" class='form-control' name="image" value="{{ $newImageName }}"><!--←【画像版記述】-->

                                    <div>                            
                                    <div class="row custom-font-weight textcolor-darkgray">
                                        <label for='title' class="mr-5 ml-3">タイトル</label>
                                        <div>{{ $newData['title']}}</div><!--タイトルデータ引っ張ってきて記述-->
                                    </div>
                                    
                                    <div class="row custom-font-weight textcolor-darkgray">
                                        <label for='amount' class='mr-5 ml-3'>金額</label>
                                        <div class="ml-4">{{ $newData['amount']}}</div>
                                    </div>

                                    
                                    <div class="row custom-font-weight textcolor-darkgray">
                                        <label for='content' class='mr-5 ml-3'>内容</label>
                                        <div class="ml-4">{{ $newData['content']}}</div>
                                    </div>

                                    <div class="custom-font-weight textcolor-darkgray">
                                        <label for='content' class='mt-2 mr-5'>画像</label>
                                        <div  class="justify-content-center"><img src="{{ $image }}" class="img-fluid" alt="" width="500" height="500"></div><!--【画像表示】-->
                                    </div>

                                    <div class='row justify-content-center'>
                                        <button type='submit' class='btn-custom w-25 mt-3'>投稿</button>
                                    </div> 
                                </div>

                                <div>
                                    <button type="button" onClick="history.back()" class='sub-btn-custom mt-3'>戻る</button>
                                </div>

                            </form><!--←これはsumbitのボタンの下に書く-->
                            </div>

                        </div>
                    </div>
                </div>
            </main>
    </div>
</body>




@endsection