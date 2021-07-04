<?php

namespace App\Http\Livewire;

use App\Domains\Auth\Models\User;
use App\Models\Banner;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class BannersTable.
 */
class BannersTable extends TableComponent
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
        $query = Banner::query();
        return $query;
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('Url'), 'url')
                ->searchable()
                ->sortable(),
            Column::make(__('Picture'), 'picture')
                ->view('backend.banner.includes.picture', 'banner')
            ,
            Column::make(__('Actions'))
                ->view('backend.banner.includes.actions', 'banner'),
        ];
    }
}
