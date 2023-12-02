@extends('admin.layouts.master')

@section('content')


@push('button')
<button type="button" data-bs-toggle="modal"
data-bs-target="#createModal" class="btn btn-warning ">Add New Language</button>
@endpush

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{$page_title}}  </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table  class="table table-hover table-lg" >
                            <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>

                            <tbody>
                            @forelse ($languages as $k => $item)
                                <tr>
                                    <td>{{$k+1}}</td>
                                    <td>{{$item->name}}</td>
                                    <td style="font-size: 22px;">{{ $item->code }}</td>
                                    <td>
                                <span class="badge badge-dot">
                                    @if($item->is_default == 1)
                                        <i class="bg-success"></i>
                                        <span class="status">Default</span>
                                    @else
                                        <span>-</span>
                                    @endif
                                </span>
                                    </td>
                                    <td>
                                        @if($item->id != 1)
                                            <a class="btn btn-primary btn-sm" href="{{route('admin.language-key', $item->id)}}"><i class="fa fa-fw fa-code"></i></a>
                                        @endif

                                        <button type="button" class="btn btn-primary btn-sm editBtn" data-url="{{ route('admin.language-manage-update', $item->id)}}" data-lang="{{ json_encode($item->only('name', 'icon', 'text_align', 'is_default')) }}"><i class="fa fa-fw fa-edit"></i></button>
                                        @if($item->id != 1)
                                            <button type="button" class="btn btn-danger btn-sm bold uppercase deleteBtn" data-url="{{ route('admin.language-manage-del', $item->id) }}"> <i class='fa fa-fw fa-trash'></i></button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{ $empty_message }}</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>


                    </div>
                    {{ $languages->links() }}
                </div>
            </div>
        </div>
    </div>







{{-- NEW MODAL --}}
        <div class="modal fade text-left" id="createModal" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel1">Add New Language </h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form action="{{ route('admin.language-manage-store')}}" method="post">
                @csrf

                <div class="modal-body">


                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="basicInput">Language Name<span class="required-label">*</span></label>
                            <input type="text" name="name" id="name" class="form-control form-control-lg"  placeholder="e.g. japaneese,portuguese" required>
                        </div>
                    </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="basicInput">Language Code<span class="required-label">*</span></label>
                                <input type="text" name="code" id="code" class="form-control form-control-lg"  placeholder="e.g. jp" required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class=" form-group">
                                    <label>Text Direction <span class="text-danger">*</span></label>
                                    <select name="text_align" class="form-control">
                                        <option value="0">Left to Right</option>
                                        <option value="1">Right to Left</option>
                                    </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="inputName" class="">Default Language <span class="text-danger">*</span></label>
                            <input type="checkbox" data-width="100%" data-height="40px" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="SET" data-off="UNSET" name="is_default">
                        </div>


                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" class="btn btn-primary ml-1" >
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Update</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

{{-- EDIT MODAL --}}
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Edit Language</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <form method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">

                    <div class="form-row">
                        <div class="col-md-6 ">
                            <label for="inputName" class="">@lang('Default Language') <span class="text-danger">*</span></label>
                            <input type="checkbox" data-width="100%" data-height="40px" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="SET" data-off="UNSET" name="is_default">
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="form-row">
                        <label for="inputName" class="col-sm-12 ">@lang('Language Name') <span class="text-danger">*</span></label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control has-error bold " id="code" name="name" required>
                        </div>
                    </div>

                    <div class="form-row d-none">
                        <label class="col-sm-12">@lang('Text Direction') <span class="text-danger">*</span></label>
                        <div class="col-sm-12">
                            <select name="text_align" class="form-control" required>
                                <option value="0">@lang('Left to Right')</option>
                                <option value="1">@lang('Right to Left')</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn btn-primary bold uppercase" id="btn-save" value="add">@lang('Update')</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- DELETE MODAL --}}
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">@lang('Remove Language')</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <form method="post" action="" class="form-inline">
                @csrf
                {{method_field('delete')}}
                <input type="hidden" name="delete_id" id="delete_id" class="delete_id" value="0">
            <div class="modal-body">
                <p class="text-muted">@lang('Are you sure you want to Delete')?</p>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-danger deleteButton">@lang('Delete')</button>
                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">@lang('Close')</button>
            </div>

            </form>

        </div>
    </div>
</div>
@endsection




@push('js')
<script>
    $('.editBtn').on('click', function() {
        var modal = $('#editModal');
        var url = $(this).data('url');

        var lang = $(this).data('lang');

        modal.find('form').attr('action', url);

        modal.find('input[name=name]').val(lang.name);
        modal.find('select[name=text_align]').val(lang.text_align);

        modal.modal('show');
    });

    $('.deleteBtn').on('click', function() {
        var modal = $('#deleteModal');
        var url = $(this).data('url');

        modal.find('form').attr('action', url);
        modal.modal('show');
    });
</script>
@endpush
