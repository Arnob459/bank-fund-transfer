@extends('user.master')

@section('content')
<!-- Content
  ============================================= -->
  <div id="content" class="py-4">
    <div class="container">
      <div class="row">

        <!-- Left Panel
        ============================================= -->
        <aside class="col-lg-3">

            <!-- Profile Details
            =============================== -->
            <div class="bg-white shadow-sm rounded text-center p-3 mb-4">
              <div class="profile-thumb mt-3 mb-4"> <img class="rounded-circle" src="https://harnishdesign.net/demo/html/payyed/images/profile-thumb.jpg" alt="">
                <div class="profile-thumb-edit bg-primary text-white" data-bs-toggle="tooltip" title="Change Profile Picture"> <i class="fas fa-camera position-absolute"></i>
                  <input type="file" class="custom-file-input" id="customFile">
                </div>
              </div>
              <p class="text-3 fw-500 mb-2">Hello, {{ auth()->user()->name }}</p>
              <p class="mb-2"><a href="https://harnishdesign.net/demo/html/payyed/settings-profile.html" class="text-5 text-light" data-bs-toggle="tooltip" title="Edit Profile"><i class="fas fa-edit"></i></a></p>
            </div>
            <!-- Profile Details End -->

            <!-- Available Balance
            =============================== -->
            <div class="bg-white shadow-sm rounded text-center p-3 mb-4">
              <div class="text-17 text-light my-3"><i class="fas fa-wallet"></i></div>
              <h3 class="text-9 fw-400">{{ $gnl->cur_sym }} {{ formatter_money(auth()->user()->balance) }} </h3>
              <p class="mb-2 text-muted opacity-8">Available Balance</p>
            </div>
            <!-- Available Balance End -->

            <!-- Need Help?
            =============================== -->
            <div class="bg-white shadow-sm rounded text-center p-3 mb-4">
              <div class="text-17 text-light my-3"><i class="fas fa-comments"></i></div>
              <h3 class="text-5 fw-400 my-4">Need Help?</h3>
              <p class="text-muted opacity-8 mb-4">Have questions or concerns regrading your account?<br>
                Our experts are here to help!.</p>
              <div class="d-grid"><a href="#" class="btn btn-primary">Chate with Us</a></div>
            </div>
            <!-- Need Help? End -->

          </aside>
        <!-- Left Panel End -->

        <!-- Middle Panel
        ============================================= -->
        <div class="col-lg-9">

          <!-- Personal Details
          ============================================= -->
          <div class="bg-white shadow-sm rounded p-4 mb-4">
            <h3 class="text-5 fw-400 d-flex align-items-center mb-4">Personal Details<a href="#edit-personal-details" data-bs-toggle="modal" class="ms-auto text-2 text-uppercase btn-link"><span class="me-1"><i class="fas fa-edit"></i></span>Edit</a></h3>
            <hr class="mx-n4 mb-4">
            <div class="row gx-3 align-items-center">
              <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Name:</p>
              <p class="col-sm-9 text-3">{{ $user->name }}</p>
            </div>
            <div class="row gx-3 align-items-center">
                <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Username:</p>
                <p class="col-sm-9 text-3">{{ $user->username }}</p>
              </div>
              <div class="row gx-3 align-items-center">
                <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Account Number:</p>
                <p class="col-sm-9 text-3">{{ $user->account_number }}</p>
              </div>

            <div class="row gx-3 align-items-baseline">
              <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Address:</p>
              <p class="col-sm-9 text-3">{{$user->address->address?? 'N/A'}}<br>

                {{$user->address->city?? ''}}<br>
                {{$user->address->state?? ''}},{{$user->address->zip?? ''}}<br>
                {{$user->address->country?? ''}}</p>
            </div>
          </div>
          <!-- Edit Details Modal
          ================================== -->
          <div id="edit-personal-details" class="modal fade " role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title fw-400">Personal Details</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                  <form id="personaldetails" action="{{route('user.profile.update')}}" method="post">
                    @csrf
                        {{method_field('put')}}

                    <div class="row g-3">
                      <div class="col-12 col-sm-12">
                        <label for="firstName" class="form-label">Full Name</label>
                        <input type="text" value="{{ $user->name }}" name="name" class="form-control" data-bv-field="firstName" id="firstName" required placeholder="Full Name">
                      </div>
                      <div class="col-12 col-sm-6">
                        <label for="username" class="form-label">username</label>
                        <input type="text" value="{{ $user->username }}"  class="form-control" data-bv-field="username" id="username" readonly placeholder="username">
                      </div>
                      <div class="col-12 col-sm-6">
                        <label for="account_number" class="form-label">Account Number</label>
                        <input type="text" value="{{ $user->account_number }}"  class="form-control" data-bv-field="account_number" id="account_number" readonly  placeholder="Full Name">
                      </div>

					  </div>

                      <h3 class="text-5 fw-400 mt-4">Address</h3>
                      <hr>
                      <div class="row g-3">
					  <div class="col-12">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" value="{{$user->address->address}}" name="address" class="form-control" data-bv-field="address" id="address" required placeholder="Address 1">
                      </div>
                      <div class="col-12 col-sm-6">
                        <label for="state" class="form-label">State</label>
                        <input id="state" value="{{$user->address->state}}" name="state" type="text" class="form-control" required placeholder="state">
                    </div>
                      <div class="col-12 col-sm-6">
                          <label for="city" class="form-label">City</label>
                          <input id="city" value="{{$user->address->city}}" name="city" type="text" class="form-control" required placeholder="City">
                      </div>

                      <div class="col-12 col-sm-6">
                        <label for="zipCode" class="form-label">Zip Code</label>
                        <input id="zipCode" value="{{$user->address->zip}}" name="zip" type="text" class="form-control" required placeholder="zip">
                      </div>
                      <div class="col-12 col-sm-6">
                          <label for="inputCountry" class="form-label">Country</label>
                          <select class="form-select" name="country" id="inputCountry" name="country_id">
                            @include('partials.country')
                          </select>
                      </div>
					  <div class="col-12 mt-4 d-grid"><button class="btn btn-primary" type="submit">Save Changes</button></div>
                    </div>

                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- Personal Details End -->



          <!-- Email Addresses
          ============================================= -->
          <div class="bg-white shadow-sm rounded p-4 mb-4">
            <h3 class="text-5 fw-400 d-flex align-items-center mb-4">Contact Addresses<a href="#edit-email" data-bs-toggle="modal" class="ms-auto text-2 text-uppercase btn-link"><span class="me-1"><i class="fas fa-edit"></i></span>Edit</a></h3>
            <hr class="mx-n4 mb-4">
            <div class="row gx-3 align-items-center">
              <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Email ID:</p>
              <p class="col-sm-9 text-3 d-sm-inline-flex d-md-flex align-items-center">{{ $user->email }}</p>
            </div>
            <div class="row gx-3 align-items-center">
              <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Mobile:</p>
              <p class="col-sm-9 text-3">{{ $user->phone }}</p>
            </div>
          </div>
          <!-- Edit Details Modal
          ================================== -->
          <div id="edit-email" class="modal fade" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title fw-400">Contact Addresses</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                  <form id="emailAddresses" action="{{route('user.contact.update')}}" method="post">
                    @csrf
                        {{method_field('put')}}
                    <div class="mb-3">
                      <label for="emailID" class="form-label d-inline-flex align-items-center">Email ID <span class="badge bg-info text-1 fw-500 rounded-pill px-2 py-1 ms-2">Primary</span></label>
                      <input type="text" value="{{ $user->email }}" name="email" class="form-control" data-bv-field="emailid" id="emailID" required placeholder="Email ID">
                    </div>
                    <div class="mb-3" class="form-label">
                      <label for="emailID2" class="form-label">Mobile Number</label>
                      <div class="input-group">
                        <input type="text" value="{{ $user->phone }}" name="phone" class="form-control" data-bv-field="emailid2" id="emailID2" required placeholder="Email ID">
                      </div>
                    </div>

                    <div class="d-grid w-100"><button class="btn btn-primary" type="submit">Save Changes</button></div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- Email Addresses End -->



        </div>
        <!-- Middle Panel End -->
      </div>
    </div>
  </div>
  <!-- Content end -->


@endsection
@push('js')
    <script>
        $("select[name=country]").val("{{ auth()->user()->address->country }}");
    </script>
@endpush
