<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    // クライアントとプロジェクトの1：多を定義
     public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
