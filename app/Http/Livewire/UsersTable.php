<?php

namespace App\Http\Livewire;

use App\Domains\Auth\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
//use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;

/**
 * Class UsersTable.
 */
class UsersTable extends TableComponent
{
//    use HtmlComponents;

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
        $query = User::with('roles', 'twoFactorAuth')
            ->withCount('twoFactorAuth');

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
            Column::make(__('Type'))
                ->view('backend.auth.user.includes.type', 'user')
                ->sortable(),
            Column::make(__('Name'), 'name')
                ->searchable()
                ->sortable(),
            Column::make(__('E-mail'), 'email')
                ->searchable()
                ->sortable(),
            Column::make(__('Verified'))
                ->view('backend.auth.user.includes.verified', 'user')
                ->sortable(function ($builder, $direction) {
                    return $builder->orderBy('email_verified_at', $direction);
                }),
            Column::make(__('2FA'))
                ->view('backend.auth.user.includes.2fa', 'user')
                ->sortable(function ($builder, $direction) {
                    return $builder->orderBy('two_factor_auth_count', $direction);
                }),
            Column::make(__('labels.backend.access.users.table.roles'), 'roles_label')
                ->customAttribute()
                ->html()
                ->searchable(function ($builder, $term) {
                    return $builder->orWhereHas('roles', function ($query) use ($term) {
                        return $query->where('name', 'like', '%'.$term.'%');
                    });
                }),
            Column::make(__('Additional Permissions'), 'permissions_label')
                ->customAttribute()
                ->html()
                ->searchable(function ($builder, $term) {
                    return $builder->orWhereHas('permissions', function ($query) use ($term) {
                        return $query->where('name', 'like', '%'.$term.'%');
                    });
                }),
            Column::make(__('Actions'))
                ->view('backend.auth.user.includes.actions', 'user'),
        ];
//        return [
//            Column::make(__('Type'))
//                ->format(function(User $model) {
//                    return view('backend.auth.user.includes.type', ['user' => $model]);
//                })
//                ->sortable(),
//            Column::make(__('Name'))
//                ->searchable()
//                ->sortable(),
//            Column::make(__('E-mail'), 'email')
//                ->searchable()
//                ->sortable(),
//            Column::make(__('Verified'))
//                ->format(function(User $model) {
//                    return view('backend.auth.user.includes.verified', ['user' => $model]);
//                })
//                ->sortable(function ($builder, $direction) {
//                    return $builder->orderBy('email_verified_at', $direction);
//                }),
//            Column::make(__('2FA'))
//                ->format(function(User $model) {
//                    return view('backend.auth.user.includes.2fa', ['user' => $model]);
//                })
//                ->sortable(function ($builder, $direction) {
//                    return $builder->orderBy('two_factor_auth_count', $direction);
//                }),
//            Column::make(__('labels.backend.access.users.table.roles'), 'roles_label')
//                ->format(function(User $model) {
//                    return $this->html($model->roles_label);
//                })
//                ->searchable(function ($builder, $term) {
//                    return $builder->orWhereHas('roles', function ($query) use ($term) {
//                        return $query->where('name', 'like', '%'.$term.'%');
//                    });
//                }),
//            Column::make(__('Additional Permissions'), 'permissions_label')
//                ->format(function(User $model) {
//                    return $this->html($model->permissions_label);
//                })
//                ->searchable(function ($builder, $term) {
//                    return $builder->orWhereHas('permissions', function ($query) use ($term) {
//                        return $query->where('name', 'like', '%'.$term.'%');
//                    });
//                }),
//            Column::make(__('Actions'))
//                ->format(function(User $model) {
//                    return view('backend.auth.user.includes.actions', ['user' => $model]);
//                }),
//        ];
    }
}
