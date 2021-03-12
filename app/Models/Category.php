<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{




    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at', 'pivot'];
    use HasTranslations;
    public $translatable = ['name'];
    // protected $table = 'categories';
    use SoftDeletes;


    public $timestamps = true;

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

}



