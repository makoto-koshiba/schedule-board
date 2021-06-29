<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schedule;
use App\User;
use App\Project;
use Carbon\Carbon;

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
       
        $users = User::all();
        
        // 日付の指定があれば指定日から、指定が無ければ今日の日付からインスタンスを作成
        if ($request->startDay) {
            $date = new Carbon($request->startDay);
        } else {
            $date = Carbon::today();
        }
        // 日付を月曜日から表示
        $date->startOfWeek();
        
        // 前の週、次の週の日付を表示
        $nextWeekDate = $date->copy()->addWeek()->format('Y-m-d');
        $beforWeekDate = $date->copy()->subWeek()->format('Y-m-d');
        
        $weekday = ['月', '火', '水', '木', '金', '土','日',];
        
        // 日付をい週間分配列で作成
        $day = $date -> copy();
        for($i=0; $i<7; $i++){ 
            $aryDay[] = $day->day;
            $day->addDay();
        }
        
        
        // 予定一覧ビューでそれを表示
        return view('schedules.index', [
             'users' => $users,
             'date' => $date,
             'weekday' => $weekday,
             'nextWeekDate'=> $nextWeekDate,
             'beforWeekDate' => $beforWeekDate,
             'aryDay'=> $aryDay,
             'day'=> $day,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // スケジュールのインスタンスを作成
         $schedule = new Schedule;
         
        // ユーザーとプロジェクトを取得
         $users = User::all();
         $projects = Project::all();

        // 予定作成ビューを表示
        return view('schedules.create', [
            'schedule' => $schedule,
            'users' => $users,
            'projects' => $projects,
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
         // スケジュールを作成
        $schedule = new Schedule;
        
        // 日付とプロジェクトをバリデーション
        $request->validate([
            'date' => 'required',
            'project_id' => 'required',
        ]);
        
        $schedule->date = $request->date;
        $schedule->project_id = $request->project_id;
        
        $schedule->save();
        
        // ユーザーIDについてループ
        foreach ($request->userIds as $userId){
            $schedule->joint_user($userId);
        }
        
        // スケジュール作成後一覧へ戻る
        return redirect()->route('schedules.index');
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
        $users = User::all();

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
        return redirect()->route('schedules.index');
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

        // 削除後一覧へ戻る
        return redirect('/');
    }
}
