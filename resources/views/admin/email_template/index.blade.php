


@extends('admin.layouts.master')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{$page_title}}  </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table  class="table table-lg table-hover " id="table1">
                            <thead>
                            <tr>
                                <th>@lang('Name')</th>
                                <th>@lang('Subject')</th>
                                <th>@lang('Status')</th>
                                <th>@lang('Action')</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($email_templates as $template)
                                <tr>
                                    <td>{{ $template->name }}</td>
                                    <td>{{ $template->subj }}</td>
                                    <td>
                                    <span class="badge bg-dot">
                                        @if($template->email_status == 1)
                                            <i class="badge bg-success"></i>
                                            <span class="status">@lang('active')</span>
                                        @else
                                            <i class="badge bg-danger"></i>
                                            <span class="status">@lang('disabled')</span>
                                        @endif
                                    </span>
                                    </td>
                                    <td>

                                        <div class="form-button-action">
                                            <a href="{{ route('admin.email-template.edit', $template->id) }}"  data-toggle="tooltip" title="" class="btn  btn-primary btn-lg" data-original-title="Edit">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('datatable')
<script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
<script src="{{ asset('assets/admin/js/pages/datatables.js') }}"></script>
@endpush
