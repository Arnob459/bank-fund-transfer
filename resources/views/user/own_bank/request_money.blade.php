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
      <h2 class="fw-400 text-center mt-3">Request Money</h2>
      <p class="lead text-center mb-4">Request your payment on anytime, anywhere in the world.</p>
      <div class="row">
        <div class="col-md-9 col-lg-7 col-xl-6 mx-auto">
          <div class="bg-white shadow-sm rounded p-3 pt-sm-4 pb-sm-5 px-sm-5 mb-4">
            <h3 class="text-5 fw-400 mb-3 mb-sm-4">Payer Details</h3>
            <hr class="mx-n3 mx-sm-n5 mb-4">
            <!-- Request Money Form
            ============================================= -->
            <form id="form-send-money" method="POST" action="{{ route('user.ownbank.requestmoney.Confirm') }}">
                @csrf
                <input type="hidden" class="fixed_charge" value="{{formatter_money($gnl->fixed_charge)}}">
                <input type="hidden" id="percent_charge" value="{{$gnl->percent_charge+0}}">
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" value="" class="form-control" data-bv-field="username" id="username" name="username" required placeholder="Enter Username">
                <div>
                    <span id="search-results"> </span>
                </div>
              </div>

              <div class="mb-3">
                <label for="youSend" class="form-label">Amount</label>
                <div class="input-group">
                  <span class="input-group-text">{{$gnl->cur_sym}}</span>
                  <input type="text" class="form-control amount" name="amount" data-bv-field="youSend" id="youSend" onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')" placeholder="">
                  <span class="input-group-text p-0">
                    <select id="youSendCurrency" data-style="form-select bg-transparent border-0" data-container="body"  class=" form-control bg-transparent" required="">
                      <option   selected="selected" >{{ $gnl->cur }}</option>
                    </select>
                    </span>
                </div>
              </div>

              <div class="mb-3">
                <div class="check_box_group">
                    <input class="radioButton" type="radio" name="who" id="sender" value="1" checked >
                    <label class="check_boxes-label" for="sender">I will pay the charge</label>
                  </div>

                  <div class="check_box_group">
                    <input class="radioButton" type="radio" name="who" id="receiver" value="0">
                    <label class="check_boxes-label" for="receiver">Receiver will pay the charge</label>
                  </div>
                </div>

                <div id="hiddenDiv">
                    <hr>
                    <p>Total Fees {{formatter_money($gnl->fixed_charge)}} {{$gnl->cur}}
                    + {{$gnl->percent_charge+0}} %<span class="float-end"  id="charge"> {{$gnl->cur_sym}}</span></p>
                    <hr>
                    <p class="text-4 fw-500">Amount After Charges<span class="float-end"   id="payAmount">{{$gnl->cur}}</p>
                </div>

              <div class="d-grid mt-4"><button class="btn btn-primary">Continue</button></div>
            </form>
            <!-- Request Money Form end -->
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

                var fix_charge = parseFloat($('.fixed_charge').val()) || 0;
                var percent_charge = parseFloat($('#percent_charge').val()) || 0;

                var percent = (amount * percent_charge / 100);
                var charge = fix_charge + percent;
                var payAmount = amount - charge;

                payAmount = Math.max(0, payAmount);

                $('#charge').text(charge.toFixed(2));
                $('#payAmount').text(payAmount.toFixed(2));


            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $('#username').on('keyup', function () {
                var query = $(this).val().trim();
                console.log(query);
                if (query !== '') {
                    $.ajax({
                        url: "{{ route('checkusername') }}",
                        type: 'GET',
                        data: { query: query },
                        success: function (data) {




                    if (data.username == query ){
                         $("#search-results").html('Name: '+ data.name);
                    }
                    else{
                        $("#search-results").html(data.status);
                    }
                   //  console.log(data.id);

                    }

                    });
                }
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var yesRadio = document.getElementById('sender');
            var noRadio = document.getElementById('receiver');
            var hiddenDiv = document.getElementById('hiddenDiv');

            function updateDivVisibility() {
                hiddenDiv.style.display = yesRadio.checked ? 'block' : 'none';
            }

            yesRadio.addEventListener('change', updateDivVisibility);
            noRadio.addEventListener('change', updateDivVisibility);

            // Initial check on page load
            updateDivVisibility();
        });
    </script>

@endpush
