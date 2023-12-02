@extends('admin.layouts.master')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title d-inline-block">@lang('Mail To Subscribers')</div>
                </div>
                <div class="card-body">
                    <form id="exampleValidation" method="post" action="{{route('admin.subscriber.mail.send')}}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="name">@lang('Subject')</label>
                                <input type="text" class="form-control  @error('subject') is-invalid @enderror"
                                       id="name" name="subject" placeholder="Enter subject" required>
                                @error('subject')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <label for="name">@lang('Message')</label>
                                <textarea id="myNicEditor"  name="message" class="form-control  nicEdit" rows="15"></textarea>
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
