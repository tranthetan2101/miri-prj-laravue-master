<?php

namespace App\Http\Livewire;

use App\Domains\Auth\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class CategoriesTable.
 */
class CategoriesTable extends TableComponent
{
    /**
     * @var string
     */
    public $sortField = 'name';

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
        $query = Category::withCount('product');

        if ($this->status === 'deleted') {
            return $query->onlyTrashed();
        }

        if ($this->status === 'deactivated') {
            return $query->onlyDeactivated();
        }

        return $query->onlyActive();
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
            Column::make(__('Picture'), 'picture')
                ->view('backend.category.includes.picture', 'category')
            ,
            Column::make(__('Slug'), 'slug'),
            Column::make(__('Actions'))
                ->view('backend.category.includes.actions', 'category'),
        ];
//        return [
//            Column::make(__('Name'))
//                ->searchable()
//                ->sortable(),
//            Column::make(__('Picture'), 'picture')->format(function(Category $model) {
//                return view('backend.category.includes.picture', ['category' => $model]);
//            }),
//            Column::make(__('Slug'), 'slug'),
//            Column::make(__('Active'), 'visible')
//                ->format(function(Category $model) {
//                    return view('backend.category.includes.visible', ['category' => $model]);
//                })
//                ->sortable(function ($builder, $direction) {
//                    return $builder->orderBy('visible', $direction);
//                }),
//            Column::make(__('Actions'))
//                ->format(function(Category $model) {
//                    return view('backend.category.includes.actions', ['category' => $model]);
//                }),
//        ];
    }
}
