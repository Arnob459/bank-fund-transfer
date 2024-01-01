@extends('user.master')

@section('content')
 <!-- Content
  ============================================= -->
  <div id="content" class="py-4">
    <div class="container">
      <div class="row">

        <!-- Left Panel
        ============================================= -->
        <aside class="col-lg-3">

            <!-- Profile Details
            =============================== -->
            <div class="bg-white shadow-sm rounded text-center p-3 mb-4">
              <div class="profile-thumb mt-3 mb-4">
                @if (auth()->user()->avatar == null)
                <img class="rounded-circle" src="{{asset('assets/images/users/2.jpg')}}" alt="">
                @else
                <img class="rounded-circle" src="{{asset('assets/images/users/'.auth()->user()->avatar)}}" alt="">
            @endif
            @if (auth()->user()->kyc_verify == 1)
            <div class="profile-thumb-edit bg-primary text-white" data-bs-toggle="tooltip" title="Verified"> <i class="fas fa-check position-absolute"></i>
            </div>
            @endif
              </div>
              <p class="text-3 fw-500 mb-2">Hello, {{ auth()->user()->username }}</p>
              <p class="mb-2"><a href="{{ route('user.profile') }}" class="text-5 text-light" data-bs-toggle="tooltip" title="Edit Profile"><i class="fas fa-edit"></i></a></p>
            </div>
            <!-- Profile Details End -->

            <!-- Available Balance
            =============================== -->
            <div class="bg-white shadow-sm rounded text-center p-3 mb-4">
              <div class="text-17 text-light my-3"><i class="fas fa-wallet"></i></div>
              <h3 class="text-9 fw-400">{{ $gnl->cur_sym }} {{ formatter_money(auth()->user()->balance) }} </h3>
              <p class="mb-2 text-muted opacity-8">Available Balance</p>
            </div>
            <!-- Available Balance End -->

            <!-- Need Help?
            =============================== -->
            <div class="bg-white shadow-sm rounded text-center p-3 mb-4">
              <div class="text-17 text-light my-3"><i class="fas fa-comments"></i></div>
              <h3 class="text-5 fw-400 my-4">Need Help?</h3>
              <p class="text-muted opacity-8 mb-4">Have questions or concerns regrading your account?<br>
                Our experts are here to help!.</p>
              <div class="d-grid"><a href="#" class="btn btn-primary">Chate with Us</a></div>
            </div>
            <!-- Need Help? End -->

          </aside>
        <!-- Left Panel End -->

        <!-- Middle Panel
        ============================================= -->
        <div class="col-lg-9">
          <h2 class="fw-400 mb-3">Transactions</h2>

          <!-- Filter
          ============================================= -->
          <div class="row">
            <div class="col mb-2">
              <form id="filterTransactions" method="post">
                <div class="row g-3 mb-3">
                  <!-- Date Range
                  ========================= -->
                  <div class="col-sm-6 col-md-5">
                    <div class="position-relative">
					<input id="dateRange" type="text" class="form-control" placeholder="Date Range">
                    <span class="icon-inside"><i class="fas fa-calendar-alt"></i></span>
					</div>
				  </div>

                </div>
              </form>
            </div>
          </div>
          <!-- Filter End -->

          <!-- All Transactions
          ============================================= -->
          <div class="bg-white shadow-sm rounded py-4 mb-4">
            <h3 class="text-5 fw-400 d-flex align-items-center px-4 mb-4">All Transactions</h3>
            <!-- Title
            =============================== -->
            <div class="transaction-title py-2 px-4">
              <div class="row">
                <div class="col-2 col-sm-2 text-center"><span class="">Date</span></div>
                <div class="col col-sm-3">Description</div>
                <div class="col-auto col-sm-4 d-none d-sm-block text-center">Status</div>
                <div class="col col-sm-2 text-end">Amount</div>
              </div>
            </div>
            <!-- Title End -->

            <!-- Transaction List
            =============================== -->

            @foreach ($logs as $item)

            <div class="transaction-list">

              <div class="transaction-item px-4 py-3" data-bs-toggle="modal" data-bs-target="#transaction-detail{{ $item->id }}">
                <div class="row align-items-center flex-row">
                  <div class="col-2 col-sm-2 text-center"> <span class="d-block text-4 fw-300">{{ \Carbon\Carbon::parse($item->created_at)->format('j M Y H:i:s') }}</span> </div>
                  <div class="col col-sm-3"> <span class="d-block text-4">@if ($item->bank_type == 1){{ $item->bank->name }} @else{{ $item->receiver->username }}@endif</span>
                 <span class="text-muted">@if ($item->type == 0)
                     Request from {{ $item->receiver->username }}
                 @else
                     Send to @if ($item->bank_type == 1){{ $item->bank->name }}@else {{ $item->receiver->username }} @endif
                 @endif</span> </div>
                 @if ($item->status == 2 || $item->status == 4)
                 <div class="col-auto col-sm-4 d-none d-sm-block text-center text-3"> <span class="badge bg-warning text-dark text-0 fw-500 rounded-pill px-2 mb-0 ">in Process</span>  <span class="text-warning" data-bs-toggle="tooltip" title="In Progress"><i class="fas fa-ellipsis-h"></i></span> </div>
               @elseif ($item->status == 1)
               <div class="col-auto col-sm-4 d-none d-sm-block text-center text-3"> <span class="badge bg-success text-dark text-0 fw-500 rounded-pill px-2 mb-0 ">Completed</span> <span class="text-success" data-bs-toggle="tooltip" title="Completed"><i class="fas fa-check-circle"></i></span> </div>
                @else
                <div class="col-auto col-sm-4 d-none d-sm-block text-center text-3"> <span class="badge bg-danger text-dark text-0 fw-500 rounded-pill px-2 mb-0 ">Cancelled</span> <span class="text-danger" data-bs-toggle="tooltip" title="Cancelled"><i class="fas fa-times-circle"></i></span> </div>
                @endif
                  <div class="col col-sm-2 text-end text-4"> <span class="text-nowrap"> {{ $gnl->cur_sym }}{{ formatter_money($item->amount) }}</span> <span class="text-2 text-uppercase">{{ $gnl->cur}}</span> </div>
                </div>
              </div>

            </div>

            <!-- Transaction List End -->

            <!-- Transaction Item Details Modal
            =========================================== -->
            <div id="transaction-detail{{ $item->id }}" class="modal fade" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered transaction-details" role="document">
                <div class="modal-content">
                  <div class="modal-body">
                    <div class="row g-0">
                      <div class="col-sm-5 d-flex justify-content-center bg-primary rounded-start py-4">
                        <div class="my-auto text-center">
                          <div class="text-17 text-white my-3"><i class="fas fa-building"></i></div>
                          <h3 class="text-4 text-white fw-400 my-3">@if ($item->bank_type == 1){{ $item->bank->name }} @else{{ $item->receiver->username }}@endif</h3>
                          <div class="text-8 fw-500 text-white my-4">{{ $gnl->cur_sym }}{{ formatter_money($item->amount) }}</div>
                          <p class="text-white">{{ \Carbon\Carbon::parse($item->created_at)->format('j M Y H:i:s') }}</p>
                        </div>
                      </div>
                      <div class="col-sm-7">
                        <h5 class="text-5 fw-400 m-3">Transaction Details
                          <button type="button" class="btn-close text-2 float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                        </h5>
                        <hr>
                        <div class="px-3">
                          <ul class="list-unstyled">
                            <li class="mb-2">@if ($item->type == 0)Request  @else Send  @endif Amount
                                <span class="float-end text-3">{{ $gnl->cur_sym }}{{ formatter_money($item->amount) }}</span></li>
                            <li class="mb-2">Fee @if ($item->final_amount > $item->amount ) ({{ $item->receiver->username }} will pay the fee) @endif
                                <span class="float-end text-3">-{{ $gnl->cur_sym }}{{ formatter_money($item->charge) }}</span></li>
                          </ul>
                          <hr class="mb-2">
                          <p class="d-flex align-items-center fw-500 mb-0">Total Amount <span class="text-3 ms-auto">{{ $gnl->cur_sym }} @if ($item->final_amount > $item->amount ) {{ formatter_money($item->amount) }} @else {{ formatter_money($item->final_amount) }} @endif</span></p>
						  <hr class="mb-4 mt-2">

                          <ul class="list-unstyled">
                            <li class="fw-500">Transaction ID:</li>
                            <li class="text-muted">{{ $item->trx }}</li>
                          </ul>
                          <ul class="list-unstyled">
                            <li class="fw-500">Description:</li>
                            @if ($item->detail == Null)
                              <li class="text-muted">{{ $item->receiver->username }} </li>
                              <li class="text-muted">{{ $item->receiver->name }} </li>
                              <li class="text-muted">{{ $item->receiver->email }} </li>

                            @else

                            @foreach(json_decode($item->detail) as $key => $data)
                            <li class="text-muted">{{ $key }}: {{ $data }} </li>
                          @endforeach
                            @endif
                          </ul>
                          @if ($item->status == 3)
                          <ul class="list-unstyled">
                            <li class="fw-500">Admin Feedback:</li>
                            <li class="text-muted">{{ $item->admin_feedback }}</li>
                          </ul>
                          @endif

                          <ul class="list-unstyled">
                            <li class="fw-500">Status:</li>
                            @if ($item->status == 2 || $item->status == 4)
                            <li class="text-muted">in Process<span class="text-warning text-3 ms-1"><i class="fas fa-ellipsis-h"></i></span></li>
                          @elseif ($item->status == 1)
                          <li class="text-muted">Completed<span class="text-success text-3 ms-1"><i class="fas fa-check-circle"></i></span></li>
                           @else
                           <li class="text-muted">Cancelled<span class="text-danger text-3 ms-1"><i class="fas fa-times-circle"></i></span></li>
                           @endif

                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Transaction Item Details Modal End -->
            @endforeach
            @if (count($logs) == 0)
            <div class="transaction-list">
                <div class="transaction-item px-4 py-3" >
                  <div class=" align-items-center ">
                    <div class=" text-center"> <span class="d-block text-4 fw-300">No Transections</span> </div>
                  </div>
                </div>
              </div>
            @endif




            <!-- Pagination
            ============================================= -->
            <ul class="justify-content-center mt-4 mb-0">
                {{$logs->links( "pagination::bootstrap-5")}}
            </ul>
            <!-- Paginations end -->

          </div>
          <!-- All Transactions End -->

        </div>
        <!-- Middle End -->
      </div>
    </div>
  </div>
  <!-- Content end -->
@endsection
