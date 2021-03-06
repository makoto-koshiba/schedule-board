<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>schedule-board</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{asset('css/table2.css') }}">
    </head>

    <body>
        
        {{-- ナビゲーションバー --}}
        
        
        @include('commons.navbar')
        
        <div class="container">
            @if(Auth::check() && Auth::user())
                <div class="text-right m-0">
                    <button type="button" onClick="history.back()" class="btn btn-primary  btn-sm">戻る</button>
                </div>
            @endif
            
            <div class="center">
                {{-- エラーメッセージ --}}
                @include('commons.error_messages')
                @yield('content')
            </div>
        </div>
        
            



        <!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>-->
        <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>-->
        <!--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>-->
        <!--<script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>-->
        {{-- jsを参照--}}
        @yield('js')
    </body>
</html>