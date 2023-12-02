@extends('admin.layouts.master')

@section('content')

@push('button')
<a href="{{ route('admin.blog.create') }}" class="btn btn-warning ">Add New</a>
@endpush

<section class="section">
    <div class="card ">
        <div class="card-header">
            <h4 class="card-title">Blog Section</h4>
        </div>
        <hr>

        <div class="card-body">
            <form action="{{ route('admin.blogsection.update') }}" method="post" >
                @csrf
            <div class="row">

                <div class="col-md-4 mb-3">
                    <div class="form-group">
                        <label for="basicInput" class="mb-2"> Title</label>
                        <input type="text" name="blog_title" class="form-control form-control-lg" id="basicInput" value="{{ $blog->title }}"  required>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="form-group">
                        <label for="basicInput" class="mb-2"> Subtitle</label>
                        <input type="text" name="blog_subtitle" class="form-control form-control-lg" id="basicInput" value="{{ $blog->sub_title }}"  required>
                    </div>
                </div>
                <hr>

                <button type="submit" class="btn btn-success me-1 mb-1">Submit</button>

            </form>

            </div>
        </div>
    </section>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Blog </h4>
            </div>
            <hr>

            <div class="card-body">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-lg">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Actions</th>


                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($blogs as $item)


                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td class="text-bold-500">
                                        <div class="avatar avatar-xl  ">
                                        <img src="{{ asset('assets/images/blog/'.$item->image) }}" >
                                        </div>
                                    </td>
                                    <td class="text-bold-500">{{ $item->title }}</td>
                                    <td>
                                        <a  href="{{ route('admin.blog.edit',$item->id) }}"  class="btn btn-primary rounded-pill"  ><i class ="bi bi-pencil">Edit</i></a>
                                        <button type="button" class="btn btn-danger rounded-pill" data-toggle="modal" data-target="#deleteModal{{ $item->id }}"><i class ="fa fa-trash"></i>Delete</button>
                                    </td>

                                </tr>
                                {{-- Delete modal --}}
                                        <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $item->id }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel{{ $item->id }}">Are You sure?</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete this item?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                        <form method="POST" action="{{ route('admin.blog.destroy', $item->id) }}">
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

                            </tbody>
                        </table>
                    </div>
                </div>


                </div>
            </div>
    </div>
</section>

@endsection
@push('js')
<script src="{{ asset('assets/admin/js/jquery-3.6.0.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
@endpush
