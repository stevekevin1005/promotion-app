<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopClassBig extends Model {

  protected $table = 'ShopClassBig';

  public function small_classes()
  {
    return $this->hasMany('App\Models\ShopClass', 'ShopClassBigid');
  }

  public function shops()
  {
    return $this->hasMany('App\Models\Shop', 'shop_class_big_id');
  }
}