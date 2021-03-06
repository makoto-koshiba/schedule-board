@extends('layouts.app')

@section('content')
    <div class="container">
       <div class="row d-flex justify-content-between mb-1">
           <div>
                @if(Auth::check() && Auth::user()->admin_flag == true )
                    {{-- 予定作成ページへのリンク --}}
                    {!! link_to_route('schedules.create', '予定追加', [], ['class' => 'btn btn-success btn-sm']) !!}
                @endif 
         　　　<!--前の2週、次の2週を表示する配列のリンク-->
                {!! link_to_route('schedules.index', '＜ 前の2週間',['startDay'=> $beforWeekDate]) !!}
                
                {!! link_to_route('schedules.index', '次の2週間 ＞',['startDay'=> $nextWeekDate]) !!}
                {!! link_to_route('schedules.month', '月表示', ['date' => $date], ['class' => 'btn btn-primary btn-sm']) !!}
            </div>
       </div>
            </div>
        {{--@if (session('message'))
          <div class="alert alert-danger alert-dismissible text-center mt-3">
           {{ session('message') }}
          </div>
        @endif--}}
        
        <table class="table table-bordered table-condensed st-tbl2">
            <thead>
                    <tr>
                        <th>{{ $day->year.'年'. $day->month.'月'}}</th>
                        <!--2週間分の日付を表示する-->
                        @for ($i = 0; $i <14; $i++)
                              <th @if($aryDays[$i]['holiday_flag'] == 'ture') style="color:red;" @endif>
                                  {{ $aryDays[$i]['day'] }}
                              </th>
                        @endfor
                    </tr>
                    <tr>
                         <th></th>
                         <!--2週間分の曜日を表示する。日曜日は赤で表示する-->
                         @for ($i = 0; $i <14; $i++)
                             <th @if($aryDays[$i]['holiday_flag'] == 'ture') style="color:red;" @endif>
                                 {{ $aryDays[$i]['weekday_label'] }}
                             </th>
                         @endfor
                    </tr>
                     <tr>
                    <th></th>
                     @for  ($i = 0; $i <14; $i++)
                         <th @if($aryDays[$i]['holiday_flag'] == 'ture') style="color:red;" @endif>
                              {{$aryDays[$i]['holiday_content'] }}
                         </th>
                     @endfor
                </tr>
            </thead>
            <tbody>
                        @foreach ($users as $user)
                <tr>
                            <th> {!! link_to_route('schedules.create', $user->name,['userId'=>$user->id]) !!}</th>
                        @for ($i = 0; $i <14; $i++)
                    <td  @if (in_array($day->copy()->addDay($i)->format('Y-m-d'), $holidays)) style="background-color: pink;" @endif>
                         <!--ユーザーに紐付いたプロジェクト名を日付に合わせて表示する-->
                         <!--休日の場合は表示しない-->
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
                        @endif
                    </td>
                        @endfor
                </tr>
                        @endforeach
            </tbody>
        </table>
    </div>
       
@endsection
@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/main.js') }}"></script>
@endsection