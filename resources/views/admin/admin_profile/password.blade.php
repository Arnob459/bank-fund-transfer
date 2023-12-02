@extends('admin.layouts.master')

@section('content')


    <section id="basic-vertical-layouts " class="d-flex justify-content-center">


            <div class="col-8 ">
                <div class="card">
                    <div class="card-content ">
                        <div class="card-body  ">
                            <form class="form form-vertical" action="{{route('admin.password.update') }}" method="POST" enctype="multipart/form-data" >
                                    @csrf
                                <div class="form-body ">
                                    <div class="row">
                                        <div class="col-12 ">
                                            <div class="form-group">
                                                <label for="first-name-vertical"> Old password</label>
                                                <input type="password" id="first-name-vertical" class="form-control"
                                                name="old_password" required>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="email-id-vertical">New Password</label>
                                                <input type="password" id="email-id-vertical" class="form-control"
                                                name="password" required>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="contact-info-vertical">Confirm Password</label>
                                                <input type="password" id="contact-info-vertical" class="form-control"
                                                name="password_confirmation" required>
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

    </section>
    </div>
@endsection
