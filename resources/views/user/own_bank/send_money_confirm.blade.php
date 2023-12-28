
@extends('user.master')
@section('content')


  <!-- Secondary menu
  ============================================= -->
  <div class="bg-primary">
    <div class="container d-flex justify-content-center">
      <ul class="nav nav-pills alternate nav-lg border-bottom-0">
        <li class="nav-item"> <a class="nav-link active" href="{{ route('user.ownbank.sendmoney') }}">Send</a></li>
        <li class="nav-item"> <a class="nav-link" href="{{ route('user.ownbank.requestmoney') }}">Request</a></li>
      </ul>
    </div>
  </div>
  <!-- Secondary menu end -->

  <!-- Content
  ============================================= -->
  <div id="content" class="py-4">
    <div class="container">

      <!-- Steps Progress bar -->
      <div class="row mt-4 mb-5">
        <div class="col-lg-11 mx-auto">
          <div class="row widget-steps">
            <div class="col-4 step complete">
              <div class="step-name">Details</div>
              <div class="progress">
                <div class="progress-bar"></div>
              </div>
              <a href="send-money.html" class="step-dot"></a> </div>
            <div class="col-4 step active">
              <div class="step-name">Confirm</div>
              <div class="progress">
                <div class="progress-bar"></div>
              </div>
              <a href="#" class="step-dot"></a> </div>
            <div class="col-4 step disabled">
              <div class="step-name">Success</div>
              <div class="progress">
                <div class="progress-bar"></div>
              </div>
              <a href="#" class="step-dot"></a> </div>
          </div>
        </div>
      </div>
      <h2 class="fw-400 text-center mt-3">Send Money</h2>
      <p class="lead text-center mb-4">You are sending money to <span class="fw-500">{{ $username->username }}</span></p>
      <div class="row">
        <div class="col-md-9 col-lg-7 col-xl-6 mx-auto">
          <div class="bg-white shadow-sm rounded p-3 pt-sm-4 pb-sm-5 px-sm-5 mb-4">

            <!-- Send Money Confirm
            ============================================= -->
            <form  id="myForm" method="POST" action="{{ route('user.ownbank.sendmoney.submit') }}">
                @csrf
                <input type="hidden" name="username" value="{{ $username->username }}">
                <input type="hidden" name="amount"  value="{{$amount}}">

                <h3 class="text-5 fw-400 mb-3 mb-sm-4">Receiver Details</h3>
                <hr class="mx-n3 mx-sm-n5 mb-4">
                <p class="mb-1">Name <span class="text-3 float-end">{{ $username->name }}</span></p>
                <p class="mb-1">Username <span class="text-3 float-end">{{ $username->username }}</span></p>
                <p class="mb-1">Email <span class="text-3 float-end">{{ $username->email }}</span></p>

              <hr class="mx-n3 mx-sm-n5 mb-3 mb-sm-4">
              <h3 class="text-5 fw-400 mb-3 mb-sm-4">Confirm Details</h3>
              <hr class="mx-n3 mx-sm-n5 mb-4">
              <p class="mb-1">Send Amount <span class="text-3 float-end">{{ $after_charge }} {{ $gnl->cur }}</span></p>
              <p class="mb-1">Total fees <span class="text-3 float-end">{{ $charge }} {{ $gnl->cur }}</span></p>
              <hr>
              <p class="text-4 fw-500">Total<span class="float-end">{{ $amount }} {{ $gnl->cur }}</span></p>
              <div class="d-grid"><button type="submit" id="submitButton" class="btn btn-primary">Send Money</button></div>
            </form>
            <!-- Send Money Confirm end -->
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Content end -->

@endsection

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var form = document.getElementById('myForm');
        var submitButton = document.getElementById('submitButton');

        form.addEventListener('submit', function () {
            submitButton.disabled = true;
        });
    });
</script>
@endpush
