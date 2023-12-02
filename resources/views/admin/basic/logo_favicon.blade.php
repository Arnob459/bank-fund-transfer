@extends('admin.layouts.master')

@section('content')

<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Logo and Favicon </h4>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.settings.logo') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-row justify-content-center">
                    <div class="form-group col-md-6">
                        <div class="form-group form-show-validation">
                            <label class="col-lg-4 col-md-3 col-sm-4 mt-sm-2">Upload Logo <span class="required-label">*</span></label>
                            <div class="form-group ">
                                <img src="{{ asset('assets/images/logo/'.$gnl->logo) }}" alt="Image Preview" id="image-preview" style="height:100px" >
                            </div>
                            <div class="col-lg-12">
                                <div class="input-file input-file-image">
                                    <input type="file" class="form-control form-control-file" id="image" name="logo" accept="image/*" hidden >
                                    <label for="image" class="btn btn-primary rounded-pill btn-lg"><i class="fa fa-file-image"></i> Upload a Logo</label>
                                </div>
                            </div>
                            <p class="text-warning mb-0 mt-2">Upload 160pxX35px Logo for best quality.</p>
                            <p class="text-warning mb-0">Only jpg, jpeg, png image allowed.</p>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group form-show-validation">
                            <label class="col-lg-4 col-md-3 col-sm-4 mt-sm-2" >Upload Favicon <span class="required-label">*</span></label>
                            <div class="form-group ">
                                <img src="{{ asset('assets/images/logo/'.$gnl->favicon) }}" alt="Image Preview" id="image-preview2" style="height:100px" >
                            </div>
                            <div class="col-lg-12">

                                <div class="input-file input-file-image">
                                    <input type="file" class="form-control form-control-file" id="imagefav" name="favicon" accept="image/*" hidden >
                                    <label for="imagefav" class="btn btn-primary rounded-pill btn-lg"><i class="fa fa-file-image"></i> Upload a Favicon</label>
                                </div>
                            </div>
                            <p class="text-warning mb-0 mt-2">Upload 40pxX40px Favicon for best quality.</p>
                            <p class="text-warning mb-0">Only jpg, jpeg, png image allowed.</p>
                        </div>
                    </div>
                </div>

                <div class="card-action">
                    <button type="submit" class="btn btn-success btn-block">Submit</button>
                </div>



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

<script>
    function previewImage2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#image-preview2').attr('src', e.target.result).show();

            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    $('#imagefav').on('change', function() {
        previewImage2(this);
    });

</script>

@endpush

@endsection
