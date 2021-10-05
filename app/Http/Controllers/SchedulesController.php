<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schedule;
use App\User;
use App\Project;
use Carbon\Carbon;
use App\Holiday;

class SchedulesController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
        // dd($request->startDay);
        if (\Auth::check())
        $user = \Auth::user();
       
        $users = User::where('admin_flag' , false)->get();
        
        // 日付の指定があれば指定日から、指定が無ければ今日の日付からインスタンスを作成
        if ($request->startDay) {
            $date = new Carbon($request->startDay);
        } else {
            $date = Carbon::today();
        }
        
        // 前の週、次の2週の日付を表示
        $nextWeekDate = $date->copy()->addWeeks(2)->format('Y-m-d');
        $beforWeekDate = $date->copy()->subWeeks(2)->format('Y-m-d');
        
        //曜日の配列を設定
        $weekday_label = [ '日', '月', '火', '水', '木', '金', '土'];
        
        // 日付を月曜日から表示
        $date->startOfWeek();
        $day = $date->copy();
        
        // 初日と末日を設定し、期間中に登録してある休日の日付を取得
        $startDay = $date->copy()->format('Y-m-d');
        $endDay = $date->copy()->addDay(13)->format('Y-m-d');
        $holidays = Holiday::whereBetween('date', [$startDay, $endDay])->pluck('date')->toArray();
        // dd($holidays);
        for ($i=0; $i<14; $i++){
            $holiday = Holiday::where('date',$date->copy()->format('Y-m-d'))->first();
            if ($holiday){
                $holiday_flag = true;
                $holiday_content = $holiday->content;
            } else {
                $holiday_flag = false;
                $holiday_content = null;
            }
                 // 曜日を日付から取得
                 $weekday[] = $weekday_label[$date->copy()->dayOfWeek];
                 
                 // 連想配列で日付、曜日、休日確認を紐づける
                 $aryDays[] = [
                'day' => $date->day,
                'weekday_label' => $weekday[$i],
                'holiday_flag' => $holiday_flag,
                'holiday_content' => $holiday_content,
                ];
            // $counter = $i-7;
            // if (6<$i && $i<14){
            //   $aryDays[] = [
            //     'day' => $date->day,
            //     'weekday_label' => $weekday_label[$counter],
            //     'holiday_flag' => $holiday_flag,
            //     'holiday_content' => $holiday_content,
            //     ]; 
            // } else {
            //     'weekday_label' => $weekday_label[$i]
            // }
                $date->addDay();
        }
        // dd($aryDays);

        // 予定一覧ビューでそれを表示
        return view('schedules.index', [
             'users' => $users,
             'date' => $date,
             'nextWeekDate'=> $nextWeekDate,
             'beforWeekDate' => $beforWeekDate,
             'aryDays'=> $aryDays,
             'day'=> $day,
             'holidays'=>$holidays
        ]);
    }
    
     public function month(Request $request)
    { 
        // dd($request->startDay);
        if (\Auth::check())
        $user = \Auth::user();
       
        $users = User::where('admin_flag' , false)->get();
        
        // 日付の指定があれば指定日から、指定が無ければ今日の日付からインスタンスを作成
        if ($request->startDay) {
            $date = new Carbon($request->startDay);
        } else {
            $date = Carbon::today();
        }
        // 日付を1日から表示
        $date->startOfMonth();
        $day = $date->copy();
        
        // 前の月、次の月の日付を表示
        $nextMonthDate = $date->copy()->addMonth()->format('Y-m-d');
        $beforMonthDate = $date->copy()->subMonth()->format('Y-m-d');
        
        // 曜日ラベルを設定
        $weekday_label = ['日', '月', '火', '水', '木', '金', '土'];
        
        // 当月の日数を取得
        $daysInMonth = $date->daysInMonth;
        
        // 一日と末日を設定し、期間中に登録してある休日の日付を取得
        $startDay = $date->copy()->format('Y-m-d');
        $endDay = $date->copy()->addDay($daysInMonth -1)->format('Y-m-d');
        $holidays = Holiday::whereBetween('date', [$startDay, $endDay])->pluck('date')->toArray();
    //   dd($holidays);
        
        // 以下の処理をひと月分繰り返す
        for ($i=0; $i<$daysInMonth; $i++){
            
            // 日付が休日にあるか検索する
            $holiday = Holiday::where('date',$date->copy()->format('Y-m-d'))->first();
            if ($holiday){
                $holiday_flag = true;
                $holiday_content = $holiday->content;
            } else {
                $holiday_flag = false;
                $holiday_content = null;
            }
                // 曜日を日付から取得
                 $weekday[] = $weekday_label[$date->copy()->dayOfWeek];
                 
                 // 連想配列で日付、曜日、休日確認を紐づける
                 $aryDays[] = [
                'day' => $date->day,
                'weekday_label' => $weekday[$i],
                'holiday_flag' => $holiday_flag,
                'holiday_content' => $holiday_content,
                ];
            
            // 日付を月末まで足していく
                $date->addDay();
        }
        // dd($aryDays);

        
        // 予定一覧ビューでそれを表示
        return view('schedules.month', [
             'users' => $users,
             'date' => $date,
             'nextMonthDate'=> $nextMonthDate,
             'beforMonthDate' => $beforMonthDate,
             'aryDays'=> $aryDays,
             'day'=> $day,
             'daysInMonth'=> $daysInMonth,
             'holidays'=> $holidays,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $userId = null;
        if($request->userId){
            $userId = $request->userId;
           }
        // スケジュールのインスタンスを作成
         $schedule = new Schedule;
         
        // ユーザーとプロジェクトを取得
         $users = User::where('admin_flag' , false)->get();
         $projects = Project::where('finish_flag', false)->get();

        // 予定作成ビューを表示
        return view('schedules.create', [
            'schedule' => $schedule,
            'users' => $users,
            'projects' => $projects,
            'userId' => $userId,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        // 日付とプロジェクトをバリデーション
        $request->validate([
            'project_id' => 'required',
        ]);
        
        // 予定開始日と終了日のインスタンスを生成
        $startDay = new Carbon($request->startDay);
        $endDay = new Carbon($request->endDay);
        
        // 開始日と終了日の日数を計算
        $days = $startDay->diffInDays($endDay);
        
        // 休日を取得
        $holidays = Holiday::whereBetween('date',[$request->startDay,$request->endDay])->get();
        // dd($holidays);
        
        // 日数分予定を繰り返す
        for($i = 0; $i <= $days; $i++){
            $schedule = new Schedule;
            $schedule->date = $startDay->copy()->addDay($i)->format('Y-m-d');
            $schedule->project_id = $request->project_id;
        if(count($holidays)>0){
        foreach($holidays as $holiday){
             if($schedule->date == $holiday->date){
                $schedule->holiday_flag = TRUE;
             }
        }
        }
        // dd($schedule->holiday_flag);
            $schedule->save();
        
        // ユーザーIDについてループ                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
            foreach ($request->userIds as $userId){
            // userインスタンスからuserIdを取得
                      $user = User::find($userId);
                    //   $otherSchedule = $user->schedules()->where('date', $schedule->date)->first();
                      
            // // もし当日の予定がすでにある場合、紐付けを解除する
            //          if(!is_null($otherSchedule)){
            //          $otherSchedule->unjoint_user($user->id);
            //          }
               
                      $schedule->joint_user($userId);
                    //   dd($schedule->joint_users()->get());
            }
        }
        // スケジュール作成後一覧へ戻る
        return redirect()->route('schedules.month');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        // idの値で予定を検索して取得
        $schedule = Schedule::findOrFail($id);
        
        // 予定詳細ビューでそれを表示
        return view('schedules.show', [
            'schedule' => $schedule,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // idの値で予定を検索して取得
        $schedule = Schedule::findOrFail($id);
        // ユーザー一覧を取得
        $users = User::where('admin_flag' , false)->get();

        // 予定編集ビューでそれを表示
        return view('schedules.edit', [
            'schedule' => $schedule,
            'users' => $users,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // idの値で予定を検索して取得
        $schedule = Schedule::findOrFail($id);
        // 日付とプロジェクトをバリデーション
        $request->validate([
            'date' => 'required',
            'project_id' => 'required',
            ]);
            
        // 予定を更新
        $schedule->date = $request->date;
        $schedule->project_id = $request->project_id;
       
        $schedule->save();
    //   ユーザーIDでループ
        foreach ($request->userIds as $userId){
        $schedule->joint_user($userId);
        }

        // 更新後一覧へ戻る
        return redirect()->route('schedules.month');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         // idの値で予定を検索して取得
        $schedule = Schedule::findOrFail($id);
        // 予定を削除
        $schedule->delete();

        // 削除後
        return redirect()->route('schedules.month');
    }
    
     public function modal(Request $request)
    {
        // // 選んだ日付が休日か判断し、休日だった場合indexに戻る
        // $holiday = Holiday::where('date',$request->date)->first();
        // if(!is_null($holiday)){
        //   return redirect()->route('schedules.index')->with('message', '休日のため予定を追加できません'); 
        // }
        
        // スケジュールのインスタンスを作成
         $schedule = new Schedule;
         
        // ユーザーとプロジェクトを取得
         $user = User::find($request->userId);
         $projects = Project::where('finish_flag', FALSE)->get();
         $date = new Carbon($request->date);
        

        // 予定作成ビューを表示
        return view('schedules.modal', [
            'schedule' => $schedule,
            'user' => $user,
            'projects' => $projects,
            'date' => $date,
        ]);
    }
    
    public function dayStore(Request $request)
    {
        
        // 日付とプロジェクトをバリデーション
        $request->validate([
            'project_id' => 'required',
        ]);
        
        //選択した日付に同じプロジェクトのスケジュールがあるか確認し、なければ新規スケジュールとして登録する
        $schedule = Schedule::where('project_id', $request->project_id)->where('date', $request->date)->where('holiday_flag' , false)->first();
        
        // 休日を取得
        // $holiday = Holiday::where('date',$request->date)->first();
       
        if(is_null($schedule)){
           $schedule= new Schedule;
           $schedule->date = new Carbon($request->date);
           $schedule->project_id = $request->project_id;
           $schedule->holiday_flag = false;     
           $schedule->save();  
        }
       
        // userインスタンスからuserIdを取得
        $schedule->joint_user($request->userId);
       
        // スケジュール作成後一覧へ戻る
        return redirect()->route('schedules.month');
    }
}
