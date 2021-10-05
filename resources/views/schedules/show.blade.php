@extends('layouts.app')

@section('content')

<h3> {{ $schedule->date }} の詳細</h3>

    <table class="table-bordered">
         
        <tr>
            <th>案件</th>
            <td >{{ $schedule->project->title }}</td>
        </tr>
       <tr>
            <th>現場住所</th>
            <td><a href="{{ $schedule->project->google_href }}" target="_blank">{{$schedule->project->address}}</a></td>
        </tr> 
        <tr>
            <th>顧客名</th>
            <td>{{ $schedule->project->client->name }}</td>
        </tr>
        <tr>
            <th style ="width: 150px">顧客担当者</th>
            <td style ="width: 200px">{{ $schedule->project->personnel }}</td>
        </tr>
        <tr>
            <th>連絡先</th>
            <td>{{ $schedule->project->countact }}</td>
        </tr>
        <tr>
            <th>メンバー</th>
            <td>
                <ul>
                    @foreach($schedule->joint_users as $user)
                        <li @if($schedule->project->user_id == $user->id) style="color:red" @endif>
                            {{ $user->name }}
                        </li>
                    @endforeach    
                </ul>
            </td>
        </tr>
    </table>
    </div>
    {{-- 編集ページへのリンク --}}
    @if(Auth::user()->admin_flag == true )
     
    <div class="d-flex flex-row bd-highlight mb-6"> 
    {!! link_to_route('schedules.edit', 'メンバー編集', ['schedule' => $schedule->id], ['class' => 'btn btn-primary btn-sm mr-3']) !!}
    {{-- メッセージ削除フォーム --}}
    {!! Form::model($schedule, ['route' => ['schedules.destroy', $schedule->id], 'method' => 'delete']) !!}
        {!! Form::submit('予定削除', ['class' => 'btn btn-danger btn-sm']) !!}
    {!! Form::close() !!}
@endif
@endsection