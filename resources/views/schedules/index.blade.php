@extends('layouts.app')

@section('content')


<h1>予定一覧</h1>
    @if(Auth::check())
 　　　<!--前の週、次の週を表示する配列のリンク-->
{!! link_to_route('schedules.index', '＜ 前の週',['startDay'=> $beforWeekDate]) !!}
    　　
{!! link_to_route('schedules.index', '次の週 ＞',['startDay'=> $nextWeekDate]) !!}
       
        <table class="table table-bordered">
            <thead>
                
                    <tr>
                        <th>{{ $date->year.'年'. $date->month.'月'}}</th>
                        @for ($i = 0; $i <7; $i++)
                              <th> {{ $aryDay[$i] }}</th>
                        @endfor
                    </tr>
                     
                    <tr>
                         <th></th>
                         @for ($i = 0; $i <7; $i++)
                             <th> {{ $weekday[$i] }}</th>
                         @endfor
                    </tr>
            </thead>
            
            <tbody>
                         @foreach ($users as $user)
                    <tr>
                            <td>{{ $user->name }}</td>
                         @for ($i = 0; $i <7; $i++)
                     <td>
                         <!--ユーザーに紐付いたプロジェクト名を日付に合わせて表示する-->
                         @if($schedule = $user->schedules()->where('date',$date->copy()->addDay($i))->first())
                          {!! link_to_route('schedules.show', $schedule->project->title, ['schedule' => $schedule->id]) !!}
                         @endif
                     </td>
                         @endfor
                </tr>
                         @endforeach
            </tbody>
        </table>
    @endif
     
       @if(Auth::check() && Auth::user()->admin_flag == true )
    {{-- 予定作成ページへのリンク --}}
    {!! link_to_route('schedules.create', '予定追加', [], ['class' => 'btn btn-primary']) !!}
       @endif
       
@endsection