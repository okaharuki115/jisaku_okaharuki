@extends('headerFooter')

@section('content')
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

                    <form action="{{ route('editMypost.complete', ['id' => $editMypostId])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div>                         
                            <div>
                                <label for='title' class='mt-2'>タイトル</label>
                                <input type='text' class='form-control' name='title' id='title' value="{{ $editData['title']}}"/>
                            </div>
                            
                            <div>
                                <label for='amount' class='mt-2'>金額</label>
                                <input type='text' class='form-control' name='amount' id='amount' value="{{ $editData['amount']}}"/>
                            </div>

                            <div>
                                <label for='content' class='mt-2'>内容</label>
                                <input type='text' class='form-control' name='content' id='content' value="{{ $editData['content']}}"/>
                            </div>

                            <div>
                                <label for='image' class='mt-2'>画像</label>
                                <input type="file" name="image"id='image'><!--←【画像選択欄】-->
                            </div>

                            <div class='row justify-content-center'>
                                <button type='submit' class='btn btn-primary w-25 mt-3'>編集</button>
                            </div> 
                        </div>

                        <div>
                            <button type="button" onClick="history.back()">戻る</button>
                        </div>

                    </form>
                    </div>

                </div>
            </div>
        </div>
    </main>





@endsection