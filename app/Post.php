<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * Set table name
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * Set column primary key
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Timestamps
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that are guarded and not included in mass assignable
     *
     * @var array
     */
    protected $guarded = [
        'id', 'downloads', 'shared', 'share_token', 'share_url', 'trashed' 
    ];

    /**
     * Set timestamps fill to true
     *
     * @var boolean
     */
    public $timestamps = true;
    
    /**
     * Assign relationship
     *
     * @return void
     */
    public function User()
    {
        return $this->belongsTo('App\User');
    }
}
