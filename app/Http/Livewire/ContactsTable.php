<?php

namespace App\Http\Livewire;

use App\Domains\Auth\Models\User;
use App\Models\Contact;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class ContactsTable.
 */
class ContactsTable extends TableComponent
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
        $query = Contact::query();
        return $query;
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('Address'), 'address')
                ->searchable()
                ->sortable(),
            Column::make(__('Picture'), 'picture')
                ->view('backend.contact.includes.picture', 'contact')
            ,
            Column::make(__('Email'), 'email'),
            Column::make(__('Actions'))
                ->view('backend.contact.includes.actions', 'contact'),
        ];
    }
}
