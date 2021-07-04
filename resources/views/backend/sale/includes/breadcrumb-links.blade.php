@if ($logged_in_user->hasAllAccess())
    <x-utils.link class="c-subheader-nav-link" :href="route('admin.sale.deleted')" :text="__('Deleted Sales')" />
@endif
