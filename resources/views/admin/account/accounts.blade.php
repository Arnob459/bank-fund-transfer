@extends('admin.layouts.master')

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
                                <th scope="col">Date</th>
                                <th scope="col">Bank </th>
                                <th scope="col">Username</th>

                                <th scope="col">@lang('Status')</th>
                                <th scope="col">Details</th>
                                <th scope="col">Action</th>


                            </tr>
                            </thead>
                            <tbody>
                            @foreach($accounts as $account)
                                <tr>
                                    <td>{{ show_datetime($account->created_at) }}</td>
                                    <td class="font-weight-bold">{{ strtoupper($account->bank->name) }}</td>
                                    <td><a href="{{route('admin.user.edit', $account->user_id)}}">{{ $account->user->username }}</a></td>
                                    <td>
                                        @if($account->status == 0)
                                            <span class="badge bg-warning">@lang('Pending')</span>
                                        @elseif($account->status == 1)
                                            <span class="badge bg-success">@lang('Approved')</span>
                                        @elseif($account->status == 2)
                                            <span class="badge bg-danger">@lang('Rejected')</span>
                                        @endif
                                    </td>

                                        <td>
                                            <button class="btn btn-primary "  data-bs-toggle="modal" data-bs-target="#primary{{ $account->id }}"><i class="fa fa-fw fa-desktop"></i></button>
                                        </td>

                                            <!--Primary theme Modal -->
                                            <div class="modal fade text-left" id="primary{{ $account->id }}" tabindex="-1" role="dialog"
                                            aria-labelledby="myModalLabel110" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary">
                                                        <h5 class="modal-title white" id="myModalLabel110">Account Details
                                                        </h5>
                                                        <button type="button" class="close" data-bs-dismiss="modal"
                                                            aria-label="Close">
                                                            <i data-feather="x"></i>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <ul class="list-unstyled">
                                                            <li class="fw-500">Bank Name</li>
                                                            <li class="text-muted">{{ $account->bank->name }}</li>
                                                          </ul>

                                                          <ul class="list-unstyled">
                                                            <li class="fw-500">Username</li>
                                                            <li class="text-muted">{{ $account->user->username }}</li>
                                                          </ul>

                                                          <ul class="list-unstyled">
                                                            <li class="fw-500">Account Type</li>
                                                            @if ($account->type == 0)
                                                            <li class="text-muted">Personal</li>

                                                            @else
                                                            <li class="text-muted">Business</li>

                                                            @endif
                                                          </ul>

                                                        @foreach(json_decode($account->user_data) as $key => $data)
                                                        <ul class="list-unstyled">
                                                          <li class="fw-500">{{ $key }}</li>
                                                          <li class="text-muted">{{ $data }}</li>
                                                        </ul>
                                                        @endforeach

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light-secondary"
                                                            data-bs-dismiss="modal">
                                                            <i class="bx bx-x d-block d-sm-none"></i>
                                                            <span class="d-none d-sm-block">Close</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($account->status != 1)

                                    <td>
                                        <button class="btn btn-success "  data-bs-toggle="modal" data-bs-target="#success{{ $account->id }}"><i class="fa fa-fw fa-check"></i></button>
                                    </td>

                                            <!--Success theme Modal -->
                                            <div class="modal fade text-left" id="success{{ $account->id }}" tabindex="-1" role="dialog"
                                                aria-labelledby="myModalLabel110" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                    role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-success">
                                                            <h5 class="modal-title white" id="myModalLabel110">Account Active
                                                            </h5>
                                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                                <i data-feather="x"></i>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">

                                                                 Are you sure you want to active this account
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light-secondary"
                                                                data-bs-dismiss="modal">
                                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Close</span>
                                                            </button>
                                                            <form method="POST" action="{{ route('admin.accounts.activate') }}">
                                                                @csrf
                                                                <input type="hidden" name="id" value="{{ $account->id }}">
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
                                        <button class="btn btn-danger "  data-bs-toggle="modal" data-bs-target="#danger{{ $account->id }}"><i class="fa fa-fw fa-ban"></i></button>
                                    </td>

                                            <!--Success theme Modal -->
                                            <div class="modal fade text-left" id="danger{{ $account->id }}" tabindex="-1" role="dialog"
                                                aria-labelledby="myModalLabel110" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                    role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-danger">
                                                            <h5 class="modal-title white" id="myModalLabel110">Account Inactive
                                                            </h5>
                                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                                <i data-feather="x"></i>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">

                                                                 Are you sure you want to inactive this account
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light-secondary"
                                                                data-bs-dismiss="modal">
                                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Close</span>
                                                            </button>
                                                            <form method="POST" action="{{ route('admin.accounts.deactivate') }}">
                                                                    @csrf
                                                                    <input type="hidden" name="id" value="{{ $account->id }}">
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
                            <p>{{ $accounts->appends(array_filter(Request::all()))->links( "pagination::bootstrap-5")}}</p>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


