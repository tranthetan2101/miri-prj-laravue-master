<?php

namespace App\Http\Livewire;

use App\Domains\Auth\Models\User;
use App\Models\Quiz;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class QuizzesTable.
 */
class QuizzesTable extends TableComponent
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
        $query = Quiz::query();
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
            Column::make(__('Phone'), 'phone_number')
                ->searchable(),
            Column::make(__('Email'), 'email'),
            Column::make(__('Note'), 'note'),
            Column::make(__('Actions'))
                ->view('backend.quiz.includes.actions', 'quiz'),
        ];
    }
}
