<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Broken extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
	protected $table = 'broken';
    protected $primaryKey = 'idbroken';
}
