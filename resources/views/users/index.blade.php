@extends('layouts.app')

@section('content')

    <h1>メンバー 一覧</h1>

    @if (count($users) > 0)
    <div class="overflow-auto" style="width:1075px; height:500px;">
        <table class="table table-bordered st-tbl2">
            <thead>
                <tr>
                    <th>メンバー</th>
                    <th>メール</th>
                    <th></th>
                </tr>
            </thead>
            
            <tbody>
                @foreach ($users as $user)
                <tr>
                    
                    <td>{{ $user ->name }}</td>
                    <td>{{ $user ->email }}</td>
                    <td> {{-- メンバー削除フォーム --}}
                     {!! Form::model($user, ['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                     {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
                     {!! Form::close() !!}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    </div>            
                {{-- メッセージ作成ページへのリンク --}}
                {!! link_to_route('users.create', '新規追加', [], ['class' => 'btn btn-primary']) !!}
   
@endsection