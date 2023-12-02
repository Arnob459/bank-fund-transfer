@extends('admin.layouts.master')

@section('content')

<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Title Subtitle Section</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.titleSubtitle.update') }}" method="post" enctype="multipart/form-data">
                @csrf
            <div class="row">

                <div class="col-md-12 mb-2">
                    <div class="form-group">
                        <label for="basicInput" class="mb-2">Plan Title <span class="required-label">*</span></label>
                        <input type="text" name="plan_title" class="form-control form-control-lg" id="basicInput" value="{{ $plan_title->title }}"  required>
                    </div>
                </div>

                <div class="col-md-12 mb-2">
                    <div class="form-group">
                        <label for="basicInput" class="mb-2">Plan Sub-Title <span class="required-label">*</span></label>
                        <input type="text" name="plan_subtitle" class="form-control form-control-lg" id="basicInput" value="{{ $plan_title->sub_title }}"  required>
                    </div>
                </div>

                <div class="col-md-12 mb-2">
                    <div class="form-group">
                        <label for="basicInput" class="mb-2">Latest Deposit Withdraw Title  <span class="required-label">*</span></label>
                        <input type="text" name="deposit_title" class="form-control form-control-lg" id="basicInput" value="{{ $latest_depo_title->title }}"  required>
                    </div>
                </div>

                <div class="col-md-12 mb-2">
                    <div class="form-group">
                        <label for="basicInput">Latest Deposit Withdraw Subtitle  <span class="required-label">*</span></label>
                        <input type="text" name="deposit_subtitle" class="form-control form-control-lg" id="basicInput" value="{{ $latest_depo_title->sub_title }}"  required>
                    </div>
                </div>

                <div class="col-md-12 mb-2">
                    <div class="form-group">
                        <label for="basicInput" class="mb-2">Payment Methods Title <span class="required-label">*</span></label>
                        <input type="text" name="method_title" class="form-control form-control-lg" id="basicInput" value="{{ $gateway_title->title }}"  required>
                    </div>
                </div>

                <div class="col-md-12 mb-2">
                    <div class="form-group">
                        <label for="basicInput" class="mb-2">Payment Methods Subtitle <span class="required-label">*</span></label>
                        <input type="text" name="method_subtitle" class="form-control form-control-lg" id="basicInput" value="{{ $gateway_title->sub_title }}"  required>
                    </div>
                </div>

                <button type="submit" class="btn btn-success me-1 mb-1">Submit</button>



            </form>

            </div>
        </div>
    </div>
</section>

@endsection
