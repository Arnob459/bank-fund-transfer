@extends('users.master')

@section('content')
        <div class="dashboard-inner-content">
            <div class="card">
                <h5 class="card-header">{{$page_title}}</h5>
                <div class="card-body">
                    <form action="{{route('user.sendmoney.submit', $bank->id)}}" method="post">
                        @csrf

                        <input type="hidden" class="fixed_charge" value="{{formatter_money($bank->fixed_charge)}}">
                        <input type="hidden" id="percent_charge" value="{{$bank->percent_charge+0}}">
                        <input type="hidden" class="minimum_amount" value="{{formatter_money($bank->minimum_limit)}}">
                        <input type="hidden" class="maximum_amount" value="{{formatter_money($bank->maximum_limit)}}">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6">
                                <label for="a-trans">@lang('Transfer Amount')</label>
                                <input type="text" class="amount" name="amount" placeholder="enter amount"
                                       onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')" required>
                            </div>
                            <div class="col-xl-6 col-lg-6">
                                <label id="limit_label">@lang('Limit') : {{$gnl->cur}}</label>
                                <input class="" type="text" style="border: 2px red" id="limit" readonly="readonly" value="{{formatter_money($bank->minimum_limit)}} - {{formatter_money($bank->maximum_limit)}} {{$gnl->cur}}">
                                <code class="limit"></code>
                            </div>
                            <div class="col-xl-6 col-lg-6">
                                <label
                                    for="charge">@lang('Charge'): {{formatter_money($bank->fixed_charge)}} {{$gnl->cur}}
                                    + {{$bank->percent_charge+0}} %</label>
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
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="text-center mb-4">@lang('Please follow the instruction bellow')</h4>
                                <p class="my-4 text-center">@php echo  $bank->description @endphp</p>
                                <p class="text-center mt-3 font-weight-bold">@lang('Processing Time : ') @php echo  $bank->processing_time @endphp</p>
                            </div>
                            @foreach(json_decode($bank->user_data) as $input)
                                <div class="col-md-12">
                                    <label for="a-trans" class="font-weight-bold">{{__($input)}}</label>
                                    <input type="text" name="ud[{{str_slug($input) }}]" placeholder="{{ __($input) }}"
                                           required>
                                </div>
                            @endforeach
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
                var min = parseFloat($('.minimum_amount').val()) || 0;
                var max = parseFloat($('.maximum_amount').val()) || 0;
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

                if (amount > max || amount < min) {
                    $('#limit').removeClass().addClass('error');
                    $('#limit_label').removeClass().addClass('error-label');
                    $('#myBtn').attr("disabled", true);
                    if (amount > balance) {
                        $('#afterBalance').removeClass().addClass('error');
                        $('#balance_limit_label').removeClass().addClass('error-label');
                        $('#myBtn').attr("disabled", true);
                    } else {
                        $('#afterBalance').removeClass();
                        $('#balance_limit_label').removeClass();
                        $('#myBtn').attr("disabled", false);
                    }

                } else {
                    $('#limit').removeClass();
                    $('#limit_label').removeClass();
                    if (amount > balance) {
                        $('#afterBalance').removeClass().addClass('error');
                        $('#balance_limit_label').removeClass().addClass('error-label');
                        $('#myBtn').attr("disabled", true);
                    } else {
                        $('#afterBalance').removeClass();
                        $('#balance_limit_label').removeClass();
                        $('#myBtn').attr("disabled", false);
                    }
                }
            });
        });
    </script>

@endpush
