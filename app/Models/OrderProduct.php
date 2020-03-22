<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderProduct
 * @package App\Models
 * @method static self findOrFail(integer $id)
 * @method static self whereNull(string $column_name)
 * @method max(string $column_name)
 * @property integer $id
 * @property integer $order_id
 * @property integer $product_id
 * @property integer $count
 * @property double $price
 * @property boolean $deleted
 */
class OrderProduct extends Model
{

    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
