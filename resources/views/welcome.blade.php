@extends(Auth::check() && Auth::user()->role_id == 1 ? 'layouts.admin' : 'layouts.farmer')
@section('page_title', 'Welcome')
@section('content')

<!-- Start Content-->

<!-- container -->


@endsection


