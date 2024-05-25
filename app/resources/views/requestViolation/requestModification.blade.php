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
            <main class="py-3">
                <div class="col-md-5 mx-auto">

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

                    <form action="{{ route('iraiModification',['id' => $iraiModificationId])}}" method="post">
                        @csrf
                        <div>  
                            <div>
                                <label for='content' class='mt-2 textcolor-darkgray custom-font-weight'>内容</label>
                                <input type='text' class='form-control' name='content' id='content' value="{{ $iraiModificationData['content']}}"/>
                            </div> 
                                                
                            <div>
                                <label for='tel' class='mt-2 textcolor-darkgray custom-font-weight'>電話番号</label>
                                <input type='text' class='form-control' name='tel' id='tel' value="{{ $iraiModificationData['tel']}}"/>
                            </div> 
                            
                            <div>
                                <label for='email' class='mt-2 textcolor-darkgray custom-font-weight'>メールアドレス</label>
                                <input type='text' class='form-control' name='email' id='email' value="{{ $iraiModificationData['email']}}"/>
                            </div> 

                            <div>
                                <label for='limit' class='mt-2 textcolor-darkgray custom-font-weight'>期日</label>
                                <input type='date' class='form-control' name='limit' id='limit' value="{{ $iraiModificationData['limit']}}"/>
                            </div>
                            <div class='row justify-content-center'>
                                <button type='submit' class='btn btn-custom mt-3'>登録</button>
                            </div>
                        </div>
                        <div>
                            <button type="button" class='btn sub-btn-custom w-10 mt-3' onClick="history.back()">戻る</button>
                        </div>
                    </form>

                </div>
            </main>
    </div>
</body>





@endsection