<?php

namespace Battambang\Loan;

use Eloquent;

class Category extends Eloquent
{
    protected $table = 'ln_category';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $softDelete = false;

    public function products(){
        return $this->hasMany('Product');
    }
}
