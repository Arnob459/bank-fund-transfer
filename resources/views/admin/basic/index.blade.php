@extends('admin.layouts.master')

@section('content')


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">{{$page_title}}</div>
                </div>
                <div class="card-body">
                    <form id="exampleValidation" method="post" action="{{route('admin.settings.basic')}}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row" >
                            <div class="col-md-4 mb-3">
                                <div class="form-group ">
                                    <label class="mb-2">@lang('Site Name')</label>
                                    <input type="text" class="form-control  form-control-lg"
                                        value="{{$gnl->site_name}}" name="site_name" placeholder="Enter site name" required>

                                </div>
                            </div>

                            <div class="form-group col-md-2 mb-3" >
                                <label class="mb-2" > @lang('Site Currency') </label>
                                <input type="text" class="form-control form-control-lg "
                                       value="{{$gnl->cur}}" placeholder="site currency" name="currency" required>
                            </div>

                            <div class="form-group col-md-3 mb-3">
                                <label class="mb-2">@lang('Site Currency Symbol')</label>
                                <input type="text" class="form-control form-control-lg  "
                                       value="{{$gnl->cur_sym}}" placeholder="site currency" name="currency_symbol"
                                       required>


                            </div>
                            <div class="form-group col-md-3 mb-3">
                                <label class="mb-2">@lang('Need Admin Approval')</label>
                                <select class="form-control form-control-lg " name="admin_permission">
                                    <option value="1">@lang('Yes')</option>
                                    <option value="0">@lang('No')</option>

                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-label">@lang('Email Verification')</label>
                                    <div class="selectgroup w-100">
                                        <input type="radio" class="btn-check" name="email_verification" id="eev"
                                        autocomplete="off" value="1" {{ $gnl->ev == '1' ? 'checked' : '' }}  >
                                    <label class="btn btn-outline-success-custom " for="eev">Enable</label>

                                    <input type="radio" class="btn-check" name="email_verification" id="dev"
                                        autocomplete="off" value="0" {{ $gnl->ev != '1' ? 'checked' : '' }}  >
                                    <label class="btn btn-outline-danger-custom" for="dev"> Disable</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-label">@lang('Email Notification')</label>
                                    <div class="selectgroup w-100">
                                        <input type="radio" class="btn-check" name="email_notification" id="een"
                                        autocomplete="off" value="1" {{ $gnl->en == '1' ? 'checked' : '' }}  >
                                    <label class="btn btn-outline-success-custom " for="een">Enable</label>

                                    <input type="radio" class="btn-check" name="email_notification" id="den"
                                        autocomplete="off" value="0" {{ $gnl->en != '1' ? 'checked' : '' }}  >
                                    <label class="btn btn-outline-danger-custom " for="den"> Disable</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-label">@lang('SMS Verification')</label>
                                    <div class="selectgroup w-100">
                                        <input type="radio" class="btn-check" name="sms_verification" id="esv"
                                        autocomplete="off" value="1" {{ $gnl->sv == '1' ? 'checked' : '' }}  >
                                    <label class="btn btn-outline-success-custom " for="esv">Enable</label>

                                    <input type="radio" class="btn-check" name="sms_verification" id="dsv"
                                        autocomplete="off" value="0" {{ $gnl->sv != '1' ? 'checked' : '' }}  >
                                    <label class="btn btn-outline-danger-custom " for="dsv"> Disable</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-label">@lang('SMS Notification')</label>
                                    <div class="selectgroup w-100">
                                        <input type="radio" class="btn-check" name="sms_notification" id="esn"
                                        autocomplete="off" value="1" {{ $gnl->sn == '1' ? 'checked' : '' }}  >
                                    <label class="btn btn-outline-success-custom " for="esn">Enable</label>

                                    <input type="radio" class="btn-check" name="sms_notification" id="dsn"
                                        autocomplete="off" value="0" {{ $gnl->sn != '1' ? 'checked' : '' }}  >
                                    <label class="btn btn-outline-danger-custom " for="dsn"> Disable</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-label">@lang('User Registration')</label>
                                    <div class="selectgroup w-100">
                                        <input type="radio" class="btn-check" name="registration" id="ereg"
                                        autocomplete="off" value="1" {{ $gnl->reg == '1' ? 'checked' : '' }}  >
                                    <label class="btn btn-outline-success-custom " for="ereg">Enable</label>

                                    <input type="radio" class="btn-check" name="registration" id="dreg"
                                        autocomplete="off" value="0" {{ $gnl->reg != '1' ? 'checked' : '' }}  >
                                    <label class="btn btn-outline-danger-custom " for="dreg"> Disable</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-label">@lang('User Login')</label>
                                    <div class="selectgroup w-100">
                                        <input type="radio" class="btn-check" name="login" id="elog"
                                        autocomplete="off" value="1" {{ $gnl->login_status == '1' ? 'checked' : '' }}  >
                                    <label class="btn btn-outline-success-custom " for="elog">Enable</label>

                                    <input type="radio" class="btn-check" name="login" id="dlog"
                                        autocomplete="off" value="0" {{ $gnl->login_status != '1' ? 'checked' : '' }}  >
                                    <label class="btn btn-outline-danger-custom " for="dlog"> Disable</label>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group col-md-6 mb-3">
                                <label for="basicInput" class="mb-2">User Registration Off Message</label>
                                <input type="text"
                                       class="form-control  form-control-lg " id="basicInput"
                                       value="{{$gnl->res_mes}}" name="registration_off_message"
                                       placeholder="User Registration Off Message">


                                <span class="text-warning">If user registration off message is null, there is a default message</span>

                            </div>

                            <div class="form-group col-md-6 mb-3">
                                <label class="mb-2">User Login Off Message</label>
                                <input type="text"
                                       class="form-control  form-control-lg "
                                       value="{{$gnl->login_mes}}" name="login_off_message"
                                       placeholder="User Login Off Message">

                                <span
                                    class="text-warning">If user login off message is null, there is a default message</span>
                            </div>

                            <div class="card-title">Transfer Charges </div>

                            <div class="col-md-6 ">
                                <label for="basicInput" class="mb-2">Percent Charge </label>
                                <div class="input-group mb-3">
                                    <input type="text" name="percent_charge" value="{{formatter_money($gnl->percent_charge)  }}" class="form-control form-control-lg"
                                        aria-label="percent_charge" aria-describedby="basic-addon1" required >
                                    <span class="input-group-text" id="basic-addon1">%</span>
                                </div>
                            </div>
                            <div class="col-md-6 ">
                                <label for="basicInput" class="mb-2">Fixed Charge </label>
                                <div class="input-group mb-3">
                                    <input type="text" name="fixed_charge" value="{{formatter_money($gnl->fixed_charge)  }}" class="form-control form-control-lg"
                                        aria-label="fixed_charge" aria-describedby="basic-addon1" required>
                                    <span class="input-group-text" id="basic-addon1">{{ $gnl->cur_sym }}</span>
                                </div>
                            </div>

                        </div>

                       <div class="card-action mt-5">
                            <button class="btn btn-success btn-block">@lang('Submit')</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>

    </div>


@endsection

@push('js_link')
    @include('partials.validation_js')
@endpush

@push('js')
    <script>
        $("select[name=admin_permission]").val("{{ $gnl->admin_permission }}");
    </script>
@endpush



