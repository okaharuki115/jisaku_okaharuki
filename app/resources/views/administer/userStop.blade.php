<!--アットextends('headerFooter')-->
<!--アットextends('layouts.auth')-->
@extends('layouts.auth')

@section('content')
<main class="py-4">
        <div class="col-md-5 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="card-body">

                            <div>名前</div>
                            <div><!--ユーザー名のデータ引っ張ってきて記述--></div>

                            <div>このユーザーを停止させますか</div>

                            <div>
                                <form method="post" action="{{ route('userStopComplete',['id'=>$userStopId]) }}">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" value="はい">
                                </form>
    
                                <div>
                                    <div onClick="history.back()"class='btn btn-primary w-10 mt-3'>いいえ</div>
                                </div>
                            </div>

                    </div>

                </div>
            </div>
        </div>
    </main>

@endsection