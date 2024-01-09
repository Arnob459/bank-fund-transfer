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

            <!-- Notifications
            ============================================= -->
            <div class="bg-white shadow-sm rounded py-4 mb-4">
              <h3 class="text-5 fw-400 px-4 mb-4">Notifications</h3>
              <hr class="mb-0">

              <!-- Notifications List
              =============================== -->
              <div class="notifications-list">
                @foreach ($notification as $nt)

                <div class="notifications-item unread px-4 py-3">
                  <div class="row align-items-center flex-row">
                    <div class="col-2 col-sm-1 text-center text-8 icon-bell"><i class="far fa-bell"></i></div>
                    <div class="col col-sm-10">
                      <h4 class="text-3 mb-1">{{ $nt->details }} Amount: {{formatter_money($nt->amount) }} {{ $gnl->cur_sym }} </h4>
                      <span class="text-muted">{{ $nt->created_at }}</span> </div>
                  </div>
                </div>
                @endforeach

              </div>
              <!-- Notifications List End -->



            </div>
            <!-- Notifications End -->

          </div>
          <!-- Middle Panel End -->

      </div>
    </div>
  </div>
  <!-- Content end -->
@endsection
