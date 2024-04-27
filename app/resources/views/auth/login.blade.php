@extends('headerFooter')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col col-md-offset-3 col-md-6">
        <nav class="card mt-5">
          <div class="card-body">
            @if($errors->any())<!--何かエラーがあったとき？-->
              <div class="alert alert-danger">
                @foreach($errors->all() as $message)
                  <p>{{ $message }}</p>
                @endforeach
              </div>
            @endif
            <!--エラーなしのとき？-->
            <form action="{{ route('login') }}" method="post"><!--,['id' => $login_Id]を追加して消した--><!--method="POST"をmethod="post"にした-->
              @csrf
              <div>
                <label>メールアドレス</label>
                <input type="text" id="email" name="email" value="{{ old('email') }}" /><!--value入れたままでいい？-->
              </div>
              <div>
                <label>パスワード</label>
                <input type="password" id="password" name="password" />
              </div>
              <div class="text-right">
                <button type="submit">ログイン</button>
              </div>
            </form>
          </div>
        </nav>

        <div>
          <a href="{{ route('password.request') }}">パスワード再設定</a>
        </div>
      </div>
    </div>
  </div>
@endsection