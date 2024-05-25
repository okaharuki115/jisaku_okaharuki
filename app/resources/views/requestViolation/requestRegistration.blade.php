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
    /*フォントを太くする*/
    .custom-font-weight {
        font-weight: 700; /* 400はnormal、700はbold */
    }
    /* テキストの色をチャコールグレーに設定 */
    .textcolor-darkgray {
        /* color: #070868;  */
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
    /* 詳細ボタン aタグの文字色を変更*/
    a.custom-link {
        color: #FFFFFF; 
        padding:10px
    }
</style>
<body>
<div id="app" class="bg-color">
    <main class="py-3">
        <div class="col-md-5 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="card-body">

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

                    <form action="{{ route('irai', ['id' => $iraiId])}}" method="post">
                        @csrf
                        <div>          
                            <div>
                                <label for='content' class='mt-2 custom-font-weight textcolor-darkgray'>内容</label>
                                <input type='text' class='form-control' name='content' id='content'/><!--value削除済-->
                            </div>
                        
                            <div>
                                <label for='tel' class='mt-2 custom-font-weight textcolor-darkgray'>電話番号</label>
                                <input type='tel' class='form-control' name='tel' id='tel'/>
                            </div>
                            
                            <div>
                                <label for='email' class='mt-2 custom-font-weight textcolor-darkgray'>メールアドレス</label>
                                <input type='text' class='form-control' name='email' id='email'/>
                            </div>

                            <div>
                                <label for='limit' class='mt-2 custom-font-weight textcolor-darkgray'>期日</label>
                                <input type='date' class='form-control' name='limit' id='limit'/>
                            </div>

                            <div class='row justify-content-center'>
                                <button type='submit' class='btn btn-custom mt-3'>登録</button>
                            </div> 
                        </div>

                        <div>
                            <button type="button" class='btn sub-btn-custom mt-3 custom-font-weight' onClick="history.back()">戻る</button>
                        </div>

                    </form>
                    </div>

                </div>
            </div>
        </div>
    </main>
</div>
</body>





@endsection