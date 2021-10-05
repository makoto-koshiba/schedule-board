@extends('layouts.app')

@section('content')


<h3>休日一覧</h3>


        @if (session('message'))
          <div class="alert alert-danger alert-dismissible text-center mt-3">
           {{ session('message') }}
          </div>
        @endif

 <div class="row">
        <div class="col-3">
            {!! Form::model($holidays, ['route' => 'holidays.bulkStore']) !!}
            
                <div class="form-group">
                    {!! Form::label('year', '取得年:') !!}
                    {!! Form::selectYear('year',Carbon\Carbon::now()->year,2100) !!}
                    {!! Form::submit('取得', ['class' => 'btn btn-primary btn-sm']) !!}
                </div>
             {!! Form::close() !!}
            
             {!! link_to_route('holidays.create', '追加', [], ['class' => 'btn btn-primary  btn-sm']) !!}
 
 
    <table class="table-bordered">
        
     
        <thead>
        <tr>
             <th style = "width :120px;">日付</th>
             <th style = "width :100px;">内容</th>
        </th>
       </thead>
       @foreach ($holidays as $holiday)
       <tbody>
        <td>{{$holiday->date}}</td>
        <td>{{$holiday->content}}</td>
        @endforeach
    
    </table>
         
         
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/main.js') }}"></script>
@endsection