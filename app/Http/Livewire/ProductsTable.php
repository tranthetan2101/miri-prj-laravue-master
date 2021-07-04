<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class ProductsTable.
 */
class ProductsTable extends TableComponent
{
    /**
     * @var string
     */
    public $sortField = 'created_at';

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
            return Product::onlyTrashed();
        }

        return Product::query();
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('Name'), 'name')
                ->searchable()
                ->sortable(function ($builder, $direction) {
                    return $builder->orderBy('created_at', $direction);
                }),
            Column::make(__('Sku'))
                ->searchable(),
            Column::make(__('Picture'), 'picture')
                ->view('backend.product.includes.picture','product'),
            Column::make(__('Category'), 'category_id')
                ->view('backend.product.includes.category','product')
                ->searchable(function ($builder, $term) {
                    return $builder->orWhereHas('category', function ($query) use ($term) {
                        return $query->where('name', 'like', '%'.$term.'%');
                    });
                }),
            Column::make(__('Type'))
                ->view('backend.product.includes.type','product')
                ->sortable(function ($builder, $direction) {
                    return $builder->orderBy('gift_set', $direction);
                }),
            Column::make(__('Create'), 'created_at')
                ->customAttribute()
                ->html(function(Product $model) { return timezone()->convertToLocal($model->created_at, 'Y-m-d H:i');})
                ->sortable(),
            Column::make(__('Actions'))->view('backend.product.includes.actions', 'product'),
        ];
//        return [
//            Column::make(__('Name'))
//                ->searchable()
//                ->sortable(),
//            Column::make(__('Picture'), 'picture')->format(function(Product $model) {
//                return view('backend.product.includes.picture', ['product' => $model]);
//            }),
//            Column::make(__('Slug'), 'slug'),
//            Column::make(__('Create'), 'created_at')->format(function(Product $model) {
//                return timezone()->convertToLocal($model->created_at, 'Y-m-d H:i');
//            })->sortable(function ($builder, $direction) {
//                    return $builder->orderBy('created_at', $direction);
//                }),
//            Column::make(__('Actions'))
//                ->format(function(Product $model) {
//                    return view('backend.product.includes.actions', ['product' => $model]);
//                }),
//        ];
    }
}
