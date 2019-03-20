<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductsImage extends Model
{
    protected $fillable = ['filename','product_id'];

    public function product(){
        return $this->belongsTo('App\Product');
    }
}
