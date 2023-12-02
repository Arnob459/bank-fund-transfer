@extends('admin.layouts.master')

@section('content')

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <form action="{{ route('admin.email-template.setting') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <h6 class="mb-4">@lang('Email Send Method')</h6>
                            <select name="email_method" class="form-control" >

                                <option value="php" @if($general_setting->name == 'php') selected @endif>PHP Mail</option>
                                <option value="smtp" @if($general_setting->name == 'smtp') selected @endif>SMTP</option>
                              </select>
                        </div>
                        <div class="form-group col-md-6 text-right">
                            <h6 class="mb-4">&nbsp;</h6>

                            <button type="button" data-bs-target="#testMailModal" data-bs-toggle="modal" class="btn btn-info">Send Test Mail</button>
                        </div>
                    </div>
                    <div class="row mt-4 d-none configForm" id="smtp">
                        <div class="col-md-12">
                            <h6 class="mb-2">@lang('SMTP Configuration')</h6>
                        </div>
                        <div class="form-group col-md-5">
                            <label>@lang('Host') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="e.g. smtp.googlemail.com" name="host" value="{{ $general_setting->mail_config->host ?? '' }}"/>
                        </div>

                        <div class="form-group col-md-2">
                            <label>@lang('Port') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Available port" name="port" value="{{ $general_setting->mail_config->port ?? '' }}"/>
                        </div>
                        <div class="form-group col-md-3">
                            <label>@lang('Driver')</label>
                            <input type="text" class="form-control" placeholder="e.g. smtp" name="driver" value="{{ $general_setting->mail_config->driver ?? '' }}"/>
                        </div>
                        <div class="form-group col-md-2">
                            <label>@lang('Encryption')</label>
                            <input type="text" class="form-control" placeholder="e.g. ssl" name="enc" value="{{ $general_setting->mail_config->enc ?? '' }}"/>
                        </div>
                        <div class="form-group col-md-6">
                            <label>@lang('Username') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Normally your email address" name="username" value="{{ $general_setting->mail_config->username ?? '' }}"/>
                        </div>
                        <div class="form-group col-md-6">
                            <label>@lang('Password') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Normally your email password" name="password" value="{{ $general_setting->mail_config->password ?? '' }}"/>
                        </div>
                    </div>
                    <div class="form-row mt-4 d-none configForm" id="sendgrid">
                        <div class="col-md-12">
                            <h6 class="mb-2">@lang('SendGrid API Configuration')</h6>
                        </div>
                        <div class="form-group col-md-12">
                            <label>@lang('APP KEY') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="SendGrid app key" name="appkey" value="{{ $general_setting->mail_config->appkey ?? '' }}"/>
                        </div>
                    </div>
                    <div class="form-row mt-4 d-none configForm" id="mailjet">
                        <div class="col-md-12">
                            <h6 class="mb-2">@lang('Mailjet API Configuration')</h6>
                        </div>
                        <div class="form-group col-md-6">
                            <label>@lang('API PUBLIC KEY') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Mailjet API PUBLIC KEY" name="public_key" value="{{ $general_setting->mail_config->public_key ?? '' }}"/>
                        </div>
                        <div class="form-group col-md-6">
                            <label>@lang('API SECRET KEY') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Mailjet API SECRET KEY" name="secret_key" value="{{ $general_setting->mail_config->secret_key ?? '' }}"/>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="form-row">
                        <div class="form-group col-md-12 text-center">
                            <button type="submit" class="btn btn-block btn-primary mr-2">@lang('Update')</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- TEST MAIL MODAL --}}
<div id="testMailModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Test Mail Setup')</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.email-template.sendTestMail') }}" method="POST">
                @csrf
                <input type="hidden" name="id">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>@lang('Sent to') <span class="text-danger">*</span></label>
                            <input type="text" name="email" class="form-control" placeholder="Email Address">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn btn-success">@lang('Send')</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
$('select[name=email_method]').on('change', function() {
    var method = $(this).val();
    $('.configForm').addClass('d-none');
    if(method != 'php') {
        $(`#${method}`).removeClass('d-none');
    }
}).change();

</script>
@endpush
