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
            /* background-color: #424242;
            color: white;
            border: none;
            border-radius: 30px; */
            background: linear-gradient(45deg, #00B2B2, #f79200);/*f79200*/
            color: white;
            border: none;
            border-radius: 30px;
            padding: 8px 16px;
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
                        
                        <form action="{{ route('confirm.post')}}" method="post" enctype="multipart/form-data"><!--ファイルをアップロードする場合は、フォームがマルチパート形式である必要があるのでenctypeを記述-->
                            @csrf
                            <div>
                                <label for='title' class="textcolor-darkgray custom-font-weight">タイトル</label>
                                <input type='text' class='form-control' name='title' value="{{ old('title')}}"/><!--old('name属性')で入力値の保持ができる-->
                            </div>
                            
                            <div>
                                <label for='amount' class='mt-2 textcolor-darkgray custom-font-weight'>金額</label>
                                <input type='amount' class='form-control' name='amount' id='amount' value="{{ old('amount')}}"/>
                            </div>

                            <div>
                                <label for='content' class='mt-2 textcolor-darkgray custom-font-weight'>内容</label>
                                <input type='content' class='form-control' name='content' id='content' value="{{ old('content')}}"/>
                            </div>

                            <div>
                                <label for='image' class='mt-2 textcolor-darkgray custom-font-weight'>画像</label>
                                <input type="file" name="image"id='image'><!--←【画像選択欄】-->
                            </div>

                            <div class='row justify-content-center'>
                                <button type='submit' class='btn btn-custom custom-font-weight w-25 mt-3'>投稿</button>
                            </div> 
                        </form>

                        
                    </div>
                </div>
            
        </div>
    </main>
</div>
</body>




@endsection