<?php

namespace App\Http\Livewire;

//use App\Models\Announcement;
use App\Domains\Announcement\Models\Announcement;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class AnnouncementsTable.
 */
class AnnouncementsTable extends TableComponent
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
        $query = Announcement::query();

        if ($this->status === 'deactivated') {
            return $query->disabled();
        }

        return $query->enabled();

    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('Message'), 'message')
                ->searchable(),
            Column::make(__('Period'))
                ->view('backend.announcement.includes.period', 'theAnnouncement'),
            Column::make(__('Status'))
                ->view('backend.announcement.includes.status', 'theAnnouncement'),

            Column::make(__('Actions'))->view('backend.announcement.includes.actions', 'theAnnouncement'),
        ];
    }
}
