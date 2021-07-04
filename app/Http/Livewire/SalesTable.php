<?php

namespace App\Http\Livewire;

use App\Models\Sale;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class SalesTable.
 */
class SalesTable extends TableComponent
{
    /**
     * @var string
     */
    public $sortField = 'id';

    public $sortDirection = 'desc';

    /**
     * @var string
     */
    public $status;

    /**
     * @param  string  $status
     */
    public function mount($status = 'active'): void
    {
        $this->status = $status;
    }

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        if ($this->status === 'deleted') {
            return Sale::onlyTrashed()->with('products');
        }

        return Sale::with('products');
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('Name'), 'name')
                ->searchable(),
            Column::make(__('Period'))
                ->view('backend.sale.includes.period', 'sale'),
            Column::make(__('Products'))
                ->view('backend.sale.includes.products', 'sale')
            ,
            Column::make(__('Discount Percent'), 'sale_amount')
                ->searchable(),
            Column::make(__('Create'), 'created_at')
                ->customAttribute()
                ->html(function(Sale $model) { return timezone()->convertToLocal($model->created_at, 'Y-m-d H:i');})
                ->sortable(),
            Column::make(__('Actions'))->view('backend.sale.includes.actions', 'sale'),
        ];
    }
}
