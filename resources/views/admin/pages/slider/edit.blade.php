@extends('admin.layouts.master')

@section('content')


<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title"> Slider Edit</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.slider.update',$slider->id) }}" method="post" enctype="multipart/form-data">
                @csrf
            <div class="row">

                <div class="form-group col-md-6">
                    <label class="col-lg-6  ">Upload Slider  <span class="required-label">*</span></label>
                    <div class="col-lg-12 ">
                        <img class="img-upload-preview mb-2 " style="height:200px" id="image-preview" src="{{asset('assets/images/slider/' .$slider->image)}}" alt="preview">

                        <div class="input-file input-file-image">
                            <input type="file" class="form-control " id="image" name="image" accept="image/*" hidden >
                            <label for="image" class="btn btn-primary rounded-pill "><i class="fa fa-file-image"></i> Upload a Image</label>
                        </div>
                    </div>
                    <p class="text-warning mb-0">Slider Will Resize 1920x1120.</p>
                    <p class="text-warning mb-0">Only jpg, jpeg, png image allowed.</p>
                </div>


                <div class="col-md-6">
                    <div class="row mb-2">
                        <div class="col-md-12 mb-3">
                            <div class="form-group ">
                                <label for="basicInput">Enter Title</label>
                                <input type="text" name="title" class="form-control form-control-lg" id="basicInput" value="{{ $slider->title }}" required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="basicInput">Enter Subtitle</label>
                                <input type="text" name="subtitle" class="form-control form-control-lg" id="basicInput" value="{{ $slider->sub_title }}" required>
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

@push('js')
<script src="{{ asset('assets/admin/js/jquery-3.6.0.min.js') }}"></script>
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

@endsection


