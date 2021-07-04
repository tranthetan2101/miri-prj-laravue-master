@if ($logged_in_user->hasAllAccess())
    <x-utils.link class="c-subheader-nav-link" :text="__('Settings')" />
@endif
