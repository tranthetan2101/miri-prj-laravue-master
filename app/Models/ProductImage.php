<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductImage extends Model
{
    protected $table = 'product_images';
    protected $fillable = [
        'product_id',
        'file_name',
        'sort_no'
    ];
    /**
     * @var array
     */
    protected $appends = [
        'picture',
    ];

    public function getPictureAttribute()
    {
        return filter_var(str_replace(" ", "_", $this->file_name), FILTER_VALIDATE_URL) ? $this->file_name : Storage::url($this->file_name);
    }
}
