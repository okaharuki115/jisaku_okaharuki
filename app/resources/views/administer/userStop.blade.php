<!--アットextends('headerFooter')-->
<!--アットextends('layouts.auth')-->
@extends('layouts.auth')

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
                            
                            <div class="text-center">{{ $stopUser['name'] }}</div>

                            <div class="text-center">このユーザーを停止させますか</div>

                            <div class="row justify-content-center">
                                <div class="col-md text-center">
                                    <form method="post" action="{{ route('userStopComplete',['id'=>$userStopId]) }}">
                                        @csrf
                                        @method('delete')
                                        <input type="submit" class='btn btn-primary w-10 mt-3' value="はい">
                                    </form>
                                </div>
    
                                <div class="col-md text-center">
                                    <div onClick="history.back()"class='btn btn-primary w-10 mt-3'>いいえ</div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

@endsection