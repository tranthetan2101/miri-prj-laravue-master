@if ($theAnnouncement->enabled)
    <span class="badge badge-success">@lang('Enabled')</span>
@else
    <span class="badge badge-danger">@lang('Disabled')</span>
@endif
