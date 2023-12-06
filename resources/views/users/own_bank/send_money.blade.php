@extends('users.master')

@section('content')
        <div class="dashboard-inner-content">
            <div class="card">
                <h5 class="card-header">{{$page_title}}</h5>
                <div class="card-body">
                    <form action="{{route('user.ownbank.sendmoney.submit')}}" method="post">
                        @csrf

                        <input type="hidden" class="fixed_charge" value="{{formatter_money($gnl->fixed_charge)}}">
                        <input type="hidden" id="percent_charge" value="{{$gnl->percent_charge+0}}">

                        <div class="row">
                            <div class="col-xl-6 col-lg-6">
                                <label for="a-trans">@lang('Transfer Amount')</label>
                                <input type="text" class="amount" name="amount" placeholder="enter amount"
                                       onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')" required>
                            </div>

                            <div class="col-xl-6 col-lg-6">
                                <label for="username">Transfer Username</label>
                                <input type="text" id="username" name="username" placeholder="enter username"  required>
                                <div>
                                    <ul id="search-results"></ul>
                                </div>
                            </div>


                            <div class="col-xl-6 col-lg-6">
                                <label
                                    for="charge">@lang('Charge'): {{formatter_money($gnl->fixed_charge)}} {{$gnl->cur}}
                                    + {{$gnl->percent_charge+0}} %</label>
                                <input type="text" readonly="readonly" value="0" id="charge">
                            </div>
                            <div class="col-xl-6 col-lg-6">
                                <label for="payAmount">@lang('Amount After Charge') : {{$gnl->cur}}</label>
                                <input type="text" value="0" id="payAmount" readonly="readonly">
                            </div>


                            <div class="col-xl-12 col-lg-12">
                                <label id="balance_limit_label">@lang('Your Balance Will Be') : {{$gnl->cur}} </label>
                                <input type="text" value="{{formatter_money(auth()->user()->balance)}}"
                                       id="afterBalance" readonly="readonly">
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 text-center">
                            <button class="btn btn-warning" id="myBtn" type="submit">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

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
                $('#charge').val(charge.toFixed(2));
                $('#payAmount').val(payAmount.toFixed(2));
                $('#afterBalance').val(afterBalance.toFixed(2));


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


                         // $("#refferal").val(data.id);


                    if (data.username == query ){
                         $("#search-results").html(data.name);
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

@endpush
