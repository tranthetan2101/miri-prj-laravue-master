    @if ($logged_in_user->hasAllAccess())
        <x-utils.edit-button :href="route('admin.coupon.edit', $coupon)" />
    @endif



    @if ($logged_in_user->hasAllAccess())
        <x-utils.delete-button
            :href="route('admin.coupon.permanently-delete', $coupon)"
            :text="__('Delete')" />
    @endif
