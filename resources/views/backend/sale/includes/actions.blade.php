@if ($sale->trashed() && $logged_in_user->hasAllAccess())
    <x-utils.form-button
        :action="route('admin.sale.restore', $sale)"
        method="patch"
        button-class="btn btn-info btn-sm"
        icon="fas fa-sync-alt"
        name="confirm-item"
    >
        @lang('Restore')
    </x-utils.form-button>

    @if (config('boilerplate.access.user.permanently_delete'))
        <x-utils.delete-button
            :href="route('admin.sale.permanently-delete', $sale)"
            :text="__('Permanently Delete')" />
    @endif
@else
    @if ($logged_in_user->hasAllAccess())
        <x-utils.edit-button :href="route('admin.sale.edit', $sale)" />
    @endif

    @if ($logged_in_user->hasAllAccess())
        <x-utils.delete-button :href="route('admin.sale.delete', $sale)" />
    @endif

@endif
