@extends('admin.layouts.master')

@section('content')


<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title"> Testimonial Edit</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.testimonial.update',$testimonial->id) }}" method="post" enctype="multipart/form-data">
                @csrf
            <div class="row">

                <div class="col-md-12">
                    <div class="row mb-2">
                        <div class="col-md-12 mb-3">
                            <div class="form-group ">
                                <label for="basicInput" class="mb-2"> Author Name</label>
                                <input type="text" name="name" class="form-control form-control-lg" id="basicInput" value="{{ $testimonial->author }}" required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="basicInput" class="mb-2"> Designation </label>
                                <input type="text" name="designation" class="form-control form-control-lg" id="basicInput" value="{{ $testimonial->designation }}" required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="basicInput" class="mb-2">Quote</label>
                                <textarea type="text" cols="5" rows="5" class="form-control" id="basicInput" name="quote" required >{{ $testimonial->quote }}</textarea>
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


