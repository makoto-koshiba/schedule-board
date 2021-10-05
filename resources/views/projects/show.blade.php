@extends('layouts.app')

@section('content')


<h3> {{ $project->title }} の詳細</h3>

    <table class="table-bordered">
       <tr>
            <th style = "width:150px;">案件コード</th>
            <td style = "width:200px;">{{  $project->client->code .'-'.$project->created_at->format('y').'-'. $project ->code }}</td>
        </tr>
        <tr>
            <th>案件名</th>
            <td>{{ $project->title }}</td>
        </tr>
        <tr>
            <th>現場住所</th>
            <td>{{ $project->address }}</td>
        </tr>
        <tr>
            <th>顧客名</th>
            <td>{{ $project->client->name }}</td>
        </tr>
        <tr>
            <th>顧客担当者</th>
            <td>{{ $project->personnel }}</td>
        </tr>
        <tr>
            <th>連絡先</th>
            <td>{{ $project->countact }}</td>
        </tr>
        <tr>
            <th>職長</th>
            <td>{{ $project->user->name }}</td>
        </tr>
        <tr>
            <th>作成日</th>
            <td>{{ $project->created_at->format('Y/m/d') }}</td>
        </tr>
    </table>
    {{-- 編集ページへのリンク --}}
    @if(Auth::user()->admin_flag == true )


     <!--<div class="d-flex justify-content-around"> -->
    {!! link_to_route('projects.edit', '編集', ['project' => $project->id], ['class' => 'btn btn-primary btn-sm mt-1']) !!}
    {!! Form::close() !!}
    @endif
    
@endsection