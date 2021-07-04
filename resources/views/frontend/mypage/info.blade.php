<div id="user-info" class="tab-content-inner-order @if($errors->has('errorInfo') || old('mode') == 'info') current @endif" data-id="{{$user->id ?? ''}}">
    <h2>Thông tin cá nhân</h2>
    @if($errors->has('errorInfo'))
    <h4 style="color:red">{{$errors->first()}}</h4>
    @endif
    <ul class="confirm-info">
        <li>
            <p class="confirm-info-title">Họ và tên</p>
            <p class="confirm confirm-user name"><span name="name">{{ Auth::user()->name }}</span><a onclick="changeinfo('name')">Chỉnh sửa</a></p>
            <form id='name-change-info' method='get' action='' class='open-additional' style='margin-bottom: 45px; margin-top: 0px !important; display:none;'>
                <div class='input-info'>
                    <input type='text' name='name' value='{{ Auth::user()->name }}'>
                    <div class='button-group' style='margin-top: 0px !important;'>
                        <a class='cancel-change-info' href='javascript:;'>HỦY</a>
                        <button type='submit' class='common-button name-change-info'>LƯU ĐỊA CHỈ NÀY</button>
                    </div>
                </div>
            </form>
        </li>
        <li>
            <p class="confirm-info-title">E-mail của bạn</p>
            <p class="confirm confirm-email email"><span name="email">{{ Auth::user()->email }}</span><a onclick="changeinfo('email')">Chỉnh sửa</a></p>
            <form id='email-change-info' method='get' action='' class='open-additional' style='margin-bottom: 45px; margin-top: 0px !important; display:none;'>
                <div class='input-info'>
                    <input type='email' name='email' value='{{ Auth::user()->email }}'>
                    <div class='button-group' style='margin-top: 0px !important;'>
                        <a class='cancel-change-info' href='javascript:;'>HỦY</a>
                        <button type='submit' class='common-button email-change-info'>LƯU EMAIL NÀY</button>
                    </div>
                </div>
            </form>
        </li>
        <li>
            <p class="confirm-info-title">Số điện thoại</p>
            <p class="confirm confirm-phone phone_number"><span name="phone_number">{{$user->phone_number ?? ''}}</span><a onclick="changeinfo('phone_number')">Chỉnh sửa</a></p>
            <form id='phone_number-change-info' method='get' action='' class='open-additional' style='margin-bottom: 45px; margin-top: 0px !important; display:none;'>
                <div class='input-info'>
                    <input type='number' name='phone_number' value='{{$user->phone_number ?? ""}}'>
                    <div class='button-group' style='margin-top: 0px !important;'>
                        <a class='cancel-change-info' href='javascript:;'>HỦY</a>
                        <button type='submit' class='common-button phone_number-change-info'>LƯU SỐ ĐIỆN THOẠI NÀY</button>
                    </div>
                </div>
            </form>
        </li>
        <li>
            <p class="confirm-info-title">Địa chỉ</p>
            <p class="confirm confirm-local addr"><span name="addr">
                    {{ $user->addr_number ?? "" }}
                    {{ ucwords($user->addr_street ?? "") }}
                    {{ $user->ward->type ?? "" }} {{ $user->ward->name ?? "" }}
                    {{ $user->district->type ?? "" }} {{ $user->district->name ?? "" }}
                    {{ $user->city->type ?? "" }} {{ $user->city->name ?? "" }}
                </span>
                <a onclick="changeAddr()">Chỉnh sửa</a></p>
            <form action="{{route('frontend.mypage.updateInfo')}}" class="open-additional" style="display:none;margin-bottom: 45px; margin-top: 0px !important;" id='addr-change-info' method="post">
                @csrf
                <div class="input-info">
                    <input type="hidden" name="id" value="{{$user->id ?? ''}}">
                    <input type="hidden" name="mode" value="info">
                    <input type="text" name="addr_number" placeholder="Số nhà" value='{{ $user->addr_number ?? "" }}'>
                    <input type="text" name="addr_street" placeholder="Địa chỉ" value='{{ $user->addr_street ?? "" }}'>
                    <div class="select2">
                        {{ html()->select('city_id')
                                ->attribute('data-type', 'city')
                                ->attribute('data-placeholder', 'Tỉnh/Thành phố')
                                ->options([$user->city->id ?? '' => $user->city->name ?? ''] ?? '')
                                ->required()
                                ->id('info_city_id')->class('form-control')}}
                    </div>
                    <div class="select2">
                        {{ html()->select('district_id')
                                ->attribute('data-type', 'district')
                                ->attribute('data-placeholder', 'Quận/Huyện')
                                ->attribute('data-parent', 'city_id')
                                ->options([$user->district->id ?? '' => $user->district->name ?? ''] ?? '')
                                ->id('info_district_id')
                                ->required()
                                ->class('form-control')}}
                    </div>
                    <div class="select2" data-id="{{ $user->city->name ?? '' }}">
                        {{ html()->select('ward_id')
                                ->attribute('data-type', 'ward')
                                ->attribute('data-placeholder', 'Phường/Xã')
                                ->attribute('data-parent', 'district_id')
                                ->options([$user->ward->id ?? '' => $user->ward->name ?? ''] ?? '')
                                ->value()
                                ->required()
                                ->id('info_ward_id')
                                ->class('form-control')}}
                    </div>
                    <div class="button-group" style='margin-top: 0px !important; margin-bottom: 60px;'>
                        <a class="cancel-addr-change-info" href="javascript:;">HỦY</a>
                        <button type="submit" class="common-button addr-change-info">LƯU ĐỊA CHỈ NÀY</button>
                    </div>
                </div>
            </form>
        </li>
        <li>
            <p class="confirm-info-title">Ngày sinh</p>
            <p class="confirm confirm-local birth"><span name="birth">@if (isset($user->birth)) {{date('d/m/Y', strtotime($user->birth))}} @endif</span><a onclick="changeinfo('birth')">Chỉnh sửa</a></p>
            <form id='birth-change-info' method='get' action='' class='open-additional' style='margin-bottom: 45px; margin-top: 0px !important; display:none;'>
                <div class='input-info'>
                    <input type='date' name='birth' value='@if (isset($user->birth)) {{$user->birth}} @endif'>
                    <div class='button-group' style='margin-top: 0px !important;'>
                        <a class='cancel-change-info' href='javascript:;'>HỦY</a>
                        <button type='submit' class='common-button birth-change-info'>LƯU NGÀY SINH NÀY</button>
                    </div>
                </div>
            </form>
        </li>
    </ul>
</div>
@push('after-scripts')
<script type="text/javascript">
    function changeinfo(name) {
        $('.' + name).hide();
        $('#' + name + '-change-info').show(); // show form
        $('.' + name + '-change-info').click(function(e) {
            var data = $('input[name="' + name + '"]').val();
            var id = $('#user-info').data('id');
            if ($("#" + name + "-change-info").validate()) {
                e.preventDefault();
                $.ajax({
                    type: 'get',
                    dataType: 'html',
                    url: '/mypage/updateInfo/?' +
                        "name=" + name +
                        "&data=" + data +
                        "&id=" + id,
                    success: function(response) {
                        var text = $('span[name="' + name + '"]').text(data);
                        $('#' + name + '-change-info').hide();
                        $('.' + name).show();
                    }
                });
            }
        });

        $('.cancel-change-info').click(function() {
            $(this).parents('form').prev().show();
            $(this).parents('form').hide();
        });
    }

    function changeAddr() {
        $('.addr').hide();
        $('#addr-change-info').show();
        $('.cancel-addr-change-info').click(function() {
            $('.addr').show();
            $('#addr-change-info').hide();
        });
    }
</script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/i18n/vi.js"></script>
<script src="{{ asset('/js/jquery.inputmask.bundle.min.js') }}"></script>
<script>
    $(function() {
        $('#info_city_id,#info_district_id,#info_ward_id').select2({
            language: 'vi',
            minimumInputLength: 1,
            ajax: {
                url: "{{ route('component.Component.locations') }}",
                dataType: 'json',
                delay: 300,
                data: function(params) {
                    return {
                        q: params.term, // search term
                        page: params.page,
                        type: $(this).data('type'),
                        parent: $('#' + $(this).data('parent')).val()
                    };
                },
                processResults: function(response, params) {
                    params.page = params.page || 1;
                    let results = $.map(response.data, function(obj) {
                        obj.text = obj.text || obj.name; // replace pk with your identifier
                        return obj;
                    });
                    return {
                        results: results,
                        pagination: {
                            more: (params.page * response.per_page) < response.total
                        }
                    };
                },
                cache: true
            }
        });
    });

    $('#info_city_id').change(function() {
        $('#info_district_id').val(null).trigger('change');
        $('#info_ward_id').val(null).trigger('change');
    })

    $('#info_district_id').change(function() {
        $('#info_ward_id').val(null).trigger('change');
    })
</script>
@endpush