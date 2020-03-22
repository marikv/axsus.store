<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Brand
 * @package App\Models
 *
 *
 * @property string $photo
 * @property string $name
 * @property string $description
 * @property string $mini_description
 * @property string $meta_description
 * @property string $meta_title
 * @property string $meta_keywords
 * @property integer $order_by
 * @property boolean $deleted
 *
 *
 */
class Brand extends Model
{
    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }
}
