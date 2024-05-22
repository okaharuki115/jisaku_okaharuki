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
                                <label for='name' class='mt-2'>ユーザー名</label>
                                <input type='text' class='form-control' name='name' id='name' value="{{ $editData['name']}}"/>
                            </div>
                            
                            <div>
                                <label for='email' class='mt-2'>メールアドレス</label>
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
                            <button type="button" class='btn btn-primary w-10 mt-3' onClick="history.back()">戻る</button>
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