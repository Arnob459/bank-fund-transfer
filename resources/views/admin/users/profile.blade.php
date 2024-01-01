@extends('admin.layouts.master')

@section('content')

    <section id="basic-vertical-layouts">
        <div class="row match-height">
            <div class="col-md-4 col-12">
                <div class="card ">
                    <div class="card-content">
                        <div class="card-body ">
                            <form class="form form-vertical">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12 text-center mb-4 mt-4 ">
                                            <div class="avatar avatar-xl me-3 mb-3  ">
                                                @if ($user->avatar == null)
                                                <span
                                                    class="avatar-title rounded-circle border border-dark">{{\Illuminate\Support\Str::limit($user->name, 1 ,'')}}</span>
                                                @else
                                                    <img src="{{asset('assets/images/users/'.$user->avatar)}}" alt="..."
                                                        class="avatar-img rounded-circle">
                                                @endif
                                            </div>
                                        </div>
                                        <hr>

                                        <div class="col-12 ">

                                            <div class="row mb-3">
                                                <div div class="col-md-4 ">
                                                    <div class="  mb-1">Name: </div>
                                                </div>
                                                <div div class="col-md-8 ">
                                                    <div class=" text-nowrap mb-1" > {{ $user->name }} </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div div class="col-md-5">
                                                    <div class="  mb-1">Username: </div>
                                                </div>
                                                <div div class="col-md-6">
                                                    <div class="  mb-1" > {{ $user->username }} </div>
                                                </div>
                                            </div> <div class="row mb-3">
                                                <div div class="col-md-4 ">
                                                    <div class="  mb-1">Email: </div>
                                                </div>
                                                <div div class="col-md-8 ">
                                                    <div class="  mb-1" > {{ $user->email }} </div>
                                                </div>
                                            </div> <div class="row mb-3">
                                                <div div class="col-md-4 ">
                                                    <div class=" mb-1">Mobile: </div>
                                                </div>
                                                <div div class="col-md-8 ">
                                                    <div class="  mb-1" > {{ $user->phone }} </div>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div div class="col-md-7 ">
                                                    <div class="  mb-1">Login As a User : </div>
                                                </div>
                                                <div div class="col-md-4">
                                                    <a target="_blank" href="{{route('admin.auto.login', $user->id)}}"> Login </a>

                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div div class="col-md-4 ">
                                                    <div class="  mb-1">Status: </div>
                                                </div>
                                                <div div class="col-md-8 ">
                                                    <div class=" mb-1" >
                                                          @if ($user->status == 1)
                                                        <span >Active</span>
                                                        @elseif ($user->status == 0)
                                                        <span >Blocked</span>
                                                        @else
                                                        <span >Pending</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>


                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8 col-12">
                <div class="card ">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">

                                <div class=" col-md-6 mb-3">
                                    <div class="custom-card rounded">
                                        <div class="card-body px-4 py-4-5">
                                            <div class="row">
                                                <div class="col-md-4  ">
                                                    <div class="stats-icon green  mb-2">
                                                        <i class="fas fa-wallet"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 ">
                                                    <h6 class="">Balance</h6>
                                                    <h6 class="font-extrabold mb-0">{{$gnl->cur_sym}} {{formatter_money($user->balance)}}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-6 mb-3">
                                    <div class="custom-card2 rounded">
                                        <div class="card-body px-4 py-4-5">
                                            <div class="row">
                                                <div class="col-md-4  ">
                                                    <div class="stats-icon blue mb-2">
                                                        <i class="fas fa-wallet"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 ">
                                                    <h6 >Total Requested Amount</h6>
                                                    <h6 class="font-extrabold mb-0">{{$gnl->cur_sym}} {{formatter_money($request_amount)}}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <div class="custom-card3 rounded">
                                        <div class="card-body px-4 py-4-5">
                                            <div class="row">
                                                <div class="col-md-4  ">
                                                    <div class="stats-icon blue mb-2">
                                                        <i class="fas fa-coins"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 ">
                                                    <h6 class="">Total Send Amount</h6>
                                                    <h6 class="font-extrabold mb-0">{{$gnl->cur_sym}} {{formatter_money($send_amount)}}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="mb-3 col-md-6">
                                    <div class="custom-card4 rounded">
                                        <div class="card-body px-4 py-4-5">
                                            <div class="row">
                                                <div class="col-md-4  ">
                                                    <div class="stats-icon blue mb-2">
                                                        <i class="fas fa-coins"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 ">
                                                    <h6 >Total Transection</h6>
                                                    <h6 class="font-extrabold mb-0">{{ $total_trx }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <button type="button"  class="btn btn-success btn-block me-1 mb-3" data-bs-toggle="modal"
                                        data-bs-target="#addModal" >Add Balance</button>

                                </div>
                                <div class="col-md-6">
                                    <button type="button"  class="btn btn-danger btn-block me-1 mb-3" data-bs-toggle="modal"
                                        data-bs-target="#subModal" >Subtract Balance</button>

                                </div>

                                @if ( $user->kyc_verify != 0 )
                                <div class="col-md-12">
                                    <a href="{{route('admin.kyc.update', $user->id)}}"  class="btn btn-primary btn-block me-1 mb-3">Kyc Data</a>

                                </div>
                                @endif




                            </div>


                            <form class="form form-vertical" action="{{route('admin.user.update',$user->id) }}" method="POST" enctype="multipart/form-data" >
                                    @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical" class="mb-2"> Name</label>
                                                <input type="text" id="first-name-vertical" class="form-control"
                                                name="name" value="{{ $user->name }}" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="email-id-vertical" class="mb-2">Username</label>
                                                <input type="text" id="email-id-vertical" class="form-control"
                                                name="username" value="{{ $user->username }}" required>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="contact-info-vertical" class="mb-2">Mobile</label>
                                                <input type="number" id="contact-info-vertical" class="form-control"
                                                name="phone" value="{{ $user->phone }}" required>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="email-id-vertical" class="mb-2">Email</label>
                                                <input type="email" id="email-id-vertical" class="form-control"
                                                name="email" value="{{ $user->email }}" required >
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="contact-info-vertical" class="mb-2">Address</label>
                                                <input type="text" id="contact-info-vertical" class="form-control"
                                                name="address" value="{{ @$user->address->address }}" >
                                            </div>
                                        </div>

                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="contact-info-vertical" class="mb-2">Country</label>
                                                <select class="form-control" name="country">
                                                    @include('partials.country')
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="contact-info-vertical" class="mb-2">State</label>
                                                <input type="text" id="contact-info-vertical" class="form-control"
                                                name="state" value="{{ @$user->address->state }}" >
                                            </div>
                                        </div>

                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="contact-info-vertical" class="mb-2">City</label>
                                                <input type="text" id="contact-info-vertical" class="form-control"
                                                name="city" value="{{ @$user->address->city }}" >
                                            </div>
                                        </div>

                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="contact-info-vertical" class="mb-2">Zip/Postal</label>
                                                <input type="text" id="contact-info-vertical" class="form-control"
                                                name="zip" value="{{ @$user->address->zip }}" >
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Email Verify </label>
                                                <div class="selectgroup w-100">
                                                    <input type="radio" class="btn-check " name="email_verify" id="success-outlined"
                                                    autocomplete="off" value="1" {{ $user->email_verify == '1' ? 'checked' : '' }}>
                                                    <label class="btn btn-outline-success  " for="success-outlined">Verified</label>

                                                <input type="radio" class="btn-check" name="email_verify" id="danger-outlined"
                                                    autocomplete="off" value="0" {{ $user->email_verify != '1' ? 'checked' : '' }}  >
                                                <label class="btn btn-outline-danger  "  for="danger-outlined"> Unverified</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Sms Verify </label>
                                                <div class="selectgroup w-100 ">
                                                    <input type="radio" class="btn-check " name="sms_verify" id="sms-verify-true"
                                                    autocomplete="off" value="1" {{ $user->sms_verify == '1' ? 'checked' : '' }} >
                                                        <label class="btn btn-outline-success   " for="sms-verify-true">Verified</label>

                                                <input type="radio" class="btn-check" name="sms_verify" id="sms-verify-false"
                                                    autocomplete="off" value="0" {{ $user->sms_verify != '1' ? 'checked' : '' }} >
                                                <label class="btn btn-outline-danger  "  for="sms-verify-false"> Unverified</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Kyc Verification</label>
                                                <div class="selectgroup w-100">
                                                    <input type="radio" class="btn-check " name="kyc_verify" id="kyc_verify-on"
                                                    autocomplete="off" value="1"  @if($user->kyc_verify == 1)    checked=""  @endif  >
                                                <label class="btn btn-outline-success " for="kyc_verify-on">Verified</label>

                                                <input type="radio" class="btn-check" name="kyc_verify" id="kyc_verify-off"
                                                    autocomplete="off" value="0" @if($user->kyc_verify != 1)    checked=""  @endif >
                                                <label class="btn btn-outline-danger"  for="kyc_verify-off"> Unverified</label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="contact-info-vertical"  class="mb-2">Status</label>
                                                <select name="status"  class="form-select" >
                                                    <option value="1"@if ($user->status == '1') selected @endif>Active</option>
                                                    <option value="0"@if ($user->status == '0') selected @endif>Block</option>
                                                    <option value="2"@if ($user->status == '2') selected @endif>Pending</option>

                                                </select>
                                            </div>
                                        </div>
                                            <button type="submit" class="btn btn-success me-1 mb-1">Update</button>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                        <div class="modal fade text-left" id="addModal" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel1">Add Amount </h5>
                                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                                <form action="{{ route('admin.user.addbalance',$user->id) }} " method="post">
                                @csrf
                                {{-- @method('put') --}}

                                <div class="modal-body">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="basicInput">Amount</label>
                                            <input type="text" name="amount" id="amount" class="form-control form-control-lg"  placeholder="Enter Amount" >
                                        </div>
                                    </div>
                                </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn" data-bs-dismiss="modal">
                                            <i class="bx bx-x d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Close</span>
                                        </button>
                                        <button type="submit" class="btn btn-primary ml-1" >
                                            <i class="bx bx-check d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Add</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- Subtraction --}}
                    <div class="modal fade text-left" id="subModal" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel2" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="myModalLabel2">Subtract Amount </h5>
                                <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                            <form action="{{ route('admin.user.subbalance',$user->id) }} " method="post">
                            @csrf
                            {{-- @method('put') --}}

                            <div class="modal-body">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="basicInput">Amount</label>
                                        <input type="text" name="amount" id="amount" class="form-control form-control-lg"  placeholder="Enter Positive Amount" >
                                    </div>
                                </div>
                            </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn" data-bs-dismiss="modal">
                                        <i class="bx bx-x d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Close</span>
                                    </button>
                                    <button type="submit" class="btn btn-danger ml-1" >
                                        <i class="bx bx-check d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Subtract</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
    </section>
    </div>
    <style>
        /* Custom CSS class to change card color */
        .custom-card {
            background-color: #80bc58; /* Change this to your desired color */
            color: white; /* Change text color to contrast with the background */
        }
        .custom-card2 {
            background-color: #8771de; /* Change this to your desired color */
            color: white; /* Change text color to contrast with the background */
        }
        .custom-card3 {
            background-color: #c266d8; /* Change this to your desired color */
            color: white; /* Change text color to contrast with the background */
        }

        .custom-card4 {
            background-color: #5398c9; /* Change this to your desired color */
            color: white; /* Change text color to contrast with the background */
        }
        .btn-outline-danger {

            height: 40px;
            width: 120px;
            }
        .btn-outline-success {

            height: 40px;
            width: 120px;
            }
    </style>

@endsection

@push('js')
    <script>
        $("select[name=country]").val("{{ @$user->address->country }}");
        $("select[name=status]").val("{{ $user->status }}");
    </script>
@endpush
