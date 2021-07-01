@extends('layouts.app')

@section('content')

 <h1>{{ $schedule->project->title }} の編集</h1>

     
    <table class="table table-bordered">
        
         <tr>
            <th>日付</th>
            <td>{{ $schedule->date }}</td>
        </tr>
        
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
                <div class="overflow-auto" style="width:300px; height:300px;">
                    @foreach($users as $user)
                    <div class="d-flex flex-row bd-highlight mb-6">
                <div class="p-2 bd-highlight">
                    {{ $user->name }}
                </div>
                <div class="p-2 bd-highlight">
                    @include('joint_user.joint_button')
                </div>
                </div>
                @endforeach 
            </td>
        </tr>
    </table>
　　　　　　　　　　
        {!! link_to_route('schedules.index', '更新', [], ['class' => 'btn btn-primary']) !!}
             
@endsection