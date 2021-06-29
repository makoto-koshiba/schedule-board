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