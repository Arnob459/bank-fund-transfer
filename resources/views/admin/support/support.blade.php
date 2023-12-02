@extends('admin.layouts.master')

@section('content')

                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            {{ $page_title }}
                        </div>
                        <div class="card-body" >
                            <div class="table-responsive">
                            <table class="table table-hover table-lg" id="table1">
                                <thead>
                                    <tr>
                                        <th scope="col"> @lang('Ticket Id') </th>
                                        <th scope="col"> @lang('Username')</th>
                                        <th scope="col"> @lang('Subject') </th>
                                        <th scope="col"> @lang('Raised Time') </th>
                                        <th scope="col"> @lang('Last Reply') </th>
                                        <th scope="col"> @lang('Status') </th>
                                        <th scope="col"> @lang('Action') </th>
                                    </tr>
                                </thead>
                                @forelse($all_ticket as $key=>$data)
                                <tr>
                                    <td>{{$data->ticket}}</td>
                                    <td><b><a href="{{route('admin.user.edit',$data->id)}}">{{$data->user->username}}</a></b></td>
                                    <td><b>{{$data->subject}}</b></td>
                                    <td>{{ \Carbon\Carbon::parse($data->created_at)->format('F dS, Y - h:i a') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($data->updated_at)->format('F dS, Y - h:i a') }}</td>
                                    <td>
                                        @if($data->status == 1)
                                            <span class="badge bg-warning">@lang('Opened')</span>
                                        @elseif($data->status == 2)
                                            <span class="badge bg-success">@lang('Answered')</span>
                                        @elseif($data->status == 3)
                                            <span class="badge bg-info">@lang('Customer Reply')</span>
                                        @elseif($data->status == 9)
                                            <span class="badge bg-danger">@lang('Closed')</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-primary btn-sm" href="{{route('admin.ticket.reply', $data->ticket )}}">View</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">@lang('No Information')</td>
                                </tr>
                            @endforelse

                            </tbody>
                            </table>
                            <ul class="pagination-overfollow">
                                <p>{{ $all_ticket->appends(array_filter(Request::all()))->links( "pagination::bootstrap-5")}}</p>
                            </ul>

                        </div>
                        </div>
                    </div>

                </section>
            </div>


@endsection
