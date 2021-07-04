<?php

namespace App\Http\Livewire;

use App\Domains\Auth\Models\User;
use App\Models\City;
use App\Models\DeliveryFee;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class DeliveryFeesTable.
 */
class DeliveryFeesTable extends TableComponent
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
        $query = DeliveryFee::with(['city','district','ward']);
        return $query;
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('City'), 'city_id')
                ->view('backend.delivery_fee.includes.city', 'delivery_fee'),
            Column::make(__('District'), 'district_id')
                ->view('backend.delivery_fee.includes.dist', 'delivery_fee'),
            Column::make(__('Ward'), 'ward_id')
                ->view('backend.delivery_fee.includes.ward', 'delivery_fee'),
            Column::make(__('Fee'), 'fee')
                ->searchable()
                ->sortable(),
            Column::make(__('Actions'))
                ->view('backend.delivery_fee.includes.actions', 'delivery_fee'),
        ];
    }
}
