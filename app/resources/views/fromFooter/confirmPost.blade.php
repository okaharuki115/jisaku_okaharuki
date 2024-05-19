@extends('headerFooter')

@section('content')
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
                            <div>
                                <label for='title'>タイトル</label>
                                <div>{{ $newData['title']}}</div><!--タイトルデータ引っ張ってきて記述-->
                            </div>
                            
                            <div>
                                <label for='amount' class='mt-2'>金額</label>
                                <div>{{ $newData['amount']}}</div>
                            </div>

                            <div>
                                <label for='content' class='mt-2'>内容</label>
                                <div>{{ $newData['content']}}</div>
                            </div>

                            <div>
                                <label for='content' class='mt-2'>画像</label>
                                <div><img src="{{ $image }}" class="img-fluid" alt="" width="700" height="700"></div><!--【画像表示】-->
                            </div>

                            <div class='row justify-content-center'>
                                <button type='submit' class='btn btn-primary w-25 mt-3'>投稿</button>
                            </div> 
                        </div>

                        <div>
                            <button type="button" onClick="history.back()" class='btn btn-primary w-10 mt-3'>戻る</button>
                        </div>

                    </form><!--←これはsumbitのボタンの下に書く-->
                    </div>

                </div>
            </div>
        </div>
    </main>





@endsection