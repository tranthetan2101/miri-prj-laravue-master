<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Element extends Model
{

    protected $table = 'elements';
    protected $fillable = ['letter', 'name', 'description', 'image'];

    /**
     * @var array
     */
    protected $appends = [
        'picture',
    ];
    public $timestamps = false;

    public function getPictureAttribute()
    {
        return filter_var(str_replace(" ", "_", $this->image), FILTER_VALIDATE_URL) ? $this->image : Storage::url($this->image);
    }
}
