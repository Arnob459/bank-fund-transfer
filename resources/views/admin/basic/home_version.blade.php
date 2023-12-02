@extends('admin.layouts.master')

@section('content')

    <div class="row">
        <div class="col-md-4">
                <div class="card card-post card-round">
                    <img class="card-img-top" style="max-height: 360px" src="{{asset('assets/images/homeversion/banner.png')}}" alt="Card image cap">
                    <div class="card-body text-center">
                        <div class="separator-solid"></div>
                        <h3 class="card-title mb-2">
                            <a href="#">
                            @lang('Banner/Static Version')
                            </a>
                        </h3>
                        @if ($gnl->home_version == 'banner')
                            <button  class="btn btn-success rounded-pill btn-sm"  data-toggle="modal">  Active</button>
                            @endif
                        @if ($gnl->home_version != 'banner')
                            <button  class="btn btn-info rounded-pill btn-sm"  data-bs-toggle="modal" data-bs-target="#banner"> Active</button>
                            <div class="modal fade" id="banner">
                                <div class="modal-dialog">
                                    <div class="modal-content" style="background-color: #202940;">
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <button type="button" class="close" data-bs-dismiss="modal">
                                                &times;
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <h4 class="modal-title">@lang('Are you sure you want to active banner version?')</h4>
                                        </div>
                                        <form class="d-inline-block"
                                              action="{{route('admin.settings.home.version.update')}}"
                                              method="post">
                                            @csrf
                                            <input type="hidden" name="home_version" value="banner">
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger"
                                                        data-bs-dismiss="modal">@lang('Close')
                                                </button>
                                                <button type="submit" class="btn btn-success">@lang('Yes')
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        <div class="col-md-4">
                <div class="card card-post card-round">
                    <img class="card-img-top" style="max-height: 360px" src="{{asset('assets/images/homeversion/slider.png')}}" alt="Card image cap">
                    <div class="card-body text-center">
                        <div class="separator-solid"></div>
                        <h3 class="card-title mb-2">
                            <a href="#">
                             @lang('Slider Version')
                            </a>
                        </h3>

                        @if ($gnl->home_version == 'slider')
                            <button  class="btn btn-success rounded-pill btn-sm"> @lang('Active')</button>
                        @endif

                        @if ($gnl->home_version != 'slider')
                            <button  class="btn btn-info rounded-pill btn-sm"  data-bs-toggle="modal"
                                     data-bs-target="#slider">  @lang('Active')</button>


                            <div class="modal fade" id="slider">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <button type="button" class="close" data-bs-dismiss="modal">
                                                &times;
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <h4 class="modal-title">@lang('Are you sure you want to active slider  version?')</h4>
                                        </div>
                                        <form class="d-inline-block"
                                              action="{{route('admin.settings.home.version.update')}}"
                                              method="post">
                                            @csrf
                                            <input type="hidden" name="home_version" value="slider">
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">@lang('Close')</button>
                                                <button type="submit" class="btn btn-success">@lang('Yes')</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
    </div>

@stop


