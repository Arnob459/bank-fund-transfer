@extends('admin.layouts.master')

@section('content')

<div class="page-content">
    <section class="row">
        <div class="col-12 ">
            <div class="row">

                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-3  ">
                                    <div class="stats-icon blue mb-2">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>

                                <div class="col-md-9 ">
                                    <h6 class="text-muted font-semibold">Total Users </h6>
                                    <h6 class="font-extrabold mb-0">{{ $total_user }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-3  ">
                                    <div class="stats-icon green mb-2">
                                        <i class="fas fa-user-check"></i>
                                    </div>
                                </div>
                                <div class="col-md-9 ">
                                    <h6 class="text-muted font-semibold">Active Users</h6>
                                    <h6 class="font-extrabold mb-0">{{ $active_user }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-3 ">
                                    <div class="stats-icon purple mb-2">
                                        <i class="fas fa-user-edit"></i>
                                    </div>
                                </div>
                                <div class="col-md-9 ">
                                    <h6 class="text-muted font-semibold">Pending Users</h6>
                                    <h6 class="font-extrabold mb-0">{{ $pending_user }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-3  ">
                                    <div class="stats-icon red mb-2">
                                        <i class="fas fa-user-times"></i>
                                    </div>
                                </div>
                                <div class="col-md-9 ">
                                    <h6 class="text-muted font-semibold">Block Users</h6>
                                    <h6 class="font-extrabold mb-0">{{ $block_user }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-3  ">
                                    <div class="stats-icon green mb-2">
                                        <i class="far fa-envelope-open"></i>
                                    </div>
                                </div>
                                <div class="col-md-9 ">
                                    <h6 class="text-muted font-semibold">Email Verified</h6>
                                    <h6 class="font-extrabold mb-0">{{ $email_verify }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-3  ">
                                    <div class="stats-icon red mb-2">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                </div>
                                <div class="col-md-9 ">
                                    <h6 class="text-muted font-semibold">Email Unverified</h6>
                                    <h6 class="font-extrabold mb-0">{{ $email_unverify }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-3  ">
                                    <div class="stats-icon green mb-2">
                                        <i class="fas fa-comment"></i>
                                    </div>
                                </div>
                                <div class="col-md-9 ">
                                    <h6 class="text-muted font-semibold">SMS Verified</h6>
                                    <h6 class="font-extrabold mb-0">{{ $sms_verify }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-3 ">
                                    <div class="stats-icon red mb-2">
                                        <i class="fas fa-comment-slash"></i>
                                    </div>
                                </div>
                                <div class="col-md-9 ">
                                    <h6 class="text-muted font-semibold">SMS Unverified </h6>
                                    <h6 class="font-extrabold mb-0">{{ $sms_unverify }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-3  ">
                                    <div class="stats-icon green mb-2">
                                        <i class="fas fa-id-card"></i>
                                    </div>
                                </div>
                                <div class="col-md-9 ">
                                    <h6 class="text-muted font-semibold">Kyc Verified</h6>
                                    <h6 class="font-extrabold mb-0">{{ $kyc_verify }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-3 ">
                                    <div class="stats-icon red mb-2">
                                        <i class="fas fa-id-card"></i>
                                    </div>
                                </div>
                                <div class="col-md-9 ">
                                    <h6 class="text-muted font-semibold">Kyc Unverified </h6>
                                    <h6 class="font-extrabold mb-0">{{ $kyc_unverify }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-3  ">
                                    <div class="stats-icon purple mb-2">
                                        <i class="fas fa-hand-holding-usd"></i>
                                    </div>
                                </div>
                                <div class="col-md-9 ">
                                    <h6 class="text-muted font-semibold">All User Balance</h6>
                                    <h6 class="font-extrabold mb-0">{{$gnl->cur_sym}} {{formatter_money($balance)}} {{$gnl->cur}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="page-heading">
                    <h3>Accounts Statistics</h3>
                </div>

                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-3  ">
                                    <div class="stats-icon blue mb-2">
                                        <i class="fas fa-user-circle"></i>
                                    </div>
                                </div>

                                <div class="col-md-9 ">
                                    <h6 class="text-muted font-semibold">Total Accounts </h6>
                                    <h6 class="font-extrabold mb-0">{{ $total_accounts }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-3  ">
                                    <div class="stats-icon green mb-2">
                                        <i class="fas fa-user-circle"></i>
                                    </div>
                                </div>
                                <div class="col-md-9 ">
                                    <h6 class="text-muted font-semibold">Active Accounts</h6>
                                    <h6 class="font-extrabold mb-0">{{ $active_accounts }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-3 ">
                                    <div class="stats-icon purple mb-2">
                                        <i class="fas fa-user-circle"></i>
                                    </div>
                                </div>
                                <div class="col-md-9 ">
                                    <h6 class="text-muted font-semibold">Pending Accounts</h6>
                                    <h6 class="font-extrabold mb-0">{{ $pending_accounts }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-3 ">
                                    <div class="stats-icon red mb-2">
                                        <i class="fas fa-user-circle"></i>
                                    </div>
                                </div>
                                <div class="col-md-9 ">
                                    <h6 class="text-muted font-semibold">Reject Accounts</h6>
                                    <h6 class="font-extrabold mb-0">{{ $reject_accounts }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="page-heading">
                    <h3>Request Statistics</h3>
                </div>
                                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-3  ">
                                    <div class="stats-icon blue mb-2">
                                        <i class="fas fa-arrow-circle-left"></i>
                                    </div>
                                </div>

                                <div class="col-md-9 ">
                                    <h6 class="text-muted font-semibold">Total Requests </h6>
                                    <h6 class="font-extrabold mb-0">{{ $total_requests }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-3  ">
                                    <div class="stats-icon green mb-2">
                                        <i class="fas fa-arrow-circle-left"></i>
                                    </div>
                                </div>
                                <div class="col-md-9 ">
                                    <h6 class="text-muted font-semibold">Active Requests</h6>
                                    <h6 class="font-extrabold mb-0">{{ $active_requests }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-3 ">
                                    <div class="stats-icon purple mb-2">
                                        <i class="fas fa-arrow-circle-left"></i>
                                    </div>
                                </div>
                                <div class="col-md-9 ">
                                    <h6 class="text-muted font-semibold">Pending Requests</h6>
                                    <h6 class="font-extrabold mb-0">{{ $pending_requests}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-3 ">
                                    <div class="stats-icon red mb-2">
                                        <i class="fas fa-arrow-circle-left"></i>
                                    </div>
                                </div>
                                <div class="col-md-9 ">
                                    <h6 class="text-muted font-semibold">Reject Requests</h6>
                                    <h6 class="font-extrabold mb-0">{{ $reject_requests }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="page-heading">
                    <h3>Send Money Statistics</h3>
                </div>
                                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-3  ">
                                    <div class="stats-icon blue mb-2">
                                        <i class="fas fa-arrow-circle-left"></i>
                                    </div>
                                </div>

                                <div class="col-md-9 ">
                                    <h6 class="text-muted font-semibold">Total Send Money </h6>
                                    <h6 class="font-extrabold mb-0">{{ $total_send_money }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-3  ">
                                    <div class="stats-icon green mb-2">
                                        <i class="fas fa-arrow-circle-left"></i>
                                    </div>
                                </div>
                                <div class="col-md-9 ">
                                    <h6 class="text-muted font-semibold">Active Send Money</h6>
                                    <h6 class="font-extrabold mb-0">{{ $active_send_money }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-3 ">
                                    <div class="stats-icon purple mb-2">
                                        <i class="fas fa-arrow-circle-left"></i>
                                    </div>
                                </div>
                                <div class="col-md-9 ">
                                    <h6 class="text-muted font-semibold">Pending Send Money</h6>
                                    <h6 class="font-extrabold mb-0">{{ $pending_send_money}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-3 ">
                                    <div class="stats-icon red mb-2">
                                        <i class="fas fa-arrow-circle-left"></i>
                                    </div>
                                </div>
                                <div class="col-md-9 ">
                                    <h6 class="text-muted font-semibold">Reject Send Money</h6>
                                    <h6 class="font-extrabold mb-0">{{ $reject_send_money }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        </div>

    </section>
</div>

@endsection


@push('js')
<script src="{{ asset('assets/admin/js/pages/dashboard.js') }}"></script>
@endpush
