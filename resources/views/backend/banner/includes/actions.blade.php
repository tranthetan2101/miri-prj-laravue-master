    @if ($logged_in_user->hasAllAccess())
        <x-utils.edit-button :href="route('admin.banner.edit', $banner)" />
    @endif



    @if ($logged_in_user->hasAllAccess())
        <x-utils.delete-button
            :href="route('admin.banner.permanently-delete', $banner)"
            :text="__('Delete')" />
    @endif
