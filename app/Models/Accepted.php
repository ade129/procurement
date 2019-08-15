<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Accepted extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
	protected $table = 'accepted';
    protected $primaryKey = 'idaccepted';

    public function users()
    {
    	return $this->belongsTo('App\Models\User', 'idusers' );
    }
}
