<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * @package App\Models
 * @method static self findOrFail(integer $id)
 * @method static self whereNull(string $column_name)
 * @method max(string $column_name)
 * @property integer $id
 * @property integer $category_id
 * @property integer $brand_id
 * @property double $price
 * @property double $old_price
 * @property string $photo
 * @property string $name
 * @property string $description
 * @property string $mini_description
 * @property string $meta_description
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $article
 * @property boolean $deleted
 *
 *
 *
 */
class Product extends Model
{

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand()
    {
        return $this->belongsTo('App\Models\Brand');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
}
