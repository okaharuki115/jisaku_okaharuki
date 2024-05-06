@extends('headerFooter')

@section('content')
<main class="py-4">
        <div class="col-md-5 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="card-body">

                    <form action="{{ route('editMypage')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div>                            
                            <div>
                                <label for='name' class='mt-2'>ユーザー名</label>
                                <input type='text' class='form-control' name='name' id='name' value="{{ $editData['name']}}"/>
                            </div>
                            
                            <div>
                                <label for='amount' class='mt-2'>メールアドレス</label>
                                <input type='text' class='form-control' name='email' id='email' value="{{ $editData['email']}}"/>
                            </div>

                            <div>
                                <label for="icon">アイコン</label>
                                <input type="file" name="icon" id='icon'><!--←【アイコン画像選択欄】-->
                            </div>

                            <div class='row justify-content-center'>
                                <button type='submit' class='btn btn-primary w-25 mt-3'>変更</button>
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