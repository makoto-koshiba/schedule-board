@extends('layouts.app')

@section('content')

<h1> {{ $schedule->created_at->format('m/d') }} の詳細</h1>

    <table class="table table-bordered">
        
        <tr>
            <th>案件</th>
            <td>{{ $schedule->project->title }}</td>
        </tr>
        
        <tr>
            <th>内容</th>
            <td>{{ $schedule->project->content }}</td>
        </tr>
        
        <tr>
            <th>メンバー</th>
            <td>
                <ul>
                    @foreach($schedule->joint_users as $user)
                        <li>
                            {{ $user->name }}
                        </li>
                    @endforeach    
                </ul>
            </td>
        </tr>
    </table>
    
    {{-- 編集ページへのリンク --}}
    @if(Auth::user()->admin_flag == true )
     
    <div class="d-flex flex-row bd-highlight mb-6"> 
    {!! link_to_route('schedules.edit', '編集', ['schedule' => $schedule->id], ['class' => 'btn btn-primary']) !!}
    {{-- メッセージ削除フォーム --}}
    {!! Form::model($schedule, ['route' => ['schedules.destroy', $schedule->id], 'method' => 'delete']) !!}
        {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@endif
@endsection