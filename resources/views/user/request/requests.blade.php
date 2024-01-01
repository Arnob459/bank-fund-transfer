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
          <h2 class="fw-400 mb-3">Requests</h2>

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
            <h3 class="text-5 fw-400 d-flex align-items-center px-4 mb-4">All Requests</h3>
            <!-- Title
            =============================== -->
            <div class="transaction-title py-2 px-4">
              <div class="row">
                <div class="col-2 col-sm-1 text-center"><span class="">Date</span></div>
                <div class="col col-sm-7">Description</div>
                <div class="col-auto col-sm-2 d-none d-sm-block text-center">Status</div>
                <div class="col-3 col-sm-2 text-end">Amount</div>
              </div>
            </div>
            <!-- Title End -->

            <!-- Transaction List
            =============================== -->
            @foreach ($requests as $request)

            <div class="transaction-list">

              <div class="transaction-item px-4 py-3" data-bs-toggle="modal" data-bs-target="#transaction-detail{{ $request->id }}">
                <div class="row align-items-center flex-row">
                  <div class="col-2 col-sm-1 text-center"> <span class="d-block text-4 fw-300">{{ \Carbon\Carbon::parse($request->created_at)->format('j M ') }}</span> </div>
                  <div class="col col-sm-7"> <span class="d-block text-4">{{ $request->user->username }}</span>
                 <span class="text-muted">Request from {{ $request->user->username }}</span> </div>
                 @if ($request->status == 2 || $request->status == 4)
                  <div class="col-auto col-sm-2 d-none d-sm-block text-center text-3"> <span class="text-warning" data-bs-toggle="tooltip" title="Pending"><i class="fas fa-ellipsis-h"></i></span> </div>
                @elseif ($request->status == 1)
                <div class="col-auto col-sm-2 d-none d-sm-block text-center text-3"> <span class="text-success" data-bs-toggle="tooltip" title="Completed"><i class="fas fa-check-circle"></i></span> </div>
                 @else
                 <div class="col-auto col-sm-2 d-none d-sm-block text-center text-3"> <span class="text-danger" data-bs-toggle="tooltip" title="Cancelled"><i class="fas fa-times-circle"></i></span> </div>
                 @endif
                  <div class="col-3 col-sm-2 text-end text-4"> <span class="text-nowrap"> {{ $gnl->cur_sym }}{{ formatter_money($request->amount) }}</span> <span class="text-2 text-uppercase">{{ $gnl->cur}}</span> </div>
                </div>
              </div>

            </div>

            <!-- Transaction List End -->

            <!-- Transaction Item Details Modal
            =========================================== -->
            <div id="transaction-detail{{ $request->id }}" class="modal fade" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered transaction-details" role="document">
                <div class="modal-content">
                  <div class="modal-body">
                    <div class="row g-0">
                      <div class="col-sm-5 d-flex justify-content-center bg-primary rounded-start py-4">
                        <div class="my-auto text-center">
                          <div class="text-17 text-white my-3"><i class="fas fa-building"></i></div>
                          <h3 class="text-4 text-white fw-400 my-3">{{ $request->user->username }}</h3>
                          <div class="text-8 fw-500 text-white my-4">{{ $gnl->cur_sym }}{{ formatter_money($request->amount) }}</div>
                          <p class="text-white">{{ \Carbon\Carbon::parse($request->created_at)->format('j M Y') }}</p>
                        </div>
                      </div>
                      <div class="col-sm-7">
                        <h5 class="text-5 fw-400 m-3">Transaction Details
                          <button type="button" class="btn-close text-2 float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                        </h5>
                        <hr>
                        <div class="px-3">
                          <ul class="list-unstyled">
                            <li class="mb-2">Request Amount
                                <span class="float-end text-3">{{ $gnl->cur_sym }}{{ formatter_money($request->amount) }}</span></li>
                            <li class="mb-2">Fee @if ($request->amount > $request->final_amount ) ({{ $request->user->username }} will pay the fee) @endif  <span class="float-end text-3">{{ $gnl->cur_sym }}{{ formatter_money($request->charge) }}</span></li>
                          </ul>
                          <hr class="mb-2">
                          <p class="d-flex align-items-center fw-500 mb-0">Total Amount <span class="text-3 ms-auto">{{ $gnl->cur_sym }} @if ($request->amount > $request->final_amount ) {{ formatter_money($request->amount) }} @else {{ formatter_money($request->final_amount) }} @endif </span></p>
						  <hr class="mb-4 mt-2">

                          <ul class="list-unstyled">
                            <li class="fw-500">Transaction ID:</li>
                            <li class="text-muted">{{ $request->trx }}</li>
                          </ul>

                          <ul class="list-unstyled">
                            <li class="fw-500">Status:</li>
                            @if ($request->status == 2 || $request->status == 4 )
                            <li class="text-muted">Pending<span class="text-warning text-3 ms-1"><i class="fas fa-ellipsis-h"></i></span></li>
                          @elseif ($request->status == 1)
                          <li class="text-muted">Completed<span class="text-success text-3 ms-1"><i class="fas fa-check-circle"></i></span></li>
                           @else
                           <li class="text-muted">Cancelled<span class="text-danger text-3 ms-1"><i class="fas fa-times-circle"></i></span></li>
                           @endif
                          </ul>

                          @if ($request->status == 2)
                          <ul class="list-unstyled">
                            <form action="{{ route('user.request.approve') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $request->id }}">
                                <div class="d-grid"><button class="btn btn-primary" type="submit">Accept</button></div>

                            </form>
                          </ul>
                          <ul class="list-unstyled">
                            <form action="{{ route('user.request.reject') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $request->id }}">
                            <div class="d-grid"><button class="btn btn-danger" type="submit">Reject</button></div>
                            </form>

                          </ul>
                          @endif

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Transaction Item Details Modal End -->
            @endforeach
            @if (count($requests) == 0)
            <div class="transaction-list">
                <div class="transaction-item px-4 py-3" >
                  <div class=" align-items-center ">
                    <div class=" text-center"> <span class="d-block text-4 fw-300">No Requests</span> </div>
                  </div>
                </div>
              </div>
            @endif


            <!-- Pagination
            ============================================= -->
            <ul class="justify-content-center mt-4 mb-0">
                {{$requests->links( "pagination::bootstrap-5")}}
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
