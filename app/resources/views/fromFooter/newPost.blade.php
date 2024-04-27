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
                        
                        <form><!--action,method追加未-->
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
                                <input type='amount' class='form-control' name='amount' id='amount' value="{{ old('amount')}}"/>
                            </div>

                            <div>
                                <label for='content' class='mt-2'>画像</label>
                                <!--ここに画像を挿入する欄を表示させるための記述を書く-->
                            </div>

                            <div class='row justify-content-center'>
                                <button type='submit' class='btn btn-primary w-25 mt-3'>投稿</button>
                            </div> 
                        </form>

                        <div>
                            <a>マイページへ</a><!--リンク先追加-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>





@endsection