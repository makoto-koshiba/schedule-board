@extends('layouts.app')

@section('content')

<h1>新規案件作成</h1>

    <div class="row">
        <div class="col-6">
            {!! Form::model($project, ['route' => 'projects.store']) !!}

                <div class="form-group">
                    {!! Form::label('title', '案件名:') !!}
                    {!! Form::text('title', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('content', '内容:') !!}
                    {!! Form::text('content', null, ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('作成', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>

@endsection