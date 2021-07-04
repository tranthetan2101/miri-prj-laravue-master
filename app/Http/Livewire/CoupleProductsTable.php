<?php

namespace App\Http\Livewire;

use App\Domains\Auth\Models\User;
use App\Models\CoupleProduct;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class CoupleProductsTable.
 */
class CoupleProductsTable extends TableComponent
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
        $query = CoupleProduct::with(['product1','product2']);
        return $query;
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('Product 1'),'product1_id')
                ->view('backend.couple_product.includes.product1', 'couple_product')
                ->searchable(function ($builder, $term) {
                    return $builder->orWhereHas('product1', function ($query) use ($term) {
                        return $query->where('name', 'like', '%'.$term.'%');
                    });
                }),
            Column::make(__('Product 2'), 'product2_id')
                ->view('backend.couple_product.includes.product2', 'couple_product')
                ->searchable(function ($builder, $term) {
                    return $builder->orWhereHas('product2', function ($query) use ($term) {
                        return $query->where('name', 'like', '%'.$term.'%');
                    });
                }),
            Column::make(__('Actions'))
                ->view('backend.couple_product.includes.actions', 'couple_product'),
        ];
    }
}
