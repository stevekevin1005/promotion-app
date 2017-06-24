<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model {

  protected $table = 'Shops';

  public function small_class()
  {
    return $this->belongsTo('App\Models\ShopClass', 'shop_class_id');
  }

}