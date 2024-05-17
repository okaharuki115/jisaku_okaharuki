@extends('headerFooter')

@section('content')
<main class="py-4">
        <div class="col-md-5 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="card-body">

                    <form action="{{ route('postSearch') }}" method="POST">
                        @csrf
                        <div> 
                            <!--タイトル-->
                            <div>
                                <label for='title' class='mt-2'>タイトル</label>
                                <input type='text' class='form-control' name='title' id='title'/><!--value追加未-->
                            </div> 

                            <!--金額（プルダウン形式）-->
                            <div>
                                <label for='amount' class='mt-2'>金額</label>
                                <select name='amount1' class='form-control'>
                                    <option value="">選択してください</option>
                                    <option value="10000">10000</option>
                                    <option value="1000">1000</option>
                                    <option value="100">100</option>
                                    <option value="0">0</option>
                                </select>
                            </div>

                            <div>~</div>

                            <div>
                                <select name='amount2' class='form-control'>
                                    <option value="">選択してください</option>
                                    <option value="10000">10000</option>
                                    <option value="1000">1000</option>
                                    <option value="100">100</option>
                                    <option value="0">0</option>
                                </select>
                            </div>
                                
                            <!--内容-->
                            <div>
                                <label for='content' class='mt-2'>内容</label>
                                <input type='text' class='form-control' name='content' id='content'/><!--value追加未-->
                            </div> 
                                                  
                            <div class='row justify-content-center'>
                                <button type='submit' class='btn btn-primary w-25 mt-3'>検索</button>
                            </div>

                        </div>

                    </form>
                    </div>

                </div>
            </div>
        </div>
    </main>





@endsection