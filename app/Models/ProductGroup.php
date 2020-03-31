<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductGroup
 * @package App\Models
 *
 * @method static self findOrFail(integer $id)
 * @method static self whereNull(string $column_name)
 * @property integer $brand_id
 * @property string $photo
 * @property string $name
 * @property string $description
 * @property string $mini_description
 * @property string $meta_description
 * @property string $meta_title
 * @property string $meta_keywords
 * @property boolean $deleted
 *
 *
 */
class ProductGroup extends Model
{

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand()
    {
        return $this->belongsTo('App\Models\Brand');
    }
}
