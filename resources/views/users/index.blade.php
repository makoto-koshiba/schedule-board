@extends('layouts.app')

@section('content')

    <h3>メンバー 一覧</h3>

    @if (count($users) > 0)
    <div class="overflow-auto" style="height:500px;">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>メンバー</th>
                    <th>メール</th>
                    <th>アカウント</th>
                    <th></th>
                </tr>
            </thead>
            
            <tbody>
                @foreach ($users as $user)
                <tr>
                    
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->account }}</td>
                    <td>
                        <div class="d-flex flex-row bd-highlight"> 
                        {!! link_to_route('users.edit', '編集', ['user' => $user->id], ['class' => 'btn btn-primary mr-1 btn-sm']) !!} 
                    　　{!! Form::model($user, ['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                     　 {!! Form::submit('削除', ['class' => 'btn btn-danger btn-sm']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    </div>            
                {{-- メッセージ作成ページへのリンク --}}
                {!! link_to_route('users.create', '新規追加', [], ['class' => 'btn btn-primary btn-sm']) !!}
   
@endsection