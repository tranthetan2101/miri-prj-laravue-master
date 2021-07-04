<div id="user-address" class="tab-content-inner-order @if(old('mode') == 'addr') current @endif">
    <h1>Địa chỉ giao hàng</h1>
    @foreach($addres as $addr)
    <div class="confirm-info">
        <ul>
            <li>
                <p class="confirm-info-title">Địa chỉ giao hàng
                    <a data-addr-id="{{$addr->id}}" data-addr_name="{{$addr->name}}" data-addr_company="{{$addr->company_name}}" data-phone_number="{{$addr->phone_number}}" data-addr_number="{{$addr->addr_number}}" data-addr_street="{{$addr->addr_street}}" data-addr_ward="{{$addr->ward->name}}" data-addr_ward_id="{{$addr->ward->id}}" data-addr_district="{{$addr->district->name}}" data-addr_district_id="{{$addr->district->id}}" data-addr_city="{{$addr->city->name}}" data-addr_city_id="{{$addr->city->id}}" class="change-addr-btn">Chỉnh sửa
                    </a>
                </p>
                <p class="confirm confirm-user"><span>{{$addr->name}}</span></p>
                <p class="confirm confirm-phone"><span>{{$addr->phone_number}}</span></p>
                <p class="confirm confirm-local"><span>{{$addr->addr_number}} {{ucwords($addr->addr_street)}} {{$addr->ward->type}} {{$addr->ward->name}} {{$addr->district->type}} {{$addr->district->name}} {{$addr->city->type}} {{$addr->city->name}}</span></p>
            </li>
        </ul>
    </div>
    @endforeach
    <div>
        <p><a class="additional">+ Thêm địa chỉ giao hàng</a></p>
        <form action="{{route('frontend.mypage.updateAddr')}}" class="open-additional addr-form" method="post" style="display:none">
            @csrf
            <div class="input-info">
                <input type="hidden" name="id" value=''>
                <input type="hidden" name="user_id" value='{{ Auth::user()->id }}'>
                <input type="hidden" name="mode" value='addr'>
                <input type="text" name="name" placeholder="Họ và tên" value=''>
                <input type="text" name="company_name" placeholder="Tên Công ty ( nếu có )" value=''>
                <input type="text" name="phone_number" placeholder="Số điện thoại" value=''>
                <input type="text" name="addr_number" placeholder="Số nhà" value=''>
                <input type="text" name="addr_street" placeholder="Địa chỉ" value=''>
                <div class="select2">
                    {{ html()->select('city_id')
                                ->attribute('data-type', 'city')
                                ->attribute('data-placeholder', 'Tỉnh/Thành phố')
                                ->required()
                                ->id('addr_city_id')->class('form-control')}}
                </div>
                <div class="select2">
                    {{ html()->select('district_id')
                                ->attribute('data-type', 'district')
                                ->attribute('data-placeholder', 'Quận/Huyện')
                                ->attribute('data-parent', 'city_id')
                                ->id('addr_district_id')
                                ->required()
                                ->class('form-control')}}
                </div>
                <div class="select2" data-id="{{ $user->city->name ?? '' }}">
                    {{ html()->select('ward_id')
                                ->attribute('data-type', 'ward')
                                ->attribute('data-placeholder', 'Phường/Xã')
                                ->attribute('data-parent', 'district_id')
                                ->required()
                                ->id('addr_ward_id')
                                ->class('form-control')}}
                </div>
            </div>
            <div class="button-group">
                <a class="back-to-buy" href="#">HỦY</a>
                <button type="submit" class="common-button">LƯU ĐỊA CHỈ NÀY</button>
            </div>

        </form>
    </div>
</div>


@push('after-scripts')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/i18n/vi.js"></script>
<script src="{{ asset('/js/jquery.inputmask.bundle.min.js') }}"></script>
<script>
    $(function() {
        $('#addr_city_id,#addr_district_id,#addr_ward_id').select2({
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

    $('#addr_city_id').change(function() {
        $('#addr_district_id').val(null).trigger('change');
        $('#addr_ward_id').val(null).trigger('change');
    })

    $('#addr_district_id').change(function() {
        $('#addr_ward_id').val(null).trigger('change');
    })

    
</script>
<script type="text/javascript">
    $(document).ready(function($) {
        getDataForCity('addr');
        $('.additional').click(function() {
            clearDataForm();
            $('.addr-form').show();
        })

        $('.change-addr-btn').click(function() {
            $('.addr-form').show();
            $('.change-addr-btn').show();
            $(this).hide();
            $('.additional').hide();
            var target = $(this);
            addDataToForm(target);
        })

        $('.back-to-buy').click(function() {
            $('.addr-form').hide();
            $('.change-addr-btn').show();
            $('.additional').show();
        })

        function addDataToForm(target) {
            $('input[name="id"]').val(target.data('addr-id'));
            $('input[name="name"]').val(target.data('addr_name'));
            $('input[name="company_name"]').val(target.data('addr_company'));
            $('input[name="phone_number"]').val(target.data('phone_number'));
            $('input[name="addr_number"]').val(target.data('addr_number'));
            $('input[name="addr_street"]').val(target.data('addr_street'));

            var cityNewOption = new Option(target.data('addr_city'), target.data('addr_city_id'), true, true);
            // Append it to the select
            $('#addr_city_id').append(cityNewOption).trigger('change');

            var districtNewOption = new Option(target.data('addr_district'), target.data('addr_district_id'), true, true);
            // Append it to the select
            $('#addr_district_id').append(districtNewOption).trigger('change');

            var wardNewOption = new Option(target.data('addr_ward'), target.data('addr_ward_id'), true, true);
            // Append it to the select
            $('#addr_ward_id').append(wardNewOption).trigger('change');
        }

        function clearDataForm() {
            $('input[name="id"]').val('');
            $('input[name="name"]').val('');
            $('input[name="company_name"]').val('');
            $('input[name="phone_number"]').val('');
            $('input[name="addr_number"]').val('');
            $('input[name="addr_street"]').val('');
            $('#addr_city_id').val(null).trigger('change');
            $('#addr_district_id').val(null).trigger('change');
            $('#addr_ward_id').val(null).trigger('change');
        }
    });
</script>

@endpush