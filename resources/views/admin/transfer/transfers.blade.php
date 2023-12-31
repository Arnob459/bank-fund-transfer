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
                                <th >@lang('Date')</th>
                                <th >@lang('Trx Number')</th>
                                <th >@lang('Username')</th>
                                <th >@lang('bank')</th>
                                <th >@lang('Amount')</th>
                                <th >@lang('Charge')</th>
                                <th >@lang('After Charge')</th>
                                <th >@lang('Payable')</th>
                                @if(request()->routeIs('admin.transfer.pending'))
                                    <th >@lang('Action')</th>
                                @elseif(request()->routeIs('admin.transfer.log') || request()->routeIs('admin.transfer.search')  || request()->routeIs('admin.users.transfer'))
                                    <th >@lang('Status')</th>
                                @endif

                                @if(request()->routeIs('admin.transfer.approved') || request()->routeIs('admin.transfer.rejected'))
                                    <th >@lang('Info')</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($transfers as $transfer)
                                <tr>
                                    <td>{{ show_datetime($transfer->created_at) }}</td>
                                    <td class="font-weight-bold">{{ strtoupper($transfer->trx) }}</td>
                                    <td><a href="{{route('admin.user.edit', $transfer->user_id)}}">{{ $transfer->user->username }}</a></td>
                                    <td>{{ $transfer->bank->name }}</td>
                                    <td class="budget font-weight-bold">{{ $transfer->amount +0 }} {{$gnl->cur_text}}</td>
                                    <td class="budget text-danger">{{$gnl->cur_sym}} {{ formatter_money($transfer->charge) }}</td>
                                    <td class="budget">{{$gnl->cur_sym}} {{ formatter_money($transfer->after_charge) }}</td>

                                    <td class="budget font-weight-bold">{{ formatter_money($transfer->final_amount) }} {{$gnl->cur_sym}} </td>
                                    @if(request()->routeIs('admin.transfer.pending'))
                                        <td>


                                            <button class="btn btn-primary viewBtn" data-detail="{{$transfer->detail}}" data-amount="{{ formatter_money($transfer->final_amount) }} {{$transfer->currency}}" data-method="{{$transfer->bank->name}}"><i class="fa fa-fw fa-desktop"></i></button>
                                            <button class="btn btn-success approveBtn"  data-id="{{ $transfer->id }}" data-amount="{{ formatter_money($transfer->final_amount) }} {{$transfer->currency}}"><i class="fa fa-fw fa-check"></i></button>
                                            <button class="btn btn-danger rejectBtn" data-id="{{ $transfer->id }}" data-amount="{{ formatter_money($transfer->final_amount) }} {{$transfer->currency}}"><i class="fa fa-fw fa-ban"></i></button>


                                        </td>
                                    @elseif(request()->routeIs('admin.transfer.log') || request()->routeIs('admin.transfer.search') || request()->routeIs('admin.users.transfer'))
                                        <td>
                                            @if($transfer->status == 2)
                                                <span class="badge bg-warning">@lang('Pending')</span>
                                            @elseif($transfer->status == 1)
                                                <span class="badge bg-success">@lang('Approved')</span>
                                            @elseif($transfer->status == 3)
                                                <span class="badge bg-danger">@lang('Rejected')</span>
                                            @endif
                                        </td>
                                    @endif


                                    @if(request()->routeIs('admin.transfer.approved') || request()->routeIs('admin.transfer.rejected'))

                                        <td>
                                            <button class="btn btn-primary detailsBtn" data-detail="{{$transfer->detail}}" data-amount="{{ formatter_money($transfer->final_amount) }} {{$transfer->currency}}" data-method="{{$transfer->bank->name}}" data-admin_details="{{$transfer->admin_feedback}}"><i class="fa fa-fw fa-desktop"></i></button>
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{ $empty_message }}</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        <ul class="pagination-overfollow">
                            <p>{{ $transfers->appends(array_filter(Request::all()))->links( "pagination::bootstrap-5")}}</p>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>



    {{-- Details MODAL --}}
    <div id="detailsModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('View transfer Details')</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>@lang('Request of ') <span class="font-weight-bold transfer-amount">-</span> @lang('via') <span class="font-weight-bold transfer-method">-</span></p>
                    <p class="transfer-detail"></p>
                    <p class="mt-3"> @lang('ADMIN RESPONSE WAS'): <br> <span class="admin-detail"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal">@lang('Close')</button>
                </div>
            </div>
        </div>
    </div>

    {{-- View MODAL --}}
    <div id="viewModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('View transfer Information')</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>@lang('Please Send') <span class="font-weight-bold transfer-amount">-</span> @lang('via') <span class="font-weight-bold transfer-method">-</span> @lang('to') :</p>
                    <p class="transfer-detail"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal">@lang('Close')</button>
                </div>
            </div>
        </div>
    </div>
    {{-- APPROVE MODAL --}}
    <div id="approveModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Approve transferal Confirmation')</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.transfer.approve') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <p>@lang('Have you Sent ')<span class="font-weight-bold transfer-amount text-success"></span>?</p>
                        <p class="transfer-detail"></p>
                        <textarea name="details" class="form-control pt-3" rows="3" placeholder="Provide the Details. eg: Transaction number" required=""></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">@lang('Close')</button>
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
                    <h5 class="modal-title">@lang('Reject transferal Confirmation')</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.transfer.reject') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <strong>@lang('Reason of Rejection')</strong>
                        <textarea name="details" class="form-control pt-3" rows="3" placeholder="Provide the Details" required=""></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">@lang('Close')</button>
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

        $('.viewBtn').on('click', function() {
            var modal = $('#viewModal');
            modal.find('.transfer-amount').text($(this).data('amount'));
            modal.find('.transfer-method').text($(this).data('bank'));

            var details =  Object.entries($(this).data('detail'));

            var list = [];
            details.map( function(item,i) {
                list[i] = ` <li class="list-group-item">${item[0]} : ${item[1]}</li>`
            });
            modal.find('.transfer-detail').html(list);
            modal.modal('show');
        });

        $('.detailsBtn').on('click', function() {
            var modal = $('#detailsModal');
            modal.find('.transfer-amount').text($(this).data('amount'));
            modal.find('.transfer-method').text($(this).data('bank'));

            var details =  Object.entries($(this).data('detail'));

            var list = [];
            details.map( function(item,i) {
                list[i] = ` <li class="list-group-item">${item[0]} : ${item[1]}</li>`
            });
            modal.find('.transfer-detail').html(list);
            modal.find('.admin-detail').text($(this).data('admin_details'));
            modal.modal('show');
        });
    </script>
@endpush
