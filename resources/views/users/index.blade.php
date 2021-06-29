@extends('layouts.app')

@section('content')

    <h1>メンバー 一覧</h1>

    @if (count($users) > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>メンバー</th>
                    <th>メール</th>
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
                     {!! Form::close() !!}
                 　 </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
                
                {{-- メッセージ作成ページへのリンク --}}
                {!! link_to_route('users.create', '新規追加', [], ['class' => 'btn btn-primary']) !!}
   
@endsection