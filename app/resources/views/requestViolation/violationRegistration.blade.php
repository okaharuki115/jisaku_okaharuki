@extends('headerFooter')

@section('content')
<main class="py-4">
        <div class="col-md-5 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="card-body">

                    <div class="mx-auto w-50">
                        <table class="table table-borderless" width="600px">
                            <tbody>
                                <tr>
                                    <td class="p-2">タイトル</td>
                                    <td class="p-2">{{ $Post_with_User['title'] }}</td><!--タイトル表示-->
                                </tr>
                            
                                <tr>
                                    <td class="p-2">内容</td>
                                    <td class="p-2">{{ $Post_with_User['content'] }}</td><!--内容表示-->
                                </tr>
                            </tbody>
                        </table>
                    </div>

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
                            <button type="button" class='btn btn-primary w-10 mt-3' onClick="history.back()">戻る</button>
                        </div>

                    
                    </div>

                </div>
            </div>
        </div>
    </main>





@endsection