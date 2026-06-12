@extends(Auth::check() && Auth::user()->role_id == 1 ? 'layouts.admin' : 'layouts.farmer')
@section('page_title', 'Farm Details')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h4>{{ $farm->farm_name }}</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Farm ID</th>
                            <td>{{ $farm->farm_id }}</td>
                        </tr>
                        <tr>
                            <th>Farm Name</th>
                            <td>{{ $farm->farm_name }}</td>
                        </tr>
                        <tr>
                            <th>Postal Address</th>
                            <td>{{ $farm->postal_address ?? 'n/a' }}</td>
                        </tr>
                        <tr>
                            <th>Contact Phone</th>
                            <td>{{ $farm->contact_phone ?? 'n/a' }}</td>
                        </tr>
                        <tr>
                            <th>Size (Hectares)</th>
                            <td>{{ $farm->size ?? 'n/a' }}</td>
                        </tr>
                        <tr>
                            <th>Latitude</th>
                            <td>{{ $farm->lat ?? 'n/a' }}</td>
                        </tr>
                        <tr>
                            <th>Longitude</th>
                            <td>{{ $farm->long ?? 'n/a' }}</td>
                        </tr>
                        <tr>
                            <th>Registered On</th>
                            <td>{{ $farm->created_at ? $farm->created_at->format('M d, Y') : 'n/a' }}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="mt-4">
                    <a href="{{ route('farmer.profile') }}" class="btn btn-secondary">Back to Profile</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
