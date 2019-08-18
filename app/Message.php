<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function from()
    {
        return $this->belongsTo('App\User','from_id');
    }
    public function to()
    {
        return $this->belongsTo('App\User','to_id');
    }
    protected $fillable = ['from_id','to_id','info','read'];
    public $timestamps = false;
}
