@extends('layouts.app')

@section('content')

 <h3>{{ $schedule->project->title }} の編集</h3>

     
    <table class="table-bordered">
        
         <tr>
            <th>日付</th>
            <td>{{ $schedule->date }}</td>
        </tr>
        
        <tr>
            <th>案件</th>
            <td>{{ $schedule->project->title }}</td>
        </tr>
        <tr>
            <th>現場住所</th>
            <td>{{ $schedule->project->address }}</td>
        </tr> 
        <tr>
            <th>顧客名</th>
            <td>{{ $schedule->project->client->name }}</td>
        </tr>
        <tr>
            <th>顧客担当者</th>
            <td>{{ $schedule->project->personnal }}</td>
        </tr>
        <tr>
            <th>連絡先</th>
            <td>{{ $schedule->project->contact }}</td>
        </tr>
        <tr>
            <th>職長</th>
            <td>{{ $schedule->project->leader }}</td>
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