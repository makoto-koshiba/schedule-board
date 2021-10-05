@extends('layouts.app')

@section('content')

 <h3>顧客追加</h3>

    <div class="row">
        <div class="col-4">
            {!! Form::model($client, ['route' => 'clients.store']) !!}
                
                 <div class="form-group">
                    {!! Form::label('name', '顧客名') !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('code', '顧客コード:') !!}
                    {!! Form::text('code', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('postal_code', '郵便番号') !!}
                    {!! Form::text('postal_code', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('address', '所在地:') !!}
                    {!! Form::text('address', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('tel', '電話番号:') !!}
                    {!! Form::text('tel', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('fax', 'fax番号:') !!}
                    {!! Form::text('fax', null, ['class' => 'form-control']) !!}
                </div>
            {!! Form::submit('作成', ['class' => 'btn btn-primary']) !!}
            
        {!! Form::close() !!}
        </div>
    </div>

@endsection