@extends('layouts.app')

@section('content')


<h3>完了案件</h3>

    @if (count($projects) > 0)
        <table class="table-bordered">
            <thead>
                <tr>
                    <th>案件コード</th>
                    <th>案件名</th>
                    <th>現場住所</th>
                    <th>顧客名</th>
                    <th>完了日</th>
                </tr>
            </thead>
            <tbody>
                
                @foreach ($projects as $project)
                
                <tr>
                     {{--完了プロジェクトか判断し、完了ならば内容を表示する--}}
                    @if($project->finish_flag == true)
                    <td>{{ $project->client->code .'-'.$project->created_at->format('y').'-'. $project ->code }}</td>
                    <td>{!! link_to_route('projects.show', $project->title, ['project' => $project->id]) !!}</td>
                    <td>{{ $project ->address }}</td>
                    <td>{!! $project->client['name'] !!} </td>
                    <td>{{ $project ->updated_at->format('Y/m/d') }}</td>
                    @endif
                    <td> @if(Auth::user()->admin_flag == true )
                        <div class="d-flex flex-row bd-highlight mb-6"> 
                      {{-- 案件を一覧に戻すフォーム --}}
                     {!! Form::model($project, ['route' => 'projects.unfinish']) !!}
                      {!! Form::submit('復元', ['class' => 'btn btn-primary btn-sm']) !!}
                      {!! Form::hidden('project_id',$project->id) !!}
                      {!! Form::close() !!}
                       @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    
    {{-- ページネーションのリンク --}}
    {{ $projects->links() }}
    
    @if(Auth::check() && Auth::user()->admin_flag == true )
    {{-- プロジェクト一覧ページへのリンク --}}
    {!! link_to_route('projects.index', '案件一覧', [], ['class' => 'btn btn-primary btn-sm mt-1']) !!}
    @endif
    
@endsection