@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    <div class="card-title">@lang('Edit Social Link')</div>
                </div>
                <form id="socialForm" action="{{route('admin.settings.social.update', $icon->id)}}" method="post"
                      onsubmit="store(event)">
                    @csrf
                    <div class="card-body pt-5 pb-5">
                        <div class="row justify-content-center">
                            <div class="form-group col-md-3">
                                <label for="">@lang('Social Icon')*</label>
                                <div class="btn-group d-block">
                                    <button type="button" class="btn btn-secondary iconpicker-component"><i
                                            class="{{$icon->icon}}"></i></button>
                                    <button type="button" class="icp icp-dd btn btn-secondary dropdown-toggle"
                                            data-selected="fa-car" data-bs-toggle="dropdown">
                                    </button>
                                    <div class="dropdown-menu"></div>
                                    <span class="action-create"></span>
                                </div>
                                <input id="inputIcon" type="hidden" name="icon">
                                @if ($errors->has('icon'))
                                    <p class="mb-0 text-danger">{{$errors->first('icon')}}</p>
                                @endif
                                <div class="mt-2">
                                    <small>@lang('info: click on the dropdown icon to select a social link icon.')</small>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="">@lang('URL') *</label>
                                <input type="text" class="form-control" name="url" value="{{$icon->url}}"
                                       placeholder="Enter URL of your social media account">
                                @if ($errors->has('url'))
                                    <p class="mb-0 text-danger">{{$errors->first('url')}}</p>
                                @endif
                            </div>

                        </div>

                    </div>
                    <div class="card-footer pt-3">
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-success btn-block">@lang('Submit')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@include('admin.layouts.iconpicker')


