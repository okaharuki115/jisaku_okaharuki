@extends('headerFooter')

@section('content')
<main class="py-4">
        <div class="col-md-5 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="card-body">

                        <div>退会されますか</div>

                        <form method="post" action="{{ route('destroyUserDelete') }}">
                            @csrf
                            @method('delete')
                            <input type="submit" value="はい">
                        </form>

                        <a href="{{ route('login') }}">
                            <button type='submit' class='btn btn-primary w-10 mt-3'>いいえ</button>
                        </a>

                    </div>

                </div>
            </div>
        </div>
    </main>

@endsection