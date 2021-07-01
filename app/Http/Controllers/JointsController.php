<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schedule;

class JointsController extends Controller
{
   
     public function store(Request $request,$scheduleId)
    {
        // $scheduleIdを手がかりに「予定」インスタンスを取得
         $schedule = Schedule::find($scheduleId);
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
        $otherschedule = Schedule::where('date',$schedule->date)->first();
        if(!is_null($otherschedule)){
           $otherschedule->unjoint_user($request->user_id);
        }
        // 前のURLへリダイレクトさせる
        return back();
    }
}
