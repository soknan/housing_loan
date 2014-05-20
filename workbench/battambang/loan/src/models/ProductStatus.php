<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 3/27/14
 * Time: 1:59 PM
 */

namespace Battambang\Loan;

use Eloquent;
class ProductStatus extends  Eloquent{
    protected $table = 'ln_product_status';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $softDelete = false;
} 