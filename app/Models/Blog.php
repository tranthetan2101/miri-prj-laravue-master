<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Blog extends Model
{
    use SoftDeletes;
    protected $table = 'blogs';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'data',
        'description',
        'image'
    ];

    /**
     * @var array
     */
    protected $appends = [
        'picture',
    ];

    public function getPictureAttribute()
    {
        return filter_var(str_replace(" ", "_", $this->image), FILTER_VALIDATE_URL) ? $this->image : Storage::url($this->image);
    }
}
