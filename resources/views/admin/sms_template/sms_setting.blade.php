@extends('admin.layouts.master')

@section('content')

    <div class="row">

    <div class="col-xl-12">
        <div class="card">
            <div class="table-responsive ">
                <table class="table table-lg table-hover ">
                    <thead>
                        <tr>
                            <th>@lang('Short Code')</th>
                            <th>@lang('Description')</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        <tr>
                            <th>@{{number}}</th>
                            <td>@lang('Number')</td>
                        </tr>
                        <tr>
                            <th>@{{message}}</th>
                            <td>@lang('Message')</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header bg-primary">
                <div class="row">
                    <div class="col-md-10">
                        <h4 class="card-title font-weight-normal pull-left">{{ $page_title }}</h4>
                    </div>
                    <div class="col-md-2">
                        <button type="button" data-bs-target="#tesSMSModal" data-bs-toggle="modal" class="btn btn-success pull-right">@lang('Send Test SMS')</button>

                    </div>
                </div>

            </div>
            <form action="{{ route('admin.sms-template.global') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">

                        <div class="form-group col-md-12">
                            <label>@lang('SMS API') <span class="text-danger">*</span></label>
                            <input type="string" class="form-control" placeholder="SMS API Configuration" name="smsapi" value="{{ $general_setting->smsapi }}" required/>
                        </div>

                    </div>
                </div>
                <div class="card-footer">
                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-block btn-success mr-2">@lang('Submit')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


{{-- TEST MAIL MODAL --}}
<div id="tesSMSModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Test SMS')</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.email-template.sendTestSMS') }}" method="POST">
                @csrf
                <input type="hidden" name="id">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>@lang('Sent to') <span class="text-danger">*</span></label>
                            <input type="text" name="mobile" class="form-control" placeholder="Mobile number">
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
