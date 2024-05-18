<!--アットextends('headerFooter')-->
<!--アットextends('layouts.auth')-->
@extends('layouts.auth')

@section('content')
<main class="py-4">
        <div class="col-md-5 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="card-body">

                            <div>この投稿は停止中です</div>

                            <div>
                                <div onClick="history.back()"class='btn btn-primary w-10 mt-3'>戻る</div>
                            </div>

                    </div>

                </div>
            </div>
        </div>
    </main>

@endsection


