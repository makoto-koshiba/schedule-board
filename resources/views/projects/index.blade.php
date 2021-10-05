@extends('layouts.app')

@section('content')


<h3>案件一覧</h3>

  @if(Auth::check() && Auth::user()->admin_flag == true )
    {{-- プロジェクト作成ページへのリンク --}}
    {!! link_to_route('projects.create', '案件作成', [], ['class' => 'btn btn-primary btn-sm mb-1']) !!}
    {!! link_to_route('projects.finishIndex', '完了案件', [], ['class' => 'btn btn-secondary btn-sm mb-1']) !!}
    @endif

        @if (count($projects) > 0)
            <table class="table-bordered">
                <thead>
                    <tr>
                        <th style = "width :100px; center">案件コード</th>
                        <th>案件名</th>
                        <th>現場住所</th>
                        <th>顧客名</th>
                        <th  style = "width :100px;">作成日</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($projects as $project)
                    <tr>
                        {{--現行プロジェクトか判断し、現行ならば内容を表示する--}}
                        @if($project->finish_flag == false)
                        <td class="text-center">
                            {{ $project->client->code .'-'.$project->created_at->format('y').'-'. $project ->code }}
                            </td>
                        <td>{!! link_to_route('projects.show', $project->title, ['project' => $project->id]) !!}</td>
                        <td>
                            <a href="{{ $project->google_href }}" target="_blank">{{$project->address}}</a>
                        </td>
                        <td>{!! $project->client['name'] !!}</td>
                        <td class="text-center"> {{ $project ->created_at->format('Y/m/d') }}</td>
                        @endif
                        <td> 
                        @if(Auth::user()->admin_flag == true )
                            <div class="d-flex flex-row bd-highlight mb-6"> 
                            {!! link_to_route('projects.edit', '編集', ['project' => $project->id], ['class' => 'btn btn-primary mr-3 btn-sm']) !!}
                          {{-- 案件完了ボタン --}}
                          {!! Form::model($project, ['route' => 'projects.finish']) !!}
                          {!! Form::submit('完了', ['class' => 'btn btn-secondary btn-sm']) !!}
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
    
@endsection