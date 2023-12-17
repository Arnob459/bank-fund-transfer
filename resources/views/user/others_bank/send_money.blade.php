
@extends('user.master')

@section('content')


<!-- Content
============================================= -->
<div id="content" class="py-4">
  <div class="container">

    <!-- Steps Progress bar -->
    <div class="row mt-4 mb-5">
      <div class="col-lg-11 mx-auto">
        <div class="row widget-steps">
          <div class="col-4 step active">
            <div class="step-name">Details</div>
            <div class="progress">
              <div class="progress-bar"></div>
            </div>
            <a href="#" class="step-dot"></a> </div>
          <div class="col-4 step disabled">
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
    <h2 class="fw-400 text-center mt-3">Send Money to {{ $account->bank->name }}</h2>
    <p class="lead text-center mb-4">Send your money on anytime, anywhere in the world.</p>
    <div class="row">
      <div class="col-md-9 col-lg-7 col-xl-6 mx-auto">
        <div class="bg-white shadow-sm rounded p-3 pt-sm-4 pb-sm-5 px-sm-5 mb-4">
          <h3 class="text-5 fw-400 mb-3 mb-sm-4">Receiver Details</h3>
          <hr class="mx-n3 mx-sm-n5 mb-4">
          <!-- Send Money Form
          ============================ -->
          <form id="form-send-money" method="POST" action="{{ route('user.sendmoney.confirm',[slug(__($account->bank->name)) , $account->id]) }}">
              @csrf
              <input type="hidden" class="fixed_charge" value="{{formatter_money($account->bank->fixed_charge)}}">
              <input type="hidden" id="percent_charge" value="{{$account->bank->percent_charge+0}}">
              @foreach(json_decode($account->user_data) as $key => $data)
              <div class="mb-3">
                <label for="username" class="form-label">{{ $key }}</label>
                <input type="text" value="{{ $data }}" class="form-control" readonly>
              </div>
              @endforeach


            <div class="mb-3">
              <label for="youSend" class="form-label">You Send</label>
              <div class="input-group">
                <span class="input-group-text">$</span>
                <input type="text" class="form-control amount" name="amount" data-bv-field="youSend" id="youSend" onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')" placeholder="">
                <span class="input-group-text p-0">
                  <select id="youSendCurrency" data-style="form-select bg-transparent border-0" data-container="body"  class=" form-control bg-transparent" required="">
                    <option   selected="selected" >{{ $gnl->cur }}</option>
                  </select>
                  </span>
              </div>
            </div>


            <hr>
            <p>Total Fees {{formatter_money($account->bank->fixed_charge)}} {{$gnl->cur}}
              + {{$account->bank->percent_charge+0}} %<span class="float-end"  id="charge"> {{$gnl->cur_sym}}</span></p>
            <hr>
            <p class="text-4 fw-500">Receiver will get<span class="float-end"   id="payAmount">{{$gnl->cur}}</p>
            <div class="d-grid"><button id="myBtn" type="submit" class="btn btn-primary">Continue</button></div>
          </form>
          <!-- Send Money Form end -->
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Content end -->
@endsection
@push('js')
<script>
    $(function () {
        $('.amount').keyup(function () {

            var amount = parseFloat($('.amount').val()) || 0;

            var balance = parseFloat({{formatter_money(auth()->user()->balance)}}) || 0;
            var fix_charge = parseFloat($('.fixed_charge').val()) || 0;
            var percent_charge = parseFloat($('#percent_charge').val()) || 0;
            var percent = (amount * percent_charge / 100);
            var charge = fix_charge + percent;
            var payAmount = amount - charge;
            var afterBalance = balance - amount;

            $('#charge').text(charge.toFixed(2));
            $('#payAmount').text(payAmount.toFixed(2));


                $('#limit').removeClass();
                $('#limit_label').removeClass();
                if (amount > balance) {
                    $('#afterBalance').removeClass().addClass('error');
                    $('#myBtn').attr("disabled", true);
                } else {
                    $('#afterBalance').removeClass();
                    $('#myBtn').attr("disabled", false);
            }
        });
    });
</script>


@endpush
