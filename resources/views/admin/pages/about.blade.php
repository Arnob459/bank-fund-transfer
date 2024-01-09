@extends('admin.layouts.master')

@section('content')

<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">About US</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.about.update') }}" method="post" enctype="multipart/form-data">
                @csrf
            <div class="row">



                <div class="form-group col-md-4">
                    <label class="col-lg-6 mb-2">About Image  <span class="required-label">*</span></label>
                    <div class="form-group ">
                        <img src="{{ asset('assets/images/about/'.$about->about_image) }}" alt="Image Preview" id="image-preview" style="height:150px" >
                    </div>
                    <div class="col-lg-12">
                        <div class="input-file input-file-image">

                            <input type="file" class="form-control " id="image" name="about_image" accept="image/*" hidden >
                            <label for="image" class="btn btn-primary rounded-pill "><i class="fa fa-file-image"></i> Upload </label>
                        </div>
                    </div>
                    <p class="text-warning mb-0">Image Will Resize 650x433.</p>
                    <p class="text-warning mb-0">Only jpg, jpeg, png image allowed.</p>
                </div>

                <div class="form-group col-md-8">
                <div class="row">

                    <div class="col-md-12 mb-2">
                        <div class="form-group">
                            <label for="basicInput" class="mb-2">Enter Title</label>
                            <input type="text" name="about_title" class="form-control form-control-lg" id="basicInput" value="{{ $about->about_title }}"  required>
                        </div>
                    </div>

                    <div class="col-md-12 mb-2">
                        <div class="form-group">
                            <label for="myNicEditor" class="mb-2">Description</label>
                            <textarea type="text" cols="10" rows="10" class="form-control" id="myNicEditor" name="about_description" required >{{  $about->about_des  }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

                <button type="submit" class="btn btn-success me-1 mb-1">Submit</button>

            </form>

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
@endpush
@push('nicEdit')
<script type="text/javascript" src="//js.nicedit.com/nicEdit-latest.js"></script>
<!-- Include NicEdit from a CDN -->


<script type="text/javascript">
    //<![CDATA[
    bkLib.onDomLoaded(function() {
        nicEditors.editors.push(
            new nicEditor().panelInstance(
                document.getElementById('myNicEditor')
            )
        );
    });
    //]]>
    </script>

@endpush

@endsection
