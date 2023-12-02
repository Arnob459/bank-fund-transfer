@extends('admin.layouts.master')

@section('content')


<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add New Slider</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.slider.store') }}" method="post" enctype="multipart/form-data">
                @csrf
            <div class="row">

                <div class="form-group col-md-4">
                    <label class="col-lg-6 mb-2 ">Upload Slider  <span class="required-label">*</span></label>
                    <div class="col-lg-12 mb-3">
                        <div class="form-group ">
                            <img src="http://placehold.it/1920x1120" alt="Image Preview" id="image-preview" style="height:100px" >
                        </div>

                        <div class="input-file input-file-image">
                            <input type="file" class="form-control " id="image" name="image" accept="image/*" hidden >
                            <label for="image" class="btn btn-primary rounded-pill "><i class="fa fa-file-image"></i> Upload a Image</label>
                        </div>
                    </div>
                    <p class="text-warning mb-0">Slider Will Resize 1920x1120.</p>
                    <p class="text-warning mb-0">Only jpg, jpeg, png image allowed.</p>
                </div>


                <div class="col-md-8">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="basicInput" class="mb-2">Enter Title</label>
                                <input type="text" name="title" class="form-control form-control-lg" id="basicInput" placeholder="Enter Title" required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="basicInput" class="mb-2">Enter Subtitle</label>
                                <input type="text" name="subtitle" class="form-control form-control-lg" id="basicInput" placeholder="Enter Subtitle" required>
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


@push('js')
<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#image-preview').attr('src', e.target.result).show();
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    $('#image').on('change', function() {
        previewImage(this);
    });
</script>
@endpush
