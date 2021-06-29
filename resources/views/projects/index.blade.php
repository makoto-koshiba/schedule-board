@extends('layouts.app')

@section('content')


<h1>案件一覧</h1>

    @if (count($projects) > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>タイトル</th>
                    <th>内容</th>
                    <th>作成日</th>
                </tr>
            </thead>
            <tbody>
                
                @foreach ($projects as $project)
                
                <tr>
                    <td>{{ $project ->title }} </td>
                    <td>{{ $project ->content }}</td>
                    <td>{{ $project ->created_at->format('Y/m/d') }}</td>
                    <td> 
                   　　 @if(Auth::user()->admin_flag == true )
                        <div class="d-flex flex-row bd-highlight mb-6"> 
                        {!! link_to_route('projects.edit', '編集', ['project' => $project->id], ['class' => 'btn btn-primary']) !!}
                      {{-- 案件削除フォーム --}}
                      {!! Form::model($project, ['route' => ['projects.destroy', $project->id], 'method' => 'delete']) !!}
                      {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
                      {!! Form::close() !!}
                       @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    <!--ページネーションへのリンク-->
    {{ $projects->links() }}
    
    @if(Auth::check() && Auth::user()->admin_flag == true )
    　　{{-- プロジェクト作成ページへのリンク --}}
    　　{!! link_to_route('projects.create', '案件作成', [], ['class' => 'btn btn-primary']) !!}
    @endif

@endsection