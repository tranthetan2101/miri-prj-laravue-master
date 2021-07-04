<?php
return [
    "backend" => [
        "access" => [
            "users" => [
                "delete_user_confirm" => "Bạn có chắc chắn muốn xóa vĩnh viễn người dùng này? Bất kỳ nơi nào trong ứng dụng tham chiếu đến ID của người dùng này rất có thể sẽ bị lỗi. Điều này sẽ gây rủi ro và không thể hoàn tác.",
                "if_confirmed_off" => "(Nếu xác nhận tắt)",
                "no_deactivated" => "Không có người dùng không hoạt động.",
                "no_deleted" => "Không có người dùng đã xóa.",
                "restore_user_confirm" => "Khôi phục người dùng này về trạng thái ban đầu?"
            ]
        ],
        "dashboard" => ["title" => "Bảng điều khiển", "welcome" => "Chào mừng"],
        "general" => [
            "all_rights_reserved" => "All Rights Reserved.",
            "are_you_sure" => "Bạn có chắc chắn muốn thực hiện việc này?",
            "boilerplate_link" => "Laravel Boilerplate",
            "continue" => "Tiếp tục",
            "member_since" => "Là thành viên kể từ",
            "minutes" => " phút",
            "search_placeholder" => "Tìm kiếm...",
            "see_all" => [
                "messages" => "Xem tất cả tin nhắn",
                "notifications" => "Xem tất cả",
                "tasks" => "Xem tất cả các công việc"
            ],
            "status" => ["offline" => "Không trực tuyến", "online" => "Trực tuyến"],
            "timeout" => "Bạn đã tự động đăng xuất vì lý do bảo mật do bạn không có hoạt động nào trong ",
            "you_have" => [
                "messages" => "{0} Bạn không có tin nhắn nào|{1} Bạn có 1 tin nhắn|[2,Inf] Bạn có :number tin nhắn",
                "notifications" => "{0} Bạn không có thông báo nào|{1} Bạn có 1 thông báo|[2,Inf] Bạn có :number thông báo",
                "tasks" => "{0} Bạn không có công việc nào|{1} Bạn có 1 công việc|[2,Inf] Bạn có :number công việc"
            ]
        ],
        "search" => [
            "empty" => "Hãy nhập thông tin để tìm kiếm.",
            "incomplete" => "Bạn phải nhập thông tin có nghĩa.",
            "results" => "Hiển thị kết quả cho :query",
            "title" => "Kết quả tìm kiếm"
        ],
        "welcome" => "Chào mừng đến với Bảng điều khiển"
    ],
    "emails" => [
        "auth" => [
            "account_confirmed" => "Tài khoản của bạn đã được xác nhận.",
            "click_to_confirm" => "Nhấn vào đây để xác nhận tài khoản của bạn:",
            "error" => "Rất tiếc!",
            "greeting" => "Xin chào!",
            "password_cause_of_email" => "Bạn nhận được email này vì chúng tôi nhận được yêu cầu đặt lại mật khẩu cho tài khoản của bạn.",
            "password_if_not_requested" => "Nếu bạn không yêu cầu đặt lại mật khẩu, bạn không cần thực hiện thêm hành động nào khác.",
            "password_reset_subject" => "Đặt lại mật khẩu",
            "regards" => "Trân trọng,",
            "reset_password" => "Nhấn vào đây để đặt lại mật khẩu",
            "thank_you_for_using_app" => "Cảm ơn bạn vì đã sử dụng dịch vụ của chúng tôi!",
            "trouble_clicking_button" => "Nếu bạn không thể nhấn vào \":action_text\" nút này, sao chép và dán liên kết bên dưới vào trình duyệt web của bạn:"
        ],
        "contact" => [
            "email_body_title" => "Bạn có một yêu cầu gửi mẫu thông tin liên hệ mới: Chi tiết ở bên dưới:",
            "subject" => "Mẫu gửi thông tin liên hệ mới của :app_name !"
        ]
    ],
    "frontend" => [
        "general" => ["joined" => "Đã tham gia"],
        "test" => "Kiểm tra",
        "tests" => [
            "based_on" => ["permission" => "Quyền dựa trên - ", "role" => "Vai trò dựa trên - "],
            "js_injected_from_controller" => "Javascript Injected from a Controller",
            "using_access_helper" => [
                "array_permissions" => "Using Access Helper with Array of Permission Names or ID's where the user does have to possess all.",
                "array_permissions_not" => "Using Access Helper with Array of Permission Names or ID's where the user does not have to possess all.",
                "array_roles" => "Using Access Helper with Array of Role Names or ID's where the user does have to possess all.",
                "array_roles_not" => "Using Access Helper with Array of Role Names or ID's where the user does not have to possess all.",
                "permission_id" => "Using Access Helper with Permission ID",
                "permission_name" => "Using Access Helper with Permission Name",
                "role_id" => "Using Access Helper with Role ID",
                "role_name" => "Using Access Helper with Role Name"
            ],
            "using_blade_extensions" => "Using Blade Extensions",
            "view_console_it_works" => "View console, you should see 'it works!' which is coming from FrontendController@index",
            "you_can_see_because" => "Bạn có thể nhìn thấy điều này vì bạn có vai trò của ':role'!",
            "you_can_see_because_permission" => "Bạn có thể nhìn thấy điều này vì bạn có quyền của ':permission'!"
        ],
        "user" => [
            "change_email_notice" => "Nếu bạn thay đổi email, bạn sẽ bị đăng xuất cho đến khi bạn xác nhận địa chỉ email mới.",
            "email_changed_notice" => "Bạn phải xác nhận địa chỉ email mới trước khi bạn có thể đăng nhập lại.",
            "password_updated" => "Mật khẩu được cập nhật thành công.",
            "profile_updated" => "Hồ sơ được cập nhật thành công."
        ],
        "welcome_to" => "Chào mừng đến với :place"
    ]
];
