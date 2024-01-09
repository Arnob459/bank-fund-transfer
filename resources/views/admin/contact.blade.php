@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    <div class="card-title">{{$page_title}} Section</div>
                </div>
                <form  class="exampleValidation" action="{{route('admin.settings.contact')}}" method="post">
                    @csrf
                    <div class="card-body ">
                        <div class="row ">
                            <div class="form-group col-md-12 mb-4">
                                <label for="" class="mb-2">Contact email </label>
                                <input type="text" class="form-control form-control-lg" name="contact_email" value="{{$setting_extra->contact_email}}"
                                       placeholder="Enter Contact Email">
                                <code>this email will use in contact </code>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="" class="mb-2">Contact phone</label>
                                <input type="text" class="form-control form-control-lg" name="contact_phone" value="{{$setting_extra->contact_phone}}"
                                       placeholder="Enter Contact Phone">
                                <code>this phone will use in contact </code>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="" class="mb-2">Contact address</label>
                                <input type="text" class="form-control form-control-lg" name="contact_address" value="{{$setting_extra->contact_address}}"
                                       placeholder="Enter Contact Address">
                                <code>this address will use in contact</code>
                            </div>

                        </div>
                    </div>
                    <div class="card-footer pt-3">
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-success btn-block">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection


