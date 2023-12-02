@extends('admin.layouts.master')

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
                                <th>@lang('Gateway')</th>
                                <th>@lang('Status')</th>
                                <th>@lang('Action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($gateways as $key=> $gateway)
                                <tr>
                                    <td>
                                        {{ $key+1 }}
                                    </td>
                                    <td>
                                        <div class="avatar">
                                            <img src="{{asset('assets/images/gateway/'.$gateway->image)}}" alt="..." class="avatar-img rounded-circle">
                                        </div>
                                    </td>
                                    <td>{{ $gateway->name }}</td>
                                    <td>
                                        @if($gateway->status == 1)
                                        <span class="badge rounded-pill bg-success">@lang('active')</span>
                                        @else
                                            <span class="badge rounded-pill bg-danger">@lang('disabled')</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-secondary btn-sm"
                                           href="{{ route('admin.deposit.gateway.edit', $gateway->code) }}">
                                            <span class="btn-label"><i class="fas fa-edit"></i></span>@lang('Edit')</a>
                                        @if($gateway->status == 0)
                                            <button class="btn btn-success btn-sm"
                                            data-bs-toggle="modal" data-bs-target="#deactivateModal{{ $gateway->code }}" >
                                                <span class="btn-label"><i class="fas fa-eye"></i></span>
                                                @lang('Active')
                                            </button>
                                        @else
                                            <button class="btn btn-danger btn-sm"
                                            data-bs-toggle="modal" data-bs-target="#activateModal{{ $gateway->code }}" >
                                                <span class="btn-label"><i class="fas fa-eye-slash"></i></span>
                                                @lang('Disable')
                                            </button>
                                        @endif
                                    </td>

                                </tr>
                                    {{-- activate modal --}}
                                        <div class="modal fade" id="activateModal{{ $gateway->code }}" tabindex="-1" role="dialog" aria-labelledby="activateModalLabel{{ $gateway->code }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="activateModalLabel{{ $gateway->code }}">Payment Method Disable!!</h5>
                                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure want to disable {{ $gateway->name }} ?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">NO</button>
                                                        <form method="POST" action="{{ route('admin.deposit.gateway.deactivate') }}">
                                                            @csrf
                                                            <input type="hidden" name="code" value="{{ $gateway->code }}">
                                                            <button type="submit" class="btn btn-success">YES</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    {{-- modal --}}
                                    {{-- deactivate modal --}}
                                        <div class="modal fade" id="deactivateModal{{ $gateway->code }}" tabindex="-1" role="dialog" aria-labelledby="deactivateModalLabel{{ $gateway->code }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deactivateModalLabel{{ $gateway->code }}">Payment Method Activation!!</h5>
                                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure to activate {{ $gateway->name }} ?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">NO</button>
                                                        <form method="POST" action="{{ route('admin.deposit.gateway.activate') }}">
                                                            @csrf
                                                            <input type="hidden" name="code" value="{{ $gateway->code }}">
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

