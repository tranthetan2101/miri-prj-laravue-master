<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Contact extends Model
{
    protected $casts = [
        'open_time' => 'date:hh:mm',
        'close_time' => 'date:hh:mm'
    ];

    protected $table = 'contacts';
    protected $fillable = ['address', 'email', 'phone_number', 'link', 'image', 'open_time', 'close_time', 'address_building','hotline','name','description'];

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
