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

                    <form action="{{ route('iraiModification',['id' => $iraiModificationId])}}" method="post">
                        @csrf
                        <div>  
                            <div>
                                <label for='content' class='mt-2'>内容</label>
                                <input type='text' class='form-control' name='content' id='content' value="{{ $iraiModificationData['content']}}"/>
                            </div> 
                                                  
                            <div>
                                <label for='tel' class='mt-2'>電話番号</label>
                                <input type='text' class='form-control' name='tel' id='tel' value="{{ $iraiModificationData['tel']}}"/>
                            </div> 
                            
                            <div>
                                <label for='email' class='mt-2'>メールアドレス</label>
                                <input type='text' class='form-control' name='email' id='email' value="{{ $iraiModificationData['email']}}"/>
                            </div> 
  

                            <div>
                                <label for='limit' class='mt-2'>期日</label>
                                <input type='date' class='form-control' name='limit' id='limit'value="{{ $iraiModificationData['limit']}}"/>
                            </div>

                            <div class='row justify-content-center'>
                                <button type='submit' class='btn btn-primary w-25 mt-3'>登録</button>
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