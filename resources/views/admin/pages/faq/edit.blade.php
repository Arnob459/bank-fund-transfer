@extends('admin.layouts.master')

@section('content')


<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">FAQ Update </h4>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.faq.update',$faq->id) }}" method="post" enctype="multipart/form-data">
                @csrf
            <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="basicInput" class="mb-2">Question</label>
                                <input type="text" name="qus" class="form-control form-control-lg" id="basicInput" value="{{ $faq->question }}"  required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group" class="mb-2">
                                <label for="basicInput">Answer</label>
                                <textarea type="text" cols="5" rows="5" class="form-control" id="basicInput" name="ans" required >{{ $faq->answer }}</textarea>
                            </div>
                        </div>


                <button type="submit" class="btn btn-success  me-1 mb-1">Submit</button>

            </form>

            </div>
        </div>
    </div>
</section>

@endsection


