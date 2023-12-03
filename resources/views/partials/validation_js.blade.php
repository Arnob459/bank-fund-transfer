@push('js_link')
    <!-- Moment JS -->
    <script src="{{asset('assets/admin/js/plugin/moment/moment.min.js')}}"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.full.min.js"></script>

    <!-- jQuery Validation -->
<!-- Include jQuery Validation Plugin from a CDN (example) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
@endpush
@push('js')

    <script>

        $("#exampleValidation").validate({
            validClass: "success",

            highlight: function (element) {
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            success: function (element) {
                $(element).closest('.form-group').removeClass('has-error').removeClass('error');

            },
        });


    </script>
@endpush

