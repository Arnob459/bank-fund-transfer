@extends('admin.layouts.master')

@section('content')

<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Kyc Information </h4>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.kyc.update',$user->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-row justify-content-center">
                    <div class="form-group col-md-6">
                        <div class="form-group form-show-validation">
                            <label class="col-lg-4 col-md-3 col-sm-4 mt-sm-2">User NID <span class="required-label">*</span></label>
                            <div class="form-group ">
                                <img src="{{ asset('assets/images/profile/'.$user->nid) }}" alt="Image Preview" id="image-preview"  >
                            </div>
                            <div class="col-lg-12">
                                <div class="input-file input-file-image">
                                    <input type="file" class="form-control form-control-file" id="image" name="nid" accept="image/*" hidden >
                                    <label for="image" class="btn btn-primary"><i class="fa fa-file-image"></i> Update</label>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group form-show-validation">
                            <label class="col-lg-4 col-md-3 col-sm-4 mt-sm-2" >User Passport <span class="required-label">*</span></label>
                            <div class="form-group ">
                                <img src="{{ asset('assets/images/profile/'.$user->passport) }}" alt="Image Preview" id="image-preview2"  >
                            </div>
                            <div class="col-lg-12">

                                <div class="input-file input-file-image">
                                    <input type="file" class="form-control form-control-file" id="imagefav" name="passport" accept="image/*" hidden >
                                    <label for="imagefav" class="btn btn-primary"><i class="fa fa-file-image"></i> Update</label>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <button type="submit"  class="btn btn-success btn-block me-1 mb-3" >Approve</button>
                    </div>
                </form>

                <div class="col-md-6">
                    <form action="{{ route('admin.kyc.reject',$user->id) }}" method="post">
                        @csrf
                        <button type="submit"  class="btn btn-danger btn-block me-1 mb-3" >Reject</button>
                    </form>
                </div>

                </div>
            </div>
        </div>
    </div>
</section>

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
