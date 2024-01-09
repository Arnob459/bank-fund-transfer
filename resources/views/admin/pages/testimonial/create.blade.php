@extends('admin.layouts.master')

@section('content')


<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Testimonial Create</h4>
        </div>
        <hr>

        <div class="card-body">
            <form action="{{ route('admin.testimonial.store') }}" method="post" enctype="multipart/form-data">
                @csrf
            <div class="row">

                <div class="col-md-12">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="basicInput" class="mb-2">Enter Author Name</label>
                                <input type="text" name="name" class="form-control form-control-lg" id="basicInput" placeholder="Enter Author" required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="basicInput" class="mb-2">Designation</label>
                                <input type="text" name="designation" class="form-control form-control-lg" id="basicInput" placeholder="Enter Designation" required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="basicInput" class="mb-2">Quote</label>
                                <textarea type="text" cols="5" rows="5" class="form-control" id="basicInput" name="quote" required ></textarea>
                            </div>
                        </div>

                    </div>

                </div>

                <button type="submit" class="btn btn-success  me-1 mb-1">Submit</button>

            </form>

            </div>
        </div>
    </div>
</section>


@endsection


