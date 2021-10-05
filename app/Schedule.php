<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = ['date'];

    // スケジュールとプロジェクトの関係定義
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    
    // ユーザーとスケジュールの多対多を定義
    public function joint_users()
    {
        return $this->belongsToMany(User::class, 'schedule_user', 'schedule_id', 'user_id')->withTimestamps();
    }
    
     public function  joint_user($userId)
    {
        // すでに紐付けしているかの確認
        $exist = $this->is_joint_user($userId);
       
        if ($exist) {
            // 紐付けしていれば何もしない
            return false;
        } else {
            // 未登録であれば登録する
            $this->joint_users()->attach($userId);
            return true;
        }
    }
    
    
    
     public function unjoint_user($userId)
    {
        // 紐付けしているかの確認
        $exist = $this->is_joint_user($userId);
        

        if ($exist) {
            // すでに紐付けしていれば外す
            $this->joint_users()->detach($userId);
            return true;
        } else {
            // 未登録であれば何もしない
            return false;
        }
    }
    
    public function is_joint_user($userId)
    {
         return $this->joint_users()->where('user_id', $userId)->exists();
    }
}