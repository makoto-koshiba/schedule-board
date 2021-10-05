@extends('layouts.app')

@section('content')


<h3>休日追加</h3>

　　<div class="row">
        <div class="col-3">
            {!! Form::model($holiday, ['route' => 'holidays.store']) !!}
            
                <div class="form-group">
                    {!! Form::label('date', '休日:') !!}
                    {!! Form::input('date','date', \Carbon\Carbon::now(), ['class'=>'date']) !!}
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