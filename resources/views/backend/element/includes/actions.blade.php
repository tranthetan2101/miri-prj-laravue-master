    @if ($logged_in_user->hasAllAccess())
        <x-utils.edit-button :href="route('admin.element.edit', $element)" />
    @endif

    @if ($logged_in_user->hasAllAccess())
        <x-utils.delete-button :href="route('admin.element.permanently-delete', $element)" />
    @endif
