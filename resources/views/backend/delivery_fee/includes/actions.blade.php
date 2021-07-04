    @if ($logged_in_user->hasAllAccess())
        <x-utils.edit-button :href="route('admin.delivery_fee.edit', $delivery_fee)" />
    @endif



    @if ($logged_in_user->hasAllAccess())
        <x-utils.delete-button
            :href="route('admin.delivery_fee.permanently-delete', $delivery_fee)"
            :text="__('Delete')" />
    @endif
