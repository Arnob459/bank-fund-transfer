@extends('admin.layouts.master')

@section('content')

    <div class="row">

    <div class="col-xl-12">
        <div class="card">
            <div class="table-responsive ">
                <table class="table table-lg table-hover">
                    <thead>
                        <tr>
                            <th>@lang('Short Code')</th>
                            <th>@lang('Description')</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        @forelse($sms_template->shortcodes as $shortcode => $key)
                        <tr>
                            <th>@php echo "{{". $shortcode ."}}"  @endphp</th>
                            <td>{{ $key }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="100%" class="text-muted text-center">@lang('No short code available')</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header bg-primary">
                <h4 class="card-title font-weight-normal">{{ $page_title }}</h4>
            </div>
            <form action="{{ route('admin.sms-template.update', $sms_template->id) }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-row">

                        <div class="form-group col-md-4">
                            <label>@lang('Status') <span class="text-danger">*</span></label>

                            <input type="checkbox" id="emailSendStatus" data-height="46px" data-width="100%" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Send SMS" data-off="Don't Send" name="sms_status" @if($sms_template->sms_status) checked @endif>
                        </div>
                        <div class="form-group col-md-12">
                            <label>@lang('Message') <span class="text-danger">*</span></label>
                            <textarea name="sms_body" rows="10" class="form-control" placeholder="Your message using shortcodes">{{ $sms_template->sms_body }}</textarea>
                        </div>

                    </div>
                </div>
                <div class="card-footer">
                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-block btn-primary mr-2">@lang('Submit')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

