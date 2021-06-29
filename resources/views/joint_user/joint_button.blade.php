
    @if ($schedule->is_joint_user($user->id))
        {{-- 参加解除ボタンのフォーム --}}
        
        {!! Form::open(['route' => ['user.unjoint', $schedule->id], 'method' => 'delete']) !!}
        {!! Form::hidden('user_id',$user->id) !!}
            {!! Form::submit('参加', ['class' => "btn btn-primary btn-sm"]) !!}
        {!! Form::close() !!}
    @else
        {{-- 参加登録ボタンのフォーム --}}
        
        {!! Form::open(['route' => ['user.joint', $schedule->id]]) !!}
        {!! Form::hidden('user_id',$user->id) !!}
            {!! Form::submit('不参加', ['class' => "btn btn-danger btn-sm"]) !!}
        {!! Form::close() !!}
    @endif