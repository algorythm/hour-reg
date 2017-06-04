<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = ['name'];

    public function hours() {
      return $this->hasMany('App\Hour');
    }
}
