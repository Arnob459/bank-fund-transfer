@push('css_link')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/fontawesome-5.15.4/css/fontawesome-iconpicker.css') }}">

@endpush
@push('js')
    <script src="{{asset('assets/admin/js/fontawesome-iconpicker.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/custom.js')}}"></script>
@endpush

@push('js')
    <script>
        function store(e) {
            e.preventDefault();
            $("#inputIcon").val($(".iconpicker-component").find('i').attr('class'));
            document.getElementById('socialForm').submit();
        }
    </script>
@endpush

