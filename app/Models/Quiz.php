<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    public const TYPES = ['Da thường','Da dầu','Da khô','Da hỗn hợp','Da nhạy cảm'];
    public const PROBLEMS = ['Da bị lão hoá','Da bị ửng đỏ','Da bị khô','Da bị chấm đỏ, trắng'];
    protected $fillable  = ['name', 'email', 'phone_number', 'skin_type', 'skin_problem', 'note'];
    protected $appends = [
        'type',
        'problem'
    ];
    public function getTypeAttribute()
    {
        return !empty(self::TYPES[$this->skin_type]) ? self::TYPES[$this->skin_type] : 'Unknown';
    }
    public function getProblemAttribute()
    {
        return !empty(self::PROBLEMS[$this->skin_problem]) ? self::PROBLEMS[$this->skin_problem] : 'Unknown';
    }
}
