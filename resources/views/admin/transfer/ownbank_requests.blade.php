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
                                <th scope="col">Trx Number</th>
                                <th scope="col">Sender</th>
                                <th scope="col">Receiver</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Charge</th>
                                <th scope="col">After Charge</th>
                                <th scope="col">Payable</th>

                                <th scope="col">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($transfers as $transfer)
                                <tr>
                                    <td>{{ show_datetime($transfer->created_at) }}</td>
                                    <td class="font-weight-bold">{{ strtoupper($transfer->trx) }}</td>
                                    <td><a href="{{route('admin.user.edit', $transfer->user_id)}}">{{ $transfer->user->username }}</a></td>
                                    <td><a href="{{route('admin.user.edit', $transfer->receiver_id)}}">{{ $transfer->receiver->username }}</a></td>
                                    <td class="budget font-weight-bold">{{ $transfer->amount +0 }} {{$gnl->cur_sym}}</td>
                                    <td class="budget text-danger">{{$gnl->cur_sym}} {{ formatter_money($transfer->charge) }}</td>
                                    <td class="budget">{{$gnl->cur_sym}} {{ formatter_money($transfer->after_charge) }}</td>

                                    <td class="budget font-weight-bold">{{ formatter_money($transfer->final_amount) }} {{$gnl->cur_sym}} </td>

                                    <td>
                                        @if($transfer->status == 2)
                                            <span class="badge bg-warning">@lang('Pending')</span>
                                        @elseif($transfer->status == 1)
                                            <span class="badge bg-success">@lang('Approved')</span>
                                        @elseif($transfer->status == 3)
                                            <span class="badge bg-danger">@lang('Rejected')</span>
                                        @endif
                                    </td>



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




@endsection


