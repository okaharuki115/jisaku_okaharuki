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
        /* color: #070868;  */
        color: #424242;
    }
    /* 詳細ボタン aタグの文字色を変更*/
    a.custom-link {
        color: #FFFFFF; 
        padding:10px
    }
    /* ボタンの色を変更する */
    .btn-custom {
        background-color: #424242;
        color: white;
        border: none;
        border-radius: 10px;
        padding: 10px 20px;
    }/* サブボタンの色を変更する */
    .sub-btn-custom {
            background-color: #FFFFFF;
            color: #424242;
            border: 2px solid #424242;
            border-radius: 10px;
            padding: 2px;
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

                    <form action="{{ route('editMypage')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div>                            
                            <div>
                                <label for='name' class='mt-2 textcolor-darkgray custom-font-weight'>ユーザー名</label>
                                <input type='text' class='form-control' name='name' id='name' value="{{ $editData['name']}}"/>
                            </div>
                            
                            <div>
                                <label for='email' class='mt-2 textcolor-darkgray custom-font-weight'>メールアドレス</label>
                                <input type='text' class='form-control' name='email' id='email' value="{{ $editData['email']}}"/>
                            </div>

                            <div>
                                <label for="icon" class='textcolor-darkgray custom-font-weight'>アイコン</label>
                                <input type="file" name="icon" id='icon'><!--←【アイコン画像選択欄】-->
                            </div>

                            <div class='row justify-content-center'>
                                <button type='submit' class='btn-custom w-25 mt-3'>変更</button>
                            </div> 
                        </div>

                        <div>
                            <button type="button" class='sub-btn-custom w-25 mt-3' onClick="history.back()">戻る</button>
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