@extends('users.master')

@section('content')

<div class="dashboard-hero-content text-white">
    <h3 class="title">{{ $page_title }}</h3>
    <ul class="breadcrumb">
        <li class="nav-item">  <a class="nav-link " href="index.html">Home</a> </li>
        <li>
            {{ $page_title }}
        </li>
    </ul>
</div>
</div>
<div class="container-fluid">
    <div class="operations">
        <h3 class="main-title">{{ $page_title }}</h3>

        <div class="table-wrapper">
            <table class="transaction-table" >
                <thead>
                    <tr>
                        <th scope="col">@lang('Transaction ID')</th>
                        <th scope="col">@lang('Amount')</th>
                        <th scope="col">@lang('Request From')</th>
                        <th scope="col">@lang('datetime')</th>
                        <th scope="col">@lang('Action')</th>
                    </tr>
                </thead>
                <tbody>

                    @if ($requests->count() == 0)
                        <tr>
                            <td class="text-center" colspan="5">
                                @lang('No data found')
                            </td>

                        </tr>
                    @endif

                    @foreach($requests as $request)
                        <tr>
                            <td class="">{{$request->trx}}</td>
                            <td class="">{{$request->final_amount}}</td>
                            <td class="">{{$request->user->username}}</td>
                            <td class="">{{ show_datetime($request->created_at) }}</td>

                            <td>
                                <button class="btn btn-success approveBtn"  data-id="{{ $request->id }}" data-amount="{{ formatter_money($request->final_amount) }} {{$gnl->cur_sym}}"><i class="fa fa-fw fa-check"></i></button><br>
                                <button class="btn btn-danger rejectBtn" data-id="{{ $request->id }}" data-amount="{{ formatter_money($request->final_amount) }} {{$gnl->cuur_sym}}"><i class="fa fa-fw fa-ban"></i></button>
                            </td>




                        </tr>
                    @endforeach
                    </tbody>
            </table>

            <ul class="pagination-overfollow">
                <p>{{ $requests->appends(array_filter(Request::all()))->links( "pagination::bootstrap-5")}}</p>
            </ul>
        </div>
    </div>

</div>

    {{-- APPROVE MODAL --}}
    <div id="approveModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Approve Request Confirmation')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('user.ownbank.request.approve') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <p>@lang('Sure! you want to Sent ')<span class="font-weight-bold transfer-amount text-success"></span>?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn-success">@lang('Approve')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- REJECT MODAL --}}
    <div id="rejectModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Reject request Confirmation')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('user.ownbank.request.reject') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <strong>@lang('Reject the request')</strong>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn-danger">@lang('Reject')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $('.approveBtn').on('click', function() {
            var modal = $('#approveModal');
            modal.find('input[name=id]').val($(this).data('id'));
            modal.find('.transfer-amount').text($(this).data('amount'));
            modal.modal('show');
        });

        $('.rejectBtn').on('click', function() {
            var modal = $('#rejectModal');
            modal.find('input[name=id]').val($(this).data('id'));
            modal.find('.transfer-amount').text($(this).data('amount'));
            modal.modal('show');
        });

    </script>
@endpush
