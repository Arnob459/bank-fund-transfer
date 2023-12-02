@extends('admin.layouts.master')
@push('button')
<button type="button" data-bs-toggle="modal"
data-bs-target="#createModal" class="btn btn-warning ">Add New Social Link</button>
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    <div class="card-title">@lang('Social Links')</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">

                            <div class="table-responsive">
                                <table class="table table-lg table-hover mt-3">
                                    <thead>
                                    <tr>
                                        <th scope="col">@lang('SL')</th>
                                        <th scope="col">@lang('Icon')</th>
                                        <th scope="col">@lang('URL')</th>
                                        <th scope="col">@lang('Actions')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($icons as $key => $social)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td><i class="{{$social->icon}}"></i></td>
                                            <td>{{$social->url}}</td>
                                            <td>
                                                <a class="btn btn-secondary btn-sm"
                                                   href="{{route('admin.settings.social.edit', $social->id)}}">
                                                    <span class="btn-label"><i class="fas fa-edit"></i></span>
                                                    @lang('Edit')</a>

                                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#myModal-{{$social->id}}">
                                                    <span class="btn-label"><i class="fas fa-edit"></i></span>
                                                    @lang('Delete')
                                                </button>

                                            </td>
                                        </tr>
                                        <div class="modal fade" id="myModal-{{$social->id}}">
                                            <div class="modal-dialog">
                                                <div class="modal-content" style="background-color: #202940;">
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">@lang("Are you sure?")</h4>
                                                        <button type="button" class="close" data-bs-dismiss="modal">
                                                            &times;
                                                        </button>
                                                    </div>
                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        @lang("You won't be able to revert this!")

                                                    </div>
                                                    <form class="d-inline-block" action="{{route('admin.settings.social.destroy', $social->id)}}" method="post">@csrf{{method_field('delete')}}
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger"
                                                                    data-bs-dismiss="modal">@lang('Close')
                                                            </button>
                                                            <button type="submit" class="btn btn-success">@lang('Delete')
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{-- NEW MODAL --}}
<div class="modal fade text-left" id="createModal" tabindex="-1" role="dialog"
aria-labelledby="myModalLabel1" aria-hidden="true">
<div class="modal-dialog " role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="myModalLabel1">Add New Social Link </h5>
            <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                aria-label="Close">
                <i data-feather="x"></i>
            </button>
        </div>
        <form id="socialForm" action="{{route('admin.settings.social.store')}}" method="post"  onsubmit="store(event)">
        @csrf

        <div class="modal-body">

            <div class="col-md-12 ">
                <label for="basicInput">@lang('Social Icon')<span class="required-label">*</span></label>

                <div class="justify-content-center d-flex">
                    <div class="btn-group d-block">
                        <button type="button" class="btn btn-lg btn-secondary iconpicker-component"><i
                                class="fa fa-heart"></i>
                        </button>
                        <button  type="button" class="icp icp-dd btn btn-lg btn-secondary dropdown-toggle"
                                data-selected="fa-car" data-bs-toggle="dropdown">
                        </button>

                        <div class="dropdown-menu"></div>
                        <span class="action-create"></span>
                    </div>
                    <input id="inputIcon" type="hidden" name="icon">
                </div>
            </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="basicInput">URL<span class="required-label">*</span></label>
                        <input type="text" name="url" class="form-control form-control-lg"  placeholder="Enter URL of your social media account" required>
                    </div>
                </div>
        </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
                <button type="submit" class="btn btn-primary ml-1" >
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Create</span>
                </button>
            </div>
        </form>
    </div>
</div>
</div>


@endsection


@include('admin.layouts.iconpicker')


