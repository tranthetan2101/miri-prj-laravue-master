<?php

namespace App\Exports;

use App\Models\ReceiveInfo;
use Maatwebsite\Excel\Concerns\FromCollection;


class ReceiveInfosExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return ReceiveInfo::select('email','created_at')->get();
    }

}
