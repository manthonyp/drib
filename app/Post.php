<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $primaryKey = 'id';
    protected $dates = [
        'created_at',
        'updated_at'
    ];
    public $timestramps = true;
    
    public function User()
    {
        return $this->belongsTo('App\User');
    }
}
