@php
    $statuses = ['đang chờ','đã thanh toán','đang vận chuyển','hoàn thành'];
    unset($statuses[$order->order_status]);
@endphp
    @if ($logged_in_user->hasAllAccess())
        <x-utils.view-button :href="route('admin.order.show', $order)" />
{{--        <x-utils.edit-button :href="route('admin.order.edit', $order)" />--}}
    @endif
    <div class="dropdown d-inline-block">
        <a class="btn btn-sm btn-secondary dropdown-toggle" id="moreMenuLink" href="#" role="button" data-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
            @lang('More')
        </a>

        <div class="dropdown-menu" aria-labelledby="moreMenuLink">
            @foreach($statuses as $k => $status)
                <x-utils.form-button
                    :action="route('admin.order.mark', [$order, $k])"
                    method="patch"
                    button-class="btn btn-primary btn-sm"
                    icon="fas fa-sync-alt"
                    name="confirm-item"
                >
                    Chuyển sang {{$status}}
                </x-utils.form-button>
            @endforeach
        </div>
    </div>

