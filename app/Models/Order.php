<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 * @package App\Models
 * @method static self findOrFail(integer $id)
 * @method static self whereNull(string $column_name)
 * @method max(string $column_name)
 * @property integer $id
 * @property integer $user_id
 * @property string|null $cart_id
 * @property integer $type
 * @property string|null $name
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $inn
 * @property string|null $kpp
 * @property string|null $contactnoe_lico
 * @property string|null $raschetnyi_schet
 * @property string|null $city
 * @property string|null $address
 * @property string|null $comment
 * @property string|null $valuta
 * @property double|null $sum
 * @property double|null $discount
 * @property boolean|null $deleted
 * @property boolean|null $is_new
 *
 */

class Order extends Model
{

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
