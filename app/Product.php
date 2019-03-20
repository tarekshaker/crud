<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name','price','main_image','description'];

    public function images(){
        return $this->hasMany('App\ProductsImage');
    }
}
