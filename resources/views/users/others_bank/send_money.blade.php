@extends('users.master')

@section('content')

<div class="dashboard-hero-content text-white">
    <h3 class="title">{{ $page_title }}</h3>
    <ul class="breadcrumb">
        <li class="nav-item">  <a class="nav-link " href="index.html">Home</a> </li>
        <li>
            {{ $page_title }}
        </li>
    </ul>
</div>
</div>
<div class="container-fluid">
    <div class="deposit">
        <div class="deposit-wrapper">
            @foreach($banks as $data)
            <div class="deposit-item">
                <div class="deposit-inner">
                    <div class="deposit-header">
                        <h3 class="title">{{__($data->name)}}</h3>
                    </div>
                    <div class="deposit-body">

                        <div class="item">
                            <div class="item-thumb">
                                <img src="{{asset('assets/images/banks/' . $data->image)}}" >
                            </div>
                        </div>
                            <div class="item-content">
                                <p>@lang('Limit') : {{formatter_money($data->minimum_limit)}} - {{formatter_money($data->maximum_limit)}} {{$gnl->cur}}</p>
                                <p>@lang('Charge') : {{$data->percent_charge+0}} % + {{formatter_money($data->fixed_charge)}} {{$gnl->cur}}</p>
                                <p>@lang('Processing Time') : {{$data->processing_time}}</p>

                                {{-- <button type="submit" class="custom-button">Withdraw Now</button> --}}
                                <a class="nav-link custom-button" href="{{ route('user.sendmoney.single', [slug(__($data->name)) , $data->id]) }}">Send Now </a>
                            </div>
                        </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</div>


@endsection
