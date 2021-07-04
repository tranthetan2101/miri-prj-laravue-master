@if ($category->trashed() && $logged_in_user->hasAllAccess())
    <x-utils.form-button
        :action="route('admin.category.restore', $category)"
        method="patch"
        button-class="btn btn-info btn-sm"
        icon="fas fa-sync-alt"
        name="confirm-item"
    >
        @lang('Restore')
    </x-utils.form-button>

    @if (config('boilerplate.access.user.permanently_delete'))
        <x-utils.delete-button
            :href="route('admin.category.permanently-delete', $category)"
            :text="__('Permanently Delete')" />
    @endif
@else
    @if ($logged_in_user->hasAllAccess())
        <x-utils.edit-button :href="route('admin.category.edit', $category)" />
    @endif
    <div class="dropdown d-inline-block">
        <a class="btn btn-sm btn-secondary dropdown-toggle" id="moreMenuLink" href="#" role="button" data-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
            @lang('More')
        </a>

        <div class="dropdown-menu" aria-labelledby="moreMenuLink">
            @if (! $category->visible)
                <x-utils.form-button
                    :action="route('admin.category.mark', [$category, 1])"
                    method="patch"
                    button-class="btn btn-primary btn-sm"
                    icon="fas fa-sync-alt"
                    name="confirm-item"
                >
                    @lang('Reactivate')
                </x-utils.form-button>
            @else
                <x-utils.form-button
                    :action="route('admin.category.mark', [$category, 0])"
                    method="patch"
                    name="confirm-item"
                    button-class="dropdown-item"
                >
                    @lang('Deactivate')
                </x-utils.form-button>
            @endif
        </div>
    </div>


    @if ($logged_in_user->hasAllAccess())
        <x-utils.delete-button :href="route('admin.category.delete', $category)" />
    @endif

@endif
