@extends('layouts.app')

@section('content')


<h1>新規予定作成</h1>

    <div class="row">
        <div class="col-6">
            {!! Form::model($schedule, ['route' => 'schedules.store']) !!}

                <div class="form-group">
                    {!! Form::label('date', '日付:') !!}
                    {{Form::date('date', \Carbon\Carbon::now(), ['class'=>'date'])}}
                </div>
                
                <div class="form-group">
                    {!! Form::label('content', '内容:') !!}
                    <!--プロジェクトをセレクトボックスで表示-->
                    {!! Form::select('project_id', $projects->pluck('title', 'id'), old('project_id'), ['placeholder' => '選択してください']) !!}
                </div>
    　　</div>
                 
                 <div class="form-group">
                    {!! Form::label('content', 'メンバー:') !!}
                 <div class="col-2">
                      <!--ユーザーをチェックボックスで選択-->
                 <div class="checkbox">
                    @foreach ($users as $user)
    　　　　　　　　　　　　{!! Form::checkbox('userIds[]', $user->id, false, ['class' => 'form-check-input']) !!} {{ $user->name }}
　　　　　　　　　　@endforeach
                </div>
                </div>

                {!! Form::submit('作成', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>

@endsection