@extends('headerFooter')

@section('content')
<main class="py-4">
        <div class="col-md-5 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="card-body">
                        <!--↓6-5P8の記述 バリデーション-->
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
                        <!--↑6-5P8の記述　バリエーション-->
                        
                        <form action="{{ route('confirm.post')}}" method="post" enctype="multipart/form-data"><!--ファイルをアップロードする場合は、フォームがマルチパート形式である必要があるのでenctypeを記述-->
                            @csrf
                            <div>
                                <label for='title'>タイトル</label>
                                <input type='text' class='form-control' name='title' value="{{ old('title')}}"/><!--old('name属性')で入力値の保持ができる-->
                            </div>
                            
                            <div>
                                <label for='amount' class='mt-2'>金額</label>
                                <input type='amount' class='form-control' name='amount' id='amount' value="{{ old('amount')}}"/>
                            </div>

                            <div>
                                <label for='content' class='mt-2'>内容</label>
                                <input type='content' class='form-control' name='content' id='content' value="{{ old('content')}}"/>
                            </div>

                            <div>
                                <label for='image' class='mt-2'>画像</label>
                                <input type="file" name="image"id='image'><!--←【画像選択欄】-->
                            </div>

                            <div class='row justify-content-center'>
                                <button type='submit' class='btn btn-primary w-25 mt-3'>投稿</button>
                            </div> 
                        </form>

                        <div>
                            <a href="{{ route('login') }}">マイページへ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>





@endsection