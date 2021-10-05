@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h3>ログイン</h3>
    </div>
    
    <div class="row">
        <div class="col-sm-2 offset-sm-5">

            {!! Form::open(['route' => 'login.post']) !!}
                <div class="form-group">
                    {!! Form::label('account', 'アカウント') !!}
                    {!! Form::text('account', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password', 'パスワード') !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>
                <div class="text-center">
                {!! Form::submit('ログイン', ['class' => 'btn btn-primary btn-inline']) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection