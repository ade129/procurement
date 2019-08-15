<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categories extends Model
{
  use SoftDeletes;

  protected $dates = ['deleted_at'];

  protected $table = 'categories';
  protected $primaryKey = 'idcategories';

  protected $fillable = [
      'name',
  ];

  public function items()
  {
    return $this->hasMany('App\Models\Items', 'idcategories');
  }
}
