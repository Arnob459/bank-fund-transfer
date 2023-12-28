@extends('admin.layouts.master')

    @push('button')
    <a href="{{ route('admin.card.type.create') }}" class="btn btn-warning ">Add New Card type</a>
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
                                <th >SL</th>
                                <th >Image </th>
                                <th >Name</th>
                                <th >Status</th>
                                <th >Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($card_types as $type)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td class="text-bold-500">
                                        <img  src="{{ asset('assets/images/card/'.$type->image) }}" >
                                    </td>
                                    <td class="font-weight-bold">{{ $type->name}}</td>


                                    <td>
                                        @if($type->status == 0)
                                            <span class="badge bg-warning">@lang('Pending')</span>
                                        @elseif($type->status == 1)
                                            <span class="badge bg-success">@lang('Active')</span>
                                        @elseif($type->status == 2)
                                            <span class="badge bg-danger">@lang('Deactive')</span>
                                        @endif
                                    </td>


                                    @if ($type->status != 1)

                                    <td>
                                        <button class="btn btn-success "  data-bs-toggle="modal" data-bs-target="#success{{ $type->id }}"><i class="fa fa-fw fa-check"></i></button>
                                    </td>

                                            <!--Success theme Modal -->
                                            <div class="modal fade text-left" id="success{{ $type->id }}" tabindex="-1" role="dialog"
                                                aria-labelledby="myModalLabel110" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                    role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-success">
                                                            <h5 class="modal-title white" id="myModalLabel110">Card type Active
                                                            </h5>
                                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                                <i data-feather="x"></i>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">

                                                                 Are you sure you want to active this Card type
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light-secondary"
                                                                data-bs-dismiss="modal">
                                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Close</span>
                                                            </button>
                                                            <form method="POST" action="{{ route('admin.type.activate') }}">
                                                                @csrf
                                                                <input type="hidden" name="id" value="{{ $type->id }}">
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
                                        <button class="btn btn-danger "  data-bs-toggle="modal" data-bs-target="#danger{{ $type->id }}"><i class="fa fa-fw fa-ban"></i></button>
                                    </td>

                                            <!--Success theme Modal -->
                                            <div class="modal fade text-left" id="danger{{ $type->id }}" tabindex="-1" role="dialog"
                                                aria-labelledby="myModalLabel110" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                    role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-danger">
                                                            <h5 class="modal-title white" id="myModalLabel110">Card type Inactive
                                                            </h5>
                                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                                <i data-feather="x"></i>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">

                                                                 Are you sure you want to inactive this Card type
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light-secondary"
                                                                data-bs-dismiss="modal">
                                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Close</span>
                                                            </button>
                                                            <form method="POST" action="{{ route('admin.card.type.deactivate') }}">
                                                                    @csrf
                                                                    <input type="hidden" name="id" value="{{ $type->id }}">
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
                            <p>{{ $card_types->appends(array_filter(Request::all()))->links( "pagination::bootstrap-5")}}</p>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection


