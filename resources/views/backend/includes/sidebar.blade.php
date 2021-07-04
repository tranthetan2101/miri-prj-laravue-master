<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand d-lg-down-none">
        <!-- <img class="c-sidebar-brand-full" width="118" height="46" align="Miri Logo" src="{{ asset('images/miri-white.svg') }}"/>
        <img class="c-sidebar-brand-minimized" width="46" height="46" align="Miri Logo" src="{{ asset('images/miri-white.svg') }}"/>
         -->
         <h3>localhost</h3>
    </div><!--c-sidebar-brand-->

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <x-utils.link
                class="c-sidebar-nav-link"
                :href="route('admin.dashboard')"
                :active="activeClass(Route::is('admin.dashboard'), 'c-active')"
                icon="c-sidebar-nav-icon cil-speedometer"
                :text="__('Dashboard')" />
        </li>
        <li class="c-sidebar-nav-title">@lang('Tool')</li>
        <li class="c-sidebar-nav-item">
            <x-utils.link
                class="c-sidebar-nav-link"
                :href="route('admin.category.index')"
                :active="activeClass(Route::is('admin.category.*'), 'c-active')"
                icon="c-sidebar-nav-icon cil-list"
                :text="__('Categories')" />
        </li>
        <li class="c-sidebar-nav-item">
            <x-utils.link
                class="c-sidebar-nav-link"
                :href="route('admin.product.index')"
                :active="activeClass(Route::is('admin.product.*'), 'c-active')"
                icon="c-sidebar-nav-icon cil-list"
                :text="__('Products')" />
        </li>
        <li class="c-sidebar-nav-item">
            <x-utils.link
                class="c-sidebar-nav-link"
                :href="route('admin.couple_product.index')"
                :active="activeClass(Route::is('admin.couple_product.*'), 'c-active')"
                icon="c-sidebar-nav-icon cil-list"
                :text="__('Couple Products')" />
        </li>
        <li class="c-sidebar-nav-item">
            <x-utils.link
                class="c-sidebar-nav-link"
                :href="route('admin.combo.index')"
                :active="activeClass(Route::is('admin.combo.*'), 'c-active')"
                icon="c-sidebar-nav-icon cil-list"
                :text="__('Combos')" />
        </li>
        <li class="c-sidebar-nav-item">
            <x-utils.link
                class="c-sidebar-nav-link"
                :href="route('admin.order.index')"
                :active="activeClass(Route::is('admin.order.*'), 'c-active')"
                icon="c-sidebar-nav-icon cil-list"
                :text="__('Orders')" />
        </li>
        <li class="c-sidebar-nav-item">
            <x-utils.link
                class="c-sidebar-nav-link"
                :href="route('admin.coupon.index')"
                :active="activeClass(Route::is('admin.coupon.*'), 'c-active')"
                icon="c-sidebar-nav-icon cil-list"
                :text="__('Coupons')" />
        </li>
        <li class="c-sidebar-nav-item">
            <x-utils.link
                class="c-sidebar-nav-link"
                :href="route('admin.sale.index')"
                :active="activeClass(Route::is('admin.sale.*'), 'c-active')"
                icon="c-sidebar-nav-icon cil-list"
                :text="__('Sale Campaigns')" />
        </li>
        <li class="c-sidebar-nav-item">
            <x-utils.link
                class="c-sidebar-nav-link"
                :href="route('admin.delivery_fee.index')"
                :active="activeClass(Route::is('admin.delivery_fee.*'), 'c-active')"
                icon="c-sidebar-nav-icon cil-list"
                :text="__('Delivery Fees')" />
        </li>
        <li class="c-sidebar-nav-item">
            <x-utils.link
                class="c-sidebar-nav-link"
                :href="route('admin.blog.index')"
                :active="activeClass(Route::is('admin.blog.*'), 'c-active')"
                icon="c-sidebar-nav-icon cil-list"
                :text="__('Blogs')" />
        </li>
        <li class="c-sidebar-nav-item">
            <x-utils.link
                class="c-sidebar-nav-link"
                :href="route('admin.banner.index')"
                :active="activeClass(Route::is('admin.banner.*'), 'c-active')"
                icon="c-sidebar-nav-icon cil-list"
                :text="__('Banners')" />
        </li>
        <li class="c-sidebar-nav-item">
            <x-utils.link
                class="c-sidebar-nav-link"
                :href="route('admin.contact.index')"
                :active="activeClass(Route::is('admin.contact.*'), 'c-active')"
                icon="c-sidebar-nav-icon cil-list"
                :text="__('Contacts')" />
        </li>
        <li class="c-sidebar-nav-item">
            <x-utils.link
                class="c-sidebar-nav-link"
                :href="route('admin.announcement.index')"
                :active="activeClass(Route::is('admin.announcement.*'), 'c-active')"
                icon="c-sidebar-nav-icon cil-list"
                :text="__('Announcements')" />
        </li>
        <li class="c-sidebar-nav-item">
            <x-utils.link
                class="c-sidebar-nav-link"
                :href="route('admin.element.index')"
                :active="activeClass(Route::is('admin.element.*'), 'c-active')"
                icon="c-sidebar-nav-icon cil-list"
                :text="__('Thành phần tổng hợp')" />
        </li>
        <li class="c-sidebar-nav-item">
            <x-utils.link
                class="c-sidebar-nav-link"
                :href="route('admin.quiz.index')"
                :active="activeClass(Route::is('admin.quiz.*'), 'c-active')"
                icon="c-sidebar-nav-icon cil-list"
                :text="__('Góc tư vấn')" />
        </li>
        <li class="c-sidebar-nav-item">
            <x-utils.link
                class="c-sidebar-nav-link"
                :href="route('admin.receive_info.index')"
                :active="activeClass(Route::is('admin.receive_info.*'), 'c-active')"
                icon="c-sidebar-nav-icon cil-list"
                :text="__('Email đăng ký theo dõi')" />
        </li>
        @if (
            $logged_in_user->hasAllAccess() ||
            (
                $logged_in_user->can('admin.access.user.list') ||
                $logged_in_user->can('admin.access.user.deactivate') ||
                $logged_in_user->can('admin.access.user.reactivate') ||
                $logged_in_user->can('admin.access.user.clear-session') ||
                $logged_in_user->can('admin.access.user.impersonate') ||
                $logged_in_user->can('admin.access.user.change-password')
            )
        )
            <li class="c-sidebar-nav-title">@lang('System')</li>

            <li class="c-sidebar-nav-dropdown {{ activeClass(Route::is('admin.auth.user.*') || Route::is('admin.auth.role.*'), 'c-open c-show') }}">
                <x-utils.link
                    href="#"
                    icon="c-sidebar-nav-icon cil-user"
                    class="c-sidebar-nav-dropdown-toggle"
                    :text="__('Access')" />

                <ul class="c-sidebar-nav-dropdown-items">
                    @if (
                        $logged_in_user->hasAllAccess() ||
                        (
                            $logged_in_user->can('admin.access.user.list') ||
                            $logged_in_user->can('admin.access.user.deactivate') ||
                            $logged_in_user->can('admin.access.user.reactivate') ||
                            $logged_in_user->can('admin.access.user.clear-session') ||
                            $logged_in_user->can('admin.access.user.impersonate') ||
                            $logged_in_user->can('admin.access.user.change-password')
                        )
                    )
                        <li class="c-sidebar-nav-item">
                            <x-utils.link
                                :href="route('admin.auth.user.index')"
                                class="c-sidebar-nav-link"
                                :text="__('User Management')"
                                :active="activeClass(Route::is('admin.auth.user.*'), 'c-active')" />
                        </li>
                    @endif

                    @if ($logged_in_user->hasAllAccess())
                        <li class="c-sidebar-nav-item">
                            <x-utils.link
                                :href="route('admin.auth.role.index')"
                                class="c-sidebar-nav-link"
                                :text="__('Role Management')"
                                :active="activeClass(Route::is('admin.auth.role.*'), 'c-active')" />
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        @if ($logged_in_user->hasAllAccess())
            <li class="c-sidebar-nav-dropdown">
                <x-utils.link
                    href="#"
                    icon="c-sidebar-nav-icon cil-list"
                    class="c-sidebar-nav-dropdown-toggle"
                    :text="__('Logs')" />

                <ul class="c-sidebar-nav-dropdown-items">
                    <li class="c-sidebar-nav-item">
                        <x-utils.link
                            :href="route('log-viewer::dashboard')"
                            class="c-sidebar-nav-link"
                            :text="__('Dashboard')" />
                    </li>
                    <li class="c-sidebar-nav-item">
                        <x-utils.link
                            :href="route('log-viewer::logs.list')"
                            class="c-sidebar-nav-link"
                            :text="__('Logs')" />
                    </li>
                </ul>
            </li>
            <li class="c-sidebar-nav-item">
                <x-utils.link
                    class="c-sidebar-nav-link"
                    :href="route('admin.setting.index')"
                    :active="activeClass(Route::is('admin.setting.*'), 'c-active')"
                    icon="c-sidebar-nav-icon cil-list"
                    :text="__('Setting')" />
            </li>
        @endif
    </ul>

    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
</div><!--sidebar-->
