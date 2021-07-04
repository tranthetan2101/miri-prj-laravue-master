@if ($coupon->used_num_unlimited)
    <span class="badge badge-success">@lang('Yes')</span>
@else
    <span class="badge badge-danger">@lang('No')</span>
@endif
