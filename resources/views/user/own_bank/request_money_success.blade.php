@extends('user.master')
@section('content')
    <!-- Secondary menu
  ============================================= -->
  <div class="bg-primary">
    <div class="container d-flex justify-content-center">
      <ul class="nav nav-pills alternate nav-lg border-bottom-0">
        <li class="nav-item"> <a class="nav-link " href="{{ route('user.ownbank.sendmoney') }}">Send</a></li>
        <li class="nav-item"> <a class="nav-link active" href="{{ route('user.ownbank.requestmoney') }}">Request</a></li>
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
              <span class="step-dot"></span> </div>
            <div class="col-4 step complete">
              <div class="step-name">Confirm</div>
              <div class="progress">
                <div class="progress-bar"></div>
              </div>
              <span class="step-dot"></span> </div>
            <div class="col-4 step complete">
              <div class="step-name">Success</div>
              <div class="progress">
                <div class="progress-bar"></div>
              </div>
              <span class="step-dot"></span> </div>
          </div>
        </div>
      </div>
      <h2 class="fw-400 text-center mt-3 mb-4">Request Money</h2>
      <div class="row">
        <div class="col-md-9 col-lg-7 col-xl-6 mx-auto">
          <!-- Request Money Success
          ============================================= -->
          <div class="bg-white text-center shadow-sm rounded p-3 pt-sm-4 pb-sm-5 px-sm-5 mb-4">
            <div class="my-4">
              <p class="text-success text-20 lh-1"><i class="fas fa-check-circle"></i></p>
              <p class="text-success text-8 fw-500 lh-1">Success!</p>
              <p class="lead">Transactions Complete</p>
            </div>
            <p class="text-3 mb-4">You've successfully <span class="text-4 fw-500">{{ $gnl->cur_sym }}{{ $amount }}</span> Request Money to <span class="fw-500">{{ $username }}</span>, See transaction details under <a class="btn-link" href="{{ route('user.transections') }}">Transections</a>.</p>
            </div>
          <!-- Request Money Success end -->
        </div>
      </div>
    </div>
  </div>
  <!-- Content end -->
@endsection
