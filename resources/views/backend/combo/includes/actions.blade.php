    @if ($logged_in_user->hasAllAccess())
        <x-utils.edit-button :href="route('admin.combo.edit', $combo)" />
    @endif

    @if ($logged_in_user->hasAllAccess())
        <x-utils.delete-button :href="route('admin.combo.delete', $combo)" />
    @endif
