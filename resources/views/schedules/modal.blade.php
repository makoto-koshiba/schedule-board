@extends('layouts.app')

@section('content')


<h3>新規予定作成</h3>

    
   <div class="row">
        <div class="col-4">
            {!! Form::model($schedule, ['route' => 'schedules.dayStore']) !!}

                <div class="form-group">
                    {!! Form::label('content','日付:') !!}
                    {{ $date->format('Y-m-d') }}
                    {!! Form::hidden('date',$date) !!}
                </div>
                 
                
                <div class="form-group">
                    {!! Form::label('content', '案件:') !!}
                    <!--プロジェクトをセレクトボックスで表示-->
                    {!! Form::select('project_id', $projects->pluck('title', 'id'), old('project_id'), ['placeholder' => '選択してください']) !!}
                </div>

                <div class="form-group row">
                    {!! Form::label('content', 'メンバー:') !!}
                    {{ $user->name }}
                    {!! Form::hidden('userId',$user->id) !!}
                </div>
                {!! Form::submit('作成', ['class' => 'btn btn-primary btn-sm']) !!}
            {!! Form::close() !!}
        　　</div>
        </div>
　　</div>

@endsection