<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Banner extends Model
{
    protected $fillable = ['url','name'];

    protected $timeStamps = false;

    protected $table = 'banners';

    /**
     * @var array
     */
    protected $appends = [
        'picture',
    ];

    public function getPictureAttribute()
    {
        return filter_var(str_replace(" ", "_", $this->name), FILTER_VALIDATE_URL) ? $this->name : Storage::url($this->name);
    }
}
