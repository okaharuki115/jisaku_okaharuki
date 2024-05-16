@extends('headerFooter')

@section('content')
<main class="py-4">
        <div class="col-md-5 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="card-body">
                    
                        <div> 
                            <div>
                                <label for='content' class='mt-2'>画像</label>
                                <div><img src="{{ asset('img/' . $postDeleteId . '/' . $deletePost['image']) }}" class="img-fluid" alt="" width="700" height="700"></div><!--【画像表示】-->
                            </div>
                            
                            <div>
                                <label for='title'>タイトル</label>
                                <div>{{ $deletePost['title']}}</div><!--編集未-->
                            </div>
                            
                            <div>
                                <label for='amount' class='mt-2'>金額</label>
                                <div>{{ $deletePost['amount']}}</div><!--編集未-->
                            </div>

                            <div>
                                <label for='content' class='mt-2'>内容</label>
                                <div>{{ $deletePost['content']}}</div><!--編集未-->
                            </div>
                        </div>

                        
                        <a href="{{ route('delete.complete', ['id' => $postDeleteId] )}}" class="ml-5">
                            <button class='btn btn-primary w-25 mt-3'>削除</button>
                        </a> 

                        <div>
                            <button type="button" onClick="history.back()">戻る</button>
                        </div>

                    
                    </div>

                </div>
            </div>
        </div>
    </main>





@endsection