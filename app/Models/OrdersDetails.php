<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrdersDetails extends Model
{
  use SoftDeletes;

  protected $dates = ['deleted_at'];

  protected $table = 'orders_details';
  protected $primaryKey = 'idordersdetails';
  
  public function items()
  {
    return $this->belongsTo('App\Models\Items', 'iditems');
  }
}
