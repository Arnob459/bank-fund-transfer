@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    <div class="card-title">{{$page_title}} Section</div>
                </div>
                <form  class="exampleValidation" action="{{route('admin.settings.contact')}}" method="post">
                    @csrf
                    <div class="card-body ">
                        <div class="row ">
                            <div class="form-group col-md-12 mb-4">
                                <label for="" class="mb-2">@lang('Contact email') </label>
                                <input type="text" class="form-control form-control-lg" name="contact_email" value="{{$setting_extra->contact_email}}"
                                       placeholder="Enter service title">
                                <code>@lang('this email will use in contact form')</code>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="" class="mb-2">@lang('Contact phone')</label>
                                <input type="text" class="form-control form-control-lg" name="contact_phone" value="{{$setting_extra->contact_phone}}"
                                       placeholder="Enter service subtitle">
                                <code>@lang('this phone will use in header top')</code>
                            </div>

                        </div>
                    </div>
                    <div class="card-footer pt-3">
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-success btn-block">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection


@section('button')

@endsection


