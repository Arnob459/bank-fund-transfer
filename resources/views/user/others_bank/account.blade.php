@extends('user.master')
@section('content')
<div class="col-lg-12">

              <!-- Credit or Debit Cards
          ============================================= -->
          <div class="bg-white shadow-sm rounded p-4 mb-4">
            <h3 class="text-5 fw-400 mb-4">Credit or Debit Cards</h3>
            <hr class="mb-4 mx-n4">
            <div class="row g-3">
              @foreach ($cards as $card)

              <div class="col-12 col-md-3 col-lg-3">
                <div class="account-card text-white rounded p-3">
                  <p class="text-4">{{ $card->card_number }}</p>
                  <p class="d-flex align-items-center"> <span class="account-card-expire text-uppercase d-inline-block opacity-7 me-2">Valid<br>
                    thru<br>
                    </span> <span class="text-4 opacity-9">{{ $card->expiry_date }}</span> @if ($card->status == 0)
                    <span class="badge bg-warning text-dark text-0 fw-500 rounded-pill px-2 ms-auto">pending</span>
                    @elseif ($card->status == 2)
                    <span class="badge bg-danger text-dark text-0 fw-500 rounded-pill px-2 ms-auto">Inactive</span>
                    @endif </p>
                  <p class="d-flex align-items-center m-0"> <span class="text-uppercase fw-500">{{ $card->user->name }}</span> <img class="ms-auto" src="{{ asset('assets/images/card/'.$card->cardType->image) }}"  title=""> </p>
                  <div class="account-card-overlay rounded">  <a href="#" data-bs-target="#edit-card-details{{ $card->card_number }}" data-bs-toggle="modal" class="text-light btn-link mx-2"><span class="me-1"><i class="fas fa-minus-circle"></i></span>Delete</a> </div>
                </div>
              </div>

                        <!-- Edit Card Details Modal
          ================================== -->
          <div id="edit-card-details{{ $card->card_number }}" class="modal fade" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title fw-400">Delete Card</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">

                    <div class="mb-3">
                      <label for="edircardNumber" class="form-label">Card Number</label>
                      <div class="input-group">
                        <span class="input-group-text"><img class="ms-auto" src="{{ asset('assets/images/card/'.$card->cardType->image) }}" alt="visa" title=""></span>
                        <input type="text" class="form-control" data-bv-field="edircardNumber" id="edircardNumber" disabled value="{{ $card->card_number }}" placeholder="Card Number">
                      </div>
                    </div>
                    <div class="row g-3 mb-3">
                      <div class="col-lg-6">
                          <label for="editexpiryDate" class="form-label">Expiry Date</label>
                          <input id="editexpiryDate" type="text" class="form-control" data-bv-field="editexpiryDate" disabled value="{{ $card->expiry_date }}" placeholder="MM/YY">
                      </div>
                      <div class="col-lg-6">
                          <label for="editcvvNumber" class="form-label">Status </label>
                          <input id="editcvvNumber" type="text" class="form-control" data-bv-field="editcvvNumber" disabled  @if ($card->status == 0)value="Pending" @elseif ($card->status == 1)value="Active" @else value="Inactive"@endif  >
                      </div>
                    </div>
                    <div class="mb-3">
                      <label for="editcardHolderName" class="form-label">Card Holder Name</label>
                      <input type="text" class="form-control" data-bv-field="editcardHolderName" id="editcardHolderName" disabled value="{{ $card->user->name }}" >
                    </div>
                    <form id="updateCard" method="POST" action="{{ route('user.card.destroy', $card->id) }}">
                        @csrf
                        @method('DELETE')
                    <div class="d-grid mt-4"><button class="btn btn-danger" type="submit">Delete Card</button></div>
                  </form>
                </div>
              </div>
            </div>
          </div>
              @endforeach


              <div class="col-12 col-md-3 col-lg-3"> <a href="" data-bs-target="#add-new-card-details" data-bs-toggle="modal" class="account-card-new d-flex align-items-center rounded h-100 p-3 mb-4 mb-lg-0">
                <p class="w-100 text-center lh-base m-0"> <span class="text-3"><i class="fas fa-plus-circle"></i></span> <span class="d-block text-body text-3">Request New Card</span> </p>
                </a> </div>
            </div>
          </div>

          <!-- Add New Card Details Modal
          ================================== -->
          <div id="add-new-card-details" class="modal fade" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title fw-400">Request a Card</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                  <form id="addCard" method="post" action="{{ route('user.card.store') }}">
                    @csrf

					<div class="btn-group d-flex mb-3" role="group">
                      <input type="radio" class="btn-check" name="options" value="1" id="option1" autocomplete="off" checked>
					  <label class="btn btn-outline-secondary btn-sm shadow-none w-100" for="option1">Debit</label>

					  <input type="radio" class="btn-check" name="options" value="2" id="option2" autocomplete="off">
                      <label class="btn btn-outline-secondary btn-sm shadow-none w-100" for="option2">Credit</label>
                    </div>
                    <div class="row g-3">
					<div class="col-12">
                      <label for="cardType" class="form-label">Card Type</label>
                      <select id="cardType" class="form-select" required name="card_type_id">
                        <option value="">Select Card Type</option>

                        @foreach ($card_types as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>

                        @endforeach
                      </select>
                    </div>

                    <div class="col-12 d-grid mt-4">
					  <button class="btn btn-primary" type="submit">Add Card</button>
					</div>
					</div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- Credit or Debit Cards End -->

    <!-- Bank Accounts
    ============================================= -->
    <div class="bg-white shadow-sm rounded p-4 mb-4">
      <h3 class="text-5 fw-400 mb-4">Bank Accounts </h3>
      <hr class="mb-4 mx-n4">
      <div class="row g-3">

        <div class="col-12 col-md-4">
            <div class="account-card account-card-primary text-white rounded">
              <div class="row g-0">
                <div class="col-3 d-flex justify-content-center p-3">
                  <div class="my-auto text-center">
                    <img  src="{{ asset('assets/images/banks/'.$primary_bank_account->bank->image) }}" alt="" style="max-width: 50px; max-height: 50px;">
                    <p class="badge bg-warning text-dark text-0 fw-500 rounded-pill px-2 mb-0">Primary</p>
                  </div>
                </div>
                <div class="col-9 border-start">
                <div class="py-4 my-2 ps-4">
                    <p class="text-4 fw-500 mb-1">{{ $primary_bank_account->bank->name }}</p>
                    <p class="text-4 opacity-9 mb-1">{{ $primary_bank_account->user->name }}</p>

                    <p class="text-4 opacity-9 mb-1">{{ $primary_bank_account->account_number }}</p>
                    <p class="m-0">Approved <span class="text-3"><i class="fas fa-check-circle"></i></span></p>
                  </div>
                </div>
              </div>
              <div class="account-card-overlay rounded"> <a href="#" data-bs-target="#primary-bank-account-details" data-bs-toggle="modal" class="text-light btn-link mx-2"><span class="me-1"><i class="fas fa-share"></i></span>More Details</a>  </div>
            </div>
          </div>

        @foreach ($accounts as $account)
        <div class="col-12 col-md-4">
            <div class="account-card account-card-primary text-white rounded">
              <div class="row g-0">
                <div class="col-3 d-flex justify-content-center p-3">
                  <div class="my-auto text-center">
                    <img  src="{{ asset('assets/images/banks/'.$account->bank->image) }}" alt="" style="max-width: 50px; max-height: 50px;">

                  </div>
                </div>
                <div class="col-9 border-start">
                <div class="py-4 my-2 ps-4">
                    <p class="text-4 fw-500 mb-1">{{ $account->bank->name }}</p>
                    <p class="text-4 opacity-9 mb-1">{{ $account->user->name }}</p>
                    <p class="text-4 opacity-9 mb-1">{{ $account->account_number }}</p>


                    @if ($account->status == 1 )
                    <p class="m-0">Approved <span class="text-3"><i class="fas fa-check-circle"></i></span></p>
                    @elseif ($account->status == 0 )
                    <p class="m-0">Pending <span class="text-3"><i class="fas fa-ellipsis-h"></i></span></p>
                    @else
                    <p class="m-0">Rejected <span class="text-3"><i class="fas fa-times-circle"></i></span></p>
                    @endif

                  </div>
                </div>
              </div>
              <div class="account-card-overlay rounded"> @if ($account->status == 1 )<a href="#" data-bs-target="#bank-account-details{{$account->id}}" data-bs-toggle="modal" class="text-light btn-link mx-2"><span class="me-1"><i class="fas fa-share"></i></span>More Details</a>@endif <a href="#" data-bs-target="#bank-account-delete{{$account->id}}" data-bs-toggle="modal"  class="text-light btn-link mx-2"><span class="me-1"><i class="fas fa-minus-circle"></i></span>Delete</a> </div>

            </div>
          </div>
              <!-- Edit Bank Account Details Modal
    ======================================== -->
    <div id="bank-account-details{{$account->id}}" class="modal fade" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered transaction-details" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <div class="row g-0">
              <div class="col-sm-5 d-flex justify-content-center bg-primary rounded-start py-4">
                <div class="my-auto text-center">
                  <img  src="{{ asset('assets/images/banks/'.$account->bank->image) }}" alt="" style="max-width: 50px; max-height: 50px;">
                  <h3 class="text-6 text-white my-3">{{ $account->bank->name }}</h3>
                  <div class="text-4 text-white my-4">{{ $account->bank->routing_number }}</div>
                </div>
              </div>
              <div class="col-sm-7">
                <h5 class="text-5 fw-400 m-3">Bank Account Details
                  <button type="button" class="btn-close text-2 float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                </h5>
                <hr>
                <div class="px-3 mb-3">
                  <ul class="list-unstyled">
                    <li class="fw-500">Account Type:</li>
                    @if ($account->type == 0)
                    <li class="text-muted">Personal</li>
                      @else
                    <li class="text-muted">Business</li>
                    @endif
                  </ul>



                  <ul class="list-unstyled">
                    <li class="fw-500">Account No:</li>
                    <li class="text-muted"> {{ $account->account_number }}</li>
                  </ul>

                  <ul class="list-unstyled">
                    <li class="fw-500">Branch:</li>
                    <li class="text-muted"> {{ $account->branch->name }}</li>
                  </ul>

                  <ul class="list-unstyled">
                    <li class="fw-500">Status:</li>
                    <li class="text-muted">Approved <span class="text-success text-3"><i class="fas fa-check-circle"></i></span></li>
                  </ul>


                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

        {{-- //delete --}}
        <div id="bank-account-delete{{$account->id}}" class="modal fade" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered transaction-details" role="document">
            <div class="modal-content">
              <div class="modal-body">
                <div class="row g-0">
                  <div class="col-sm-5 d-flex justify-content-center bg-primary rounded-start py-4">
                    <div class="my-auto text-center">
                      <img  src="{{ asset('assets/images/banks/'.$account->bank->image) }}" alt="" style="max-width: 50px; max-height: 50px;">
                      <h3 class="text-6 text-white my-3">{{ $account->bank->name }}</h3>
                      <div class="text-4 text-white my-4">{{ $account->bank->routing_number }}</div>
                    </div>
                  </div>
                  <div class="col-sm-7">
                    <h5 class="text-5 fw-400 m-3">Bank Account Details
                      <button type="button" class="btn-close text-2 float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                    </h5>
                    <hr>
                    <div class="px-3 mb-3">
                      <ul class="list-unstyled">
                        <li class="fw-500">Account Type:</li>
                        @if ($account->type == 0)
                        <li class="text-muted">Personal</li>
                          @else
                        <li class="text-muted">Business</li>
                        @endif
                      </ul>


                      <ul class="list-unstyled">
                        <li class="fw-500">Account No:</li>
                        <li class="text-muted"> {{ $account->account_number }}</li>
                      </ul>

                      <ul class="list-unstyled">
                        <li class="fw-500">Branch:</li>
                        <li class="text-muted"> {{ $account->branch->name }}</li>
                      </ul>

                      <ul class="list-unstyled">
                        <li class="fw-500">Status:</li>
                      @if ($account->status == 1)
                        <li class="text-muted">Approved <span class="text-success text-3"><i class="fas fa-check-circle"></i></span></li>
                        @elseif ($account->status == 0)
                        <li class="text-muted">Pending <span class="text-warning text-3"><i class="fas fa-ellipsis-h"></i></span></li>
                        @else
                        <li class="text-muted">Rejected <span class="text-danger text-3"><i class="fas fa-times-circle"></i></span></li>


                      @endif

                      </ul>

                      <ul class="list-unstyled">
                        <form method="POST" action="{{ route('user.account.destroy', $account->id) }}">
                            @csrf
                            @method('DELETE')
                            <div class="d-grid"><button type="submit" class="btn btn-sm btn-outline-danger shadow-none"><span class="me-1"><i class="fas fa-minus-circle"></i></span>Delete</button></div>
                        </form>
                     </ul>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        @endforeach

        <div class="col-12 col-md-4"> <a href="" data-bs-target="#add-new-bank-account" data-bs-toggle="modal" class="account-card-new d-flex align-items-center rounded h-100 p-3 mb-4 mb-lg-0">
          <p class="w-100 text-center lh-base m-0"> <span class="text-3"><i class="fas fa-plus-circle"></i></span> <span class="d-block text-body text-3">Request for New Bank Account</span> </p>
          </a> </div>
      </div>
    </div>

    <!-- Add New Bank Account Details Modal
    ======================================== -->
    <div id="add-new-bank-account" class="modal fade" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title fw-400">Request for new bank account</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body p-4">
            <form id="addbankaccount" method="post" action="{{ route('user.account.store') }}">
                @csrf
              <div class="mb-3">
                <div class="form-check form-check-inline">
                  <input class="form-check-input"  id="personal" name="account_type" value="0" checked="" required type="radio">
                  <label class="form-check-label" for="personal">Personal</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" id="business" name="account_type" value="1" required type="radio">
                  <label class="form-check-label" for="business">Business</label>
                </div>
              </div>

                <div class="mb-3">
                    <label for="bankSelect" class="form-label">Bank Name</label>
                    <select class="form-select" id="bankSelect" onchange="showBankFields()" name="bank_id" >
                    <option value="">Select Bank</option>

                    @foreach ($bankData as $bank)
                    <option value="{{ $bank->id }}">{{ $bank->name }}</option>

                    @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="branchSelect" class="form-label">Branch</label>
                    <select class="form-select" id="branchSelect"  name="branch_id" >
                    <option value="">Select Branch</option>

                    @foreach ($branches as $branch)
                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>

                    @endforeach
                    </select>
                </div>



              <div class="form-check mb-3">
              </div>
              <div class="d-grid"><button class="btn btn-primary" type="submit">Send new request</button></div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Bank Accounts End -->

  </div>
  <!-- Middle Panel End -->

  <div id="primary-bank-account-details" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered transaction-details" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <div class="row g-0">
            <div class="col-sm-5 d-flex justify-content-center bg-primary rounded-start py-4">
              <div class="my-auto text-center">
                <img  src="{{ asset('assets/images/banks/'.$primary_bank_account->bank->image) }}" alt="" style="max-width: 50px; max-height: 50px;">
                <h3 class="text-6 text-white my-3">{{ $primary_bank_account->bank->name }}</h3>
                <div class="text-4 text-white my-4">{{ $primary_bank_account->bank->routing_number }}</div>
              </div>
            </div>
            <div class="col-sm-7">
              <h5 class="text-5 fw-400 m-3">Bank Account Details
                <button type="button" class="btn-close text-2 float-end" data-bs-dismiss="modal" aria-label="Close"></button>
              </h5>
              <hr>
              <div class="px-3 mb-3">
                <ul class="list-unstyled">
                  <li class="fw-500">Account Type:</li>
                  <li class="text-muted">Personal</li>
                </ul>



                <ul class="list-unstyled">
                  <li class="fw-500">Account No:</li>
                  <li class="text-muted"> {{ $primary_bank_account->account_number }}</li>
                </ul>

                <ul class="list-unstyled">
                  <li class="fw-500">Branch:</li>
                  <li class="text-muted"> Main Branch</li>
                </ul>

                <ul class="list-unstyled">
                  <li class="fw-500">Status:</li>
                  <li class="text-muted">Approved <span class="text-success text-3"><i class="fas fa-check-circle"></i></span></li>
                </ul>


              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


@endsection
