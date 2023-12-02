@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">{{$page_title}}</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <form action="{{ route('admin.deposit.gateway.update', $gateway->code) }}" method="POST"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="alias" value="{{ $gateway->alias }}">

                                    <div class="card-body">

                                        @isset($gateway->currencies)
                                            @foreach($gateway->currencies as $gateway_currency)
                                                <input type="hidden" name="currency[{{ $currency_idx }}][symbol]"
                                                       value="{{ $gateway_currency->symbol }}">
                                                <div class="row">

                                                    <div class="form-group mb-3 col-md-12">
                                                        <label class="w-100">{{ $gateway->name }}
                                                            - {{$gateway_currency->currency}}<span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control form-control-lg"
                                                               placeholder="Name for Gateway"
                                                               name="currency[{{ $currency_idx }}][name]"
                                                               value="{{ $gateway_currency->name }}" required/></div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="card outline-primary">
                                                            <div class="input-group mb-3">
                                                                <label class="w-100">@lang('Minimum Deposit Amount')<span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" class="form-control"
                                                                       name="currency[{{ $currency_idx }}][min_amount]"
                                                                       value="{{ formatter_money($gateway_currency->min_amount) }}"
                                                                       placeholder="0" required/>
                                                                <div class="input-group-append">
                                                                    <div class="input-group-text">{{ $gnl->cur }}</div>
                                                                </div>
                                                            </div>
                                                            <div class="input-group">
                                                                <label class="w-100">@lang('Maximum Deposit Amount')
                                                                    <span class="text-danger">*</span></label>

                                                                <input type="text" class="form-control"
                                                                       placeholder="0"
                                                                       name="currency[{{ $currency_idx }}][max_amount]"
                                                                       value="{{ formatter_money($gateway_currency->max_amount) }}"
                                                                       required/>
                                                                <div class="input-group-append">
                                                                    <div
                                                                        class="input-group-text">{{ $gnl->cur }}</div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="card outline-primary">
                                                            <div class="input-group mb-3">
                                                                <label class="w-100">@lang('Deposit Fixed Charge')<span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control"
                                                                       placeholder="0"
                                                                       name="currency[{{ $currency_idx }}][fixed_charge]"
                                                                       value="{{ formatter_money($gateway_currency->fixed_charge) }}"
                                                                       required/>
                                                                <div class="input-group-append">
                                                                    <div class="input-group-text">{{ $gnl->cur }}</div>
                                                                </div>
                                                            </div>
                                                            <div class="input-group">
                                                                <label class="w-100">@lang('Deposit Percent Charge')
                                                                    <span
                                                                        class="text-danger">*</span></label>

                                                                <input type="text" class="form-control"
                                                                       placeholder="0"
                                                                       name="currency[{{ $currency_idx }}][percent_charge]"
                                                                       value="{{ formatter_money($gateway_currency->percent_charge) }}"
                                                                       required/>
                                                                <div class="input-group-append">
                                                                    <div class="input-group-text">%</div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="card outline-primary">

                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="input-group mb-3">
                                                                        <label class="w-100">@lang('Method Currency')</label>
                                                                        <select
                                                                            name="currency[{{ $currency_idx }}][currency]"
                                                                            class="form-control">
                                                                            @foreach($supportedCurrencies as $currency => $symbol)
                                                                                <option
                                                                                    @if( $gateway_currency->currency == $currency ) selected
                                                                                    @endif value="{{$currency}}"
                                                                                    data-symbol="{{ $symbol }}">{{ $currency }} </option>
                                                                            @endforeach
                                                                        </select>

                                                                    </div>

                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="input-group mb-3">
                                                                        <label class="w-100">@lang('Currency Symbol')</label>
                                                                        <input type="text"
                                                                               name="currency[{{ $currency_idx }}][symbol]"
                                                                               class="form-control border-radius-5 symbl"
                                                                               value="{{ $gateway_currency->symbol }}"
                                                                               data-crypto="{{ $gateway->crypto }}"
                                                                               required/></div>

                                                                </div>
                                                            </div>
                                                            <div class="input-group">

                                                                <label class="w-100">@lang('Rate') <span
                                                                        class="text-danger">*</span></label>
                                                                <div class="input-group-prepend">

                                                                    <div class="input-group-text">
                                                                        1 {{ $gnl->cur }} =
                                                                    </div>
                                                                </div>
                                                                <input type="text" class="form-control "
                                                                       placeholder="0"
                                                                       name="currency[{{ $currency_idx }}][rate]"
                                                                       value="{{ $gateway_currency->rate +0 }}"
                                                                       required/>
                                                                <div class="input-group-append">
                                                                    <div
                                                                        class="input-group-text currency_symbol">
                                                                        <span> @if ($gateway->crypto == 1)
                                                                            @lang('USD') @else
                                                                                {{$gateway_currency->currency}}
                                                                        @endif</span>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <code>(@lang('site Currency = method Currency'))</code>
                                                        </div>
                                                    </div>
                                                </div>

                                        @endforeach
                                    @endisset
                                        @if($gateway->code < 1000 && $gateway->extra)
                                                <h4>   <label>  @lang('Configurations') </label></h4>
                                                <div class="row">
                                                    @foreach($gateway->extra as $key => $extra)
                                                        <div class="form-group col-lg-6">
                                                            <label>{{ @$extra->title }}</label>
                                                            <div class="input-group">
                                                                <input disabled  class="form-control" id="id{{$key}}" value="{{ route($extra->value) }}"/>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                            <div class="body">
                                            <h4 class="mb-3">@lang('Setting for') {{ $gateway->name }}</h4>
                                            <div class="row">
                                                @foreach($parameter_list->where('global', true) as $key => $param)
                                                    <div class="form-group col-lg-6">
                                                        <label>{{ @$param->title }} <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control"
                                                               name="global[{{ $key }}]" value="{{ @$param->value }}"
                                                               required/>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group form-show-validation">
                                                    <label class="col-lg-4 col-md-3 col-sm-4 mt-sm-2">@lang('Upload image')
                                                        <span
                                                            class="required-label">*</span></label>
                                                    <div class="col-lg-12">
                                                        <div class="input-file input-file-image">

                                                            <div class="form-group ">
                                                                <img src="{{ asset('assets/images/gateway/'.$gateway->image) }}" alt="Image Preview" id="image-preview" style="height:200px" >
                                                            </div>
                                                            <div class="col-lg-12 ">
                                                                <div class="input-file input-file-image">
                                                                    <input type="file" class="form-control " id="image" name="image" accept="image/*" hidden >
                                                                    <label for="image" class="btn btn-primary rounded-pill "><i class="fa fa-file-image"></i> Upload</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p class="text-warning mb-0 mt-2">@lang('avatar Will Resize 200x200.')</p>
                                                    <p class="text-warning mb-0">@lang('Only jpg, jpeg, png image allowed.')</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-success btn-block">
                                         @lang('Update Gateway')
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $('.symbl').on('input', function () {
            var curText = $(this).data('crypto') == 1 ? 'USD' : $(this).val();
            $(this).parents('.payment-method-body').find('.currency_symbol').text(curText);
        });

    </script>
@endpush
@push('js')
<script src="{{ asset('assets/admin/js/jquery-3.6.0.min.js') }}"></script>
<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#image-preview').attr('src', e.target.result).show();
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    $('#image').on('change', function() {
        previewImage(this);
    });
</script>
@endpush
