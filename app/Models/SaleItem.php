<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class SaleItem extends Pivot
{
    protected $table = "sale_items";
}
