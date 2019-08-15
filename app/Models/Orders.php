<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Orders extends Model
{
  use SoftDeletes;

  protected $dates = ['deleted_at'];

  protected $table = 'orders';
  protected $primaryKey = 'idorders';

  protected $fillable = [
      'idorders','idusers', 'iditems', 'due_date','date_orders','quantity','received_by','approved_by','status'
  ];

  public function users()
  {
    return $this->belongsTo('App\Models\User', 'idusers');
  }
  

  public function notifications()
  {
    return $this->hasMany('App\Models\Notifications', 'idorders');
  }

  public function orders_details()
  {
    return $this->hasMany('App\Models\OrdersDetails', 'idorders');
  }

  public function received()
  {
    return $this->hasOne('App\Models\Received', 'idreceived','received_by');
  }

  public function accepted()
  {
    return $this->hasOne('App\Models\Accepted', 'idaccepted','accepted_by');
  }

}
