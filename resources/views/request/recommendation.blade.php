@extends(Auth::check() && Auth::user()->role_id == 1 ? 'layouts.admin' : 'layouts.farmer')
@section('page_title', 'Upload Recommendation')
@section('content')
    @include('request.partials.results.soil_results_recommendation')
@endsection

@section('scripts')
<script src="{{ asset('assets/vendor/dropzone/min/dropzone.min.js') }}"></script>
<script src="{{ asset('assets/js/ui/component.fileupload.js') }}"></script>
@endsection
