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
</style>
<body>
    <div id="app" class="bg-color">
        <main class="py-4">
                <div class="col-md-8 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-body">
                            
                            <div class="container px-4 px-lg-5 my-2">
                                <div class="row gx-4 gx-lg-5 align-items-center">
                                    <div class="col-md-6">
                                        <label for='content' class='mt-2'>画像</label>
                                        <div><img src="{{ asset('img/' . $postDeleteId . '/' . $deletePost['image']) }}" class="img-fluid" alt="" width="700" height="700"></div><!--【画像表示】-->
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div>
                                            <label for='title'>タイトル</label>
                                            <div>{{ $deletePost['title']}}</div>
                                        </div>
                                        
                                        <div>
                                            <label for='amount' class='mt-2'>金額</label>
                                            <div>{{ $deletePost['amount']}}</div>
                                        </div>

                                        <div>
                                            <label for='content' class='mt-2'>内容</label>
                                            <div>{{ $deletePost['content']}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="container my-5">
                            <div class="row justify-content-center">
                                <div class="col">
                                    <a href="{{ route('delete.complete', ['id' => $postDeleteId] )}}" class="ml-5">
                                        <button class='btn btn-primary w-10 mt-3'>削除</button>
                                    </a> 
                                </div>

                                <div class="col">
                                    <button type="button" class='btn btn-primary w-10 mt-3' onClick="history.back()">戻る</button>
                                </div>
                            </div>
                            </div>


                        </div>
                    </div>
                </div>
            </main>
    </div>
</body>





@endsection