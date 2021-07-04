<?php

namespace App\Http\Livewire;

use App\Models\Combo;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class CombosTable.
 */
class CombosTable extends TableComponent
{
    /**
     * @var string
     */
    public $sortField = 'created_at';

    public $sortDirection = 'desc';



    /**
     * @param  string  $status
     */
    public function mount(): void
    {

    }

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        return Combo::query();
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
                ->view('backend.combo.includes.picture','combo'),
            Column::make(__('Category'), 'category_id')
                ->view('backend.combo.includes.category','combo')
                ->searchable(function ($builder, $term) {
                    return $builder->orWhereHas('category', function ($query) use ($term) {
                        return $query->where('name', 'like', '%'.$term.'%');
                    });
                }),
            Column::make(__('Create'), 'created_at')
                ->customAttribute()
                ->html(function(Combo $model) { return timezone()->convertToLocal($model->created_at, 'Y-m-d H:i');})
                ->sortable(),
            Column::make(__('Actions'))->view('backend.combo.includes.actions', 'combo'),
        ];
    }
}
