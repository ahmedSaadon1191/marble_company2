<?php

namespace App\Models;

use App\Models\Category;
use App\Models\ProductImg;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{

    protected $fillable = ['name', 'updated_at', 'created_at', 'top_product'];
    protected $hidden = ['created_at', 'updated_at', 'pivot'];
    use HasTranslations;
    public $translatable = ['name'];
    use SoftDeletes;

    protected $table = 'products';

    public $timestamps = true;

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Get all of the comments for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productImage()
    {
        return $this->hasMany(ProductImg::class, 'product_id', 'id')->withTrashed();
    }


     // OTHER METHODS
     public function Status()
     {
     return $this->top_product == 1 ? 'مهم' : 'منتج عادي';
     }
}
