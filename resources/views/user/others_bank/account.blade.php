@extends('user.master')
@section('content')
<div class="col-lg-12">


    <!-- Bank Accounts
    ============================================= -->
    <div class="bg-white shadow-sm rounded p-4 mb-4">
      <h3 class="text-5 fw-400 mb-4">Bank Accounts <span class="text-muted text-4">(for Transfer Money)</span></h3>
      <hr class="mb-4 mx-n4">
      <div class="row g-3">
        @foreach ($accounts as $account)
        <div class="col-12 col-md-4">
            <div class="account-card account-card-primary text-white rounded">
              <div class="row g-0">
                <div class="col-3 d-flex justify-content-center p-3">
                  <div class="my-auto text-center">
                    <img  src="{{ asset('assets/images/banks/'.$account->bank->image) }}" alt="" style="max-width: 50px; max-height: 50px;">
                    @if ($account->status == 1 )
                    <p class="badge bg-warning text-dark text-0 fw-500 rounded-pill px-2 mb-0">Approved</p>
                    @endif
                  </div>
                </div>
                <div class="col-9 border-start">
                <div class="py-4 my-2 ps-4">
                    <p class="text-4 fw-500 mb-1">{{ $account->bank->name }}</p>
                    @foreach(json_decode($account->user_data) as $data)
                    <p class="text-4 opacity-9 mb-1">{{$data}}</p>
                    @endforeach

                  </div>
                </div>
              </div>
              <div class="account-card-overlay rounded"> @if ($account->status == 1 )<a href="#" data-bs-target="#bank-account-details{{$account->id}}" data-bs-toggle="modal" class="text-light btn-link mx-2"><span class="me-1"><i class="fas fa-share"></i></span>send money</a>@endif <a href="#" data-bs-target="#bank-account-delete{{$account->id}}" data-bs-toggle="modal"  class="text-light btn-link mx-2"><span class="me-1"><i class="fas fa-minus-circle"></i></span>Delete</a> </div>

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
                  @foreach(json_decode($account->user_data) as $key => $data)
                  <ul class="list-unstyled">
                    <li class="fw-500">{{ $key }}</li>
                    <li class="text-muted">{{ $data }}</li>
                  </ul>
                  @endforeach

                  <ul class="list-unstyled">
                    <li class="fw-500">Status:</li>
                    <li class="text-muted">Approved <span class="text-success text-3"><i class="fas fa-check-circle"></i></span></li>
                  </ul>

                  <div class="d-grid"><a href="{{ route('user.sendmoney.single', [slug(__($account->bank->name)) , $account->id]) }}" class="btn btn-sm btn-outline-success shadow-none"><span class="me-1"><i class="fas fa-share"></i></span>Send Money</a></div>
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
                      @foreach(json_decode($account->user_data) as $key => $data)
                      <ul class="list-unstyled">
                        <li class="fw-500">{{ $key }}</li>
                        <li class="text-muted">{{ $data }}</li>
                      </ul>
                      @endforeach
                      @if ($account->status == 1)

                      <ul class="list-unstyled">
                        <li class="fw-500">Status:</li>
                        <li class="text-muted">Approved <span class="text-success text-3"><i class="fas fa-check-circle"></i></span></li>
                      </ul>
                      @endif

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
          <p class="w-100 text-center lh-base m-0"> <span class="text-3"><i class="fas fa-plus-circle"></i></span> <span class="d-block text-body text-3">Add New Bank Account</span> </p>
          </a> </div>
      </div>
    </div>

    <!-- Add New Bank Account Details Modal
    ======================================== -->
    <div id="add-new-bank-account" class="modal fade" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title fw-400">Add bank account</h5>
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
              <div class="mb-3" id="bankFields">
                <!-- Bank-specific input fields will be displayed here -->
                <input type="hidden" id="hiddenUserData" name="user_data">

            </div>

              <div class="form-check mb-3">
                <input class="form-check-input" id="remember-me" name="remember" type="checkbox">
                <label class="form-check-label" for="remember-me">I confirm the bank account details above</label>
              </div>
              <div class="d-grid"><button class="btn btn-primary" type="submit">Add Bank Account</button></div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Bank Accounts End -->

  </div>
  <!-- Middle Panel End -->

@endsection
@push('js')
<script>
    var bankData = @json($bankData);
</script>

<script>
    function showBankFields() {
        var selectedBankSelect = document.getElementById("bankSelect");
        var selectedBankId = selectedBankSelect ? selectedBankSelect.value : null;

        // Ensure selectedBankId is valid
        if (selectedBankId !== null) {
            var selectedBank = bankData.find(bank => bank.id == selectedBankId);

            // Ensure selectedBank is valid and has user_data property
            if (selectedBank && selectedBank.user_data) {
                var bankFieldsContainer = document.getElementById("bankFields");

                // Clear previous fields
                bankFieldsContainer.innerHTML = "";

                // Add input fields based on user_data
                JSON.parse(selectedBank.user_data).forEach(function (userDataField) {
                    bankFieldsContainer.innerHTML += `
                        <div class="mb-3">

                        <label for="${userDataField}" class="form-label" >${userDataField}:</label>
                        <input type="text" class="form-control" id="${userDataField}" name="ud[${userDataField}]" required>
                        </div>
                    `;
                });
                // document.getElementById("hiddenUserData").value = selectedBank.user_data;
            }
        }
    }
</script>

@endpush
