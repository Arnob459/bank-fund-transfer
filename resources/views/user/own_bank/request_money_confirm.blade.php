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
              <a href="request-money.html" class="step-dot"></a> </div>
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
      <h2 class="fw-400 text-center mt-3">Request Money</h2>
      <p class="lead text-center mb-4">You are requesting money from <span class="fw-500">{{ $username->username }}</span></p>
      <div class="row">
        <div class="col-md-9 col-lg-7 col-xl-6 mx-auto">
          <div class="bg-white shadow-sm rounded p-3 pt-sm-4 pb-sm-5 px-sm-5 mb-4">
            <!-- Request Money Confirm Details
            ============================================= -->
            <h3 class="text-5 fw-400 mb-3 mb-sm-4">Confirm Details</h3>
            <hr class="mx-n3 mx-sm-n5 mb-4">
            <div class="row g-3 align-items-center">
              <p class="col-sm-4 text-muted text-sm-end mb-0 mb-sm-3">Name:</p>
              <p class="col-sm-8 text-3">{{ $username->name }}</p>
            </div>
            <div class="row g-3 align-items-center">
                <p class="col-sm-4 text-muted text-sm-end mb-0 mb-sm-3">Username:</p>
                <p class="col-sm-8 text-3">{{ $username->username }}</p>
              </div>
            <div class="row g-3 align-items-center">
              <p class="col-sm-4 text-muted text-sm-end mb-0 mb-sm-3">Email:</p>
              <p class="col-sm-8 text-3">{{ $username->email }}</p>
            </div>

            <div class="row g-3 align-items-center">
              <p class="col-sm-4 text-muted text-sm-end fw-500 mb-0 mb-sm-3">Requested Amount:</p>
              <p class="col-sm-8 text-4 fw-500">{{ $amount }} {{ $gnl->cur }}</p>
            </div>

            <div class="row g-3 align-items-center">
                <p class="col-sm-4 text-muted text-sm-end fw-500 mb-0 mb-sm-3">Charge:</p>
                <p class="col-sm-8 text-4 fw-500">{{ $charge }} {{ $gnl->cur }} @if ($who == 0)
                    <span class="text-3"> ( {{ $username->username }} will pay the charge)</span>
                @endif</p>
            </div>

            @if ( $who == 1 )

            <div class="row g-3 align-items-center">
                <p class="col-sm-4 text-muted text-sm-end fw-500 mb-0 mb-sm-3">Amount After Charge:</p>
                <p class="col-sm-8 text-4 fw-500">{{ $after_charge }} {{ $gnl->cur }}</p>
            </div>
            @endif

            <form id="form-send-money" method="POST" action="{{ route('user.ownbank.requestmoney.submit') }}">
                @csrf
                <input type="hidden" name="username" value="{{ $username->username }}">
                <input type="hidden" name="amount"  value="{{$amount}}">
                <input type="hidden" name="who"  value="{{$who}}">

              <div class="d-grid"><button type="submit" class="btn btn-primary">Request Money</button></div>
            </form>
            <!-- Request Money Confirm Details end -->
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Content end -->

@endsection
