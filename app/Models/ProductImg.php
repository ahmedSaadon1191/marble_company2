<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductImg extends Model
{
    protected $hidden = ['created_at', 'updated_at', 'pivot'];


    protected $guarded = [];
    use HasTranslations;
    public $translatable = ['color_name'];

          use SoftDeletes;

    public $timestamps = true;

    /**
     * The roles that belong to the ProductImg
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function colors()
    {
        return $this->belongsToMany('App\Models\Color', 'color_productImgs', 'product_img_id', 'color_id');
    }

    /**
     * Get the user that owns the ProductImg
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

}
