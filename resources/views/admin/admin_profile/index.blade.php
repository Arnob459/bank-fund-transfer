@extends('admin.layouts.master')

@section('content')

    <section id="basic-vertical-layouts">
        <div class="row match-height">
            <div class="col-md-4 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body text-center">
                            <form class="form form-vertical">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12 ">
                                            <div class="avatar avatar-xl me-3 mb-3 ">
                                            <img src="{{ asset('assets/admin/images/profile/'.$admin->image) }}" alt="" srcset="">
                                            </div>

                                            <h3 class="card-title text-nowrap mb-1"> {{ $admin->username }} </h3>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" action="{{route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" >
                                    @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical"> Name</label>
                                                <input type="text" id="first-name-vertical" class="form-control"
                                                name="name" value="{{ $admin->name }}" required>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="email-id-vertical">Username</label>
                                                <input type="text" id="email-id-vertical" class="form-control"
                                                name="username" value="{{ $admin->username }}" required>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="formFileSm" class="form-label">Avatar </label>
                                            <input class="form-control form-control-sm" name="image" id="formFileSm" type="file">
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="email-id-vertical">Email</label>
                                                <input type="email" id="email-id-vertical" class="form-control"
                                                name="email" value="{{ $admin->email }}" required >
                                            </div>
                                        </div>

                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>
@endsection
