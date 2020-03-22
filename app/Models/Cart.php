<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\Console\Helper\Helper;

/**
 * Class Cart
 * @package App\Models
 * @method static self find(integer $id)
 * @method static self findOrFail(integer $id)
 * @method static self whereNull(string $column_name)
 * @method max(string $column_name)
 * @property integer $id
 * @property integer $user_id
 * @property string $cart_id
 * @property integer $product_id
 * @property integer $count
 * @property double $price
 * @property boolean $bought
 * @property boolean $deleted
 */

class Cart extends Model
{

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public static function currentCartId()
    {
        if (Cookie::get('cartId')) {
            return Cookie::get('cartId');
        } else {
            $val = sha1(time() . uniqid());
            \cookie('cartId', $val, 3000000);
            return  $val;
        }
    }
}
