@extends('layouts.app')

@section('content')


<h1> {{ $project->title }} の詳細</h1>

    <table class="table table-bordered">
        <tr>
            <th>案件</th>
            <td>{{ $project->title }}</td>
        </tr>
        <tr>
            <th>内容</th>
            <td>{{ $project->content }}</td>
        </tr>
        <tr>
            <th>作成日</th>
            <td>{{ $project->created_at->format('Y/m/d') }}</td>
        </tr>
    </table>
    {{-- 編集ページへのリンク --}}
    @if(Auth::user()->admin_flag == true )


     <div class="d-flex justify-content-around"> 
    {!! link_to_route('projects.edit', '編集', ['project' => $project->id], ['class' => 'btn btn-primary']) !!}
    {{-- メッセージ削除フォーム --}}
    {!! Form::model($project, ['route' => ['projects.destroy', $project->id], 'method' => 'delete']) !!}
    {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
    @endif
    
@endsection