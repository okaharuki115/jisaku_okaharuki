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
            border-radius: 30px;
        }
        /*フォントを太くする*/
        .custom-font-weight {
            font-weight: 700; /* 400はnormal、700はbold */
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
            padding: 10px 20px;
        }

</style>
<body>
<div id="app" class="bg-color">

<main class="py-4">
        <div class="col-md-5 mx-auto m-5">
            
                    <h2 class="page-section-heading text-center textcolor-darkgray custom-font-weight text-uppercase p-3">postsearch</h2>

                    <form action="{{ route('postSearch') }}" method="POST">
                        @csrf
                        <div> 
                            <!--タイトル-->
                            <div>
                                <label for='title' class='mt-2 custom-font-weight textcolor-darkgray'>タイトル</label>
                                <input type='text' class='form-control' name='title' id='title'/><!--value追加未-->
                            </div> 

                            <!--金額（プルダウン形式）-->
                            <label for='amount' class='mt-2 custom-font-weight textcolor-darkgray'>金額</label>
                            <div class="row">
                                <div class="col">
                                    
                                    <select name='amount1' class='form-control'>
                                        <option value="">選択してください</option>
                                        <option value="10000">10000</option>
                                        <option value="1000">1000</option>
                                        <option value="100">100</option>
                                        <option value="0">0</option>
                                    </select>
                                </div>

                                <div class="col-md-1 custom-font-weight textcolor-darkgray">~</div>

                                <div class="col">
                                    <select name='amount2' class='form-control'>
                                        <option value="">選択してください</option>
                                        <option value="10000">10000</option>
                                        <option value="1000">1000</option>
                                        <option value="100">100</option>
                                        <option value="0">0</option>
                                    </select>
                                </div>
                            </div>
                                
                            <!--内容-->
                            <div>
                                <label for='content' class='mt-2 custom-font-weight textcolor-darkgray'>内容</label>
                                <input type='text' class='form-control' name='content' id='content'/><!--value追加未-->
                            </div> 
                                                  
                            <div class='row justify-content-center'>
                                <button type='submit' class='btn-custom custom-font-weight w-25 mt-3'>検索</button>
                            </div>

                        </div>

                    </form>
                 
            
        </div>
    </main>
</div>
</body>




@endsection