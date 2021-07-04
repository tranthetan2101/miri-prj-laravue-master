<?php

namespace App\Http\Livewire;

use App\Domains\Auth\Models\User;
use App\Models\ReceiveInfo;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class ReceiveInfosTable.
 */
class ReceiveInfosTable extends TableComponent
{
    /**
     * @var string
     */
    public $sortField = 'id';

    public $exports = ['csv', 'xls', 'xlsx', 'pdf'];

    public $sortDirection = 'desc';


    public function mount(): void
    {
    }

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        $query = ReceiveInfo::query();
        return $query;
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('Email'), 'email')
                ->searchable(),
            Column::make(__('Ngày đăng ký'), 'created_at')
                ->customAttribute()
                ->html(function(ReceiveInfo $model) { return timezone()->convertToLocal($model->created_at, 'Y-m-d H:i');})
                ->sortable(),
        ];
    }
}
