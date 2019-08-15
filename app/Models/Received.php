<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Received extends Model
{
      use SoftDeletes;

    protected $dates = ['deleted_at'];
	protected $table = 'received';
    protected $primaryKey = 'idreceived';

    public function users()
    {
    	return $this->belongsTo('App\Models\User', 'idusers');

    }
}
