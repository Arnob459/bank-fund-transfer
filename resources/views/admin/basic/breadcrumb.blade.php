@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">{{$page_title}}</div>
                </div>
                <div class="card-body">
                    <form  id="exampleValidation" method="post" action="{{route('admin.settings.breadcrumb')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row justify-content-center">
                            <div class="form-group col-md-12">
                                <div class="form-group form-show-validation">
                                    <label class="col-lg-4 col-md-3 col-sm-4 mt-sm-2">@lang('Upload breadcrumb') <span class="required-label">*</span></label>
                                    <div class="col-lg-12 mb-3">
                                    <img class="img-upload-preview image-fluid" id="image-preview" style="max-height: 350px;"  src="{{asset('assets/images/breadcrumb/'. $gnl->breadcrumb)}}" alt="preview">
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="input-file input-file-image">
                                            <input type="file" class="form-control form-control-file" id="image" name="breadcrumb" accept="image/*" hidden>
                                            <label for="image" class="btn btn-primary rounded-pill btn-lg"><i class="fa fa-file-image"></i> @lang('Upload a Breadcrumb')</label>
                                        </div>
                                    </div>
                                    <p class="text-warning mb-0 mt-2">@lang('Breadcrumb Will Resize 1920pxX350px or upload 1920pxX350px Breadcrumb for best quality').</p>
                                    <p class="text-warning mb-0">@lang('Only jpg, jpeg, png image allowed').</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-action">
                            <button class="btn btn-success btn-block">@lang('Submit')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
