<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schedule;
use App\User;

class JointsController extends Controller
{
   
     public function store(Request $request, $scheduleId)
    {
        // $scheduleIdを手がかりに「予定」インスタンスを取得
        $schedule = Schedule::find($scheduleId);
        $user = User::find($request->user_id);
        // 当日のユーザーの予定を取得
        $otherSchedule = $user->schedules()->where('date', $schedule->date)->first();
        // dd($otherSchedules);
        // もし当日の予定がすでにある場合、紐付けを解除する
        if(!is_null($otherSchedule)){
            $otherSchedule->unjoint_user($user->id);
        }
        
       // $request->user_idを joint_user() メソッドの引数に渡す
        $schedule->joint_user($request->user_id);
        // 前のURLへリダイレクトさせる
        return back();
    }
    
     public function destroy(Request $request,$scheduleId)
    {
        // 予定が idのユーザを紐付け解除する
        $schedule = Schedule::find($scheduleId);
        $schedule->unjoint_user($request->user_id);
        
        
        // 前のURLへリダイレクトさせる
        return back();
    }
}
