@extends('headerFooter')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col col-md-offset-3 col-md-6">
        <nav class="card mt-5">
          <div class="card-body">
            <!--エラーがある場合？-->
            @if($errors->any())
              <div class="alert alert-danger">
                @foreach($errors->all() as $message)
                  <p>{{ $message }}</p>
                @endforeach
              </div>
            @endif
            <!--エラーがない場合？-->
            <!--　　　　　　　　　↓auth内の「register」ルートを通すことで、登録してregister.blade.phpに飛ぶところまでの処理をしてくれる-->
            <form action="{{ route('register') }}" method="POST">
                @csrf
  
                <div>
                  <label for="name">ユーザー名</label>
                  <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" />
                </div>
  
                <div>
                  <label for="email">メールアドレス</label>
                  <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" />
                </div>
  

                
                <div>
                  <label for="password">パスワード</label>
                  <input type="password" class="form-control" id="password" name="password">
                </div>
  
                <div>
                  <!--PW確認欄入れないとエラー出る-->
                  <label for="password-confirm">パスワード（確認）</label>
                  <input type="password" class="form-control" id="password-confirm" name="password_confirmation">
                </div>
    
                <div>
                  <button type="submit">登録</button>
                </div>
            </form>
          </div>
        </nav>
      </div>
    </div>
  </div>
@endsection