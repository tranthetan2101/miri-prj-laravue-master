<?php

return [

    // All the sections for the settings page
    'sections' => [
        'app' => [
            'title' => 'Cấu hình chung',
            'descriptions' => 'Cấu hình chung ứng dụng', // (optional)
            'icon' => 'fa fa-cog', // (optional)

            'inputs' => [
                [
                    'name' => 'free_ship_min_cost', // unique key for setting
                    'type' => 'number', // type of input can be text, number, textarea, select, boolean, checkbox etc.
                    'label' => 'Miễn phí giao hàng', // label for input
                    // optional properties
                    'placeholder' => '', // placeholder for input
                    'class' => 'form-control', // override global input_class
                    'style' => '', // any inline styles
                    'rules' => 'required|min:0', // validation rules for this input
                    'value' => '500000', // any default value
                    'hint' => 'Giá trị đơn hàng tối thiểu Free ship' // help block text for input
                ],
                [
                    'name' => 'default_delivery_fee', // unique key for setting
                    'type' => 'number', // type of input can be text, number, textarea, select, boolean, checkbox etc.
                    'label' => 'Phí giao hàng mặc định', // label for input
                    // optional properties
                    'placeholder' => '', // placeholder for input
                    'class' => 'form-control', // override global input_class
                    'style' => '', // any inline styles
                    'rules' => 'required|min:0', // validation rules for this input
                    'value' => '15000', // any default value
                    'hint' => 'Phí giao hàng mặc định cho đơn hàng có địa điểm giao hàng không cài đặt trong Menu Phí vận chuyển' // help block text for input
                ],
                [
                    'type' => 'checkbox_group',
                    'label' => 'Phương thức thanh toán',
                    'name' => 'payment_methods',
                    'data_type' => 'array', // required
                    'options' => [
                        'COD', 'ATM', 'CC', 'MOMO'
                    ]
                ]
            ]
        ],
        'content' => [
            'title' => 'Nội dung',
            'descriptions' => 'Cấu hình các nội dung', // (optional)
            'icon' => 'fa fa-cog', // (optional)
            'inputs' => [
                [
                    'name' => 'home_video',
                    'type' => 'file',
                    'label' => 'Video trang chủ',
                    'hint' => 'Must be an video',
                    'rules' => 'nullable|mimes:mp4',
                    'disk' => 'public', // which disk you want to upload, default to 'public'
                    'path' => 'files', // path on the disk, default to '/',
                ],
                [
                    'name' => 'terms', // unique key for setting
                    'type' => 'ckeditor', // type of input can be text, number, textarea, select, boolean, checkbox etc.
                    'label' => 'Điều khoản sử dụng', // label for input
                    // optional properties
                    'placeholder' => '', // placeholder for input
                    'class' => 'form-control', // override global input_class
                    'style' => '', // any inline styles
                    'rules' => 'required', // validation rules for this input
                    'value' => '', // any default value
                    'hint' => '' // help block text for input
                ],
                [
                    'name' => 'privacy', // unique key for setting
                    'type' => 'ckeditor', // type of input can be text, number, textarea, select, boolean, checkbox etc.
                    'label' => 'Chính sách quyền riêng tư', // label for input
                    // optional properties
                    'placeholder' => '', // placeholder for input
                    'class' => 'form-control', // override global input_class
                    'style' => '', // any inline styles
                    'rules' => 'required', // validation rules for this input
                    'value' => '', // any default value
                    'hint' => '' // help block text for input
                ],
            ]
        ],
        'footer' => [
            'title' => 'Cấu hình Page Footer',
            'icon' => 'fa fa-cog', // (optional)
            'inputs' => [
                [
                    'name' => 'facebook', // unique key for setting
                    'type' => 'text', // type of input can be text, number, textarea, select, boolean, checkbox etc.
                    'label' => 'Facebook Link', // label for input
                    // optional properties
                    'placeholder' => '', // placeholder for input
                    'class' => 'form-control', // override global input_class
                    'style' => '', // any inline styles
                    'rules' => 'nullable|string', // validation rules for this input
                    'value' => '', // any default value
                    'hint' => '' // help block text for input
                ],
                [
                    'name' => 'youtube', // unique key for setting
                    'type' => 'text', // type of input can be text, number, textarea, select, boolean, checkbox etc.
                    'label' => 'Youtube Link', // label for input
                    // optional properties
                    'placeholder' => '', // placeholder for input
                    'class' => 'form-control', // override global input_class
                    'style' => '', // any inline styles
                    'rules' => 'nullable|string', // validation rules for this input
                    'value' => '', // any default value
                    'hint' => '' // help block text for input
                ],
                [
                    'name' => 'instagram', // unique key for setting
                    'type' => 'text', // type of input can be text, number, textarea, select, boolean, checkbox etc.
                    'label' => 'Instagram Link', // label for input
                    // optional properties
                    'placeholder' => '', // placeholder for input
                    'class' => 'form-control', // override global input_class
                    'style' => '', // any inline styles
                    'rules' => 'nullable|string', // validation rules for this input
                    'value' => '', // any default value
                    'hint' => '' // help block text for input
                ],
                [
                    'name' => 'fb_page_id', // unique key for setting
                    'type' => 'text', // type of input can be text, number, textarea, select, boolean, checkbox etc.
                    'label' => 'FB Messenger Page ID', // label for input
                    // optional properties
                    'placeholder' => '', // placeholder for input
                    'class' => 'form-control', // override global input_class
                    'style' => '', // any inline styles
                    'rules' => 'nullable|string', // validation rules for this input
                    'value' => '', // any default value
                    'hint' => '' // help block text for input
                ],
            ]
        ]
    ],

    // Setting page url, will be used for get and post request
    'url' => '/admin/setting',

    // Any middleware you want to run on above route
    'middleware' => ['is_admin'],

    // View settings
//    'setting_page_view' => 'app_settings::settings_page',
    'setting_page_view' => 'backend/setting/index',
    'flash_partial' => '',

    // Setting section class setting
    'section_class' => 'card mb-3',
    'section_heading_class' => 'card-header',
    'section_body_class' => 'card-body',

    // Input wrapper and group class setting
    'input_wrapper_class' => 'form-group',
    'input_class' => 'form-control',
    'input_error_class' => 'has-error',
    'input_invalid_class' => 'is-invalid',
    'input_hint_class' => 'form-text text-muted',
    'input_error_feedback_class' => 'text-danger',

    // Submit button
    'submit_btn_text' => 'Save Settings',
    'submit_success_message' => 'Settings has been saved.',

    // Remove any setting which declaration removed later from sections
    'remove_abandoned_settings' => false,

    // Controller to show and handle save setting
    'controller' => '\QCod\AppSettings\Controllers\AppSettingController',

    // settings group
    'setting_group' => 'default'
];
