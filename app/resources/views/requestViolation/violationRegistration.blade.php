@extends('headerFooter')

@section('content')
<main class="py-4">
        <div class="col-md-5 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="card-body">

                        

                        <div>
                            <div>タイトル</div>
                            <div>{{ $Post_with_User['title'] }}</div><!--タイトル表示-->
                        </div>
                    
                        <div>
                            <div>内容</div>
                            <div>{{ $Post_with_User['content'] }}</div><!--内容表示-->
                        </div>

                        <form action="{{ route('ihan', ['id' => $ihanId])}}" method="post">
                        @csrf
                        
                            <div>
                                <label for='comment' class='mt-2'>コメント</label>
                                <input type='text' class='form-control' name='comment' id='comment'/>
                            </div>

                            <div class='row justify-content-center'>
                                <button type='submit' class='btn btn-primary w-25 mt-3'>報告</button>
                            </div> 

                        </form>
                        
                        <div>
                            <button type="button" onClick="history.back()">戻る</button>
                        </div>

                    
                    </div>

                </div>
            </div>
        </div>
    </main>





@endsection