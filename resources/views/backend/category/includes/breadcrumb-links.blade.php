<x-utils.link
    class="c-subheader-nav-link"
    :href="route('admin.category.deactivated')"
    :text="__('Deactivated Categories')" />

@if ($logged_in_user->hasAllAccess())
    <x-utils.link class="c-subheader-nav-link" :href="route('admin.category.deleted')" :text="__('Deleted Categories')" />
@endif
