@extends('layouts.app')

@section('content')

<h1>予定一覧</h1>
 @if(Auth::check())
    
        @for ($i = -7; $i <=-1; $i++)
       {{$date->clone()->addday($i)->day,'前の週'}}
        @endfor 
       
         @for ($i = 7; $i <=13; $i++)
       {{ $date->clone()->addday($i)->day,'次の週' }}
        @endfor                     
                        

        <table class="table table-bordered">
            <thead>
                
                    <tr>
                        <th>{{ $date->year.'年'. $date->month.'月'}}</th>
                         @for ($i = 0; $i <=6; $i++)
                              <th> {{ $date->clone()->addday($i)->day }}</th>
                         @endfor
                    </tr>
                     
                    <tr>
                         <th></th>
                         @for ($i = 0; $i <=6; $i++)
                         <th>{{ $weekday[$date->clone()->addday($i)->weekday()] }}</th>
                          @endfor
                    </tr>
            
            </thead>
            
            <tbody>
                   @foreach ($users as $user)
                <tr>
                     <th>{{ $user->name }}</th>
                    @endforeach
                </tr>
                
                @foreach ($schedules as $schedule)
                
                    {{-- 予定詳細ページへのリンク --}}
                    
                    <td>{!! link_to_route('schedules.show', $schedule->project->title, ['schedule' => $schedule->id]) !!}</td>
                    
                    @endforeach
            </tbody>
        </table>
    @endif
    
       @if(Auth::check() && Auth::user()->admin_flag == true )
    {{-- 予定作成ページへのリンク --}}
    {!! link_to_route('schedules.create', '予定追加', [], ['class' => 'btn btn-primary']) !!}
    
    @endif
    
    

@endsection

<h1>予定一覧</h1>
    @if(Auth::check())
 　　　<!--前の2週、次の2週を表示する配列のリンク-->
{!! link_to_route('schedules.index', '＜ 前の2週間',['startDay'=> $beforWeekDate]) !!}
    　　
{!! link_to_route('schedules.index', '次の2週間 ＞',['startDay'=> $nextWeekDate]) !!}

{!! link_to_route('schedules.month', '月表示', ['date' => $date,], ['class' => 'btn btn-primary']) !!}

         <div class="overflow-auto" style="width:1075px; height:500px;">
        <table class="table table-bordered st-tbl1">
            <thead>
                
                    <tr>
                        <th>{{ $date->year.'年'. $date->month.'月'}}</th>
                        @for ($i = 0; $i <14; $i++)
                              <th> {{ $aryDay[$i] }}</th>
                        @endfor
                    </tr>
                    <tr>
                         <th></th>
                         @for ($i = 0; $i <14; $i++)
                             <th> {{ $weekday[$i] }}</th>
                         @endfor
                    </tr>
            </thead>
            
            <tbody>
                         @foreach ($users as $user)
                    <tr>
                            <th>{{ $user->name }}</th>
                         @for ($i = 0; $i <14; $i++)
                     <td>
                         <!--ユーザーに紐付いたプロジェクト名を日付に合わせて表示する-->
                         @if($schedules = $user->schedules()->where('date',$date->copy()->addDay($i))->get())
                         @foreach($schedules as $schedule)
                          {!! link_to_route('schedules.show', $schedule->project->title, ['schedule' => $schedule->id]) !!}
                          @endforeach
                         @endif
                     </td>
                         @endfor
                </tr>
                         @endforeach
            </tbody>
        </table>
        </div>
    @endif
    
    
       @if(Auth::check() && Auth::user()->admin_flag == true )
    {{-- 予定作成ページへのリンク --}}
    {!! link_to_route('schedules.create', '予定追加', [], ['class' => 'btn btn-primary']) !!}
       @endif
       
@endsection