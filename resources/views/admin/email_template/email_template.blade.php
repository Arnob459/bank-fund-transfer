@extends('admin.layouts.master')

@section('content')
<div class="row">

    <div class="col-xl-12">
        <div class="card">
            <div class="table-responsive">
                <table class="table table-lg">
                    <thead>
                        <tr>
                            <th>@lang('Short Code')</th>
                            <th>@lang('Description')</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        <tr>
                            <th>@{{name}}</th>
                            <td>@lang('User Name')</td>
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
                <h4 class="card-title font-weight-normal">{{ $page_title }}</h4>
            </div>
            <form action="{{ route('admin.email-template.global') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-row">

                        <div class="form-group col-md-12">
                            <label>@lang('Email Sent From') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Email address" name="efrom" value="{{ $general_setting->efrom }}"  required/>
                        </div>
                        <div class="form-group col-md-12">
                            <label>@lang('Email Body') <span class="text-danger">*</span></label>
                            <textarea name="etemp" id="myNicEditor" rows="10" class="form-control" placeholder="Your email template">{{ $general_setting->etemp }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="form-group col-md-12 text-center">
                        <button type="submit" class="btn btn-block btn-primary mr-2">@lang('Update')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
@push('nicEdit')
<script type="text/javascript" src="//js.nicedit.com/nicEdit-latest.js"></script>
<!-- Include NicEdit from a CDN -->


<script type="text/javascript">
    //<![CDATA[
    bkLib.onDomLoaded(function() {
        nicEditors.editors.push(
            new nicEditor().panelInstance(
                document.getElementById('myNicEditor')
            )
        );
    });
    //]]>
    </script>

@endpush
