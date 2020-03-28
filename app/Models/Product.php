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
 * @property integer $product_group_id
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
 * @property integer $order_by
 * @property string $language_id
 * @property integer $delivery_type_id
 * @property string $nds
 * @property string $delivery_days
 * @property string $notes
 * @property string $os
 *
 */
class Product extends Model
{

    public const DELIVERY_TYPE_E = 1;
    public const DELIVERY_TYPE_F = 2;

    public static $deliveryTypes = [
        self::DELIVERY_TYPE_E => 'Электронная (e-mail)',
        self::DELIVERY_TYPE_F => 'Физическая',
    ];



    public const LANG_RUS = 1;
    public const LANG_ENG = 2;

    public static $languages = [
        self::LANG_RUS => 'Русский',
        self::LANG_ENG => 'Английский',
    ];



    public const OS_WIN = 1;
    public const OS_MAC = 2;
    public const OS_LIN = 3;
    public const OS_AND = 4;

    public static $platforms = [
        self::OS_WIN => 'Windows',
        self::OS_MAC => 'MacOS',
        self::OS_LIN => 'Linux',
        self::OS_AND => 'Android',
    ];






    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand()
    {
        return $this->belongsTo(\App\Models\Brand::class);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productGroup()
    {
        return $this->belongsTo(\App\Models\ProductGroup::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categories()
    {
        return $this->hasMany(\App\Models\CategoryProduct::class);
    }
}
