@extends('layouts.app')

@section('content')

 <h1>{{ $project->title }} の編集</h1>

    <div class="row">
        <div class="col-6">
            {!! Form::model($project, ['route' => ['projects.update', $project->id], 'method' => 'put']) !!}

                <div class="form-group">
                    {!! Form::label('title', '案件:') !!}
                    {!! Form::text('title', null, ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('content', '内容:') !!}
                    {!! Form::text('content', null, ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('更新', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>

@endsection