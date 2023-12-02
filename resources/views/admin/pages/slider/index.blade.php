@extends('admin.layouts.master')

@section('content')

@push('button')
<a href="{{ route('admin.slider.create') }}" class="btn btn-lg btn-warning ">Add New</a>
@endpush

<section class="section">

    <div class="row">
        @foreach ($sliders as $slider)
        <div class="col-xl-4 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">

                    <img class="img-fluid w-100" src="{{ asset('assets/images/slider/'.$slider->image) }}" id="image-preview" alt="Slider Image">

                    </div>
                </div>
                <hr>

                <div class="card-footer ">
                    <h4 class="card-title"> {{ $slider->title }}</h4>
                    <p> {{ $slider->subtitle }} </p>
                    <a type="submit"  href="{{ route('admin.slider.edit',$slider->id) }}"  class="btn btn-primary rounded-pill"  ><i class ="bi bi-pencil">Edit</i></a>
                    <button type="button" class="btn btn-danger rounded-pill" data-toggle="modal" data-target="#deleteModal{{ $slider->id }}"><i class ="fa fa-trash"></i>Delete</button>
                </div>
            </div>
        </div>
         {{-- Delete modal --}}
         <div class="modal fade" id="deleteModal{{ $slider->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $slider->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel{{ $slider->id }}">Are you sure?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this item?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <form method="POST" action="{{ route('admin.slider.destroy', $slider->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    {{-- modal --}}
    @endforeach

    </div>




</section>

@endsection
@push('js')
<script src="{{ asset('assets/admin/js/jquery-3.6.0.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
@endpush
