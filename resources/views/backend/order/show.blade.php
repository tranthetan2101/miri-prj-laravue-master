@extends('backend.layouts.app')

@section('title', __('View Order'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('View Order')
        </x-slot>

        <x-slot name="headerActions">
            <x-utils.link class="card-header-action" :href="route('admin.order.index')" :text="__('Back')" />
        </x-slot>

        <x-slot name="body">
            <table class="table table-hover">
                <tr>
                    <th>@lang('#')</th>
                    <td>{{$order->order_key}}</td>
                </tr>
                <tr>
                    <th>@lang('Transaction ID')</th>
                    <td>{{$order->transaction_id}}</td>
                </tr>
                <tr>
                    <th>@lang('User')</th>
                    <td>@if($order->user)
                            {{$order->user->email}}
                        @else
                            @lang('N/A')
                        @endif</td>
                </tr>
                <tr>
                    <th>@lang('Name')</th>
                    <td>{{ $order->name }}</td>
                </tr>

                <tr>
                    <th>@lang('E-mail Address')</th>
                    <td>{{ $order->email }}</td>
                </tr>

                <tr>
                    <th>@lang('Phone')</th>
                    <td>{{ $order->phone_number }}</td>
                </tr>

                <tr>
                    <th>@lang('Receiver Phone')</th>
                    <td>{{ $order->receive_phone_number }}</td>
                </tr>

                <tr>
                    <th>@lang('Shipping Address')</th>
                    <td>{{ $order->addr_number.' '.$order->addr_street.', '.$order->ward->name.', '.$order->district->name.', '.$order->city->name }}</td>
                </tr>

                <tr>
                    <th>@lang('Note')</th>
                    <td>{{ $order->note }}</td>
                </tr>

                <tr>
                    <th>@lang('Payment Method')</th>
                    <td>{{ $order->payment_type }}</td>
                </tr>

                <tr>
                    <th>@lang('Subtotal')</th>
                    <td>{{ $order->subtotal }}</td>
                </tr>

                <tr>
                    <th>@lang('Total')</th>
                    <td>{{ $order->total }}</td>
                </tr>

                <tr>
                    <th>@lang('Discount')</th>
                    <td>{{ $order->discount }}</td>
                </tr>

                <tr>
                    <th>@lang('Coupon')</th>
                    <td>{{ $order->coupon_code }}</td>
                </tr>

                <tr>
                    <th>@lang('Delivery Fee')</th>
                    <td>{{ $order->delivery_fee }}</td>
                </tr>

                <tr>
                    <th>@lang('Order Date')</th>
                    <td>
                        @if($order->order_date)
                            @displayDate($order->order_date)
                        @else
                            @lang('N/A')
                        @endif
                    </td>
                </tr>

                <tr>
                    <th>@lang('Payment Date')</th>
                    <td>
                        @if($order->payment_date)
                            @displayDate($order->payment_date)
                        @else
                            @lang('N/A')
                        @endif
                    </td>
                </tr>

                <tr>
                    <th>@lang('Status')</th>
                    <td><span class="badge badge-success">{{ $order->status }}</span></td>
                </tr>

            </table>
            <hr/>
            <table class="table table-hover">
                <tr>
                    <th></th>
                    <td><h3>@lang('Detail')</h3></td>
                </tr>
                @foreach($order->detail as $k => $detail)
                    <tr>
                        <th></th>
                        <th colspan="2">@lang('Item') {{$k+1}}</th>
                    </tr>
                <tr>
                    <th>@lang('Product')</th>
                    <td>{{$detail->product_name}}</td>
                </tr>
                    <tr>
                        <th>@lang('Category')</th>
                        <td>{{$detail->cate_name}}</td>
                    </tr>
                    <tr>
                        <th>@lang('Quantity')</th>
                        <td>{{$detail->quantity}}</td>
                    </tr>
                    <tr>
                        <th>@lang('Price')</th>
                        <td>{{$detail->price}}</td>
                    </tr>
                    <tr>
                        <th>@lang('Price 2')</th>
                        <td>{{$detail->price2}}</td>
                    </tr>
                    <tr>
                        <th colspan="2"></th>
                    </tr>
                @endforeach
            </table>
        </x-slot>


    </x-backend.card>
@endsection
