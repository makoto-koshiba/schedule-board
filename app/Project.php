<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function schedule()
    {
        return $this->hasMany(Schedule::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    
    protected $appends = ['google_href'];

  public function getGoogleHrefAttribute()
  {
    return 'http://maps.google.co.jp/maps?q={' . urlencode($this->address) . '}&z={15}';
  }
  
}
