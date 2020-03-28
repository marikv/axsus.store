<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CategoryProduct
 * @package App\Models
 * @method static self findOrFail(integer $id)
 * @method static self whereNull(string $column_name)
 * @method max(string $column_name)
 * @property integer $id
 * @property integer $category_id
 * @property integer $product_id
 *
 *
 *
 */
class CategoryProduct extends Model
{

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
