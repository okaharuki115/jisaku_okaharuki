@extends('headerFooter')

@section('content')
<main class="py-4">
        <div class="col-md-5 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="card-body">

                        <div>退会されますか</div>

                            <div>
                            <div>
                                <a>はい</a><!--リンク先追加-->
                            </div>

                            <div>
                                <a href="{{ route('login') }}">いいえ</a>
                            </div>
                            </div>

                    </div>

                </div>
            </div>
        </div>
    </main>

@endsection