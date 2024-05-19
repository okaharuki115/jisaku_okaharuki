@extends('headerFooter')

@section('content')
<main class="py-4">
        <div class="col-md-5 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="card-body">

                        <div class="text-center">退会されますか</div>

                        <div class="row justify-content-center">
                            <div class="col-md text-center">
                                <form method="post" action="{{ route('destroyUserDelete') }}">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" class='btn btn-primary w-10 mt-3' value="はい">
                                </form>
                            </div>

                            <div class="col-md text-center">
                                <a href="{{ route('login') }}">
                                    <button type='submit' class='btn btn-primary w-10 mt-3'>いいえ</button>
                                </a>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </main>

@endsection