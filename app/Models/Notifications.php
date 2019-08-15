<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
  protected $table = 'notifications';
  protected $primaryKey = 'idnotifications';

  protected $fillable = [
      'idusers','idorders','subject','seen'
  ];

  public function users()
  {
    return $this->belongsTo('App\Models\User', 'idusers');
  }

  public function orders()
  {
    return $this->belongsTo('App\Models\Orders', 'idorders');
  }
}
