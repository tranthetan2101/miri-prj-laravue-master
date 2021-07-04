<x-utils.link
    class="c-subheader-nav-link"
    :href="route('admin.order.pending')"
    :text="__('Pending Orders')" />
<x-utils.link
    class="c-subheader-nav-link"
    :href="route('admin.order.paid')"
    :text="__('Paid Orders')" />
<x-utils.link
    class="c-subheader-nav-link"
    :href="route('admin.order.shipping')"
    :text="__('Shipping Orders')" />
<x-utils.link
    class="c-subheader-nav-link"
    :href="route('admin.order.completed')"
    :text="__('Completed Orders')" />

