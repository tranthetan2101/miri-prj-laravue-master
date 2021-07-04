<?php

namespace App\Http\Livewire;

use App\Models\Coupon;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class CouponsTable.
 */
class CouponsTable extends TableComponent
{
    /**
     * @var string
     */
    public $sortField = 'id';

    public $sortDirection = 'desc';


    public function mount(): void
    {
    }

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        $query = Coupon::query();
        return $query;
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('Name'), 'name')
                ->searchable()
                ->sortable(),
            Column::make(__('Code'), 'code')
                ->searchable()
                ->sortable(),
            Column::make(__('Discount'), 'price')
                ->view('backend.coupon.includes.number', 'coupon')
                ->sortable(),
            Column::make(__('Start'), 'period_start')
                ->customAttribute()
                ->html(function(Coupon $model) { return timezone()->convertToLocal($model->period_start, 'Y-m-d H:i');})
                ->sortable(),
            Column::make(__('End'), 'period_end')
                ->customAttribute()
                ->html(function(Coupon $model) { return timezone()->convertToLocal($model->period_end, 'Y-m-d H:i');})
                ->sortable(),
            Column::make(__('Quantity'), 'used_num'),
            Column::make(__('Unlimited'))
                ->view('backend.coupon.includes.unlimited', 'coupon')
                ,
            Column::make(__('Actions'))
                ->view('backend.coupon.includes.actions', 'coupon'),
        ];
    }
}
