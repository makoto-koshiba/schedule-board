@extends('layouts.app')

@section('content')

 <h3>{{ $project->title }} の編集</h3>

    <div class="row">
        <div class="col-4">
            {!! Form::model($project, ['route' => ['projects.update', $project->id], 'method' => 'put']) !!}

                 <div class="form-group">
                    {!! Form::label('code', 'コード:') !!}
                    {!! Form::text('code', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('title', '案件名:') !!}
                    {!! Form::text('title', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('address', '現場住所:') !!}
                    {!! Form::text('address', null, ['class' => 'form-control']) !!}
                </div>
                 <div class="form-group">
                    {!! Form::label('client_id', '顧客名:') !!}
                    {!! Form::select('client_id', $clients->pluck('name', 'id'), old('client_id'), ['placeholder' => '選択してください']) !!}
                </div>
                 <div class="form-group">
                    {!! Form::label('personnel', '担当者:') !!}
                    {!! Form::text('personnel', null, ['class' => 'form-control']) !!}
                     <div class="form-group">
                    {!! Form::label('countact', '連絡先:') !!}
                    {!! Form::text('countact', null, ['class' => 'form-control']) !!}
                </div>
                 <div class="form-group">
                    {!! Form::label('user_id', '職長:') !!}
                    {!! Form::select('user_id', $users->pluck('name', 'id'), old('user_id'), ['placeholder' => '選択してください']) !!}
                </div>

                {!! Form::submit('更新', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>

@endsection