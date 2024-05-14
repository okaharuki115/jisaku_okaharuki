<!--アットextends('headerFooter')-->
<!--アットextends('layouts.auth')-->
@extends('layouts.auth')

@section('content')
<main class="py-4">
        <div class="col-md-5 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="card-body">

                            <div>タイトル</div>
                            <div><!--タイトルのデータ引っ張ってきて記述--></div>

                            <div>この投稿を停止させますか</div>

                            <div>
                                <div>
                                    <a href="{{ route('postStopComplete',['id'=>$postStopId])}}">はい</a><!--リンク先追加-->
                                </div>
    
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