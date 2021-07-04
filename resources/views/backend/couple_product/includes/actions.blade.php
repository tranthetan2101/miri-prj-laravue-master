    @if ($logged_in_user->hasAllAccess())
        <x-utils.edit-button :href="route('admin.couple_product.edit', $couple_product)" />
    @endif



    @if ($logged_in_user->hasAllAccess())
        <x-utils.delete-button
            :href="route('admin.couple_product.permanently-delete', $couple_product)"
            :text="__('Delete')" />
    @endif
