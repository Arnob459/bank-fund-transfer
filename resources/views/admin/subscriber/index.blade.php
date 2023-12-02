@extends('admin.layouts.master')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title d-inline-block">@lang('Subscribers')</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">

                            <div class="table-responsive">
                                <table class="table table-hover table-lg">
                                    <thead>
                                    <tr>
                                        <th scope="col">@lang('SL')</th>
                                        <th scope="col">@lang('Email')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($subscribers as $key => $subscriber)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$subscriber->email}}</td>
                                        </tr>
                                    @endforeach
                                    @if (count($subscribers) == 0)
                                        <tr>
                                            <td class="text-center" colspan="2">@lang('NO SUBSCRIBER FOUND')</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                                <ul class="pagination-overfollow">
                                    <p>{{ $subscribers->appends(array_filter(Request::all()))->links( "pagination::bootstrap-5")}}</p>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection


