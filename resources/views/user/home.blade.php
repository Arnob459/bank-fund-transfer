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
            <div class="profile-thumb mt-3 mb-4"> <img class="rounded-circle" src="https://harnishdesign.net/demo/html/payyed/images/profile-thumb.jpg" alt="">
              <div class="profile-thumb-edit bg-primary text-white" data-bs-toggle="tooltip" title="Change Profile Picture"> <i class="fas fa-camera position-absolute"></i>
                <input type="file" class="custom-file-input" id="customFile">
              </div>
            </div>
            <p class="text-3 fw-500 mb-2">Hello, {{ auth()->user()->name }}</p>
            <p class="mb-2"><a href="https://harnishdesign.net/demo/html/payyed/settings-profile.html" class="text-5 text-light" data-bs-toggle="tooltip" title="Edit Profile"><i class="fas fa-edit"></i></a></p>
          </div>
          <!-- Profile Details End -->

          <!-- Available Balance
          =============================== -->
          <div class="bg-white shadow-sm rounded text-center p-3 mb-4">
            <div class="text-17 text-light my-3"><i class="fas fa-wallet"></i></div>
            <h3 class="text-9 fw-400">{{ $gnl->cur_sym }} {{ formatter_money(auth()->user()->balance) }} </h3>
            <p class="mb-2 text-muted opacity-8">Available Balance</p>
            <hr class="mx-n3">
            <div class="d-flex"><a href="https://harnishdesign.net/demo/html/payyed/withdraw-money.html" class="btn-link me-auto">Withdraw</a> <a href="https://harnishdesign.net/demo/html/payyed/deposit-money.html" class="btn-link ms-auto">Deposit</a></div>
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

          <!-- Profile Completeness
          =============================== -->
          <div class="bg-white shadow-sm rounded p-4 mb-4">
            <h3 class="text-5 fw-400 d-flex align-items-center mb-4">Profile Completeness<span class="border text-success rounded-pill fw-500 text-2 px-3 py-1 ms-2">50%</span></h3>
            <hr class="mb-4 mx-n4">
            <div class="row gy-4 profile-completeness">
              <div class="col-sm-6 col-md-3">
                <div class="border rounded text-center px-3 py-4"> <span class="d-block text-10 text-light mt-2 mb-3"><i class="fas fa-mobile-alt"></i></span> <span class="text-5 d-block text-success mt-4 mb-3"><i class="fas fa-check-circle"></i></span>
                  <p class="mb-0">Mobile Added</p>
                </div>
              </div>
              <div class="col-sm-6 col-md-3">
                <div class="border rounded text-center px-3 py-4"> <span class="d-block text-10 text-light mt-2 mb-3"><i class="fas fa-envelope"></i></span> <span class="text-5 d-block text-success mt-4 mb-3"><i class="fas fa-check-circle"></i></span>
                  <p class="mb-0">Email Added</p>
                </div>
              </div>
              <div class="col-sm-6 col-md-3">
                <div class="position-relative border rounded text-center px-3 py-4"> <span class="d-block text-10 text-light mt-2 mb-3"><i class="fas fa-credit-card"></i></span> <span class="text-5 d-block text-light mt-4 mb-3"><i class="far fa-circle "></i></span>
                  <p class="mb-0"><a class="btn-link stretched-link" href="#">Add Card</a></p>
                </div>
              </div>
              <div class="col-sm-6 col-md-3">
                <div class="position-relative border rounded text-center px-3 py-4"> <span class="d-block text-10 text-light mt-2 mb-3"><i class="fas fa-university"></i></span> <span class="text-5 d-block text-light mt-4 mb-3"><i class="far fa-circle "></i></span>
                  <p class="mb-0"><a class="btn-link stretched-link" href="#">Add Bank Account</a></p>
                </div>
              </div>
            </div>
          </div>
          <!-- Profile Completeness End -->

          <!-- Recent Activity
          =============================== -->
          <div class="bg-white shadow-sm rounded py-4 mb-4">
            <h3 class="text-5 fw-400 d-flex align-items-center px-4 mb-4">Recent Activity</h3>

            <!-- Title
            =============================== -->
            <div class="transaction-title py-2 px-4">
              <div class="row fw-00">
                <div class="col-2 col-sm-1 text-center"><span class="">Date</span></div>
                <div class="col col-sm-7">Description</div>
                <div class="col-auto col-sm-2 d-none d-sm-block text-center">Status</div>
                <div class="col-3 col-sm-2 text-end">Amount</div>
              </div>
            </div>
            <!-- Title End -->

            @foreach ($logs as $item)

            <div class="transaction-list">

              <div class="transaction-item px-4 py-3" data-bs-toggle="modal" data-bs-target="#transaction-detail{{ $item->id }}">
                <div class="row align-items-center flex-row">
                  <div class="col-2 col-sm-1 text-center"> <span class="d-block text-4 fw-300">{{ \Carbon\Carbon::parse($item->created_at)->format('j M ') }}</span> </div>
                  <div class="col col-sm-7"> <span class="d-block text-4">@if ($item->bank_type == 1){{ $item->bank->name }} @else{{ $item->receiver->username }}@endif</span>
                 <span class="text-muted">@if ($item->type == 0)
                     Request from {{ $item->receiver->username }}
                 @else
                     Send to @if ($item->bank_type == 1){{ $item->bank->name }}@else {{ $item->receiver->username }} @endif
                 @endif</span> </div>
                 @if ($item->status == 2)
                  <div class="col-auto col-sm-2 d-none d-sm-block text-center text-3"> <span class="text-warning" data-bs-toggle="tooltip" title="In Progress"><i class="fas fa-ellipsis-h"></i></span> </div>
                @elseif ($item->status == 1)
                <div class="col-auto col-sm-2 d-none d-sm-block text-center text-3"> <span class="text-success" data-bs-toggle="tooltip" title="Completed"><i class="fas fa-check-circle"></i></span> </div>
                 @else
                 <div class="col-auto col-sm-2 d-none d-sm-block text-center text-3"> <span class="text-danger" data-bs-toggle="tooltip" title="Cancelled"><i class="fas fa-times-circle"></i></span> </div>
                 @endif
                  <div class="col-3 col-sm-2 text-end text-4"> <span class="text-nowrap"> {{ $gnl->cur_sym }}{{ formatter_money($item->amount) }}</span> <span class="text-2 text-uppercase">{{ $gnl->cur}}</span> </div>
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
                          <p class="text-white">{{ \Carbon\Carbon::parse($item->created_at)->format('j M Y') }}</p>
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
                          <ul class="list-unstyled">
                            <li class="fw-500">Status:</li>
                            @if ($item->status == 2)
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

            <!-- View all Link
            =============================== -->
            <div class="text-center mt-4"><a href="{{ route('user.transections') }}" class="btn-link text-3">View all<i class="fas fa-chevron-right text-2 ms-2"></i></a></div>
            <!-- View all Link End -->

          </div>
          <!-- Recent Activity End -->
        </div>
        <!-- Middle Panel End -->
      </div>
    </div>
  </div>
  <!-- Content end -->

  <!-- Footer
  ============================================= -->

    @endsection