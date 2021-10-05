@extends('layouts.app')

@section('content')

    <h3>新規追加</h3>

    <div class="row">
        <div class="col-3">
            {!! Form::model($user, ['route' => 'users.store']) !!}

                <div class="form-group">
                    {!! Form::label('name', '名前') !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('email', 'メール') !!}
                    {!! Form::email('email', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('account', 'アカウント') !!}
                    {!! Form::text('account', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('password', 'パスワード') !!}
                    {!! Form::password('password', null, ['class' => 'form-control']) !!}
                </div>
                
                {!! Form::submit('追加', ['class' => 'btn btn-primary btn-sm mt-1']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection