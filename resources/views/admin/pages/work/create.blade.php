@extends('admin.layouts.master')

@section('content')


<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">How it's Work Create </h4>
        </div>

        <div class="card-body">
            <form id="socialForm"  action="{{ route('admin.work.store') }}" method="post" enctype="multipart/form-data" onsubmit="store(event)">
                @csrf
            <div class="row">

                <div class=" col-md-3">
                    <div class="form-group justify-content-center ">
                        <label for="">@lang(' Icon') *</label>
                        <div class="btn-group d-block   mb-2">
                            <button type="button" class="btn btn-lg btn-secondary iconpicker-component"><i
                                    class="fa fa-fw fa-heart"></i></button>
                            <button type="button" class="icp icp-dd btn btn-lg btn-secondary dropdown-toggle"
                                    data-selected="fa-car" data-bs-toggle="dropdown">
                            </button>
                            <div class="dropdown-menu"></div>
                            <span class="action-create"></span>
                        </div>
                        <input id="inputIcon" type="hidden" name="icon">
                        <div class="mt-3">
                            <small>@lang('Info : click on the dropdown icon to select a social link icon.')</small>
                        </div>
                    </div>
                </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="basicInput">Title</label>
                                <input type="text" name="title" class="form-control form-control-lg" id="basicInput" placeholder="Enter Work Title" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="basicInput">Short Text</label>
                                <input type="text" name="subtitle" class="form-control form-control-lg" id="basicInput" placeholder="Enter Work Short Text" required>
                            </div>
                        </div>

                <button type="submit" class="btn btn-success  me-1 mb-1">Submit</button>

            </form>

            </div>
        </div>
    </div>
</section>
@endsection


@include('admin.layouts.iconpicker')
