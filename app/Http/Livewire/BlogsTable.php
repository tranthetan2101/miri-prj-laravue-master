<?php

namespace App\Http\Livewire;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class BlogsTable.
 */
class BlogsTable extends TableComponent
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
            return Blog::onlyTrashed();
        }

        return Blog::query();
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
            Column::make(__('Picture'), 'picture')
                ->view('backend.blog.includes.picture','blog'),
            Column::make(__('Slug'), 'slug'),
            Column::make(__('Create'), 'created_at')
                ->customAttribute()
                ->html(function(Blog $model) { return timezone()->convertToLocal($model->created_at, 'Y-m-d H:i');})
                ->sortable(),
            Column::make(__('Actions'))->view('backend.blog.includes.actions', 'blog'),
        ];
//        return [
//            Column::make(__('Name'))
//                ->searchable()
//                ->sortable(),
//            Column::make(__('Picture'), 'picture')->format(function(Blog $model) {
//                return view('backend.blog.includes.picture', ['blog' => $model]);
//            }),
//            Column::make(__('Slug'), 'slug'),
//            Column::make(__('Create'), 'created_at')->format(function(Blog $model) {
//                return timezone()->convertToLocal($model->created_at, 'Y-m-d H:i');
//            })->sortable(function ($builder, $direction) {
//                    return $builder->orderBy('created_at', $direction);
//                }),
//            Column::make(__('Actions'))
//                ->format(function(Blog $model) {
//                    return view('backend.blog.includes.actions', ['blog' => $model]);
//                }),
//        ];
    }
}
