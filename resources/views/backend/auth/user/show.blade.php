@extends('backend.layouts.app')

@section('title', __('View User'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('View User')
        </x-slot>

        <x-slot name="headerActions">
            <x-utils.link class="card-header-action" :href="route('admin.auth.user.index')" :text="__('Back')" />
        </x-slot>

        <x-slot name="body">
            <table class="table table-hover">
                <tr>
                    <th>@lang('Type')</th>
                    <td>@include('backend.auth.user.includes.type')</td>
                </tr>

                <tr>
                    <th>@lang('Avatar')</th>
                    <td><img src="{{ $user->avatar }}" class="user-profile-image" /></td>
                </tr>

                <tr>
                    <th>@lang('Name')</th>
                    <td>{{ $user->name }}</td>
                </tr>

                <tr>
                    <th>@lang('E-mail Address')</th>
                    <td>{{ $user->email }}</td>
                </tr>

                <tr>
                    <th>@lang('Status')</th>
                    <td>@include('backend.auth.user.includes.status', ['user' => $user])</td>
                </tr>

                <tr>
                    <th>@lang('Verified')</th>
                    <td>@include('backend.auth.user.includes.verified', ['user' => $user])</td>
                </tr>

                <tr>
                    <th>@lang('Timezone')</th>
                    <td>{{ $user->timezone ?? __('N/A') }}</td>
                </tr>

                <tr>
                    <th>@lang('Last Login At')</th>
                    <td>
                        @if($user->last_login_at)
                            @displayDate($user->last_login_at)
                        @else
                            @lang('N/A')
                        @endif
                    </td>
                </tr>

                <tr>
                    <th>@lang('Last Known IP Address')</th>
                    <td>{{ $user->last_login_ip ?? __('N/A') }}</td>
                </tr>

                @if ($user->isSocial())
                    <tr>
                        <th>@lang('Provider')</th>
                        <td>{{ $user->provider ?? __('N/A') }}</td>
                    </tr>

                    <tr>
                        <th>@lang('Provider ID')</th>
                        <td>{{ $user->provider_id ?? __('N/A') }}</td>
                    </tr>
                @endif

                <tr>
                    <th>@lang('labels.backend.access.users.table.roles')</th>
                    <td>{!! $user->roles_label !!}</td>
                </tr>

                <tr>
                    <th>@lang('Additional Permissions')</th>
                    <td>{!! $user->permissions_label !!}</td>
                </tr>
            </table>
            <hr/>
            <table class="table table-hover">
                <tr>
                    <th></th>
                    <td><h3>@lang('Detail')</h3></td>
                </tr>
                @if($user->customerDetail)
                    <tr>
                        <th>@lang('Sex')</th>
                        <td>{{$user->customerDetail->sex}}</td>
                    </tr>
                    <tr>
                        <th>@lang('Phone')</th>
                        <td>{{$user->customerDetail->phone_number}}</td>
                    </tr>
                    <tr>
                        <th>@lang('Addr')</th>
                        <td>{{ $user->customerDetail->addr_number.' '.$user->customerDetail->addr_street.', '.($user->customerDetail->ward ? $user->customerDetail->ward->name : '').', '.($user->customerDetail->district ? $user->customerDetail->district->name : '').', '.($user->customerDetail->city ? $user->customerDetail->city->name : '') }}</td>
                    </tr>
                    <tr>
                        <th>@lang('Birth')</th>
                        <td>{{$user->customerDetail->birth}}</td>
                    </tr>
                    <tr>
                        <th>@lang('Buy Times')</th>
                        <td>{{$user->customerDetail->buy_times}}</td>
                    </tr>
                    <tr>
                        <th>@lang('Buy Total')</th>
                        <td>{{$user->customerDetail->buy_total}}</td>
                    </tr>
                    <tr>
                        <th colspan="2"></th>
                    </tr>
                    @endif
            </table>
            <table class="table table-hover">
                <tr>
                    <th></th>
                    <td><h3>@lang('Addresses')</h3></td>
                </tr>
                @foreach($user->customerAddrs as $k => $addr)
                    <tr>
                        <th></th>
                        <th colspan="2">@lang('Address') {{$k+1}}</th>
                    </tr>
                    <tr>
                        <th>@lang('Name')</th>
                        <td>{{$addr->name}}</td>
                    </tr>
                    <tr>
                        <th>@lang('Phone')</th>
                        <td>{{$addr->phone_number}}</td>
                    </tr>
                    <tr>
                        <th>@lang('Addr')</th>
                        <td>{{ $addr->addr_number.' '.$addr->addr_street.', '.$addr->ward->name.', '.$addr->district->name.', '.$addr->city->name }}</td>
                    </tr>
                    <tr>
                        <th>@lang('Company')</th>
                        <td>{{$addr->company_name}}</td>
                    </tr>
                    <tr>
                        <th>@lang('Type')</th>
                        <td>{{$addr->deliveryAddressType}}</td>
                    </tr>
                    <tr>
                        <th>@lang('Is Default')</th>
                        <td>{{$addr->deliveryAddressDefault}}</td>
                    </tr>
                    <tr>
                        <th colspan="2"></th>
                    </tr>
                @endforeach
            </table>
        </x-slot>

        <x-slot name="footer">
            <small class="float-right text-muted">
                <strong>@lang('Account Created'):</strong> @displayDate($user->created_at) ({{ $user->created_at->diffForHumans() }}),
                <strong>@lang('Last Updated'):</strong> @displayDate($user->updated_at) ({{ $user->updated_at->diffForHumans() }})

                @if($user->trashed())
                    <strong>@lang('Account Deleted'):</strong> @displayDate($user->deleted_at) ({{ $user->deleted_at->diffForHumans() }})
                @endif
            </small>
        </x-slot>
    </x-backend.card>
@endsection
