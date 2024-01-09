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
              <div class="profile-thumb mt-3 mb-4">
                @if (auth()->user()->avatar == null)
                <img class="rounded-circle" src="{{asset('assets/images/users/2.jpg')}}" alt="">
                @else
                <img class="rounded-circle" src="{{asset('assets/images/users/'.auth()->user()->avatar)}}" alt="">
            @endif
            @if (auth()->user()->kyc_verify == 1)
            <div class="profile-thumb-edit bg-primary text-white" data-bs-toggle="tooltip" title="Verified"> <i class="fas fa-check position-absolute"></i>
            </div>
            @endif
              </div>
              <p class="text-3 fw-500 mb-2">Hello, {{ auth()->user()->username }}</p>
              <p class="mb-2"><a href="{{ route('user.profile') }}" class="text-5 text-light" data-bs-toggle="tooltip" title="Edit Profile"><i class="fas fa-edit"></i></a></p>
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



          </aside>
        <!-- Left Panel End -->

        <!-- Middle Panel
        ============================================= -->
        <div class="col-lg-9">

            <div id="content">
                <div class="container">
                  <div class="row g-4">
                    <div class="col-md-4">
                      <div class="bg-white shadow-md rounded h-100 p-3">
                        <div class="featured-box text-center">
                          <div class="featured-box-icon text-primary mt-4"> <i class="fas fa-map-marker-alt"></i></div>
                          <h3>{{ $gnl->site_name }}</h3>
                          <p>{{ $gnl_extra->contact_address }} </p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="bg-white shadow-md rounded h-100 p-3">
                        <div class="featured-box text-center">
                          <div class="featured-box-icon text-primary mt-4"> <i class="fas fa-phone"></i> </div>
                          <h3>Telephone</h3>
                          <p class="mb-0">{{ $gnl_extra->contact_phone }}</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="bg-white shadow-md rounded h-100 p-3">
                        <div class="featured-box text-center">
                          <div class="featured-box-icon text-primary mt-4"> <i class="fas fa-envelope"></i> </div>
                          <h3>Business Inquiries</h3>
                          <p>{{ $gnl_extra->contact_email }}</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="text-center py-5">
                        <h2 class="text-8">Get in touch</h2>
                        <div class="d-flex flex-column">
                          <ul class="social-icons social-icons-lg social-icons-colored justify-content-center">
                            @foreach ($socials as $item)
                            <li class="social-icons-facebook"><a data-bs-toggle="tooltip" href="{{ $item->url }}" target="_blank" ><i class="{{ $item->icon }}"></i></a></li>

                            @endforeach
                          </ul>
                        </div>
                      </div>
                </div>

                <!-- Content end -->


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
