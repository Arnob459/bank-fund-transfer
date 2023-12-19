@extends('admin.layouts.master')

@push('button')
<a href="{{ route('admin.banks.create') }}" class="btn btn-warning ">Add New Bank</a>
@endpush

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{$page_title}}</h4>
                </div>
                <div class="card-body">
                        <table class="table table-hover table-responsive" id="table1">
                            <thead>
                            <tr>
                                <th>@lang('Sl')</th>
                                <th>@lang('Image')</th>
                                <th>@lang('Bank')</th>
                                <th>@lang('Status')</th>
                                <th>@lang('Action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($banks as $key=> $bank)
                                <tr>
                                    <td>
                                        {{ $key+1 }}
                                    </td>
                                    <td>
                                        <div class="avatar">
                                            <img src="{{asset('assets/images/banks/'.$bank->image)}}" alt="..." class="avatar-img rounded-circle">
                                        </div>
                                    </td>
                                    <td>{{ $bank->name }} @if ($bank->primary == 1)
                                    <span class="badge rounded-pill bg-primary">@lang('primary')</span>@endif  </td>
                                    <td>
                                        @if($bank->status == 1)
                                        <span class="badge rounded-pill bg-success">@lang('active')</span>
                                        @else
                                            <span class="badge rounded-pill bg-danger">@lang('disabled')</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-secondary btn-sm"
                                           href="{{ route('admin.banks.edit', $bank->id) }}">
                                            <span class="btn-label"><i class="fas fa-edit"></i></span>@lang('Edit')</a>
                                        @if($bank->status == 0)
                                            <button class="btn btn-success btn-sm"
                                            data-bs-toggle="modal" data-bs-target="#deactivateModal{{ $bank->id }}" >
                                                <span class="btn-label"><i class="fas fa-eye"></i></span>
                                                @lang('Active')
                                            </button>
                                        @else
                                            <button class="btn btn-danger btn-sm"
                                            data-bs-toggle="modal" data-bs-target="#activateModal{{ $bank->id }}" >
                                                <span class="btn-label"><i class="fas fa-eye-slash"></i></span>
                                                @lang('Disable')
                                            </button>
                                        @endif
                                    </td>

                                </tr>
                                    {{-- activate modal --}}
                                        <div class="modal fade" id="activateModal{{ $bank->id }}" tabindex="-1" role="dialog" aria-labelledby="activateModalLabel{{ $bank->id }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="activateModalLabel{{ $bank->id }}">Payment Method Disable!!</h5>
                                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure want to disable {{ $bank->name }} ?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">NO</button>
                                                        <form method="POST" action="{{ route('admin.banks.deactivate') }}">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ $bank->id }}">
                                                            <button type="submit" class="btn btn-success">YES</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    {{-- modal --}}
                                    {{-- deactivate modal --}}
                                        <div class="modal fade" id="deactivateModal{{ $bank->id }}" tabindex="-1" role="dialog" aria-labelledby="deactivateModalLabel{{ $bank->id }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deactivateModalLabel{{ $bank->id }}">Bank Activation!!</h5>
                                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure to activate {{ $bank->name }} ?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">NO</button>
                                                        <form method="POST" action="{{ route('admin.banks.activate') }}">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ $bank->id }}">
                                                            <button type="submit" class="btn btn-success">YES</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    {{-- modal --}}
                            @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>

    @push('datatable')
<script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
<script src="{{ asset('assets/admin/js/pages/datatables.js') }}"></script>
@endpush

@endsection

