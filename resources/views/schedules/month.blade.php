@extends('layouts.schedule')

@section('content')

   <div class="container-fluid">
       <div class="row d-flex justify-content-between mb-1">
           <div>
                @if(Auth::check() && Auth::user()->admin_flag == true )
                    {{-- 予定作成ページへのリンク --}}
                    {!! link_to_route('schedules.create', '予定追加', [], ['class' => 'btn btn-success btn-sm']) !!}
                @endif
 　　<!--前月、次の月を表示する配列のリンク-->
                {!! link_to_route('schedules.month', '＜ 前月',['startDay'=> $beforMonthDate]) !!}
                    　　
                {!! link_to_route('schedules.month', '次月 ＞',['startDay'=> $nextMonthDate]) !!}
                {!! link_to_route('schedules.index', '週表示', ['date' => $date,], ['class' => 'btn btn-primary btn-sm']) !!}
           </div>
           <div>
                @if(Auth::check() && Auth::user())
                    <div class="text-right m-0">
                        <button type="button" onClick="history.back()" class="btn btn-primary  btn-sm">戻る</button>
                    </div>
                @endif
           </div>
       </div>

         
        <table class="table table-bordered table-condensed st-tbl1">
            <thead>
                
                    <tr>
                        <th>{{ $day->year.'年'. $day->month.'月' }}</th>
                         <!--１ヵ月分の日付と曜日を表示する-->
                        @for ($i = 0; $i <$daysInMonth; $i++)
                              <th @if($aryDays[$i]['holiday_flag'] == 'ture') style="color:red;" @endif>
                                  {{ $aryDays[$i]['day'] }}
                              </th>
                        @endfor
                    </tr>
                    
                    <tr>
                         <th></th>
                         @for ($i = 0;  $i <$daysInMonth; $i++)
                             <th @if($aryDays[$i]['holiday_flag'] == 'ture') style="color:red;" @endif> 
                                 {{ $aryDays[$i]['weekday_label'] }}
                             </th>
                         @endfor
                    </tr>
                    
                    <tr>        
                    <th></th>
                     @for  ($i = 0; $i <$daysInMonth; $i++)
                         <th @if($aryDays[$i]['holiday_flag'] == 'ture') style="color:red;" @endif>
                              {{$aryDays[$i]['holiday_content'] }}
                         </th>
                     @endfor
                </tr>
                
            </thead>
            
            <tbody>
                         @foreach ($users as $user)
                    <tr>
                            <th>{!! link_to_route('schedules.create', $user->name,['userId'=>$user->id]) !!}</th>
                         @for ($i = 0; $i <$daysInMonth; $i++)
                     <td @if (in_array($day->copy()->addDay($i)->format('Y-m-d'), $holidays)) style="background-color: pink;" @endif>
                         <!--ユーザーに紐付いたプロジェクト名を日付に合わせて表示する-->
                         <!--休日の場合は表示しない-->
                         <!--予定が1件以上の時は予定を全て表示する-->
                         @if (count($schedules = $user->schedules()->where('holiday_flag',false)->where('date',$day->copy()->addDay($i))->get())>1)
                             @foreach ( $schedules as $schedule)
                                    {!! link_to_route('schedules.show', $schedule->project->title, ['schedule' => $schedule->id]) !!}<br>
                             @endforeach
                             
                        <!--予定が1件の時は予定と追加ボタンを表示する-->     
                         @elseif (count($schedules)==1)
                             @foreach ( $schedules as $schedule)
                                    {!! link_to_route('schedules.show', $schedule->project->title, ['schedule' => $schedule->id]) !!}<br>
                             @endforeach
                                    
                            {!! Form::open(['route'=>'schedules.modal', 'class'=>"table-form"]) !!}
                            {!! Form::hidden('userId',$user->id) !!}
                            {!! Form::hidden('date',$day->copy()->addDay($i)) !!}
                            {!! Form::submit('',['class' => 'table-submit']) !!}
                            {!! Form::close() !!}
                       
                        <!--紐付くプロジェクトが無ければ追加ボタンを表示する-->
                        @else
                             {!! Form::open(['route'=>'schedules.modal', 'class'=>"table-form"]) !!}
                             {!! Form::hidden('userId',$user->id) !!}
                             {!! Form::hidden('date',$day->copy()->addDay($i)) !!}
                             {!! Form::submit('',['class' => 'table-submit']) !!}
                             {!! Form::close() !!}
                             {!! Form::open(['route'=>'schedules.modal', 'class'=>"table-form"]) !!}
                             {!! Form::hidden('userId',$user->id) !!}
                             {!! Form::hidden('date',$day->copy()->addDay($i)) !!}
                             {!! Form::submit('',['class' => 'table-submit']) !!}
                             {!! Form::close() !!}
                             
                         @endif
                     </td>
                         @endfor
                </tr>
                         @endforeach
            </tbody>
        </table>
    
    </div>
    
    
       
@endsection