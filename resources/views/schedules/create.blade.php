@extends('layouts.app')

@section('content')


<h3>新規予定作成</h3>

    <div class="row">
        <div class="col-4">
            {!! Form::model($schedule, ['route' => 'schedules.store']) !!}

                <div class="form-group">
                    {!! Form::label('date', '開始日:') !!}
                    {{Form::input('date','startDay', \Carbon\Carbon::now(), ['class'=>'date'])}}
                </div>
                 <div class="form-group">
                    {!! Form::label('date', '終了日:') !!}
                    {{Form::input('date','endDay', \Carbon\Carbon::now(), ['class'=>'date'])}}
                </div>
                
                <div class="form-group">
                    {!! Form::label('content', '案件:') !!}
                    <!--プロジェクトをセレクトボックスで表示-->
                    {!! Form::select('project_id', $projects->pluck('title', 'id'), old('project_id'), ['placeholder' => '選択してください']) !!}
                </div>

                 <div class="form-group">
                    {!! Form::label('content', 'メンバー:',['class'=> 'col-4']) !!}
                    <div class="overflow-auto col-6" style="height:200px;">
                      {{--ユーザーをチェックボックスで選択--}}
                    @foreach ($users as $user)
                    <div>
                    {!! Form::checkbox('userIds[]', $user->id, ($user->id == $userId) ? true : false, []) !!} {{ $user->name }}
                    </div>
                    @endforeach
                    </div>
                 </div>
                {!! Form::submit('作成', ['class' => 'btn btn-success btn-sm']) !!}
            {!! Form::close() !!}
        </div>
    </div>

@endsection