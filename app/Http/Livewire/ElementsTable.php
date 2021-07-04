<?php

namespace App\Http\Livewire;

use App\Models\Element;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class ElementsTable.
 */
class ElementsTable extends TableComponent
{
    /**
     * @var string
     */
    public $sortField = 'name';

    public $sortDirection = 'asc';


    public function mount(): void
    {
    }

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        $query = Element::query();
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
            Column::make(__('Picture'), 'picture')
                ->view('backend.element.includes.picture', 'element')
            ,
            Column::make(__('Description'), 'description'),
            Column::make(__('Actions'))
                ->view('backend.element.includes.actions', 'element'),
        ];
    }
}
