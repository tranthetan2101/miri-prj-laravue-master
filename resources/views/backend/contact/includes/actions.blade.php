    @if ($logged_in_user->hasAllAccess())
        <x-utils.edit-button :href="route('admin.contact.edit', $contact)" />
    @endif



    @if ($logged_in_user->hasAllAccess())
        <x-utils.delete-button
            :href="route('admin.contact.permanently-delete', $contact)"
            :text="__('Delete')" />
    @endif
