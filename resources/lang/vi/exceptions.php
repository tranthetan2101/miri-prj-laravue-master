<?php
return [
    "backend" => [
        "access" => [
            "roles" => [
                "already_exists" => "Vai trò này đã tồn tại. Hãy chọn một tên khác.",
                "cant_delete_admin" => "Bạn không thể xóa vai trò quản trị viên.",
                "create_error" => "Đã xảy ra sự cố khi tạo vai trò. Hãy thử lại.",
                "delete_error" => "Đã xảy ra sự cố khi xóa vai trò. Hãy thử lại.",
                "has_users" => "Bạn không thể xóa vai trò với những người dùng đã được liên kết.",
                "needs_permission" => "Bạn phải chọn ít nhất một quyền cho vai trò này.",
                "not_found" => "Vai trò không tồn tại.",
                "update_error" => "Đã xảy ra sự cố khi cập nhật vai trò. Hãy thử lại."
            ],
            "users" => [
                "already_confirmed" => "Người dùng đã được xác nhận.",
                "cant_confirm" => "Đã xảy ra sự cố khi xác nhận tài khoản người dùng.",
                "cant_deactivate_self" => "Bạn không thể làm điều này với chính mình.",
                "cant_delete_admin" => "Bạn không thể xóa quản trị viên.",
                "cant_delete_own_session" => "You can not delete your own session.",
                "cant_delete_self" => "Bạn không thể xóa chính mình.",
                "cant_restore" => "Người dùng chưa được xóa nên không thể khôi phục.",
                "cant_unconfirm_admin" => "Bạn không thể hủy xác nhận quản trị viên.",
                "cant_unconfirm_self" => "Bạn không thể hủy xác nhận chính mình.",
                "create_error" => "Đã xảy ra sự cố khi tạo người dùng. Hãy thử lại.",
                "delete_error" => "Đã xảy ra sự cố khi xóa người dùng. Hãy thử lại.",
                "delete_first" => "Người dùng này phải bị xóa trước khi có thể bị hủy vĩnh viễn.",
                "email_error" => "Địa chỉ email này thuộc về một người dùng khác.",
                "mark_error" => "Đã xảy ra sự cố khi cập nhật người dùng. Hãy thử lại.",
                "not_confirmed" => "Người dùng này chưa được xác nhận.",
                "not_found" => "Người dùng này không tồn tại.",
                "restore_error" => "Đã xảy ra sự cố khi khôi phục người dùng. Hãy thử lại.",
                "role_needed" => "Bạn phải chọn ít nhất một vai trò.",
                "role_needed_create" => "Bạn phải chọn ít nhất một vai trò.",
                "social_delete_error" => "Đã xảy ra sự cố khi xóa tài khoản mạng xã hội khỏi người dùng này.",
                "update_error" => "Đã xảy ra lỗi khi cập nhật người dùng. Hãy thử lại.",
                "update_password_error" => "Đã xảy ra sự cố khi thay đổi mật khẩu người dùng. Hãy thử lại."
            ]
        ]
    ],
    "frontend" => [
        "auth" => [
            "confirmation" => [
                "already_confirmed" => "Tài khoản của bạn đã được xác nhận.",
                "confirm" => "Xác nhận tài khoản của bạn!",
                "created_confirm" => "Tài khoản của bạn đã được tạo thành công. Chúng tôi đã gửi một email để xác nhận tài khoản của bạn.",
                "created_pending" => "Tài khoản của bạn đã được tạo thành công và đang chờ được phê duyệt. Một email sẽ được gửi đến bạn khi tài khoản của bạn được duyệt.",
                "mismatch" => "Mã xác nhận của bạn không đúng.",
                "not_found" => "Mã xác nhận này không tồn tại.",
                "pending" => "Tài khoản của bạn hiện đang chờ được phê duyệt.",
                "resend" => "Tài khoản của bạn chưa được xác nhận. Hãy nhấn vào liên kết xác nhận trong email của bạn, hoặc <a href=\":url\">Nhấn vào đây</a> để gửi lại email xác nhận.",
                "resent" => "Một email xác nhận đã được gửi đến địa chỉ email trong hồ sơ của bạn.",
                "success" => "Tài khoản của bạn đã được xác nhận thành công!"
            ],
            "deactivated" => "Tài khoản của bạn đã ngừng hoạt động.",
            "email_taken" => "Địa chỉ email đã được sử dụng.",
            "password" => [
                "change_mismatch" => "Đây không phải là mật khẩu cũ của bạn.",
                "reset_problem" => "Đã xảy ra sự cố khi đặt lại mật khẩu. Hãy gửi lại yêu cầu đặt lại mật khẩu."
            ],
            "registration_disabled" => "Đăng ký hiện đã đóng."
        ]
    ]
];
