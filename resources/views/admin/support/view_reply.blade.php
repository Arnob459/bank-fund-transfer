@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    <div class="card-title">Ticket</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-10">
                            <h4><b>Ticket:</b> {{$ticket_object->ticket}} | <b>subject :</b>  {{$ticket_object->subject}}</h4>
                        </div>
                        <div class="col-md-2">
                            <div class="float-right">
                                @if($ticket_object->status == 1)
                                    <button class="btn btn-warning"> @lang('Opened')</button>
                                @elseif($ticket_object->status == 2)
                                    <button type="button" class="btn btn-success"> @lang('Answered')</button>
                                @elseif($ticket_object->status == 3)
                                    <button type="button" class="btn btn-info"> @lang('Customer Reply')</button>
                                @elseif($ticket_object->status == 9)
                                    <button type="button" class="btn btn-danger"> @lang('Closed')</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Support Message</div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('admin.store.reply', $ticket_object->ticket)}}"
                          accept-charset="UTF-8" class="form-horizontal form-bordered">
                       @csrf
                        <div class="form-group">
                            <label class="col-md-12 bold">@lang('Reply'): </label>
                            <div class="col-md-12">
                                <textarea class="form-control" name="comment" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-info col-md-12"><i class="fa fa-check"></i>Reply
                                </button>
                            </div>

                        </div>
                    </form>
                    <hr>

                    <div class="form-group">
                        <div class="col-md-12">
                            @foreach($ticket_data as $data)
                                @if($data->type == 1)

                                    <div class="list-group-item align-items-start mb-2">
                                        <div class="list-group-item-body">
                                            <h4 class="list-group-item-title text-truncate">
                                                <a href="{{route('admin.user.edit', $username->id)}}">  {{$username->username}}</a>
                                            </h4>
                                            <p> {{ $data->comment}} </p>
                                            <p class="list-group-item-text small"> {{ \Carbon\Carbon::parse($data->updated_at)->format('F dS, Y - h:i A') }} </p>
                                        </div>
                                    </div>

                                @else
                                    <div class="list-group-item align-items-start mb-2">
                                        <div class="list-group-item-body">
                                            <h4 class="list-group-item-title text-truncate">
                                                <a href="#">{{Auth::guard('admin')->user()->name}}</a>
                                            </h4>
                                            <p> {{ $data->comment}} </p>
                                            <p class="list-group-item-text small"> {{ \Carbon\Carbon::parse($data->updated_at)->format('F dS, Y - h:i A') }} </p>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
