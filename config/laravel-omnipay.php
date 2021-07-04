<?php

return [
    // Cấu hình cho các cổng thanh toán tại hệ thống của bạn, các cổng không xài có thể xóa cho gọn hoặc không điền.
    // Các thông số trên có được khi bạn đăng ký tích hợp.

    'gateways' => [
        'MoMoAIO' => [
            'driver' => 'MoMo_AllInOne',
            'options' => [
                'accessKey' => '87HstHBA41QTj5i3',
                'secretKey' => 'nx6xNvfegZpPNqiqGfnyGosYbf7Kt05o',
                'partnerCode' => 'MOMOT87620201012',
                'testMode' => true,
            ],
        ],
        'OnePayDomestic' => [
            'driver' => 'OnePay_Domestic',
            'options' => [
                'vpcMerchant' => 'TESTONEPAY',
                'vpcAccessCode' => '6BEB2546',
                'vpcUser' => '',
                'vpcPassword' => '',
                'vpcHashKey' => '6D0870CDE5F24F34F3915FB0045120DB',
                'testMode' => true,
            ],
        ],
        'OnePayInternational' => [
            'driver' => 'OnePay_International',
            'options' => [
                'vpcMerchant' => 'TESTONEPAY',
                'vpcAccessCode' => '6BEB2546',
                'vpcUser' => '',
                'vpcPassword' => '',
                'vpcHashKey' => '6D0870CDE5F24F34F3915FB0045120DB',
                'testMode' => true,
            ],
        ],
    ],
];
