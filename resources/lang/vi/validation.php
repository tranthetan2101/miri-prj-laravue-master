<?php
return [
    "accepted" => " :attribute phải được chấp nhận.",
    "active_url" => " :attribute không phải liên kết hợp lệ.",
    "after" => " :attribute phải sau ngày :date.",
    "after_or_equal" => " :attribute phải sau hoặc là ngày :date.",
    "alpha" => " :attribute chỉ có thể chức các chữ cái.",
    "alpha_dash" => " :attribute chỉ có thể chứa các chữ cái, số, dấu gạch ngang và dấu gạch dưới.",
    "alpha_num" => " :attribute chỉ có thể chứa các chữ cái và số.",
    "array" => " :attribute phải là một dãy số.",
    "before" => " :attribute phải trước ngày :date.",
    "before_or_equal" => " :attribute phải trước hoặc là ngày :date.",
    "between" => [
        "array" => " :attribute phải có số lượng từ :min đến :max .",
        "file" => " :attribute phải từ :min đến :max kilobytes.",
        "numeric" => " :attribute phải từ :min đến :max.",
        "string" => " :attribute phải từ :min đến :max kí tự."
    ],
    "boolean" => "The :attribute field must be true or false.",
    "confirmed" => " :attribute không hợp lệ.",
    "custom" => ["attribute-name" => ["rule-name" => "custom-message"]],
    "date" => " :attribute không phù hợp.",
    "date_equals" => " :attribute phải là ngày :date.",
    "date_format" => " :attribute không đúng định dạng :format.",
    "different" => " :attribute và :other phải khác nhau.",
    "digits" => " :attribute phải là :digits chữ số.",
    "digits_between" => " :attribute phải từ :min đến :max chữ số.",
    "dimensions" => " :attribute có kích thước hình ảnh không hợp lệ.",
    "distinct" => " :attribute có giá trị bị trùng.",
    "email" => " :attribute phải là địa chỉ email hợp lệ.",
    "ends_with" => " :attribute phải kết thúc bằng một trong những điều sau: :values.",
    "exists" => " :attribute được chọn không hợp lệ.",
    "file" => " :attribute phải là một tệp tin.",
    "filled" => " :attribute phải là một giá trị.",
    "gt" => [
        "array" => " :attribute phải có số lượng nhiều hơn :value.",
        "file" => " :attribute phải lớn hơn :value kilobytes.",
        "numeric" => " :attribute phải lớn hơn :value.",
        "string" => " :attribute phải lớn hơn :value kí tự."
    ],
    "gte" => [
        "array" => " :attribute phải có số lượng là :value hoặc nhiều hơn.",
        "file" => " :attribute phải lớn hơn hoặc bằng :value kilobytes.",
        "numeric" => " :attribute phải lớn hơn hoặc bằng :value.",
        "string" => " :attribute phải lớn hơn hoặc bằng :value kí tự."
    ],
    "image" => " :attribute phải là một hình ảnh.",
    "in" => " :attribute được chọn không hợp lệ.",
    "in_array" => " :attribute không tồn tại trong :other.",
    "integer" => " :attribute phải là số nguyên.",
    "ip" => " :attribute phải là địa chỉ IP hợp lệ.",
    "ipv4" => " :attribute phải là địa chỉ IPv4 hợp lệ.",
    "ipv6" => " :attribute phải là địa chỉ IPv6 hợp lệ.",
    "json" => " :attribute phải là chuỗi JSON hợp lệ.",
    "lt" => [
        "array" => " :attribute phải có số lượng nhỏ hơn :value.",
        "file" => " :attribute phải nhỏ hơn :value kilobytes.",
        "numeric" => " :attribute phải nhỏ hơn :value.",
        "string" => " :attribute phải nhỏ hơn :value kí tự."
    ],
    "lte" => [
        "array" => " :attribute phải có số lượng nhiều hơn :value.",
        "file" => " :attribute phải nhỏ hơn hoặc bằng :value kilobytes.",
        "numeric" => " :attribute phải nhỏ hơn hoặc bằng :value.",
        "string" => " :attribute phải nhỏ hơn hoặc bằng :value kí tự."
    ],
    "max" => [
        "array" => " :attribute có số lượng không nhiều hơn :max.",
        "file" => " :attribute không nhiều hơn :max kilobytes.",
        "numeric" => " :attribute không nhiều hơn :max.",
        "string" => " :attribute không nhiều hơn :max kí tự."
    ],
    "mimes" => " :attribute phải là tệp tin loại: :values.",
    "mimetypes" => " :attribute phải là tệp tin loại: :values.",
    "min" => [
        "array" => " :attribute phải có số lượng ít nhất :min.",
        "file" => " :attribute phải ít nhất :min kilobytes.",
        "numeric" => " :attribute phải ít nhất :min.",
        "string" => " :attribute phải ít nhất :min kí tự."
    ],
    "not_in" => " :attribute được chọn không hợp lệ.",
    "not_regex" => " :attribute định dạng không hợp lệ.",
    "numeric" => " :attribute phải là chữ số.",
    "password" => "Mật khẩu không chính xác.",
    "present" => " :attribute phải là hiện tại.",
    "regex" => " :attribute định dạng không hợp lệ.",
    "required" => " :attribute là bắt buộc.",
    "required_if" => " :attribute là bắt buộc khi :other là :value.",
    "required_unless" => " :attribute là bắt buộc nếu :other không là :values.",
    "required_with" => " :attribute là bắt buộc khi :values là hiện tại.",
    "required_with_all" => " :attribute là bắt buộc khi :values là hiện tại.",
    "required_without" => " :attribute là bắt buộc khi :values không là hiện tại.",
    "required_without_all" => " :attribute là bắt buộc khi không giá trị nào của :values là hiện tại.",
    "same" => " :attribute và :other không trùng khớp.",
    "size" => [
        "array" => " :attribute phải là :size.",
        "file" => " :attribute phải là :size kilobytes.",
        "numeric" => " :attribute phải là :size.",
        "string" => " :attribute phải là :size kí tự."
    ],
    "starts_with" => " :attribute phải bắt đầu bằng một trong những: :values.",
    "string" => " :attribute phải là một chuỗi.",
    "timezone" => " :attribute phải là múi giờ hợp lệ.",
    "unique" => " :attribute đã được sử dụng.",
    "uploaded" => " :attribute tải lên thất bại.",
    "url" => " :attribute định dạng không hợp lệ.",
    "uuid" => " :attribute phải là UUID hợp lệ.",
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        "period_end" => "Kết thúc"
    ],
];
