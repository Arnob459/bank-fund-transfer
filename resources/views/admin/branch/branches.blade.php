@extends('admin.layouts.master')

    @push('button')
    <a href="" data-bs-toggle="modal" data-bs-target="#createbranch" class="btn btn-warning ">Add New Branch</a>
    @endpush

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{$page_title}}  </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table  class="table  table-hover" >
                            <thead>
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Branch </th>
                                <th scope="col">Routing Number</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($branches as $branch)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td class="font-weight-bold">{{ $branch->name}}</td>
                                    <td>{{$branch->routing_number}}</td>

                                    <td>
                                        @if($branch->status == 0)
                                            <span class="badge bg-warning">@lang('Pending')</span>
                                        @elseif($branch->status == 1)
                                            <span class="badge bg-success">@lang('Active')</span>
                                        @elseif($branch->status == 2)
                                            <span class="badge bg-danger">@lang('Deactive')</span>
                                        @endif
                                    </td>


                                    @if ($branch->status != 1)

                                    <td>
                                        <button class="btn btn-success "  data-bs-toggle="modal" data-bs-target="#success{{ $branch->id }}"><i class="fa fa-fw fa-check"></i></button>
                                    </td>

                                            <!--Success theme Modal -->
                                            <div class="modal fade text-left" id="success{{ $branch->id }}" tabindex="-1" role="dialog"
                                                aria-labelledby="myModalLabel110" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                    role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-success">
                                                            <h5 class="modal-title white" id="myModalLabel110">branch Active
                                                            </h5>
                                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                                <i data-feather="x"></i>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">

                                                                 Are you sure you want to active this branch
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light-secondary"
                                                                data-bs-dismiss="modal">
                                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Close</span>
                                                            </button>
                                                            <form method="POST" action="{{ route('admin.branch.activate') }}">
                                                                @csrf
                                                                <input type="hidden" name="id" value="{{ $branch->id }}">
                                                            <button type="submit" class="btn btn-success ml-1">  <i class="bx bx-check d-block d-sm-none"></i> <span class="d-none d-sm-block">Active</span>
                                                            </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else

                                    <td>
                                        <button class="btn btn-danger "  data-bs-toggle="modal" data-bs-target="#danger{{ $branch->id }}"><i class="fa fa-fw fa-ban"></i></button>
                                    </td>

                                            <!--Success theme Modal -->
                                            <div class="modal fade text-left" id="danger{{ $branch->id }}" tabindex="-1" role="dialog"
                                                aria-labelledby="myModalLabel110" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                    role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-danger">
                                                            <h5 class="modal-title white" id="myModalLabel110">branch Inactive
                                                            </h5>
                                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                                <i data-feather="x"></i>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">

                                                                 Are you sure you want to inactive this branch
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light-secondary"
                                                                data-bs-dismiss="modal">
                                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Close</span>
                                                            </button>
                                                            <form method="POST" action="{{ route('admin.branch.deactivate') }}">
                                                                    @csrf
                                                                    <input type="hidden" name="id" value="{{ $branch->id }}">
                                                                <button type="submit" class="btn btn-danger ml-1">  <i class="bx bx-check d-block d-sm-none"></i> <span class="d-none d-sm-block">Inactive</span>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    @endif
                                    <td></td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                        <ul class="pagination-overfollow">
                            <p>{{ $branches->appends(array_filter(Request::all()))->links( "pagination::bootstrap-5")}}</p>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>

        <!--Create Branch Modal -->
        <div class="modal fade text-left" id="createbranch" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel110" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title white" id="myModalLabel110">Create New Branch
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>

                    <form method="POST" action="{{ route('admin.branch.store') }}">
                        @csrf
                    <div class="modal-body">

                        <div class="col-12">
                            <div class="form-group">
                                <label for="contact-info-vertical" class="mb-2">Branch Name</label>
                                <input type="text" id="contact-info-vertical" class="form-control"
                                name="name"  required>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="contact-info-vertical" class="mb-2">Routing Number</label>
                                <input type="text" id="contact-info-vertical" class="form-control"
                                name="routing_number" required >
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-light-secondary"
                            data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>

                        <button type="submit" class="btn btn-primary ml-1">  <i class="bx bx-check d-block d-sm-none"></i> <span class="d-none d-sm-block">Create</span>
                        </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


