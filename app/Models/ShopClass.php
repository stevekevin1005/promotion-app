<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopClass extends Model {

  protected $table = 'ShopClassSmall';

  public function big_class()
  {
      return $this->belongsTo('App\Models\ShopClassBig', 'ShopClassBigid');
  }

  public function shops()
  {
      return $this->hasMany('App\Models\Shop', 'shop_class_id');
  }
}